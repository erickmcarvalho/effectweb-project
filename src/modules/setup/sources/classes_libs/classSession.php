<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Library - Session
 * Last Update: 24/04/2013 - 18:33h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Installer_Session extends CTM_Command
{
	private $session	= array();
	private $crypt_key	= "b4127515610e3722ee1dc1f5e58f8249";

	/**
	 *	Class constructor
	 *
	 *	@return	void
	*/
	public function __construct()
	{
		$this->registry();
	}
	/**
	 *	Start Session
	 *
	 *	@return	string
	*/
	public function StartSession($session_string)
	{
		$this->session = unserialize(CTM_Crypt::Lib('Base64')->Decode($session_string, $this->crypt_key));
	}
	/**
	 *	Get Session
	 *
	 *	@param	mixed	Session key
	 *	@param	&array	Session returned
	 *	@return	array
	*/
	public function GetSession($key, &$return = array())
	{
		return $return = $this->session[$key];
	}
	/**
	 *	Set Session
	 *
	 *	@param	string	Session key
	 *	@param	array	Session content
	 *	@return boolean
	*/
	public function SetSession($key, $value)
	{
		$this->session[$key] = $value;
	}
	/**
	 *	End Session
	 *
	 *	@param	&string	Session encoded
	 *	@return	string
	*/
	public function EndSession(&$encoded = NULL)
	{
		$encoded = CTM_Crypt::Lib('Base64')->Encode(serialize($this->session), $this->crypt_key);
		$this->session = array();

		return $encoded;
	}
}