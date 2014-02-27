<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Extension variables
 * Last Update: 19/07/2013 - 03:55h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

define("CTM_CACHE_PATH", CTM_ROOT_PATH."cache/");
define("CTM_CONTROL_PATH", CTM_ROOT_PATH."control/");
define("CTM_KERNEL_PATH", CTM_ROOT_PATH."modules/kernel/");
define("CTM_SOURCES_PATH", CTM_ROOT_PATH."modules/sources/");
define("CTM_APPLICATION_PATH", CTM_ROOT_PATH."modules/applications/");

require_once(CTM_CONTROL_PATH."Settings.php");
require_once(CTM_ROOT_PATH."modules/extensions/furlCache.php");
require_once(CTM_ROOT_PATH."modules/extensions/appsCache.php");
require_once(CTM_ROOT_PATH."modules/extensions/versionHistory.php");
require_once(CTM_ROOT_PATH."modules/sources/includes/uploadify.inc.php");
require_once(CTM_ROOT_PATH."modules/sources/includes/security.inc.php");
require_once(CTM_ROOT_PATH."modules/sources/includes/interfaces.inc.php");
require_once(CTM_ROOT_PATH."modules/sources/includes/variables.inc.php");
require_once(CTM_ROOT_PATH."modules/sources/includes/autoload.inc.php");
require_once(CTM_ROOT_PATH."modules/sources/includes/functions.inc.php");
require_once(CTM_ROOT_PATH."modules/sources/classes/CronJob.php");
require_once((CTM_ROOT_AREA == "admin" ? CTM_ADMINCP_PATH : CTM_ROOT_PATH."modules/")."sources/classes/Authentication.php");

if(EW_SECURITY_CHEKING != md5("Cetemaster EffectWeb (c) 2012"))
{
	print "<h1>CTM Fatal Error</h1><hr>You do not have permission to use this API.";
	print "<hr><address>Cetemaster Effect Web v2.x - www.cetemaster.com</address>";
	exit();
}

define("EW_THIS_VERSION", "20007");
define("EW_REAL_VERSION", $versionHistory[EW_THIS_VERSION]['version']);
define("EW_PUBLIC_VERSION", $versionHistory[EW_THIS_VERSION]['show']);
define("EW_BUILD_VERSION", $versionHistory[EW_THIS_VERSION]['build']);
define("EW_LOG_PATH", CTM_CONTROL_PATH."Logs/");
define("EW_LOG_EXT", ".log");

define("CTM_DEVELOPER_MODE", FALSE);
define("CTM_INVENTORY_SIZE", MUSERVER_VERSION > 2 ? (MUSERVER_VERSION >= 9 ? 3456 : 1728) : (MUSERVER_VERSION == 1 ? 1080 : 760));
define("CTM_SKILL_SIZE", MUSERVER_VERSION > 1 ? 180 : 60);

CTM_Framework::Start();
Uploadify::run();

