<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Ajax Module - Web Poll
 * Last Update: 03/05/2012 - 16:30h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Ajax_WebPoll extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		$this->lang->loadLanguageFile("ajax");
		
		switch($_GET['cmd'])
		{
			case "result" :
				$this->loadPollResults((integer)$_GET['id']);
				$this->output->loadSkinCache("ajax", "WebPoll_Result");
				$this->output->noSetCache(true);
			break;
			case "vote" :
				if(!empty($_POST['PollAnswer']))
					$this->loadVotePoll((integer)$_GET['id'], (integer)$_POST['PollAnswer']);
				else
					exit(showMessage($this->lang->words['Ajax']['Poll']['Messages']['Select'], -1));
			break;
			case "loadPolls" :
				$this->loadAllPolls();
				$this->output->loadSkinCache("ajax", "WebPoll_All");
				$this->output->noSetCache(true);
			break;
			default :
				$this->loadWebPoll(empty($_GET['id']) ? 0 : $_GET['id']);
				$this->output->loadSkinCache("ajax", "WebPoll_Show");
				$this->output->noSetCache(true);
			break;
		}
	}
	/**
	 *	Check Poll Exists
	 *
	 *	@param	integer	Poll Id
	 *	@return	boolean
	*/
	private static function checkPollExists($id = 0)
	{
		self::DB()->Arguments($id);
		$query = self::DB()->Query("SELECT Id FROM dbo.CTM_Polls".($id > 0 ? " WHERE Id = %d" : NULL));
		
		return self::DB()->CountRows($query) > 0;
	}
	/**
	 *	Check Answer Exists
	 *
	 *	@param	integer	Answer Id
	 *	@return	void
	*/
	private static function checkAnswerExists($id = 0)
	{
		self::DB()->Arguments($id);
		$query = self::DB()->Query("SELECT Id FROM dbo.CTM_PollAnswers WHERE Id = %d");
		
		return self::DB()->CountRows($query) > 0;
	}
	/**
	 *	Check User Vote in Poll
	 *
	 *	@param	integer	Poll Id
	 *	@param	string	User Account
	 *	@return	boolean
	*/
	private static function checkUserVote($id = 0, $account = NULL)
	{
		self::DB()->Arguments($id, $account);
		$query = self::DB()->Query("SELECT Id FROM dbo.CTM_PollVotes WHERE PollID = %d AND Account = '%s'");
		
		return self::DB()->CountRows($query) > 0;
	}
	/**
	 *	Load: Show Poll
	 *
	 *	@param	integer	Specifies Poll Id
	 *	@return	void
	*/
	private function loadWebPoll($specifies = 0)
	{
		if($specifies > 0) 
			$load = " WHERE Id = %d";
		else
			$load = " ORDER BY Id DESC";
		
		self::DB()->Arguments($specifies);
		$resource = self::DB()->Query("SELECT Id,Question,EndDate FROM dbo.CTM_Polls".$load);
		
		if(self::DB()->CountRows($resource) > 0)
		{
			$ajaxPoll = self::DB()->FetchObject($resource);
			
			self::loadCheckPollExpiration($specifies > 0 ? $specifies : $ajaxPoll->Id, $ajaxPoll->EndDate);
			
			$findAnswers = self::DB()->Query("SELECT Id,Answer,Votes FROM dbo.CTM_PollAnswers WHERE PollId = '".$ajaxPoll->Id."'");
			$answers = array();
			
			while($answer = self::DB()->FetchObject($findAnswers))
				$answers[$answer->Id] = $answer->Answer;
			
			$GLOBALS['ajax_poll'] = array
			(
				"id" => $ajaxPoll->Id,
				"question" => $ajaxPoll->Question,
				"answers" => $answers
			);
		}
		else
		{
			if($specifies > 0)
				exit(showMessage($this->lang->words['Ajax']['Poll']['Messages']['NotExists']['Poll'], -2));
			else
				exit(showMessage($this->lang->words['Ajax']['Poll']['Messages']['NonePoll'], -4));
		}
	}
	/**
	 *	Load: Poll Results
	 *
	 *	@param	integer	Poll Id
	 *	@param	string	Show Message
	 *	@return	void
	*/
	private function loadPollResults($id = 0, $message = NULL)
	{
		$queryString = "SELECT MAX(CTM_Polls.Status) AS Status, MAX(CTM_Polls.BeginDate) AS BeginDate, MAX(CTM_Polls.EndDate) AS EndDate,";
		$queryString .= " SUM(CTM_PollAnswers.Votes) AS TotalVotes";
		$queryString .= " FROM dbo.CTM_Polls JOIN dbo.CTM_PollAnswers ON (CTM_PollAnswers.PollId = CTM_Polls.Id) WHERE CTM_Polls.Id = %d";
		
		self::DB()->Arguments($id);
		self::DB()->Query($queryString, $resource);
			
		if(self::DB()->CountRows($resource) > 0)
		{
			$ajaxPoll = self::DB()->FetchObject($resource);
			
			switch($ajaxPoll->Status)
			{
				case 0 : $status = "<strong style=\"color: green;\">".$this->lang->words['Words']['Opened']."</strong>"; break;
				case 1 : $status = "<strong style=\"color: red;\">".$this->lang->words['Words']['Closed']."</strong>"; break;
			}
			
			self::DB()->Arguments($id);
			$findAnswers = self::DB()->Query("SELECT * FROM dbo.CTM_PollAnswers WHERE PollId = %d");
			$answers = array();
			
			while($answer = self::DB()->FetchObject($findAnswers))
			{
				$answers[$answer->Id] = array
				(
					"answer" => $answer->Answer,
					"votes" => number_format($answer->Votes, 0, false, "."),
					"result" => $ajaxPoll->TotalVotes > 0 ? str_replace(".0", NULL, number_format($answer->Votes * 100 / $ajaxPoll->TotalVotes)) : 0
				);
			}
		
			$GLOBALS['ajax_poll_result'] = array
			(
				"begin_date" => date("d/m/Y - H:i", $ajaxPoll->BeginDate),
				"end_date" => date("d/m/Y - H:i", $ajaxPoll->EndDate),
				"total_votes" => number_format($ajaxPoll->TotalVotes, 0, false, "."),
				"status" => $status,
				"message" => $message,
				"answers" => $answers
				
			);
		}
		else
		{
			exit(showMessage($this->lang->words['Ajax']['Poll']['Messages']['NotExists']['Poll'], -2));
		}
	}
	/**
	 *	Load: Vote in Poll
	 *
	 *	@param	integer	Poll Id
	 *	@param	integer	Answer Id
	 *	@return	void
	*/
	private function loadVotePoll($id = 0, $answer = 0)
	{
		if(!self::checkPollExists($id)) exit(showMessage($this->lang->words['Ajax']['Poll']['Messages']['NotExists']['Poll'], -2));
		if(!self::checkAnswerExists($answer)) exit(showMessage($this->lang->words['Ajax']['Poll']['Messages']['NotExists']['Answer'], -2));
		if(!SESSION_USER_LOGGED) exit(showMessage($this->lang->words['Ajax']['Poll']['Messages']['Logged'], -2));
		if(self::checkUserVote($id, USER_ACCOUNT)) exit(showMessage($this->lang->words['Ajax']['Poll']['Messages']['Voted'], -2));
		
		self::DB()->Arguments($id);
		$resource = self::DB()->Query("SELECT Status FROM dbo.CTM_Polls WHERE Id = %d");
		$status = self::DB()->FetchRow($resource);
		
		if($status[0] == 1) exit(showMessage($this->lang->words['Ajax']['Poll']['Messages']['Closed'], -2));
		
		self::DB()->Arguments(USER_ACCOUNT, $id, $answer);
		self::DB()->Insert("CTM_PollVotes", array("Account" => "%s", "PollId" => "%d", "AnswerId" => "%d"));
		
		self::DB()->Arguments($answer, $id);
		self::DB()->ForceDataType("Votes", "integer");
		self::DB()->Update("CTM_PollAnswers", array("Votes" => "plus:1"), "Id = %d AND PollId = %d");
		
		$this->loadPollResults($id, showMessage($this->lang->words['Ajax']['Poll']['Messages']['Success'], -3));
		$this->output->loadSkinCache("ajax", "WebPoll_Result");
		$this->output->noSetCache(true);
	}
	/**
	 *	Check Poll Expiration
	 *
	 *	@param	integer	Poll Id
	 *	@param	integer	End Date [Time Stamp]
	 *	@return	void
	*/
	private function loadCheckPollExpiration($id = 0, $endDate = 0)
	{
		if($id > 0)
		{
			if((time() - $endDate) >= 18000)
			{
				self::DB()->Arguments($id);
				self::DB()->Query("UPDATE dbo.CTM_Polls SET Status = 1 WHERE Id = %d");
			}
		}
	}
	/**
	 *	Load: All Polls
	 *
	 *	@return	void
	*/
	private function loadAllPolls()
	{
		$query = self::DB()->Query("SELECT Question,Id FROM dbo.CTM_Polls ORDER BY Id DESC");
		$GLOBALS['ajax_all_polls'] = array();
		
		if(self::DB()->CountRows($query) > 0)
			while($ajaxPolls = self::DB()->FetchRow($query))
				$GLOBALS['ajax_all_polls'][$ajaxPolls[1]] = $ajaxPolls[0];
		else
			exit(showMessage($this->lang->words['Ajax']['Poll']['Messages']['NonePoll'], -0));
	}
}