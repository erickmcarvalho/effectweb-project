<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Application User Control Panel - Sources
 * Last Update: 24/05/2012 - 18:24h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

/*******************************************/
/* Error String Lines                      */
/* Compile lines of warning or/and errors  */
/*******************************************/
class UserPanel_Error
{
	/**
	 *	Error Lines
	 *
	 *	@access	public
	 *	@var	array
	*/
	public $error		= array();
	/**
	 *	Line Count
	 *
	 *	@access	public
	 *	@var	array => array(int Warning, int Error)
	*/
	public $count		= array(0,0);
	
	/**
	 *	Init Class
	 *
	 *	@return	void
	*/
	public function initClass()
	{
		#void
	}
	/**
	 *	Add Error Line
	 *
	 *	@param	string	Error String
	 *	@param	integer	Type (0 = Warning, 1 = Error)
	 *	@return	void
	*/
	public function addError($error, $key = 0)
	{
		$this->error[$key][$this->count[$key]++] = "&raquo; {$error}<br />\n";
	}
	/**
	 *	Show Error
	 *
	 *	@param	integer	Type (0 = Warning, 1 = Error)
	 *	@return	string	Error String
	*/
	public function showError($key = 0)
	{
		$return = NULL;
		
		foreach($this->error[$key] as $error) 
			$return .= $error;
			
		$this->clearError($key);
		return $return;
	}
	/**
	 *	Private: Clear Error
	 *
	 *	@param	integer	Type (0 = Warning, 1 = Error, -1 = All)
	 *	@return	void
	*/
	private function clearError($key = -1)
	{
		if($key >= 0)
		{
			$this->error[$key] = array();
			$this->count[$key] = array();
		}
		else
		{
			$this->error = array();
			$this->count = array(0,0);
		}
	}
}