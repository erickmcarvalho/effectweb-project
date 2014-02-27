<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Application User Control Panel - Support Options
 * Last Update: 13/08/2012 - 00:57h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class UserPanel_Support extends CTM_EffectWeb_UserPanel
{
	/**
	 *	Init Class
	 *
	 *	@return	void
	*/
	public function initClass()
	{
		$this->registry();
		$this->FactoryCP();
	}
	/**
	 *	Option: Tickets
	 *	Tickets for support
	 *
	 *	@return	void
	*/
	public function SupportTickets()
	{
		switch($_GET['section'] ? $_GET['section'] : $this->URLData[2])
		{
			case "list" :
				$this->DB->Arguments(USER_ACCOUNT);
				$this->DB->Query("SELECT Id, Departament, Subject, Status, [Date] FROM dbo.CTM_Tickets WHERE Account = '%s' ORDER BY Id DESC", $all_tickets_q);
				
				$tickets_opened = array();
				$tickets_progress = array();
				$tickets_closed = array();
				
				if($this->DB->CountRows($all_tickets_q) > 0)
				{
					while($all_tickets = $this->DB->FetchObject($all_tickets_q))
					{
						switch($all_tickets->Status)
						{
							case 0 : 
								$var_name = "tickets_opened"; 
								$status = "<span style='color: blue;'>".$this->lang->words['UserPanel']['SupportTickets']['Status']['Opened']."</span>";
							break;
							case 1 : 
								$var_name = "tickets_progress"; 
								$status = "<span style='color: green;'>".$this->lang->words['UserPanel']['SupportTickets']['Status']['Responded']."</span>";
							break;
							case 2 : 
								$var_name = "tickets_progress"; 
								$status = "<span style='color: orange;'>".$this->lang->words['UserPanel']['SupportTickets']['Status']['Progress']."</span>";
							break;
							case 3 : 
								$var_name = "tickets_closed"; 
								$status = "<span style='color: red;'>".$this->lang->words['UserPanel']['SupportTickets']['Status']['Closed']."</span>";
							break;
						}
						
						${$var_name}[$all_tickets->Id] = array
						(
							"departament" => htmlEncode($this->settings['USERPANEL']['SUPPORT']['TICKETS']['DEPARTAMENTS'][$all_tickets->Departament]),
							"subject" => htmlEncode($all_tickets->Subject),
							"date" => date("d/m/Y - h:i a", $all_tickets->Date),
							"status" => $status
						);
					}
				}
				
				$GLOBALS['userpanel']['support_tickets']['auto_load_ticket'] = $_GET['showticket'] ? $_GET['showticket'] : $this->URLData[3];
				$GLOBALS['userpanel']['support_tickets']['list_tickets'] = array
				(
					"opened" => $tickets_opened,
					"progress" => $tickets_progress,
					"closed" => $tickets_closed
				);
				
				unset($tickets_opened);
				unset($tickets_progress);
				unset($tickets_closed);
					
				return $this->LoadPage("option_supportTickets_list", true);
			break;
			case "show" :
				$ticket_id = intval($_GET['id']);
				
				$this->DB->Arguments($ticket_id, USER_ACCOUNT);
				$this->DB->Query("SELECT * FROM dbo.CTM_Tickets WHERE Id = %d AND Account = '%s'", $get_ticket);
				
				if($this->DB->CountRows($get_ticket) < 1)
					return exit(showMessage(sprintf($this->lang->words['UserPanel']['SupportTickets']['ErrorMessage'], CoreVariables::ErrorsCode()->TicketNotFound), 2));
				
				$ticket = $this->DB->FetchObject($get_ticket);
				switch($_GET['do'])
				{
					case "show_annex" :
						if(!empty($ticket->Annex))
						{
							$filename = $this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['TICKET_ANNEX'].$ticket->Annex;
							
							if(preg_match("/\.([gif|jpg|jpeg|png])/i", substr($filename, strrpos($filename, "."))))
							{
								header("Location: ".$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['TICKET_ANNEX'].$ticket->Annex);
							}
							else
							{
								header("Content-type: text/plain");
								readfile($filename);
							}
						}
						exit();
					break;
					case "reply" :
						if(empty($_POST['ReplyMessage']))
						{
							exit(showMessage($this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Messages']['ReplyVoid'], 1));
						}
						else
						{
							$message = htmlEncode(nl2br(strip_tags($_POST['ReplyMessage'])));
							$insert_columns = array
							(
								"TicketID" => $ticket_id,
								"Author" => "%s",
								"Account" => "%s",
								"Date" => time(),
								"Message" => "%s"
							);
							
							
							$this->DB->Arguments($ticket->Character, USER_ACCOUNT, htmlEncode(nl2br(strip_tags($_POST['ReplyMessage']))));
							$this->DB->Insert("CTM_TicketReplies", $insert_columns);
							
							$this->DB->Arguments($ticket_id, USER_ACCOUNT);
							$this->DB->Update("CTM_Tickets", array("Status" => 2), "Id = %d AND Account = '%s'");
							
							exit("<script>CTM.AjaxLoad('?app=core&module=userpanel&option=supportTickets&showticket=".$ticket_id."', 'showTicket');</script>");
						}
					break;
					case "close" :
						if($ticket->Status == 3)
						{
							exit(showMessage($this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Messages']['IsClosed'], 2));
						}
						else
						{
							$this->DB->Arguments($ticket_id, USER_ACCOUNT);
							$this->DB->Query("UPDATE dbo.CTM_Tickets SET Status = 3 WHERE Id = %d AND Account = '%s'");
							
							$string = "<script>changeTicketStatus(";
							$string .= "'".$ticket->Id."','";
							$string .= str_replace("'", "\'", htmlEncode($this->settings['USERPANEL']['SUPPORT']['TICKETS']['DEPARTAMENTS'][$ticket->Departament]))."',";
							$string .= "'".str_replace("'", "\'", $ticket->Subject)."',";
							$string .= "'".date("d/m/Y - H:i", $ticket->Date)."',";
							$string .= "'<span style=\'color: red;\'>";
							$string .= str_replace("'", "\'", $this->lang->words['UserPanel']['SupportTickets']['Status']['Closed']);
							$string .= "</span>',3);</script>".showMessage($this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Messages']['Closed'], 3);
							
							exit($string);
						}
					break;
				}
				
				switch($ticket->Status)
				{
					case 0 : 
						$status = "<span style='color: blue;'>".$this->lang->words['UserPanel']['SupportTickets']['Status']['Opened']."</span>";
					break;
					case 1 : 
						$status = "<span style='color: green;'>".$this->lang->words['UserPanel']['SupportTickets']['Status']['Responded']."</span>";
					break;
					case 2 : 
						$status = "<span style='color: orange;'>".$this->lang->words['UserPanel']['SupportTickets']['Status']['Progress']."</span>";
					break;
					case 3 : 
						$status = "<span style='color: red;'>".$this->lang->words['UserPanel']['SupportTickets']['Status']['Closed']."</span>";
					break;
				}
				
				$this->DB->Arguments($ticket_id);
				$this->DB->Query("SELECT * FROM dbo.CTM_TicketReplies WHERE TicketID = %d ORDER BY Id DESC", $get_replies);
				$replies = array();
				
				if($this->DB->CountRows($get_replies) > 0)
				{
					while($_reply = $this->DB->FetchObject($get_replies))
					{
						$replies[] = array
						(
							"author" => $_reply->Author,
							"date" => date("d/m/Y - h:i a", $_reply->Date),
							"message" => htmlDecode($_reply->Message)
						);
					}
				}
				
				$GLOBALS['userpanel']['support_tickets']['show_ticket'] = array
				(
					"id" => $ticket_id,
					"departament" => htmlEncode($this->settings['USERPANEL']['SUPPORT']['TICKETS']['DEPARTAMENTS'][$ticket->Departament]),
					"subject" => htmlDecode($ticket->Subject),
					"character" => $ticket->Character,
					"status" => $status,
					"date" => date("d/m/Y - h:i a", $ticket->Date),
					"message" => htmlDecode($ticket->Text),
					"_replies" => $replies,
					"_opened" => $ticket->Status < 3
				);
				
				if(strlen($ticket->Annex) > 1)
				{
					$GLOBALS['userpanel']['support_tickets']['show_ticket']['annex'] = array
					(
						"link" => "?app=core&amp;module=userpanel&amp;option=supportTickets&amp;section=show&amp;id=".$ticket_id."&amp;do=show_annex",
						"name" => $ticket->Annex
					);
				}
				
				$this->lang->setArguments("UserPanel,SupportTickets,ShowTicket,Title", "#".$ticket_id);
				return $this->LoadPage("option_supportTickets_show", true);
			break;
			case "open" :
				$departament = !is_null($_GET['departament']) ? $_GET['departament'] : $this->URLData[3];
				
				if(is_null($departament) || !array_key_exists($departament, $this->settings['USERPANEL']['SUPPORT']['TICKETS']['DEPARTAMENTS']))
				{
					if($_GET['write'] == true)
						exit(showMessage($this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['SelectDepartament'], 2));
						
					return $this->LoadPage("option_supportTickets_open", true);
				}
				else
				{
					if($_GET['write'] == true)
					{
						$error = $this->LoadClass("Error", "class_sources");
						
						if(empty($_POST['Subject']))
							$error->addError($this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['SubjectVoid'], 0);
						if(empty($_POST['Character']))
							$error->addError($this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['SelectCharacter'], 0);
						if(empty($_POST['Text']))
							$error->addError($this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['MessageVoid'], 0);
							
						if($error->count[0] > 0)
						{
							$_error = "<strong>".$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['VoidMessage']."<strong><br />";
							exit(showMessage($_error."<br />".$error->showError(0), 1));
						}
						else
						{
							if($this->settings['USERPANEL']['SUPPORT']['TICKETS']['LIMIT_OPEN'] > 0)
							{
								$this->DB->Arguments(USER_ACCOUNT);
								$this->DB->Query("SELECT 1 FROM dbo.CTM_Tickets WHERE Account = '%s' AND Status < 3");
								
								if($this->DB->CountRows() >= $this->settings['USERPANEL']['SUPPORT']['TICKETS']['LIMIT_OPEN'])
								{
									exit(showMessage($this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['LimitReached'], 2));
								}
							}
							
							$current_id = $this->DB->Query("SELECT Id FROM dbo.CTM_Tickets ORDER BY Id DESC");
							$current_id = $this->DB->FetchRow($current_id);
							$current_id = strlen($current_id[0]) < 1 ? 0 : $current_id[0];
							
							$protocol = date("Y").str_pad($current_id, 6, "1", STR_PAD_LEFT);
							
							if($_POST['u_sendFile'] == 1)
							{
								if($_POST['u_ready'] == 1)
								{
									$size = $this->settings['WEBDATA']['UPLOADS']['FILESIZE']['TICKET_ANNEX'];
									$dir = CTM_ROOT_PATH.$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['TICKET_ANNEX'];

									Uploadify::set("Filedata", $size, array("gif", "jpg", "jpeg", "png", "txt", "log"), $protocol, $dir, $session);
									exit("<script>startUpload('{$protocol}', '{$session}');</script>");
								}
							}
							
							if($_POST['u_sendFile'] == 1)
							{
								$data = unserialize(base64_decode($_POST['u_fileUploaded']));
								$annex = $data['parsed_file_name'];
								
								if(!$data)
								{
									exit(showMessage($this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['AnnexError'], 2));
								}
								elseif($data['error_no'] == 2)
								{
									$this->lang->setArguments("UserPanel,SupportTickets,OpenTicket,Messages,ErrorFormat", "<b>JPEG</b>, <b>GIF</b>, <b>PNG</b>, <b>TXT/LOG</b>");
									exit(showMessage($this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['ErrorFormat'], 2));
								}
								elseif($data['error_no'] == 3)
								{
									$this->lang->setArguments("UserPanel,ChangeAvatar,Messages,ErrorSize", "<b>".$data['max_file_size']."</b>");
									exit(showMessage($this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['ErrorSize'], 2));
								}
								elseif($data['error_no'] != 0)
								{
									exit(showMessage($this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['AnnexError'], 2));
								}
							}
							
							$columns_insert = array
							(
								"Account" => USER_ACCOUNT,
								"Character" => $_POST['Character'],
								"Protocol" => $protocol,
								"Status" => 0,
								"Subject" => htmlEncode($_POST['Subject']),
								"Departament" => intval($_GET['departament']),
								"Date" => time(),
								"Text" => htmlEncode(nl2br(strip_tags($_POST['Text']))),
								"Annex" => $annex
							);
							
							//$this->DB->ForceDataType("Protocol", "integer");
							$this->DB->ForceDataType("Status", "integer");
							$this->DB->ForceDataType("Departament", "integer");
							$this->DB->ForceDataType("Date", "integer");
							$this->DB->ForceDataType("Annex", empty($annex) ? "null" : "string");
							$this->DB->Insert("CTM_Tickets", $columns_insert);
						
							$this->WriteLog(array
							(
								"option" => "Support Tickets",
								"character" => false,
								"data" => array
								(
									"Protocol: ".$protocol,
									"Subject: ".strip_tags($_POST['Subject']),
									"Departament: ".$this->settings['USERPANEL']['SUPPORT']['TICKETS']['DEPARTAMENTS'][intval($_GET['departament'])],
									"Character: ".$_POST['Character'],
									"Annex: ".(!empty($annex) ? $annex : "None")
								),
							));
							
							exit(showMessage(sprintf($this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['Success'], $protocol), 3));
						}
					}

					$GLOBALS['userpanel']['support_tickets']['open_ticket']['departament'] = !is_null($_GET['departament']) ? $_GET['departament'] : $this->URLData[3];
					$GLOBALS['userpanel']['support_tickets']['open_ticket']['characters'] = array();

					$this->DB->Arguments(USER_ACCOUNT);
					$this->DB->Query("SELECT Name FROM ".MUGEN_CORE.".dbo.Character WHERE AccountID = '%s'", $find_characters_q);

					if($this->DB->CountRows($find_characters_q) > 0)
					{
						while($find_characters = $this->DB->FetchObject($find_characters_q))
						{
							$GLOBALS['userpanel']['support_tickets']['open_ticket']['characters'][] = $find_characters->Name;
						}
					}
					
					return $this->LoadPage("option_supportTickets_open_form", true);
				}
			break;
			default :
				if($_GET['showticket'])
					$GLOBALS['userpanel']['support_tickets']['auto_load_ticket'] = $_GET['showticket'];
				elseif(strstr($this->URLData[2], "showticket-"))
					$GLOBALS['userpanel']['support_tickets']['auto_load_ticket'] = str_replace("showticket-", NULL, $this->URLData[2]);
			break;
		}
	}
}