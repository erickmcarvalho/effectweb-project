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

	const MUONLINE_LIB_FOLDER			= "{KERNEL_PATH}MuOnlineLibrary/";
	const MUONLINE_LIB_ITEM_LIBRARY		= "itemClass/";
}