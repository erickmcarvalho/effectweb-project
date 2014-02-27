<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Controller: Command Output
 * Last Update: 14/12/2012 - 16:32h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTMCommand_Output
{
	public $templateId		= 0;
	public $template		= NULL;

	private $noSetTemp		= FALSE;
	private $cacheClass		= array();
	private $loadedCaches	= array();
	private $content		= array();
	
	/**
	 *	Load Skin Cache
	 *
	 *	@param	string	Skin file
	 *	@param	string	Skin name
	 *	@param	boolean	Set Global Content
	 *	@param	string	Set Content
	 *	@return	string	Skin content
	*/
	public function loadSkinCache($category, $cache, $setGlobalContent = FALSE, $setContent = "subContent")
	{
		if($this->noSetTemp == false)
		{
			if(file_exists(CTM_CACHE_PATH."skin_cache/templates/".$this->template."/skin_".$category.".php"))
			{
				if(!$this->loadedCaches[$category])
				{
					require_once(CTM_CACHE_PATH."skin_cache/templates/".$this->template."/skin_".$category.".php");
					$this->cacheClass[$category] = $callSkinCache;
					$this->loadedCaches[$category] = array();
				}
				
				if(method_exists($this->cacheClass[$category], $cache))
				{
					if(!in_array($cache, $this->loadedCaches[$category]))
						$this->loadedCaches[$category][$cache] = $this->cacheClass[$category]->{$cache}();
						
					$return = $this->loadedCaches[$category][$cache];
					return $this->content[$setGlobalContent == true ? 'global' : $setContent] = $return;
				}
			}
			else
			{
				CTM_Controller::DebugLog("Can not to open the skin cache {".$category."::".$cache."}");
			}
		}
	}
	/**
	 *	Set Skin Cache
	 *
	 *	@param	string	Category
	 *	@param	string	Cache
	 *	@param	string	Key name
	 *	@return	void
	*/
	public function setSkinCache($category, $cache, $name = "\$content")
	{
		$this->content[$name] = $this->loadSkilCache($category, $cache, false);
	}
	/**
	 *	Set Template Key
	 *
	 *	@param	string	Set template
	 *	@return	void
	*/
	public function setTemplate($template)
	{
		$this->template = $template;
	}
	/**
	 *	No Set Cache
	 *
	 *	@param	boolean	No Set Cache
	 *	@return	void
	*/
	public function noSetCache($boolean)
	{
		$this->noSetTemp = (boolean)$boolean;
	}
	/**
	 *	Return Content
	 *
	 *	@param	array	Replace
	 *	@param	string	Content
	 *	@return	string	Skin content
	*/
	public function returnContent($replace = FALSE, $content = "global")
	{
		$content = $this->content[$content];
		
		if($replace)
		{
			if(count($replace) > 1)
			{
				foreach($replace as $key => $value)
					if(strstr($content, $key))
						$content = str_replace($key, $value, $content);
			}
			else
				if(strstr($content, key($replace)))
					$content = str_replace(key($replace), $replace[key($replace)], $content);
		}
		
		$this->noSetCache(false);
		return $content;
	}
	/**
	 *	Return Full Content
	 *
	 *	@param	array	Replace
	 *	@return	string	Skin content
	*/
	public function returnFullContent($replace = FALSE)
	{
		if(!$this->content['global'])
			$content = "subContent";
		else
			$content = "global";
			
		return $this->returnContent($replace, $content);
	}
	/**
	 *	Show Error
	 *
	 *	@param	string	Message
	 *	@return	void
	*/
	public function showError($message_error)
	{
		$GLOBALS['message_error'] = $message_error;
		
		$this->loadSkinCache("others", "error_page");
		//$this->noSetCache(true);
	}
	/**
	 *	Redirect Page
	 *
	 *	@param	string	Title
	 *	@param	string	Message
	 *	@param	string	Link referer
	 *	@return	void
	*/
	public function redirectPage($title, $message, $referer = "*")
	{
		if($referer == "*") $referer = CTM_URLEngine::URLBase();
		
		$GLOBALS['redirector']['title'] = $title;
		$GLOBALS['redirector']['message'] = $message;
		$GLOBALS['redirector']['referer'] = $referer;
		
		$this->loadSkinCache("others", "redirector", true);
		$this->noSetCache(true);
	}
}