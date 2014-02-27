<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * MuOnline Library: Item
 * Author: $CTM['Erick-Master']
 * Last Update: 09/06/2013 - 16:59h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class MuOnline_Item extends CTM_MuOnline
{
	private static $settings	= array
	(
		"dbVersion" => 2,
		"Database" => "MuOnline",
		"Files" => array
		(
			"Data" => "Item.txt",
			"DefineItems" => "DefineItems.ini",
			"ExcellentOptions" => "ExcellentOptions.txt",
			"JewelOfHarmony" => "JewelOfHarmony.txt",
			"SocketSystem" => "SocketSystem.txt"
		)
	);
	
	private static $makerClass		= NULL;
	private static $editorClass		= NULL;
	private static $parserClass		= NULL;
	private static $databaseClass	= NULL;
	private static $stringsClass	= NULL;
	private static $vaultClass		= NULL;
	private static $inventoryClass	= NULL;
	
	/**
	 *	Library Factory
	 *	Set up a library setting
	 *
	 *	@param	array	Library Settings
	 *	@return	void
	*/
	public function LibFactory($settings)
	{
		self::$settings = $settings;
	}
	/**
	 *	Make Item Hex
	 *	Make a new item hex from the properties
	 *	
	 *	@param	integer	Item Section
	 *	@param	integer	Item Index
	 *	@param	array	Item Properties
	 *	@param	&string	Item Hex Variable
	 *	@param	integer	DB Version (0 = Old / 1 = New)
	 *
	 *	@return	string	Item Hexa
	*/
	public final function MakeItemHex($section, $index, $properties = array(), &$itemHex = NULL, $dbVersion = -1)
	{
		if(!self::$makerClass)
		{
			require_once(self::LibGetRealPath(self::MUONLINE_LIB_FOLDER.self::MUONLINE_LIB_ITEM_LIBRARY."itemMaker.class.php"));
			self::$makerClass = new MuOnline_ItemMaker(self::$settings);
		}
		
		return $itemHex = self::$makerClass->MakeItem($section, $index, $properties, $dbVersion);
	}
	/**
	 *	Edit Item Hex
	 *	Edit a item hex from the new properties
	 *	
	 *	@param	string	Item Current Hex
	 *	@param	array	Item New Properties
	 *	@param	&string	Item New Hex Variable
	 *	@param	integer	DB Version (0 = Old / 1 = New)
	 *
	 *	@return	string	Item New Hexa
	*/
	public final function EditItemHex($itemHex, $newProperties = array(), &$newHex = NULL, $dbVersion = -1)
	{
		if(!self::$editorClass)
		{
			require_once(self::LibGetRealPath(self::MUONLINE_LIB_FOLDER.self::MUONLINE_LIB_ITEM_LIBRARY."itemEditor.class.php"));
			self::$editorClass = new MuOnline_ItemEditor(self::$settings);
		}
		
		return $newHex = self::$editorClass->EditItem($itemHex, $newProperties, $dbVersion);
	}
	/**
	 *	Parse Item Hex
	 *	Parse a item hex and return the properties in array
	 *	
	 *	@param	string	Current Item Hex
	 *	@param	&array	Item Properties in Array
	 *	@param	integer	DB Version (0 = Old / 1 = New)
	 *
	 *	@return	array	Item Properties in Array
	*/
	public final function ParseItemHex($itemHex, &$properties = array(), $dbVersion = -1)
	{
		if(!self::$parserClass)
		{
			require_once(self::LibGetRealPath(self::MUONLINE_LIB_FOLDER.self::MUONLINE_LIB_ITEM_LIBRARY."itemParser.class.php"));
			self::$parserClass = new MuOnline_ItemParser(self::$settings);
		}
		
		return $properties = self::$parserClass->ParseItem($itemHex, $dbVersion);
	}
	/**
	 *	Get Item Index
	 *	Parse and get a section and index from Item Hex
	 *
	 *	@param	string	Item Hex
	 *	@param	&array	Item Index
	 *	@return	array
	*/
	public final function GetItemIndex($hexa, &$itemIndex = array())
	{
		if(self::$settings['dbVersion'] >= 2)
		{
			$index = hexdec(substr($hexa, 0, 2));
			$section = hexdec(substr($hexa, 18, 1));
		}
		else
		{
			$unique = hexdec(substr($hexa, 14, 2)) & 128 == 128 ? 8 : 0;
			$data = hexdec(substr($hexa, 0, 2));
			
			$index = $data & 0x1F;
			$section = (((($data | $index) & 0xE0) & 0xFF) / 32);
			$section += $unique;
		}
		
		return $itemIndex = array("section" => intval($section), "index" => intval($index));
	}
	/**
	 *	Get Item Serial
	 *	Get and gerate a hex serial from Database
	 *
	 *	@return	string
	*/
	public final function GetItemSerial()
	{
		$GetItemSerialQ = self::Driver()->MSSQL()->Query("EXEC ".self::$settings['Database'].".dbo.WZ_GetItemSerial");
		$GetItemSerial = self::Driver()->MSSQL()->FetchRow($GetItemSerialQ);
		
		return strtoupper(str_pad(dechex($GetItemSerial[0]), 8, 0, STR_PAD_LEFT));
	}
	/**
	 *	Fix Item Hex
	 *	Fix the item hex to valid string
	 *
	 *	@param	string	Item Hex
	 *	@param	boolean	Source from SQL
	 *	@param	&string	Item hex fixed
	 *	@return	string
	*/
	public final function FixItemHex($string, $from_db = false, &$itemHex = NULL)
	{
		if($from_db == true)
			$string = bin2hex($string);

		return $itemHex = strtoupper(str_pad($string, (self::$settings['dbVersion'] >= 2 ? 32 : 20), 0, STR_PAD_RIGHT));
	}
	/**
	 *	Database Class
	 *	Return items database class
	 *
	 *	@return	object
	*/
	public final function Database()
	{
		if(!self::$databaseClass)
		{
			require_once(self::LibGetRealPath(self::MUONLINE_LIB_FOLDER.self::MUONLINE_LIB_ITEM_LIBRARY."itemDatabase.class.php"));
			self::$databaseClass = new MuOnline_ItemDatabase(self::$settings);
		}
		
		return self::$databaseClass;
	}
	/**
	 *	Strings Class
	 *	Return items strings class
	 *
	 *	@return	object
	*/
	public final function Strings()
	{
		if(!self::$stringsClass)
		{
			require_once(self::LibGetRealPath(self::MUONLINE_LIB_FOLDER.self::MUONLINE_LIB_ITEM_LIBRARY."itemStrings.class.php"));
			self::$stringsClass = new MuOnline_ItemStrings(self::$settings);
		}
		
		return self::$stringsClass;
	}
	/**
	 *	Vault Class
	 *	Return vault class
	 *
	 *	@return	object
	*/
	public final function Vault()
	{
		if(!self::$vaultClass)
		{
			require_once(self::LibGetRealPath(self::MUONLINE_LIB_FOLDER.self::MUONLINE_LIB_ITEM_LIBRARY."itemVault.class.php"));
			self::$vaultClass = new MuOnline_ItemVault(self::$settings);
		}
		
		return self::$vaultClass;
	}
	/**
	 *	Inventory Class
	 *	Return inventory class
	 *
	 *	@return	object
	*/
	public final function Inventory()
	{
		if(!self::$inventoryClass)
		{
			require_once(self::LibGetRealPath(self::MUONLINE_LIB_FOLDER.self::MUONLINE_LIB_ITEM_LIBRARY."itemInventory.class.php"));
			self::$inventoryClass = new MuOnline_ItemInventory(self::$settings);
		}
		
		return self::$inventoryClass;
	}
}