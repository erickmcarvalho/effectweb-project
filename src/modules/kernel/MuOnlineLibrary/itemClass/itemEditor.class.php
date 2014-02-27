<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * MuOnline Library: Item - Editor Class
 * Author: $CTM['Litlle']
 * Last Update: 29/04/2012 - 19:06h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class MuOnline_ItemEditor extends MuOnline_Item
{
	/**
	 *	Variable that stores the new item and returns it.
	 *
	 *	@var	string	Hex item modified (32 characters)
	 */
	private $hexItem 	= NULL;
	/**
	 *	Variable that stores the DB Version.
	 *
	 *	@var	integer	DB Version
	 */
	private $dbVerion	= -1;
		
	/**
	 *	Main function of the class receives the data and changes, if the variable exists.
	 *
	 *	@param	string	Hex item (32 characters)
	 *  @param	array	Changes to be made
	 *  @param	integer	Version of the database, signed or unsigned
	 */
	public function EditItem($itemHex, $newProperties = array(), $dbVersion = -1)
	{
		$this->dbVerion = $dbVersion;
		
		$itemNoModify = $this->SectionItem($itemHex);
		$itemModify = $this->replaceModify($itemNoModify, $newProperties);
		self::MakeItemHex($itemNoModify["Section"], $itemNoModify["Index"], $itemModify, $this->hexItem, $dbVersion);
		
		$this->replaceSerial($itemNoModify["Serial"]);
		
		return $this->hexItem;
	}
	/**
	 *	Function designed to verify that an item is to change it
	 *
	 *	@param	array	Data not modified
	 *  @param	array	Modified data, ready for editing
	 */
	private function replaceModify($noItemModify, $Modify)
	{
		if(!isset($Modify["Level"]))
			$Modify["Level"] = $noItemModify["Level"];
		
		if(!isset($Modify["Option"]))
			$Modify["Option"] = $noItemModify["Option"];
		
		if(!isset($Modify["Skill"]))
			$Modify["Skill"] = $noItemModify["Skill"];
		
		if(!isset($Modify["Luck"]))
			$Modify["Luck"] = $noItemModify["Luck"];
		
		if(!isset($Modify["Durability"]))
			$Modify["Durability"] = $noItemModify["Durability"];
			
		if(!isset($Modify["Excellent"]))
			$Modify["Excellent"] = $noItemModify["Excellent"];	
			
		if(!isset($Modify["Ancient"]))
			$Modify["Ancient"] = $noItemModify["Ancient"];
		
		if(!isset($Modify["Refine"]))
			$Modify["Refine"] = $noItemModify["Refine"];
		
		if(!isset($Modify["JewelOfHarmony"]))
			$Modify["JewelOfHarmony"] = $noItemModify["JewelOfHarmony"];
			
		if(!isset($Modify["SocketOption"]))
			$Modify["SocketOption"] = $noItemModify["SocketOption"];
			
		return $Modify;	
	}
	/**
	 *	Developed function to change the serial
	 *
	 *	@param	string	Serial item
	 */
	private function replaceSerial($toSerial)
	{
		$this->hexItem = str_replace(substr($this->hexItem, 6, 8), $toSerial, $this->hexItem);
	}
	/**
	 *	Developed function to convert hex to decimal
	 *
	 *	@param	string	hexacimal item (32 characters)
	 */
	private function SectionItem($h = NULL)
	{
		if(!is_null($h))
		{
			self::ParseItemHex($h, $itemSection, $this->dbVerion);
		}
		
		return $itemSection;
	}
}