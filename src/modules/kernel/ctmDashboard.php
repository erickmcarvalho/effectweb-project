<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Dashboard System
 * Author: $CTM['Erick-Master']
 * Last Update: 05/09/2013 - 01:45h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

if(CTM_Framework::CheckValues() == false)
{
	print "<h1>CTM Fatal Error</h1><hr>You do not have permission to use this API.";
	print "<hr><address>Cetemaster Framework - www.cetemaster.com</address>";
	exit();
}

class CTM_Dashboard extends CTM_Command
{
	public static $application		= NULL;
	private static $inApplication	= FALSE;
	
	/**
	 *	Start Dashboard
	 *
	 *	@return	void
	*/
	public static function init()
	{
		global $furlCache, $appsCache;
		
		if(!self::$inApplication)
		{
			if(CTM_ROOT_AREA == "admin")
			{
				$application = "Core";
				$section = "System";
				
				if($_GET['app'] && array_key_exists($_GET['app'], $appsCache))
				{
					$cache = $appsCache[$_GET['app']];
					$application = $cache['name'];
					$section = $cache['module'];
					
					define("CTM_BOARD_APP", $application);
					define("ACP_LOAD_MODULE", $section);
				}
				elseif($_GET['app'])
					return CTM_ACPBoard::output()->loadSkinCache("server")->application_failed();
			}
			else
			{
				$application = CTM_Registry::$initdata['DEFAULT_APPLICATION'];
				$section = CTM_Registry::$initdata['DEFAULT_APP_SECTION'];
				
				if(CTM_URLEngine::$URLData[0] && array_key_exists(CTM_URLEngine::$URLData[0], $furlCache))
				{
					$furl = $furlCache[CTM_URLEngine::$URLData[0]];
					
					$application = $appsCache[$furl['app']]['name'];
					$section = $furl['module'];
					$load = $furl['section'];
				}
				elseif($_GET['app'] && array_key_exists($_GET['app'], $appsCache))
				{
					$cache = $appsCache[$_GET['app']];
					$application = $cache['name'];
					$section = $cache['module'];
				}
				elseif($_GET['app'] && CTM_URLEngine::$URLData[0])
					return CTM_Controller::instance()->output->loadSkinCache("server", "applicationFailed");
			}
			
			
			CTM_Command::instance()->registry();
			CTM_Command::instance()->lang->loadLanguageFile("global", $application, false);
			
			if(CTM_ROOT_AREA == "admin")
			{
				if($application == "Core")
				{
					self::$application = "Core";
					define("CTM_BOARD_APP", "Core");
					define("ACP_LOAD_MODULE", $section);
					
					return;
				}
			}
			
			if(CTM_ROOT_AREA == "public")
			{
				$load = $load ? $load : "app_section.php";
				self::LoadApplication($application, $section, $load);
			}
		}
	}
	/**
	 *	Load Application
	 *
	 *	@param	string	Application
	 *	@param	string	Module
	 *	@return	void
	*/
	public static function LoadApplication($application, $section = "*DEFAULT*", $load = "app_section.php")
	{
		if(!self::$application || self::$application != $application)
		{
			$section = eregi_replace("[^a-zA-Z0-9_]", NULL, $section);
			self::$application = $application;
			
			require_once(CTM_APPLICATION_PATH."apps_ctm/".strtolower($application)."/".(CTM_ROOT_AREA == "admin" ? "admin/" : NULL)."application.php");
			$application = str_replace(array(".", "-"), "_", $application).(CTM_ROOT_AREA == "admin" ? "_Admin" : NULL);
			$application = new $application();
			
			self::$inApplication = TRUE;
			define("THIS_APPLICATION_PATH", CTM_APPLICATION_PATH."apps_ctm/".strtolower(self::$application)."/");
			define("CTM_BOARD_APP", self::$application); 
			
			$application->registry();
			$application->init($section, $load);
		}
	}
	/**
	 *	Load Application Module
	 *
	 *	@param	string	Module
	 *	@param	string	Section
	 *	@return	void
	*/
	public static function LoadAPPModule($module, $section = "app_section.php")
	{
		$acp = CTM_ROOT_AREA == "admin" ? "admin/" : NULL;
		$prefix = CTM_ROOT_AREA == "admin" ? "Admin_" : NULL;
		
		$section = substr($section, -4, 4) != ".php" ? $section.".php" : $section;
		
		if(self::$application == "Core" && CTM_ROOT_AREA == "admin")
			$module_path = CTM_ADMINCP_PATH."modules/api_core/".strtolower($module)."/".$section;
		else
			$module_path = THIS_APPLICATION_PATH.$acp."modules/".strtolower($module)."/".$section;
		
		if(file_exists($module_path))
		{
			require_once($module_path);
			$application = str_replace(array(".", "-"), "_", self::$application)."_".$prefix.str_replace(array(".", "-"), "_", $module);
			$application = new $application();
		
			$application->registry();
			$application->init();
		}
		
		return "MODULE_INVALID";
	}
	/**
	 *	Check Module Exists
	 *
	 *	@param	string	Module
	 *	@return	boolean
	*/
	public static function APP_ModuleExists($module)
	{
		$acp = CTM_ROOT_AREA == "admin" ? "admin/" : NULL;
		return file_exists(THIS_APPLICATION_PATH.$acp."modules/".strtolower($module)."/app_section.php");
	}
}