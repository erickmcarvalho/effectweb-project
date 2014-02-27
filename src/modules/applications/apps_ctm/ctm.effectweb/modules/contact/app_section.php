<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Application Contact Page
 * Last Update: 15/08/2012 - 23:18h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Contact extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->lang->loadLanguageFile("contact");
		$this->lang->setArguments("Contact,HeaderText", $this->settings['CONTACT']['ENABLE_PHONE'] == true ? 3 : 2);
		
		$this->output->loadSkinCache("contact", "contact");
	}
}