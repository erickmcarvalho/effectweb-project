<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Effect Web: Financial - Invoices
 * Last Update: 04/03/2013 - 17:34h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Admin_Financial_Invoices extends CTM_EffectWeb_Admin_Financial
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{		
		switch($_GET['do'])
		{
			case "view" :
				$this->LoadModule("View")->initSection();
			break;
			default :
				$this->LoadModule("All")->initSection();
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
		return $this->checkPermission("modules", "effectweb_financial_invoices_".$module_name, $not_block == false);
	}
	/**
	 *	Protected: Check Permission - Item
	 *
	 *	@param	string	Module name
	 *	@return	boolean
	*/
	protected function CheckPermissionItem($item_name)
	{
		return $this->checkPermission("items", "effectweb_financial_invoices_".$item_name, false);
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
			require_once(THIS_APPLICATION_PATH."admin/modules/financial/invoices/".strtolower($module_name).".php");
			
			$module_name = "CTM_EffectWeb_Admin_Financial_Invoices_".$module_name;
			$this->classes_loaded[$module_name] = new $module_name();
			$this->classes_loaded[$module_name]->registry();
		}
		
		return $this->classes_loaded[$module_name];
	}
}