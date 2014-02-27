<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Notices Pages - View
 * Last Update: 09/05/2012 - 14:18h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Notices_Ajax extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		switch($_GET['load'])
		{
			case "commentNotice" :
				$this->loadCommentNotice();
			break;
			case "loadComments" :
				$this->loadNoticeComments();
			break;
		}
	}
	/**
	 *	Load Comment Notice
	 *
	 *	@return	void
	*/
	private function loadCommentNotice()
	{
		if(SESSION_USER_LOGGED == false)
			exit(showMessage($this->lang->words['NoticeAjax']['CommentNotice']['Messages']['NotLogged'], 2));
		else
		{
			$this->DB->Arguments($_GET['id']);
			$findSwitchQ = $this->DB->Select("CommentSwitch", "CTM_Notices", "Id = %d");
			$findSwitchR = $this->DB->CountRows($findSwitchQ);
			$findSwitch = $this->DB->FetchRow($findSwitchQ);
		
			if($findSwitchR < 1)
				exit(showMessage($this->lang->words['NoticeAjax']['CommentNotice']['Messages']['NotExists'], 2));
			elseif($findSwitch[0] == 0)
				exit(showMessage($this->lang->words['NoticeAjax']['CommentNotice']['Messages']['Disabled'], 2));
			elseif(empty($_POST['Character']))
				exit(showMessage($this->lang->words['NoticeAjax']['CommentNotice']['Messages']['SelectChar'], 1));
			elseif(empty($_POST['Text']))
				exit(showMessage($this->lang->words['NoticeAjax']['CommentNotice']['Messages']['SetComment'], 1));
			else
			{
				$insertData = array
				(
					"NoticeID" => "%d",
					"Account" => "%s",
					"Author" => "%s",
					"Date" => "%d",
					"Text" => "%s"
				);
				
				$this->DB->Arguments(intval($_GET['id']), USER_ACCOUNT, $_POST['Character'], time(), htmlEncode($_POST['Text']));
				$this->DB->Insert("CTM_NoticeComments", $insertData);
				
				$string = "<script>CTM.AjaxLoad('?app=core&module=notices&load=loadComments&id=".$_GET['id']."','noticeComments');</script>";
				$string .= showMessage($this->lang->words['NoticeAjax']['CommentNotice']['Messages']['Success'], 3);
				exit($string);
			}
		}
	}
	/**
	 *	Load Notice Comments
	 *
	 *	@return	void
	*/
	private function loadNoticeComments()
	{
		$GLOBALS['ajax_notice_comments'] = array();
		$queryString = "SELECT CTM_NoticeComments.*, ".MUGEN_CORE.".dbo.Character.".COLUMN_CHARIMAGE." FROM dbo.CTM_NoticeComments ";
		$queryString .= "JOIN ".MUGEN_CORE.".dbo.Character ON (".MUGEN_CORE.".dbo.Character.Name = CTM_NoticeComments.Author)";
		$queryString .= " WHERE NoticeID = %d ORDER BY Id DESC";
		
		$this->DB->Arguments($_GET['id']);
		$this->DB->Query($queryString, $findCommentsQ);
		
		if($this->DB->CountRows($findCommentsQ) > 0)
		{
			while($comment = $this->DB->FetchArray($findCommentsQ))
			{
				$GLOBALS['ajax_notice_comments'][] = array
				(
					"author" => $comment['Author'],
					"image" => self::instance()->functions->GetCharImage($comment[COLUMN_CHARIMAGE]),
					"date" => date("d/m/Y - h:i a", $comment['Date']),
					"text" => nl2br($comment['Text'])
				);
			}
		}
		
		$this->output->loadSkinCache("notices", "ajax_load_comments");
		$this->output->noSetCache(true);
	}
}