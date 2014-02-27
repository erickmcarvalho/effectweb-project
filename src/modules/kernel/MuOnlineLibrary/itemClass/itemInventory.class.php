<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * MuOnline Library: Item - Inventory Class
 * Author: $CTM['Erick-Master']
 * Last Update: 24/04/2012 - 22:18h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

final class MuOnline_ItemInventory extends MuOnline_Item
{
	/**
	 *	Lib Settings
	 *
	 *	@access	private
	 *	@var	array	Library Settings
	*/
	private $settings	= array
	(
		"dbVersion" => 2,
		"Database" => "MuOnline",
		"Table" => array
		(
			"Table" => "Character",
			"Inventory" => "Inventory",
			"Name" => "Name",
			"Account" => "AccountID"
		),
		"Length" => array
		(
			"All" => 1728,
			"Equipments" => 192,
			"Inventory" => 1024,
			"PersonalStore" => 512,
			"Item" => 32
		),
		"Limit" => array
		(
			"All" => 108,
			"Equipments" => 12,
			"Inventory" => 64,
			"PersonalStore" => 32
		)
	);
	/**
	 *	Inventory Variables
	 *
	 *	@access	private
	 *	@var	array	Inventory Variables
	*/
	private $vars		= array();
	
	/**
	 *	Class Constructor
	 *	Set up library settings
	 *
	 *	@param	array	Lib Settings
	 *	@return	void
	*/
	public final function __construct($settings)
	{
		if(!$settings['Table']['Table']) $settings['Table']['Table'] = $this->settings['Table']['Table'];
		if(!$settings['Table']['Inventory']) $settings['Table']['Inventory'] = $this->settings['Table']['Inventory'];
		if(!$settings['Table']['Name']) $settings['Table']['Name'] = $this->settings['Table']['Name'];
		if(!$settings['Table']['Account']) $settings['Table']['Account'] = $this->settings['Table']['Account'];
		
		if(!$settings['Length']['All']) $settings['Length']['All'] = $settings['dbVersion'] >= 2 ? 1728 : 1080;
		if(!$settings['Length']['Equipments']) $settings['Length']['Equipments'] = $settings['dbVersion'] >= 2 ? 192 : 120;
		if(!$settings['Length']['Inventory']) $settings['Length']['Inventory'] = $settings['dbVersion'] >= 2 ? 1024 : 640;
		if(!$settings['Length']['PersonalStore']) $settings['Length']['PersonalStore'] = $settings['dbVersion'] >= 2 ? 512 : 268;
		if(!$settings['Length']['Item']) $settings['Length']['Item'] = $settings['dbVersion'] >= 2 ? 32 : 20;
		
		if(!$settings['Limit']['All']) $settings['Limit']['All'] = 108;
		if(!$settings['Limit']['Equipments']) $settings['Limit']['Equipments'] = 12;
		if(!$settings['Limit']['Inventory']) $settings['Limit']['Inventory'] = 64;
		if(!$settings['Limit']['PersonalStore']) $settings['Limit']['PersonalStore'] = 32;
		
		if($settings['dbVersion'] == 1) $settings['Length']['All'] = 760;
		
		if($settings['dbVersion'] == 3)
		{
			$settings['Length']['All'] = 2732;
			$settings['Length']['Inventory'] = 2048;
			$settings['Limit']['All'] = 172;
			$settings['Limit']['Inventory'] = 128;
		}
		
		$this->settings = $settings;
	}
	/**
	 *	Open Inventory
	 *	Open inventory from Character or Hexadecimal
	 *
	 *	@param	string	Char name
	 *	@param	string	Hexadecimal
	 *	@return	void
	*/
	public final function OpenInventory($charname = NULL, $hexadecimal = NULL)
	{
		if(empty($hexadecimal))
			$this->loadOpenInventoryFromChar($charname);
		else
			$this->loadOpenInventoryFromHexa($hexadecimal);
			
		$x = $this->settings['Length']['Equipments'] * 2;
		$y = $this->settings['Length']['Inventory'] * 2;
		$y += $x;
		
		$this->vars['invenhex']['equipments'] = strtoupper(substr($this->vars['invenhex']['all'], 0, $x));
		$this->vars['invenhex']['inventory'] = strtoupper(substr($this->vars['invenhex']['all'], $x, $this->settings['Length']['Inventory'] * 2));
		$this->vars['invenhex']['personalstore'] = strtoupper(substr($this->vars['invenhex']['all'], $y, $this->settings['Length']['PersonalStore'] * 2));
		
		for($i = 0; $i < 12; $i++)
		{
			$hexa = substr($this->vars['invenhex']['all'], $i * $this->settings['Length']['Item'], $this->settings['Length']['Item']);
			$this->vars['slots']['equipments'][$i] = $hexa;
		}
			
		$this->loadInventoryCutSlots();
		$this->loadInventoryRestructureSlots();
	}
	/**
	 *	Get Inventory Items
	 *	Get and parse items from inventory
	 *
	 *	@param	boolean	Parse Items
	 *	@param	&array	Inventory Items
	 *	@return	array
	*/
	public final function GetInventoryItems($parseItems = FALSE, &$inventoryItems = array())
	{
		$inventoryItems['Equipments']['Hand']['Left'] = $this->loadSetEquipment($this->vars['slots']['equipments'][0], $parseItems);
		$inventoryItems['Equipments']['Hand']['Right'] = $this->loadSetEquipment($this->vars['slots']['equipments'][1], $parseItems);
		$inventoryItems['Equipments']['Set']['Helm'] = $this->loadSetEquipment($this->vars['slots']['equipments'][2], $parseItems);
		$inventoryItems['Equipments']['Set']['Armor'] = $this->loadSetEquipment($this->vars['slots']['equipments'][3], $parseItems);
		$inventoryItems['Equipments']['Set']['Pants'] = $this->loadSetEquipment($this->vars['slots']['equipments'][4], $parseItems);
		$inventoryItems['Equipments']['Set']['Gloves'] = $this->loadSetEquipment($this->vars['slots']['equipments'][5], $parseItems);
		$inventoryItems['Equipments']['Set']['Boots'] = $this->loadSetEquipment($this->vars['slots']['equipments'][6], $parseItems);
		$inventoryItems['Equipments']['Wing'] = $this->loadSetEquipment($this->vars['slots']['equipments'][7], $parseItems);
		$inventoryItems['Equipments']['Pet'] = $this->loadSetEquipment($this->vars['slots']['equipments'][8], $parseItems);
		$inventoryItems['Equipments']['Pendant'] = $this->loadSetEquipment($this->vars['slots']['equipments'][9], $parseItems);
		$inventoryItems['Equipments']['Ring']['Left'] = $this->loadSetEquipment($this->vars['slots']['equipments'][10], $parseItems);
		$inventoryItems['Equipments']['Ring']['Right'] = $this->loadSetEquipment($this->vars['slots']['equipments'][11], $parseItems);
		
		$t = 0;
		for($i = 0; $i < $this->settings['Limit']['Inventory']; $i++)
		{
			$itemSlotHex = $this->loadFixItem($this->vars['slots']['inventory'][$i]['hexa']);
			
			if($this->loadIsFreeSlot($itemSlotHex) == true)
				continue;
				
			if($parseItems == true)
			{
				$inventoryItems['Inventory'][$t] = array();
				$inventoryItems['Inventory'][$t]['Hex'] = $itemSlotHex;
				$inventoryItems['Inventory'][$t++]['Parse'] = $this->ParseItemHex($itemSlotHex);
			}
			else
				$inventoryItems['Inventory'][$t++] = $this->loadFixItem($itemSlotHex);
		}
		
		if($this->settings['dbVersion'] >= 1)
		{
			$t = 0;
			for($i = 0; $i < $this->settings['Limit']['PersonalStore']; $i++)
			{
				$itemSlotHex = $this->loadFixItem($this->vars['slots']['personalstore'][$i]['hexa']);
				
				if($this->loadIsFreeSlot($itemSlotHex) == true)
					continue;
					
				if($parseItems == true)
				{
					$inventoryItems['PersonalStore'][$t] = array();
					$inventoryItems['PersonalStore'][$t]['Hex'] = $itemSlotHex;
					$inventoryItems['PersonalStore'][$t++]['Parse'] = $this->ParseItemHex($itemSlotHex);
				}
				else
					$inventoryItems['PersonalStore'][$t++] = $this->loadFixItem($itemSlotHex);
			}
		}
		
		return $inventoryItems;
	}
	/**
	 *	Find Slot Free
	 *	Search by inventory free slot
	 *
	 *	@param	integer	Item Length: x
	 *	@param	integer	Item Length: y
	 *	@param	&bool	Result Array
	 *	@param	string	Section
	 *	@return	array
	*/
	public final function FindSlotFree($ix = 0, $iy = 0, &$result = false, $section = "Inventory")
	{
		$section = strtolower($name = $section);
		for($i = 0; $i < $this->settings['Limit'][$name]; $i++)
		{
			$thisSlot = $this->vars['slots'][$section][$i];
			if($this->loadIsFreeSlot($thisSlot['hexa']) == true)
			{
				$check = 0;
				
				if($thisSlot['ready'] == true) $check++;
				for($x = 0; $x < $ix; $x++)
				{
					for($y = 0; $y < $iy; $y++)
					{
						$tmp = ($i + 1) % 8;
							
						if($tmp == 0 && $ix > 1) $check++;
						elseif($tmp == 7 && $ix > 2) $check++;
						elseif($tmp == 6 && $ix > 3) $check++;
						elseif($tmp == 5 && $ix > 4) $check++;
						//elseif($this->vars['slots'][$section][$i + $x]['free'] == false) $check++;
						elseif($this->vars['slots'][$section][$i + $x + 8 * $y]['free'] == false) $check++;
					}
				}
				
				if($check == 0)
				{
					$slot = $i;
					
					$this->vars['slots'][$section][$i]['ready'] = TRUE;
					$this->SkipSlot($i, $ix, $iy, $section);
					break;
				}
			}
		}
		
		return $result = $check == 0 ? $slot : false;
	}
	/**
	 *	Insert Item
	 *	Insert item hex in free slot
	 *
	 *	@param	string	Item Hex
	 *	@param	integer	Ready Slot
	  *	@param	string	Section
	 *	@return	boolean
	*/
	public final function InsertItem($hex, $readySlot = 0, $section = "Inventory")
	{
		$section = strtolower($section);
		if($this->vars['slots'][$section][$readySlot]['ready'] == true)
		{
			$this->vars['slots'][$section][$readySlot]['hexa'] = $this->loadFixItem($hex);
			$this->vars['slots'][$section][$readySlot]['free'] = FALSE;
			$this->vars['slots'][$section][$readySlot]['ready'] = FALSE;
			
			return true;
		}
		
		return false;
	}
	/**
	 *	Search Item Slot
	 *	Search item slot by hex or serial
	 *
	 *	@param	string	Item Hex/Serial
	 *	@param	&int	Inventory Slot
	 *	@param	string	Section
	 *	@return	integer	Inventory Slot
	*/
	public final function SearchSlot($input, &$slot = FALSE, $section = "Inventory")
	{
		$section = strtolower($name = $section);
		for($i = 0; $i < $this->settings['Limit'][$name]; $i++)
		{
			$slot = FALSE;
			if(strlen($input) == $this->settings['Length']['Item'])
			{
				if($this->vars['slots'][$section][$i]['hexa'] == strtoupper($input))
				{
					$slot = $i;
					break;
				}
			}
			elseif(strlen($input) == 8)
			{
				if(substr($this->vars['slots'][$section][$i]['hexa'], 6, 8) == strtoupper($input))
				{
					$slot = $i;
					break;
				}
			}
		}
		
		return $slot;
	}
	/**
	 *	Change Equipped Item
	 *	Change equipped item hexa from inventory
	 *
	 *	@param	integer	Equipped Slot
	 *	@param	string	Item Hexa
	 *	@return	void
	*/
	public final function ChangeEquippedItem($slot = 0, $hexa = NULL)
	{
		$this->vars['slots']['equipments'][$slot] = $this->loadFixItem($hexa);
	}
	/**
	 *	Change Item
	 *	Change item hexa from inventory slot
	 *
	 *	@param	integer	Inventory Slot
	 *	@param	string	Item Hexa
	 *	@param	string	Section
	 *	@return	boolean
	*/
	public final function ChangeItem($slot, $hexa, $section = "Inventory")
	{
		$section = strtolower($section);
		
		if($this->loadIsFreeSlot($hexa) == false)
		{
			$this->vars['slots'][$section][$slot]['hexa'] = $this->loadFixItem($hexa);
			return true;
		}
		
		return false;
	}
	/**
	 *	Remove Item
	 *	Remove item from inventory, set free status
	 *
	 *	@param	integer	Inventory Slot
	 *	@param	string	Section
	 *	@return	boolean
	*/
	public final function RemoveItem($slot, $section = "Inventory")
	{
		$section = strtolower($section);
		
		if(!$this->vars['slots'][$slot])
			return false;
			
		$this->loadSkipSlot($slot, $this->vars['slots'][$section][$slot]['x'], $this->vars['slots'][$section][$slot]['y'], $section, true);
		
		$this->vars['slots'][$section][$slot]['hexa'] = str_repeat("F", $this->settings['Length']['Item']);
		$this->vars['slots'][$section][$slot]['free'] = TRUE;
		$this->vars['slots'][$section][$slot]['ready'] = FALSE;
		$this->vars['slots'][$section][$slot]['x'] = 0;
		$this->vars['slots'][$section][$slot]['y'] = 0;
		
		return true;
	}
	/**
	 *	Skip Slot
	 *	Skip free slots
	 *
	 *	@param	integer	Section Slot
	 *	@param	integer	Item Length: x
	 *	@param	integer	Item Length: y
	 *	@param	string	Section
	 *	@param	boolean	Set Status
	 *	@return	void
	*/
	public final function SkipSlot($slot, $ix, $iy, $section = "Inventory", $status = FALSE)
	{
		$section = strtolower($section);
		for($x = 0; $x < $ix; $x++)
		{
			for($y = 0; $y < $iy; $y++)
			{
				$this->vars['slots'][$section][$slot + $x]['free'] = $status;
				$this->vars['slots'][$section][$slot + $x + 8 * $y]['free'] = $status;
			}
		}
	}
	/**
	 *	Compile Inventory Hexa
	 *	Load and compile a full inventory hexa
	 *
	 *	@param	&string	Inventory Hexa
	 *	@return	string	Inventory Hexa
	*/
	public final function CompileInventoryHex(&$inventoryHexa = NULL)
	{
		for($i = 0; $i < $this->settings['Limit']['Equipments']; $i++)
			$inventoryHexa .= $this->loadFixItem($this->vars['slots']['equipments'][$i]);
			
		for($i = 0; $i < $this->settings['Limit']['Inventory']; $i++)
			$inventoryHexa .= $this->loadFixItem($this->vars['slots']['inventory'][$i]['hexa']);
			
		if($this->settings['dbVersion'] >= 1)
			for($i = 0; $i < $this->settings['Limit']['PersonalStore']; $i++)
				$inventoryHexa .= $this->loadFixItem($this->vars['slots']['personalstore'][$i]['hexa']);
			
		return $inventoryHexa;
	}
	/**
	 *	Close Inventory
	 *	Compile hexadecimal and update inventory
	 *
	 	@param	boolean	Update Inventory DB
		@param	&string	Inventory Hexa
	 *	@return	string	Inventory Hexa
	*/
	public final function CloseInventory($updateDatabase = FALSE, &$inventoryContent = NULL)
	{
		$this->CompileInventoryHex($inventoryContent);
		
		if($updateDatabase == true)
		{
			$queryString = "UPDATE [".$this->settings['Database']."].dbo.[".$this->settings['Table']['Table']."]";
			$queryString .= " SET [".$this->settings['Table']['Inventory']."] = 0x".$inventoryContent;
			$queryString .= " WHERE [".$this->settings['Table']['Name']."] = '%s'";
			
			self::Driver()->MSSQL()->Arguments($this->vars['charname']);
			self::Driver()->MSSQL()->Query($queryString);
		}
		
		$this->vars = array();
		return $inventoryContent;
	}
	/**
	 *	Open Inventory from Charname
	 *	Open inventory from Charname
	 *
	 *	@param	string	Char Name
	 *	@return	void
	*/
	private final function loadOpenInventoryFromChar($charname)
	{
		$queryString = "DECLARE @inventory varbinary(".$this->settings['Length']['All'].");\n\n";
		$queryString .= "SELECT @inventory = [".$this->settings['Table']['Inventory']."] FROM [".$this->settings['Database']."]";
		$queryString .= ".dbo.[".$this->settings['Table']['Table']."] WHERE [".$this->settings['Table']['Name']."]";
		$queryString .= " = '%s';\n";
		$queryString .= "PRINT @inventory;";
		
		self::Driver()->MSSQL()->Arguments($charname);
		self::Driver()->MSSQL()->Query($queryString);
		
		$hexadecimal = strtoupper(substr(trim(self::Driver()->MSSQL()->Client()->GetLastMessage()), 2));
		
		$this->vars['charname'] = $charname;
		$this->vars['invenhex']['all'] = $hexadecimal;
	}
	/**
	 *	Open Inventory from Hexadecimal
	 *	Open inventory from Hexadecimal
	 *
	 *	@param	string	Hexadecimal
	 *	@return	void
	*/
	private final function loadOpenInventoryFromHexa($login)
	{
		$hexadecimal = strtoupper($hexadecimal);
		
		if(empty($hexadecimal))
			$dexadecimal = str_repeat("FF", $this->settings['Length']['All']);
			
		return $this->vars['invenhex']['all'] = $this->loadFixInventory($hexadecimal);
	}
	/**
	 *	Inventory Cut Slots
	 *	Cut slots from inventory hexadecimal
	 *
	 *	@return	void
	*/
	private final function loadInventoryCutSlots()
	{
		for($i = 0; $i < $this->settings['Limit']['Inventory']; $i++)
		{
			$hexa = substr($this->vars['invenhex']['inventory'], $i * $this->settings['Length']['Item'], $this->settings['Length']['Item']);
			
			if($this->loadIsFreeSlot($hexa) == true)
			{
				$free = TRUE;
				$x = 0;
				$y = 0;
			}
			else
			{
				$this->GetItemIndex($hexa, $itemIndex);
				$this->Database()->GetItemSize($itemIndex['section'], $itemIndex['index'], $itemSize);
				
				$free = FALSE;
				$x = $itemSize['x'];
				$y = $itemSize['y'];
			}
			
			$this->vars['slots']['inventory'][$i]['hexa'] = $hexa;
			$this->vars['slots']['inventory'][$i]['free'] = $free;
			$this->vars['slots']['inventory'][$i]['ready'] = FALSE;
			$this->vars['slots']['inventory'][$i]['x'] = $x;
			$this->vars['slots']['inventory'][$i]['y'] = $y;
		}
		
		if($this->settings['dbVersion'] >= 1)
		{
			for($i = 0; $i < $this->settings['Limit']['PersonalStore']; $i++)
			{
				$hexa = substr($this->vars['invenhex']['personalstore'], $i * $this->settings['Length']['Item'], $this->settings['Length']['Item']);
				
				if($this->loadIsFreeSlot($hexa) == true)
				{
					$free = TRUE;
					$x = 0;
					$y = 0;
				}
				else
				{
					$this->GetItemIndex($hexa, $itemIndex);
					$this->Database()->GetItemSize($itemIndex['section'], $itemIndex['index'], $itemSize);
					
					$free = FALSE;
					$x = $itemSize['x'];
				$y = $itemSize['y'];
				}
				
				$this->vars['slots']['personalstore'][$i]['hexa'] = $hexa;
				$this->vars['slots']['personalstore'][$i]['free'] = $free;
				$this->vars['slots']['personalstore'][$i]['ready'] = FALSE;
				$this->vars['slots']['personalstore'][$i]['x'] = $x;
				$this->vars['slots']['personalstore'][$i]['y'] = $y;
			}
		}
	}
	/**
	 *	Inventory Restructure Slots
	 *	Restructure slots from inventory slots
	 *
	 *	@return	void
	*/
	private final function loadInventoryRestructureSlots()
	{
		for($i = 0; $i < $this->settings['Limit']['Inventory']; $i++)
		{
			if($this->vars['slots']['inventory'][$i]['free'] == true)
				continue;
				
			for($x = 0; $x < $this->vars['slots']['inventory'][$i]['x']; $x++)
			{
				for($y = 0; $y < $this->vars['slots']['inventory'][$i]['y']; $y++)
				{
					$this->vars['slots']['inventory'][$i + $x]['free'] = FALSE;
					$this->vars['slots']['inventory'][$i + $x + 8 * $y]['free'] = FALSE;
				}
			}
		}
		
		if($this->settings['dbVersion'] >= 1)
		{
			for($i = 0; $i < $this->settings['Limit']['PersonalStore']; $i++)
			{
				if($this->vars['slots']['personalstore'][$i]['free'] == true)
					continue;
					
				for($x = 0; $x < $this->vars['slots']['personalstore'][$i]['x']; $x++)
				{
					for($y = 0; $y < $this->vars['slots']['personalstore'][$i]['y']; $y++)
					{
						$this->vars['slots']['personalstore'][$i + $x]['free'] = FALSE;
						$this->vars['slots']['personalstore'][$i + $x + 8 * $y]['free'] = FALSE;
					}
				}
			}
		}
	}
	/**
	 *	Is Free Slot
	 *	Check item hex is free slot
	 *
	 *	@param	string	Item Hex
	 *	@return	boolean
	*/
	private final function loadIsFreeSlot($hexa)
	{
		if(strtoupper($hexa) == str_repeat("F", $this->settings['Length']['Item']))
			return true;
		elseif($hexa == str_repeat("0", $this->settings['Length']['Item']))
			return true;
		elseif(empty($hexa) == true)
			return true;
		
		return false;
	}
	/**
	 *	Set Equipment
	 *	Fix and set equipment data
	 *
	 *	@param	string	Item Hex
	 *	@param	boolean	Parse Item
	 *	@return	string/array
	*/
	private final function loadSetEquipment($hexa, $parseItem = FALSE)
	{
		$hexa = $this->loadFixItem($hexa);
		
		if($this->loadIsFreeSlot($hexa) == true)
			return "No item";
		else
			return $parseItem ? array("Hexa" => $hexa, "Parse" => $this->ParseItemHex($hexa)) : $hexa;
	}
	/**
	 *	Fix Inventory Hexa
	 *	Fix length of inventory hexa
	 *
	 *	@param	string	Hexadecimal
	 *	@return	string	Hexadecimal fixed
	*/
	private final function loadFixInventory($hexadecimal)
	{
		return str_pad(strtoupper($hexadecimal), $this->settings['Length']['All'] * 2, "F", STR_PAD_RIGHT);
	}
	/**
	 *	Fix Item Hexa
	 *	Fix length of item hexa
	 *
	 *	@param	string	Hexadecimal
	 *	@return	string	Hexadecimal fixed
	*/
	private final function loadFixItem($hexadecimal)
	{
		return str_pad(strtoupper($hexadecimal), $this->settings['Length']['Item'], "F", STR_PAD_RIGHT);
	}
}