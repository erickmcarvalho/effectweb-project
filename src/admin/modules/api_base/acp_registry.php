<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP API: Registry
 * Last Update: 19/08/2012 - 15:08h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_ACPRegistry
{
	public static $acp_vars			= array();
	public static $member			= array();
	public static $output_vars		= array
	(
		"no_set_temp" => FALSE,
		"cache_class" => array(),
		"loaded_caches" => array(),
		"content" => array(),
	);
	
	/**
	 *	Fetch Variables
	 *
	 *	@return	array
	*/
	public static function fetchVariables()
	{
		return self::$acp_vars;
	}
	/**
	 *	Fetch Member
	 *
	 *	@return	array
	*/
	public static function fetchMember()
	{
		if(!self::$member)
			self::$member = Authentication::GetAuthData();
			
		return self::$member;
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
				
			eval("self::\$acp_vars{$vars} = \$value;");
			return;
		}
		
		self::$acp_vars[$key] = $value;
	}
}