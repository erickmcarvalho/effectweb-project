<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - Login
 * Last Update: 08/06/2013 - 17:23h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Update_Login extends CTM_Command
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
		$this->lang->loadLanguageFile("login");

		if($_GET['do'] == "check")
		{
			$_username = str_replace("'", NULL, $_POST['username']);
			$_password = str_replace("'", NULL, $_POST['password']);

			if(empty($_username) || empty($_password))
			{
				$GLOBALS['error_message'] = $this->showMessage($this->lang->words['Login']['Messages']['FieldsVoid'], "attention");
			}
			else
			{
				$this->DB->Arguments($_username, $_password, USE_MD5);
				$auth_query = $this->DB->Query("EXEC dbo.CTM_CheckAccount '%s','%s', %d");
				$auth_fetch = $this->DB->FetchRow($auth_query);
				$auth_result = "0x".bin2hex($auth_fetch[0]);

				if($auth_result == "0x02")
				{
					$GLOBALS['error_message'] = $this->showMessage($this->lang->words['Login']['Messages']['LoginFailed'], "error");
				}
				elseif($auth_result == "0x03")
				{
					if(!in_array($_username, $this->settings['ADMINCONTROLPANEL']['SYSTEM_MANAGER']))
					{
						$GLOBALS['error_message'] = $this->showMessage($this->lang->words['Login']['Messages']['NoPermission'], "error");
					}
					else
					{
						$this->session->StartSession($_POST['session']);
						$this->session->GetSession("sections", $session);

						$session['authentication'] = true;

						$this->session->SetSession("sections", $session);
						$this->session->EndSession($_session);

						$this->nextSection($_session);
					}
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
		$this->output->setTitles($this->lang->words['Login']['HTML'], $this->lang->words['Login']['Step']);

		return $content = array("type" => "section", "section" => "login");
	}
}

$section = new Update_Login();