<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * MuOnline Library: Item - Database Class
 * Author: $CTM['Erick-Master']
 * Last Update: 21/06/2012 - 23:50h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

final class MuOnline_ItemDatabase extends MuOnline_Item
{
	/**
	 *	Lib Settings
	 *
	 *	@access	private
	 *	@var	array	Library Settings
	*/
	private $settings	= array();
	/**
	 *	Temp Settings
	 *
	 *	@access	private
	 *	@var	array	Temp Settings
	*/
	private $tempSts	= array();
	/**
	 *	Item Database
	 *
	 *	@access	private
	 *	@var	array	Item.txt Database
	*/
	private $database	= array();
	
	/**
	 *	Class Constructor
	 *	Set up library settings
	 *
	 *	@param	array	Lib Settings
	 *	@return	void
	*/
	public final function __construct($settings)
	{
		$this->settings = $settings;
	}
	/**
	 *	Get Item Data
	 *	Get item data from database
	 *	
	 *	@param	integer	Item Section
	 *	@param	integer	Item Index
	 *	@param	integer	Item Level
	 *	@param	&array	Item Array Data
	 *
	 *	@return	array	Item Data
	*/
	public final function GetItemData($section = 0, $index = 0, $level = 0, &$itemData = array())
	{
		$this->ConstructItemDatabase();
		
		if(!($itemData = $this->database['Data'][$section][$index]))
			return false;
		
		$itemData['Name'] = $this->GetItemName($section, $index, $level);
		return $itemData;
	}
	/**
	 *	Get Item Name
	 *	Get item name from database
	 *	
	 *	@param	integer	Item Section
	 *	@param	integer	Item Index
	 *	@param	integer	Item Level
	 *	@param	string	Item String Name
	 *
	 *	@return	string	Item Name
	*/
	public final function GetItemName($section = 0, $index = 0, $level = 0, &$itemName = NULL)
	{
		$define = parse_ini_file($this->settings['Files']['DefineItems'], TRUE);
					
		if($define)
		{
			if(array_key_exists($section."-".$index, $define))
			{
				if(strlen($level) == 1) $level = "0".$level;
				if(array_key_exists("LEVEL_".$level, $define[$section."-".$index]))
				{
					return $itemName = $define[$section."-".$index]["LEVEL_".$level];
				}
			}
		}
		
		$this->ConstructItemDatabase();
		return $itemName = $this->database['Data'][$section][$index]['Name'];
	}
	/**
	 *	Get Item Size
	 *	Get the length from item database
	 *
	 *	@param	integer	Item Section
	 *	@param	integer	Item Index
	 *	@return	array	Item Size (X/Y)
	*/
	public final function GetItemSize($section, $index, &$itemSize = array())
	{
		$this->ConstructItemDatabase();
		return $itemSize = $this->database['Data'][$section][$index]['Size'];
	}
	/**
	 *	Get Socket Option
	 *	Get Socket options from database
	 *
	 *	@param	integer	Option Index
	 *	@param	&string	Option Data
	 *	@return	string	Option Data
	*/
	public final function GetSocketOption($index = -1, &$return = NULL)
	{
		$this->ConstructSocketDatabase();
		
		if($return = $this->database['Socket']['Options'][$index] && $index != -1)
			return $return;
		else
			$return = $this->database['Socket']['Options'];
			
		return $return;
	}
	/**
	 *	Check Define Item Name
	 *	Get item name is in DefineItems.ini
	 *	
	 *	@param	integer	Item Section
	 *	@param	integer	Item Index
	 *	@param	integer	Item Level
	 *
	 *	@return	boolean
	*/
	public final function CheckDefineItemName($section, $index, $level)
	{
		$define = parse_ini_file($this->settings['Files']['DefineItems'], TRUE);
					
		if($define)
		{
			if(array_key_exists($section."-".$index, $define))
			{
				if(strlen($level) == 1) $level = "0".$level;
				if(array_key_exists("LEVEL_".$level, $define[$section."-".$index]))
				{
					return true;
				}
			}
		}
		
		return false;
	}
	/**
	 *	Construct Item Database
	 *	Construct the item database from Item.txt
	 *
	 *	@return	void
	*/
	private final function ConstructItemDatabase()
	{
		$serialize_file = CTM_FileManage::Lib('ReadScript')->CheckSerializeFile("Item_Data.serialize.dat") == false;
		$structure_file = CTM_FileManage::Lib('ReadScript')->StructureFile($this->settings['Files']['Database'], "Item_Data.serialize.dat", TRUE);
		$serialize_data = CTM_FileManage::Lib('ReadScript')->ReadScript();
		
		if($serialize_file == true || $structure_file == true)
		{
			foreach($serialize_data as $key => $lines)
			{
				foreach($lines as $itemId => $item)
				{
					$this->database['Data'][$key][$itemId]['Section'] = $key;
					$this->database['Data'][$key][$itemId]['Index'] = $itemId;
					
					if($this->settings['dbVersion'] >= 2)
					{
						$this->database['Data'][$key][$itemId]['Slot'] = $item[0];
						$this->database['Data'][$key][$itemId]['Skill'] = $item[1];
						$this->database['Data'][$key][$itemId]['Size']['x'] = $item[2];
						$this->database['Data'][$key][$itemId]['Size']['y'] = $item[3];
						$this->database['Data'][$key][$itemId]['HaveSerial'] = $item[4];
						$this->database['Data'][$key][$itemId]['HaveOption'] = $item[5];
						$this->database['Data'][$key][$itemId]['DropItem'] = $item[6];
						$this->database['Data'][$key][$itemId]['Name'] = $item[7];
						
						if($key <> 14)
						{
							$this->database['Data'][$key][$itemId]['Level'] = $item[8];
						}
						
						if($key > -1 && $key < 6)
						{
							$this->database['Data'][$key][$itemId]['Damage']['Min'] = $item[9];
							$this->database['Data'][$key][$itemId]['Damage']['Min'] = $item[10];
							$this->database['Data'][$key][$itemId]['AttackSpeed'] = $item[11];
							$this->database['Data'][$key][$itemId]['Durability'] = $item[12];
							$this->database['Data'][$key][$itemId]['Magic']['Durability'] = $item[13];
							$this->database['Data'][$key][$itemId]['Magic']['Damage'] = $item[14];
							$this->database['Data'][$key][$itemId]['Requirement']['Level'] = $item[15];
							$this->database['Data'][$key][$itemId]['Requirement']['Strength'] = $item[16];
							$this->database['Data'][$key][$itemId]['Requirement']['Dexterity'] = $item[17];
							$this->database['Data'][$key][$itemId]['Requirement']['Vitality'] = $item[18];
							$this->database['Data'][$key][$itemId]['Requirement']['Energy'] = $item[19];
							$this->database['Data'][$key][$itemId]['Requirement']['Command'] = $item[20];
							#this->database['Data'][$key][$itemId]['None'] = $item[21];
							$this->database['Data'][$key][$itemId]['ClassUse']['SM'] = $item[22];
							$this->database['Data'][$key][$itemId]['ClassUse']['BK'] = $item[23];
							$this->database['Data'][$key][$itemId]['ClassUse']['ME'] = $item[24];
							$this->database['Data'][$key][$itemId]['ClassUse']['MG'] = $item[25];
							$this->database['Data'][$key][$itemId]['ClassUse']['DL'] = $item[26];
							$this->database['Data'][$key][$itemId]['ClassUse']['SU'] = $item[27];
							$this->database['Data'][$key][$itemId]['ClassUse']['RF'] = $item[28];
						}
						elseif($key > 5 && $key < 12)
						{
							$this->database['Data'][$key][$itemId]['Defense'] = $item[9];
							
							switch($key)
							{
								case 6 : $this->database['Data'][$key][$itemId]['DefenseSuccess'] = $item[10]; break;
								case 7 : $this->database['Data'][$key][$itemId]['MagicSuccess'] = $item[10]; break;
								case 8 : $this->database['Data'][$key][$itemId]['MagicSuccess'] = $item[10]; break;
								case 9 : $this->database['Data'][$key][$itemId]['MagicSuccess'] = $item[10]; break;
								case 10 : $this->database['Data'][$key][$itemId]['AttackSpeed'] = $item[10]; break;
								case 11 : $this->database['Data'][$key][$itemId]['WalkSpeed'] = $item[10]; break;
							}
								
							$this->database['Data'][$key][$itemId]['Durability'] = $item[11];
							$this->database['Data'][$key][$itemId]['Requirement']['Level'] = $item[12];
							$this->database['Data'][$key][$itemId]['Requirement']['Strength'] = $item[13];
							$this->database['Data'][$key][$itemId]['Requirement']['Dexterity'] = $item[14];
							$this->database['Data'][$key][$itemId]['Requirement']['Vitality'] = $item[15];
							$this->database['Data'][$key][$itemId]['Requirement']['Energy'] = $item[16];
							$this->database['Data'][$key][$itemId]['Requirement']['Command'] = $item[17];
							#this->database['Data'][$key][$itemId]['None'] = $item[18];
							$this->database['Data'][$key][$itemId]['ClassUse']['SM'] = $item[19];
							$this->database['Data'][$key][$itemId]['ClassUse']['BK'] = $item[20];
							$this->database['Data'][$key][$itemId]['ClassUse']['ME'] = $item[21];
							$this->database['Data'][$key][$itemId]['ClassUse']['MG'] = $item[22];
							$this->database['Data'][$key][$itemId]['ClassUse']['DL'] = $item[23];
							$this->database['Data'][$key][$itemId]['ClassUse']['SU'] = $item[24];
							$this->database['Data'][$key][$itemId]['ClassUse']['RF'] = $item[25];
						}
						elseif($key > 11 && $key < 13)
						{
							$this->database['Data'][$key][$itemId]['Defense'] = $item[9];
							$this->database['Data'][$key][$itemId]['Durability'] = $item[10];
							$this->database['Data'][$key][$itemId]['Requirement']['Level'] = $item[11];
							$this->database['Data'][$key][$itemId]['Requirement']['Energy'] = $item[12];
							$this->database['Data'][$key][$itemId]['Requirement']['Strength'] = $item[13];
							$this->database['Data'][$key][$itemId]['Requirement']['Dexterity'] = $item[14];
							$this->database['Data'][$key][$itemId]['Requirement']['Command'] = $item[15];
							$this->database['Data'][$key][$itemId]['BuyMoney'] = $item[16];
							$this->database['Data'][$key][$itemId]['ClassUse']['SM'] = $item[17];
							$this->database['Data'][$key][$itemId]['ClassUse']['BK'] = $item[18];
							$this->database['Data'][$key][$itemId]['ClassUse']['ME'] = $item[19];
							$this->database['Data'][$key][$itemId]['ClassUse']['MG'] = $item[20];
							$this->database['Data'][$key][$itemId]['ClassUse']['DL'] = $item[21];
							$this->database['Data'][$key][$itemId]['ClassUse']['SU'] = $item[22];
							$this->database['Data'][$key][$itemId]['ClassUse']['RF'] = $item[23];
						}
						elseif($key > 12 && $key < 14)
						{
							$this->database['Data'][$key][$itemId]['Durability'] = $item[9];
							$this->database['Data'][$key][$itemId]['Resistance'][1] = $item[10];
							$this->database['Data'][$key][$itemId]['Resistance'][2] = $item[11];
							$this->database['Data'][$key][$itemId]['Resistance'][3] = $item[12];
							$this->database['Data'][$key][$itemId]['Resistance'][4] = $item[13];
							$this->database['Data'][$key][$itemId]['Resistance'][5] = $item[14];
							$this->database['Data'][$key][$itemId]['Resistance'][6] = $item[15];
							$this->database['Data'][$key][$itemId]['Resistance'][7] = $item[16];
							#this->database['Data'][$key][$itemId]['None'] = $item[17];
							$this->database['Data'][$key][$itemId]['ClassUse']['SM'] = $item[18];
							$this->database['Data'][$key][$itemId]['ClassUse']['BK'] = $item[19];
							$this->database['Data'][$key][$itemId]['ClassUse']['ME'] = $item[20];
							$this->database['Data'][$key][$itemId]['ClassUse']['MG'] = $item[21];
							$this->database['Data'][$key][$itemId]['ClassUse']['DL'] = $item[22];
							$this->database['Data'][$key][$itemId]['ClassUse']['SU'] = $item[23];
							$this->database['Data'][$key][$itemId]['ClassUse']['RF'] = $item[24];
						}
						elseif($key > 13 && $key < 15)
						{
							$this->database['Data'][$key][$itemId]['Value'] = $item[8];
							$this->database['Data'][$key][$itemId]['Level'] = $item[9];
						}
						elseif($key > 14 && $key < 16)
						{
							$this->database['Data'][$key][$itemId]['Requirement']['Level'] = $item[9];
							$this->database['Data'][$key][$itemId]['Requirement']['Energy'] = $item[10];
							$this->database['Data'][$key][$itemId]['BuyMoney'] = $item[11];
							$this->database['Data'][$key][$itemId]['ClassUse']['SM'] = $item[12];
							$this->database['Data'][$key][$itemId]['ClassUse']['BK'] = $item[13];
							$this->database['Data'][$key][$itemId]['ClassUse']['ME'] = $item[14];
							$this->database['Data'][$key][$itemId]['ClassUse']['MG'] = $item[15];
							$this->database['Data'][$key][$itemId]['ClassUse']['DL'] = $item[16];
							$this->database['Data'][$key][$itemId]['ClassUse']['SU'] = $item[17];
							$this->database['Data'][$key][$itemId]['ClassUse']['RF'] = $item[18];
						}
					}
					else
					{
						$this->database['Data'][$key][$itemId]['Slot'] = $item[0];
						$this->database['Data'][$key][$itemId]['Size']['x'] = $item[1];
						$this->database['Data'][$key][$itemId]['Size']['y'] = $item[2];
						$this->database['Data'][$key][$itemId]['HaveSerial'] = $item[3];
						$this->database['Data'][$key][$itemId]['DropItem'] = $item[4];
						$this->database['Data'][$key][$itemId]['Name'] = $item[5];
						
						if($key <> 14)
						{
							$this->database['Data'][$key][$itemId]['Level'] = $item[6];
						}
						elseif($key > -1 && $key < 6)
						{
							$this->database['Data'][$key][$itemId]['Damage']['Min'] = $item[7];
							$this->database['Data'][$key][$itemId]['Damage']['Min'] = $item[8];
							$this->database['Data'][$key][$itemId]['AttackSpeed'] = $item[9];
							$this->database['Data'][$key][$itemId]['Durability'] = $item[10];
							$this->database['Data'][$key][$itemId]['Magic']['Durability'] = $item[11];
							$this->database['Data'][$key][$itemId]['Requirement']['Level'] = $item[12];
							$this->database['Data'][$key][$itemId]['Requirement']['Strength'] = $item[13];
							$this->database['Data'][$key][$itemId]['ClassUse']['SM'] = $item[14];
							$this->database['Data'][$key][$itemId]['ClassUse']['BK'] = $item[15];
							$this->database['Data'][$key][$itemId]['ClassUse']['ME'] = $item[16];
							$this->database['Data'][$key][$itemId]['ClassUse']['MG'] = $item[17];
							$this->database['Data'][$key][$itemId]['ClassUse']['DL'] = $item[18];
						}
						elseif($key > 5 && $key < 12)
						{
							$this->database['Data'][$key][$itemId]['Defense'] = $item[7];
							$i = $key > 7 ? 1 : 0;
							
							switch($key)
							{
								case 7 : $this->database['Data'][$key][$itemId]['MagicSuccess'] = $item[8]; break;
								case 8 : $this->database['Data'][$key][$itemId]['MagicSuccess'] = $item[8]; break;
								case 9 : $this->database['Data'][$key][$itemId]['MagicSuccess'] = $item[8]; break;
								case 10 : $this->database['Data'][$key][$itemId]['AttackSpeed'] = $item[8]; break;
								case 11 : $this->database['Data'][$key][$itemId]['WalkSpeed'] = $item[8]; break;
							}
							
							$this->database['Data'][$key][$itemId]['Durability'] = $item[8 + $i];
							$this->database['Data'][$key][$itemId]['Requirement']['Level'] = $item[9 + $i];
							$this->database['Data'][$key][$itemId]['Requirement']['Strength'] = $item[10 + $i];
							$this->database['Data'][$key][$itemId]['ClassUse']['SM'] = $item[11 + $i];
							$this->database['Data'][$key][$itemId]['ClassUse']['BK'] = $item[12 + $i];
							$this->database['Data'][$key][$itemId]['ClassUse']['ME'] = $item[13 + $i];
							$this->database['Data'][$key][$itemId]['ClassUse']['MG'] = $item[14 + $i];
							$this->database['Data'][$key][$itemId]['ClassUse']['DL'] = $item[15 + $i];
						}
						elseif($key > 11 && $key < 13)
						{
							$this->database['Data'][$key][$itemId]['Defense'] = $item[9];
							$this->database['Data'][$key][$itemId]['Durability'] = $item[10];
							$this->database['Data'][$key][$itemId]['Requirement']['Level'] = $item[11];
							$this->database['Data'][$key][$itemId]['Requirement']['Energy'] = $item[12];
							$this->database['Data'][$key][$itemId]['Requirement']['Strength'] = $item[13];
							$this->database['Data'][$key][$itemId]['Requirement']['Dexterity'] = $item[14];
							$this->database['Data'][$key][$itemId]['Requirement']['Command'] = $item[15];
							$this->database['Data'][$key][$itemId]['BuyMoney'] = $item[16];
							$this->database['Data'][$key][$itemId]['ClassUse']['SM'] = $item[17];
							$this->database['Data'][$key][$itemId]['ClassUse']['BK'] = $item[18];
							$this->database['Data'][$key][$itemId]['ClassUse']['ME'] = $item[19];
							$this->database['Data'][$key][$itemId]['ClassUse']['MG'] = $item[20];
							$this->database['Data'][$key][$itemId]['ClassUse']['DL'] = $item[21];
							$this->database['Data'][$key][$itemId]['ClassUse']['SU'] = $item[22];
							$this->database['Data'][$key][$itemId]['ClassUse']['RF'] = $item[23];
						}
						elseif($key > 12 && $key < 14)
						{
							$this->database['Data'][$key][$itemId]['Durability'] = $item[9];
							$this->database['Data'][$key][$itemId]['Resistance'][1] = $item[10];
							$this->database['Data'][$key][$itemId]['Resistance'][2] = $item[11];
							$this->database['Data'][$key][$itemId]['Resistance'][3] = $item[12];
							$this->database['Data'][$key][$itemId]['Resistance'][4] = $item[13];
							$this->database['Data'][$key][$itemId]['Resistance'][5] = $item[14];
							$this->database['Data'][$key][$itemId]['Resistance'][6] = $item[15];
							$this->database['Data'][$key][$itemId]['Resistance'][7] = $item[16];
							#this->database['Data'][$key][$itemId]['None'] = $item[17];
							$this->database['Data'][$key][$itemId]['ClassUse']['SM'] = $item[18];
							$this->database['Data'][$key][$itemId]['ClassUse']['BK'] = $item[19];
							$this->database['Data'][$key][$itemId]['ClassUse']['ME'] = $item[20];
							$this->database['Data'][$key][$itemId]['ClassUse']['MG'] = $item[21];
							$this->database['Data'][$key][$itemId]['ClassUse']['DL'] = $item[22];
							$this->database['Data'][$key][$itemId]['ClassUse']['SU'] = $item[23];
							$this->database['Data'][$key][$itemId]['ClassUse']['RF'] = $item[24];
						}
						elseif($key > 13 && $key < 15)
						{
							$this->database['Data'][$key][$itemId]['Value'] = $item[8];
							$this->database['Data'][$key][$itemId]['Level'] = $item[9];
						}
						elseif($key > 14 && $key < 16)
						{
							$this->database['Data'][$key][$itemId]['Requirement']['Level'] = $item[9];
							$this->database['Data'][$key][$itemId]['Requirement']['Energy'] = $item[10];
							$this->database['Data'][$key][$itemId]['BuyMoney'] = $item[11];
							$this->database['Data'][$key][$itemId]['ClassUse']['SM'] = $item[12];
							$this->database['Data'][$key][$itemId]['ClassUse']['BK'] = $item[13];
							$this->database['Data'][$key][$itemId]['ClassUse']['ME'] = $item[14];
							$this->database['Data'][$key][$itemId]['ClassUse']['MG'] = $item[15];
							$this->database['Data'][$key][$itemId]['ClassUse']['DL'] = $item[16];
							$this->database['Data'][$key][$itemId]['ClassUse']['SU'] = $item[17];
							$this->database['Data'][$key][$itemId]['ClassUse']['RF'] = $item[18];
						}
					}
				}
			}
			
			CTM_FileManage::Lib('ReadScript')->WriteSerializeData("Item_Data.serialize.dat", $this->database['Data'], md5_file($this->settings['Files']['Database']));
		}
		elseif(!$this->database['Data'])
			$this->database['Data'] = $serialize_data;
	}
	/**
	 *	Construct Socket Database
	 *	Construct the socket database from SocketSystem.txt
	 *
	 *	@return	void
	*/
	private final function ConstructSocketDatabase()
	{
		$serialize_file = CTM_FileManage::Lib('ReadScript')->CheckSerializeFile("Item_SocketSystem.serialize.dat") == false;
		$structure_file = CTM_FileManage::Lib('ReadScript')->StructureFile($this->settings['Files']['SocketSystem'], "Item_SocketSystem.serialize.dat", TRUE);
		$serialize_data = CTM_FileManage::Lib('ReadScript')->ReadScript();
		
		if($serialize_file == true || $structure_file == true)
		{
			foreach($serialize_data[0] as $key => $value)
				$this->database['Socket']['Types'][$key] = array("Index" => $key, "Name" => $value);
			
			foreach($serialize_data[1] as $key => $value)
			{
				$this->database['Socket']['Options'][$key]['Index'] = $key;
				$this->database['Socket']['Options'][$key]['Type'] = $value[0];
				$this->database['Socket']['Options'][$key]['Name'] = $value[1];
				$this->database['Socket']['Options'][$key]['Values'][1] = $value[2];
				$this->database['Socket']['Options'][$key]['Values'][2] = $value[3];
				$this->database['Socket']['Options'][$key]['Values'][3] = $value[4];
				$this->database['Socket']['Options'][$key]['Values'][4] = $value[5];
				$this->database['Socket']['Options'][$key]['Values'][5] = $value[6];
			}
			
			CTM_FileManage::Lib('ReadScript')->WriteSerializeData("Item_SocketSystem.serialize.dat", $this->database['Socket'], md5_file($this->settings['Files']['SocketSystem']));
		}
		elseif(!$this->database['Socket'])
		{
			$this->database['Socket']['Types'] = $serialize_data['Types'];
			$this->database['Socket']['Options'] = $serialize_data['Options'];
		}
	}
}