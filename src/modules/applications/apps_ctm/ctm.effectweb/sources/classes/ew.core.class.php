<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Class: Core Library
 * Last Update: 15/08/2012 - 16:44h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EWCore extends CTM_Command
{
	protected static $application	= "CTM.EffectWeb";
	
	/**
	 *	Get Default Page
	 *
	 *	@return	string
	*/
	protected function DefaultPage()
	{
		$URI = CTM_URLEngine::URIString();
		$URL = CTM_URLEngine::URLData();
		
		if(strpos($URI, "?page=") > 0) $URI = str_replace("?page=", "?pag=", $URI);
		elseif(count($URL) < 1) $URI = "?pag=home";
		
		return "<script>CTM.AjaxLoad('".$URI."','content');</script>";
	}
}