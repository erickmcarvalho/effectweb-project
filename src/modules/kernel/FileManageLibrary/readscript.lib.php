<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * File Management: Structure and read data script file
 * Author: $CTM['Erick-Master']
 * Last Update: 17/07/2012 - 15:05h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class FileManagement_ReadScript extends CTM_FileManage
{
	private static $serialize_path	= NULL;
	private static $hash_file		= NULL;
	
	private static $file_directory	= NULL;
	private static $file_serialize	= NULL;
	
	/**
	 *	Library Factory
	 *	Set up a library setting
	 *
	 *	@param	array	Library Settings
	 *	@return	void
	*/
	public function LibFactory($settings)
	{
		self::$serialize_path = $settings['SerializePath'];
		self::$hash_file = $settings['HashFilesPath'];
	}
	/**
	 *	Structure File
	 *	Structure script file
	 *
	 *	@param	string	File directory
	 *	@param	string	File serialize directory
	 *	@param	boolean	Set the primary value to id
	 *	@return	boolean
	*/
	public static function StructureFile($file_directory, $file_serialize, $setPrimaryValueId = FALSE)
	{
		if(!file_exists($file_directory))
			return false;
			
		self::$file_directory = $file_directory;
		self::$file_serialize = $file_serialize;
			
		$structure_file = TRUE;
		
		if(self::CheckSerializeFile($file_serialize) == true)
			if(md5_file($file_directory) == self::GetSerializeHash($file_serialize))
				$structure_file = FALSE;
		
		if($structure_file == true)
		{
			if(!$file = file($file_directory))
				return false;
				
			$scriptData = array();
			$currentSection = 0;
			$currentColumn = 0;
			
			foreach($file as $string)
			{
				if($string == NULL) continue;
				if(substr($string, 0, 2) == "//") continue;
				if(substr($string, 0, 1) == "#") continue;
				if(substr($string, 0, 1) == "\r") continue;
				
				$string = str_replace("	", " ", trim($string));
				
				if(strpos($string, "//") > 0)$string = substr($string, 0, strrpos($string, "//"));
				if(strpos($string, "#") > 0) $string = substr($string, 0, strrpos($string, "#"));
				
				if(strtolower(substr($string, 0, 3)) == "end")
				{
					$currentSection = 0;
					$currentColumn = 0;
					continue;
				}
				
				$isSection = FALSE;
				$length = strlen($string);
				
				if($length > 1)
				{
					$count = 0;
					for($i = 0; $i < $length; $i++) if($string[$i] != " ") $count++;
					if($count == $length) $isSection = TRUE;
				}
				else $isSection = TRUE;
				
				if($isSection == TRUE)
				{
					$scriptData[$string] = array();
					$currentSection = $string;
					$currentColumn = 0;
				}
				else
				{
					$lineInfo = self::setLineString($string, $currentColumn++, $setPrimaryValueId);
					$scriptData[$currentSection][$lineInfo['ID']] = $lineInfo['VALUES'];
				}
			}
			
			self::WriteSerializeData($file_serialize, $scriptData, md5_file($file_directory));
			return true;
		}
		
		return false;
	}
	/**
	 *	Read Script File
	 *	Return the array data
	 *
	 *	@return	array|boolean
	*/
	public static function ReadScript($file_serialize = NULL, &$script_data = array())
	{
		if(!$file_serialize)
		{
			if(!self::$file_serialize)
				return false;
			else
				$file_serialize = self::$file_serialize;
		}
			
		if(self::CheckSerializeFile($file_serialize))
		{
			$serialized = file_get_contents(self::$serialize_path."files/".$file_serialize);
			$unserialized = unserialize(trim($serialized));
			
			return $script_data = $unserialized ? $unserialized : false;
		}
		
		return false;
	}
	/**
	 *	Check Serialize File
	 *	Check if the serialize file exist
	 *
	 *	@param	string	File name
	 *	@return	boolean
	*/
	public static function CheckSerializeFile($file_name)
	{
		return file_exists(self::$serialize_path."files/".$file_name);
	}
	/**
	 *	Get Serialize Hash
	 *	Return the MD5 Hash of serialie file
	 *
	 *	@param	string	Serialize file name
	 *	@return	string|boolean
	*/
	public static function GetSerializeHash($serialize_file)
	{
		if(file_exists(self::$serialize_path.self::$hash_file))
		{
			$hash_file = file_get_contents(self::$serialize_path.self::$hash_file);
			$hash_file = unserialize(trim($hash_file));
			
			if($hash_file)
			{
				if(array_key_exists($serialize_file, $hash_file))
					return $hash_file[$serialize_file];
				else
					return false;
			}
		}
		
		return false;
	}
	/**
	 *	Write Serialize Data
	 *	Write the serialize data
	 *
	 *	@param	string	Serialize file name
	 *	@param	array	Script data
	 *	@param	string	Script file MD5
	 *	@return	void
	*/
	public static function WriteSerializeData($file_name, $script_data, $script_md5)
	{
		if(file_exists(self::$serialize_path.self::$hash_file))
		{
			$hash_data = file_get_contents(self::$serialize_path.self::$hash_file);
			$hash_data = unserialize($hash_data);
			
			$hash_data[$file_name] = $script_md5;
		}
		else
		{
			$hash_data[$file_name] = $script_md5;
		}
		
		if($fp = fopen(self::$serialize_path.self::$hash_file, "w"))
		{
			fwrite($fp, serialize($hash_data));
			fclose($fp);
		}
		
		if($fp = fopen(self::$serialize_path."files/".$file_name, "w"))
		{
			fwrite($fp, serialize($script_data));
			fclose($fp);
		}
	}
	/**
	 *	Set Line String
	 *	Set line string from script
	 *
	 *	@param	string	Data
	 *	@param	string	Identify
	 *	@param	boolean	Set the primary value to id
	 *	@return	string
	*/
	private static function setLineString($data, $id, $setPrimaryValueId = FALSE)
	{
		// Thanks to Flavio Hernandes
		$split = preg_split("/[\s,]*\\\"([^\\\"]+)\\\"[\s,]*|[\s,]*'([^']+)'[\s,]*|[\s,]+/", $data, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		$columns = array();
		
		foreach($split as $key => $value)
		{
			if($setPrimaryValueId)
			{
				if($key == 0)
				{
					$setId = $value;
					continue;
				}
			}
			else $setId = $id;
			
			$columns[] = $value;
		}
		
		return array("ID" => $setId, "VALUES" => $columns);
	}
}