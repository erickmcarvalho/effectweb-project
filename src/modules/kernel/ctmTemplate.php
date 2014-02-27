<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Template Engine Library
 * Author: $CTM['Erick-Master']
 * Last Update: 29/08/2012 - 20:49h
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

class CTM_Template extends CTM_Framework
{
	private static $settings	= array();
	private static $librarys	= array();
	
	/**
	 *	Library Factory
	 *
	 *	@param	array	Lib Settings
	 *	@return	void
	*/
	public static function libraryFactory($settings)
	{
		self::$settings = $settings;
	}
	/**
	 *	Call Class Library
	 *
	 *	@param	string	Lib name
	 *	@return	class
	*/
	public static function Lib($name)
	{
		if(self::checkLibrary($name, self::$settings[$name]))
			return self::loadLibrary($name);
	}
	/**
	 *	Private: Check Library
	 *
	 *	@param	string	Lib name
	 *	@param	array	Lib settings
	 *	@return	boolean
	*/
	private static function checkLibrary($library, $settings = array())
	{
		$lib = strtolower($library);
		
		if(!self::$librarys[$lib])
		{
			if(file_exists(self::LibGetRealPath(self::TEMPLATE_ENGINE_LIB_FOLDER).$lib.".lib.php"))
			{
				$library = "TemplateEngine_".$library;
				require_once(self::LibGetRealPath(self::TEMPLATE_ENGINE_LIB_FOLDER).$lib.".lib.php");
				
				self::$librarys[$lib] = new $library();
				self::$librarys[$lib]->LibFactory($settings);
				
				return true;
			}
			
			return false;
		}
		
		return true;
	}
	/**
	 *	Private: Load Library
	 *
	 *	@param	string	Lib name
	 *	@return	class
	*/
	private static function loadLibrary($library)
	{
		$lib = strtolower($library);
		return self::$librarys[$lib];
	}
}