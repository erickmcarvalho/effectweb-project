<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Extensions
 * Last Update: 24/04/2013 - 18:33h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

define("CTM_SETUP_PATH", CTM_ROOT_PATH."modules/setup/");

interface Installer
{
	const DefaultDBHost	= "127.0.0.1";
	const DefaultDBPort	= 1433;
	const DefaultDBUser	= "sa";
	const DefaultDBPass	= NULL;
	const DefaultDBName	= "EffectWeb";
}