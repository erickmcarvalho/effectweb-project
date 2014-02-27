<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Brute Cryptography
 * Author: $CTM['Erick-Master']
 * Last Update: 17/07/2012 - 15:16h
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

class CTM_Crypt extends CTM_Framework
{
	private static $settings	= array();
	private static $librarys	= array();
	private static $count_lib	= 0;
	
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
		if(($lib = self::checkLibrary($name, self::$settings[$name])) > -1)
			return self::loadLibrary($lib);
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
		
		if(file_exists(self::LibGetRealPath(self::CRYPT_LIB_FOLDER).$lib.".lib.php"))
		{
			$library = "Cryptography_".$library;
			require_once(self::LibGetRealPath(self::CRYPT_LIB_FOLDER).$lib.".lib.php");
				
			$num = self::$count_lib++;
			self::$librarys[$num] = new $library();
			self::$librarys[$num]->LibFactory($settings);
				
			return $num;
		}
		
		return -1;
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