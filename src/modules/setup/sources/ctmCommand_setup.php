<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Command Interface
 * Last Update: 24/04/2013 - 18:33h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_Command
{
	protected $settings			= array();
	protected $vars				= array();
	protected $output			= NULL;
	protected $lang				= NULL;
	protected $functions		= NULL;
	protected $email			= NULL;
	protected $DB				= NULL;
	protected $section			= 0;

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
		$this->DB = CTM_Registry::fetchDriver();
		$this->section = CTM_Registry::fetchSection();

		if(count(CTM_Registry::$libs) > 0)
			foreach(CTM_Registry::$libs as $key => $class)
				$this->{$key} = $class;
 	}
	/**
	 *	Load Library
	 *
	 *	@param	string	Library name
	 *	@return	void
	*/
	protected function loadLibrary($lib_name, $object)
	{
		if(file_exists(CTM_SETUP_PATH."sources/classes_libs/class".$lib_name.".php") && !array_key_exists($object, CTM_Registry::$libs))
		{
			$class_name = "Installer_".$lib_name;
			
			require_once(CTM_SETUP_PATH."sources/classes_libs/class".$lib_name.".php");
			CTM_Registry::$libs[$object] = new $class_name;

			$this->{$object} = CTM_Registry::$libs[$object];
		}
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
	 *	Get Database class
	 *
	 *	@return	object
	*/
	protected function DB()
	{
		return !self::instance()->DB ? false : self::instance()->DB;
	}
	/**
	 *	Get self instance
	 *
	 *	@return	object
	*/
	protected function instance()
	{
		if(!self::$instance)
			self::$instance = new self();
			
		return self::$instance;
	}

	/**
	 *	Next Section
	 *
	 *	@param	string	Setup session
	 *	@return	void
	*/
	protected function nextSection($session = false)
	{
		$next_section = $this->section + 1;
		$next_section = $next_section >= $this->vars['max_sections'] ? $this->vars['max_sections'] : $next_section;

		$_SESSION['SETUP_SECTION'] = $next_section;
		$_SESSION['SETUP_SESSION'] = $session;
		header("Location: ?app=".CTM_SETUP_MODE."&section=".$next_section);
		exit();
	}
	/**
	 *	Show Message
	 *
	 *	@param	string	Message text
	 *	@param	string	Message type (atention / error / info / success)
	 *	@return	string
	*/
	protected function showMessage($text, $type = "information")
	{
		return "<div class='".$type."'>".$text."</div>";
	}
}