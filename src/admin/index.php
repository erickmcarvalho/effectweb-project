<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
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
define("CTM_ROOT_AREA", "admin");

require_once("../initdata.php");
require_once(CTM_ROOT_PATH."modules/sources/ctmCommand.php");
require_once(CTM_ROOT_PATH."modules/sources/ctmRegistry.php");
require_once(CTM_ROOT_PATH."modules/sources/ctmController.php");
require_once(CTM_ROOT_PATH."modules/sources/ctmExtensions.php");

require_once(CTM_ADMINCP_PATH."modules/api_base/acp_registry.php");
require_once(CTM_ADMINCP_PATH."modules/api_base/acp_command.php");
require_once(CTM_ADMINCP_PATH."modules/api_core.php");

require_once(CTM_ADMINCP_PATH."sources/acp_extensions.php");

CTM_Controller::initNow();
exit();