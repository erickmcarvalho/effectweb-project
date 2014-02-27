<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * File Management: XML - Text
 * Author: $CTM['Erick-Master']
 * Last Update: 25/07/2012 - 17:22h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class FileManagement_XMLText extends FileManagement_XML
{
	/**
	 *	Encode Attribute
	 *	Encode the string for XML Attribute
	 *
	 *	@param	string	String for encoding
	 *	@return	string
	*/
	public function EncodeAttribute($string)
	{
		$string = preg_replace("/&(?!#[0-9]+;)/s", "&amp;", $string);
		$string = str_replace("<", "&lt;", $string);
		$string = str_replace(">", "&gt;", $string);
		$string = str_replace('"', "&quot;", $string);
		$string = str_replace("'", "&#039;", $string);
		
		return $string;
	}
	/**
	 *	Decode Attribute
	 *	Decode the XML Attribute for string
	 *
	 *	@param	string	String for decoding
	 *	@return	string
	*/
	public function DecodeAttribute($string)
	{
		$string = str_replace("&amp;", "&", $string);
		$string = str_replace("&lt;", "<", $string);
		$string = str_replace("&gt;", ">", $string);
		$string = str_replace("&quot;", '"', $string);
		$string = str_replace("&#039;", "'", $string);
		
		return $string;
	}
}