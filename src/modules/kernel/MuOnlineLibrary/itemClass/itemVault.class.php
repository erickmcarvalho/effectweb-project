<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * MuOnline Library: Item - Vault Class
 * Author: $CTM['Erick-Master']
 * Last Update: 24/04/2012 - 22:31h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

final class MuOnline_ItemVault extends MuOnline_Item
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
			"Table" => "warehouse",
			"Items" => "Items",
			"Account" => "AccountID",
			"Number" => "Number",
			"DbVersion" => "DbVersion"
		),
		"Length" => array
		(
			"Vault" => 1920,
			"Item" => 32
		),
		"Limit" => 120
	);
	/**
	 *	Vault Variables
	 *
	 *	@access	private
	 *	@var	array	Vault Variables
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
		if(!$settings['Table']['Items']) $settings['Table']['Items'] = $this->settings['Table']['Items'];
		if(!$settings['Table']['Account']) $settings['Table']['Account'] = $this->settings['Table']['Account'];
		if(!$settings['Table']['Number']) $settings['Table']['Number'] = $this->settings['Table']['Number'];
		if(!$settings['Table']['DbVersion']) $settings['Table']['DbVersion'] = $this->settings['Table']['DbVersion'];
		
		if(!$settings['Length']['Vault']) $settings['Length']['Vault'] = $settings['dbVersion'] >= 2 ? 1920 : 1200;
		if(!$settings['Length']['Item']) $settings['Length']['Item'] = $settings['dbVersion'] >= 2 ? 32 : 20;
		
		if(!$settings['Limit']) $settings['Limit'] = 120;
		
		if($settings['dbVersion'] == 3 && $settings['Table']['Table'] == "warehouse")
		{
			$settings['Length']['Vault'] = 3840;
			$settings['Limit'] = 240;
		}
		
		$this->settings = $settings;
	}
	/**
	 *	Open Vault
	 *	Open vault from Account or Hexadecimal
	 *
	 *	@param	string	Login Name
	 *	@param	integer	Vault Number
	 *	@param	string	Hexadecimal
	 *	@return	void
	*/
	public final function OpenVault($login = NULL, $number = -1, $hexadecimal = NULL)
	{
		if(empty($hexadecimal))
			$this->loadOpenVaultFromUser($login, $number);
		else
			$this->loadOpenVaultFromHexa($hexadecimal);
			
		$this->loadVaultCutSlots();
		$this->loadVaultRestructureSlots();
	}
	/**
	 *	Get Vault Items
	 *	Get and parse items from vault
	 *
	 *	@param	boolean	Parse Items
	 *	@param	&array	Vault Items
	 *	@return	array
	*/
	public final function GetVaultItems($parseItems = FALSE, &$vaultItems = array())
	{
		for($i = 0; $i < $this->settings['Limit']; $i++)
		{
			$itemSlotHex = $this->loadFixItem($this->vars['slots'][$i]['hexa']);
			
			if($this->loadIsFreeSlot($itemSlotHex) == true)
				continue;
				
			if($parseItems == true)
			{
				$vaultItems[$i + 1] = array();
				$vaultItems[$i + 1]['Hex'] = $itemSlotHex;
				$vaultItems[$i + 1]['Parse'] = self::Lib('Item')->ParseItemHex($itemSlotHex);
			}
			else
				$vaultItems[$i + 1] = $this->loadFixItem($this->vars['slots'][$i]['hexa']);
		}
		
		return $vaultItems;
	}
	/**
	 *	Find Slot Free
	 *	Search by vault free slot
	 *
	 *	@param	integer	Item Length: x
	 *	@param	integer	Item Length: y
	 *	@param	&bool	Result Array
	 *	@return	array
	*/
	public final function FindSlotFree($ix = 0, $iy = 0, &$result = false)
	{
		for($i = 0; $i < $this->settings['Limit']; $i++)
		{
			$thisSlot = $this->vars['slots'][$i];
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
						//elseif($this->vars['slots'][$i + $x]['free'] == false) $check++;
						elseif($this->vars['slots'][$i + $x + 8 * $y]['free'] == false) $check++;
					}
				}
				
				if($check == 0)
				{
					$slot = $i;
					
					$this->vars['slots'][$i]['ready'] = TRUE;
					$this->vars['last_free_slot'] = $i;
					$this->SkipSlot($i + 1, $ix, $iy);
					break;
				}
			}
		}
		
		return $result = $check == 0 ? $slot + 1 : false;
	}
	/**
	 *	Insert Item
	 *	Insert item hex in free slot
	 *
	 *	@param	string	Item Hex
	 *	@param	integer	Ready Slot
	 *	@return	boolean
	*/
	public final function InsertItem($hex, $readySlot = -1)
	{
		if($readySlot == -1)
			$readySlot = $this->vars['last_free_slot'] + 1;
		
		if($this->vars['slots'][--$readySlot]['ready'] == true)
		{
			$this->vars['slots'][$readySlot]['hexa'] = $this->loadFixItem($hex);
			$this->vars['slots'][$readySlot]['free'] = FALSE;
			$this->vars['slots'][$readySlot]['ready'] = FALSE;
			
			return true;
		}
		
		return false;
	}
	/**
	 *	Search Item Slot
	 *	Search item slot by hex or serial
	 *
	 *	@param	string	Item Hex/Serial
	 *	@param	integer	Vault Slot
	 *	@return	integer	Vault Slot
	*/
	public final function SearchSlot($input, &$slot = FALSE)
	{
		for($i = 0; $i < $this->settings['Limit']; $i++)
		{
			$slot = FALSE;
			if(strlen($input) == $this->settings['Length']['Item'])
			{
				if($this->vars['slots'][$i]['hexa'] == strtoupper($input))
				{
					$slot = $i;
					break;
				}
			}
			elseif(strlen($input) == 8)
			{
				if(substr($this->vars['slots'][$i]['hexa'], 6, 8) == strtoupper($input))
				{
					$slot = $i;
					break;
				}
			}
		}
		
		return $slot + 1;
	}
	/**
	 *	Change Item
	 *	Change item hexa from vault slot
	 *
	 *	@param	integer	Vault Slot
	 *	@param	string	Item Hexa
	 *	@return	boolean
	*/
	public final function ChangeItem($slot, $hexa)
	{
		if($this->loadIsFreeSlot($hexa) == false)
		{
			$this->vars['slots'][--$slot]['hexa'] = $this->loadFixItem($hexa);
			return true;
		}
		
		return false;
	}
	/**
	 *	Remove Item
	 *	Remove item from vault, set free status
	 *
	 *	@param	integer	Vault Slot
	 *	@return	boolean
	*/
	public final function RemoveItem($slot)
	{
		if(!$this->vars['slots'][--$slot])
			return false;
			
		$this->SkipSlot($slot, $this->vars['slots'][$slot]['x'], $this->vars['slots'][$slot]['y'], true);
		
		$this->vars['slots'][$slot]['hexa'] = str_repeat("F", $this->settings['Length']['Item']);
		$this->vars['slots'][$slot]['free'] = TRUE;
		$this->vars['slots'][$slot]['ready'] = FALSE;
		$this->vars['slots'][$slot]['x'] = 0;
		$this->vars['slots'][$slot]['y'] = 0;
		
		return true;
	}
	/**
	 *	Skip Slot
	 *	Skip free slots
	 *
	 *	@param	integer	Vault Slot
	 *	@param	integer	Item Length: x
	 *	@param	integer	Item Length: y
	 *	@param	boolean	Set Status
	 *	@return	void
	*/
	public final function SkipSlot($slot, $ix, $iy, $status = FALSE)
	{
		$slot--;
		
		for($x = 0; $x < $ix; $x++)
		{
			for($y = 0; $y < $iy; $y++)
			{
				$this->vars['slots'][$slot + $x]['free'] = $status;
				$this->vars['slots'][$slot + $x + 8 * $y]['free'] = $status;
			}
		}
	}
	/**
	 *	Compile Vault Hexa
	 *	Load and compile a full vault hexa
	 *
	 *	@param	&string	Vault Hexa
	 *	@return	string	Vault Hexa
	*/
	public final function CompileVaultHex(&$vaultHexa = NULL)
	{
		for($i = 0; $i < $this->settings['Limit']; $i++)
			$vaultHexa .= $this->loadFixItem($this->vars['slots'][$i]['hexa']);
			
		return $vaultHexa = $this->loadFixVault($vaultHexa);
	}
	/**
	 *	Close Vault
	 *	Compile hexadecimal and update Vault
	 *
	 	@param	boolean	Update Vault DB
		@param	&string	Vault Hexa
	 *	@return	string	Vault Hexa
	*/
	public final function CloseVault($updateDatabase = FALSE, &$vaultContent = NULL)
	{
		$this->CompileVaultHex($vaultContent);
		
		if($updateDatabase == true)
		{
			$finalWhere = $this->vars['number'] > -1 ? " AND [".$this->settings['Table']['Number']."] = %d" : NULL;
			
			$queryString = "UPDATE [".$this->settings['Database']."].dbo.[".$this->settings['Table']['Table']."]";
			$queryString .= " SET [".$this->settings['Table']['Items']."] = 0x".$vaultContent;
			$queryString .= " WHERE [".$this->settings['Table']['Account']."] = '%s'".$finalWhere;
			
			self::Driver()->MSSQL()->Arguments($this->vars['username'], $this->vars['number']);
			self::Driver()->MSSQL()->Query($queryString);
		}
		
		$this->vars = array();
		return $vaultContent;
	}
	/**
	 *	Open Vault from Username
	 *	Open vault from Username
	 *
	 *	@param	string	Login Name
	 *	@param	integer	Vault Number
	 *	@return	void
	*/
	private final function loadOpenVaultFromUser($login, $number = -1)
	{
		$finalWhere = $number > -1 ? " AND [".$this->settings['Table']['Number']."] = %d" : NULL;
		
		$queryString = "DECLARE @vault varbinary(".$this->settings['Length']['Vault'].");\n\n";
		$queryString .= "SELECT @vault = [".$this->settings['Table']['Items']."] FROM [".$this->settings['Database']."]";
		$queryString .= ".dbo.[".$this->settings['Table']['Table']."] WHERE [".$this->settings['Table']['Account']."]".$finalWhere;
		$queryString .= " = '%s';\n";
		$queryString .= "PRINT @vault;";
		
		self::Driver()->MSSQL()->Arguments($login, $number);
		self::Driver()->MSSQL()->Query($queryString);
		
		$hexadecimal = strtoupper(substr(trim(self::Driver()->MSSQL()->Client()->GetLastMessage()), 2));
		
		$this->vars['username'] = $login;
		$this->vars['vaulthex'] = $hexadecimal;
	}
	/**
	 *	Open Vault from Hexadecimal
	 *	Open vault from Hexadecimal
	 *
	 *	@param	string	Hexadecimal
	 *	@return	void
	*/
	private final function loadOpenVaultFromHexa($login)
	{
		$hexadecimal = strtoupper($hexadecimal);
		
		if(empty($hexadecimal))
			$dexadecimal = str_repeat("FF", $this->settings['Length']['Vault']);
			
		return $this->vars['vaulthex'] = $this->loadFixVault($hexadecimal);
	}
	/**
	 *	Vault Cut Slots
	 *	Cut slots from vault hexadecimal
	 *
	 *	@return	void
	*/
	private final function loadVaultCutSlots()
	{
		for($i = 0; $i < $this->settings['Limit']; $i++)
		{
			$hexa = substr($this->vars['vaulthex'], $i * $this->settings['Length']['Item'], $this->settings['Length']['Item']);
			
			if($this->loadIsFreeSlot($hexa) == true)
			{
				$free = TRUE;
				$x = 0;
				$y = 0;
			}
			else
			{
				self::Lib('Item')->GetItemIndex($hexa, $itemIndex);
				self::Lib('Item')->Database()->GetItemSize($itemIndex['section'], $itemIndex['index'], $itemSize);
				
				$free = FALSE;
				$x = $itemSize['x'];
				$y = $itemSize['y'];
			}
			
			$this->vars['slots'][$i]['hexa'] = $hexa;
			$this->vars['slots'][$i]['free'] = $free;
			$this->vars['slots'][$i]['ready'] = FALSE;
			$this->vars['slots'][$i]['x'] = $x;
			$this->vars['slots'][$i]['y'] = $y;
		}
	}
	/**
	 *	Vault Restructure Slots
	 *	Restructure slots from vault slots
	 *
	 *	@return	void
	*/
	private final function loadVaultRestructureSlots()
	{
		for($i = 0; $i < $this->settings['Limit']; $i++)
		{
			if($this->vars['slots'][$i]['free'] == true)
				continue;
				
			for($x = 0; $x < $this->vars['slots'][$i]['x']; $x++)
			{
				for($y = 0; $y < $this->vars['slots'][$i]['y']; $y++)
				{
					$this->vars['slots'][$i + $x]['free'] = FALSE;
					$this->vars['slots'][$i + $x + 8 * $y]['free'] = FALSE;
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
	 *	Fix Vault Hexa
	 *	Fix length of vault hexa
	 *
	 *	@param	string	Hexadecimal
	 *	@return	string	Hexadecimal fixed
	*/
	private final function loadFixVault($hexadecimal)
	{
		return str_pad(strtoupper($hexadecimal), $this->settings['Length']['Vault'] * 2, "F", STR_PAD_RIGHT);
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