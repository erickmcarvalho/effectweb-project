<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Public Show Files
 * Last Update: 25/05/2012 - 18:12h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2012. All Rights Reserved, 
 * www.ctmts.com / www.cetemaster.com
*/

if(!empty($_GET['showLoad']))
{
	require_once(CTM_ROOT_PATH."modules/kernel/ctmCaptcha.php");
	require_once(CTM_ROOT_PATH."modules/sources/includes/functions.inc.php");
	require_once(CTM_ROOT_PATH."modules/sources/extras/classGuildMark.php");

	switch($_GET["showLoad"])
	{
		case "captcha" :
			CTM_Captcha::$number = 8;
			CTM_Captcha::$size = 18;
			CTM_Captcha::$words = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			CTM_Captcha::$bg = PUBLIC_DIRECTORY."/style_captcha/backgrounds/{rand}.gif";
			CTM_Captcha::$fontDir = PUBLIC_DIRECTORY."/style_captcha/fonts/";
			
			CTM_Captcha::$fonts = array
			(
				# => array("font.ttf", $numberWords),
				0 => array("constan.ttf", 8),
				1 => array("FRABK.ttf", 8),
				2 => array("MAIAN.ttf", 8),
			);
			
			CTM_Captcha::$colors = array
			(
				# => array($red, $green, $blue),
				0 => array(131, 7, 124),
				1 => array(70, 138, 239),
				2 => array(30, 30, 30),
				3 => array(118, 106, 0),
				4 => array(157, 10, 79),
				5 => array(72, 104, 33),
				6 => array(214, 0, 0),
				7 => array(48, 71, 160),
			);
			
			CTM_Captcha::$border = array
			(
				0 => true, // Switch
				1 => array(0, 0, 0) // array($red, $green, $blue)
			);
			
			CTM_Captcha::$setLines = array
			(
				0 => true, // Switch
				1 => array // Lines
				(
					# => array($red, $green, $blue),
					0 => array(70, 120, 278), // Line 1
					1 => array(0, 0, 0), // Line 2
					2 => array(48, 71, 160), // Line 3
				),
			);
			
			CTM_Captcha::CaptchaImage(186, 27);
			exit();
		break;
		case "gmark" :
			GuildMark::getMark($_GET['hexa'], 100);
			exit();
		break;
		case "jslang" :
			if($_GET['lang'])
			{
				if(file_exists(CTM_ROOT_PATH."cache/lang_cache/".$_GET['lang']."/web_".CTM_ROOT_AREA.".js"))
				{
					header("Content-type: text/javascript");
					readfile(CTM_ROOT_PATH."cache/lang_cache/".$_GET['lang']."/web_".CTM_ROOT_AREA.".js");
				}
			}
			exit();
		break;
		default :
			exit("showLoad Error");
		break;
	}
}

?>