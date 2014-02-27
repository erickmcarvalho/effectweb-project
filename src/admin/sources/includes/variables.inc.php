<?php
/**
 * Cetemaster Services
 * Effect Web 2 - Admin Control Panel
 *
 * Extension variables
 * Last Update: 04/05/2013 - 23:18h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

$acp_version_history = array
(
	"10000" => array
	(
		"show" => "v1.0",
		"version" => "1.0.0",
		"build" => "1.0.0.0",
	),
);

$acp_modules_name = array
(
	"core" => array
	(
		"system" => "System",
		"members" => "Members",
		"server" => "Server",
	),
);

define("ACP_THIS_VERSION", "10000");
define("ACP_REAL_VERSION", $acp_version_history[ACP_THIS_VERSION]['version']);
define("ACP_PUBLIC_VERSION", $acp_version_history[ACP_THIS_VERSION]['show']);
define("ACP_BUILD_VERSION", $acp_version_history[ACP_THIS_VERSION]['build']);