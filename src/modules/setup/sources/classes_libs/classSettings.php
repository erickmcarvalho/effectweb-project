<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Library - Settings
 * Last Update: 24/04/2013 - 18:33h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Installer_Settings extends CTM_Command
{
	private $file_path		= NULL;
	private $file_content	= array();

	/**
	 *	Class constructor
	 *
	 *	@return	void
	*/
	public function __construct()
	{
		$this->registry();
	}
	/**
	 *	Open Settings
	 *
	 *	@param	string	Settings path
	 *	@return	boolean
	*/
	public function OpenSettings($path)
	{
		$this->file_path = str_replace("{ROOT_PATH}", CTM_ROOT_PATH, $path);
		
		if(file_exists($this->file_path))
		{
			$this->file_content = file($this->file_path);
			return true;
		}

		return false;
	}
	/**
	 *	Set Line
	 *
	 *	@param	string	Line syntax
	 *	@param	array	Arguments
	 *	@param	boolean	Add line	
	 *	@param	boolean	Set all lines
	 *	@return	void
	*/
	public function SetLine($syntax, $arguments = array(), $add_line = false, $set_all = false)
	{
		$syntax = str_replace(array("{!#!}", "{!@!}"), array('"', "'"), $syntax);
		
		$_syntax = str_replace(array("\\$", "\(\.\*\?\)"), array("$", "(.*?)"), preg_quote($syntax, "/"));
		$variable = false;
		$tags = 1;
		
		if(substr($_syntax, 0, 1) == "$")
		{
			$_syntax = substr($_syntax, 1);
			$variable = true;
		}

		while(strstr($_syntax, "$"))
		{
			$_syntax = str_replace("$".$tags++, "(.*?)", $_syntax);
		}

		for($i = 0; $i < count($arguments); $i++)
		{
			$syntax = str_replace("$".($i + 1), $arguments[$i], $syntax);
		}

		$_syntax = ($variable == true ? "\\$" : NULL).$_syntax;
		$set = false;
		
		for($i = 0; $i < count($this->file_content); $i++)
		{
			$continue = $set_all == true ? true : $set == false;

			if(preg_match("/".$_syntax."/is", $this->file_content[$i]) && $continue == true)
			{
				$this->file_content[$i] = preg_replace("/".$_syntax."/is", $syntax, $this->file_content[$i]);
				$set = true;
			}
		}


		if($set == false && $add_line == true)
		{
			$this->file_content[count($this->file_content) + 1] = "\r\n".$syntax.(substr($syntax, -1, 1) != ";" ? ";" : NULL);
		}
	}
	/**
	 *	Close Settings
	 *
	 *	@param	boolean	Backup original settings
	 *	@return	void
	*/
	public function CloseSettings($backup = false)
	{
		if($backup == true)
			copy($this->file_path, $this->file_path.".bak");

		$fp = fopen($this->file_path, "w");

		if($fp)
		{
			fwrite($fp, implode(NULL, $this->file_content));
			fclose($fp);
		}
	}
}