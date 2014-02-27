<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software Alpha 1
 * $PACKAGE['APP']: Core
 *
 * Redirect Page
 * Last update: 11/04/2012 - 00:09h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Redirect extends CTM_EWCore
{
	private $refererLink	= NULL;
	
	public function init()
	{
		$this->refererLink = !empty($_GET['referer']) ? urldecode($_GET['referer']) : CTM_URLEngine::URLBase();
		
		switch($_GET['do'])
		{
			case "loginSuccess" :
				$this->loadRedirectLoginSuccess();
			break;
			case "logoutSuccess" :
				$this->loadRedirectLogoutSuccess();
			break;
		}
		
		CTM_Template::closeOpen();
		CTM_Template::open("redirector");
	}
	/**
	 *	Redirect: Login Success
	 *
	 *	@return	void
	*/
	private function loadRedirectLoginSuccess()
	{
		CTM_Template::setTag("REDIRECT_TITLE", CTM_Language::Load("Redirector[LoginSuccess][Title]"));
		CTM_Template::setTag("REDIRECT_MESSAGE", NULL);
		CTM_Template::setTag("REDIRECT_REFERER", $this->refererLink);
	}
	/**
	 *	Redirect: Logout Success
	 *
	 *	@return	void
	*/
	private function loadRedirectLogoutSuccess()
	{
		CTM_Template::setTag("REDIRECT_TITLE", CTM_Language::Load("Redirector[LogoutSuccess][Title]"));
		CTM_Template::setTag("REDIRECT_MESSAGE", NULL);
		CTM_Template::setTag("REDIRECT_REFERER", $this->refererLink);
	}
}