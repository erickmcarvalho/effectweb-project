<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Main controller
 * Last Update: 13/06/2013 - 01:46h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_Controller extends CTM_Command
{
	/**
	 *	Init intaller now
	 *
	 *	@return	void
	*/
	public static function initNow()
	{
		global $install_sections, $upgrade_sections, $repair_sections, $installation;

		CTM_Controller::PHPErrors();
		CTM_Command::instance()->loadLibrary((CTM_SETUP_MODE == "install" ? "Install" : (CTM_SETUP_MODE == "repair" ? "Repair" : "Upgrade")), "setup");
		CTM_Registry::init();
		CTM_Registry::setVars("section", $_GET['section']);
		CTM_Registry::setVars("max_sections", CTM_Command::instance()->setup->max_sections);

		CTM_Command::instance()->registry();
		CTM_Command::instance()->lang->loadLanguageFile("core:global");
		CTM_Command::instance()->output->registry();

		$continue = true;

		if(CTM_SETUP_MODE == "install")
		{
			$setup_sections = $install_sections;
			$sections_folder = "install";

			if($installation['is_installed'] == true)
			{
				require_once(CTM_SETUP_PATH."sources/sections/install/block.php");

				$section->run();
				$section->content($content);
				$continue = false;
			}
		}
		elseif(CTM_SETUP_MODE == "default")
		{
			self::instance()->output->setTitles(self::instance()->lang->words['Default']['HTML'], self::instance()->lang->words['Default']['Step']);
			$content = array("type" => "core", "section" => "default_page");
			$continue = false;

			$GLOBALS['hide_button'] = true;
			$GLOBALS['hide_sidebar'] = true;
		}
		elseif(CTM_SETUP_MODE == "upgrade")
		{
			$setup_sections = $upgrade_sections;
			$sections_folder = "upgrade";

			if($installation['current_version'] == EW_THIS_VERSION)
			{
				require_once(CTM_SETUP_PATH."sources/sections/upgrade/block.php");

				$section->run();
				$section->content($content);
				$continue = false;
			}
		}
		elseif(CTM_SETUP_MODE == "repair")
		{
			$setup_sections = $repair_sections;
			$sections_folder = "repair";

			if($installation['is_installed'] == false)
			{
				header("Location: ?app=install");
				exit();
			}
			elseif($installation['current_version'] < EW_THIS_VERSION)
			{
				header("Location: ?app=upgrade");
				exit();
			}
		}

		if($continue == true && (CTM_SETUP_MODE == "upgrade" || CTM_SETUP_MODE == "repair"))
		{
			self::instance()->DB->settings['mssql']['hostname'] = MSSQL_HOSTNAME;
			self::instance()->DB->settings['mssql']['hostport'] = MSSQL_HOSTPORT;
			self::instance()->DB->settings['mssql']['database'] = CTMEW_CORE;
			self::instance()->DB->settings['mssql']['username'] = MSSQL_USERNAME;
			self::instance()->DB->settings['mssql']['password'] = MSSQL_PASSWORD;
			self::instance()->DB->settings['mssql']['persistent'] = FALSE;
			self::instance()->DB->settings['mssql']['hideErrors'] = TRUE;
			self::instance()->DB->settings['mssql']['debug'] = FALSE;
			self::instance()->DB->Connect("mssql");

			if(!self::instance()->DB->IsConnected())
			{
				self::instance()->output->setTitles(self::instance()->lang->words['Default']['HTML'], self::instance()->lang->words['Default']['Step']);
				$content = array("type" => "core", "section" => "show_error");
				$continue = false;

				$GLOBALS['show_error'] = self::instance()->lang->words['DBConnectError'];
				$GLOBALS['hide_button'] = true;
				$GLOBALS['hide_sidebar'] = true;
			}
		}

		if($continue == true)
		{
			if($_GET['section'])
			{
				if(file_exists(CTM_SETUP_PATH."sources/sections/".$sections_folder."/".$setup_sections[$_GET['section']].".php") && CTM_Command::instance()->setup->CheckSection())
				{
					require_once(CTM_SETUP_PATH."sources/sections/".$sections_folder."/".$setup_sections[$_GET['section']].".php");

					$section->run();
					$section->content($content);
				}
				else
				{
					require_once(CTM_SETUP_PATH."sources/sections/".$sections_folder."/".$setup_sections[1].".php");

					$section->run();
					$section->content($content);
				}
			}
			else
			{
				require_once(CTM_SETUP_PATH."sources/sections/".$sections_folder."/".$setup_sections[1].".php");

				$section->run();
				$section->content($content);
			}
		}

		$GLOBALS['section'] = $_GET['section'] ? $_GET['section'] : 1;
		$GLOBALS['__session'] = $_POST['session'] ? $_POST['session'] : $_SESSION['SETUP_SESSION'];
		
		echo CTM_Command::instance()->output->returnFullContent($content);
		exit("\r\n<!-- Cetemaster PHP Installer v1.1 - Copyright 2013 (c) Cetemaster Services (www.cetemaster.com.br) -->");
	}
	/**
	 *	Update Kernel Cache
	 *
	 *	@param	string	Secure key
	 *	@param	string	Kernel key
	 *	@param	string	Kernel cache
	 *	@return	void
	*/
	public function UpdateWebCache($s_key, $key, $value)
	{
		if($s_key == "effectwebkernelhash")
		{
			$fp = file(CTM_CACHE_PATH."server_cache/db_php/core_sources/kernel_info.php");
			$hex = "0x".str_pad(strtoupper(dechex(crc32("ew_k:".$key))), 8, 0, STR_PAD_LEFT);
			$h_value = "0x".strtoupper(bin2hex(md5("checksum:ew_kernel:".substr($hex, 2).":".(strlen($value) < 32 ? md5($value) : $value))));
			
			$next_date_line = false;
			$seted = false;
			$file = NULL;

			for($i = 0; $i < count($fp); $i++)
			{
				$_key = substr($fp[$i], 11, 10);

				if($_key == $hex)
				{
					$fp[$i] = "\$EW_KERNEL[".$hex."] = ".$h_value.";\n";
					$seted = true;
				}
				
				if(substr($fp[$i], 0, 11) == "\$EW_KERNEL[")
				{
					$file .= $fp[$i];
				}
			}

			if($seted == false)
			{
				$file .= "\n\$EW_KERNEL[".$hex."] = ".$h_value.";";
			}

			$new_file = "<?php\n";
			$new_file .= "/**\n";
			$new_file .= " * Generated by Effect Web Board\n";
			$new_file .= " * ".date("r")."\n";
			$new_file .= "*/\n\n";
			$new_file .= $file;

			$fp = fopen(CTM_CACHE_PATH."server_cache/db_php/core_sources/kernel_info.php", "wb");
			fwrite($fp, rtrim($new_file, "\n"));
			fclose($fp);
		}
	}
	/**
	 *	Private: PHP Errors
	 *
	 *	@return	void
	*/
	private static function PHPErrors()
	{
		if(CTM_SERVER_DEBUG == false)
			ini_set("display_errors", "Off");
				
		if(CTM_ERROR_CAPTURE == true)
		{
			if(!file_exists(EW_LOG_PATH."ServerError/"))
				mkdir(EW_LOG_PATH."ServerError");
				
			if(!function_exists("myErrorHandler"))
			{
				function myErrorHandler($errno, $errstr, $errfile, $errline)
				{
					if($errno == E_WARNING || $errno == E_PARSE || $errno == E_ERROR || $errno == E_DEPRECATED)
					{
						if($fp = fopen(EW_LOG_PATH."ServerError/".date("d-m-Y").EW_LOG_EXT, "a+"))
						{
							$write = "[".date("H:i:s")."] Error number: ".$errno."\r\n"
							. "[".date("H:i:s")."] Error string: ".strip_tags($errstr)."\r\n"
							. "[".date("H:i:s")."] Error line: ".$errline."\r\n"
							. "[".date("H:i:s")."] Error file: ".myDirectory($errfile)."\r\n"
							. substr($write, strlen($write - 2) != "\r\n" ? "\r\n" : NULL)
							. str_repeat("=", 90)."\r\n";
									
							fwrite($fp, $write);
							fclose($fp);
						}
					}
					elseif(CTM_DEVELOPER_MODE == TRUE && ($errno == E_STRICT || $errno == E_NOTICE))
					{
						if($fp = fopen(EW_LOG_PATH."DeveloperStricts/".date("d-m-Y").EW_LOG_EXT, "a+"))
						{
							$write = "[".date("H:i:s")."] Error number: ".$errno."\r\n"
							. "[".date("H:i:s")."] Error string: ".strip_tags($errstr)."\r\n"
							. "[".date("H:i:s")."] Error line: ".$errline."\r\n"
							. "[".date("H:i:s")."] Error file: ".myDirectory($errfile)."\r\n"
							. substr($write, strlen($write - 2) != "\r\n" ? "\r\n" : NULL)
							. str_repeat("=", 90)."\r\n";
									
							fwrite($fp, $write);
							fclose($fp);
						}
					}

					if(CTM_SERVER_DEBUG == true && ($errno != E_STRICT && $errno != E_NOTICE))
					{
						trigger_error($errstr, myUserErrorNumber($errno));
					}
				}
			}
				
			set_error_handler("myErrorHandler");
		}
	}
}