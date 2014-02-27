<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Framework error
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

class CTM_Error
{
	/**
	 *	Show Driver Error
	 *	Break the script and show error
	 *
	 *	@param	string	SQL Error
	 *	@param	string	SQL Query (optional)
	 *	@return	void
	*/
	public static function driverError($message, $query = NULL)
	{
		if(loadIsAjax() == true)
			exit(self::showSimpleError("Driver Error: ".$message));
			
		if(file_exists(CTM_CACHE_PATH."skin_cache/driverError.php"))
			require_once(CTM_CACHE_PATH."skin_cache/driverError.php");
		elseif(function_exists("ctm_exception_error"))
			ctm_exception_error($message);
		else
			throw new Exception($message);
			
		exit();
	}
	/**
	 *	Show Public Error
	 *	Break the script and show error
	 *
	 *	@param	string	Public Error
	 *	@param	string	Public Cache File (optional)
	 *	@return	void
	*/
	public static function publicError($message, $cache = NULL)
	{
		if(loadIsAjax() == true)
			exit(self::showSimpleError("Public Error: ".$message));
			
		if(file_exists(CTM_CACHE_PATH."skin_cache/publicError.php"))
			require_once(CTM_CACHE_PATH."skin_cache/publicError.php");
		elseif(function_exists("ctm_exception_error"))
			ctm_exception_error($message);
		else
			throw new Exception($message);
			
		exit();
	}
	/**
	 *	Show Kernel Error
	 *	Break the script and show error
	 *
	 *	@param	string	Kernel Error (optional)
	 *	@return	void
	*/
	public static function kernelError($message = NULL)
	{
		if(loadIsAjax() == true)
			exit(self::showSimpleError("Kernel Error: ".$message));
			
		if(file_exists(CTM_CACHE_PATH."skin_cache/kernelError.php"))
			require_once(CTM_CACHE_PATH."skin_cache/kernelError.php");
		elseif(function_exists("ctm_exception_error"))
			ctm_exception_error($message);
		else
			throw new Exception($message);
			
		exit();
	}
	/**
	 *	Show Simple Error
	 *	Return the simple error string
	 *
	 *	@param	string	Error message
	 *	@return	void
	*/
	public static function showSimpleError($message)
	{
		$begin = "<span style=\"border:1px dashed #c00; color:#c00; background-color:#ffebe8;\">";
		$end = "</span>";
		return $begin.$message.$end;
	}
}