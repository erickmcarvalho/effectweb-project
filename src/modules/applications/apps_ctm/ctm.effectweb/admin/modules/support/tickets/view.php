<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Effect Web: Support - Tickets - View
 * Last Update: 23/12/2012 - 20:27h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Admin_Support_Tickets_View extends CTM_EffectWeb_Admin_Support_Tickets
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		$this->DB->Arguments($_GET['id']);
		$find_ticket_q = $this->DB->Query("SELECT * FROM dbo.CTM_Tickets WHERE Id = %d");

		if($this->DB->CountRows($find_ticket_q) > 0)
		{
			$ticket = $this->DB->FetchObject($find_ticket_q);
			
			define("EDIT_TICKET_ACCESS", $this->CheckPermissionItem("edit_ticket"));
			define("DELETE_TICKET_ACCESS", $this->CheckPermissionItem("delete_ticket"));
			
			switch($_GET['cmd'])
			{
				case "annex" :
					if(!empty($ticket->Annex))
					{
						ini_set("memory_limit", "240M");
						ob_end_clean();

						$filename = "../".$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['TICKET_ANNEX'].$ticket->Annex;
						$fileext = substr($filename, strrpos($filename, "."));
						
						if(preg_match("/\.([gif|jpg|jpeg|png])/i", $fileext))
						{
							switch($fileext)
							{
								case ".gif" :
									$image = imagecreatefromgif($filename);

									header("Content-type: image/gif");
									imagegif($image);
								break;
								case ".png" :
									$image = imagecreatefrompng($filename);

									header("Content-type: image/png");
									imagepng($image);
								break;
								case ".jpg" :
									$image = imagecreatefromjpeg($filename);

									header("Content-type: image/jpeg");
									imagejpeg($image);
								break;
								case ".jpeg" :
									$image = imagecreatefromjpeg($filename);

									header("Content-type: image/jpeg");
									imagejpeg($image);
								break;
							}
						
							imagedestroy($image);
						}
						else
						{
							header("Content-type: text/plain");
							readfile($filename);
						}
					}
					exit();
				break;
				case "close" :
					if($ticket->Status == 3)
					{
						if($_GET['return'] == true)
							exit("<script>location.href='?app=support&do=tickets&load=isClosed';</script>");
						else
							exit(adminShowMessage($this->lang->words['EWSupport']['Tickets']['ViewTicket']['CloseTicket']['Messages']['TicketClosed'], 2));
					}
					else
					{
						$this->DB->Arguments($_GET['id']);
						$this->DB->Query("UPDATE dbo.CTM_Tickets SET Status = 3 WHERE Id = %d");
						
						if($_GET['return'] == true)
							exit("<script>location.href='?app=support&do=tickets&load=closed';</script>");
						else
							exit("<script>closeThisTicket();</script>");
					}
				break;
				case "reply" :
					if(empty($_POST['ReplyText']))
					{
						exit(adminShowMessage($this->lang->words['EWSupport']['Tickets']['ViewTicket']['ReplyTicket']['Messages']['TextVold'], 2));
					}
					else
					{
						$sendDate = time();
						
						$this->DB->Arguments($_GET['id'], $this->member['account']['data']['Name'], USER_ACCOUNT, $sendDate, htmlEncode($_POST['ReplyText']));
						$this->DB->Query("INSERT INTO dbo.CTM_TicketReplies (TicketID, Author, Account, [Date], Message) VALUES (%d, '%s', '%s', %d, '%s')");
						
						$this->DB->Arguments($_GET['id']);
						$this->DB->Query("UPDATE dbo.CTM_Tickets SET Status = 1 WHERE Id = %d");
						
						$id = $this->DB->GetLastedId();
						exit("<script>addReplyTicket('".str_replace("'", "\'", $_POST['ReplyText'])."','".$this->member['account']['data']['Name']."','".date("d/m/Y - H:i", $sendDate)."',{$id});</script>");
					}
				break;
				case "edit" :
					if(EDIT_TICKET_ACCESS)
					{
						if(empty($_POST['Subject']) || empty($_POST['Message']))
							exit(adminShowMessage($this->lang->words['EWSupport']['Tickets']['ViewTicket']['EditTicket']['Messages']['FieldsVold'], 1));
							
						$this->DB->Arguments(htmlEncode($_POST['Subject']), $_POST['Departament'], $_POST['Status'], htmlEncode($_POST['Message']), $_GET['id']);
						$this->DB->Query("UPDATE dbo.CTM_Tickets SET Subject = '%s',Departament = %d,Status = %d,Text = '%s' WHERE Id = %d");
						
						switch($_POST['Status'])
						{
							case 0 : 
								$status = "<span style='color: blue;'>".$this->lang->words['EWSupport']['Tickets']['Status']['Opened']."</span>";
							break;
							case 1 : 
								$status = "<span style='color: green;'>".$this->lang->words['EWSupport']['Tickets']['Status']['Responded']."</span>";
							break;
							case 2 : 
								$status = "<span style='color: orange;'>".$this->lang->words['EWSupport']['Tickets']['Status']['Progress']."</span>";
							break;
							case 3 : 
								$status = "<span style='color: red;'>".$this->lang->words['EWSupport']['Tickets']['Status']['Closed']."</span>";
							break;
						}
						
						$return = "<script>completeEditTicket(";
						$return .= "'".str_replace("'", "\'", htmlDecode(htmlEncode($_POST['Subject']), TRUE))."',";
						$return .= "'".str_replace("'", "\'", $this->settings['USERPANEL']['SUPPORT']['TICKETS']['DEPARTAMENTS'][$_POST['Departament']])."',";
						$return .= "'".str_replace("'", "\'", $status)."',";
						$return .= "'".str_replace("'", "\'", htmlDecode(htmlEncode($_POST['Message']), TRUE))."'";
						$return .= ");</script>";
						exit($return);
					}
				break;
				case "delete" :
					if(DELETE_TICKET_ACCESS)
					{
						$query = "DELETE FROM dbo.CTM_Tickets WHERE Id = %d;\n";
						$query .= "DELETE FROM dbo.CTM_TicketReplies WHERE TicketID = %d;";
						
						$this->DB->Arguments($_GET['id'], $_GET['id']);
						$this->DB->Query($query);
						
						if(!empty($ticket->Annex))
							if(file_exists("../".$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['TICKET_ANNEX'].$ticket->Annex))
								unlink("../".$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['TICKET_ANNEX'].$ticket->Annex);
						
						exit("<script>location.href='".$this->acp_vars['acp_url']."?app=effectweb&module=support&section=tickets&message=deleted';</script>");
					}
				break;
				case "editReply" :
					$this->DB->Arguments($_GET['rid'], $_GET['id']);
					$query = $this->DB->Query("SELECT Id,Message FROM dbo.CTM_TicketReplies WHERE Id = %d AND TicketID = %d");
					
					if($this->DB->CountRows($query) > 0)
					{
						if($_GET['write'] == TRUE)
						{
							if(empty($_POST['ReplyMessage']))
								exit(adminShowMessage($this->lang->words['EWSupport']['Tickets']['ViewTicket']['EditReply']['Messages']['FieldVoid'], 1));
							
							$this->DB->Arguments(htmlEncode($_POST['ReplyMessage']), $_GET['rid'], $_GET['id']);
							$this->DB->Query("UPDATE dbo.CTM_TicketReplies SET Message = '%s' WHERE Id = %d AND TicketID = %d");
						
							exit("<script>editTicketReply('".str_replace(array("\n", "\r"), NULL, $_POST['ReplyMessage'])."',".$_GET['rid'].");</script>");
						}
						else
						{
							$reply = $this->DB->FetchArray($query);
							$noOpenCache = TRUE;
							
							$GLOBALS['edit_reply']['ticket_id'] = $_GET['id'];
							$GLOBALS['edit_reply']['reply_id'] = $_GET['rid'];
							$GLOBALS['edit_reply']['reply_message'] = str_replace(array("\n", "\r"), NULL, htmlDecode($reply['Message'], true));

							$this->output->setContent("tickets_viewTicket_editReply");
							$this->output->setVariable("no_set_temp", true);
						}
					}
					else exit();
				break;
				case "deleteReply" :
					$this->DB->Arguments($_GET['rid'], $_GET['id']);
					$query = $this->DB->Query("SELECT Id FROM dbo.CTM_TicketReplies WHERE Id = %d AND TicketID = %d");
					
					if($this->DB->CountRows($query) > 0)
					{
						$this->DB->Arguments($_GET['rid'], $_GET['id']);
						$this->DB->Query("DELETE FROM dbo.CTM_TicketReplies WHERE Id = %d AND TicketID = %d");
						
						exit("<script>"."$"."('#replyId-".$_GET['rid']."').hide('slow');</script>");
					}
					exit();
				break;
			}

			$this->DB->Arguments($_GET['id']);
			$query = $this->DB->Query("SELECT * FROM dbo.CTM_TicketReplies WHERE TicketID = %d");
			
			$replies = array();

			if($this->DB->CountRows($query) > 0)
			{
				while($reply = self::DB()->FetchObject($query))
				{
					$replies[$reply->Id] = array
					(
						"author" => $reply->Author,
						"is_team" => $this->functions->CheckTeamACP($reply->Account),
						"send_date" => date("d/m/Y - G:i a", $reply->Date),
						"message" => htmlDecode($reply->Message, true)
					);
				}
			}

			$GLOBALS['view_ticket'] = array
			(
				"id" => $ticket->Id,
				"subject" => $ticket->Subject,
				"departament" => array
				(
					"id" => $ticket->Departament,
					"title" => $this->settings['USERPANEL']['SUPPORT']['TICKETS']['DEPARTAMENTS'][$ticket->Departament]
				),
				"open_date" => date("d/m/Y - G:i a", $ticket->Date),
				"account" => $ticket->Account,
				"character" => $ticket->Character,
				"message" => nl2br(htmlDecode($ticket->Text)),
				"status" => $ticket->Status,
				"protocol" => $ticket->Protocol,
				"annex" => $ticket->Annex,
				"replies" => $replies
			);
			
			if($noOpenCache == false)
				$this->output->setContent("tickets_viewTicket");
		}
	}
}
		