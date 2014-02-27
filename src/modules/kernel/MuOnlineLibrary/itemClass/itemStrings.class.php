<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * MuOnline Library: Item - Strings Class
 * Author: $CTM['Erick-Master']
 * Last Update: 21/06/2012 - 23:43h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class MuOnline_ItemStrings extends MuOnline_Item
{
	/**
	 *	Lib Settings
	 *
	 *	@access	private
	 *	@var	array	Library Settings
	*/
	private $settings			= array();
	/**
	 *	Info Strings
	 *
	 *	@access	private
	 *	@var	array	Info Strings Database
	*/
	private $infoStrings		= array();
	/**
	 *	Excellent Strings
	 *
	 *	@access	private
	 *	@var	array	Excellent Strings Database
	*/
	private $excellentStrings	= array();
	/**
	 *	Jewel Of Harmony Strings
	 *
	 *	@access	private
	 *	@var	array	Harmony Strings Database
	*/
	private $harmonyStrings		= array();
	/**
	 *	Socket System Strings
	 *
	 *	@access	private
	 *	@var	array	Socket Strings Database
	*/
	private $socketStrings		= array();
	
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
	 *	Get Item Info
	 *	Get info string from database
	 *
	 *	@param	integer	Info Id
	 *	@param	string	Language
	 *	@param	integer	Info return value
	 *	@return	string
	*/
	public final function GetItemInfo($id, $language, $return = 0)
	{
		if(!$this->infoStrings)
		{
			CTM_FileManage::Lib('ReadScript')->StructureFile($this->settings['Files']['InfoStrings'], "Item_InfoStrings.serialize.dat", TRUE);
			CTM_FileManage::Lib('ReadScript')->ReadScript(NULL, $serialize_data);
			
			$this->infoStrings = $serialize_data;
		}
		
		return utf8_encode($this->infoStrings[$id][$language][$return]);
	}
	/**
	 *	Get Excellent Data
	 *	Get excellent options from database
	 *	
	 *	@param	integer	Item Section
	 *	@param	integer	Item Index
	 *	@param	integer	Item Slot
	 *	@param	integer	Item Level
	 *	@param	&array	Excellent Array Options
	 *
	 *	@return	array	Excellent options
	*/
	public final function GetExcellentData($section = 0, $index = 0, $level = 0, $slot = -1, &$excellentData = array())
	{
		if(!$this->excellentStrings)
		{
			CTM_FileManage::Lib('ReadScript')->StructureFile($this->settings['Files']['ExcellentOptions'], "Item_ExcellentOptions.serialize.dat", TRUE);
			CTM_FileManage::Lib('ReadScript')->ReadScript(NULL, $serialize_data);
			
			$this->excellentStrings = $serialize_data;
		}
		
		/* Attack: Swords ~ Staff */
		if($section >= 0 && $section <= 5)
			$database = $this->excellentStrings['ATTACK'];
		
		/* Defense: Shields/Sets */
		elseif($section >= 6 && $section <= 11)
			$database = $this->excellentStrings['DEFENSE'];
			
		/* Wings: Level 1/2 */	
		elseif($slot == 7 && ($section == 12 && $index >= 0 && $index <= 6))
			$database = $this->excellentStrings['WINGS:LV1-2'];
		
		/* Wings: Level 1/2 (Summoner) */	
		elseif($slot == 7 && ($section == 12 && $index >= 41 && $index <= 42))
			die;//$database = $this->excellentStrings['WINGS:LV1-2'];
			
		/* Wings: Level 2 (Dark Lord) */
		elseif($slot == 7 && ($section == 13 && $index == 30))
			$database = $this->excellentStrings['WINGS:CAPES'];
			
		/* Wings: Level 2 (Rage Fighter) */
		elseif($slot == 7 && ($section == 12 && $index == 49))
			$database = $this->excellentStrings['WINGS:CAPES'];
			
		/* Wings: Level 3 */
		elseif($slot == 7 && ($section == 12 && $index >= 36 && $index <= 40))
			$database = $this->excellentStrings['WINGS:LV3'];
		
		/* Wings: Level 3 (Summoner) */	
		elseif($slot == 7 && ($section == 12 && $index == 43 && $index == 43))
			$database = $this->excellentStrings['WINGS:LV3'];
		
		/* Wings: Level 3 (Rage Fighter) */	
		elseif($slot == 7 && ($section == 12 && $index == 50 && $index == 50))
			$database = $this->excellentStrings['WINGS:LV3'];
		
		/* Special Items: Horn of Fenrir */
		elseif($section == 13 && $slot == 8 && $index == 37)
			$database = $this->excellentStrings['FENRI'];
			
		/* Defense: Pets/Items */	
		elseif($section == 13 && $section == 13)
			$database = $this->excellentStrings['DEFENSE'];
		
		if($database)
		{
			foreach($database as $key => $value)
			{
				if(is_array($value))
				{
					if(!array_key_exists(0, $value)) $database[$key][0] = "None";
					if(!array_key_exists(1, $value)) $database[$key][1] = "None";
					if(!array_key_exists(2, $value)) $database[$key][2] = "None";
					if(!array_key_exists(3, $value)) $database[$key][3] = "None";
					if(!array_key_exists(4, $value)) $database[$key][4] = "None";
					if(!array_key_exists(5, $value)) $database[$key][5] = "None";
				}
				else
				{
					$database[$key][0] = "None";
					$database[$key][1] = "None";
					$database[$key][2] = "None";
					$database[$key][3] = "None";
					$database[$key][4] = "None";
					$database[$key][5] = "None";
				}
				
				$database[$key][0] = utf8_encode($value[0]);
				$database[$key][1] = utf8_encode($value[1]);
				$database[$key][2] = utf8_encode($value[2]);
				$database[$key][3] = utf8_encode($value[3]);
				$database[$key][4] = utf8_encode($value[4]);
				$database[$key][5] = utf8_encode($value[5]);
				
				for($i = 0; $i < 6; $i++)
				{
					if(preg_match("/\{!(.*?)!\}/is", $database[$key][$i], $match))
					{
						$str = str_replace("\$LEVEL", $level, $match[1]);
						eval("$"."row = ".$str.";");
						
						$database[$key][$i] = str_replace($match[0], $row, $database[$key][$i]);
					}
				}
			}
		}
		
		return $excellentData = $database;
	}
	/**
	 *	Get Harmony Data
	 *	Get Jewel Of Harmony options from database
	 *	
	 *	@param	integer	Item Section
	 *	@param	integer	Harmony Option
	 *	@param	integer	Harmony Level
	 *	@param	&array	Harmony Array Options
	 *
	 *	@return	array	Harmony options
	*/
	public final function GetHarmonyData($itemSection = 0, $harmonyOption = 0, $harmonyLevel = 0, &$harmonyData = array())
	{
		if(!$this->harmonyStrings)
		{
			CTM_FileManage::Lib('ReadScript')->StructureFile($this->settings['Files']['JewelOfHarmony'], "Item_JewelOfHarmony.serialize.dat", TRUE);
			CTM_FileManage::Lib('ReadScript')->ReadScript(NULL, $serialize_data);
			
			$this->harmonyStrings = $serialize_data;
		}
		
		if($itemSection >= 0 && $itemSection <= 4)
			if(array_key_exists($harmonyOption, $this->harmonyStrings[1]))
				$harmony = $this->harmonyStrings[1][$harmonyOption];
		
		if($itemSection == 5)
			if(array_key_exists($harmonyOption, $this->harmonyStrings[2]))
				$harmony = $this->harmonyStrings[2][$harmonyOption];
				
		if($itemSection >= 6 && $itemSection <= 44)
			if(array_key_exists($harmonyOption, $this->harmonyStrings[3]))
				$harmony = $this->harmonyStrings[3][$harmonyOption];
				
		if(!$harmony)
			return $harmonyData = array("Name" => "Error", "Value" => 0);
			
		return $harmonyData = array("Name" => $harmony[0], "Value" => $harmony[$harmonyLevel + 1]);
	}
	/**
	 *	Get Socket Data
	 *	Get Socket System options from database
	 *	
	 *	@param	integer	Socket Slot
	 *	@param	integer	Socket Option
	 *	@param	integer	Socket Level
	 *	@param	&string	Socket Data
	 *
	 *	@return	string	Socket options
	*/
	public final function GetSocketData($slot, $option, $level, &$socketData = NULL)
	{
		if(!$this->socketStrings)
		{
			CTM_FileManage::Lib('ReadScript')->StructureFile($this->settings['Files']['SocketSystem'], "Item_SocketStrings.serialize.dat", TRUE);
			CTM_FileManage::Lib('ReadScript')->ReadScript(NULL, $serialize_data);
			
			$this->socketStrings = $serialize_data;
		}
		
		if($option == -1)
			return $socketData = "Socket ".$slot." : Free Slot";
		
		$level += 2;
		
		$string = "Socket ".$slot." : ";
		$string .= $this->socketStrings[0][$this->socketStrings[1][$option][0]][0];
		$string .= " (".$this->socketStrings[1][$option][1].") + ";
		$string .= $this->socketStrings[1][$option][$level];
		
		return $socketData = $string;
	}
}