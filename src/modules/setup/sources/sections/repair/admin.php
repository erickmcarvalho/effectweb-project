<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - Admin Account
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

		if($options['create_admin_account'] == true)
		{
			$this->lang->loadLanguageFile("admin_account");

			if($_GET['do'] == "check")
			{
				if(empty($_POST['account']) || empty($_POST['character']) || empty($_POST['contact']))
				{
					$GLOBALS['error_message'] = $this->showMessage($this->lang->words['AdminAccount']['Messages']['FieldsVoid'], "attention");
				}
				else
				{
					$session = array
					(
						"account" => $_POST['account'],
						"name" => $_POST['character'],
						"contact" => $_POST['contact']
					);

					$this->session->SetSession("admin_account", $session);
					$this->session->EndSession($new_session);

					$this->nextSection($new_session);
				}
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
		$this->output->setTitles($this->lang->words['AdminAccount']['HTML'], $this->lang->words['AdminAccount']['Step']);
		return $content = array("type" => "section", "section" => "admin_account");
	}
}

$section = new Repair_Admin();