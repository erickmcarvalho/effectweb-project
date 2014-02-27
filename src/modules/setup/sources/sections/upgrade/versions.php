<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - Versions Info
 * Last Update: 08/06/2013 - 17:23h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Update_Versions extends CTM_Command
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
		global $versionHistory, $installation;

		$this->lang->loadLanguageFile("versions");

		if($_GET['do'] == "check")
		{
			$this->session->StartSession($_POST['session']);
			$this->session->GetSession("sections", $session);

			$session['versions'] = true;

			$this->session->SetSession("sections", $session);
			$this->session->EndSession($_session);

			$this->nextSection($_session);
		}

		require_once(CTM_SETUP_PATH."sources/extensions/setup_versions_update.php");

		$versions_to_update = array();

		arsort($versionHistory);
		foreach($versionHistory as $version => $info)
		{
			if($version > $installation['current_version'])
			{
				$versions_to_update[$version] = $update_versions[$version];
				$versions_to_update[$version]['version'] = $versionHistory[$version]['show'];
			}
		}

		$GLOBALS['versions_to_update'] = $versions_to_update;
	}
	/**
	 *	Section Content
	 *
	 *	@param	&string	Content variable
	 *	@return	string
	*/
	public function content(&$content = NULL)
	{
		$this->output->setTitles($this->lang->words['Versions']['HTML'], $this->lang->words['Versions']['Step']);

		return $content = array("type" => "section", "section" => "versions");
	}
}

$section = new Update_Versions();