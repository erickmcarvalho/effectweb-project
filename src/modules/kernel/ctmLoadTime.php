<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Script loading time count
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

class CTM_LoadTime
{
	private static $times 	= array();
	private static $current	= 0;
	
	/**
	 *	Start Count
	 *	Start count and return the resource
	 *
	 *	@return	resource
	*/
	public static function startTime()
	{
		$identification = self::$current++;
		self::$times[$identification] = explode(" ", microtime());
		self::$times[$identification] = self::$times[$identification][1] + self::$times[$identification][0];
		
		return "Resource #".$identification;
	}
	/**
	 *	Result Time
	 *	End the count and return the result
	 *
	 *	@param	mixed	Identification (Default -> 0)
	 *	@return	string	Time result
	*/
	public static function resultTime($identification = 0)
	{
		$identification = str_replace("Resource #", NULL, $identification);
		
		if(array_key_exists($identification, self::$times))
		{
			$startTime = self::$times[$identification];
			$endTime = explode(" ", microtime());
			$endTime = $endTime[1] + $endTime[0];
			
			self::$times[$identification] = FALSE;
			
			return (float)substr($endTime - $startTime, 0, 5);
		}
		
		return "Error";
	}
}