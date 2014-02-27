<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Global Framework Class
 * Author: $CTM['Erick-Master']
 * Last Update: 18/05/2012 - 14:42h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_Framework implements CetemasterFrameworkInterface
{
	private static $validKey		= "4360c9eef1a87548e903e2a1de81cf0e";
	private static $moduleKey		= "f6e12ba851b3f0ce00f9756495ecf57c";
	private static $started			= FALSE;

	private static $global_paths	= array
	(
		"{ROOT_PATH}" => CTM_ROOT_PATH,
		"{KERNEL_PATH}" => CTM_KERNEL_PATH,
		"{SOURCES_PATH}" => CTM_SOURCES_PATH,
		"{CACHE_PATH}" => CTM_CACHE_PATH
	);
	
	/**
	 *	Start Framework
	 *
	 *	@return	void
	*/
	public static function Start()
	{
		self::$started = TRUE;
	}
	/**
	 *	Check Framework
	 *
	 *	@return	void
	*/
	public static function CheckValues()
	{
		return md5(self::GLOBAL_FRAMEWORK_KEY) == self::$validKey && self::$started == true && defined("IN_CTM_MODULE") && md5(CTM_MODULE_KEY."%%%%%%%%7474747") == self::$moduleKey;
	}
	/**
	 *	Protected: Driver Class
	 *
	 *	@return	void
	*/
	protected static function Driver()
	{
		if(CTM_Registry::fetchDriver())
			return CTM_Registry::fetchDriver();
		
		$class = new CTM_Driver();
		return $class;
	}
	/**
	 *	Protected: Get Log Path
	 *
	 *	@param	string	Log path
	 *	@param	boolean	Return extension (default -> true)
	 *	@return	void
	*/
	protected static function LibGetLogPath($file_path, $extension = true)
	{
		return CTM_ROOT_PATH.str_replace(CTM_ROOT_PATH, NULL, self::GLOBAL_LOG_PATH).$file_path.($extension == true ? self::GLOBAL_LOG_EXTENSION : NULL);
	}
	/**
	 *	Protected: Get Real Path
	 *
	 *	@return	void
	*/
	protected static function LibGetRealPath($path)
	{
		return strtr($path, self::$global_paths);
	}
}