<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Notices Pages - View
 * Last Update: 09/06/2013 - 17:35h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Notices_View extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection($id = 0)
	{
		$queryString = "SELECT CTM_Notices.*, CTM_TeamMembers.Name, ".MUGEN_CORE.".dbo.Character.".COLUMN_CHARIMAGE."";
		$queryString .= " FROM dbo.CTM_Notices JOIN dbo.CTM_TeamMembers ON (CTM_TeamMembers.Account = CTM_Notices.Account)";
		$queryString .= " LEFT JOIN ".MUGEN_CORE.".dbo.Character ON (";
		$queryString .= MUGEN_CORE.".dbo.Character.Name = CTM_TeamMembers.Name) WHERE CTM_Notices.Id = %d";
		
		$this->DB->Arguments($id);
		$this->DB->Query($queryString, $query);
		
		if($this->DB->CountRows($query) < 1)
			return $this->output->showError($this->lang->words['ViewNotice']['Error']);
		
		$notice = $this->DB->FetchObject($query);
			
		$GLOBALS['view_notice'] = array
		(
			"id" => $id,
			"title" => htmlDecode($notice->Title, true),
			"author" => array("name" => $notice->Name, "image" => self::instance()->functions->GetCharImage($notice->{COLUMN_CHARIMAGE})),
			"date" => date("d/m/Y - h:i a", $notice->Date),
			"text" => htmlDecode($notice->Text, true),
			"comments_switch" => (bool)$notice->CommentSwitch
		);
		
		$this->lang->setTags("ViewNotice,Header", $GLOBALS['view_notice']['author']['name'], $GLOBALS['view_notice']['date']);
		$this->output->loadSkinCache("notices", "view_notice");
	}
}