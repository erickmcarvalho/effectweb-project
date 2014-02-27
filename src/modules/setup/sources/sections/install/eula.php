<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - EULA
 * Last Update: 24/04/2013 - 18:33h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Install_EULA extends CTM_Command
{
	/**
	 *	Class construct
	 *
	 *	@return	void
	*/
	public function __construct()
	{
		$this->registry();

		$this->loadLibrary("Session", "session");
	}
	/**
	 *	Run Section
	 *
	 *	@return	void
	*/
	public function run()
	{
		if($_GET['do'] == "check")
		{
			if($_POST['accept'] == 1)
			{
				$this->session->StartSession($_POST['session']);
				$this->session->GetSession("sections", $session);

				$session['eula'] = true;

				$this->session->SetSession("sections", $session);
				$this->session->EndSession($_session);

				return $this->nextSection($_session);
			}
			else
			{
				$GLOBALS['error_message'] = true;
			}
		}

		$xml = CTM_FileManage::Lib('XML')->ParseXML(CTM_SETUP_PATH."xml/license.xml");

		$GLOBALS['eula_terms'] = nl2br(trim($xml->eula));
	}
	/**
	 *	Section Content
	 *
	 *	@param	&string	Content variable
	 *	@return	string
	*/
	public function content(&$content = NULL)
	{
		$this->lang->loadLanguageFile("eula");
		$this->output->setTitles($this->lang->words['EULA']['HTML'], $this->lang->words['EULA']['Step']);
		return $content = array("type" => "section", "section" => "eula");
	}
}

$section = new Install_EULA();