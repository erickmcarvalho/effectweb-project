<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Command Registry
 * Last Update: 24/04/2013 - 18:33h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

require_once(CTM_SETUP_PATH."sources/classes_base/classOutput.php");
require_once(CTM_SETUP_PATH."sources/classes_base/classLanguage.php");
require_once(CTM_SETUP_PATH."sources/classes_base/classFunctions.php");

class CTM_Registry
{
	const FRAMEWORK_KEY	= "f6bd9b20de75ab7752ed2e2064413360";

	public static $libs				= array();
	private static $settings		= array();
	private static $vars			= array();
	private static $DB				= NULL;
	private static $output			= NULL;
	private static $lang			= NULL;
	private static $functions		= NULL;

	/**
	 *	Init
	 *
	 *	@return	array
	*/
	public static function init()
	{
		global $CTM_SETTINGS;
		
		self::$settings = $CTM_SETTINGS;

		self::$DB = new CTM_Driver();
		self::$output = new CTMCommand_Output();
		self::$lang = new CTMCommand_Language();
		self::$functions = new CTMCommand_Functions();
		
		if(count($GLOBALS['_POST']) > 0)
		{
			foreach($GLOBALS['_POST'] as $key => $value)
			{
				$GLOBALS['_POST'][$key] = stripslashes($value);
			}
		}
	}
	/**
	 *	Fetch Settings
	 *
	 *	@return	array
	*/
	public static function fetchSettings()
	{
		return self::$settings;
	}
	/**
	 *	Fetch Variables
	 *
	 *	@return	array
	*/
	public static function fetchVariables()
	{
		return self::$vars;
	}
	/**
	 *	Fetch Output
	 *
	 *	@return	object
	*/
	public static function fetchOutput()
	{
		return self::$output;
	}
	/**
	 *	Fetch Language
	 *
	 *	@return	object
	*/
	public static function fetchLanguage()
	{
		return self::$lang;
	}
	/**
	 *	Fetch Functions
	 *
	 *	@return	object
	*/
	public static function fetchFunctions()
	{
		return self::$functions;
	}
	/**
	 *	Fetch Driver
	 *
	 *	@return	object
	*/
	public static function fetchDriver()
	{
		return self::$DB;
	}
	/**
	 *	Fetch Section
	 *
	 *	@return	integer
	*/
	public static function fetchSection()
	{
		return self::$vars['section'];
	}
	/**
	 *	Set Variable
	 *
	 *	@param	mixed	Key
	 *	@param	mixed	Value
	 *	@return	void
	*/
	public static function setVars($key, $value)
	{
		if(strstr($key, ","))
		{
			$cut = explode(",", $key);
	
			if(count($cut) > 0)
				foreach($cut as $keys) $vars .= "['".$keys."']";
				
			eval("self::\$vars{$vars} = \$value;");
			return;
		}
		
		self::$vars[$key] = $value;
	}
}