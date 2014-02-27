<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Notices Pages
 * Last Update: 09/06/2013 - 17:35h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Notices extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->lang->loadLanguageFile("notices");
		
		if($_GET['view'] || strstr($this->URLData[1], "view") || strstr($this->URLData[1], "view"))
			$this->loadViewNotice();
		elseif($_GET['load'])
			$this->loadAjaxNotice();
		else
		{
			$this->loadAllNotices();
			$this->output->loadSkinCache("notices", "all_notices");
		}
	}
	/**
	 *	Load View Notice
	 *
	 *	@return	void
	*/
	private function loadViewNotice()
	{
		if((int)$_GET['view']) 
			$id = (int)$_GET['view'];
		else 
			$id = (int)$this->URLData[2];
		
		require_once(THIS_APPLICATION_PATH."modules/notices/view.php");
		$viewNotice = new Notices_View();
		$viewNotice->registry();
		$viewNotice->initSection($id);
	}
	/**
	 *	Load Ajax Notice
	 *
	 *	@return	void
	*/
	private function loadAjaxNotice()
	{
		require_once(THIS_APPLICATION_PATH."modules/notices/ajax.php");
		$ajaxNotices = new Notices_Ajax();
		$ajaxNotices->registry();
		$ajaxNotices->initSection();
	}
	/**
	 *	Load All Notices
	 *
	 *	@return	void
	*/
	private function loadAllNotices()
	{
		$query = $this->DB->Query("SELECT Title,Date,Id FROM dbo.CTM_Notices ORDER BY Id DESC");
		$GLOBALS['all_notices'] = array();
		
		if($this->DB->CountRows($query) > 0)
		{
			while($data = $this->DB->FetchArray($query))
			{
				$GLOBALS['all_notices'][$data['Id']] = array
				(
					"title" => htmlDecode($data['Title'], true),
					"date" => date("d/m/Y - h:i a", $data['Date'])
				);
			}
		}
	}
}