<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * CTM Cookie Parser
 * Author: $CTM['Erick-Master']
 * Last Update: 18/05/2012 - 14:42h
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

class CTM_Cookies
{
	/**
	 *	Name prefix
	 *	Default -> NULL
	 *
	 *	@var	string
	 *	@access	public
	*/
	public static $prefix		= NULL;
	/**
	 *	Cookie path
	 *	Default -> /
	 *
	 *	@var	string
	 *	@access	public
	*/
	public static $cookiePath	= "/";
	/**
	 *	Cookie domain
	 *	Default -> NULL
	 *
	 *	@var	string
	 *	@access	public
	*/
	public static $cookieDomain	= NULL;
	
	/**
	 *	Set Cookie
	 *	Set the cookie in browser
	 *
	 *	@param	string	Cookie name
	 *	@param	string	Cookie value
	 *	@param	integer	TimeStamp expiration (Set -1 to infinity or 0 to default)
	 *	@return	void
	*/	
	public static function SetCookie($name, $value, $time = 0)
	{
		self::checkValues();
		
		if(is_array($value)) $value = serialize($value);
		if($time == -1) $time = time() + 60 * 60 * 24 * 365;
		
		@setcookie(self::$prefix.$name, $value, $time, self::$cookiePath, self::$cookieDomain);
	}
	/**
	 *	Get Cookie Value
	 *	Get the value from cookie
	 *
	 *	@param	string	Cookie name
	 *	@return	mixed
	*/
	public static function GetCookie($name)
	{
		self::checkValues();
		
		if(isset($_COOKIE[self::$prefix.str_replace(".", "_", $name)]))
		{
			$value = $_COOKIE[self::$prefix.str_replace(".", "_", $name)];
			
			if(substr($value, 0, 2) == "a:")
				return sql_escape(unserialize(stripslashes(urldecode($value))));
			else
				return sql_escape(stripslashes(urldecode($value)));
		}
		else return FALSE;
	}
	/**
	 *	Private: Check Values
	 *	Check the class values
	 *
	 *	@return	void
	*/
	private static function checkValues()
	{
		if(empty(self::$cookiePath))
			self::$cookiePath = "/";
	}
}