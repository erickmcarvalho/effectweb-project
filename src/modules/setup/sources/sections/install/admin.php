<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - Admin Account
 * Last Update: 24/04/2013 - 18:33h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Install_Admin extends CTM_Command
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
		$this->lang->loadLanguageFile("admin_account");

		if($_GET['do'] == "check")
		{
			if(empty($_POST['account']) || empty($_POST['character']) || empty($_POST['contact']))
			{
				$GLOBALS['error_message'] = $this->showMessage($this->lang->words['AdminAccount']['Messages']['FieldsVoid'], "attention");
			}
			else
			{
				$this->session->StartSession($_POST['session']);
				$this->session->GetSession("db_settings", $db);

				$this->DB->settings['mssql']['hostname'] = $db['sql_host'];
				$this->DB->settings['mssql']['hostport'] = $db['sql_port'];
				$this->DB->settings['mssql']['username'] = $db['sql_user'];
				$this->DB->settings['mssql']['password'] = $db['sql_pass'];
				$this->DB->settings['mssql']['database'] = MUGEN_CORE;
				$this->DB->settings['mssql']['persistent'] = FALSE;
				$this->DB->settings['mssql']['hideErrors'] = TRUE;
				$this->DB->settings['mssql']['debug'] = FALSE;
				$this->DB->Connect("mssql");

				if(!$this->DB->IsConnected())
				{
					$GLOBALS['error_message'] = $this->showMessage($this->lang->words['AdminAccount']['Messages']['ConnectError'], "error");
				}
				else
				{
					$this->DB->Arguments($_POST['character'], $_POST['account']);
					$this->DB->Query("SELECT Name FROM dbo.Character WHERE Name = '%s' AND AccountID = '%s'", $find_char_q);
				
					/*if($this->DB->CountRows($find_char_q) < 1 || !$find_char_q)
					{
						$GLOBALS['error_message'] = $this->showMessage($this->lang->words['AdminAccount']['Messages']['InvalidData'], "error");
					}
					else
					{*/
						$session = array
						(
							"account" => $_POST['account'],
							"name" => $_POST['character'],
							"contact" => $_POST['contact']
						);

						$this->session->SetSession("admin_account", $session);
						$this->session->EndSession($new_session);

						$this->nextSection($new_session);
					//}
				}
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
		$this->output->setTitles($this->lang->words['AdminAccount']['HTML'], $this->lang->words['AdminAccount']['Step']);
		return $content = array("type" => "section", "section" => "admin_account");
	}
}

$section = new Install_Admin();