<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - Block Install
 * Last Update: 09/06/2013 - 06:24h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Update_BlockUpdate extends CTM_Command
{
	/**
	 *	Class construct
	 *
	 *	@return	void
	*/
	public function __construct()
	{
		$this->registry();
	}
	/**
	 *	Run Section
	 *
	 *	@return	void
	*/
	public function run()
	{
		global $installation, $versionHistory;

		$GLOBALS['hide_button'] = true;
		$GLOBALS['installation_info'] = array
		(
			"current_version" => $versionHistory[str_pad($installation['current_version'], 5, 0, STR_PAD_RIGHT)]['show'],
			"old_version" => $versionHistory[str_pad($installation['old_version'], 5, 0, STR_PAD_RIGHT)]['show'],
			"last_installation" => date("d/m/Y - H:i:s", $installation['last_installation']),
			"last_update" => date("d/m/Y - H:i:s", $installation['last_update'])
		);
	}
	/**
	 *	Section Content
	 *
	 *	@param	&string	Content variable
	 *	@return	string
	*/
	public function content(&$content = NULL)
	{
		$this->lang->loadLanguageFile("block_update");
		$this->output->setTitles($this->lang->words['BlockUpdate']['HTML'], $this->lang->words['BlockUpdate']['Step']);
		return $content = array("type" => "section", "section" => "block_update");
	}
}

$section = new Update_BlockUpdate();