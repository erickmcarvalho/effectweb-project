<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: Server Control
 * Last Update: 24/05/2013 - 23:21h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_Server extends CTM_ACPCommand
{
	private $classes_loaded	= array();
	
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->output->loadSkinCache("core_server", true);
		
		if($this->checkPermission("applications", "core", true))
		{
			$this->lang->loadLanguageFile("server");
			
			switch($_GET['section'])
			{
				case "gamecontrol" :
					if($this->CheckPermissionModule("gamecontrol") == true)
					{
						$this->LoadModule("GameControl")->initSection();
					}
				break;
				default :
					$this->output->loadSkinCache("core_server", true);
					$this->output->setContent("server_home");
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
		return $this->checkPermission("modules", "core_server_".$module_name, $not_block == false);
	}
	/**
	 *	Protected: Check Permission - Item
	 *
	 *	@param	string	Module name
	 *	@return	boolean
	*/
	protected function CheckPermissionItem($item_name)
	{
		return $this->checkPermisison("items", "core_server_".$item_name, false);
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
			require_once(CTM_ADMINCP_PATH."modules/api_core/server/".strtolower($module_name).".php");
			
			$module_name = "Core_Admin_Server_".$module_name;
			$this->classes_loaded[$module_name] = new $module_name();
			$this->classes_loaded[$module_name]->registry();
		}
		
		return $this->classes_loaded[$module_name];
	}
}