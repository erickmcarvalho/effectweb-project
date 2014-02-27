<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Controller: Command Registry
 * Last Update: 14/12/2012 - 16:32h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

require_once(CTM_ROOT_PATH."modules/sources/classes/base/classOutput.php");
require_once(CTM_ROOT_PATH."modules/sources/classes/base/classLanguage.php");
require_once(CTM_ROOT_PATH."modules/sources/classes/base/classFunctions.php");
require_once(CTM_ROOT_PATH."modules/sources/classes/base/classEmail.php");

class CTM_Registry
{
	const FRAMEWORK_KEY	= "f6bd9b20de75ab7752ed2e2064413360";
	
	public static $initdata			= array
	(
		"DEFAULT_APPLICATION" => DEFAULT_APPLICATION,
		"DEFAULT_APP_SECTION" => DEFAULT_APP_SECTION,
	);
	
	private static $settings		= array();
	private static $vars			= array();
	private static $setup			= array();
	private static $URLData			= array();
	private static $DB				= NULL;
	private static $output			= NULL;
	private static $lang			= NULL;
	private static $functions		= NULL;
	private static $email			= NULL;
	//private static $mailer		= NULL;
	
	/**
	 *	Init
	 *
	 *	@return	array
	*/
	public static function init()
	{
		global $CTM_SETTINGS;
		
		self::$settings = $CTM_SETTINGS;
		self::$URLData = CTM_URLEngine::URLData();

		self::$DB = new CTM_Driver();
		self::$output = new CTMCommand_Output();
		self::$lang = new CTMCommand_Language();
		self::$functions = new CTMCommand_Functions();
		self::$email = new CTMCommand_Email();
		
		self::$output->templateId = self::$settings['WEBPUBLIC']['DEFAULT']['TEMPLATE'];
		self::$lang->languageId = self::$settings['WEBPUBLIC']['DEFAULT']['LANGUAGE'];
		
		self::$output->template = self::$settings['WEBPUBLIC']['TEMPLATES'][self::$output->templateId][0];
		self::$lang->language = self::$settings['WEBPUBLIC']['LANGUAGES'][self::$lang->languageId][0];
		
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
	 *	Fetch URL Data
	 *
	 *	@return	array
	*/
	public static function fetchURLData()
	{
		return self::$URLData;
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
	 *	Fetch Email
	 *
	 *	@return	object
	*/
	public static function fetchEmail()
	{
		return self::$email;
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
	 *	Fetch Setup
	 *
	 *	@return	object
	*/
	public static function fetchSetup()
	{
		return self::$setup;
	}
	/**
	 *	Set Setup
	 *
	 *	@param	mixed	Key
	 *	@param	mixed	Value
	 *	@return	void
	*/
	public static function setSetup($key, $value)
	{
		self::$setup[$key] = $value;
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
	/**
	 *	Set Settings
	 *
	 *	@param	mixed	Key
	 *	@param	mixed	Value
	 *	@return	void
	*/
	public static function setSettings($key, $value)
	{
		if(strstr($key, ","))
		{
			$cut = explode(",", $key);
	
			if(count($cut) > 0)
				foreach($cut as $keys) $vars .= "['".$keys."']";
				
			eval("self::\$settings{$vars} = \$value;");
			return;
		}
		
		self::$vars[$key] = $value;
	}
}