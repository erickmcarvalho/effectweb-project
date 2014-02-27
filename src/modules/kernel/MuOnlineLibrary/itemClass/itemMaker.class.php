<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * MuOnline Library: Item - Maker Class
 * Author: $CTM['Erick-Master']
 * Last Update: 16/04/2012 - 19:30h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

final class MuOnline_ItemMaker extends MuOnline_Item
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
	 *	Item Properties
	 *
	 *	@access	private
	 *	@var	array	Properties
	*/
	private $properties	= array();
	/**
	 *	Item Section
	 *
	 *	@access	private
	 *	@var	integer	Item Section
	*/
	private $section	= 0;
	/**
	 *	Item Index
	 *
	 *	@access	private
	 *	@var	integer	Item Index
	*/
	private $index		= 0;
	/**
	 *	Maker Variables
	 *
	 *	@access	private
	 *	@var	array	Maker Variables
	*/
	private $vars		= array();
	/**
	 *	Maker Options
	 *
	 *	@access	private
	 *	@var	array	Maker Variables Options
	*/
	private $options	= array("Excellent" => false);
	/**
	 *	Final Hex Item
	 *
	 *	@access	private
	 *	@var	string	Final Item Hex
	*/
	private $hexItem	= NULL;
	
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
	 *	Make Item Hex
	 *	Start a maker item
	 *	
	 *	@param	integer	Item Section
	 *	@param	integer	Item Index
	 *	@param	array	Item Properties
	 *	@param	integer	DB Version (0 = Old / 1 = New)
	 *
	 *	@return	string	Item Hexa
	*/
	public final function MakeItem($section, $index, $properties, $dbVersion = -1)
	{
		$this->section = intval($section);
		$this->index = intval($index);
		$this->properties = $properties;
		$this->hexItem = NULL;
		
		if($dbVersion != -1)
		{
			$this->tempSts['dbVersion'] = $dbVersion;
			$this->settings['dbVersion'] = intval($dbVersion);
		}
		
		$this->loadPrimaryFunction();
		$this->loadSetIndex();
		$this->loadSetProperties();
		$this->loadSetOption();
		$this->loadSetExcellent();
		$this->loadSetDBNewOptions();
		$this->loadSetJewelOfHarmony();
		$this->loadSetSocketOption();
		$this->loadSetDurability();
		$this->loadGenerateHexItem();
		$this->loadFinishMaker();
		
		return $this->hexItem;
	}
	/**
	 *	Primary Function
	 *
	 *	@return	void
	*/
	private final function loadPrimaryFunction()
	{
		for($i = 0; $i < 7 + ($this->settings['dbVersion'] >= 2 ? 5 : 0); $i++)
			$this->vars[$i] = 0;
			
		if($this->properties['Serial'])
			$this->vars[3] = $this->loadPadFix($this->properties['Serial'], 8);
		else
			$this->vars[3] = $this->loadPadFix($this->GetItemSerial(), 8);
	}
	/**
	 *	Set Index
	 *
	 *	@return	void
	*/
	private final function loadSetIndex()
	{
		$this->vars[0] = intval($this->index);
		
		if($this->settings['dbVersion'] < 2)
		{
			$this->vars[0] = (($this->index & 0x1F) | (($this->section << 5) & 0xE0)) & 0xFF;
			if($this->section > 7) $this->vars[4] += 128;
		}
	}
	/**
	 *	Set Properties
	 *
	 *	@return	void
	*/
	private final function loadSetProperties()
	{
		if($this->properties['Level'] > 0) $this->vars[1] += $this->properties['Level'] * 8;
		if($this->properties['Skill'] == true) $this->vars[1] += 128;
		if($this->properties['Luck'] == true) $this->vars[1] += 4;
		
		if($this->properties['Ancient'] == 1) $this->vars[5] = 5;
		if($this->properties['Ancient'] == 2) $this->vars[5] = 10;
	}
	/**
	 *	Set Option
	 *
	 *	@return void
	*/
	private final function loadSetOption()
	{
		switch($this->properties['Option'])
		{
			case 4 : $this->vars[1] += 1; break;
			case 8 : $this->vars[1] += 2; break;
			case 12 : $this->vars[1] += 3; break;
			case 16 : $this->vars[1] += 0; break;
			case 20 : $this->vars[1] += 1; break;
			case 24 : $this->vars[1] += 2; break;
			case 28 : $this->vars[1] += 3; break;
		}
		
		if($this->properties['Option'] >= 16) $this->vars[4] += 64;
	}
	/**
	 *	Set Excellent
	 *
	 *	@return void
	*/
	private final function loadSetExcellent()
	{
		if(is_array($this->properties['Excellent']))
		{
			$excellent = 0;
			
			if($this->properties['Excellent'][0] == true) $excellent += 1;
			if($this->properties['Excellent'][1] == true) $excellent += 2;
			if($this->properties['Excellent'][2] == true) $excellent += 4;
			if($this->properties['Excellent'][3] == true) $excellent += 8;
			if($this->properties['Excellent'][4] == true) $excellent += 16;
			if($this->properties['Excellent'][5] == true) $excellent += 32;
			
			if($excellent > 0)
			{
				$this->vars[4] += $excellent;
				$this->options['Excellent'] = TRUE;
			}
		}
	}
	/**
	 *	Set DB-2 Options
	 *
	 *	@return void
	*/
	private final function loadSetDBNewOptions()
	{
		if($this->settings['dbVersion'] >= 2)
		{
			$this->vars[6] += $this->section * 2;
			$this->vars[6] += $this->properties['Refine'] == true ? 1 : 0;
			$this->vars[6] *= 8;
		}
	}
	/*
	 *	Set Jewel Of Harmony (DB Version = 2)
	 *
	 *	@return void
	*/
	private final function loadSetJewelOfHarmony()
	{
		if($this->settings['dbVersion'] >= 2)
		{
			if(is_array($this->properties['JewelOfHarmony']) && count($this->properties['JewelOfHarmony']) >= 2)
			{
				$t = $this->properties['JewelOfHarmony'][0];
				$l = $this->properties['JewelOfHarmony'][1];
				
				if(($t > 0 && $t < 16) && ($l > -1 && $l < 16))
					return $this->vars[7] = ($t * 16) | $l;
			}
			
			$this->vars[7] = 0;
		}
	}
	/*
	 *	Set Socket Option (DB Version = 2 / S4)
	 *
	 *	SocketSystem = 1: WebZen
	 *	SocketSystem = 2: SCFMuTeam
	 *
	 *	@return void
	*/
	private final function loadSetSocketOption()
	{
		if($this->settings['dbVersion'] >= 2)
		{
			$a = 0;
			$b = 0;
			$c = 0;
			$d = 0;
			$e = 0;
			
			if($this->settings['SocketSystem'] > 0)
			{
				if($this->settings['SocketSystem'] == 1)
				{
					$a = 255;
					$b = 255;
					$c = 255;
					$d = 255;
					$e = 255;
				}
				elseif($this->settings['SocketSystem'] == 2)
				{
					$a = 0;
					$b = 0; 
					$c = 0;
					$d = 0;
					$e = 0;
				}
				
				if(is_array($this->properties['SocketOption']) && count($this->properties['SocketOption']) > 0)
				{
					if($this->settings['SocketSystem'] == 1)
					{
						$a = 254;
						$b = 254;
						$c = 254;
						$d = 254;
						$e = 254;
					}
					elseif($this->settings['SocketSystem'] == 2)
					{
						$a = 255;
						$b = 255; 
						$c = 255;
						$d = 255;
						$e = 255;
					}
					
					
					$database = $this->Database()->GetSocketOption();
					$sockets = $this->properties['SocketOption'];
					
					if($sockets[0][1] < 0) $sockets[0][1] = 0;
					if($sockets[1][1] < 0) $sockets[1][1] = 0;
					if($sockets[2][1] < 0) $sockets[2][1] = 0;
					if($sockets[3][1] < 0) $sockets[3][1] = 0;
					if($sockets[4][1] < 0) $sockets[4][1] = 0;
					
					if($sockets[0][1] > 4) $sockets[0][1] = 4;
					if($sockets[1][1] > 4) $sockets[1][1] = 4;
					if($sockets[2][1] > 4) $sockets[2][1] = 4;
					if($sockets[3][1] > 4) $sockets[3][1] = 4;
					if($sockets[4][1] > 4) $sockets[4][1] = 4;
					
					if($this->settings['SocketSystem'] >= 2)
					{
						if(!$sockets[0][0]) $sockets[0][0] = -1;
						if(!$sockets[1][0]) $sockets[1][0] = -1;
						if(!$sockets[2][0]) $sockets[2][0] = -1;
						if(!$sockets[3][0]) $sockets[3][0] = -1;
						if(!$sockets[4][0]) $sockets[4][0] = -1;
						
						if($sockets[0][0] > -1) $sockets[0][0]++;
						if($sockets[1][0] > -1) $sockets[1][0]++;
						if($sockets[2][0] > -1) $sockets[2][0]++;
						if($sockets[3][0] > -1) $sockets[3][0]++;
						if($sockets[4][0] > -1) $sockets[4][0]++;
					}
					
					if(is_array($sockets[0]) && $sockets[0][0] > -1 && array_key_exists($sockets[0][0], $database))
						$a = $sockets[0][0] + ($sockets[0][1] * 50);
						
					if(is_array($sockets[1]) && $sockets[1][0] > -1 && array_key_exists($sockets[1][0], $database))
						$b = $sockets[1][0] + ($sockets[1][1] * 50);
						
					if(is_array($sockets[2]) && $sockets[2][0] > -1 && array_key_exists($sockets[2][0], $database))
						$c = $sockets[2][0] + ($sockets[2][1] * 50);
						
					if(is_array($sockets[3]) && $sockets[3][0] > -1 && array_key_exists($sockets[3][0], $database))
						$d = $sockets[3][0] + ($sockets[3][1] * 50);
						
					if(is_array($sockets[4]) && $sockets[4][0] > -1 && array_key_exists($sockets[4][0], $database))
						$e = $sockets[4][0] + ($sockets[4][1] * 50);
						
						
					if($sockets[0][0] == -2 || $sockets[0] == -2)
						$a = ($this->settings['SocketSystem'] >= 2 ? 0 : 255);
						
					if($sockets[1][0] == -2 || $sockets[1] == -2)
						$b = ($this->settings['SocketSystem'] >= 2 ? 0 : 255);
						
					if($sockets[2][0] == -2 || $sockets[2] == -2)
						$c = ($this->settings['SocketSystem'] >= 2 ? 0 : 255);
						
					if($sockets[3][0] == -2 || $sockets[3] == -2)
						$d = ($this->settings['SocketSystem'] >= 2 ? 0 : 255);
						
					if($sockets[4][0] == -2 || $sockets[4] == -2)
						$e = ($this->settings['SocketSystem'] >= 2 ? 0 : 255);
						
					//$this->vars[7] = 0;
				}
			}
			
			$this->vars[8] = $a;
			$this->vars[9] = $b;
			$this->vars[10] = $c;
			$this->vars[11] = $d;
			$this->vars[12] = $e;
		}
	}
	/*
	 *	Set Durability
	 *
	 *	@return void
	*/
	private final function loadSetDurability()
	{
		if($this->properties['Durability'] >= 255)
			return $this->vars[2] = 255;
			
		$this->vars[2] = $this->properties['Durability'];
		$level = $this->properties['Level'];
			
		if($this->index >= 27 && $this->section == 14 && $level == 3) $level = 0;
		if($this->index >= 29 && $this->section == 14) return $this->vars[2] = 1;
			
		if($level < 5) $this->vars[2] += $level;
		else 
		{
			switch($level)
			{
				case 10 : $this->vars[2] += ($level * 2 - 3); break;
				case 11 : $this->vars[2] += ($level * 2 - 1); break;
				case 12 : $this->vars[2] += ($level * 2 + 2); break;
				case 13 : $this->vars[2] += ($level * 2 + 6); break;
				case 14 : $this->vars[2] += ($level * 2 + 11); break;
				case 15 : $this->vars[2] += ($level * 2 + 17); break;
				default : $this->vars[2] += ($level * 2 - 4); break;
			}
		}
			
		if(!($this->index == 3  && $this->section == 12)
		&& !($this->index == 4  && $this->section == 12)
		&& !($this->index == 5  && $this->section == 12)
		&& !($this->index == 6  && $this->section == 12)
		&& !($this->index == 36  && $this->section == 12)
		&& !($this->index == 37  && $this->section == 12)
		&& !($this->index == 38  && $this->section == 12)
		&& !($this->index == 39  && $this->section == 12)
		&& !($this->index == 40  && $this->section == 12)
		&& !($this->index == 43  && $this->section == 12)
		&& !($this->index == 19  && $this->section == 0)
		&& !($this->index == 18  && $this->section == 4)
		&& !($this->index == 10  && $this->section == 5)
		&& !($this->index == 13  && $this->section >= 2)
		&& !($this->index == 30  && $this->section == 13))
			if($this->vars[5] > 0) $this->vars[2] += 20;
			elseif($this->options['Excellent'] == true) $this->vars[2] += 15;
			
		return $this->vars[2] = ($this->vars[2] >= 255 ? 255 : $this->vars[2]);
	}
	/*
	 *	Generate Hex Item
	 *
	 *	@return void
	*/
	private final function loadGenerateHexItem()
	{
		foreach($this->vars as $key => $value)
		{
			if($key != 3)
				$value = $this->loadHexByte($value);
			
			$this->hexItem .= $value;
		}
			
		$this->hexItem = strtoupper($this->hexItem);
	}
	/*
	 *	Finish Maker
	 *
	 *	@return void
	*/
	private final function loadFinishMaker()
	{
		foreach($this->tempSts as $key => $value)
			$this->settings[$key] = $value;
			
		$this->section = 0;
		$this->index = 0;
		
		$this->tempSts = array();
		$this->vars = array();
		
		$this->options = array("Excellent" => false);
	}
	/*
	 *	Hex Byte
	 *
	 *	@param	integer	Input
	 *	@return string
	*/
	private final function loadHexByte($input)
	{
		return $this->loadPadFix(dechex(intval($input)));
	}
	/*
	 *	Pad Fix
	 *
	 *	@param	string	Input
	 *	@param	integer	Length
	 *	@return	string
	*/
	private final function loadPadFix($input, $length = 2)
	{
		return str_pad($input, $length, 0, STR_PAD_LEFT);
	}
}