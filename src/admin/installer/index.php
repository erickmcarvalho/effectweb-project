<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Gateway file
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
define("CTM_ROOT_AREA", "setup");
define("CTM_SETUP_MODE", $_GET['app'] ? ($_GET['app'] == "upgrade" ? "upgrade" : ($_GET['app'] == "repair" ? "repair" : "install")) : "default");

require_once("../../initdata.php");
require_once(CTM_ROOT_PATH."cache/server_cache/db_php/core_sources/installation_info.php");
require_once(CTM_ROOT_PATH."modules/setup/sources/extensions/setup_sections.php");
require_once(CTM_ROOT_PATH."modules/setup/sources/extensions/setup_extensions.php");
require_once(CTM_ROOT_PATH."modules/setup/sources/ctmCommand_setup.php");
require_once(CTM_ROOT_PATH."modules/setup/sources/ctmRegistry_setup.php");
require_once(CTM_ROOT_PATH."modules/setup/sources/ctmController_setup.php");
require_once(CTM_ROOT_PATH."modules/sources/ctmExtensions.php");

CTM_Controller::initNow();
exit();