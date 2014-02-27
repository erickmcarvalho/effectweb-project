<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Panel User - Class Virtual Vault
 * Last Update: 09/06/2013 - 16:48h
 * Author: $CTM['Erick-Master']['Litlle']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class UserPanel_VirtualVault extends CTM_EffectWeb_UserPanel
{
	/**
	 *	Vault Parse Items
	 *
	 *	@access	private
	 *	@var	array
	*/
	private $vaultParseItems	= array();
	/**
	 *	Game Vault Items
	 *
	 *	@access	private
	 *	@var	array
	*/
	private $vaultItems			= array();
	
	/**
	 *	Init Class
	 *
	 *	@return	void
	*/
	public function initClass()
	{
		$this->registry();
		$this->FactoryCP();
	}
	/**
	 *	Open Vault
	 *
	 *	@return	void
	*/
	public function OpenVault()
	{
		$this->MuLib('Item')->Vault()->OpenVault(USER_ACCOUNT);
		
		$this->vaultParseItems = $this->MuLib('Item')->Vault()->GetVaultItems(true);
		
		foreach($this->vaultParseItems as $key => $item)
			$this->vaultItems[$item['Parse']['Serial']] = array($key, $item['Hex']);
	}
	/**
	 *	Load Items Vaults
	 *
	 *	@return	array
	*/
	public function LoadItemsVaults()
	{
		$vaultItems = array();
		$virtualItems = array();
		
		$this->DB->Arguments(USER_ACCOUNT);
		$this->DB->Query("SELECT ItemHex FROM ".MUGEN_CORE.".dbo.EffectWebVirtualVault WHERE Account = '%s'", $virtual);
			
		if(count($this->vaultParseItems) > 0)
		{
			$this->MuLib('Item')->Vault()->CloseVault(false);
			
			foreach($this->vaultParseItems as $key => $value)
			{
				$itemDetails = $this->functions->LoadItemDetails($value['Parse']);
				
				$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
				$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
				$vaultItems[$key]['name'] = $itemDetails['Name'];
				$vaultItems[$key]['serial'] = $value['Parse']['Serial'];
				$vaultItems[$key]['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
				$vaultItems[$key]['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
				$vaultItems[$key]['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
				$vaultItems[$key]['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
				$vaultItems[$key]['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
				$vaultItems[$key]['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
				$vaultItems[$key]['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
			}
		}
		
		if($this->DB->CountRows($virtual) > 0)
		{
			$key = 0;
				
			while($virtualVault = $this->DB->FetchObject($virtual))
			{
				$itemHex = strtoupper(bin2hex($virtualVault->ItemHex));
				$itemParse = $this->MuLib('Item')->ParseItemHex($itemHex);
				$itemDetails = $this->functions->LoadItemDetails($itemParse);
				
				$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
				$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
					
				$virtualItems[$key]['name'] = $itemDetails['Name'];
				$virtualItems[$key]['serial'] = $itemParse['Serial'];
				$virtualItems[$key]['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
				$virtualItems[$key]['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
				$virtualItems[$key]['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
				$virtualItems[$key]['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
				$virtualItems[$key]['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
				$virtualItems[$key]['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
				$virtualItems[$key]['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				$key++;		
			}
		}
			
		return array("GameVault" => $vaultItems, "VirtualVault" => $virtualItems);
	}
	/**
	 *	Transfer Item to Virtual Vault
	 *
	 *	Return result operation:
	 *	ERROR				= Operation error of browse hack detected
	 *	VAULT_FULL			= No space in the virtual vault
	 *	ALL_OK				= Item transfered with success	
	 *
	 *	@param	string	Item Serial	
	 *	@return	string
	*/
	public function TransferItemToVirtual($itemSerial)
	{
		if(!array_key_exists($itemSerial, $this->vaultItems))
		{
			$this->MuLib('Item')->Vault()->CloseVault(true);
			return "ERROR";
		}
		else
		{
			if($this->settings['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['INSERT_ITEM'] == false)
			{
				$this->MuLib('Item')->Vault()->CloseVault(true);
				return "ERROR";
			}
			
			if($this->settings['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['ITEMS_LIMIT'][$this->userData['vip'][VIP_COLUMN]] > 0)
			{
				$this->DB->Arguments(USER_ACCOUNT);
				$this->DB->Query("SELECT Account FROM ".MUGEN_CORE.".dbo.EffectWebVirtualVault WHERE Account = '%s'", $itemCount);
				
				if($this->DB->CountRows($itemCount) >= $this->settings['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['ITEMS_LIMIT'][$this->userData['vip'][VIP_COLUMN]])
				{
					$this->MuLib('Item')->Vault()->CloseVault(true);
					return "VAULT_FULL";
				}
			}
			
			$key = $this->vaultItems[$itemSerial][0];
			$hexItem = $this->vaultItems[$itemSerial][1]; 
			
			$this->DB->Arguments("0x".$itemSerial);
			$this->DB->Query("SELECT ItemHex FROM ".MUGEN_CORE.".dbo.EffectWebVirtualVault WHERE ItemSerial = %s", $virtual);
			
			if($this->DB->CountRows($virtual) <= 0)
			{
				$this->MuLib('Item')->Vault()->RemoveItem($key);
				$this->MuLib('Item')->Vault()->CloseVault(true);
				
				$this->DB->Arguments("0x".$hexItem, "0x".$itemSerial, USER_ACCOUNT, time());
				$this->DB->Query("INSERT ".MUGEN_CORE.".dbo.EffectWebVirtualVault (ItemHex, ItemSerial, Account, SendDate) VALUES (%s, %s, '%s', %d)");
	
				return "ALL_OK";
			}
		}
	}
	/**
	 *	Transfer Item to Game Vault
	 *
	 *	Return result operation:
	 *	ERROR				= Operation error of browse hack detected
	 *	VAULT_FULL			= No space in the vault of the game
	 *	ALL_OK				= Item transfered with success	
	 *
	 *	@param	string	Item Serial	
	 *	@return	string
	*/
	public function TransferItemToGame($itemSerial)
	{
		$this->DB->Arguments("0x".$itemSerial, USER_ACCOUNT);
		$this->DB->Query("SELECT ItemHex FROM ".MUGEN_CORE.".dbo.EffectWebVirtualVault WHERE ItemSerial = %s AND Account = '%s'", $query);
		
		if($this->DB->CountRows($query) < 1)
		{
			$this->MuLib('Item')->Vault()->CloseVault(true);
			return "ERROR";
		}
		elseif(array_key_exists($itemSerial, $this->vaultItems))
		{
			$this->MuLib('Item')->Vault()->CloseVault(true);
			return "ERROR";
		}
		else
		{
			$itemHex = $this->DB->FetchRow($query);
			$itemHex = $this->MuLib('Item')->FixItemHex($itemHex[0], true);
			
			$this->MuLib('Item')->GetItemIndex($itemHex, $itemIndex);
			$this->MuLib('Item')->Database()->GetItemSize($itemIndex['section'], $itemIndex['index'], $itemSize);
			$this->MuLib('Item')->Vault()->FindSlotFree($itemSize['x'], $itemSize['y'], $findSlotFree);
			
			if($findSlotFree == false)
			{
				$this->MuLib('Item')->Vault()->CloseVault(true);
				return "VAULT_FULL";
			}
			else
			{
				if($this->MuLib('Item')->Vault()->InsertItem($itemHex) == true)
				{
					$this->MuLib('Item')->Vault()->CloseVault(true);
					$this->DB->Arguments("0x".$itemSerial, USER_ACCOUNT);
					$this->DB->Query("DELETE FROM ".MUGEN_CORE.".dbo.EffectWebVirtualVault WHERE ItemSerial = %s AND Account = '%s'");
					
					return "ALL_OK";
				}
				else
				{
					$this->MuLib('Item')->Vault()->CloseVault(true);
					return "ERROR";
				}
			}
		}
	}
}