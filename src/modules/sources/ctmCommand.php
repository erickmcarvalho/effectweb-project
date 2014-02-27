<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Controller: Command Interface
 * Last Update: 14/12/2012 - 16:32h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_Command
{
	protected $settings			= array();
	protected $setup			= array();
	protected $vars				= array();
	protected $URLData			= array();
	protected $output			= NULL;
	protected $lang				= NULL;
	protected $functions		= NULL;
	protected $email			= NULL;
	protected $mailer			= NULL;
	protected $DB				= NULL;
	
	private static $instance	= NULL;
	
	/**
	 *	Registry instance
	 *
	 *	@return	void
	*/
	public function registry()
	{
		$this->settings = CTM_Registry::fetchSettings();
		$this->vars = CTM_Registry::fetchVariables();
		$this->output = CTM_Registry::fetchOutput();
		$this->lang = CTM_Registry::fetchLanguage();
		$this->functions = CTM_Registry::fetchFunctions();
		$this->email = CTM_Registry::fetchEmail();
		$this->mailer = $GLOBALS['CTM_Mailer'];
		$this->DB = CTM_Registry::fetchDriver();
		$this->URLData = CTM_Registry::fetchURLData();
	}
	/**
	 *	Update Vars
	 *
	 *	@param	mixed	Key
	 *	@param	mixed	Value
	 *	@return	void
	*/
	protected function updateVars($key, $value)
	{
		$this->vars[$key] = $value;
		CTM_Registry::setVars($key, $value);
	}
	/**
	 *	Update Settings
	 *
	 *	@param	mixed	Key
	 *	@param	mixed	Value
	 *	@return	void
	*/
	protected function updateSettings($key, $value)
	{
		$this->settings[$key] = $value;
		CTM_Registry::setSettings($key, $value);
	}
	/**
	 *	Get Database class
	 *
	 *	@return	object
	*/
	protected static function DB()
	{
		return !self::instance()->DB ? false : self::instance()->DB;
	}
	/**
	 *	Get Mu Library class
	 *
	 *	@param	string	Library
	 *	@return	object
	*/
	protected function MuLib($lib)
	{
		return CTM_MuOnline::Lib($lib);
	}
	/**
	 *	Get self instance
	 *
	 *	@return	object
	*/
	protected static function instance()
	{
		if(!self::$instance)
			self::$instance = new self();
			
		return self::$instance;
	}
	/**
	 *	Get self $this
	 *
	 *	@return	object
	*/
	protected function this()
	{
		return $this;
	}
}