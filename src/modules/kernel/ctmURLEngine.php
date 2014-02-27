<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * CTM URL Engine: URL Parser
 * Author: $CTM['Erick-Master']
 * Last Update: 24/11/2012 - 19:32h
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

class CTM_URLEngine
{
	/**
	 *	URL Data Array
	 *
	 *	@var	array
	 *	@access	public
	*/
	public static $URLData	= array();
	/**
	 *	URL Base
	 *
	 *	@var	string
	 *	@access	public
	*/
	public static $URLBase	= NULL;
	
	/**
	 *	Get URL Data
	 *	Get and parse the URL vars from request
	 *
	 *	@param	&array	Return variable
	 *	@return	array
	*/
	public static function URLData(&$var = NULL)
	{
		$URI = str_replace(basename($_SERVER['PHP_SELF']), NULL, $_SERVER['PHP_SELF']);
		$URI = str_replace(substr($URI, 0, strlen($URL) - 1), NULL, $_SERVER['REQUEST_URI']);
		$URI = str_replace(basename($_SERVER['PHP_SELF']), NULL, $URI);
		$URL = $_SERVER['QUERY_STRING'];
	
		if(substr($URI, 0, 3) == "/?/") return $var = self::setURLData(explode("/", substr($URI, 3)));
		if(substr($URI, 0, 2) != "/?") return $var = self::setURLData(explode("/", substr($URI, 1)));
		if(substr($URL ,0 ,1) == "/") return $var = self::setURLData(explode("/", substr($URL, 1)));
	}
	/**
	 *	Get URL Base
	 *	Get the base from URL requested
	 *
	 *	@param	boolean	With basename
	 *	@return	string
	*/
	public static function URLBase($wirh_basename = FALSE)
	{
		if(!self::$URLBase)
		{
			$URLBase = strtolower($_SERVER['HTTPS']) == "on" ? "https" : "http";
			$URLBase .= "://";
			$URLBase .= $_SERVER['HTTP_HOST'];
			$URLBase .= str_replace(basename($_SERVER['PHP_SELF']), NULL, $_SERVER['PHP_SELF']);

			self::$URLBase = $URLBase;
		}
	
		return self::$URLBase.($with_basename == true ? basename($_SERVER['PHP_SELF']) : NULL);
	}
	/**
	 *	Get URL Host
	 *	Get the full URL host requested
	 *
	 *	@return	string
	*/
	public static function URLHost()
	{
		return "http".(strtolower($_SERVER['HTTPS']) == "on" ? "s" : NULL)."://".$_SERVER['HTTP_HOST'];
	}
	/**
	 *	Get URL String
	 *	Get the URL String from $_SERVER['REQUEST_URI'] or $_SERVER['QUERY_STRING']
	 *
	 *	@return	string
	*/
	public static function URIString()
	{
		return strlen($_SERVER['REQUEST_URI']) < 1 ? $_SERVER['QUERY_STRING'] : $_SERVER['REQUEST_URI'];
	}
	/**
	 *	Private: Set URL Data
	 *	Set the URL data
	 *
	 *	@param	array	URL Data
	 *	@return	array
	*/
	private static function setURLData($data)
	{
		self::$URLData = $data;
		return $data;
	}
}