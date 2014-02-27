<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Controller: Command Email
 * Last Update: 14/12/2012 - 16:32h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTMCommand_Email extends CTM_Command
{
	/**
	 *	Arguments
	 *
	 *	@access	public
	 *	@var	array
	*/
	public $arguments	= array();
	/**
	 *	Template content
	 *
	 *	@access	private
	 *	@var	string
	*/
	private $template	= NULL;
	
	/**
	 *	Construct class
	 *
	 *	@return	void
	*/
	public function __construct()
	{
		$this->registry();
	}
	/**
	 *	Load Email template
	 *
	 *	@param	string	Template name
	 *	@return	void
	*/
	public function LoadTemplate($template)
	{
		$this->lang->loadLanguageFile("emailcontent");
		$this->template = $template;
	}
	/**
	 *	Get E-Mail Content
	 *
	 *	@param	&string	E-Mail content
	 *	@return	void
	*/
	public function GetMailContent(&$returnContent = array())
	{
		$lang_words = $this->lang->words;
		
		if($this->template)
		{
			require_once(CTM_CACHE_PATH."mail_cache/content/".$this->lang->language.".php");
			
			if($EMAIL_CONTENT[$this->template])
			{
				$mailContent = $EMAIL_CONTENT[$this->template]['Content'];
				foreach($this->arguments as $key => $value)
					$mailContent = str_replace("<#".$key."#>", $value, $mailContent);
				
				require_once(CTM_CACHE_PATH."mail_cache/emailTemplate.php");
				return $returnContent = array("subject" => $EMAIL_CONTENT[$this->template]['Subject'], "content" => $emailTemplate);
			}
		}
		
		$this->arguments = array();
		$this->template = NULL;
	}
}