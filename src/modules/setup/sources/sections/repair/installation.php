<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - Installation (Repair)
 * Last Update: 09/06/2013 - 05:06h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Repair_Installation extends CTM_Command
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
		$this->lang->loadLanguageFile(array("installation", "install:install_texts"));
	}
	/**
	 *	Run Section
	 *
	 *	@return	void
	*/
	public function run()
	{
		global $versionHistory, $installation;

		$this->session->StartSession($_SESSION['SETUP_SESSION']);
		$this->session->GetSession("options", $options);
		$this->session->GetSession("repair_db", $repair_db);

		if($_GET['do'] == "run")
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
					$vault_ready = false;
					$reset_data = 0;
					$this->step = "SQL";

					/*if(count($install_objects) > 0 && $options['repair_db_web'] == true)
					{
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

							if($repair_db['db_web']['reset_all_tables'] == true && $query == "TABLE")
							{
								$this->DB->Arguments($name);
								$this->DB->Query("SELECT id FROM dbo.sysobjects WHERE name = '%s' AND type = '{$_type}'", $check);

								if($this->DB->CountRows($check) > 0)
								{
									$this->DB->Arguments($name);
									$this->DB->Query("DROP {$query} dbo.%s", $test);

									$delete_success = $test == true;
								}
							}
						}

						if($repair_db['db_web']['reset_all_tables'] == true && $query == "TABLE")
						{
							if($delete_success == false)
							{
								$GLOBALS['error_message'] = $this->showMessage($this->lang->words['Installation']['Messages']['DeleteTablesFailed'], "error");
								$all_ok = false;
							}
						}
					}*/

					if(count($repair_objects['Server']) > 0 && $options['repair_db_server'] == true)
					{
						foreach($repair_objects['Server'] as $name => $type)
						{
							if($name == "MEMB_INFO" && $repair_db['db_server']['reset_member_data'] == true)
							{
								$reset_data += $this->loadResetDBData(MUACC_CORE.".dbo.MEMB_INFO", $type);
							}
							elseif($name == "Character" && $repair_db['db_server']['reset_character_data'] == true)
							{
								$reset_data += $this->loadResetDBData(MUACC_CORE.".dbo.Character", $type);
							}
							else
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

								if($repair_db['db_server']['reset_all_tables'] == true && $query == "TABLE" && $name != "EffectWebVirtualVault")
								{
									$this->DB->Arguments($name);
									$this->DB->Query("SELECT id FROM ".MUGEN_CORE.".dbo.sysobjects WHERE name = '%s' AND type = '{$_type}'", $check);

									if($this->DB->CountRows($check) > 0)
									{
										$this->DB->Arguments($name);
										$this->DB->Query("DROP {$query} ".MUGEN_CORE.".dbo.%s", $test);

										$delete_success = $test == true;
									}
								}
							}

							if($repair_db['db_server']['reset_virtual_vault_items'] == true && $name == "EffectWebVirtualVault" && $vault_ready == false)
							{
								$this->DB->Query("SELECT id FROM ".MUGEN_CORE.".dbo.sysobjects WHERE name = 'EffectWebVirtualVault' AND type = '{$_type}'", $check);
								if($this->DB->CountRows($check) > 0)
								{
									$this->DB->Arguments($name);
									$this->DB->Query("DROP TABLE ".MUGEN_CORE.".dbo.EffectWebVirtualVault", $test);

									$vault_ready = true;
									$delete_success = $test == true;
								}
							}

							if($repair_db['db_server']['reset_all_tables'] == true && $query == "TABLE")
							{
								if($delete_success == false)
								{
									$GLOBALS['error_message'] = $this->showMessage($this->lang->words['Installation']['Messages']['DeleteTablesFailed'], "error");
									$all_ok = false;
								}
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

						$_install_alters = array();
						$_install_tables = array();
						$_install_procedures = array();
						$_install_views = array();
						$_install_fulltext = array();

						if(count($install_alters) > 0)
						{
							foreach($install_alters as $_query)
							{
								/*if($_query['db'] == "system" && $options['repair_db_web'] == true)
								{
									$_install_tables[] = $_query;
								}*/

								if($_query['db'] == "server" && $options['repair_db_server'] == true)
								{
									$_install_alters[] = $_query;
								}
							}
						}

						if(count($install_tables) > 0)
						{
							foreach($install_tables as $_query)
							{
								/*if($_query['db'] == "system" && $options['repair_db_web'] == true)
								{
									$_install_tables[] = $_query;
								}*/

								if($_query['db'] == "server" && $options['repair_db_server'] == true)
								{
									$_install_tables[] = $_query;
								}
							}
						}

						if(count($install_procedures) > 0)
						{
							foreach($install_procedures as $_query)
							{
								/*if($_query['db'] == "system" && $options['repair_db_web'] == true)
								{
									$_install_procedures[] = $_query;
								}*/

								if($_query['db'] == "server" && $options['repair_db_server'] == true)
								{
									$_install_procedures[] = $_query;
								}
							}
						}

						if(count($install_views ) > 0)
						{
							foreach($install_views as $_query)
							{
								/*if($_query['db'] == "system" && $options['repair_db_web'] == true)
								{
									$_install_views[] = $_query;
								}*/

								if($_query['db'] == "server" && $options['repair_db_server'] == true)
								{
									$_install_views[] = $_query;
								}
							}
						}

						if(count($install_fulltext ) > 0)
						{
							foreach($install_fulltext as $_query)
							{
								/*if($_query['db'] == "system" && $options['repair_db_web'] == true)
								{
									$_install_fulltext[] = $_query;
								}*/

								if($_query['db'] == "server" && $options['repair_db_server'] == true)
								{
									$_install_fulltext[] = $_query;
								}
							}
						}

						if(count($_install_alters) > 0)
						{
							foreach($_install_alters as $query)
							{
								$this->DB->Query($this->loadCompileQuery($query), $test);

								if($test == true)
									$alters++;
							}
						}

						if(count($_install_tables) > 0)
						{
							foreach($_install_tables as $query)
							{
								$this->DB->Query($this->loadCompileQuery($query), $test);

								if($test == true)
									$tables++;
							}
						}

						if(count($_install_procedures) > 0)
						{
							foreach($_install_procedures as $query)
							{
								$this->DB->Query($this->loadCompileQuery($query), $test);

								if($test == true)
									$procedures++;
							}
						}

						if(count($_install_views) > 0)
						{
							foreach($_install_views as $query)
							{
								$this->DB->Query($this->loadCompileQuery($query), $test);

								if($test == true)
									$views++;
							}
						}
							
						if(count($_install_fulltext) > 0)
						{
							foreach($_install_fulltext as $query)
							{
								$this->DB->Query($this->loadCompileQuery($query), $test);

								if($test == true)
									$others++;
							}
						}
					}

					$GLOBALS['repaired_alters'] = $alters;
					$GLOBALS['repaired_tables'] = $tables;
					$GLOBALS['repaired_procedures'] = $procedures;
					$GLOBALS['repaired_views'] = $views;
					$GLOBALS['repaired_others'] = $others;
					$GLOBALS['reseted_data'] = $reset_data;
					$GLOBALS['go_next'] = "?app=repair&section=".$this->section."&do=run&set=template";

					return false;
				break;
				case "template" :
					if($options['restore_factory_template'] == true)
					{
						$xml_content = file_get_contents(CTM_SETUP_PATH."setup/install/xml/skin_harmony.xml");
						$path = "server_cache/db_php/skin_sources/skin_sources.php";
							
						CTM_Template::Lib('ImportExport')->ImportXML($xml_content, $skin_info);
						CTM_Controller::UpdateWebCache("effectwebkernelhash", "hash_file:".$path, "hash_file:".md5_file(CTM_CACHE_PATH.$path));

						$this->step = "Template";
						$GLOBALS['restored_templates'] = array($skin_info['Name']);
						$GLOBALS['go_next'] = "?app=repair&section=".$this->section."&do=run&set=data";
					}
					else
					{
						header("Location: ?app=repair&section=".$this->section."&do=install&set=data");
					}
				break;
				case "data" :
					require_once(CTM_SETUP_PATH."sources/extensions/setup_sql_data.php");
					require_once(CTM_SETUP_PATH."setup/install/sql/mssql_inserts.php");

					$this->install_vars['querys']['team_groups:name'] = $this->lang->words['InstallTexts']['AdminGroup']['Name'];
					$this->install_vars['querys']['team_groups:group_title'] = $this->lang->words['InstallTexts']['AdminGroup']['Title'];

					$inserts = 0;
					$this->step = "Data";

					if($options['create_admin_account'] == true)
					{
						$test = array(false, false);
						//$this->DB->Query($this->loadCompileQuery($install_inserts['General']['AdminAccount']['Group']), $test[0]);

						$this->install_vars['querys']['team_members:group_id'] = 1;//$this->DB->GetLastedId();
						$this->DB->Query($this->loadCompileQuery($install_inserts['AdminAccount:Account']), $test[1]);

						//if($test[0] == true)
							//$inserts++;

						if($test[1] == true)
							$inserts++;
					}

					if($options['restore_factory_tasks'] == true)
					{
						$test = false;
							
						if(count($sql_data) > 0)
						{
							foreach($sql_data as $index => $query)
							{
								if(substr($index, 0, 9) == "CronTask:")
								{
									$this->DB->Query($query['Select'], $test);

									if($this->DB->CountRows($test) > 0)
									{
										$this->DB->Query($query['Delete']);
									}
									
									$this->DB->Query($this->loadCompileQuery($install_inserts[$index]), $test);

									if($test == true)
										$inserts++;
								}
							}
						}
					}

					$GLOBALS['inserted_data'] = $inserts;
					$GLOBALS['go_next'] = "?app=repair&section=".$this->section."&do=run&set=end";
				break;
				case "end" :
					$this->session->StartSession($_POST['session']);
					$this->session->SetSession("repair", array("end" => true));
					$this->session->EndSession($new_session);

					$this->nextSection($new_session);
				break;
				default :
					header("Location: ?app=repair&section=".$this->section);
				break;
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
		$GLOBALS['do'] = "run&amp;set=sql";

		$this->output->setTitles($this->lang->words['Installation']['HTML'], $this->lang->words['Installation']['Step'][$this->step]);
		return $content = array("type" => "section", "section" => "installation");
	}
	/**
	 *	Private: Reset DB Data
	 *
	 *	@param	string	Table
	 *	@param	array	Columns
	 *	@return	integer
	*/
	private function loadResetDBData($table, $columns)
	{
		$count = 0;

		if(count($columns) > 0)
		{
			foreach($columns as $column => $_type)
			{
				if(strstr($_type, ":"))
					list($trash, $_type, $_result, $__result) = explode(":", $_type);

				switch($_type)
				{
					case "integer" :
						$update = $_result;
					break;
					case "hex" :
						$update = "0x".str_repeat($_result, $__result);
					break;
					default :
						$update = "NULL";
					break;
				}

				$this->DB->Arguments($name);
				$this->DB->Query("UPDATE {$table} SET {$column} =  {$update}", $test);

				if($test == true)
					$count++;
			}
		}

		return $count;
	}
	/**
	 *	Private: Compile Query String
	 *
	 *	@param	string	Query string
	 *	@param	string	Query key (Default -> query)
	 *	@return	string
	*/
	private function loadCompileQuery($_query, $key = "query")
	{
		if(!$this->xml['query_texts'])
			$this->xml['query_texts'] = CTM_FileManage::Lib('XML')->ParseXML(CTM_SETUP_PATH."setup/repair/xml/texts_querys.xml");

		if(count($_query['arguments']) > 0)
		{
			foreach($_query['arguments'] as $param => $type)
			{
				switch($type)
				{
					case "session" :
						list($_key, $value) = explode(":", $param);

						$session = $this->session->GetSession($_key);
						$_query[$key] = str_replace("{:".$param.":}", $session[$value], $_query[$key]);
					break;
					case "text" :
						$_query[$key] = str_replace("{:".$param.":}", $this->xml['query_texts']->{$param}, $_query[$key]);
					break;
					case "var" :
						$_query[$key] = str_replace("{:".$param.":}", $this->install_vars['querys'][$param], $_query[$key]);
					break;
				}
			}
		}

		return $_query[$key];
	}
}

$section = new Repair_Installation();