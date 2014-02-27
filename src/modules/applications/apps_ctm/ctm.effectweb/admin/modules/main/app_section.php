<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Effect Web: Main Control
 * Last Update: 10/09/2012 - 16:52h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Admin_Main extends CTM_ACPCommand
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->output->loadSkinCache("main", true);
		$this->lang->loadLanguageFile("main");
		
		switch($_GET['section'])
		{
			case "notices" :
				if($this->CheckPermissionModule("main") == true)
				{
					$this->LoadModule("Notices")->initSection();
				}
			break;
			case "polls" :
				if($this->CheckPermissionModule("polls") == true)
				{
					$this->LoadModule("Polls")->initSection();
				}
			break;
			default :
				$this->output->setContent("main_home");
			break;
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
		return $this->checkPermission("modules", "effectweb_main_".$module_name, $not_block == false);
	}
	/**
	 *	Protected: Check Permission - Item
	 *
	 *	@param	string	Module name
	 *	@return	boolean
	*/
	protected function CheckPermissionItem($item_name)
	{
		return $this->checkPermission("items", "effectweb_main_".$item_name, false);
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
			require_once(THIS_APPLICATION_PATH."admin/modules/main/".strtolower($module_name).".php");
			
			$module_name = "CTM_EffectWeb_Admin_Main_".$module_name;
			$this->classes_loaded[$module_name] = new $module_name();
			$this->classes_loaded[$module_name]->registry();
		}
		
		return $this->classes_loaded[$module_name];
	}
}