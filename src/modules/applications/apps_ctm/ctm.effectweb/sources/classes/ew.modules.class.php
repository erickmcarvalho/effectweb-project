<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Class: Effect Web Modules
 * Last Update: 15/08/2012 - 16:44h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class EW_Modules extends CTM_Command
{
	/**
	 *	Public Modules
	 *
	 *	@return	void
	*/
	public function loadPublicModules()
	{
		$this->registry();
		
		$templateId = FALSE;
		$languageId = FALSE;
		
		$template = FALSE;
		$language = FALSE;
		
		if(isset($_REQUEST['tpl']) && $this->settings['WEBPUBLIC']['SELECTOR']['TEMPLATES'] == true)
		{
			if(array_key_exists($_REQUEST['tpl'], $this->settings['WEBPUBLIC']['TEMPLATES']))
			{
				if(file_exists(CTM_CACHE_PATH."skin_cache/templates/".$this->settings['WEBPUBLIC']['TEMPLATES'][$_REQUEST['tpl']][0]."/"))
				{
					CTM_Cookies::setCookie("UserTemplate", $_REQUEST['tpl'], -1);
					$templateId = $_REQUEST['tpl'];
					$template = $this->settings['WEBPUBLIC']['TEMPLATES'][$_REQUEST['tpl']][0];
				}
			}
		}
		elseif(CTM_Cookies::GetCookie("UserTemplate"))
		{
			$loadTemplate = CTM_Cookies::GetCookie("UserTemplate");
			
			if(array_key_exists($loadTemplate, $this->settings['WEBPUBLIC']['TEMPLATES']))
			{
				if(file_exists(CTM_CACHE_PATH."skin_cache/templates/".$this->settings['WEBPUBLIC']['TEMPLATES'][$loadTemplate][0]."/"))
				{
					$templateId = $loadTemplate;
					$template = $this->settings['WEBPUBLIC']['TEMPLATES'][$loadTemplate][0];
				}
			}
		}
		
		if(isset($_REQUEST['lang']) && $this->settings['WEBPUBLIC']['SELECTOR']['LANGUAGES'] == true)
		{
			if(array_key_exists($_REQUEST['lang'], $this->settings['WEBPUBLIC']['LANGUAGES']))
			{
				if(file_exists(CTM_CACHE_PATH."skin_cache/".$this->settings['WEBPUBLIC']['LANGUAGES'][$_REQUEST['lang']][0]."/"))
				{
					CTM_Cookies::setCookie("UserLanguage", $_REQUEST['lang'], -1);
					$languageId = $_REQUEST['lang'];
					$language = $this->settings['WEBPUBLIC']['LANGUAGES'][$_REQUEST['lang']][0];
				}
			}
		}
		elseif(CTM_Cookies::GetCookie("UserLanguage"))
		{
			$loadLanguage = CTM_Cookies::GetCookie("UserLanguage");
			
			if(array_key_exists($loadTemplate, $this->settings['WEBPUBLIC']['LANGUAGES']))
			{
				if(file_exists(CTM_CACHE_PATH."lang_cache/".$this->settings['WEBPUBLIC']['LANGUAGES'][$loadLanguage][0]."/"))
				{
					$languageId = $loadLanguage;
					$language = $this->settings['WEBPUBLIC']['LANGUAGES'][$loadLanguage][0];
				}
			}
		}
		
		if(!(boolean)$template || !(boolean)$templateId)
		{
			CTM_Cookies::setCookie("UserTemplate", NULL);
			$templateId = $this->settings['WEBPUBLIC']['DEFAULT']['TEMPLATE'];
			$template = $this->settings['WEBPUBLIC']['TEMPLATES'][$templateId][0];
		}
		if(!(boolean)$language || !(boolean)$languageId)
		{
			CTM_Cookies::setCookie("UserLanguage", NULL);
			$languageId = $this->settings['WEBPUBLIC']['DEFAULT']['LANGUAGE'];
			$language = $this->settings['WEBPUBLIC']['LANGUAGES'][$languageId][0];
		}
		
		CTM_Command::instance()->output->setTemplate($template);
		CTM_Command::instance()->lang->setLanguage($language);
		
		define("CTM_TEMPLATE_SELECTED", $templateId);
		define("CTM_LANGUAGE_SELECTED", $languageId);
	}
}