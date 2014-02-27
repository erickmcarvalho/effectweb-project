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

class Install_Installation extends CTM_Command
{
	private $step			= "Start";
	private $install_vars	= array();
	private $xml			= array();

	/**
	 *	Class construct
	 *
	 *	@return	void
	*/
	public function __construct()
	{
		$this->registry();

		$this->loadLibrary("Session", "session");
		$this->loadLibrary("Settings", "iSettings");
		$this->lang->loadLanguageFile(array("installation", "install_texts"));
	}
	/**
	 *	Run Section
	 *
	 *	@return	void
	*/
	public function run()
	{
		global $installation;

		if($_GET['do'] == "install")
		{
			$this->session->StartSession($_POST['session']);
			$this->session->GetSession("db_settings", $sql_session);

			$this->DB->settings['mssql']['hostname'] = $sql_session['sql_host'];
			$this->DB->settings['mssql']['hostport'] = $sql_session['sql_port'];
			$this->DB->settings['mssql']['database'] = $sql_session['sql_db'];
			$this->DB->settings['mssql']['username'] = $sql_session['sql_user'];
			$this->DB->settings['mssql']['password'] = $sql_session['sql_pass'];
			$this->DB->settings['mssql']['persistent'] = FALSE;
			$this->DB->settings['mssql']['hideErrors'] = TRUE;
			$this->DB->settings['mssql']['debug'] = FALSE;
			$this->DB->Connect("mssql");

			if(!$this->DB->IsConnected())
			{
				$GLOBALS['error_message'] = $this->showMessage($this->lang->words['Installation']['Messages']['ConnectError'], "error");
			}
			else
			{
				switch($_GET['set'])
				{
					case "sql" :
						require_once(CTM_SETUP_PATH."sources/extensions/setup_sql_objects.php");
						require_once(CTM_SETUP_PATH."setup/install/sql/mssql_alters.php");
						require_once(CTM_SETUP_PATH."setup/install/sql/mssql_tables.php");
						require_once(CTM_SETUP_PATH."setup/install/sql/mssql_procedures.php");
						require_once(CTM_SETUP_PATH."setup/install/sql/mssql_views.php");
						require_once(CTM_SETUP_PATH."setup/install/sql/mssql_fulltext.php");

						$all_ok = true;
						$this->step = "SQL";

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

									if($sql_session['delete_install'] == true)
									{
										$this->DB->Arguments($name);
										$this->DB->Query("DROP {$query} dbo.%s", $test);
										
										$delete_success = $test == true;
									}
									else
									{
										$delete_success = false;
									}
								}
							}

							if($with_objects == true)
							{
								if($sql_session['delete_install'] == true)
								{
									if($delete_success == false)
									{
										$GLOBALS['error_message'] = $this->showMessage($this->lang->words['Installation']['Messages']['DeleteInstallationFailed'], "error");
										$all_ok = false;
									}
								}
								else
								{
									$GLOBALS['error_message'] = $this->showMessage($this->lang->words['Installation']['Messages']['ExistingInstallation'], "error");
									$all_ok = false;
								}
							}
						}

						if($all_ok == true)
						{
							$this->install_vars['querys']['mu_accounts:database'] = MUACC_CORE;
							$this->install_vars['querys']['mu_general:database'] = MUGEN_CORE;
							$this->install_vars['querys']['coin:database'] = COIN_CORE;
							$this->install_vars['querys']['coin:table'] = COIN_TABLE;
							$this->install_vars['querys']['coin:column_1'] = COIN_COLUMN_1;
							$this->install_vars['querys']['coin:column_2'] = COIN_COLUMN_2;
							$this->install_vars['querys']['coin:column_3'] = COIN_COLUMN_3;
							$this->install_vars['querys']['coin:login'] = COIN_LOGIN;

							$alters = 0;
							$tables = 0;
							$procedures = 0;
							$views = 0;
							$others = 0;

							if(count($install_alters) > 0)
							{
								foreach($install_alters as $query)
								{
									$alters++;
									$this->DB->Query($this->loadCompileQuery($query));
								}
							}

							if(count($install_tables) > 0)
							{
								foreach($install_tables as $query)
								{
									$tables++;
									$this->DB->Query($this->loadCompileQuery($query));
								}
							}

							if(count($install_procedures) > 0)
							{
								foreach($install_procedures as $query)
								{
									$procedures++;
									$this->DB->Query($this->loadCompileQuery($query));
								}
							}

							if(count($install_views) > 0)
							{
								foreach($install_views as $query)
								{
									$views++;
									$this->DB->Query($this->loadCompileQuery($query));
								}
							}

							if(count($install_fulltext) > 0)
							{
								foreach($install_fulltext as $query)
								{
									$others++;
									$this->DB->Query($this->loadCompileQuery($query));
								}
							}

							$GLOBALS['installed_alters'] = $alters;
							$GLOBALS['installed_tables'] = $tables;
							$GLOBALS['installed_procedures'] = $procedures;
							$GLOBALS['installed_views'] = $views;
							$GLOBALS['installed_others'] = $others;
							$GLOBALS['go_next'] = "?app=install&section=".$this->section."&do=install&set=template";
						}

						return false;
					break;
					case "template" :
						$xml_content = file_get_contents(CTM_SETUP_PATH."setup/install/xml/skin_harmony.xml");
						$path = "server_cache/db_php/skin_sources/skin_sources.php";
						
						CTM_Template::Lib('ImportExport')->ImportXML($xml_content, $skin_info);
						CTM_Controller::UpdateWebCache("effectwebkernelhash", "hash_file:".$path, "hash_file:".md5_file(CTM_CACHE_PATH.$path));

						$this->step = "Template";
						$GLOBALS['installed_templates'] = array($skin_info['Name']);
						$GLOBALS['go_next'] = "?app=install&section=".$this->section."&do=install&set=settings";
					break;
					case "settings" :
						$xml_settings = CTM_FileManage::Lib('XML')->ParseXML(CTM_SETUP_PATH."setup/install/xml/control_settings.xml");

						$lines = 0;
						$this->step = "Settings";

						if(count($xml_settings) > 0)
						{
							$this->iSettings->OpenSettings(CTM_CONTROL_PATH."Settings.php");

							foreach($xml_settings->line as $xml)
							{
								$lines++;
								$this->iSettings->SetLine($xml['syntax'], $this->loadCompileSettingsArgs($xml));
							}

							$this->iSettings->CloseSettings();
						}

						$GLOBALS['changed_lines'] = $lines;
						$GLOBALS['go_next'] = "?app=install&section=".$this->section."&do=install&set=data";
					break;
					case "data" :
						require_once(CTM_SETUP_PATH."setup/install/sql/mssql_inserts.php");

						$this->install_vars['querys']['team_groups:name'] = $this->lang->words['InstallTexts']['AdminGroup']['Name'];
						$this->install_vars['querys']['team_groups:group_title'] = $this->lang->words['InstallTexts']['AdminGroup']['Title'];

						$inserts = 0;
						$this->step = "Data";

						if(count($install_inserts) > 0)
						{
							foreach($install_inserts as $query)
							{
								$inserts++;
								$this->DB->Query($this->loadCompileQuery($query));
							}
						}

						$GLOBALS['inserted_data'] = $inserts;
						$GLOBALS['go_next'] = "?app=install&section=".$this->section."&do=install&set=end";
					break;
					case "end" :
						$this->session->StartSession($_POST['session']);
						$this->session->SetSession("install", array("end" => true));
						$this->session->EndSession($new_session);

						$this->nextSection($new_session);
					break;
					default :
						header("Location: ?app=install&section=".$this->section);
					break;
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
		$GLOBALS['hide_button'] = true;
		$GLOBALS['do'] = "install&amp;set=sql";

		$this->output->setTitles($this->lang->words['Installation']['HTML'], $this->lang->words['Installation']['Step'][$this->step]);
		return $content = array("type" => "section", "section" => "installation");
	}
	/**
	 *	Private: Compile Query String
	 *
	 *	@param	string	Query string
	 *	@return	string
	*/
	private function loadCompileQuery($_query)
	{
		if(!$this->xml['query_texts'])
			$this->xml['query_texts'] = CTM_FileManage::Lib('XML')->ParseXML(CTM_SETUP_PATH."setup/install/xml/texts_querys.xml");

		if($_query['arguments'])
		{
			foreach($_query['arguments'] as $param => $type)
			{
				switch($type)
				{
					case "session" :
						list($key, $value) = explode(":", $param);

						$session = $this->session->GetSession($key);
						$_query['query'] = str_replace("{:".$param.":}", $session[$value], $_query['query']);
					break;
					case "text" :
						$_query['query'] = str_replace("{:".$param.":}", $this->xml['query_texts']->{$param}, $_query['query']);
					break;
					case "var" :
						$_query['query'] = str_replace("{:".$param.":}", $this->install_vars['querys'][$param], $_query['query']);
					break;
				}
			}
		}

		return $_query['query'];
	}
	/**
	 *	Private: Compile Settings String
	 *
	 *	@param	string	Settings string
	 *	@return	string
	*/
	private function loadCompileSettingsArgs($xml)
	{
		if(!$this->xml['settings_texts'])
			$this->xml['settings_texts'] = CTM_FileManage::Lib('XML')->ParseXML(CTM_SETUP_PATH."setup/install/xml/texts_settings.xml");

		$arguments = array();
		$i = 0;

		foreach($xml as $_xml)
		{
			switch($_xml['type'])
			{
				case "session" :
					list($key, $value) = explode(":", $_xml['param']);
	
					$session = $this->session->GetSession($key);
					$arguments[$i++] = $session[$value];
				break;
				case "text" :
					$arguments[$i++] = $this->xml['settings_texts']->{$param};
				break;
				case "var" :
					$arguments[$i++] = $this->install_vars['settings'][$param];
				break;
			}
		}

		return $arguments;
	}
}

$section = new Install_Installation();