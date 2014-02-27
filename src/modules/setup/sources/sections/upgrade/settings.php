<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - Settings Change
 * Last Update: 09/06/2013 - 02:12h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Update_Settings extends CTM_Command
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
		global $versionHistory, $installation;
		$this->lang->loadLanguageFile("settings");

		require_once(CTM_SETUP_PATH."sources/extensions/setup_versions_update.php");
		$end = 0;
		$versions_to_update = array();

		foreach($versionHistory as $version => $info)
		{
			if($version > $installation['current_version'] && $update_versions[$version]['settings'] == true && file_exists(CTM_SETUP_PATH."setup/updates/".$version."/xml/control_settings.xml"))
			{
				$versions_to_update[$end++] = $version;
			}
		}

		//$end -= 1;
		$current_step = $_GET['step'] < 1 ? 0 : ($_GET['step'] > $end ? $end : $_GET['step']);
		$current_version = $versions_to_update[$current_step];
		
		$_xml = CTM_FileManage::Lib('XML')->ParseXML(CTM_SETUP_PATH."setup/updates/".$current_version."/xml/control_settings.xml");
		$this->_settings = file_get_contents(CTM_CONTROL_PATH."Settings.php");

		if($_GET['do'] == "check")
		{
			$line = array();
			$i = 0;

			if($_xml)
			{
				foreach($_xml as $xml)
				{
					if($xml->command == "change")
					{
						if(preg_match("/".$this->buildSyntax($xml->search, true)."/is", $this->_settings))
						{
							//$line[$i++] = "NoChanged";
						}
						elseif(!preg_match("/".$this->buildSyntax($xml->syntax, true)."/is", $this->_settings))
						{
							//$line[$i++] = "NoChanged";
						}
					}
					elseif($xml->command == "remove")
					{
						if(preg_match("/".$this->buildSyntax($xml->syntax, true)."/is", $this->_settings))
						{
							//$line[$i++] = "NoRemoved";
						}
					}
					elseif($xml->command == "insert")
					{
						if(!preg_match("/".$this->buildSyntax($xml->syntax, true)."/is", $this->_settings))
						{
							//$line[$i++] = "NoInserted";
						}
					}
				}
			}

			if(count($line) > 0)
			{
				$GLOBALS['lines_error'] = $line;
			}
			else
			{
				if($current_step == $end)
				{
					$this->session->StartSession($_POST['session']);
					$this->session->GetSession("sections", $session);

					$session['settings'] = true;

					$this->session->SetSession("sections", $session);
					$this->session->EndSession($_session);

					$this->nextSection($_session);
				}
				else
				{
					header("Location: ?app=".CTM_SETUP_MODE."&section=".$this->section."&step=".($current_step + 1));
					exit();
				}
			}
		}

		$line = array();
		$i = 0;
		
		if($_xml)
		{
			foreach($_xml as $xml)
			{
				$line[$i] = array
				(
					"command" => $xml->command,
					"syntax" => $this->buildSyntax($xml->syntax)
				);

				if(!empty($xml->search))
				{
					$line[$i]['search'] = $this->buildSyntax($xml->search);
				}

				if(!empty($xml->insert))
				{
					switch($xml->insert)
					{
						case "abdove" :
							$line[$i]['insert'] = "Abdove";
						break;
						case "below" :
							$line[$i]['insert'] = "Below";
						break;
						case "before" :
							$line[$i]['insert'] = "Before";
						break;
						case "after" :
							$line[$i]['insert'] = "After";
						break;
					}
				}

				$i++;
			}
		}

		$GLOBALS['current_version']['string'] = $versionHistory[$current_version]['show'];
		$GLOBALS['current_version']['key'] = $current_version;
		$GLOBALS['settings_lines'] = $line;
		$GLOBALS['do'] = "check&amp;step=".$current_step;
	}
	/**
	 *	Section Content
	 *
	 *	@param	&string	Content variable
	 *	@return	string
	*/
	public function content(&$content = NULL)
	{
		$this->output->setTitles($this->lang->words['Settings']['HTML'], $this->lang->words['Settings']['Step']);

		return $content = array("type" => "section", "section" => "settings");
	}
	/**
	 *	Private: Build Syntax
	 *
	 *	@param	string	Syntax
	 *	@param	boolean	Is for preg_match (default -> false)
	 *	@return	string
	*/
	private function buildSyntax($syntax, $is_preg = false)
	{
		$syntax = rtrim($syntax);

		if(strstr($syntax, "(:any)"))
		{
			preg_match("/".str_replace("\\(\\:any\\)", "(.*?)", preg_quote($syntax, "/"))."/is", $this->_settings, $match);
			$i = 1;

			while(strstr($syntax, "(:any)"))
			{
				$syntax = preg_replace("/\\(\\:any\\)/is", $match[$i], $syntax, 1);
				$i++;
			}
		}

		return $is_preg == true ? str_replace("\\(\\:any\\)", "(.*?)", preg_quote(trim($syntax), "/")) : $syntax;
	}
}

$section = new Update_Settings();