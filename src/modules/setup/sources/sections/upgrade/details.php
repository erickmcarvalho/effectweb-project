<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - Details
 * Last Update: 08/06/2013 - 17:23h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Update_Details extends CTM_Command
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

		$this->lang->loadLanguageFile("details");

		if($_GET['do'] == "check")
		{
			$this->session->StartSession($_POST['session']);
			$this->session->GetSession("sections", $session);

			$session['details'] = true;

			$this->session->SetSession("sections", $session);
			$this->session->EndSession($_session);

			$this->nextSection($_session);
		}

		require_once(CTM_SETUP_PATH."sources/extensions/setup_versions_update.php");
		$versions_to_update = array();

		foreach($versionHistory as $version => $info)
		{
			if($version > $installation['current_version'] && file_exists(CTM_SETUP_PATH."setup/updates/".$version."/xml/info_details.xml"))
			{
				$xml = CTM_FileManage::Lib('XML')->ParseXML(CTM_SETUP_PATH."setup/updates/".$version."/xml/info_details.xml");

				$versions_to_update[$version]['version'] = $versionHistory[$version]['show'];
				$versions_to_update[$version]['details'] = nl2br($xml->details);
			}
		}

		arsort($versions_to_update);
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
		$this->output->setTitles($this->lang->words['Details']['HTML'], $this->lang->words['Details']['Step']);

		return $content = array("type" => "section", "section" => "details");
	}
}

$section = new Update_Details();