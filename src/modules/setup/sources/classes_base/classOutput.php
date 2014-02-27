<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Command Output
 * Last Update: 24/04/2013 - 18:33h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTMCommand_Output
{
	private $classCore		= NULL;
	private $classSection	= NULL;
	private $loadedCaches	= array();
	private $content		= array();
	
	/**
	 *	Registry class
	 *
	 *	@return	void
	*/
	public function registry()
	{
		require_once(CTM_SETUP_PATH."cache/output/skin_core.php");
		$this->classCore = $_skin_core_class;
		
		if(CTM_SETUP_MODE != "default")
		{
			require_once(CTM_SETUP_PATH."cache/output/skin_".CTM_SETUP_MODE.".php");
			$this->classSection = $_skin_section_class;
		}
	}
	/**
	 *	Set Titles
	 *
	 *	@param	string	Title tag
	 *	@param	string	Current step
	 *	@return	void
	*/
	public function setTitles($tag, $step)
	{
		$GLOBALS['html_title'] = $tag;
		$GLOBALS['sidebar']['current_step'] = $step;
	}
	/**
	 *	Load section content
	 *
	 *	@param	string	Skin key
	 *	@param	string	Skin type (core or section)
	 *	@return	string	Skin content
	*/
	public function loadContent($skin_key, $skin_type = "core")
	{
		if(method_exists($skin_type == "section" ? $this->classSection : $this->classCore, $skin_key))
		{
			$class = $skin_type == "section" ? $this->classSection : $this->classCore;
			$content = $class->{$skin_key}();
		}
		else
		{
			$content = NULL;
		}

		return $content;
	}
	/**
	 *	Return Full Content
	 *
	 *	@param	array	Skin cache
	 *	@return	string	Skin content
	*/
	public function returnFullContent($skin_cache)
	{
		$global = $this->loadContent("global_header", "core");
		$content = $this->loadContent($skin_cache['section'], $skin_cache['type']);
			
		return str_replace("{#SETUP_CONTENT#}", $content, $global);
	}
}