<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: System Control
 * Last Update: 15/04/2012 - 18:05h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_System extends CTM_ACPCommand
{
	private $classes_loaded	= array();
	
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->output->loadSkinCache("core_system", true);
		
		if($this->checkPermission("applications", "core", true))
		{
			$this->lang->loadLanguageFile("system");
			
			switch($_GET['section'])
			{
				case "cronjob" :
					if($this->CheckPermissionModule("cronjob") == true)
					{
						$this->LoadModule("CronJob")->initSection();
					}
				break;
				case "board" :
					$this->LoadModule("Board")->initSection();
				break;
				case "templates" :
					if($this->CheckPermissionModule("templates") == true)
					{
						$this->LoadModule("Templates")->initSection();
					}
				break;
				case "analysis" :
					if($this->CheckPermissionModule("analysis") == true)
					{
						$this->LoadModule("Analysis")->initSection();
					}
				break;
				case "sysinfo" :
					$this->LoadModule("SysInfo")->initSection();
				break;
				default :
					$this->LoadModule("Home")->initSection();
					$this->output->setContent("system_home");
				break;
			}	
		}
	}
	/**
	 *	Protected: Check Permission - Module
	 *
	 *	@param	string	Module name
	 *	@param	boolean	Not block
	 *	@return	boolean
	*/
	protected function CheckPermissionModule($module_name, $not_block = FALSE)
	{
		return $this->checkPermission("modules", "core_system_".$module_name, $not_block == false);
	}
	/**
	 *	Protected: Check Permission - Item
	 *
	 *	@param	string	Module name
	 *	@return	boolean
	*/
	protected function CheckPermissionItem($item_name)
	{
		return $this->checkPermisison("items", "core_system_".$item_name, false);
	}
	/**
	 *	Protected: Load Module
	 *
	 *	@param	string	Module name
	 *	@return	void
	*/
	protected function LoadModule($module_name)
	{
		if(!$this->classes_loaded[$module_name])
		{
			$module_name = str_replace(array(".", "-"), "_", $module_name);
			require_once(CTM_ADMINCP_PATH."modules/api_core/system/".strtolower($module_name).".php");
			
			$module_name = "Core_Admin_System_".$module_name;
			$this->classes_loaded[$module_name] = new $module_name();
			$this->classes_loaded[$module_name]->registry();
		}
		
		return $this->classes_loaded[$module_name];
	}
}