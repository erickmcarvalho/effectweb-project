<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Profile and search
 * Last Update: 05/09/2013 - 01:45h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Profile extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		if($this->URLData[1] == "char" || strlen($_GET['char']) > 0)
		{
			require_once(THIS_APPLICATION_PATH."modules/profile/profile_char.php");
			$showProfile = new CTM_EffectWeb_Profile();
			$showProfile->registry();
			$showProfile->init();
		}
		elseif($this->URLData[1] == "guild" || strlen($_GET['guild']) > 0)
		{
			require_once(THIS_APPLICATION_PATH."modules/profile/profile_guild.php");
			$showProfile = new CTM_EffectWeb_Profile();
			$showProfile->registry();
			$showProfile->init();
		}
		else
		{
			require_once(THIS_APPLICATION_PATH."modules/profile/search.php");
			$search = new CTM_EffectWeb_Profile();
			$search->registry();
			$search->init();
		}
	}
}