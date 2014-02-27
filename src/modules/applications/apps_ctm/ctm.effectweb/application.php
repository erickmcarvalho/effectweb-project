<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Application: [Core] CTM Effect Web
 * Last Update: 05/09/2013 - 01:44h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb extends CTM_Command
{
	/**
	 *	Application Name
	 *
	 *	@access	private
	 *	@var	string	Application Name
	*/
	private static $appName		= "CTM.EffectWeb";
	/**
	 *	Application Folder
	 *
	 *	@access	private
	 *	@var	string	Application Directory
	*/
	private static $appFolder	= "apps_ctm/ctm.effectweb";
	
	/**
	 *	Init Application
	 *
	 *	@return	void
	*/
	public function init($section = "*DEFAULT*", $load = "app_section.php")
	{
		global $appsCache;
		self::loadSources();
		
		$CTM_EWGeneral = new CTM_EWGeneral();
		$EW_Modules = new EW_Modules();
		
		$EW_Modules->loadPublicModules();
		$page = $_POST['pag'] ? $_GET['pag'] : $_GET['module'];
		
		if($page && !CTM_Dashboard::APP_ModuleExists($page))
			return $this->output->loadSkinCache("server", "404_error");
		elseif($_GET['ajax'])
			$controller = "Ajax";
		elseif($page)
			$controller = $page;
		elseif($section != "*DEFAULT*")
			$controller = $section;
		else
			$controller = $appsCache['core']['section'];
		
		$CTM_EWGeneral->init();
		CTM_Dashboard::LoadAPPModule($controller, $load);
	}
	/**
	 *	Load Source Files
	 *
	 *	@return	void
	*/
	private static function loadSources()
	{
		require_once(CTM_APPLICATION_PATH.self::$appFolder."/sources/classes/ew.core.class.php");
		require_once(CTM_APPLICATION_PATH.self::$appFolder."/sources/classes/ew.modules.class.php");
		require_once(CTM_APPLICATION_PATH.self::$appFolder."/sources/classes/ew.general.class.php");
	}
}