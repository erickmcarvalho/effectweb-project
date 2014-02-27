<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Register
 * Last Update: 16/05/2012 - 11:18h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Register extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->lang->loadLanguageFile("register");
		
		switch($_GET['do'] ? $_GET['do'] : $this->URLData[1])
		{
			case "confirm" :
				require_once(THIS_APPLICATION_PATH."modules/register/confirm.php");
				$confirmAccount = new Register_ConfirmAccount();
				$confirmAccount->registry();
				$confirmAccount->initSection();
			break;
			default :
				require_once(THIS_APPLICATION_PATH."modules/register/register.php");
				$registerAccount = new Register_RegisterAccount();
				$registerAccount->registry();
				$registerAccount->initSection();
			break;
		}
	}
}