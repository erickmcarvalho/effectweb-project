<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Init File - Sets up globals
 * Last Update: 09/04/2012 - 02:23h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

//---------------------------------------------------------------
// USER CONFIGURATIONS: CUSTOM SETTINGS
//---------------------------------------------------------------

/*
 * SESSION_NAME
 *
 * The name of the PHP session
*/
define("SESSION_NAME", "Fa2e9Zd23B37");

/*
 * ADMINCP_DIRECTORY
 *
 * The name of the AdminCP directory
*/
define("ADMINCP_DIRECTORY", "admin");

/*
 * PUBLIC_DIRECTORY
 *
 * The name of the public directory
*/
define("PUBLIC_DIRECTORY", "public");

/*
 * DEFAULT_APPLICATION
 *
 * Default application name
*/
define("DEFAULT_APPLICATION", "CTM.EffectWeb");

/*
 * DEFAULT_APP_SESCTION
 *
 * Default section name of default application
*/
define("DEFAULT_APP_SECTION", "home");

/*
 * HTACCESS_FRIEND_URL
 *
 * Use .htaccess friend URL
 * URL example: www.yourboard.com/$1/$2/[...]
*/
define("HTACCESS_FRIEND_URL", FALSE);

//---------------------------------------------------------------
// USER CONFIGURATIONS: MAIN PATHS
//---------------------------------------------------------------

/*
 * CTM_ROOT_PATH
 *
 * The root path directory
*/
define("CTM_ROOT_PATH", str_replace("\\", "/", dirname(__FILE__))."/");

/*
 * CTM_PUBLIC_PATH
 *
 * The public path directory
*/
define("CTM_PUBLIC_PATH", CTM_ROOT_PATH.PUBLIC_DIRECTORY."/");

/*
 * CTM_ADMINCP_PATH
 *
 * The AdminCP path directory
*/
define("CTM_ADMINCP_PATH", CTM_ROOT_PATH.ADMINCP_DIRECTORY."/");

//---------------------------------------------------------------
// ADVANCED CONFIGURATIONS: DEBUG
//---------------------------------------------------------------

/*
 * SYSTEM DEBUG
 *
 * Can capture system logs to a file (control/Logs/Debug)
 * Recomended only in system tests
*/
define("CTM_SYSTEM_DEBUG", TRUE);

/*
 * SERVER DEBUG
 *
 * Can show the php errors in user display
 * Recomended only in system tests
*/
define("CTM_SERVER_DEBUG", TRUE);

/*
 * ERROR CAPTURE
 *
 * Can capture php errors to a file (control/Logs/ServerError)
 * This is recomended only SERVER DEBUG disabled
*/
define("CTM_ERROR_CAPTURE", TRUE);

/*
 * SQL DEBUG MODE
 *
 * Can capture sql errors to a file (control/Logs/{DRIVER})
 * This is recomended only SYSTEM DEBUG disabled
 * Example: define("CTM_SQL_DEBUG_MODE", "mssql,mysql");
 * Disable: define("CTM_SQL_DEBUG_MODE", FALSE);
*/
define("CTM_SQL_DEBUG_MODE", "mssql,mysql");

/*
 * MAILER DEBUG MODE
 * Can capture mailer errors to a file (control/Logs/Mailer)
 * Recomended only in system tests
*/
define("CTM_MAILER_DEBUG_MODE", TRUE);

//---------------------------------------------------------------
// ADVANCED CONFIGURATIONS: ADMINCP
//---------------------------------------------------------------

/*
 * ACP USE ZIP
 * Compress the extract files in GZIP or ZIP
 * Set "gzip" or "zip" or "none"
 * Default is "gzip"
*/
define("CTM_ACP_USE_ZIP", "zip");

//--------------------------------------------------------------------------
// XX NOTHING USER CONFIGURABLE XX NOTHING USER CONFIGURABLE XX
//--------------------------------------------------------------------------

/*
 * PHP Session and Output Buffering
*/
ob_start();
session_name(SESSION_NAME);
session_start();

/*
 * Exception error handler
 *
 * @param	string	Error Message
 * @return	void
*/
function ctm_exception_error($error)
{
	header("Content-type: text/plain");
	print "CTM ERROR: ";
	print $error;
	exit();
}