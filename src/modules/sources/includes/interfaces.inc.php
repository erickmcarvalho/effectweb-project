<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Extension includes: Global interfaces
 * Last Update: 14/12/2012 - 16:32h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

interface EffectWebData
{
	const CAPTCHA_URL 			= "?showLoad=captcha";
	const LOGOGUILD_URL			= "?showLoad=gmark";
	const LANGUAGE_JS			= "?showLoad=jslang&lang=";
	const AUTH_LOGIN_KEY		= "@&*()14787[]";
	
	const ACP_SHOW_MESSAGE_TYPE	= 0;
	const ACP_AUTH_LOGIN_KEY	= "@&*()14787[]";
}

interface EffectWebFiles
{
	const TEMPLATE_XML_FILENAME	= "ew_template.xml";
}

interface EffectWebInfo
{
	const DEFAULT_TEMPLATE	= "Harmony";
}

interface CetemasterFrameworkInterface
{
	const GLOBAL_FRAMEWORK_KEY			= "6f7f31423d5fd722da10169e65c095c9";
	
	const LIBINFO_DEVELOPER_NAME		= "Cetemaster Services";
	const LIBINFO_DEVELOPER_ADDR		= "www.cetemaster.com.br";
	const LIBINFO_DEVELOPER_MAIL		= "contato@cetemaster.com.br";
	const LIBINFO_DEVELOPER_YEAR		= "2013";

	const GLOBAL_LOG_PATH				= EW_LOG_PATH;
	const GLOBAL_LOG_EXTENSION			= EW_LOG_EXT;

	const CRYPT_LIB_FOLDER				= "{KERNEL_PATH}CryptographyLibrary/";

	const DRIVER_LIB_FOLDER				= "{KERNEL_PATH}DatabaseLibrary/";

	const FILE_MANAGEMENT_LIB_FOLDER	= "{KERNEL_PATH}FileManageLibrary/";
	const FILE_MANAGEMENT_XML_LIBRARY	= "xmlClass/";

	const TEMPLATE_ENGINE_LIB_FOLDER	= "{KERNEL_PATH}TemplateLibrary/";
	const TEMPLATE_ENGINE_EXPORT_FILE	= "ew_template.xml";

	const COMMUNICATION_LIB_FOLDER		= "{KERNEL_PATH}CommunicationLibrary/";

	const MAILER_PHPMAILER_PATH			= "{SOURCES_PATH}extras/PHPMailer/";

	const LICENSE_FILEPATH_INFO			= "{CACHE_PATH}core_cache/license/licenseInfo.ini";
	const LICENSE_FILEPATH_DATA			= "{CACHE_PATH}core_cache/license/licenseData.dat";
	const LICENSE_LIB_FOLDER			= "{KERNEL_PATH}LicenseLibrary/";
	const LICENSE_SUBKEY_KEY			= "1ef2c52e24b74401c04b02ac1dd07917";
	const LICENSE_DATAKEY_KEY			= "57150ac5cc3412ef435153e2d8cf1bea";
	const LICENSE_DATA_KEY_1			= "a1b371b0906a03923ffa16f84e9da344";
	const LICENSE_DATA_KEY_2			= "edfa4a46445fe8ac404bb5e64ec89661";
	const LICENSE_DATA_KEY_3			= "a8f4e38be108a05aed0ab1cae35b6c12";
	const LICENSE_REMOTE_PACK_KEY		= "5e0e82b07e7fe82db6e5be4c634d7420";
	const LICENSE_REMOTE_ADDRESS		= "http://request.effectweb.net/index.php";
	const LICENSE_REMOTE_TIMEOUT		= 1;
	const LICENSE_CHECK_DOMAIN			= TRUE;
	const LICENSE_CHECK_IP				= TRUE;
	const LICENSE_CHECK_COMPUTERNAME	= FALSE;
	const LICENSE_CHECK_HARDWAREID		= FALSE;
	const LICENSE_CHECK_CACHE			= TRUE;
	const LICENSE_CHECK_TIME			= TRUE;
	const LICENSE_CACHE_HOURS			= 10;

	const MUONLINE_LIB_FOLDER			= "{KERNEL_PATH}MuOnlineLibrary/";
	const MUONLINE_LIB_ITEM_LIBRARY		= "itemClass/";
}