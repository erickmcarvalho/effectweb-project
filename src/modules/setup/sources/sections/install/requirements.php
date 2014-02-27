<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Section - Requirements
 * Last Update: 24/04/2013 - 18:33h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Install_Requirements extends CTM_Command
{
	private $extensions	= array
	(
		"mssql" => "mssql",
		"curl" => "curl",
		"sockets" => "sockets",
		"gd" => "gd",
		"zip" => "zip",
		"ioncube" => "ionCube Loader"
	);

	private $versions	= array
	(
		"php" => "5.1.1",
		"ioncube" => "4.0.4"
	);

	private $others		= array
	(
		"memory_limit" => "124M"
	);

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
		require_once(CTM_SETUP_PATH."sources/extensions/setup_directorys.php");
		$dirs_error = array();

		if(count($install_directorys) > 0)
		{
			foreach($install_directorys as $path)
			{
				if(($fp = fopen(CTM_ROOT_PATH.$path.(substr($path, -1, 1) != "/"  ? "/" : NULL)."file.test", "w")))
				{
					fclose($fp);
					unlink(CTM_ROOT_PATH.$path.(substr($path, -1, 1) != "/"  ? "/" : NULL)."file.test");
				}
				else
				{
					$dirs_error[] = $path;
				}
			}
		}

		$data['mssql_extension'] = extension_loaded($this->extensions['mssql']) == true;
		$data['curl_extension'] = extension_loaded($this->extensions['curl']) == true;
		$data['sockets_extension'] = extension_loaded($this->extensions['sockets']) == true;
		$data['gd_extension'] = extension_loaded($this->extensions['gd']) == true;
		$data['zip_extension'] = extension_loaded($this->extensions['zip']) == true;
		$data['ioncube_extension'] = extension_loaded($this->extensions['ioncube']) == true;

		$data['php_version'] = version_compare(phpversion(), $this->versions['php'], ">=") == true;
		$data['ioncube_version'] = $this->loadCheckionCubeVersion($this->versions['ioncube']) == true;

		$data['json_lib'] = function_exists("json_encode") == true;
		
		$data['memory_limit_current'] = ini_get("memory_limit");
		$data['memory_limit_recommend'] = $this->others['memory_limit'];
		$data['directorys_to_write'] = $dirs_error;

		if($_GET['do'] == "check")
		{
			$compatible = true;

			if(!$data['mssql_extension'])
				$compatible = false;

			if(!$data['curl_extension'])
				$compatible = false;

			/*if(!$data['sockets_extension'])
				$compatible = false;*/

			if(!$data['gd_extension'])
				$compatible = false;

			if(!$data['php_version'])
				$compatible = false;

			if(!$data['ioncube_version'])
				$compatible = false;

			if(!$data['json_lib'])
				$compatible = false;

			if(count($dirs_error) > 0)
				$compatible = false;

			if($compatible == true)
			{
				$this->session->SetSession("sections", array("requirements" => true));
				$this->session->EndSession($session_string);

				return $this->nextSection($session_string);
			}
			else
			{
				$GLOBALS['error_message'] = TRUE;
			}
		}

		$GLOBALS['requirements'] = $data;
	}
	/**
	 *	Section Content
	 *
	 *	@param	&string	Content variable
	 *	@return	string
	*/
	public function content(&$content = NULL)
	{
		$this->lang->loadLanguageFile("requirements");
		$this->output->setTitles($this->lang->words['Requirements']['HTML'], $this->lang->words['Requirements']['Step']);
		return $content = array("type" => "section", "section" => "requirements");
	}
	/**
	 *	Private: Check ionCube Version
	 *
	 *	@param	string	ionCube minimum version
	 *	@return	boolean
	*/
	private function loadCheckionCubeVersion($version)
	{
		if(function_exists("ioncube_loader_iversion"))
		{
			$ic_iversion = ioncube_loader_iversion();
			$ic_version = sprintf("%d.%d.%d", $ic_iversion / 10000, ($ic_iversion / 100) % 100, $ic_iversion % 100);
			
			return version_compare($ic_version, $version, ">=");
		}
		else
		{
			return "0.0.0";
		}
	}
}

$section = new Install_Requirements();