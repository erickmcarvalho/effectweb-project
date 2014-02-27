<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Application Global Modules
 * Last Update: 15/04/2012 - 18:05h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Global extends CTM_EWCore
{
	public function init()
	{
		switch($_GET['section'])
		{
			case "login" :
				$this->loadModuleLogin();
			break;
			case "sysinfo" :
				$this->loadSystemInformation();
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
		
		if(empty($_REQUEST['referer'])) $GLOBALS['referer'] = "?";
		$this->output->loadSkinCache("others", "global_login");
	}
	/**
	 *	Global: System Information
	 *
	 *	@return	void
	*/
	private function loadSystemInformation()
	{
		$license_name = SERVER_NAME;
		$license_address = preg_replace("/(www\.|:.*)/i", NULL, $_SERVER['HTTP_HOST']);
		$url = CTM_URLEngine::URLBase();

		echo <<<HTML
<div align="center" style="width: 350px">
	<a href="http://www.cetemaster.com.br" target="_blank"><img src="{$rl}admin/skin_cp/images/logo.png" border="0" /></a><br />
	<a href="http://www.cetemaster.com.br" target="_blank">www.cetemaster.com.br</a> / <a href="http://www.cetemaster.com" target="_blank">www.cetemaster.com</a><br /><br />
    <strong style="color:rgb(6, 62, 80);">Effect Web {$this->vars['web_version']}</strong><br />
    Suite and control developed by <strong style="color:rgb(6, 62, 80);">Erick-Master & Litlle</strong><br />
    Design and images developed by <strong style="color:rgb(6, 62, 80);">LucasHP</strong><br /><br />
    <strong style="color:rgb(6, 62, 80);">MuOnline Suite Software (2013)</strong><br />
    Licensed to: <strong>{$license_name} - {$license_address}</strong><br />
    This software is not a free distribution.<br /><br />
    <strong style="color:rgb(6, 62, 80);">Cetemaster Services, Limited</strong><br />
    Copyright (c) 2010-2013. All Rights Reserved,<br />
    <a href="http://www.cetemaster.com.br" target="_blank">www.cetemaster.com.br</a> / <a href="http://www.cetemaster.com" target="_blank">www.cetemaster.com</a>

</div>
HTML;
		exit();
	}
}