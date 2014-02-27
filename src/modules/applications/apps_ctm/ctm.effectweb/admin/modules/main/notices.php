<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Effect Web: Main Control - Notices
 * Last Update: 14/09/2012 - 12:25h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Admin_Main_Notices extends CTM_EffectWeb_Admin_Main
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
			case "addNotice" :
				$this->loadAddNotice();
				$this->output->setContent("notices_addNotice");
			break;
			case "editNotice" :
				$this->loadEditNotice();
				$this->output->setContent("notices_editNotice");
			break;
			default :
				$this->loadManageNotices();
				$this->output->setContent("notices_manageNotices");
			break;
		}
	}
	/**
	 *	Private: Check Notice Exists
	 *	Check if the notice exists
	 *
	 *	@param	integer	Notice ID
	 *	@param	string	Account name
	 *	@return	boolean
	*/
	private function loadCheckNotice($id, $account = USER_ACCOUNT)
	{
		if(empty($id))
			return false;
		
		if($account == USER_ACCOUNT)
			$from_account = $this->CheckPermissionItem("notices_manage_all") == false ? " AND Account = '%s'" : NULL;
		elseif(!empty($account))
			$from_account = " AND Account = '%s'";
			
		$this->DB->Arguments(USER_ACCOUNT);
		$this->DB->Query("SELECT 1 FROM dbo.CTM_Notices WHERE Id = ".intval($id).$from_account, $check_notice_exists_query);
		
		return $this->DB->CountRows($check_notice_exists_query) > 0;
	}
	/**
	 *	Private: Add Notice
	 *	Add a new notice in Effect Web
	 *
	 *	@return	void
	*/
	private function loadAddNotice()
	{
		if($_GET['write'] == true)
		{
			if(empty($_POST['fieldTitle']))
			{
				$GLOBALS['result_command'] = $this->lang->words['EWMain']['Notices']['AddNotice']['Messages']['TitleVoid'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
			}
			elseif(empty($_POST['fieldText']))
			{
				$GLOBALS['result_command'] = $this->lang->words['EWMain']['Notices']['AddNotice']['Messages']['TextVoid'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
			}
			else
			{
				$insert_columns = array
				(
					"Title" => htmlEncode($_POST['fieldTitle']),
					"Date" => time(),
					"Account" => USER_ACCOUNT,
					"Text" => htmlEncode($_POST['fieldText']),
					"CommentSwitch" => $_POST['enableComments'] == true ? 1 : 0
				);
				
				$this->DB->Insert("CTM_Notices", $insert_columns);
				
				$GLOBALS['result_command'] = $this->lang->words['EWMain']['Notices']['AddNotice']['Messages']['Success'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
			}
		}
	}
	/**
	 *	Private: Manage Notices
	 *	Manage the notices from member (or all) from Effect Web
	 *
	 *	@return	void
	*/
	private function loadManageNotices()
	{
		if($_GET['do'] == "deleteNotices")
		{
			$queryString = NULL;
			$count = 0;
			
			if(count($_POST) > 0 && is_null($_GET['id']))
			{
				foreach($_POST as $key => $value)
				{
					if(substr($key, 0, 8) == "notice__" && $value == 1)
					{
						$id = eregi_replace("[^0-9]", NULL, $key);
						
						if($this->loadCheckNotice($id) == true)
						{
							$queryString .= "DELETE FROM dbo.CTM_Notices WHERE Id = ".intval($id).";\n";
							$queryString .= "DELETE FROM dbo.CTM_NoticeComments WHERE NoticeID = ".intval($id).";\n";
							$queryString .= "--------------------------------------------------------------\n";
							$count++;
						}
					}
				}
			}
			elseif($_GET['id'])
			{	
				if($this->loadCheckNotice($_GET['id']) == true)
				{
					$count = 1;
					$queryString = "DELETE FROM dbo.CTM_Notices WHERE Id = ".intval($_GET['id']).";\n";
					$queryString .= "DELETE FROM dbo.CTM_NoticeComments WHERE NoticeID = ".intval($_GET['id']).";\n";
				}
			}
			
			if($count > 0)
			{
				$this->DB->Query($queryString);
					
				$GLOBALS['result_command'] = sprintf($this->lang->words['EWMain']['Notices']['ManageNotices']['Messages']['NoticesDeleted'], $count);
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
			}
			else
			{
				$GLOBALS['result_command'] = $this->lang->words['EWMain']['Notices']['ManageNotices']['Messages']['SelectNotice'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
			}
		}
		
		$queryString = "SELECT CTM_Notices.Id AS Id, CTM_Notices.Title AS Title, MAX(CTM_Notices.[Date]) AS [Date], CTM_Notices.Account AS Account";
		$queryString .= ", MAX(CTM_Notices.CommentSwitch) AS CommentSwitch, COUNT(CTM_NoticeComments.Id) AS CommentCount FROM dbo.CTM_Notices";
		$queryString .= " LEFT JOIN CTM_NoticeComments ON (CTM_NoticeComments.NoticeID = CTM_Notices.Id)";
		$queryString .= (($all = $this->CheckPermissionItem("notices_manage_all")) == false ? " WHERE dbo.CTM_Notices.Account = '%s'" : NULL);
		$queryString .= " GROUP BY CTM_Notices.Id, CTM_Notices.Title, CTM_Notices.Account";
		
		$this->DB->Arguments(USER_ACCOUNT);
		$this->DB->Query($queryString, $query_result);
		
		$GLOBALS['notice_list'] = array();
		$GLOBALS['manage_all_notices'] = $all;
		
		if($this->DB->CountRows($query_result) > 0)
		{
			while($row = $this->DB->FetchObject($query_result))
			{
				$GLOBALS['notice_list'][$row->Id] = array
				(
					"title" => $row->Title,
					"post_date" => date("d/m/Y - h:i a"),
					"comments_enabled" => (boolean)$row->CommentSwitch,
					"comments_count" => number_format($row->CommentCount, 0, false, "."),
				);
				
				if($all == true)
					$GLOBALS['notice_list'][$row->Id]['account'] = $row->Account;
			}
		}
	}
	/**
	 *	Private: Edit Notice
	 *	Edit the notice from Effect Web
	 *
	 *	@return	void
	*/
	private function loadEditNotice()
	{
		$GLOBALS['notice_exists'] = $this->loadCheckNotice($_GET['id']);
		
		if($GLOBALS['notice_exists'] == true)
		{
			if($_GET['write'] == true)
			{
				if(empty($_POST['fieldTitle']))
				{
					$GLOBALS['result_command'] = $this->lang->words['EWMain']['Notices']['EditNotice']['Messages']['TitleVoid'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
				}
				elseif(empty($_POST['fieldText']))
				{
					$GLOBALS['result_command'] = $this->lang->words['EWMain']['Notices']['EditNotice']['Messages']['TextVoid'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
				}
				else
				{
					$update_columns = array
					(
						"Title" => htmlEncode($_POST['fieldTitle']),
						"Text" => htmlEncode($_POST['fieldText']),
						"CommentSwitch" => $_POST['enableComments'] == true ? 1 : 0
					);
					
					if($_POST['refreshDate'] == true)
						$update_columns['Date'] = time();
					
					$this->DB->Update("CTM_Notices", $update_columns, "Id = ".intval($_GET['id']));
					
					$GLOBALS['result_command'] = $this->lang->words['EWMain']['Notices']['EditNotice']['Messages']['Success'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
				}
			}
			
			$select_notice = $this->DB->Select("*", "CTM_Notices", "Id = ".intval($_GET['id']));
			$fetch_notice = $this->DB->FetchObject($select_notice);
			
			$GLOBALS['notice_data'] = array
			(
				"id" => intval($_GET['id']),
				"title" => str_replace(array("<", ">"), array("&lt;", "&gt;"), htmlDecode($fetch_notice->Title)),
				"date" => date("d/m/Y", $fetch_notice->Date),
				"text" => str_replace(array("<", ">"), array("&lt;", "&gt;"), htmlDecode($fetch_notice->Text)),
				"comments_enabled" => $fetch_notice->CommentSwitch == 1
			);
			
			$this->lang->setArguments("EWMain,Notices,EditNotice,Title", $_GET['id']);
		}
	}
}