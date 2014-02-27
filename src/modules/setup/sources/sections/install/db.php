<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - Database
 * Last Update: 24/04/2013 - 18:33h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Install_Database extends CTM_Command
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
		require_once(CTM_SETUP_PATH."sources/extensions/setup_sql_objects.php");

		$this->lang->loadLanguageFile("db_settings");

		if($_GET['do'] == "check")
		{
			if(empty($_POST['db_host']) || empty($_POST['db_port']) || empty($_POST['db_name']) || empty($_POST['db_user']))
			{
				$GLOBALS['error_message'] = $this->showMessage($this->lang->words['DBSettings']['Messages']['FieldsVoid'], "attention");
			}
			else
			{
				$this->DB->settings['mssql']['hostname'] = $_POST['db_host'];
				$this->DB->settings['mssql']['hostport'] = $_POST['db_port'];
				$this->DB->settings['mssql']['database'] = $_POST['db_name'];
				$this->DB->settings['mssql']['username'] = $_POST['db_user'];
				$this->DB->settings['mssql']['password'] = $_POST['db_pass'];
				$this->DB->settings['mssql']['persistent'] = FALSE;
				$this->DB->settings['mssql']['hideErrors'] = TRUE;
				$this->DB->settings['mssql']['debug'] = FALSE;
				$this->DB->Connect("mssql");

				if(!$this->DB->IsConnected())
				{
					$GLOBALS['error_message'] = $this->showMessage($this->lang->words['DBSettings']['Messages']['ConnectError'], "error");
				}
				else
				{
					$all_ok = false;


					if(count($install_objects) > 0)
					{
						$with_objects = false;
						$delete_success = false;

						foreach($install_objects as $name => $type)
						{
							switch($type)
							{
								case "table" :
									$_type = "U";
									$query = "TABLE";
								break;
								case "procedure" :
									$_type = "P";
									$query = "PROCEDURE";
								break;
								case "view" :
									$_type = "V";
									$query = "VIEW";
								break;
							}

							$this->DB->Arguments($name);
							$this->DB->Query("SELECT id FROM dbo.sysobjects WHERE name = '%s' AND type = '{$_type}'", $check);

							if($this->DB->CountRows($check) > 0)
							{
								$with_objects = true;
								break;
							}
						}

						if($with_objects == true)
						{
							if($_POST['new_installation'] == 1)
							{
								$delete_install = true;
								$all_ok = true;
							}
							else
							{
								$GLOBALS['error_message'] = $this->showMessage($this->lang->words['DBSettings']['Messages']['ExistingInstallation'], "error");
								$GLOBALS['existing_installation'] = true;
							}
						}
						else
						{
							$all_ok = true;
						}
					}

					$this->DB->CloseConnection();

					if($all_ok == true)
					{
						$settings = array
						(
							"sql_host" => $_POST['db_host'],
							"sql_port" => $_POST['db_port'],
							"sql_user" => $_POST['db_user'],
							"sql_pass" => $_POST['db_pass'],
							"sql_db" => $_POST['db_name'],
							"delete_install" => $delete_install
						);

						$this->session->StartSession($_POST['session']);
						$this->session->SetSession("db_settings", $settings);
						$this->session->EndSession($new_session);

						$this->nextSection($new_session);
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
		$this->output->setTitles($this->lang->words['DBSettings']['HTML'], $this->lang->words['DBSettings']['Step']);
		return $content = array("type" => "section", "section" => "db_settings");
	}
}

$section = new Install_Database();