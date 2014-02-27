<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - DB Repair
 * Last Update: 13/06/2013 - 02:02h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Repair_Admin extends CTM_Command
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
		$this->lang->loadLanguageFile(array("db_repair"));
	}
	/**
	 *	Run Section
	 *
	 *	@return	void
	*/
	public function run()
	{
		$this->session->StartSession($_SESSION['SETUP_SESSION']);
		$this->session->GetSession("options", $options);

		if($options['repair_db_web'] == true || $options['repair_db_server'] == true)
		{
			$this->lang->loadLanguageFile("db");

			if($_GET['do'] == "check")
			{
				/*if($options['repair_db_web'] == true)
				{
					$session['db_web'] = array
					(
						"reset_all_tables" => $_POST['web_reset_all_tables'] == 1,
					);
				}*/

				if($options['repair_db_server'] == true)
				{
					$session['db_server'] = array
					(
						"reset_all_tables" => $_POST['server_reset_all_tables'] == 1,
						"reset_virtual_vault_items" => $_POST['server_reset_virtual_vault_items'] == 1,
						"reset_member_data" => $_POST['server_reset_member_data'] == 1,
						"reset_character_data" => $_POST['reset_reset_character_data'] == 1
					);
				}

				$this->session->SetSession("repair_db", $session);
				$this->session->EndSession($new_session);

				$this->nextSection($new_session);
			}
		}
		else
		{
			$this->session->EndSession($new_session);
			$this->nextSection($new_session);
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
		$this->output->setTitles($this->lang->words['DBRepair']['HTML'], $this->lang->words['DBRepair']['Step']);
		return $content = array("type" => "section", "section" => "db_repair");
	}
}

$section = new Repair_Admin();