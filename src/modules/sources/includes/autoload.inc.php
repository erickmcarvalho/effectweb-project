<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Extension includes: PHP Class Autoload
 * Last Update: 14/12/2012 - 16:32h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

$classNotLoad = array();
$especialClass = array();

function __autoload($class_name)
{
	global $classNotLoad, $especialClass;
	
	if(in_array($class_name, $classNotLoad)) return NULL;
	if(array_key_exists($class_name, $especialClass))
		return require_once(CTM_ROOT_PATH."modules/sources/extras/class".$especialClass[$class_name].".php");
	
	$class_name = str_replace("CTM_", "ctm", $class_name);
	$class_name = str_replace("_", ".", $class_name);
	$camelCase = strtoupper(substr($class_name, 0, 1)).substr($class_name, 1);
	$class_dir = CTM_KERNEL_PATH."%s".".php";
	
	//if(file_exists(sprintf($class_dir, strtoupper(substr($class_name, 0, 1)).substr($class_name, 1))))
	//	require_once(CTM_KERNEL_PATH.strtoupper(substr($class_name, 0, 1)).substr($class_name, 1).".php");
	/*else*/if(file_exists(sprintf($class_dir, $class_name)))
		require_once(CTM_KERNEL_PATH.$class_name.".php");
	elseif(file_exists(sprintf($class_dir, $camelCase)))
		require_once(CTM_KERNEL_PATH.$camelCase.".php");
	elseif(file_exists(CTM_ROOT_PATH."modules/sources/extras/class".$camelCase.".php"))
		require_once(CTM_ROOT_PATH."modules/sources/extras/class".$camelCase.".php");
}
?>