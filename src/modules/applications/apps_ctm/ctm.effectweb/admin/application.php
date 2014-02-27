<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Application: CTM Effect Web - Admin
 * Last Update: 10/09/2012 - 16:55h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Admin extends CTM_ACPCommand
{
	/**
	 *	Init Application
	 *
	 *	@return	void
	*/
	public function init($section = "*DEFAULT*")
	{
		if($this->checkPermission("applications", "effectweb", true))
		{
			global $appsCache;
			
			if($_GET['module'] && !CTM_Dashboard::APP_ModuleExists($_GET['module']))
				return $this->output->setContent("module_failed");
			elseif($_GET['module'])
				$controller = $_GET['module'];
			elseif($section != "*DEFAULT*")
				$controller = $section;
			else
				$controller = $appsCache['effectweb']['section'];
			
			CTM_Dashboard::LoadAPPModule($controller);
		}
	}
}