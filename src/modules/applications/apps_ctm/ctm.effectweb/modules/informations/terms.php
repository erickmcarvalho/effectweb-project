<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Informations Page - Server Terms
 * Last Update: 07/05/2012 - 22:10h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Infos_ServerTerms extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		$open_terms = file_get_contents(CTM_CACHE_PATH."terms_cache/".$this->lang->language.".txt");
		
		if(!$open_terms) $GLOBALS['load_terms'] = FALSE;
		else $GLOBALS['load_terms'] = htmlspecialchars_decode(htmlentities($open_terms));
		
		$this->output->loadSkinCache("informations", "serverTerms");
		if($_GET['only']) $this->output->noSetCache(true);
	}
}