if(CTM_ROOT_AREA == "public" || CTM_ROOT_AREA == "admin" || CTM_ROOT_AREA == "setup")
{
	$muSettings['Item']['Database'] = MUGEN_CORE;
	$muSettings['Item']['dbVersion'] = MUSERVER_VERSION >= 3 ? (MUSERVER_VERSION >= 9 ? 3 : 2) : (MUSERVER_VERSION == 2 ? 1 : 0);
	$muSettings['Item']['SocketSystem'] = SERVER_FILES == 2 ? 2 : (MUSERVER_VERSION >= 6 ? 1 : 0);
	$muSettings['Item']['Files']['Database'] = CTM_CONTROL_PATH."Data/Items/Item.txt";
	$muSettings['Item']['Files']['DefineItems'] = CTM_CONTROL_PATH."Data/Items/DefineItems.ini";
	$muSettings['Item']['Files']['InfoStrings'] = CTM_CONTROL_PATH."Data/Items/ItemOptions.txt";
	$muSettings['Item']['Files']['ExcellentOptions'] = CTM_CONTROL_PATH."Data/Items/ExcellentOptions.txt";
	$muSettings['Item']['Files']['JewelOfHarmony'] = CTM_CONTROL_PATH."Data/Items/JewelOfHarmony.txt";
	$muSettings['Item']['Files']['SocketSystem'] = CTM_CONTROL_PATH."Data/Items/SocketSystem.txt";
	$muSettings['Quest']['Database'] = MUGEN_CORE;
	$muSettings['Quest']['Files']['Database'] = CTM_CONTROL_PATH."Data/QuestData.txt";
	$muSettings['JoinServer']['JoinServer'] = SERVER_FILES == 0 ? "XT" : "WZ";
	$muSettings['JoinServer']['JSHost'] = $CTM_SETTINGS['JOINSERVER']['CONNECTION']['HOST'];
	$muSettings['JoinServer']['JSPort'] = $CTM_SETTINGS['JOINSERVER']['CONNECTION']['PORT'];
	$muSettings['JoinServer']['Timeout'] = $CTM_SETTINGS['JOINSERVER']['CONNECTION']['TIMEOUT'];
	$fileSettings['ReadScript']['SerializePath'] = CTM_CACHE_PATH."server_cache/db_scripts/";
	$fileSettings['ReadScript']['HashFilesPath'] = "hash_files.txt";
	$skinSettings['Database']['SystemName'] = "Effect Web ".EW_REAL_VERSION;
	$skinSettings['Database']['DatabaseDir'] = CTM_CACHE_PATH."server_cache/db_php/skin_sources/";
	$skinSettings['Sources']['SystemName'] = "Effect Web ".EW_REAL_VERSION;
	$skinSettings['Sources']['CodeKeyCryptKey'] = "h+C$/AY#p2kmU90%";
	$skinSettings['Sources']['DatabaseDir'] = CTM_CACHE_PATH."server_cache/db_php/skin_sources/skin_sources.php";
	$skinSettings['Logic']['SystemName'] = "Effect Web ".EW_REAL_VERSION;
	$skinSettings['ImportExport']['SystemName'] = "Effect Web Template Engine";
	$skinSettings['ImportExport']['Version'] = EW_BUILD_VERSION;
	$skinSettings['ImportExport']['XMLCryptKey'] = "z7RvS82*#M2+tpu+";
	$skinSettings['ImportExport']['CodeKeyCryptKey'] = "h+C$/AY#p2kmU90%";
	$skinSettings['ImportExport']['CodeKeyVars'][0] = array();
	
	CTM_MuOnline::libraryFactory($muSettings);
	CTM_FileManage::libraryFactory($fileSettings);
	CTM_Template::libraryFactory($skinSettings);
	
	$CTM_Mailer = new CTM_Mailer();
	$CTM_Mailer->LibFactory();
	$CTM_Mailer->SendMethod = $CTM_SETTINGS['MAILER']['TYPE'];
	$CTM_Mailer->Debug = CTM_MAILER_DEBUG_MODE;
	$CTM_Mailer->FromMail = array($CTM_SETTINGS['MAILER']['FROM'], SERVER_NAME);
	$CTM_Mailer->LogPath = EW_LOG_PATH."Mailer/";
	
	if($CTM_SETTINGS['MAILER']['TYPE'] == 1)
	{
		$CTM_Mailer->SMTPHost = $CTM_SETTINGS['MAILER']['SMTP']['HOST'];
		$CTM_Mailer->SMTPPort = $CTM_SETTINGS['MAILER']['SMTP']['PORT'];
		$CTM_Mailer->SMTPUser = $CTM_SETTINGS['MAILER']['SMTP']['USER'];
		$CTM_Mailer->SMTPPass = $CTM_SETTINGS['MAILER']['SMTP']['PASS'];
		$CTM_Mailer->SMTPHelo = $CTM_SETTINGS['MAILER']['SMTP']['HELO'];
		$CTM_Mailer->SMTPSecure = $CTM_SETTINGS['MAILER']['SMTP']['SECURE'];
	}
}