<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: System Control - Board
 * Last Update: 30/12/2012 - 00:29h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_System_Board extends Core_Admin_System
{
	/**
	 *	Init module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		if(in_array(USER_ACCOUNT, $this->settings['ADMINCONTROLPANEL']['SYSTEM_MANAGER']))
		{
			switch($_GET['index'])
			{
				case "license" :
					$this->loadControlLicense();
				break;
			}
		}
		else
		{
			define("ACP_PERMISSION_ACCESS_ERROR", 1);
		}
	}
}