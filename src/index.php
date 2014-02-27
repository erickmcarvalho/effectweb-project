<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Gateway index.php file
 * Last Update: 19/08/2012 - 14:56h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

define("IN_CTM_MODULE", TRUE);
define("CTM_MODULE_KEY", "bf6654d3");
define("CTM_SYSTEM_NAME", "EffectWeb");
define("CTM_ROOT_AREA", "public");

require_once("initdata.php");
require_once(CTM_ROOT_PATH."modules/showLoad.php");
require_once(CTM_ROOT_PATH."modules/sources/ctmCommand.php");
require_once(CTM_ROOT_PATH."modules/sources/ctmRegistry.php");
require_once(CTM_ROOT_PATH."modules/sources/ctmController.php");
require_once(CTM_ROOT_PATH."modules/sources/ctmExtensions.php");

CTM_Controller::initNow();
exit();