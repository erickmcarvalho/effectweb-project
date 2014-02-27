<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Application Global Modules
 * Last Update: 15/04/2012 - 18:05h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_Global extends CTM_ACPCommand
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		switch($_GET['section'])
		{
			case "login" :
				$this->loadModuleLogin();
			break;
		}
	}
	/**
	 *	Global Module: Login / Logout
	 *
	 *	@return void
	*/
	private function loadModuleLogin()
	{
		switch($_GET['do'])
		{
			case "process" :
				Authentication::LoginModule(true);
			break;
			case "logout" :
				return Authentication::LogoutModule();
			break;
			default :
				Authentication::LoginModule(false);
			break;
		}
		
		if(empty($_REQUEST['referer'])) 
			$GLOBALS['referer'] = "?";
		
		$this->output->loadSkinCache("core_global")->auth_login($GLOBALS['auth_login']['message']);
	}
}