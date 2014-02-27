<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: Members Control
 * Last Update: 19/09/2012 - 17:42h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_Members extends CTM_ACPCommand
{
	private $classes_loaded	= array();
	
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->output->loadSkinCache("core_members", true);

		if($this->checkPermission("applications", "core", true))
		{
			$this->lang->loadLanguageFile("members");
			
			switch($_GET['section'])
			{
				case "accounts" :
					if($this->CheckPermissionModule("accounts") == true)
					{
						$this->LoadModule("Accounts")->initSection();
					}
				break;
				case "characters" :
					if($this->CheckPermissionModule("characters") == true)
					{
						$this->LoadModule("Characters")->initSection();
					}
				break;
				case "team" :
					if($this->CheckPermissionModule("team") == true)
					{
						$this->LoadModule("Team")->initSection();
					}
				break;
				default :
					$this->output->loadSkinCache("core_members", true);
					$this->output->setContent("members_home");
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
		return $this->checkPermission("modules", "core_members_".$module_name, $not_block == false);
	}
	/**
	 *	Protected: Check Permission - Item
	 *
	 *	@param	string	Module name
	 *	@param	boolean	Not block
	 *	@return	boolean
	*/
	protected function CheckPermissionItem($item_name, $not_block = FALSE)
	{
		return $this->checkPermission("items", "core_members_".$item_name,  $not_block == false);
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
			require_once(CTM_ADMINCP_PATH."modules/api_core/members/".strtolower($module_name).".php");
			
			$module_name = "Core_Admin_Members_".$module_name;
			$this->classes_loaded[$module_name] = new $module_name();
			$this->classes_loaded[$module_name]->registry();
		}
		
		return $this->classes_loaded[$module_name];
	}
}