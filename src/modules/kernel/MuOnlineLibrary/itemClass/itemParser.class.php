<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * MuOnline Library: Item - Parser Class
 * Author: $CTM['Erick-Master']
 * Last Update: 19/04/2012 - 15:54h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

final class MuOnline_ItemParser
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
	 *	Result Variables
	 *
	 *	@access	private
	 *	@var	array	Parser Variables
	*/
	private $vars		= array();
	/**
	 *	 Hex Item
	 *
	 *	@access	private
	 *	@var	string	Item Hex
	*/
	private $hexItem	= NULL;
	/**
	 *	 Bytes Item
	 *
	 *	@access	private
	 *	@var	array	Item Hex
	*/
	private $bytes		= array();
	/**
	 *	Parse Result
	 *
	 *	@access	private
	 *	@var	string	Result Item
	*/
	private $result		= array();
	
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
	 *	Parse Item Hex
	 *	Start a parse item
	 *	
	 *	@param	string	Item Hex
	 *	@param	integer	DB Version (0 = Old / 1 = New)
	 *
	 *	@return	array	Item Array Properties
	*/
	public final function ParseItem($hex, $dbVersion = -1)
	{
		if($dbVersion != $this->settings['dbVersion'])
		{
			$this->tempSts['dbVersion'] = $dbVersion;
			
			if($dbVersion != -1)
				$this->settings['dbVersion'] = intval($dbVersion);
		}
		
		$this->hexItem = strtoupper($hex);
		
		$this->loadDeclareVars();
		$this->loadPrimaryFunction();
		$this->loadParseIndex();
		$this->loadParseProperties();
		$this->loadParseExcellent();
		$this->loadParseAncient();
		$this->loadParseDBNewOptions();
		$this->loadParseJewelOfHarmony();
		$this->loadParseSocketOption();
		$this->loadFinishParser();
		
		return $this->result;
	}
	/**
	 *	Declare Variables
	 *
	 *	@return	void
	*/
	private final function loadDeclareVars()
	{
		$this->vars['Index'] = 0;
		$this->vars['Section'] = 0;
		$this->vars['Serial'] = 0;
		$this->vars['Level'] = 0;
		$this->vars['Option'] = 0;
		$this->vars['Skill'] = 0;
		$this->vars['Luck'] = 0;
		$this->vars['Durability'] = 0;
		$this->vars['Excellent'] = array("Count" => 0, 0, 0, 0, 0, 0, 0);
		
		if($this->settings['dbVersion'] > 0)
		{
			$this->vars['Ancient'] = 0;
			
			if($this->settings['dbVersion'] >= 2)
			{
				$this->vars['Refine'] = 0;
				$this->vars['JewelOfHarmony'] = array(0, 0);
				
				if($this->settings['SocketSystem'] > 0)
					$this->vars['SocketOption'] = array("Count" => 0, array(-2, 0), array(-2, 0), array(-2, 0), array(-2, 0), array(-2, 0));
			}
		}
	}
	/**
	 *	Primary Function
	 *
	 *	@return	void
	*/
	private final function loadPrimaryFunction()
	{
		$serial = substr($this->hexItem, 6, 8);
		$hexItem = substr($this->hexItem, 0, 6).substr($this->hexItem, 14);
		
		for($i = 0; $i < 6 + ($this->settings['dbVersion'] >= 2 ? 6 : 0); $i++)
			$this->bytes[$i] = substr($hexItem, $i * 2, 2);
		
		$this->vars['Serial'] = $serial;
		$this->vars['Durability'] = intval(hexdec($this->bytes[2]));
	}
	/**
	 *	Parse Index
	 *
	 *	@return	void
	*/
	private final function loadParseIndex()
	{
		$this->vars['Index'] = intval(hexdec($this->bytes[0]));
		
		if($this->settings['dbVersion'] < 2)
		{
			$unique = 0;
			if(hexdec($this->bytes[3]) & 128 == 128)
			{
				$this->bytes[3] = hexdec(dechex($this->bytes[3]) - 128);
				$unique = 8;
			}
			
			$index = $this->vars['Index'] & 0x1F;
			$section = (((($this->vars['Index'] | $index) & 0xE0) & 0xFF) / 32);
			$section +=  $unique;
			
			$this->vars['Index'] = intval($index);
			$this->vars['Section'] = intval($section);
		}
	}
	/**
	 *	Parse Properties
	 *
	 *	@return	void
	*/
	private final function loadParseProperties()
	{
		$temp = intval(hexdec($this->bytes[1]));
		
		if(($temp & 128) == 128)
		{
			$this->vars['Skill'] = 1;
			$temp -= 128;
		}
		
		if(($temp % 8) == 0)
		{
			$this->vars['Luck'] = 0;
			$this->vars['Option'] = 0;
		}
		else
		{
			$number = $temp % 8;
			$temp -= $number;
			
			if($number >= 4)
			{
				$this->vars['Luck'] = 1;
				$number -= 4;
			}
			
			$this->vars['Option'] = $number * 4;
		}
		
		$this->vars['Level'] = $temp / 8;
		$this->vars['Option'] += $this->bytes[3] & 64 == 64 ? 16 : 0;
	}
	/**
	 *	Parse Excellent
	 *
	 *	@return	void
	*/
	private final function loadParseExcellent()
	{
		$temp = intval(hexdec($this->bytes[3]));
		$count = 0;
		
		if($temp & 32 == 32)
		{
			$this->vars['Excellent'][5] = 1;
			$count++;
			$temp -= 32;
		}
		if($temp & 16 == 16)
		{
			$this->vars['Excellent'][4] = 1;
			$count++;
			$temp -= 16;
		}
		if($temp & 8 == 8)
		{
			$this->vars['Excellent'][3] = 1;
			$count++;
			$temp -= 8;
		}
		if($temp & 4 == 4)
		{
			$this->vars['Excellent'][2] = 1;
			$count++;
			$temp -= 4;
		}
		if($temp & 2 >= 2)
		{
			$this->vars['Excellent'][1] = 1;
			$count++;
			$temp -= 2;
		}
		if($temp & 1 == 1)
		{
			$this->vars['Excellent'][0] = 1;
			$count++;
			$temp -= 1;
		}
		
		$this->vars['Excellent']['Count'] = $count;
	}
	/**
	 *	Parse Ancient (DB Version > 0)
	 *
	 *	@return	void
	*/
	private final function loadParseAncient()
	{
		if($this->settings['dbVersion'] > 0)
		{
			switch($this->bytes[4])
			{
				case "05" : return $this->vars['Ancient'] = 1; break;
				case "0A" : return $this->vars['Ancient'] = 2; break;
				default : return $this->vars['Ancient'] = 0; break;
			}
		}
	}
	/**
	 *	Parse DB-2 Options
	 *
	 *	@return	void
	*/
	private final function loadParseDBNewOptions()
	{
		if($this->settings['dbVersion'] >= 2)
		{
			$temp = hexdec($this->bytes[5]);
			
			$section = $temp / 2;
			$section /= 8;
			
			if(($section * 2) & 8 == 8)
				$this->vars['Refine'] = 1;
				
			$this->vars['Section'] = intval($section);
		}
	}
	/**
	 *	Parse Jewel Of Harmony (DB Version = 2)
	 *
	 *	@return void
	*/
	private final function loadParseJewelOfHarmony()
	{
		if($this->settings['dbVersion'] >= 2)
		{
			if(substr($this->bytes[6], 0, 1) === 0)
			{
				$this->vars['JewelOfHarmony'] = array(0, 0);
				$this->options['JewelOfHarmony'] = 0;
			}
			else
			{
				$this->vars['JewelOfHarmony'][0] = intval(hexdec(substr($this->bytes[6], 0, 1)));
				$this->vars['JewelOfHarmony'][1] = intval(hexdec(substr($this->bytes[6], 1, 1)));
				$this->options['JewelOfHarmony'] = 1;
			}
		}
	}
	/**
	 *	Parse Socket Option (DB Version = 2 / S4)
	 *
	 *	SocketSystem = 1: WebZen
	 *	SocketSystem = 2: SCFMuTeam
	 *
	 *	@return void
	*/
	private final function loadParseSocketOption()
	{
		if($this->settings['dbVersion'] >= 2 && $this->settings['SocketSystem'] > 0)
		{
			$void = $this->settings['SocketSystem'] >= 2 ? 0 : 255;
			$free = $this->settings['SocketSystem'] >= 2 ? 255 : 254;
			$count = 0;
			
			$sockets[0] = intval(hexdec($this->bytes[7]));
			$sockets[1] = intval(hexdec($this->bytes[8]));
			$sockets[2] = intval(hexdec($this->bytes[9]));
			$sockets[3] = intval(hexdec($this->bytes[10]));
			$sockets[4] = intval(hexdec($this->bytes[11]));
			
			if($sockets[0] == $free) { $this->vars['SocketOption'][0][0] = -1; $count++; }
			if($sockets[1] == $free) { $this->vars['SocketOption'][1][0] = -1; $count++; }
			if($sockets[2] == $free) { $this->vars['SocketOption'][2][0] = -1; $count++; }
			if($sockets[3] == $free) { $this->vars['SocketOption'][3][0] = -1; $count++; }
			if($sockets[4] == $free) { $this->vars['SocketOption'][4][0] = -1; $count++; }
			
			if($sockets[0] <> $void && $sockets[0] <> $free)
			{
				$option = $sockets[0] % 50;
				$socket = $option - ($this->settings['SocketSystem'] == 2 ? 1 : 0);
				$count++;
				
				if($sockets[0] >= 50)
					$this->vars['SocketOption'][0] = array($socket, ($sockets[0] - $option) / 50);
				else
					$this->vars['SocketOption'][0] = array($sockets[0], 0);
			}
			
			if($sockets[1] <> $void && $sockets[1] <> $free)
			{
				$option = $sockets[1] % 50;
				$socket = $option - ($this->settings['SocketSystem'] == 2 ? 1 : 0);
				$count++;
				
				if($sockets[1] >= 50)
					$this->vars['SocketOption'][1] = array($socket, ($sockets[1] - $option) / 50);
				else
					$this->vars['SocketOption'][1] = array($sockets[1], 0);
			}
			
			if($sockets[2] <> $void && $sockets[2] <> $free)
			{
				$option = $sockets[2] % 50;
				$socket = $option - ($this->settings['SocketSystem'] == 2 ? 1 : 0);
				$count++;
				
				if($sockets[2] >= 50)
					$this->vars['SocketOption'][2] = array($socket, ($sockets[2] - $option) / 50);
				else
					$this->vars['SocketOption'][2] = array($sockets[2], 0);
			}
			
			if($sockets[3] <> $void && $sockets[3] <> $free)
			{
				$option = $sockets[3] % 50;
				$socket = $option - ($this->settings['SocketSystem'] == 2 ? 1 : 0);
				$count++;
				
				if($sockets[3] >= 50)
					$this->vars['SocketOption'][3] = array($socket, ($sockets[3] - $option) / 50);
				else
					$this->vars['SocketOption'][3] = array($sockets[3], 0);
			}
			
			if($sockets[4] <> $void && $sockets[4] <> $free)
			{
				$option = $sockets[4] % 50;
				$socket = $option - ($this->settings['SocketSystem'] == 2 ? 1 : 0);
				$count++;
				
				if($sockets[4] >= 50)
					$this->vars['SocketOption'][4] = array($socket, ($sockets[4] - $option) / 50);
				else
					$this->vars['SocketOption'][4] = array($sockets[4], 0);
			}
			
			$this->vars['SocketOption']['Count'] = $count;
		}
	}
	private final function loadFinishParser()
	{
		foreach($this->tempSts as $key => $value)
			$this->settins[$key] = $value;
			
		$this->result = $this->vars;
		$this->hexItem = NULL;
		
		$this->bytes = array();
		$this->vars = array();
		$this->tempSts = array();
	}
}