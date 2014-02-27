<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - Options
 * Last Update: 13/06/2013 - 01:36h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Repair_Options extends CTM_Command
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
		$this->lang->loadLanguageFile("options");
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
			$check = 0;

			if($_POST['repair_db_web'])
				$check++;
			if($_POST['repair_db_server'])
				$check++;
			if($_POST['restore_factory_template'])
				$check++;
			if($_POST['restore_factory_tasks'])
				$check++;
			if($_POST['create_admin_account'])
				$check++;

			if($check > 0)
			{
				$this->session->StartSession($_POST['session']);
				//$this->session->GetSession("sections", $session);

				$session = array
				(
					"repair_db_web" => $_POST['repair_db_web'] == 1,
					"repair_db_server" => $_POST['repair_db_server'] == 1,
					"restore_factory_template" => $_POST['restore_factory_template'] == 1,
					"restore_factory_tasks" => $_POST['restore_factory_tasks'] == 1,
					"create_admin_account" => $_POST['create_admin_account'] == 1
				);

				$this->session->SetSession("options", $session);
				$this->session->EndSession($_session);
				
				return $this->nextSection($_session);
			}
			else
			{
				$GLOBALS['error_message'] = true;
			}
		}
	}
	/**
	 *	Section Content
	 *
	 *	@param	&string	Content variable
	 *	@return	string
	*/
	public function content(&$content = NULL)
	{
		$this->output->setTitles($this->lang->words['Options']['HTML'], $this->lang->words['Options']['Step']);
		return $content = array("type" => "section", "section" => "options");
	}
}

$section = new Repair_Options();