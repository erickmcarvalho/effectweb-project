<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Controller: Command Language
 * Last Update: 14/12/2012 - 16:32h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTMCommand_Language
{
	public $words			= array();
	public $language		= "en_US";
	public $languageId		= 0;

	private $loadedLangs	= array();
	
	/**
	 *	Set Template Key
	 *
	 *	@param	string	Set language
	 *	@return	void
	*/
	public function setLanguage($language)
	{
		$this->language = $language;
	}
	/**
	 *	Load Language Files
	 *
	 *	@param	string|array	File(s)
	 *	@param	boolean			Force Reload
	 *	@return	void
	*/
	public function loadLanguageFile($files, $app = CTM_BOARD_APP, $forceReload = FALSE)
	{
		$app = strtolower($app) == "core" && CTM_ROOT_AREA == "admin" ? "admin_core" : strtolower($app);
		
		if($forceReload == true)
			$this->words = array();
			
		if(is_string($files))
		{
			if(!in_array($app."::".$files, $this->loadedLangs))
			{
				if(file_exists(CTM_CACHE_PATH."lang_cache/".$this->language."/".$app."/".CTM_ROOT_AREA."_".$files.".php"))
				{
					require_once(CTM_CACHE_PATH."lang_cache/".$this->language."/".$app."/".CTM_ROOT_AREA."_".$files.".php");
					$this->words = array_merge($this->words, $CTM_LANG);
					$this->loadedLangs[] = $app."::".$files;
				}
				else
				{
					CTM_Controller::DebugLog("Can not to open the language cache {".CTM_ROOT_AREA."::".$files."}");
				}
			}
		}
		else
		{
			foreach($files as $file)
			{
				if(!in_array($app."::".$file, $this->loadedLangs))
				{
					if(file_exists(CTM_CACHE_PATH."lang_file/".$this->language."/".$app."/".CTM_ROOT_AREA."_".$file.".php"))
					{
						require_once(CTM_CACHE_PATH."lang_file/".$this->language."/".$app."/".CTM_ROOT_AREA."_".$file.".php");
						$this->words = array_merge($this->words, $CTM_LANG);
						$this->loadedLangs[] = $app."::".$file;
					}
					else
					{
						CTM_Controller::DebugLog("Can not to open the language cache {".CTM_ROOT_AREA."::".$file."}");
					}
				}
			}
		}
	}
	/**
	 *	Set Arguments
	 *
	 *	@param	string	Word - Use "," to set array keys
	 *	@param	string	Argument
	 *	@param	string	[...]
	 *	@return	void
	*/
	public function setArguments()
	{
		$arguments = func_get_args();
		$word = $arguments[0];
		array_shift($arguments);
		
		if(strstr($word, ","))
		{
			$cut = explode(",", $word);
	
			if(count($cut) > 0)
				foreach($cut as $keys)
					$vars .= "['".$keys."']";
				
			eval("\$this->words{$vars} = vsprintf(\$this->words{$vars}, \$arguments);");
			return;
		}
		
		if($this->words[$word])
		{
			$this->words[$word] = vsprintf($this->words[$word], $arguments);
		}
	}
	/**
	 *	Set Arguments Tags
	 *
	 *	@param	string	Word - Use "," to set array keys
	 *	@param	string	Argument
	 *	@param	string	[...]
	 *	@return	void
	*/
	public function setTags()
	{
		$arguments = func_get_args();
		$word = $arguments[0];
		array_shift($arguments);
		
		$vars = "['".$word."']";
		if(strstr($word, ","))
		{
			$cut = explode(",", $word);
			$vars = NULL;
	
			if(count($cut) > 0)
				foreach($cut as $keys) $vars .= "['".$keys."']";
		}
		
		eval("
		for(\$i = 1; \$i <= sizeof(\$arguments); \$i++)
			if(strstr(\$this->words{$vars}, '$'.\$i))
				\$this->words{$vars} = str_replace('$'.\$i, \$arguments[\$i - 1], \$this->words{$vars});");
		
		if($this->words[$word])
		{
			for($i = 1; $i <= sizeof($arguments); $i++)
			{
				if(strstr($this->words[$word], '$'.$i))
				{
					$this->words[$word] = str_replace('$'.$i, $arguments[$i - 1], $this->words[$word]);
				}
			}
		}
	}
	/**
	 *	Set Arguments Parameters
	 *
	 *	@param	string	Word - Use "," to set array keys
	 *	@param	string	Argument
	 *	@param	string	[...]
	 *	@return	void
	*/
	public function setParameters($word, $parameters = array())
	{
		foreach($parameters as $key => $value)
			if(strstr($this->words[$word], $key))
				$this->words[$word] = str_replace($key, $value, $this->words[$word]);
	}
}