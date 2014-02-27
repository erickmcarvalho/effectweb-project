<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Cryptography: Base64
 * Author: $CTM['Erick-Master']
 * Last Update: 14/12/2012 - 01:32h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Cryptography_Base64 extends CTM_Crypt
{
	private static $base64Mask = '0123456789%!@*&%\\"$';

	/**
	 *	Library Factory
	 *	Set up a library setting
	 *
	 *	@param	array	Library Settings
	 *	@return	void
	*/
	public function LibFactory($settings)
	{
		//self::$settings = $settings;
	}
	/**
	 *	Encode String
	 *	Encode the string
	 *
	 *	@param	string	String
	 *	@param	mixed	Mark
	 *	@return	string
	*/
	public function Encode($string, $mask = NULL)
	{
		$encodedStr = NULL;
		$mask = md5((string)(!is_null($mask) ? $mask : self::$base64Mask));
			
		for($i = 0; $i < strlen($string); $i++)
			$encodedStr .= $string{$i} ^ $mask{ ($i % 32) };
			
		return base64_encode($encodedStr);
	}
	/**
	 *	Decode String
	 *	Decode the string
	 *
	 *	@param	string	String
	 *	@param	mixed	Mark
	 *	@return	string
	*/
	public function Decode($string, $mask = NULL)
	{
		$string = base64_decode($string);
		$decodedStr = NULL;
		$mask = md5((string)(!is_null($mask) ? $mask : self::$base64Mask));
		
		for($i = 0; $i < strlen($string); $i++)
			$decodedStr .= $string{$i} ^ $mask{ ($i % 32) };
			
		return $decodedStr;
	}
}