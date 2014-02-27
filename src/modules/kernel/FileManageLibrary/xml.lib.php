<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * File Management: XML Manipulation
 * Author: $CTM['Erick-Master']
 * Last Update: 25/07/2012 - 16:57h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class FileManagement_XML extends CTM_FileManage
{
	private static $settings			= array();
	private static $creatorClass		= NULL;
	private static $textClass			= NULL;
	
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
	}
	/**
	 *	Is XML
	 *	Check if the source is XML
	 *
	 *	@param	mixed	XML string of file path
	 *	@return	boolean
	*/
	public function IsXML($source)
	{
		libxml_use_internal_errors(true);
		
		if(file_exists($source) && is_file($source))
			$source = file_get_contents($source);
		
		simplexml_load_string($source);
		$errors = libxml_get_errors();
		
		return empty($errors) == true;
	}
	/**
	 *	Parse XML
	 *	Parse the XML and return in array and objects
	 *
	 *	@param	mixed	XML string of file path
	 *	@return	array|object
	*/
	public function ParseXML($source)
	{
		if(file_exists($source) && is_file($source))
			$source = file_get_contents($source);
		
		if(!$this->IsXML($source))
			return false;
		
		$xml = new SimpleXMLElement($source);
		return $xml;
	}
	/**
	 *	Create XML
	 *	Create a XML File
	 *
	 *	@param	string	XML Name
	 *	@param	array	XML Properties
	 *	@param	&string	XML Source
	 *	@return	string
	*/
	public function CreateXML($xml_name, $xml_properties = array(), $save_file = FALSE, &$xml_source = NULL)
	{
		if(!self::$creatorClass)
		{
			require_once(self::LibGetRealPath(self::FILE_MANAGEMENT_LIB_FOLDER.self::FILE_MANAGEMENT_XML_LIBRARY)."xmlCreator.class.php");
			self::$creatorClass = new FileManagement_XMLCreator(self::$settings);
		}
		
		if(!$xml_properties['Attributes'])
			$xml_properties['Attributes'] = array();
			
		if(!$xml_properties['Header'])
			$xml_properties['Header'] = array("1.0", "utf-8");
		
		self::$creatorClass->CreateFile($xml_name, $xml_properties['Attributes'], $xml_properties['Header']);
		self::$creatorClass->SetElements($xml_properties['Elements']);
		self::$creatorClass->BuildXML();
		
		return $xml_source = self::$creatorClass->SaveXML($save_file);
	}
	/**
	 *	Text Class
	 *	Return XML text class
	 *
	 *	@return	object
	*/
	public function Text()
	{
		if(!self::$textClass)
		{
			require_once(self::LibGetRealPath(self::FILE_MANAGEMENT_LIB_FOLDER.self::FILE_MANAGEMENT_XML_LIBRARY)."xmlText.class.php");
			self::$textClass = new FileManagement_XMLText(self::$settings);
		}
		
		return self::$textClass;
	}
}