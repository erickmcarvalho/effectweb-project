<?php
/**
 * Cetemaster Services
 * CTM.Framework v1.0
 *
 * File Management: Ini Files
 * Author: $CTM['Erick-Master']
 * Last Update: 19/01/2012 - 19:51h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class FileManagement_IniFiles extends CTM_FileManage
{
	private $linebreak	= "\n";

	/**
	 *	Library Factory
	 *	Set up a library setting
	 *
	 *	@param	array	Library Settings
	 *	@return	void
	*/
	public function LibFactory($settings)
	{
		//self::$settings = $settings;

		if(substr(strtoupper(PHP_OS), 0, 3) == "WIN")
		{
			$this->linebreak = "\r";
		}
	}
	/**
	 *	Parse Ini String
	 *	Parse the string in ini for array
	 *
	 *	@param	string	Ini String
	 *	@return	array
	*/
	public function ParseIniString($string)
	{
		if(!function_exists("parse_ini_string"))
		{
			if(($tmp = tempnam(md5(time()."&".$_SERVER['HTTP_HOST']."&".mt_rand()), "tmp")))
			{
				if(($fp = fopen($tmp, "w")))
				{
					fwrite($fp, $string);
					fclose($fp);
			
					$parseString = parse_ini_file($tmp, TRUE);
					unlink($tmp); unset($string);
			
					return $parseString;
				}
			}
		}
		else
		{
			return parse_ini_string($string, TRUE);
		}
		
		return false;
	}
	/**
	 *	Edit Ini String
	 *	Edit the string from ini file
	 *
	 *	@param	string	The ini section
	 *	@param	string	The ini key
	 *	@param	string	The new value
	 *	@param	string	The content (File path or ini string)
	 *	@param	boolean	If true, return the array with old and new content
	 *	@return	string|array
	*/
	public function EditIniString($section, $key, $newValue, $content, $return = FALSE)
	{
		if(file_exists($content) && is_file($content))
		{
			$fileDir = $content;
			$isFile = TRUE;
			$content = file_get_contents($content);
		}
		
		$section = "[".str_replace(array("[", "]"), NULL, $section)."]";
		$newValue = " ".$newValue;
		
		$iString = strpos($content, $section);
		$iString = strpos(substr($content, $iString), $key) + $iString;
		$tString = strpos(substr($content, $iString), "=");
		
		$xString = substr($content, $tString);
		
		for($i = 0; $i < strlen($xString); $i++)
		{
			if($xString{$i} != " " && $xString{$i} != "	")
			{
				$yString = strpos($xString, $xString{$i});
				break;
			}
			elseif($xString{$i} == $this->linebreak)
			{
				$yString = strpos($xString, $xString{$i}) - 1;
				break;
			}
		}
		
		$kString = strpos(substr($content, $iString + ($tString - $yString)), $this->linebreak);
		$kString = $kString < 1 ? strlen(substr($content, $iString + ($tString - $yString))) : $kString;
		$newContent = substr_replace($content, $newValue, $yString + $iString + $tString + 1, $kString - 1);
		
		if($isFile == true)
		{
			if($fp = fopen($fileDir, "wb"))
			{
				fwrite($fp, $newContent);
				fclose($fp);
			}
		}
		else
		{
			if($return == true)
				return array($newContent, $content);
			else
				return $newContent;
		}
	}
	/**
	 *	Insert ini Data
	 *	Insert data in ini file
	 *
	 *	@param	string	The ini path
	 *	@param	string	The data
	 *	@param	string	Replace section
	 *	@reutrn	void
	*/
	public function InsertIniData($fileName, $data, $replaceSection = NULL)
	{
		if(file_exists($fileName) && is_file($fileName))
		{
			if(!empty($replaceSection))
			{
				$file = file($fileName);
				$replaceSection = str_replace(array("[", "]"), NULL, $replaceSection);
				$replaceSection = "[".$replaceSection."]";
				
				$check = FALSE;
				$final = FALSE;
				
				for($i = 0; $i < sizeof($file); $i++)
				{
					if(trim($file[$i]) == $replaceString && !$check)
					{
						$check = TRUE;
					}
					elseif(substr(trim($file[$i]), 0, strlen($replaceString)) != $replaceString)
					{
						if(substr(trim($file[$i]), 0, 1) == "[")
						{
							$final = TRUE;
							$fString = trim($file[$i]);
						}
						continue;
					}
				}
			
				if($check == true)
				{
					$content = file_get_contents($fileName);
					$begin = explode($replaceSection, $content);
					$end = $final == true ? substr($begin[1], strpos($begin[1], $fString)) : NULL;
					
					$newData = $begin[0].$data.$end;
					
					if($fp = fopen($fileName, "wb"))
					{
						fwrite($fp, $newData);
						fclose($fp);
					}
				
					unset($data, $begin, $newData);
					$finish = TRUE;
				}
			}
			
			if($finish == false)
			{
				if($fp = fopen($fileName, "a+"))
				{
					fwrite($fp, $content);
					fclose($fp);
				}
			}
		}
	}
}