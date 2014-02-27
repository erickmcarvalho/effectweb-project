<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Effect Web: Main Control - Polls
 * Last Update: 14/09/2012 - 13:01h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Admin_Main_Polls extends CTM_EffectWeb_Admin_Main
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		switch($_GET['index'])
		{
			case "addPoll" :
				$this->loadAddPoll();
				$this->output->setContent("polls_addPoll");
			break;
			case "editPoll" :
				$this->loadEditPoll();
				$this->output->setContent("polls_editPoll");
			break;
			default :
				$this->loadManagePolls();
				$this->output->setContent("polls_managePolls");
			break;
		}
	}
	/**
	 *	Private: Check Poll Exists
	 *	Check if the poll exists
	 *
	 *	@param	integer	Notice ID
	 *	@return	boolean
	*/
	private function loadCheckPoll($id)
	{
		if(empty($id))
			return false;
		
		$this->DB->Query("SELECT 1 FROM dbo.CTM_Polls WHERE Id = ".intval($id), $check_poll_exists_query);
		
		return $this->DB->CountRows($check_poll_exists_query) > 0;
	}
	/**
	 *	Private: Check Poll Answer Exists
	 *	Check if the answer of poll exists
	 *
	 *	@param	integer	Answer ID
	 *	@param	integer	Poll ID
	 *	@return	boolean
	*/
	private function loadCheckAnswer($id, $poll = -1)
	{
		if(empty($id))
			return false;
		
		$poll_where = $poll != -1 ? " AND PollID = ".intval($poll) : NULL;
		$this->DB->Query("SELECT 1 FROM dbo.CTM_PollAnswers WHERE Id = ".intval($id).$poll_where, $check_answer_exists_query);
		
		return $this->DB->CountRows($check_answer_exists_query) > 0;
	}
	/**
	 *	Private: Add Poll
	 *	Add a new poll in Effect Web
	 *
	 *	@return	void
	*/
	private function loadAddPoll()
	{
		if($_GET['write'] == true)
		{
			$date = explode("/", $_POST['expiration']);
			
			if(empty($_POST['fieldQuestion']))
			{
				$GLOBALS['result_command'] = $this->lang->words['EWMain']['Polls']['AddPoll']['Messages']['FieldsVoid'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
			}
			elseif(empty($_POST['answerCount']) || $_POST['answerCount'] < 2)
			{
				$GLOBALS['result_command'] = $this->lang->words['EWMain']['Polls']['AddPoll']['Messages']['AnswerError'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
			}
			elseif(count($date) <> 3)
			{
				$GLOBALS['result_command'] = $this->lang->words['EWMain']['Polls']['AddPoll']['Messages']['DateError'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
			}
			else
			{
				$expiration = mktime(23, 59, 59, $date[0], $date[1], $date[2]); 
				$break = 0;
				
				for($i = 1; $i <= $_POST['answerCount']; $i++)
					if(empty($_POST['Answer_'.$i]))
						$break++;
					
				if($break > 0)
				{
					$GLOBALS['result_command'] = $this->lang->words['EWMain']['Polls']['AddPoll']['Messages']['FieldsVoid'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
				}
				else
				{
					
					$this->DB->Arguments(htmlEncode($_POST['fieldQuestion']), time(), $expiration, 0);
					
					$prepare = "DECLARE @id int;\n";
					$prepare .= "INSERT INTO dbo.CTM_Polls (Question,BeginDate,EndDate,Status) VALUES ";
					$prepare .= "('%s',%d,%d,%s);\n";
					$prepare .= "SELECT @id = @@IDENTITY;\n";
					
					for($i = 1; $i <= $_POST['answerCount']; $i++)
					{
						$this->DB->Arguments(htmlEncode($_POST['Answer_'.$i]));
						$prepare .= "INSERT INTO dbo.CTM_PollAnswers (PollID, Answer, Votes) VALUES (@id, '%s', 0);\n";
					}
					
					$this->DB->Query($prepare);
					
					$GLOBALS['result_command'] = $this->lang->words['EWMain']['Polls']['AddPoll']['Messages']['Success'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
				}
			}
		}
	}
	/**
	 *	Private: Manage Poll
	 *	Manage the polls from Effect Web
	 *
	 *	@return	void
	*/
	private function loadManagePolls()
	{
		if($_GET['do'] == "deletePolls")
		{
			$queryString = NULL;
			$count = 0;
			
			if(count($_POST) > 0 && is_null($_GET['id']))
			{
				foreach($_POST as $key => $value)
				{
					if(substr($key, 0, 6) == "poll__" && $value == 1)
					{
						$id = eregi_replace("[^0-9]", NULL, $key);
						
						if($this->loadCheckPoll($id) == true)
						{
							$queryString .= "DELETE FROM dbo.CTM_Polls WHERE Id = ".intval($id).";\n";
							$queryString .= "DELETE FROM dbo.CTM_PollAnswers WHERE PollID = ".intval($id).";\n";
							$queryString .= "DELETE FROM dbo.CTM_PollVotes WHERE PollID = ".intval($id).";\n";
							$queryString .= "--------------------------------------------------\n";
							$count++;
						}
					}
				}
			}
			elseif($_GET['id'])
			{	
				if($this->loadCheckPoll($_GET['id']) == true)
				{
					$count = 1;
					$queryString .= "DELETE FROM dbo.CTM_Polls WHERE Id = ".intval($_GET['id']).";\n";
					$queryString .= "DELETE FROM dbo.CTM_PollAnswers WHERE PollID = ".intval($_GET['id']).";\n";
					$queryString .= "DELETE FROM dbo.CTM_PollVotes WHERE PollID = ".intval($_GET['id']).";\n";
				}
			}
			
			if($count > 0)
			{
				$this->DB->Query($queryString);
					
				$GLOBALS['result_command'] = sprintf($this->lang->words['EWMain']['Polls']['ManagePolls']['Messages']['PollsDeleted'], $count);
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
			}
			else
			{
				$GLOBALS['result_command'] = $this->lang->words['EWMain']['Polls']['ManagePolls']['Messages']['SelectPoll'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
			}
		}
		
		$GLOBALS['poll_list'] = array();
		
		$find_all_polls_q = $this->DB->Select("Id,Question,BeginDate,EndDate,Status", "CTM_Polls", NULL, "Id DESC");
		
		if($this->DB->CountRows($find_all_polls_q) > 0)
		{
			while($find_all_polls = $this->DB->FetchArray($find_all_polls_q))
			{
				switch($find_all_polls['Status'])
				{
					case 0 : $status = "<span style=\"color: green;\">".$this->lang->words['Words']['Opened']."</span>"; break;
					case 1 : $status = "<span style=\"color: red;\">".$this->lang->words['Words']['Closed']."</span>"; break;
				}
				
				$GLOBALS['poll_list'][intval($find_all_polls['Id'])] = array
				(
					"question" => $find_all_polls['Question'],
					"begin_date" => date("d/m/Y", $find_all_polls['BeginDate']),
					"end_date" => date("d/m/Y", $find_all_polls['EndDate']),
					"status" => $status
				);
			}
		}
	}
	/**
	 *	Private: Edit Poll
	 *	Edit a poll from Effect Web
	 *
	 *	@return	void
	*/
	private function loadEditPoll()
	{
		$GLOBALS['poll_exists'] = $this->loadCheckPoll($_GET['id']);
		
		if($GLOBALS['poll_exists'] == true)
		{
			if($_GET['write'] == true)
			{
				$date = explode("/", $_POST['expiration']);
				
				if(empty($_POST['fieldQuestion']))
				{
					$GLOBALS['result_command'] = $this->lang->words['EWMain']['Polls']['EditPoll']['Messages']['FieldsVoid'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
				}
				elseif(empty($_POST['answerCount']) || $_POST['answerCount'] < 2)
				{
					$GLOBALS['result_command'] = $this->lang->words['EWMain']['Polls']['EditPoll']['Messages']['AnswerError'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
				}
				elseif(count($date) <> 3)
				{
					$GLOBALS['result_command'] = $this->lang->words['EWMain']['Polls']['EditPoll']['Messages']['DateError'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
				}
				else
				{
					$expiration = mktime(23, 59, 59, $date[0], $date[1], $date[2]); 
					$break = 0;
					
					for($i = 1; $i <= $_POST['answerCount']; $i++)
						if(empty($_POST['Answer_'.$i]) || $_POST['VotesAnswers_'.$i] == NULL)
							$break++;
						
					if($break > 0)
					{
						$GLOBALS['result_command'] = $this->lang->words['EWMain']['Polls']['EditPoll']['Messages']['FieldsVoid'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
					}
					else
					{
						$prepare = "UPDATE dbo.CTM_Polls SET Question = '%s', EndDate = %d, Status = %d WHERE Id = %d;\n";
						
						for($i = 1; $i <= $_POST['answerCount']; $i++)
						{
							if($i > $_POST['answerAfterCount'])
							{
								$poll_id = intval($_GET['id']);
								$answer = htmlEncode($_POST['Answer_'.$i]);
								$votes = (int)$_POST['VotesAnswers_'.$i];
								
								$prepare .= "INSERT INTO dbo.CTM_PollAnswers (PollID, Answer, Votes) VALUES ({$poll_id}, '{$answer}', {$votes});\n";
							}
							else
							{
								if($this->loadCheckAnswer($_POST['IdAnswer_'.$i], $_GET['id']) == true)
								{
									$answer_id = intval($_POST['IdAnswer_'.$i]);
									$poll_id = intval($_GET['id']);
									$answer = htmlEncode($_POST['Answer_'.$i]);
									$votes = (int)$_POST['VotesAnswers_'.$i];
									
									$prepare .= "UPDATE dbo.CTM_PollAnswers SET Answer = '{$answer}', Votes = {$votes} WHERE Id = {$answer_id} AND PollID = {$poll_id};\n";
								}
							}
						}
						
						$this->DB->Arguments(htmlEncode($_POST['fieldQuestion']), $expiration, $_POST['PollStatus'], intval($_GET['id']));
						$this->DB->Query($prepare);
						
						$GLOBALS['result_command'] = $this->lang->words['EWMain']['Polls']['EditPoll']['Messages']['Success'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
					}
				}
			}
		
			$find_poll_q = $this->DB->Query("SELECT * FROM dbo.CTM_Polls WHERE Id = ".intval($_GET['id']));
			$find_poll = $this->DB->FetchObject($find_poll_q);
			
			$find_answers_q = $this->DB->Query("SELECT * FROM dbo.CTM_PollAnswers WHERE PollID = ".intval($_GET['id']));
			$find_answers_c = $this->DB->CountRows($find_answers_q);
			
			$answers = array();
			$i = 1;
			
			while($find_answers = $this->DB->FetchObject($find_answers_q))
			{
				$answers[$i++] = array
				(
					"id" => intval($find_answers->Id),
					"answer" => $find_answers->Answer,
					"votes" => intval($find_answers->Votes)
				);
			}
			
			$GLOBALS['edit_poll'] = array
			(
				"answer_after_count" => intval($find_answers_c),
				"question" => $find_poll->Question,
				"end_date" => date("m/d/Y", $find_poll->EndDate),
				"status" => intval($find_poll->Status),
				"answers" => $answers
			);
			
			unset($answers, $i);
			
			$this->lang->setArguments("EWMain,Polls,EditPoll,Title", $_GET['id']);
		}
	}
}