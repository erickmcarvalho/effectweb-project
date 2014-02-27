<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Extension includes: Security check files
 * Last Update: 14/12/2012 - 16:32h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

if(!class_exists("security") && file_exists(CTM_CACHE_PATH."server_cache/db_php/core_sources/kernel_info.php"))
{
	require_once(CTM_CACHE_PATH."server_cache/db_php/core_sources/kernel_info.php");

	class security
	{
		public function __construct()
		{
			if(defined("EW_SECURITY_CHEKING"))
				$this->runSystemError();

			if(defined("EW_THIS_VERSION"))
				$this->runSystemError();

			if(defined("CTM_SERVER_ADDRESS"))
				$this->runSystemError();

			if(defined("CTM_DEVELOPER_MODE"))
				$this->runSystemError();
				
			if(!defined("CTM_SYSTEM_NAME"))
				$this->runSystemError();
				
			if(CTM_SYSTEM_NAME != "EffectWeb")
				$this->runSystemError();

			if(!file_exists(CTM_CACHE_PATH."server_cache/db_php/core_sources/kernel_info.php"))
				$this->runSystemError();

			if(!$this->runSystemCheckSum("{CACHE_PATH}server_cache/db_php/skin_sources/skin_sources.php"))
				$this->runSystemError();
				
			/* Protect this file */
			define("EW_SECURITY_CHEKING", "76708759289ed886b91b634944f38dbd");
		}

		private function runSystemError()
		{
			print "<h1>CTM Fatal Error</h1><hr>You do not have permission to use this API.";
			print "<hr><address>Cetemaster Effect Web v2.x - www.cetemaster.com</address>";
			exit();
		}

		private function runSystemCheckSum($file_path)
		{
			global $EW_KERNEL;

			$_path = str_replace(array("{CACHE_PATH}", "{ROOT_PATH}"), array(CTM_CACHE_PATH, CTM_ROOT_PATH), $file_path);
			$file_path = str_replace(array("{CACHE_PATH}", "{ROOT_PATH}"), NULL, $file_path);

			if(strlen(file_get_contents($_path)) == 0)
				return true;

			$file = crc32("ew_k:hash_file:".$file_path);
			$file_hex = str_pad(strtoupper(dechex($file)), 8, 0, STR_PAD_LEFT);

			$file_checksum = md5_file($_path);
			$file_checksum = md5("checksum:ew_kernel:".$file_hex.":hash_file:".$file_checksum);
			$file_checksum = strtoupper(bin2hex($file_checksum));
			
			return hexdec($file_checksum) == $EW_KERNEL[$file] || hexdec($file_checksum) == $EW_KERNEL[hexdec($file)];
		}
	}

	$_security = new security();
}
else
{
	print "<h1>CTM Fatal Error</h1><hr>You do not have permission to use this API.";
	print "<hr><address>Cetemaster Effect Web v2.x - www.cetemaster.com</address>";
	exit();
}
