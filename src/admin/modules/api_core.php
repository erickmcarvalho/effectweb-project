<?php
/**
 * Cetemaster Services
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP: Application Core
 * Last Update: 19/08/2012 - 15:08h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_ACPBoard extends CTM_ACPCommand
{
	private static $output_class	= NULL;
	public static $output_content	= NULL;
	public static $output_method	= NULL;
	public static $output_vars		= array();
	
	/**
	 *	Init ACP Board
	 *
	 *	@return	void
	*/
	public static function init($core_module = NULL)
	{
		self::acp_instance()->registry();
		self::start($core_module);
		self::setup($core_module);
		
		$skin_global = self::output()->loadSkinCache("core_global", false);
		
		if(ACP_SESSION_LOGGED == TRUE)
		{
			self::instance()->lang->loadLanguageFile("header", "Core");
			self::instance()->lang->setArguments("Header,Footer,LoadTime", CTM_LoadTime::resultTime());

			if(!self::$output_content)
				self::$output_content = $skin_global;
			
			$skin_global->registry();
			self::$output_content->registry();

			if(ACP_PERMISSION_ACCESS_ERROR == 1)
				$output_content = $skin_global->permission_error();
			elseif(ACP_PERMISSION_LICENSE_ERROR == 1)
				$output_content = $skin_global->module_unavailable();
			elseif(method_exists(self::$output_content, self::$output_method))
				$output_content = self::$output_content->{self::$output_method}();

			if(method_exists(self::$output_content, "core_global_sidebar"))
				$output_sidebar = self::$output_content->core_global_sidebar();
			else
				$output_sidebar = NULL;
			
			if(loadIsAjax() == true)
				print $output_content;
			else
				print $skin_global->global_header($output_content, $output_sidebar);
		}
		else
		{
			self::instance()->lang->loadLanguageFile("auth", "Core");
			$skin_global->registry();
			
			print $skin_global->auth_login($GLOBALS['auth_login']['message']);
		}
		
		print "\r\n<!-- Effect Web 2 :: Admin Control Panel ".ACP_PUBLIC_VERSION." / Powered by Erick-Master & Litlle / (c) 2012 - www.cetemaster.com.br [Licensed to: ".SERVER_NAME."] -->";
	}
	/**
	 *	Call output class
	 *
	 *	@return	class	CTMACPBoard_Output
	*/
	public static function output()
	{
		if(!self::$output_class)
			self::$output_class = new CTMACPBoard_Output();
			
		return self::$output_class;
	}
	/**
	 *	Private: Setup AdminCP
	 *
	 *	@return	void
	*/
	private static function setup($core_module)
	{
		global $appsCache, $acp_modules_name;
		
		$app = $_GET['app'] ? $_GET['app'] : "core";
		
		if($_GET['module'])
			$core_module = $acp_modules_name[$app][$_GET['module']];
		elseif($core_module == "*DEFAULT*" || !$core_module)
			$core_module = $appsCache['core']['module'];

		if(!$core_module)
			$core_module = "API Error";
			
		$app_title = $appsCache[$app]['title'];
		
		self::acp_instance()->updateACPVars("title", "Effect Web 2 ".(!ACP_SESSION_LOGGED ? "AdminCP: Log In" : "> ".$app_title." > ".$core_module));
		self::acp_instance()->updateACPVars("acp_url", CTM_URLEngine::URLBase());
		self::acp_instance()->updateACPVars("root_url", str_replace(ADMINCP_DIRECTORY."/", NULL, CTM_URLEngine::URLBase()));
		self::acp_instance()->updateACPVars("current_url", CTM_URLEngine::URLHost().CTM_URLEngine::URIString());
		self::acp_instance()->updateACPVars("ctm_name", CTM_Framework::LIBINFO_DEVELOPER_NAME);
		self::acp_instance()->updateACPVars("ctm_addr", CTM_Framework::LIBINFO_DEVELOPER_ADDR);
		self::acp_instance()->updateACPVars("ctm_mail", CTM_Framework::LIBINFO_DEVELOPER_MAIL);
		self::acp_instance()->updateACPVars("ctm_year", CTM_Framework::LIBINFO_DEVELOPER_YEAR);
	}
	/**
	 *	Private: Start AdminCP
	 *
	 *	@return	void
	*/
	private static function start($core_module = "*DEFAULT*")
	{
		self::instance()->lang->loadLanguageFile("global", "Core");
		
		if(!ACP_SESSION_LOGGED)
		{
			CTM_Dashboard::LoadAPPModule("global");
		}
		elseif(CTM_BOARD_APP == "Core")
		{
			global $appsCache;
		
			if($_GET['ajax'])
				$controller = "Ajax";
			elseif($_GET['module'])
				$controller = $_GET['module'];
			elseif($core_module != "*DEFAULT*" && $core_module)
				$controller = $core_module;
			else
				$controller = $appsCache['core']['module'];
				
			CTM_Dashboard::LoadAPPModule($controller);
		}
		else
		{
			CTM_Dashboard::LoadApplication(CTM_BOARD_APP, ACP_LOAD_MODULE);

			if(file_exists(THIS_APPLICATION_PATH."admin/variables/acp_modules_name.php"))
			{
				require_once(THIS_APPLICATION_PATH."admin/variables/acp_modules_name.php");
				$GLOBALS['acp_modules_name'] = array_merge($GLOBALS['acp_modules_name'], $_acp_modules_name);
			}
		}
	}
}

class CTMACPBoard_Output
{
	/**
	 *	Load Skin Cache
	 *
	 *	@param	string	Category file name
	 *	@return	class	$callSkinCache
	*/
	public function loadSkinCache($category, $set_skin_cache = TRUE)
	{
		if(CTM_ACPRegistry::$output_vars['no_set_temp'] == false)
		{
			$path = substr($category, 0, 5) == "core_" ? CTM_ADMINCP_PATH."modules/api_skin/" : THIS_APPLICATION_PATH."admin/skin_cp/cp_skin_";
			
			if(file_exists($path.$category.".php"))
			{
				if(!CTM_ACPRegistry::$output_vars['cache_class'][$category])
				{
					require($path.$category.".php");
					CTM_ACPRegistry::$output_vars['cache_class'][$category] = $callSkinCache;
				}
				
				if($set_skin_cache == true)
					return CTM_ACPBoard::$output_content = CTM_ACPRegistry::$output_vars['cache_class'][$category];
				else
					return CTM_ACPRegistry::$output_vars['cache_class'][$category];
			}
			else
			{
				//exit('failed');
			}
		}
	}
	/**
	 *	Set content method
	 *
	 *	@param	string	Method name
	 *	@return	void
	*/
	public function setContent($method_name)
	{
		//if(CTM_ACPBoard::$output_content)
		//	if(method_exists(CTM_ACPBoard::$output_content, $method_name))
				return CTM_ACPBoard::$output_method = $method_name;
				
		return false;
	}
	/**
	 *	Set global skin variable
	 *
	 *	@param	string	Var name
	 *	@param	string	Var value
	 *	@return	void
	*/
	public function setVariable($key, $value)
	{
		CTM_ACPBoard::$output_vars[$key] = $value;
	}
	/**
	 *	Redirect page
	 *
	 *	@param	string	Title
	 *	@param	string	Message
	 *	@param	string	Referer link
	 *	@return	void
	*/
	public function redirectPage($title, $message, $referer = "*")
	{
		if($referer == "*") $referer = CTM_URLEngine::URLBase();
		
		exit(self::loadSkinCache("core_global")->global_redirect($title, $message, $referer));
	}
}