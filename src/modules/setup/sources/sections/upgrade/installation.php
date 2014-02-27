<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - Installation (Update)
 * Last Update: 09/06/2013 - 05:06h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Update_Installation extends CTM_Command
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
		$this->lang->loadLanguageFile(array("installation", "update_texts"));
	}
	/**
	 *	Run Section
	 *
	 *	@return	void
	*/
	public function run()
	{
		global $versionHistory, $installation;

		if($_GET['do'] == "install")
		{
			require_once(CTM_SETUP_PATH."sources/extensions/setup_versions_update.php");
			$end = 0;

			foreach($versionHistory as $version => $info)
			{
				if($version > $installation['current_version'])
				{
					$versions_to_update[$end++] = $version;
				}
			}

			$end -= 1;
			$current_step = !$_GET['step'] ? 0 : ($_GET['step'] > $end ? $end : $_GET['step']);
			$current_version = $versions_to_update[$current_step];

			switch($_GET['set'])
			{
				case "sql" :
					if($update_versions[$current_version]['sql_site'] == true || $update_versions[$current_version]['sql_server'] == true)
					{
						require_once(CTM_SETUP_PATH."setup/updates/".$current_version."/sql/mssql_drops.php");
						require_once(CTM_SETUP_PATH."setup/updates/".$current_version."/sql/mssql_alters.php");
						require_once(CTM_SETUP_PATH."setup/updates/".$current_version."/sql/mssql_tables.php");
						require_once(CTM_SETUP_PATH."setup/updates/".$current_version."/sql/mssql_procedures.php");
						require_once(CTM_SETUP_PATH."setup/updates/".$current_version."/sql/mssql_views.php");
						require_once(CTM_SETUP_PATH."setup/updates/".$current_version."/sql/mssql_fulltext.php");

						$this->step = "SQL";

						$this->install_vars['querys']['mu_accounts:database'] = MUACC_CORE;
						$this->install_vars['querys']['mu_general:database'] = MUGEN_CORE;
						$this->install_vars['querys']['coin:database'] = COIN_CORE;
						$this->install_vars['querys']['coin:table'] = COIN_TABLE;
						$this->install_vars['querys']['coin:column_1'] = COIN_COLUMN_1;
						$this->install_vars['querys']['coin:column_2'] = COIN_COLUMN_2;
						$this->install_vars['querys']['coin:column_3'] = COIN_COLUMN_3;
						$this->install_vars['querys']['coin:login'] = COIN_LOGIN;

						$drops = 0;
						$alters = 0;
						$tables = 0;
						$procedures = 0;
						$views = 0;
						$others = 0;

						if(count($update_drops) > 0)
						{
							foreach($update_drops as $query)
							{
								$drops++;
								$this->DB->Query($this->loadCompileQuery($query, $current_version));
							}
						}

						if(count($update_alters) > 0)
						{
							foreach($update_alters as $query)
							{
								$alters++;
								$this->DB->Query($this->loadCompileQuery($query, $current_version));
							}
						}

						if(count($update_tables) > 0)
						{
							foreach($update_tables as $query)
							{
								$tables++;
								$this->DB->Query($this->loadCompileQuery($query, $current_version));
							}
						}

						if(count($update_procedures) > 0)
						{
							foreach($update_procedures as $query)
							{
								$procedures++;
								$this->DB->Query($this->loadCompileQuery($query, $current_version));
							}
						}

						if(count($update_views) > 0)
						{
							foreach($update_views as $query)
							{
								$views++;
								$this->DB->Query($this->loadCompileQuery($query, $current_version));
							}
						}
								
						if(count($update_fulltext) > 0)
						{
							foreach($update_fulltext as $query)
							{
								$others++;
								$this->DB->Query($this->loadCompileQuery($query, $current_version));
							}
						}

						$GLOBALS['droped_objects'] = $drops;
						$GLOBALS['installed_alters'] = $alters;
						$GLOBALS['installed_tables'] = $tables;
						$GLOBALS['installed_procedures'] = $procedures;
						$GLOBALS['installed_views'] = $views;
						$GLOBALS['installed_others'] = $others;
						$GLOBALS['go_next'] = "?app=upgrade&section=".$this->section."&do=install&set=template&step=".$current_step;
					}
					else
					{
						header("Location: ?app=upgrade&section=".$this->section."&do=install&set=template&step=".$current_step);
					}
				break;
				case "template" :
					if($update_versions[$current_version]['templates'] == true)
					{
						$xml_content = file_get_contents(CTM_SETUP_PATH."setup/install/xml/skin_harmony.xml");
						$path = "server_cache/db_php/skin_sources/skin_sources.php";
						
						CTM_Template::Lib('ImportExport')->ImportXML($xml_content, $skin_info);
						CTM_Controller::UpdateWebCache("effectwebkernelhash", "hash_file:".$path, "hash_file:".md5_file(CTM_CACHE_PATH.$path));

						$this->step = "Template";
						$GLOBALS['updated_templates'] = array($skin_info['Name']);
						$GLOBALS['go_next'] = "?app=upgrade&section=".$this->section."&do=install&set=data&step=".$current_step;
					}
					else
					{
						header("Location: ?app=upgrade&section=".$this->section."&do=install&set=data&step=".$current_step);
					}
				break;
				case "data" :
					if($update_versions[$current_version]['sql_site'] == true || $update_versions[$current_version]['sql_server'] == true)
					{
						require_once(CTM_SETUP_PATH."setup/updates/".$current_version."/sql/mssql_inserts.php");

						$this->install_vars['querys']['team_groups:name'] = $this->lang->words['InstallTexts']['AdminGroup']['Name'];
						$this->install_vars['querys']['team_groups:group_title'] = $this->lang->words['InstallTexts']['AdminGroup']['Title'];

						$inserts = 0;
						$this->step = "Data";

						if(count($update_inserts) > 0)
						{
							foreach($update_inserts as $query)
							{
								$inserts++;
								$this->DB->Query($this->loadCompileQuery($query));
							}
						}

						$GLOBALS['inserted_data'] = $inserts;
						$GLOBALS['go_next'] = "?app=upgrade&section=".$this->section."&do=install&set=end&step=".$current_step;
					}
					else
					{
						header("Location: ?app=upgrade&section=".$this->section."&do=install&set=end&step=".$current_step);
					}
				break;
				case "end" :
					if($current_step == $end)
					{
						$this->session->StartSession($_POST['session']);
						$this->session->SetSession("install", array("end" => true));
						$this->session->EndSession($new_session);

						$this->nextSection($new_session);
					}
					else
					{
						header("Location: ?app=upgrade&section=".$this->section."&do=install&set=sql&step=".($current_step + 1));
					}
				break;
				default :
					header("Location: ?app=upgrade&section=".$this->section);
				break;
			}

			$GLOBALS['current_version']['string'] = $versionHistory[$current_version]['show'];
			$GLOBALS['current_version']['key'] = $current_version;
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
	private function loadCompileQuery($_query, $version)
	{
		if(!$this->xml['query_texts'])
			$this->xml['query_texts'] = CTM_FileManage::Lib('XML')->ParseXML(CTM_SETUP_PATH."setup/updates/".$version."/xml/texts_querys.xml");

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
}

$section = new Update_Installation();