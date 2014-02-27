<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Application User Control Panel - Character Options
 * Last Update: 27/07/2012 - 15:23h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class UserPanel_Character extends CTM_EffectWeb_UserPanel
{
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
	 *	Option: View Character
	 *	Show infos of the character selected
	 *
	 *	@return	void
	*/
	public function ViewCharacter()
	{
		$character = $this->MuLib('Member')->LoadChar($this->character);
		
		switch($_GET['do'])
		{
			case "inventory" :
				$this->MuLib('Item')->Inventory()->OpenInventory($this->character);
				$this->MuLib('Item')->Inventory()->GetInventoryItems(true, $inventory);
				$this->MuLib('Item')->Inventory()->CloseInventory(false);
				
				if($inventory['Equipments']['Hand']['Left'] != "No item")
				{
					$itemDetails = $this->functions->LoadItemDetails($inventory['Equipments']['Hand']['Left']['Parse'], $character);
					
					$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
					$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
					$inventoryItems['equipments']['hand']['left']['name'] = $itemDetails['Name'];
					$inventoryItems['equipments']['hand']['left']['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
					$inventoryItems['equipments']['hand']['left']['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
					$inventoryItems['equipments']['hand']['left']['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
					$inventoryItems['equipments']['hand']['left']['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
					$inventoryItems['equipments']['hand']['left']['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
					$inventoryItems['equipments']['hand']['left']['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
					$inventoryItems['equipments']['hand']['left']['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				}
				else
				{
					$inventoryItems['equipments']['hand']['left']['name'] = $this->lang->words['UserPanel']['ViewCharacter']['Inventory']['NoItem'];
				}
				
				if($inventory['Equipments']['Hand']['Right'] != "No item")
				{
					$itemDetails = $this->functions->LoadItemDetails($inventory['Equipments']['Hand']['Right']['Parse'], $character);
					
					$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
					$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
					$inventoryItems['equipments']['hand']['right']['name'] = $itemDetails['Name'];
					$inventoryItems['equipments']['hand']['right']['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
					$inventoryItems['equipments']['hand']['right']['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
					$inventoryItems['equipments']['hand']['right']['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
					$inventoryItems['equipments']['hand']['right']['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
					$inventoryItems['equipments']['hand']['right']['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
					$inventoryItems['equipments']['hand']['right']['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
					$inventoryItems['equipments']['hand']['right']['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				}
				else
				{
					$inventoryItems['equipments']['hand']['right']['name'] = $this->lang->words['UserPanel']['ViewCharacter']['Inventory']['NoItem'];
				}
				
				if($inventory['Equipments']['Set']['Helm'] != "No item")
				{
					$itemDetails = $this->functions->LoadItemDetails($inventory['Equipments']['Set']['Helm']['Parse'], $character);
					
					$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
					$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
					$inventoryItems['equipments']['set']['helm']['name'] = $itemDetails['Name'];
					$inventoryItems['equipments']['set']['helm']['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
					$inventoryItems['equipments']['set']['helm']['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
					$inventoryItems['equipments']['set']['helm']['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
					$inventoryItems['equipments']['set']['helm']['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
					$inventoryItems['equipments']['set']['helm']['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
					$inventoryItems['equipments']['set']['helm']['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
					$inventoryItems['equipments']['set']['helm']['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				}
				else
				{
					$inventoryItems['equipments']['set']['helm']['name'] = $this->lang->words['UserPanel']['ViewCharacter']['Inventory']['NoItem'];
				}
				
				if($inventory['Equipments']['Set']['Armor'] != "No item")
				{
					$itemDetails = $this->functions->LoadItemDetails($inventory['Equipments']['Set']['Armor']['Parse'], $character);
					
					$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
					$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
					$inventoryItems['equipments']['set']['armor']['name'] = $itemDetails['Name'];
					$inventoryItems['equipments']['set']['armor']['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
					$inventoryItems['equipments']['set']['armor']['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
					$inventoryItems['equipments']['set']['armor']['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
					$inventoryItems['equipments']['set']['armor']['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
					$inventoryItems['equipments']['set']['armor']['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
					$inventoryItems['equipments']['set']['armor']['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
					$inventoryItems['equipments']['set']['armor']['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				}
				else
				{
					$inventoryItems['equipments']['set']['armor']['name'] = $this->lang->words['UserPanel']['ViewCharacter']['Inventory']['NoItem'];
				}
				
				if($inventory['Equipments']['Set']['Pants'] != "No item")
				{
					$itemDetails = $this->functions->LoadItemDetails($inventory['Equipments']['Set']['Pants']['Parse'], $character);
					
					$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
					$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
					$inventoryItems['equipments']['set']['pants']['name'] = $itemDetails['Name'];
					$inventoryItems['equipments']['set']['pants']['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
					$inventoryItems['equipments']['set']['pants']['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
					$inventoryItems['equipments']['set']['pants']['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
					$inventoryItems['equipments']['set']['pants']['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
					$inventoryItems['equipments']['set']['pants']['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
					$inventoryItems['equipments']['set']['pants']['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
					$inventoryItems['equipments']['set']['pants']['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				}
				else
				{
					$inventoryItems['equipments']['set']['pants']['name'] = $this->lang->words['UserPanel']['ViewCharacter']['Inventory']['NoItem'];
				}
				
				if($inventory['Equipments']['Set']['Gloves'] != "No item")
				{
					$itemDetails = $this->functions->LoadItemDetails($inventory['Equipments']['Set']['Gloves']['Parse'], $character);
					
					$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
					$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
					$inventoryItems['equipments']['set']['gloves']['name'] = $itemDetails['Name'];
					$inventoryItems['equipments']['set']['gloves']['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
					$inventoryItems['equipments']['set']['gloves']['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
					$inventoryItems['equipments']['set']['gloves']['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
					$inventoryItems['equipments']['set']['gloves']['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
					$inventoryItems['equipments']['set']['gloves']['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
					$inventoryItems['equipments']['set']['gloves']['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
					$inventoryItems['equipments']['set']['gloves']['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				}
				else
				{
					$inventoryItems['equipments']['set']['gloves']['name'] = $this->lang->words['UserPanel']['ViewCharacter']['Inventory']['NoItem'];
				}
				
				if($inventory['Equipments']['Set']['Boots'] != "No item")
				{
					$itemDetails = $this->functions->LoadItemDetails($inventory['Equipments']['Set']['Boots']['Parse'], $character);
					
					$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
					$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
					$inventoryItems['equipments']['set']['boots']['name'] = $itemDetails['Name'];
					$inventoryItems['equipments']['set']['boots']['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
					$inventoryItems['equipments']['set']['boots']['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
					$inventoryItems['equipments']['set']['boots']['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
					$inventoryItems['equipments']['set']['boots']['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
					$inventoryItems['equipments']['set']['boots']['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
					$inventoryItems['equipments']['set']['boots']['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
					$inventoryItems['equipments']['set']['boots']['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				}
				else
				{
					$inventoryItems['equipments']['set']['boots']['name'] = $this->lang->words['UserPanel']['ViewCharacter']['Inventory']['NoItem'];
				}
				
				if($inventory['Equipments']['Wing'] != "No item")
				{
					$itemDetails = $this->functions->LoadItemDetails($inventory['Equipments']['Wing']['Parse'], $character);
					
					$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
					$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
					$inventoryItems['equipments']['wing']['name'] = $itemDetails['Name'];
					$inventoryItems['equipments']['wing']['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
					$inventoryItems['equipments']['wing']['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
					$inventoryItems['equipments']['wing']['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
					$inventoryItems['equipments']['wing']['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
					$inventoryItems['equipments']['wing']['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
					$inventoryItems['equipments']['wing']['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
					$inventoryItems['equipments']['wing']['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				}
				else
				{
					$inventoryItems['equipments']['wing']['name'] = $this->lang->words['UserPanel']['ViewCharacter']['Inventory']['NoItem'];
				}
				
				if($inventory['Equipments']['Pet'] != "No item")
				{
					$itemDetails = $this->functions->LoadItemDetails($inventory['Equipments']['Pet']['Parse'], $character);
					
					$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
					$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
					$inventoryItems['equipments']['pet']['name'] = $itemDetails['Name'];
					$inventoryItems['equipments']['pet']['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
					$inventoryItems['equipments']['pet']['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
					$inventoryItems['equipments']['pet']['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
					$inventoryItems['equipments']['pet']['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
					$inventoryItems['equipments']['pet']['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
					$inventoryItems['equipments']['pet']['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
					$inventoryItems['equipments']['pet']['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				}
				else
				{
					$inventoryItems['equipments']['pet']['name'] = $this->lang->words['UserPanel']['ViewCharacter']['Inventory']['NoItem'];
				}
				
				if($inventory['Equipments']['Pendant'] != "No item")
				{
					$itemDetails = $this->functions->LoadItemDetails($inventory['Equipments']['Pendant']['Parse'], $character);
					
					$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
					$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
					$inventoryItems['equipments']['pendant']['name'] = $itemDetails['Name'];
					$inventoryItems['equipments']['pendant']['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
					$inventoryItems['equipments']['pendant']['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
					$inventoryItems['equipments']['pendant']['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
					$inventoryItems['equipments']['pendant']['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
					$inventoryItems['equipments']['pendant']['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
					$inventoryItems['equipments']['pendant']['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
					$inventoryItems['equipments']['pendant']['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				}
				else
				{
					$inventoryItems['equipments']['pendant']['name'] = $this->lang->words['UserPanel']['ViewCharacter']['Inventory']['NoItem'];
				}
				
				if($inventory['Equipments']['Ring']['Left'] != "No item")
				{
					$itemDetails = $this->functions->LoadItemDetails($inventory['Equipments']['Ring']['Left']['Parse'], $character);
					
					$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
					$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
					$inventoryItems['equipments']['ring']['left']['name'] = $itemDetails['Name'];
					$inventoryItems['equipments']['ring']['left']['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
					$inventoryItems['equipments']['ring']['left']['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
					$inventoryItems['equipments']['ring']['left']['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
					$inventoryItems['equipments']['ring']['left']['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
					$inventoryItems['equipments']['ring']['left']['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
					$inventoryItems['equipments']['ring']['left']['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
					$inventoryItems['equipments']['ring']['left']['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				}
				else
				{
					$inventoryItems['equipments']['ring']['left']['name'] = $this->lang->words['UserPanel']['ViewCharacter']['Inventory']['NoItem'];
				}
				
				if($inventory['Equipments']['Ring']['Right'] != "No item")
				{
					$itemDetails = $this->functions->LoadItemDetails($inventory['Equipments']['Ring']['Right']['Parse'], $character);
					
					$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
					$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
				
					$inventoryItems['equipments']['ring']['right']['name'] = $itemDetails['Name'];
					$inventoryItems['equipments']['ring']['right']['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
					$inventoryItems['equipments']['ring']['right']['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
					$inventoryItems['equipments']['ring']['right']['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
					$inventoryItems['equipments']['ring']['right']['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
					$inventoryItems['equipments']['ring']['right']['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
					$inventoryItems['equipments']['ring']['right']['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
					$inventoryItems['equipments']['ring']['right']['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					
				}
				else
				{
					$inventoryItems['equipments']['ring']['right']['name'] = $this->lang->words['UserPanel']['ViewCharacter']['Inventory']['NoItem'];
				}
				
				if(count($inventory['Inventory']) > 0)
				{
					foreach($inventory['Inventory'] as $key => $value)
					{
						$itemDetails = $this->functions->LoadItemDetails($value['Parse'], $character);
						
						$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
						$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
						
						$inventoryItems['inventory'][$key]['name'] = $itemDetails['Name'];
						$inventoryItems['inventory'][$key]['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
						$inventoryItems['inventory'][$key]['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
						$inventoryItems['inventory'][$key]['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
						$inventoryItems['inventory'][$key]['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
						$inventoryItems['inventory'][$key]['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
						$inventoryItems['inventory'][$key]['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
						$inventoryItems['inventory'][$key]['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
					}
				}
				
				if(MUSERVER_VERSION >= 2)
				{
					if(count($inventory['PersonalStore']) > 0)
					{
						foreach($inventory['PersonalStore'] as $key => $value)
						{
							$itemDetails = $this->functions->LoadItemDetails($value['Parse'], $character);
							
							$requirement = "<ul id='requirement'>\\\n".$itemDetails['Tooltip']['Requirement']."\\\n</ul>";
							$classUse = "<br />\\\n<ul id='classUse'>\\\n".$itemDetails['Tooltip']['ClassUse']."\\\n</ul>";
							
							$inventoryItems['personal_store'][$key]['name'] = $itemDetails['Name'];
							$inventoryItems['personal_store'][$key]['tooltip']['set_item'] = $itemDetails['Tooltip']['Set_Item'];
							$inventoryItems['personal_store'][$key]['tooltip']['begin'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Begin']);
							$inventoryItems['personal_store'][$key]['tooltip']['requirement'] = isset($itemDetails['Tooltip']['Requirement']) ? $requirement : NULL;
							$inventoryItems['personal_store'][$key]['tooltip']['class_use'] = isset($itemDetails['Tooltip']['ClassUse']) ? $classUse : NULL;
							$inventoryItems['personal_store'][$key]['tooltip']['harmony'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Harmony']);
							$inventoryItems['personal_store'][$key]['tooltip']['options'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Options']);
							$inventoryItems['personal_store'][$key]['tooltip']['socket'] = str_replace("{#}", "<br />\\\n", $itemDetails['Tooltip']['Socket']);	
						}
					}
				}
				
				$GLOBALS['userpanel']['view_char']['inventory'] = $inventoryItems;
				$this->LoadPage("option_viewChar_inventory", true);
			break;
			default :
				$GLOBALS['userpanel']['view_char']['image'] = $this->functions->GetCharImage($character[COLUMN_CHARIMAGE]);
				$GLOBALS['userpanel']['view_char']['class_name'] = $this->functions->ClassInfo($character['Class']);
				$GLOBALS['userpanel']['view_char']['class_is_lord'] = $this->functions->ClassIsLord($character['Class']);
				$GLOBALS['userpanel']['view_char']['level'] = intval($character['cLevel']);
				$GLOBALS['userpanel']['view_char']['experience'] = intval($character['Experience']);
				$GLOBALS['userpanel']['view_char']['points'] = number_format($character['LevelUpPoint'], 0, false, ".");
				$GLOBALS['userpanel']['view_char']['resets'] = number_format($character[COLUMN_RESET], 0, false, ".");
				$GLOBALS['userpanel']['view_char']['master_resets'] = number_format($character[COLUMN_MRESET], 0, false, ".");
				$GLOBALS['userpanel']['view_char']['strength'] = number_format($character['Strength'], 0, false, ".");
				$GLOBALS['userpanel']['view_char']['dexterity'] = number_format($character['Dexterity'], 0, false, ".");
				$GLOBALS['userpanel']['view_char']['vitality'] = number_format($character['Vitality'], 0, false, ".");
				$GLOBALS['userpanel']['view_char']['energy'] = number_format($character['Energy'], 0, false, ".");
				$GLOBALS['userpanel']['view_char']['command'] = number_format($character[COLUMN_COMMAND], 0, false, ".");
				$GLOBALS['userpanel']['view_char']['map_name'] = $this->functions->MapInfo($character['MapNumber']);
				$GLOBALS['userpanel']['view_char']['map_posx'] = intval($character['MapPosX']);
				$GLOBALS['userpanel']['view_char']['map_posy'] = intval($character['MapPosY']);
			break;
		}
	}
	/**
	 *	Option: Reset System
	 *	Reset the character
	 *
	 *	@return	void
	*/
	public function ResetSystem()
	{
		$charStatus = $this->MuLib('Member')->LoadChar($this->character);
		
		if($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] == 4)
		{
			$serialize_file = CTM_FileManage::Lib('ReadScript')->CheckSerializeFile("Web_ResetTable.serialize.dat") == false;
			$structure_file = CTM_FileManage::Lib('ReadScript')->StructureFile(CTM_CONTROL_PATH."Data/ResetTable.txt", "Web_ResetTable.serialize.dat", FALSE);
			$serialize_data = CTM_FileManage::Lib('ReadScript')->ReadScript();
			
			foreach($serialize_data as $key => $value)
			{
				$separate = explode("-", $key);
				
				if($separate[1] == "XXX")
					$separate[1] = $charStatus[COLUMN_RESET];
					
				if($charStatus[COLUMN_RESET] >= $separate[0] && $charStatus[COLUMN_RESET] <= $separate[1])
				{
					$setData = $value;
					break;
				}
			}
			
			$settings['LEVEL_RESET'] = $setData[0][$this->userData['vip'][VIP_COLUMN]];
			$settings['MONEY_REQUIRE'] = $setData[1][$this->userData['vip'][VIP_COLUMN]];
			$settings['LEVEL_AFTER'] = $setData[2][$this->userData['vip'][VIP_COLUMN]];
			$settings['CLEAR_INVENT'] = (bool)$setData[3][$this->userData['vip'][VIP_COLUMN]];
			$settings['CLEAR_SKILL'] = (bool)$setData[4][$this->userData['vip'][VIP_COLUMN]];
			$settings['CLEAR_QUEST'] = (bool)$setData[5][$this->userData['vip'][VIP_COLUMN]];
			$settings['SET_POINTS'] = $setData[6][$this->userData['vip'][VIP_COLUMN]];
			
		}
		else
		{
			switch($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'])
			{
				case 1 : $CONFIG = 0xC0; break;
				case 2 : $CONFIG = 0xC1; break;
				case 3 : $CONFIG = 0xC2; break;
			}
			
			$settings['LEVEL_RESET'] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_RESET'][$this->userData['vip'][VIP_COLUMN]];
			$settings['MONEY_REQUIRE'] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MONEY_REQUIRE'][$this->userData['vip'][VIP_COLUMN]];
			$settings['LEVEL_AFTER'] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_AFTER'][$this->userData['vip'][VIP_COLUMN]];
			$settings['CLEAR_INVENT'] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_INVENT'][$this->userData['vip'][VIP_COLUMN]];
			$settings['CLEAR_SKILL'] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_SKILL'][$this->userData['vip'][VIP_COLUMN]];
			$settings['CLEAR_QUEST'] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_QUEST'][$this->userData['vip'][VIP_COLUMN]];
			
			if($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] > 1)
				$settings['SET_POINTS'] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][$CONFIG]['SET_POINTS'][$this->userData['vip'][VIP_COLUMN]];
		}
		
		if($_GET['write'] == true)
		{
			$error = $this->LoadClass("Error", "class_sources");
			
			if($charStatus['cLevel'] < $settings['LEVEL_RESET'])
				$error->AddError($this->lang->words['UserPanel']['ResetSystem']['Messages']['Error_Level']);
				
			if($charStatus['Money'] < $settings['MONEY_REQUIRE'])
				$error->AddError($this->lang->words['UserPanel']['ResetSystem']['Messages']['Error_Money']);
				
			if($error->count[0] > 0)
			{
				$message = $this->lang->words['UserPanel']['ResetSystem']['Messages']['Error_Message'];
				$message .= "<br /><br />".$error->showError();
					
				return setResult(showMessage($message, 2));
			}
			else
			{
				$columnsUpdate = array
				(
					"cLevel" => $settings['LEVEL_AFTER'],
					"Money" => "minus:".$settings['MONEY_REQUIRE'],
					"Experience" => 0,
					COLUMN_RESET => "plus:1",
				);
				
				$this->DB->ForceDataType("cLevel", "integer");
				$this->DB->ForceDataType("Money", "integer");
				$this->DB->ForceDataType("Experience", "integer");
				$this->DB->ForceDataType(COLUMN_RESET, "integer");
				
				if($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] == 2)
				{
					$columnsUpdate['LevelUpPoint'] = "plus:".$settings['SET_POINTS'];
					$this->DB->ForceDataType("LevelUpPoint", "integer");
				}
				elseif($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] > 2)
				{
					$stats = $this->functions->CharInitialPoints($charStatus['Class']);
					
					$columnsUpdate['LevelUpPoint'] = ($settings['SET_POINTS'] * ($charStatus[COLUMN_RESET] + 1));
					$columnsUpdate['Strength'] = $stats[0];
					$columnsUpdate['Dexterity'] = $stats[1];
					$columnsUpdate['Vitality'] = $stats[2];
					$columnsUpdate['Energy'] = $stats[3];
					
					$this->DB->ForceDataType("LevelUpPoint", "integer");
					$this->DB->ForceDataType("Strength", "integer");
					$this->DB->ForceDataType("Dexterity", "integer");
					$this->DB->ForceDataType("Vitality", "integer");
					$this->DB->ForceDataType("Energy", "integer");
					
					if($this->functions->ClassIsLord($charStatus['Class']) == true)
					{
						$columnsUpdate[COLUMN_COMMAND] = $stats[4];
						$this->DB->ForceDataType(COLUMN_COMMAND, "integer");
					}
				}
				
				if($settings['CLEAR_INVENT'] == true)
				{
					$columnsUpdate['Inventory'] = "0x".str_repeat("FF", CTM_INVENTORY_SIZE);
					$this->DB->ForceDataType("Inventory", "none");
				}
				
				if($settings['CLEAR_SKILL'] == true)
				{
					$columnsUpdate['MagicList'] = "0x".str_repeat("FF0000", CTM_SKILL_SIZE / 6);
					$this->DB->ForceDataType("MagicList", "none");
				}
				
				if($settings['CLEAR_QUEST'] == true)
				{
					$columnsUpdate['Quest'] = "0x".str_repeat("FF", 50);
					$columnsUpdate['Class'] = $this->functions->CharInitialClass($charStatus['Class']);
					
					$this->DB->ForceDataType("Quest", "none");
					$this->DB->ForceDataType("Class", "integer");
				}
				
				$this->DB->Arguments($this->character, USER_ACCOUNT);
				$this->DB->Update(MUGEN_CORE."@Character", $columnsUpdate, "Name = '%s' AND AccountID = '%s'");
				
				if($this->settings['PANELUSER']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] == 1)
				{
					$columnsUpdate['LevelUpPoint'] = $charStatus['LevelUpPoint'];
				}
				elseif($this->settings['PANELUSER']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] < 3)
				{
					$columnsUpdate['Strength'] = $charStatus['Strength'];
					$columnsUpdate['Dexterity'] = $charStatus['Dexterity'];
					$columnsUpdate['Vitality'] = $charStatus['Vitality'];
					$columnsUpdate['Energy'] = $charStatus['Energy'];
					$columnsUpdate[COLUMN_COMMAND] = $charStatus[COLUMN_COMMAND];
				}
				
				$this->WriteLog(array
				(
					"option" => "Reset System",
					"character" => true,
					"data" => array
					(
						"[Before] Class: ".$this->functions->ClassInfo($charStatus['Class']),
						"[Before] Resets: ".number_format($charStatus[COLUMN_RESET], 0, false, "."),
						"[Before] Level: ".$charStatus['cLevel'],
						"[Before] Points: ".number_format($charStatus['LevelUpPoint'], 0, false, "."),
						"[Before] Money: ".number_format($charStatus['Money'], 0, false, "."),
						"[Before] Strength: ".number_format($charStatus['Strength'], 0, false, "."),
						"[Before] Dexterity: ".number_format($charStatus['Dexterity'], 0, false, "."),
						"[Before] Vitality: ".number_format($charStatus['Vitality'], 0, false, "."),
						"[Before] Energy: ".number_format($charStatus['Energy'], 0, false, "."),
						"[Before] Command: ".number_format($this->functions->ClassIsLord($charStatus['Class']) ? $charStatus[COLUMN_COMMAND] : 0, 0, false, "."),
						"[After] Class: ".$this->functions->ClassInfo($settings['CLEAR_QUEST'] == true ? $columnsUpdate['Class'] : $charStatus['Class']),
						"[After] Resets: ".number_format($charStatus[COLUMN_RESET] + 1, 0, false, "."),
						"[After] Level: ".$columnsUpdate['cLevel'],
						"[After] Points: ".number_format($columnsUpdate['LevelUpPoint'], 0, false, "."),
						"[After] Money: ".number_format($charStatus['Money'] - $settings['MONEY_REQUIRE'], 0, false, "."),
						"[After] Strength: ".number_format($columnsUpdate['Strength'], 0, false, "."),
						"[After] Dexterity: ".number_format($columnsUpdate['Dexterity'], 0, false, "."),
						"[After] Vitality: ".number_format($columnsUpdate['Vitality'], 0, false, "."),
						"[After] Energy: ".number_format($columnsUpdate['Energy'], 0, false, "."),
						"[After] Command: ".number_format($this->functions->ClassIsLord($charStatus['Class']) ? $columnsUpdate[COLUMN_COMMAND] : 0, 0, false, "."),
						"[After] Clear Inventory: ".($settings['CLEAR_INVENT'] == true ? "Yes" : "No"),
						"[After] Clear Skills: ".($settings['CLEAR_SKILL'] == true ? "Yes" : "No"),
						"[After] Clear Quests: ".($settings['CLEAR_QUEST'] == true ? "Yes" : "No"),
					),
				));
				
				$this->lang->setArguments("UserPanel,ResetSystem,Messages,Success", $charStatus[COLUMN_RESET] + 1);
				setResult(showMessage($this->lang->words['UserPanel']['ResetSystem']['Messages']['Success'], 3));
			}
		}
		
		$number = create_function("\$integer", "return number_format(\$integer, 0, false, '.');");
		$span = create_function("\$string, \$bool", "return '<span style=\"color: '.(\$bool == true ? 'red' : 'green').'\">'.\$string.'</span>';");
		
		$clear_after = array
		(
			0 => $settings['CLEAR_INVENT'] == true ? $this->lang->words['Words']['Yes'] : $this->lang->words['Words']['No'],
			1 => $settings['CLEAR_SKILL'] == true ? $this->lang->words['Words']['Yes'] : $this->lang->words['Words']['No'],
			2 => $settings['CLEAR_QUEST'] == true ? $this->lang->words['Words']['Yes'] : $this->lang->words['Words']['No']
		);
		
		$GLOBALS['userpanel']['reset_system']['mode'] = $this->functions->GetResetInfo(0, "TYPE");
		$GLOBALS['userpanel']['reset_system']['class_is_lord'] = $this->functions->ClassIsLord($charStatus['Class']);
		$GLOBALS['userpanel']['reset_system']['require']['level'] = $settings['LEVEL_RESET'];
		$GLOBALS['userpanel']['reset_system']['require']['money'] = $number($settings['MONEY_REQUIRE']);
		
		$GLOBALS['userpanel']['reset_system']['before']['resets'] = $number($charStatus[COLUMN_RESET]);
		$GLOBALS['userpanel']['reset_system']['before']['level'] = $charStatus['cLevel'];
		$GLOBALS['userpanel']['reset_system']['before']['points'] = $number($charStatus['LevelUpPoint']);
		$GLOBALS['userpanel']['reset_system']['before']['class'] = $this->functions->ClassInfo($charStatus['Class']);
		$GLOBALS['userpanel']['reset_system']['before']['money'] = $number($charStatus['Money']);
		
		if($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] > 2)
		{
			$GLOBALS['userpanel']['reset_system']['before']['strength'] = $number($charStatus['Strength']);
			$GLOBALS['userpanel']['reset_system']['before']['dexterity'] = $number($charStatus['Dexterity']);
			$GLOBALS['userpanel']['reset_system']['before']['vitality'] = $number($charStatus['Vitality']);
			$GLOBALS['userpanel']['reset_system']['before']['energy'] = $number($charStatus['Energy'], 0);
			$GLOBALS['userpanel']['reset_system']['before']['command'] = $number($charStatus[COLUMN_COMMAND]);
		}
		
		$GLOBALS['userpanel']['reset_system']['after']['resets'] = $number($charStatus[COLUMN_RESET] + 1);
		$GLOBALS['userpanel']['reset_system']['after']['level'] = $settings['LEVEL_AFTER'];
		$GLOBALS['userpanel']['reset_system']['after']['money'] = $number($charStatus['Money'] - $settings['MONEY_REQUIRE']);
		
		switch($this->settings['USERPANEL']['CHARACTER']['RESET'][0xFF]['MODE'])
		{
			case 1 : $GLOBALS['userpanel']['reset_system']['after']['points'] = $number($charStatus['LevelUpPoint']); break;
			case 2 : $GLOBALS['userpanel']['reset_system']['after']['points'] = $number($charStatus['LevelUpPoint'] + $settings['SET_POINTS']); break;
			default : $GLOBALS['userpanel']['reset_system']['after']['points'] = $number($settings['SET_POINTS'] * ($charStatus[COLUMN_RESET] + 1));
		}
		
		$GLOBALS['userpanel']['reset_system']['after']['class'] = $settings['CLEAR_QUEST'] == true ?
			$this->functions->ClassInfo($this->functions->CharInitialClass($charStatus['Class']))
				: $this->functions->ClassInfo($charStatus['Class']);
		
		if($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] > 2)
		{
			$set = $this->functions->CharInitialPoints($charStatus['Class']);
			$GLOBALS['userpanel']['reset_system']['after']['strength'] = $set[0];
			$GLOBALS['userpanel']['reset_system']['after']['dexterity'] = $set[1];
			$GLOBALS['userpanel']['reset_system']['after']['vitality'] = $set[2];
			$GLOBALS['userpanel']['reset_system']['after']['energy'] = $set[3];
			$GLOBALS['userpanel']['reset_system']['after']['command'] = $set[4];
		}
		
		$GLOBALS['userpanel']['reset_system']['after']['clear_invent'] = $span($clear_after[0], $settings['CLEAR_SKILL']);
		$GLOBALS['userpanel']['reset_system']['after']['clear_skill'] = $span($clear_after[1], $settings['CLEAR_SKILL']);
		$GLOBALS['userpanel']['reset_system']['after']['clear_quest'] = $span($clear_after[2], $settings['CLEAR_QUEST']);
	}
	/**
	 *	Option: Master Reset
	 *	Master Reset the character
	 *
	 *	@return	void
	*/
	public function MasterReset()
	{
		$charStatus = $this->MuLib('Member')->LoadChar($this->character);
		
		$settings['LEVEL_RESET'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['LEVEL_RESET'][$this->userData['vip'][VIP_COLUMN]];
		$settings['MONEY_REQUIRE'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MONEY_REQUIRE'][$this->userData['vip'][VIP_COLUMN]];
		$settings['RESET_POINTS'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['RESET_POINTS'][$this->userData['vip'][VIP_COLUMN]];
		$settings['COIN_AWARD'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['COIN_AWARD'][$this->userData['vip'][VIP_COLUMN]];
		$settings['COIN_NUMBER'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['COIN_NUMBER'];
		$settings['STATS_REQUIRE'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_REQUIRE'];
		$settings['STATS_AFTER'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_AFTER'];
		$settings['CLEAR_INVENT'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_INVENT'][$this->userData['vip'][VIP_COLUMN]];
		$settings['CLEAR_SKILL'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_SKILL'][$this->userData['vip'][VIP_COLUMN]];
		$settings['CLEAR_QUEST'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_QUEST'][$this->userData['vip'][VIP_COLUMN]];
		
		if($this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MODE'] == 1)
		{
			$settings['RESETS_REQUIRE'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REQUIRE'][$this->userData['vip'][VIP_COLUMN]];
			$settings['RESETS_REMOVE'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REMOVE'][$this->userData['vip'][VIP_COLUMN]];
		}
		elseif($this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MODE'] == 2)
			$settings['RESETS_REQUIRE'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC1]['RESETS_REQUIRE'][$this->userData['vip'][VIP_COLUMN]];
		
		$coinName = constant("COIN_NAME_".$settings['COIN_NUMBER']);	
		$coinColumn = constant("COIN_COLUMN_".$settings['COIN_NUMBER']);
			
		if($_GET['write'] == true)
		{
			$error = $this->LoadClass("Error", "class_sources");
			
			if($this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MODE'] < 3 && $charStatus[COLUMN_RESET] < $settings['RESETS_REQUIRE'])
				$error->AddError($this->lang->words['UserPanel']['MasterReset']['Messages']['Error_Resets']);
			
			if($charStatus['cLevel'] < $settings['LEVEL_RESET'])
				$error->AddError($this->lang->words['UserPanel']['MasterReset']['Messages']['Error_Level']);
				
			if($charStatus['Strength'] < $settings['STATS_REQUIRE'][0])
				$error->AddError(sprintf($this->lang->words['UserPanel']['MasterReset']['Messages']['Error_Strength'], $settings['STATS_REQUIRE'][0]));
				
			if($charStatus['Dexterity'] < $settings['STATS_REQUIRE'][1])
				$error->AddError(sprintf($this->lang->words['UserPanel']['MasterReset']['Messages']['Error_Dexterity'], $settings['STATS_REQUIRE'][1]));
				
			if($charStatus['Vitality'] < $settings['STATS_REQUIRE'][2])
				$error->AddError(sprintf($this->lang->words['UserPanel']['MasterReset']['Messages']['Error_Vitality'], $settings['STATS_REQUIRE'][2]));
				
			if($charStatus['Energy'] < $settings['STATS_REQUIRE'][3])
				$error->AddError(sprintf($this->lang->words['UserPanel']['MasterReset']['Messages']['Error_Energy'], $settings['STATS_REQUIRE'][3]));
				
			if($charStatus[COLUMN_COMMAND] < $settings['STATS_REQUIRE'][4] && $this->functions->ClassIsLord($charStatus['Class']) == true)
				$error->AddError(sprintf($this->lang->words['UserPanel']['MasterReset']['Messages']['Error_Command'], $settings['STATS_REQUIRE'][4]));
				
			if($charStatus['Money'] < $settings['MONEY_REQUIRE'])
				$error->AddError($this->lang->words['UserPanel']['MasterReset']['Messages']['Error_Money']);
				
			if($error->count[0] > 0)
			{
				$message = $this->lang->words['UserPanel']['MasterReset']['Messages']['Error_Message'];
				$message .= "<br /><br />".$error->showError();
					
				setResult(showMessage($message, 2));
			}
			else
			{
				$default = $this->functions->CharInitialPoints($charStatus['Class']);
				$set[0] = $settings['STATS_AFTER'][0] == -1 ? $default[0] : $settings['STATS_AFTER'][0];
				$set[1] = $settings['STATS_AFTER'][1] == -1 ? $default[1] : $settings['STATS_AFTER'][1];
				$set[2] = $settings['STATS_AFTER'][2] == -1 ? $default[2] : $settings['STATS_AFTER'][2];
				$set[3] = $settings['STATS_AFTER'][3] == -1 ? $default[3] : $settings['STATS_AFTER'][3];
				$set[4] = $settings['STATS_AFTER'][4] == -1 ? $default[4] : $settings['STATS_AFTER'][4];
				
				$columnsUpdate = array
				(
					"cLevel" => 1,
					"Money" => "minus:".$settings['MONEY_REQUIRE'],
					"Experience" => 0,
					"LevelUpPoint" => 0,
					"Strength" => $set[0],
					"Dexterity" => $set[1],
					"Vitality" => $set[2],
					"Energy" => $set[3],
					COLUMN_MRESET => "plus:1",
				);
				
				$this->DB->ForceDataType("cLevel", "integer");
				$this->DB->ForceDataType("Money", "integer");
				$this->DB->ForceDataType("Experience", "integer");
				$this->DB->ForceDataType("LevelUpPoint", "integer");
				$this->DB->ForceDataType("Strength", "integer");
				$this->DB->ForceDataType("Dexterity", "integer");
				$this->DB->ForceDataType("Vitality", "integer");
				$this->DB->ForceDataType("Energy", "integer");
				$this->DB->ForceDataType(COLUMN_MRESET, "integer");
				
				if($this->functions->ClassIsLord($charStatus['Class']) == true)
				{
					$columnsUpdate[COLUMN_COMMAND] = $set[4];
					$this->DB->ForceDataType(COLUMN_COMMAND, "integer");
				}
				
				if($this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MODE'] == 1)
				{
					$columnsUpdate[COLUMN_RESET] = "minus:".$settings['RESETS_REMOVE'];
					$this->DB->ForceDataType(COLUMN_RESET, "integer");
				}
				
				if($settings['CLEAR_INVENT'] == true)
				{
					$columnsUpdate['Inventory'] = "0x".str_repeat("FF", CTM_INVENTORY_SIZE);
					$this->DB->ForceDataType("Inventory", "none");
				}
				
				if($settings['CLEAR_SKILL'] == true)
				{
					$columnsUpdate['MagicList'] = "0x".str_repeat("FF0000", CTM_SKILL_SIZE / 6);
					$this->DB->ForceDataType("MagicList", "none");
				}
				
				if($settings['CLEAR_QUEST'] == true)
				{
					$columnsUpdate['Quest'] = "0x".str_repeat("FF", 50);
					$columnsUpdate['Class'] = $this->functions->CharInitialClass($charStatus['Class']);
					
					$this->DB->ForceDataType("Quest", "none");
					$this->DB->ForceDataType("Class", "integer");
				}
				
				$this->DB->Arguments($this->character, USER_ACCOUNT);
				$this->DB->Update(MUGEN_CORE."@Character", $columnsUpdate, "Name = '%s' AND AccountID = '%s'");
				
				$this->MuLib('Member')->UpdateAccount(USER_ACCOUNT, array
				(
					"coin" => array
					(
						$coinColumn => $this->userData['coin'][$coinColumn] + $settings['COIN_AWARD']
					)
				));
				
				$this->WriteLog(array
				(
					"option" => "Master Reset",
					"character" => true,
					"data" => array
					(
						"[Before] {$coinName}: ".number_format($this->userData['coin'][$coinColumn], 0, false, "."),
						"[Before] Class: ".$this->functions->ClassInfo($charStatus['Class']),
						"[Before] Master Resets: ".number_format($charStatus[COLUMN_MRESET], 0, false, "."),
						"[Before] Resets: ".number_format($charStatus[COLUMN_RESET], 0, false, "."),
						"[Before] Level: ".$charStatus['cLevel'],
						"[Before] Points: ".number_format($charStatus['LevelUpPoint'], 0, false, "."),
						"[Before] Money: ".number_format($charStatus['Money'], 0, false, "."),
						"[Before] Strength: ".number_format($charStatus['Strength'], 0, false, "."),
						"[Before] Dexterity: ".number_format($charStatus['Dexterity'], 0, false, "."),
						"[Before] Vitality: ".number_format($charStatus['Vitality'], 0, false, "."),
						"[Before] Energy: ".number_format($charStatus['Energy'], 0, false, "."),
						"[Before] Command: ".number_format($this->functions->ClassIsLord($charStatus['Class']) ? $charStatus[COLUMN_COMMAND] : 0, 0, false, "."),
						"[After] {$coinName}: ".number_format($this->userData['coin'][$coinColumn] + $settings['COIN_AWARD'], 0, false, "."),
						"[After] Class: ".$this->functions->ClassInfo($settings['CLEAR_QUEST'] == true ? $columnsUpdate['Class'] : $charStatus['Class']),
						"[After] Master Resets: ".number_format($charStatus[COLUMN_MRESET] + 1, 0, false, "."),
						"[After] Resets: ".number_format($charStatus[COLUMN_RESET] - $settings['RESETS_REMOVE'], 0, false, "."),
						"[After] Level: ".$columnsUpdate['cLevel'],
						"[After] Points: ".number_format($columnsUpdate['LevelUpPoint'], 0, false, "."),
						"[After] Money: ".number_format($charStatus['Money'] - $settings['MONEY_REQUIRE'], 0, false, "."),
						"[After] Strength: ".number_format($columnsUpdate['Strength'], 0, false, "."),
						"[After] Dexterity: ".number_format($columnsUpdate['Dexterity'], 0, false, "."),
						"[After] Vitality: ".number_format($columnsUpdate['Vitality'], 0, false, "."),
						"[After] Energy: ".number_format($columnsUpdate['Energy'], 0, false, "."),
						"[After] Command: ".number_format($this->functions->ClassIsLord($charStatus['Class']) ? $columnsUpdate[COLUMN_COMMAND] : 0, 0, false, "."),
						"[After] Clear Inventory: ".($settings['CLEAR_INVENT'] == true ? "Yes" : "No"),
						"[After] Clear Skills: ".($settings['CLEAR_SKILL'] == true ? "Yes" : "No"),
						"[After] Clear Quests: ".($settings['CLEAR_QUEST'] == true ? "Yes" : "No"),
					),
				));
				
				$this->lang->setArguments("UserPanel,MasterReset,Messages,Success", $charStatus[COLUMN_MRESET] + 1, $settings['COIN_AWARD'], $coinName);
				setResult(showMessage($this->lang->words['UserPanel']['MasterReset']['Messages']['Success'], 3));
			}
		}
		
		$number = create_function("\$integer", "return number_format(\$integer, 0, false, '.');");
		$span = create_function("\$string, \$bool", "return '<span style=\"color: '.(\$bool == true ? 'red' : 'green').'\">'.\$string.'</span>';");
		
		$init_stats = $this->functions->CharInitialPoints($charStatus['Class']);
		
		$stats_after = array
		(
			0 => $settings['STATS_AFTER'][0] == -1 ? $init_stats[0] : $settings['STATS_AFTER'][0],
			1 => $settings['STATS_AFTER'][0] == -1 ? $init_stats[1] : $settings['STATS_AFTER'][1],
			2 => $settings['STATS_AFTER'][0] == -1 ? $init_stats[2] : $settings['STATS_AFTER'][2],
			3 => $settings['STATS_AFTER'][0] == -1 ? $init_stats[3] : $settings['STATS_AFTER'][3],
			4 => $settings['STATS_AFTER'][0] == -1 ? $init_stats[4] : $settings['STATS_AFTER'][4],
		);
		
		$clear_after = array
		(
			0 => $settings['CLEAR_INVENT'] == true ? $this->lang->words['Words']['Yes'] : $this->lang->words['Words']['No'],
			1 => $settings['CLEAR_SKILL'] == true ? $this->lang->words['Words']['Yes'] : $this->lang->words['Words']['No'],
			2 => $settings['CLEAR_QUEST'] == true ? $this->lang->words['Words']['Yes'] : $this->lang->words['Words']['No']
		);
		
		$GLOBALS['userpanel']['master_reset']['class_is_lord'] = $this->functions->ClassIsLord($charStatus['Class']);
		$GLOBALS['userpanel']['master_reset']['require']['resets'] = $number($settings['RESETS_REQUIRE']);
		$GLOBALS['userpanel']['master_reset']['require']['level'] = $number($settings['LEVEL_RESET']);
		$GLOBALS['userpanel']['master_reset']['require']['strength'] = $number($settings['STATS_REQUIRE'][0]);
		$GLOBALS['userpanel']['master_reset']['require']['dexterity'] = $number($settings['STATS_REQUIRE'][1]);
		$GLOBALS['userpanel']['master_reset']['require']['vitality'] = $number($settings['STATS_REQUIRE'][2]);
		$GLOBALS['userpanel']['master_reset']['require']['energy'] = $number($settings['STATS_REQUIRE'][3]);
		$GLOBALS['userpanel']['master_reset']['require']['command'] = $number($settings['STATS_REQUIRE'][4]);
		$GLOBALS['userpanel']['master_reset']['require']['money'] = $number($settings['MONEY_REQUIRE']);
		
		$GLOBALS['userpanel']['master_reset']['before']['mresets'] = $number($charStatus[COLUMN_MRESET]);
		$GLOBALS['userpanel']['master_reset']['before']['resets'] = $number($charStatus[COLUMN_RESET]);
		$GLOBALS['userpanel']['master_reset']['before']['level'] = $charStatus['cLevel'];
		$GLOBALS['userpanel']['master_reset']['before']['points'] = $number($charStatus['LevelUpPoint']);
		$GLOBALS['userpanel']['master_reset']['before']['strength'] = $number($charStatus['Strength']);
		$GLOBALS['userpanel']['master_reset']['before']['dexterity'] = $number($charStatus['Dexterity']);
		$GLOBALS['userpanel']['master_reset']['before']['vitality'] = $number($charStatus['Vitality']);
		$GLOBALS['userpanel']['master_reset']['before']['energy'] = $number($charStatus['Energy']);
		$GLOBALS['userpanel']['master_reset']['before']['command'] = $number($charStatus[COLUMN_COMMAND]);
		$GLOBALS['userpanel']['master_reset']['before']['class'] = $this->functions->ClassInfo($charStatus['Class']);
		$GLOBALS['userpanel']['master_reset']['before']['money'] = $number($charStatus['Money']);
		
		$GLOBALS['userpanel']['master_reset']['after']['mresets'] = $number($charStatus[COLUMN_MRESET] + 1);
		$GLOBALS['userpanel']['master_reset']['after']['resets'] = $number($charStatus[COLUMN_RESET]  - $settings['RESETS_REMOVE']);
		$GLOBALS['userpanel']['master_reset']['after']['level'] = 1;
		$GLOBALS['userpanel']['master_reset']['after']['points'] = 0;
		$GLOBALS['userpanel']['master_reset']['after']['strength'] = $number($stats_after[0]);
		$GLOBALS['userpanel']['master_reset']['after']['dexterity'] = $number($stats_after[1]);
		$GLOBALS['userpanel']['master_reset']['after']['vitality'] = $number($stats_after[2]);
		$GLOBALS['userpanel']['master_reset']['after']['energy'] = $number($stats_after[3]);
		$GLOBALS['userpanel']['master_reset']['after']['command'] = $number($stats_after[4]);
		$GLOBALS['userpanel']['master_reset']['after']['money'] = $number($charStatus['Money'] - $settings['MONEY_REQUIRE']);
		
		$GLOBALS['userpanel']['master_reset']['after']['class'] = $settings['CLEAR_QUEST'] == true ?
			$this->functions->ClassInfo($this->functions->CharInitialClass($charStatus['Class']))
				: $this->functions->ClassInfo($charStatus['Class']);
		
		$GLOBALS['userpanel']['master_reset']['after']['clear_invent'] = $span($clear_after[0], $settings['CLEAR_INVENT']);
		$GLOBALS['userpanel']['master_reset']['after']['clear_skill'] = $span($clear_after[1], $settings['CLEAR_SKILL']);
		$GLOBALS['userpanel']['master_reset']['after']['clear_quest'] = $span($clear_after[2], $settings['CLEAR_QUEST']);
	}
	/**
	 *	Option: Transfer Resets
	 *	Transfer reset from a char to other char
	 *
	 *	@return	void
	*/
	public function TransferResets()
	{
		$char_status = $this->MuLib('Member')->LoadChar($this->character, COLUMN_RESET.",Class");
		$char_status[COLUMN_RESET] -= $this->settings['BONUS']['CREATE_CHAR']['SET_RESETS'];
		$settings = $this->settings['USERPANEL']['CHARACTER']['TRANSFER_RESETS'];
		
		if($_GET['write'] == TRUE)
		{
			$this->lang->setArguments("UserPanel,TransferResets,Messages,Error_ResetsReequire", $this->settings['CHARACTER']['TRANSFER_RESETS']['REQUIRE_RESETS']);
			CTM_Language::setArguments("Panel[Char][TReset][eRequire]", array("<strong>", $_PANELUSER['CHARACTER']['TRANSFER_RESETS']['REQUIRE_RESETS'], "</strong>"));
			CTM_Language::setArguments("Panel[Char][TReset][minSend]", array("<strong>", $_PANELUSER['CHARACTER']['TRANSFER_RESETS']['MIN_SEND'], "</strong>"));
			CTM_Language::setArguments("Panel[Char][TReset][maxSend]", array("<strong>", $_PANELUSER['CHARACTER']['TRANSFER_RESETS']['MAX_SEND'], "</strong>"));
			
			if(empty($_POST['charDestination']))
				setResult(showMessage($this->lang->words['UserPanel']['TransferResets']['Messages']['NULL_Destination'], 1));
				
			elseif(empty($_POST['numberResets']))
				setResult(showMessage($this->lang->words['UserPanel']['TransferResets']['Messages']['NULL_Number'], 1));
				
			elseif(!is_numeric($_POST['numberResets']))
				setResult(showMessage($this->lang->words['UserPanel']['TransferResets']['Messages']['Error_WordsNumber'], 2));
				
			elseif($_POST['charDestination'] == $this->character)
				setResult(showMessage($this->lang->words['UserPanel']['TransferResets']['Messages']['Error_Character'], 2));
				
			elseif(!$this->functions->CheckCharacter($_POST['charDestination']))
				setResult(showMessage($this->lang->words['Global']['Errors']['CheckCharInvalid'], 2));
				
			elseif($char_status[COLUMN_RESET] < $settings['REQUIRE_RESETS'])
				setResult(showMessage(sprintf($this->lang->words['UserPanel']['TransferResets']['Messages']['Error_ResetsRequire'], $settings['REQUIRE_RESETS']), 2));
				
			elseif($_POST['numberResets'] < $settings['MIN_SEND'])
				setResult(showMessage(sprintf($this->lang->words['UserPanel']['TransferResets']['Messages']['Error_MinSend'], $settings['MIN_SEND']), 2));
			else
			{
				$break = FALSE;
				if($settings['MAX_SEND'] > 0)
				{
					if($_POST['numberResets'] > $settings['MAX_SEND'])
					{
						$break = TRUE;
						setResult(showMessage(sprintf($this->lang->words['UserPanel']['TransferResets']['Messages']['Error_MaxSend'], $settings['MAX_SEND']), 2));
					}
				}
				
				if($char_status[COLUMN_RESET] < $_POST['numberResets'])
				{
					$break = TRUE;
					setResult(showMessage($this->lang->words['UserPanel']['TransferResets']['Messages']['Error_Resets'], 2));
				}
				
				if($break == false)
				{
					$string = "UPDATE ".MUGEN_CORE.".dbo.Character SET ".COLUMN_RESET." =  ".COLUMN_RESET." - %d";
					
					if($settings['RESET_CHAR'] == 1)
					{
						$set = $this->functions->CharInitialPoints($class);
						$string .= ", LevelUpPoint = 0, Strength = {$set[0]}, Dexterity = {$set[1]}, Vitality = {$set[2]}, Energy = {$set[3]}";
						
						if($this->functions->ClassIsLord($char_status['Class']))
							$string .= ", ".COLUMN_COMMAND." = {$set[4]}";
					}
					
					$string .= " WHERE Name = '%s' AND AccountID = '%s';\n";
					$string .= "UPDATE ".MUGEN_CORE.".dbo.Character SET ".COLUMN_RESET." = ".COLUMN_RESET." + %d";
					$string .= " WHERE Name = '%s' AND AccountID = '%s'";
					
					$this->DB->Arguments($_POST['numberResets'], $this->character, USER_ACCOUNT, $_POST['numberResets'], $_POST['charDestination'], USER_ACCOUNT);
					$this->DB->Query($string);
					
					$this->WriteLog(array
					(
						"option" => "Transfer Resets",
						"character" => true,
						"data" => array
						(
							"[General] Char Destination: ".$_POST['charDestination'],
							"[General] Number of Resets: ".number_format($_POST['numberResets'], 0, false, "."),
							"[Before] Resets: ".number_format($char_status[COLUMN_RESET], 0, false, "."),
							"[After] Resets: ".number_format($char_status[COLUMN_RESET] - $_POST['numberResets'], 0, false, ".")
						),
					));
					
					$this->lang->setArguments("UserPanel,TransferResets,Messages,Success", $_POST['numberResets'], $_POST['charDestination']);
					setResult(showMessage($this->lang->words['UserPanel']['TransferResets']['Messages']['Success'], 3));
				}
			}
		}
		
		$char_status[COLUMN_RESET] = $char_status[COLUMN_RESET] < 0 ? 0 : $char_status[COLUMN_RESET];
		$GLOBALS['userpanel']['transfer_resets']['resets_available'] = number_format($char_status[COLUMN_RESET], 0, false, ".");
		$GLOBALS['userpanel']['transfer_resets']['characters'] = array();
		
		$this->DB->Arguments(USER_ACCOUNT);
		$findCharactersQ = $this->DB->Select("Name,".COLUMN_RESET, MUGEN_CORE."@Character", "AccountID = '%s'");
		
		if($this->DB->CountRows($findCharactersQ) > 0)
		{
			while($findCharacters = $this->DB->FetchObject($findCharactersQ))
			{
				if($findCharacters->Name == $this->character)
					continue;
					
				$GLOBALS['userpanel']['transfer_resets']['characters'][$findCharacters->Name] = number_format($findCharacters->{COLUMN_RESET}, 0, false, ".");
			}
		}
	}
	/**
	 *	Option: Clear Pk
	 *	Clear the pk of character
	 *
	 *	@return void
	*/
	public function ClearPk()
	{
		if($_GET['write'] == true)
		{
			$character = $this->MuLib('Member')->LoadChar($this->character, "PkLevel,PkCount,Money,".COLUMN_PKCOUNT.",".COLUMN_HEROCOUNT);
			$error = $this->LoadClass("Error", "class_sources");
			
			if($character['Money'] < $this->settings['USERPANEL']['CHARACTER']['CLEAR_PK']['REQUIRE_MONEY'][$this->userData['vip'][VIP_COLUMN]])
				$error->addError($this->lang->words['UserPanel']['ClearPk']['Messages']['NoMoney']);
				
			if(!($character['PkLevel'] <> 3))
				$error->addError($this->lang->words['UserPanel']['ClearPk']['Messages']['NoPk']);
			
			if($error->count[0] > 0)
			{
				setResult(showMessage($this->lang->words['UserPanel']['ClearPk']['Messages']['Message']."<br /><br />".$error->showError(0), 2));
			}
			else
			{
				$column = $character['PkLevel'] != 3 && $character['PkLevel'] < 3 ? COLUMN_HEROCOUNT : COLUMN_PKCOUNT;
				$count = (integer)str_replace("-", NULL, $character['PkCount']);
				
				$updateQuery = array($column => "plus:%d", "PkCount" => 0, "PkLevel" => 3, "PkTime" => 0, "Money" => "minus:%d");
				$this->DB->Arguments($count, $this->settings['USERPANEL']['CHARACTER']['CLEAR_PK']['REQUIRE_MONEY'][$this->userData['vip'][VIP_COLUMN]]);
				$this->DB->Arguments($this->character, USER_ACCOUNT);
				
				$this->DB->ForceDataType($column, "integer");
				$this->DB->ForceDataType("PkCount", "integer");
				$this->DB->ForceDataType("PkLevel", "integer");
				$this->DB->ForceDataType("PkTime", "integer");
				$this->DB->ForceDataType("Money", "integer");
				
				$this->DB->Update(MUGEN_CORE."@Character", $updateQuery, "Name = '%s' AND AccountID = '%s'");
				
				$money = $this->settings['USERPANEL']['CHARACTER']['CLEAR_PK']['REQUIRE_MONEY'][$this->userData['vip'][VIP_COLUMN]];
				$this->WriteLog(array
				(
					"option" => "Clear Pk",
					"character" => true,
					"data" => array
					(
						"[Before] Money: ".number_format($character['Money'], 0, false, "."),
						"[Before] Status: ".($character['PkLevel'] < 3 ? "Hero" : "Pk"),
						"[Before] Pk Kills: ".number_format($character[COLUMN_PKCOUNT], 0, false, "."),
						"[Before] Hero Kills: ".number_format($character[COLUMN_HEROCOUNT], 0, false, "."),
						"[After] Money: ".number_format($character['Money'] - $money, 0, false, "."),
						"[After] Status: Normal",
						"[After] Pk Kills: ".number_format($character[COLUMN_PKCOUNT] + ($character['PkLevel'] > 3 ? $count : 0), 0, false, "."),
						"[After] Hero Kills: ".number_format($character[COLUMN_HEROCOUNT] + ($character['PkLevel'] < 3 ? $count : 0), 0, false, ".")
					),
				));
				
				setResult(showMessage($this->lang->words['UserPanel']['ClearPk']['Messages']['Success'], 3));
			}
		}
		
		$this->lang->setArguments("UserPanel,ClearPk,RequireMoney", $this->settings['USERPANEL']['CHARACTER']['CLEAR_PK']['REQUIRE_MONEY'][$this->userData['vip'][VIP_COLUMN]]);
	}
	/**
	 *	Option: Change Class
	 *	Change the class from character
	 *
	 *	@return	void
	*/
	public function ChangeClass()
	{
		$error = $this->LoadClass("Error", "class_sources");
		$character = $this->MuLib('Member')->LoadChar($this->character, "Class,cLevel");
		
		$this->MuLib('Quest')->OpenQuest($this->character);
		$this->MuLib('Quest')->GetAllQuestStatus($quests);
		$this->MuLib('Quest')->GetQuestDatabase(-1, $quest_db);
		
		if($_GET['write'] == true)
		{
			if(empty($_POST['NewClass']))
			{
				setResult(showMessage($this->lang->words['UserPanel']['ChangeClass']['Messages']['SelectClass'], 1));
			}
			else
			{
				$level = 0;
				
				$index = substr($_POST['NewClass'], 0, 1);
				$id = substr($_POST['NewClass'], 2);
				
				if($character['Class'] == $this->settings['CLASSCODE'][$id][0])
				{
					setResult(showMessage(sprintf($this->lang->words['UserPanel']['ChangeClass']['Messages']['CurrentClass'], $this->settings['CLASSCODE'][$id][1]), 2));
				}
				else
				{
					switch($index)
					{
						case 2 :
							if($this->settings['USERPANEL']['CHARACTER']['CHANGE_CLASS']['REQUIRE_QUESTS'][0] == TRUE)
							{
								if($id != "DL" && $id != "MG" && $id != "RF")
									if($quests[0]['Status'] <> 2)
										$error->addError($quests[0]['Name'], 0);
							}
							if($this->settings['USERPANEL']['CHARACTER']['CHANGE_CLASS']['REQUIRE_LEVEL'] == TRUE)
							{
								if($id != "DL" && $id != "MG" && $id != "RF")
									if($character['cLevel'] < $quest_db[0]['MinLevel'])
										$level = $quest_db[0]['MinLevel'];
							}
						break;
						case 3 :
							if($this->settings['USERPANEL']['CHARACTER']['CHANGE_CLASS']['REQUIRE_QUESTS'][1] == TRUE)
							{
								if($id != "LE" && $id != "DM" && $id != "FM")
								{
									if($quests[0]['Status'] <> 2)
										$error->addError($quests[0]['Name'], 0);
									
									if($quests[1]['Status'] <> 2)
										$error->addError($quests[1]['Name'], 0);
									
									if($quests[2]['Status'] <> 2)
										$error->addError($quests[2]['Name'], 0);
								}
								if($this->settings['USERPANEL']['CHARACTER']['CHANGE_CLASS']['THREE_REQ_QUEST'] == TRUE)
								{
									if($quests[4]['Status'] <> 2)
										$error->addError($quests[4]['Name'], 0);
										
									if($quests[5]['Status'] <> 2)
										$error->addError($quests[5]['Name'], 0);
								}
							}
							if($this->settings['USERPANEL']['CHARACTER']['CHANGE_CLASS']['REQUIRE_LEVEL'] == TRUE)
							{
								if($data['cLevel'] < $quest_db[1]['MinLevel'])
									$level = $quest_db[1]['MinLevel'];
							}
						break;
					}
				
					if($error->count[0] > 0)
					{
						$msg_error = "<strong>".$this->lang->words['UserPanel']['ChangeClass']['Messages']['RequireQuests']."</strong>";
						setResult(showMessage($msg_error."<br /><br />".$error->showError(0), 2));
					}
					elseif($level > 0)
					{
						setResult(showMessage(sprintf($this->lang->words['UserPanel']['ChangeClass']['Messages']['RequireLevel'], $level), 2));
					}
					else
					{
						$update_columns['Class'] = $this->settings['CLASSCODE'][$id][0];
					
						if($this->settings['USERPANEL']['CHARACTER']['CHANGE_CLASS']['SET_QUESTS'] == TRUE)
						{
							switch($index)
							{
								case 2 :
									if($id != "LE" && $id != "DM" && $id != "FM")
									{
										$this->MuLib('Quest')->SetQuestStatus(0, 2);
										$this->MuLib('Quest')->SetQuestStatus(1, 2);
										
										if(MUSERVER_VERSION >= 4)
										{
											$this->MuLib('Quest')->SetQuestStatus(4, 3);
											$this->MuLib('Quest')->SetQuestStatus(5, 3);
											$this->MuLib('Quest')->SetQuestStatus(6, 3);
											$this->MuLib('Quest')->SetQuestStatus(7, 3);
										}
									}
								break;
								case 3 :
									if($id != "LE" && $id != "DM" && $id != "FM")
									{
										$this->MuLib('Quest')->SetQuestStatus(0, 2);
										$this->MuLib('Quest')->SetQuestStatus(1, 2);
										//$this->MuLib('Quest')->SetQuestStatus(2, 2);
									}
									
									$this->MuLib('Quest')->SetQuestStatus(4, 2);
									$this->MuLib('Quest')->SetQuestStatus(5, 2);
									$this->MuLib('Quest')->SetQuestStatus(6, 2);
									$this->MuLib('Quest')->SetQuestStatus(7, 2);
								break;
								default :
									$this->MuLib('Quest')->SetAllQuestStatus(3); 
								break;
							}
						
							$update_columns['Quest'] = "0x".$this->MuLib('Quest')->CloseQuest(false);
						}
						
						$this->DB->ForceDataType("Class", "integer");
						$this->DB->ForceDataType("Quest", "*");
						
						$this->DB->Arguments($this->character, USER_ACCOUNT);
						$this->DB->Update(MUGEN_CORE."@Character", $update_columns, "Name = '%s' AND AccountID = '%s'");
						
						$this->MuLib('Member')->RemoveSkillTree($this->character);
						
						$this->WriteLog(array
						(
							"option" => "Change Class",
							"character" => true,
							"data" => array
							(
								"[Before] Class: ".$this->functions->ClassInfo($character['Class']),
								"[After] Class: ".$this->settings['CLASSCODE'][$id][1]
							),
						));
					
						setResult(showMessage(sprintf($this->lang->words['UserPanel']['ChangeClass']['Messages']['Success'], $this->settings['CLASSCODE'][$id][1]), 3));
					}
				}
			}
		}
		
		$class[0] = array();
		$class[1] = array();
		$clsss[2] = array();
		
		$class[0]['DW'] = $this->settings['CLASSCODE']['DW'][1];
		$class[0]['DK'] = $this->settings['CLASSCODE']['DK'][1];
		$class[0]['FE'] = $this->settings['CLASSCODE']['FE'][1];
		
		if(MUSERVER_VERSION >= 5)
			$class[0]['SU'] = $this->settings['CLASSCODE']['SU'][1];
		
		$class[1]['SM'] = $this->settings['CLASSCODE']['SM'][1];
		$class[1]['BK'] = $this->settings['CLASSCODE']['BK'][1];
		$class[1]['ME'] = $this->settings['CLASSCODE']['ME'][1];
		
		if(MUSERVER_VERSION >= 5)
			$class[1]['BS'] = $this->settings['CLASSCODE']['BS'][1];
			
		$class[1]['MG'] = $this->settings['CLASSCODE']['MG'][1];
		
		if(MUSERVER_VERSION >= 1)
			$class[1]['DL'] = $this->settings['CLASSCODE']['DL'][1];
		
		if(MUSERVER_VERSION >= 4)
		{
			$class[2]['GM'] = $this->settings['CLASSCODE']['GM'][1];
			$class[2]['BM'] = $this->settings['CLASSCODE']['BM'][1];
			$class[2]['HE'] = $this->settings['CLASSCODE']['HE'][1];
			
			if(MUSERVER_VERSION >= 5)
				$class[2]['DIM'] = $this->settings['CLASSCODE']['DIM'][1];
			
			$class[2]['DM'] = $this->settings['CLASSCODE']['DM'][1];
			$class[2]['LE'] = $this->settings['CLASSCODE']['LE'][1];
		}
		
		if(MUSERVER_VERSION == 8)
		{
			$class[1]['RF'] = $this->settings['CLASSCODE']['RF'][1];
			$class[2]['FM'] = $this->settings['CLASSCODE']['FM'][1];
		}
		
		$GLOBALS['userpanel']['change_class']['select_class'][1] = $class[0];
		$GLOBALS['userpanel']['change_class']['select_class'][2] = $class[1];
		$GLOBALS['userpanel']['change_class']['select_class'][3] = $class[2];
		$GLOBALS['userpanel']['change_class']['current_class'] = $this->functions->ClassInfo($character['Class']);
	}
	/**
	 *	Option: Change Name
	 *	Change the name from character
	 *
	 *	@return	void
	*/
	public function ChangeName()
	{
		if($_GET['write'] == true)
		{
			if(empty($_POST['NewName']))
			{
				setResult(showMessage($this->lang->words['UserPanel']['ChangeName']['Messages']['FieldVoid'], 1));
			}
			elseif(empty($_POST['Captcha']))
			{
				setResult(showMessage($this->lang->words['Global']['Captcha']['Messages']['Void'], 1));
			}	
			elseif(!CTM_Captcha::Check($_POST['Captcha']))
			{
				setResult(showMessage($this->lang->words['Global']['Captcha']['Messages']['Invalid'], 2));
			}
			elseif(strlen($_POST['NewName']) < 4)
			{
				setResult(showMessage($this->lang->words['UserPanel']['ChangeName']['Messages']['ErrorLength'], 2));
			}
			elseif(eregi("[^a-zA-Z0-9_!=?&-]", $_POST['NewName']))
			{
				setResult(showMessage($this->lang->words['UserPanel']['ChangeName']['Messages']['ErrorWords'], 2));
			}
			else
			{
				$bad_syntax = FALSE;
				
				foreach($this->settings['USERPANEL']['CHARACTER']['CHANGE_NAME']['BAD_SYNTAX'] as $badSyntax)
				{
					if(stristr($_POST['NewName'], $badSyntax))
					{
						$bad_syntax = TRUE;
						break;
					}
				}
					
				if($bad_syntax == true)
				{
					setResult(showMessage($this->lang->words['UserPanel']['ChangeName']['Messages']['ErrorSyntax'], 2));
				}
				else
				{
					$this->DB->Arguments($this->character);
					$this->DB->Query("SELECT Name FROM ".MUGEN_CORE.".dbo.GuildMember WHERE Name = '%s'", $find_guild);
						
					if($this->DB->CountRows($find_guild) > 0)
					{
						setResult(showMessage($this->lang->words['UserPanel']['ChangeName']['Messages']['ErrorGuild'], 2));
					}
					else
					{
						$change_name_result = $this->MuLib('Member')->RenameCharacter($this->character, USER_ACCOUNT, $_POST['NewName']);
						
						switch($change_name_result)
						{
							case "NAME_IN_USE" :
								setResult(showMessage($this->lang->words['UserPanel']['ChangeName']['Messages']['ErrorName'], 2));
							break;
							case "ALL_OK" :
								$temp_name = $this->character;
								$this->character = $_POST['NewName'];
								
								$_SESSION['USERCP_CHARACTER_SELECTED'] = $_POST['NewName'];
								$GLOBALS['userpanel']['character'] = $_POST['NewName'];
								
								CTM_Captcha::gerateCaptchaText();
								$this->WriteLog(array
								(
									"option" => "Change Name",
									"character" => true,
									"data" => array
									(
										"[Before] Name: ".$temp_name,
										"[After] Name: ".$this->character
									),
								));
							
								$string = showMessage(sprintf($this->lang->words['UserPanel']['ChangeName']['Messages']['Success'], $_POST['NewName']), 3);
								
								if(loadIsAjax() == true)
								{
									$string .= "\n<script>$('#cpCharSelected').val('".$_POST['NewName']."');\n";
									$string .= "$('#currentCharName').val('".$_POST['NewName']."');</script>";
								}
								
								setResult($string);
							break;
							case "ID_ERROR" :
								$this->WriteLog(array
								(
									"option" => "Change Name",
									"character" => true,
									"data" => array
									(
										"Error #".CoreVariables::ErrorsCode()->CharGameIDFail
									),
								));
								
								setResult(showMessage(sprintf($this->lang->words['UserPanel']['ChangeName']['Messages']['GeneralError'], CoreVariables::ErrorsCode()->CharGameIDFail), 2));
							break;
						}
					}
				}
			}
		}
	}
	/**
	 *	Option: Move Character
	 *	Move the character of map
	 *
	 *	@return	void
	*/
	public function MoveCharacter()
	{
		if($_GET['write'] == true)
		{
			if(is_null($_POST['MapNumber']) || !array_key_exists($_POST['MapNumber'], $this->settings['MAPDATA']))
			{
				setResult(showMessage($this->lang->words['UserPanel']['MoveCharacter']['Messages']['Invalid'], 2));
			}
			else
			{
				$current_warp = $this->MuLib('Member')->LoadChar($this->character, "MapNumber,MapPosX,MapPosY");
				
				$columns_update = array
				(
					"MapNumber" => $_POST['MapNumber'],
					"MapPosX" => $this->settings['MAPDATA'][$_POST['MapNumber']][0],
					"MapPosY" => $this->settings['MAPDATA'][$_POST['MapNumber']][1]
				);
				
				$this->DB->Arguments($this->character, USER_ACCOUNT);
				$this->DB->Update(MUGEN_CORE."@Character", $columns_update, "Name = '%s' AND AccountID = '%s'");
				
				$this->WriteLog(array
				(
					"option" => "Move Character",
					"character" => true,
					"data" => array
					(
						"[Before] Map Name: ".$this->settings['MAPDATA'][$current_warp['MapNumber']][2],
						"[Before] Map PosX: ".$current_warp['MapPosX'],
						"[Before] Map PosY: ".$current_warp['MapPosY'],
						"[After] Map Name: ".$this->settings['MAPDATA'][$_POST['MapNumber']][2],
						"[After] Map PosX: ".$this->settings['MAPDATA'][$_POST['MapNumber']][0],
						"[After] Map PosY: ".$this->settings['MAPDATA'][$_POST['MapNumber']][1]
					),
				));
				
				$map_name = $this->settings['MAPDATA'][$_POST['MapNumber']][2];
				setResult(showMessage(sprintf($this->lang->words['UserPanel']['MoveCharacter']['Messages']['Success'], $map_name), 3));
			}
		}
	}
	/**
	 *	Option: Manage Profile
	 *	Set the permissions of visualization from char profile
	 *
	 *	@return	void
	*/
	public function ManageProfile()
	{
		if($_GET['write'] == true)
		{
			$this->DB->Arguments($this->character);
			$this->DB->Query("SELECT * FROM dbo.CTM_CharProfile WHERE Name = '%s'", $find_profile);
			
			if($this->DB->CountRows($find_profile) > 0)
			{
				$fetch_profile = $this->DB->FetchArray($profile_dataQ);
				
				$current_data['show_profile'] = $fetch_profile['ShowProfile'] == 1;
				$current_data['show_skills'] = $fetch_profile['ShowSkills'] == 1;
				$current_data['show_resets'] = $fetch_profile['ShowResets'] == 1;
				$current_data['show_map'] = $fetch_profile['ShowMap'] == 1;
				$current_data['show_status'] = $fetch_profile['ShowStatus'] == 1;
			}
			else
			{
				$current_data['show_profile'] = TRUE;
				$current_data['show_skills'] = TRUE;
				$current_data['show_resets'] = TRUE;
				$current_data['show_map'] = TRUE;
				$current_data['show_status'] = TRUE;
			}
		
			$profile_data = array
			(
				"ShowProfile" => 0,
				"ShowSkills" => 0,
				"ShowResets" => 0,
				"ShowMap" => 0,
				"ShowStatus" => 0
			);
			
			if($_POST['ShowProfile'] == 1) $profile_data['ShowProfile'] = 1;
			if($_POST['ShowSkills'] == 1) $profile_data['ShowSkills'] = 1;
			if($_POST['ShowResets'] == 1) $profile_data['ShowResets'] = 1;
			if($_POST['ShowMap'] == 1) $profile_data['ShowMap'] = 1;
			if($_POST['ShowStatus'] == 1) $profile_data['ShowStatus'] = 1;
			
			$this->DB->Arguments($this->character);
			$this->DB->Query("SELECT 1 FROM dbo.CTM_CharProfile WHERE Name = '%s'", $data_exists);
			
			if($this->DB->CountRows($data_exists) > 0)
			{
				$this->DB->Arguments($this->character);
				$this->DB->Update("CTM_CharProfile", $profile_data, "Name = '%s'");
			}
			else
			{
				$this->DB->Arguments($this->character);
				$this->DB->Insert("CTM_CharProfile", array_merge($profile_data, array("Name" => "%s")));
			}
			
			$this->WriteLog(array
			(
				"option" => "Manage Profile",
				"character" => true,
				"data" => array
				(
					"[Before] Show Profile: ".$current_data['show_profile'] == 1 ? "Yes" : "No",
					"[Before] Show Skills: ".$current_data['show_skills'] == 1 ? "Yes" : "No",
					"[Before] Show Resets: ".$current_data['show_resets'] == 1 ? "Yes" : "No",
					"[Before] Show Map: ".$current_data['show_map'] == 1 ? "Yes" : "No",
					"[Before] Show Status: ".$current_data['show_status'] == 1 ? "Yes" : "No",
					"[After] Show Profile: ".$profile_data['ShowProfile'] == 1 ? "Yes" : "No",
					"[After] Show Skills: ".$profile_data['ShowSkills'] == 1 ? "Yes" : "No",
					"[After] Show Resets: ".$profile_data['ShowResets'] == 1 ? "Yes" : "No",
					"[After] Show Map: ".$profile_data['ShowMap'] == 1 ? "Yes" : "No",
					"[After] Show Status: ".$profile_data['ShowStatus'] == 1 ? "Yes" : "No",
				),
			));
			
			setResult(showMessage($this->lang->words['UserPanel']['ManageProfile']['Messages']['Success'], 3)); 
		}
		
		$this->DB->Arguments($this->character);
		$this->DB->Query("SELECT * FROM dbo.CTM_CharProfile WHERE Name = '%s'", $find_profile);
		
		if($this->DB->CountRows($find_profile) > 0)
		{
			$fetch_profile = $this->DB->FetchArray($profile_dataQ);
			
			$profile_data['show_profile'] = $fetch_profile['ShowProfile'] == 1;
			$profile_data['show_skills'] = $fetch_profile['ShowSkills'] == 1;
			$profile_data['show_resets'] = $fetch_profile['ShowResets'] == 1;
			$profile_data['show_map'] = $fetch_profile['ShowMap'] == 1;
			$profile_data['show_status'] = $fetch_profile['ShowStatus'] == 1;
		}
		else
		{
			$profile_data['show_profile'] = TRUE;
			$profile_data['show_skills'] = TRUE;
			$profile_data['show_resets'] = TRUE;
			$profile_data['show_map'] = TRUE;
			$profile_data['show_status'] = TRUE;
		}
		
		$GLOBALS['userpanel']['manage_profile']['profile_data'] = $profile_data;
	}
	/**
	 *	Option: Change Avatar [Not finished]
	 *	Upload or remove the avatar
	 *
	 *	@return	void
	*/
	public function ChangeAvatar()
	{
		if($_GET['write'] == true)
		{
			switch($_POST['c_command'])
			{
				case "upload" :
					switch($_POST['u_command'])
					{
						case "begin" :
							if(empty($_POST['u_imageChanged']))
							{
								setResult(showMessage($this->lang->words['UserPanel']['ChangeAvatar']['Messages']['NoImage'], 1));
							}
							else
							{
								$name = str_replace("-", NULL, crc32(sha1(time().rand()).gerateRandText().md5($this->character)));
								$size = $this->settings['WEBDATA']['UPLOADS']['FILESIZE']['CHARIMAGE'];
								$dir = CTM_ROOT_PATH.$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['CHARIMAGE'];

								if(file_exists($dir.$name))
								{
									while(file_exists($dir.$name))
									{
										$name = str_replace("-", NULL, crc32(sha1(time().rand()).gerateRandText().md5($this->character)));
									}
								}

								Uploadify::set("Filedata", $size, array("gif", "jpg", "jpeg", "png"), $name, $dir, $session);
								exit("<script>startUpload('".$name."', '".$session."');</script>");
							}
						break;
						case "finish" :
							if(empty($_POST['u_imageUploaded']))
							{
								exit(showMessage($this->lang->words['UserPanel']['ChangeAvatar']['Messages']['NoImage'], 1));
							}
							else
							{
								$image = unserialize(base64_decode($_POST['u_imageUploaded']));

								if(!$image)
								{
									exit(showMessage($this->lang->words['UserPanel']['ChangeAvatar']['Messages']['ImageError'], 2));
								}
								elseif($image['error_no'] == 2)
								{
									$this->lang->setArguments("UserPanel,ChangeAvatar,Messages,ErrorFormat", "<b>JPEG</b>, <b>GIF</b>, <b>PNG</b>");
									exit(showMessage($this->lang->words['UserPanel']['ChangeAvatar']['Messages']['ErrorFormat'], 2));
								}
								elseif($image['error_no'] == 3)
								{
									$this->lang->setArguments("UserPanel,ChangeAvatar,Messages,ErrorSize", "<b>".$data['max_file_size']."</b>");
									exit(showMessage($this->lang->words['UserPanel']['ChangeAvatar']['Messages']['ErrorSize'], 2));
								}
								elseif($image['error_no'] != 0)
								{
									exit(showMessage($this->lang->words['UserPanel']['ChangeAvatar']['Messages']['ImageError'], 2));
								}
								else
								{
									$this->DB->Arguments(str_replace(CTM_ROOT_PATH, NULL, $image['parsed_file_name']), $this->character, USER_ACCOUNT);
									$this->DB->Query("UPDATE ".MUGEN_CORE.".dbo.Character SET ".COLUMN_CHARIMAGE." = '%s' WHERE Name = '%s' AND AccountID = '%s'");
									
									$this->WriteLog(array
									(
										"option" => "Change Avatar",
										"character" => true,
										"data" => array
										(
											"Command: Change Avatar",
											"File name: ".$image[0].".".$image[1]
										),
									));
									
									exit(showMessage($this->lang->words['UserPanel']['ChangeAvatar']['Messages']['Success'], 3));
								}
							}
						break;
					}
				break;
				case "no_image" :
					$find_image = $this->MuLib('Member')->LoadChar($this->character, COLUMN_CHARIMAGE);
					
					if(strlen($find_image[COLUMN_CHARIMAGE]) > 1)
					{
						$this->DB->Arguments($this->character, USER_ACCOUNT);
						$this->DB->ForceDataType(COLUMN_CHARIMAGE, "null");
						$this->DB->Update(MUGEN_CORE."@Character", array(COLUMN_CHARIMAGE => NULL), "Name = '%s' AND AccountID = '%s'");
						
						unlink(CTM_ROOT_PATH.$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['CHARIMAGE'].$find_image[COLUMN_CHARIMAGE]);
					}
					
					$this->WriteLog(array
					(
						"option" => "Change Avatar",
						"character" => true,
						"data" => array
						(
							"Command: Remove Avatar",
							"File name: ".(strlen($find_image[COLUMN_CHARIMAGE]) > 1 ? $find_image[COLUMN_CHARIMAGE] : "Not Found")
						),
					));
					
					exit(showMessage($this->lang->words['UserPanel']['ChangeAvatar']['Messages']['Success'], 3));
				break;
				default :
					exit(showMessage($this->lang->words['UserPanel']['ChangeAvatar']['Messages']['SetCommand'], 1));
				break;
			}
		}
		
		$find_image = $this->MuLib('Member')->LoadChar($this->character, COLUMN_CHARIMAGE);
		$GLOBALS['userpanel']['change_avatar']['with_avatar'] = strlen($find_image[COLUMN_CHARIMAGE]) > 1;
		$GLOBALS['userpanel']['change_avatar']['c_command'] = strlen($find_image[COLUMN_CHARIMAGE]) > 1 ? "upload" : "no_image";
	}
	/**
	 *	Option: Repair Points
	 *	Check and repair the stats from character
	 *
	 *	@return	void
	*/
	public function RepairPoints()
	{
		if($_GET['write'] == true)
		{
			$char_data = $this->MuLib('Member')->LoadChar($this->character, "Class,Strength,Dexterity,Vitality,Energy,".COLUMN_COMMAND);
			$default = $this->functions->CharInitialPoints($char_data['Class']);
			$check = 0;
			
			$strength = $char_data['Strength'];
			$dexterity = $char_data['Dexterity'];
			$vitality = $char_data['Vitality'];
			$energy = $char_data['Energy'];
			$command = $char_data[COLUMN_COMMAND];
			
			if($strength < $default[0])
			{
				$strength = $default[0];
				$check++;
			}
			if($dexterity < $default[1]) 
			{
				$dexterity = $default[1];
				$check++;
			}
			if($vitality < $default[2])
			{
				$vitality = $default[2];
				$check++;
			}
			if($energy < $default[3])
			{
				$energy = $default[3];
				$check++;
			}
			if($this->functions->ClassIsLord($char_data['Class']) && $command < $default[4])
			{
				$command = $default[4];
				$check++;
			}
			
			if($check == 0)
			{
				if($strength > MAX_STRENGTH)
				{
					$strength = MAX_STRENGTH;
					$check++;
				}
				if($dexterity > MAX_DEXTERITY)
				{
					$dexterity = MAX_DEXTERITY;
					$check++;
				}
				if($vitality > MAX_VITALITY)
				{
					$vitality = MAX_VITALITY;
					$check++;
				}
				if($energy > MAX_ENERGY)
				{
					$energy = MAX_ENERGY;
					$check++;
				}
				if($this->functions->ClassIsLord($char_data['Class']) && $command > MAX_COMMAND)
				{
					$command = MAX_COMMAND;
					$check++;
				}
			}
			
			if($check == 0)
			{
				setResult(showMessage($this->lang->words['UserPanel']['RepairPoints']['Messages']['All_Ok'], 0));
			}
			else
			{
				$columns_update = array
				(
					"Strength" => intval($strength),
					"Dexterity" => intval($dexterity),
					"Vitality" => intval($vitality),
					"Energy" => intval($energy)
				);
				
				if($this->functions->ClassIsLord($char_data['Class']))
					$columns_update[COLUMN_COMMAND] = intval($command);
				
				$this->DB->Arguments($this->character, USER_ACCOUNT);
				$this->DB->Update(MUGEN_CORE."@Character", $columns_update, "Name = '%s' AND AccountID = '%s'");
				
				$this->WriteLog(array
				(
					"option" => "Repair Points",
					"character" => true,
					"data" => array
					(
						"[Before] Strength: ".number_format($char_data['Strength'], 0, false, "."),
						"[Before] Dexterity: ".number_format($char_data['Dexterity'], 0, false, "."),
						"[Before] Vitality: ".number_format($char_data['Vitality'], 0, false, "."),
						"[Before] Energy: ".number_format($char_data['Energy'], 0, false, "."),
						"[Before] Command: ".number_format($this->functions->ClassIsLord($char_data['Class']) ? $char_data[COLUMN_COMMAND] : 0, 0, false, "."),
						"[After] Strength: ".number_format($strength, 0, false, "."),
						"[After] Dexterity: ".number_format($dexterity, 0, false, "."),
						"[After] Vitality: ".number_format($vitality, 0, false, "."),
						"[After] Energy: ".number_format($energy, 0, false, "."),
						"[After] Command: ".number_format($this->functions->ClassIsLord($char_data['Class']) ? $command : 0, 0, false, ".")
					),
				));
				
				setResult(showMessage($this->lang->words['UserPanel']['RepairPoints']['Messages']['Success'], 3));
			}
		}
	}
	/**
	 *	Option: Redistribute Points
	 *	Reset the stats for default and plus in Level Up Points
	 *
	 *	@return	void
	*/
	public function RedistributePoints()
	{
		$char_data = $this->MuLib('Member')->LoadChar($this->character, "Class,LevelUpPoint,Strength,Dexterity,Vitality,Energy,".COLUMN_COMMAND);
		$default = $this->functions->CharInitialPoints($char_data['Class']);
		
		$points = $char_data['LevelUpPoint'];
		$strength = $char_data['Strength'];
		$dexterity = $char_data['Dexterity'];
		$vitality = $char_data['Vitality'];
		$energy = $char_data['Energy'];
		$command = $char_data[COLUMN_COMMAND];
		
		$strength -= $default[0];
		$dexterity -= $default[1];
		$vitality -= $default[2];
		$energy -= $default[3];
		$command -= $default[4];
		
		$points += $strength;
		$points += $dexterity;
		$points += $vitality;
		$points += $energy;
		$points += $command;
		
		if(!$this->functions->ClassIsLord($char_data['Class']))
			$points -= $command;
		
		if($_GET['write'] == true)
		{
			$check = 0;
			
			if($char_data['Strength'] < $this->settings['USERPANEL']['CHARACTER']['REDISTRIBUTE_POINTS']['MIN_REQUIRE']) $check++;
			if($char_data['Dexterity'] < $this->settings['USERPANEL']['CHARACTER']['REDISTRIBUTE_POINTS']['MIN_REQUIRE']) $check++;
			if($char_data['Vitality'] < $this->settings['USERPANEL']['CHARACTER']['REDISTRIBUTE_POINTS']['MIN_REQUIRE']) $check++;
			if($char_data['Energy'] < $this->settings['USERPANEL']['CHARACTER']['REDISTRIBUTE_POINTS']['MIN_REQUIRE']) $check++;
			
			if($this->functions->ClassIsLord($char_data['Class']))
				if($char_data[COLUMN_COMMAND] < $this->settings['USERPANEL']['CHARACTER']['REDISTRIBUTE_POINTS']['MIN_REQUIRE']) $check++;
				
			if($check > 0)
			{
				$_points =  number_format($this->settings['USERPANEL']['CHARACTER']['REDISTRIBUTE_POINTS']['MIN_REQUIRE'], 0, false, ".");
				setResult(showMessage(sprintf($this->lang->words['UserPanel']['RedistributePoints']['Messages']['MinRequire'], $_points), 2));
			}
			else
			{
				$columns_update = array
				(
					"LevelUpPoint" => $points,
					"Strength" => $default[0],
					"Dexterity" => $default[1],
					"Vitality" => $default[2],
					"Energy" => $default[3]
				);
				
				if($this->functions->ClassIsLord($char_data['Class']))
					$columns_update[COLUMN_COMMAND] = $default[4];
					
				$this->DB->Arguments($this->character, USER_ACCOUNT);
				$this->DB->Update(MUGEN_CORE."@Character", $columns_update, "Name = '%s' AND AccountID = '%s'");
				
				$this->WriteLog(array
				(
					"option" => "Redistribute Points",
					"character" => true,
					"data" => array
					(
						"[Before] Points: ".number_format($char_data['LevelUpPoint'], 0, false, "."),
						"[Before] Strength: ".number_format($char_data['Strength'], 0, false, "."),
						"[Before] Dexterity: ".number_format($char_data['Dexterity'], 0, false, "."),
						"[Before] Vitality: ".number_format($char_data['Vitality'], 0, false, "."),
						"[Before] Energy: ".number_format($char_data['Energy'], 0, false, "."),
						"[Before] Command: ".number_format($this->functions->ClassIsLord($char_data['Class']) ? $char_data[COLUMN_COMMAND] : 0, 0, false, "."),
						"[After] Points: ".number_format($points, 0, false, "."),
						"[After] Strength: ".number_format($default[0], 0, false, "."),
						"[After] Dexterity: ".number_format($default[1], 0, false, "."),
						"[After] Vitality: ".number_format($default[2], 0, false, "."),
						"[After] Energy: ".number_format($default[3], 0, false, "."),
						"[After] Command: ".number_format($this->functions->ClassIsLord($char_data['Class']) ? $default[4] : 0, 0, false, ".")
					),
				));
			
				setResult(showMessage(sprintf($this->lang->words['UserPanel']['RedistributePoints']['Messages']['Success'], $points), 3));
			}
		}
		
		$GLOBALS['userpanel']['redistribute_points']['before_points']['points'] = number_format($char_data['LevelUpPoint'], 0, false, ".");
		$GLOBALS['userpanel']['redistribute_points']['before_points']['strength'] = number_format($char_data['Strength'], 0, false, ".");
		$GLOBALS['userpanel']['redistribute_points']['before_points']['dexterity'] = number_format($char_data['Dexterity'], 0, false, ".");
		$GLOBALS['userpanel']['redistribute_points']['before_points']['vitality'] = number_format($char_data['Vitality'], 0, false, ".");
		$GLOBALS['userpanel']['redistribute_points']['before_points']['energy'] = number_format($char_data['Energy'], 0, false, ".");
		$GLOBALS['userpanel']['redistribute_points']['before_points']['command'] = number_format($char_data[COLUMN_COMMAND], 0, false, ".");
		
		$GLOBALS['userpanel']['redistribute_points']['after_points']['points'] = number_format($points, 0, false, ".");
		$GLOBALS['userpanel']['redistribute_points']['after_points']['strength'] = number_format($default[0], 0, false, ".");
		$GLOBALS['userpanel']['redistribute_points']['after_points']['dexterity'] = number_format($default[1], 0, false, ".");
		$GLOBALS['userpanel']['redistribute_points']['after_points']['vitality'] = number_format($default[2], 0, false, ".");
		$GLOBALS['userpanel']['redistribute_points']['after_points']['energy'] = number_format($default[3], 0, false, ".");
		$GLOBALS['userpanel']['redistribute_points']['after_points']['command'] = number_format($default[4], 0, false, ".");
		
		$GLOBALS['userpanel']['redistribute_points']['class_is_lord'] = $this->functions->ClassIsLord($char_data['Class']);
	}
	/**
	 *	Option: Distribute Points
	 *	Distribute the points from character
	 *
	 *	@return	void
	*/
	public function DistributePoints()
	{
		$error = $this->LoadClass("Error", "class_sources");
		$char_data = $this->MuLib('Member')->LoadChar($this->character, "Class,LevelUpPoint,Strength,Dexterity,Vitality,Energy,".COLUMN_COMMAND);
		
		if($_GET['write'] == true)
		{
			if(!$this->functions->ClassIsLord($char_data['Class']))
				$_POST['Command'] = 0;
			
			if(empty($_POST['Strength'])) $_POST['Strength'] = 0;
			if(empty($_POST['Dexterity'])) $_POST['Dexterity'] = 0;
			if(empty($_POST['Vitality'])) $_POST['Vitality'] = 0;
			if(empty($_POST['Energy'])) $_POST['Energy'] = 0;
			if(empty($_POST['Command'])) $_POST['Command'] = 0;
			
			$_POST['Strength'] = eregi_replace("[^0-9]", NULL, $_POST['Strength']);
			$_POST['Dexterity'] = eregi_replace("[^0-9]", NULL, $_POST['Dexterity']);
			$_POST['Vitality'] = eregi_replace("[^0-9]", NULL, $_POST['Vitality']);
			$_POST['Energy'] = eregi_replace("[^0-9]", NULL, $_POST['Energy']);
			$_POST['Command'] = eregi_replace("[^0-9]", NULL, $_POST['Command']);
			
			$points_total = $_POST['Strength'];
			$points_total += $_POST['Dexterity'];
			$points_total += $_POST['Vitality'];
			$points_total += $_POST['Energy'];
			$points_total += $_POST['Command'];
			
			if($char_data['LevelUpPoint'] < $points_total)
				$error->addError($this->lang->words['UserPanel']['DistributePoints']['Messages']['NoPoints']);
				
			if(($char_data['Strength'] + $_POST['Strength']) > MAX_STRENGTH)
				$error->addError($this->lang->words['UserPanel']['DistributePoints']['Messages']['LimitStrength']);
				
			if(($char_data['Dexterity'] + $_POST['Dexterity']) > MAX_DEXTERITY)
				$error->addError($this->lang->words['UserPanel']['DistributePoints']['Messages']['LimitDexterity']);
				
			if(($char_data['Vitality'] + $_POST['Vitality']) > MAX_VITALITY)
				$error->addError($this->lang->words['UserPanel']['DistributePoints']['Messages']['LimitVitality']);
				
			if(($char_data['Energy'] + $_POST['Energy']) > MAX_ENERGY)
				$error->addError($this->lang->words['UserPanel']['DistributePoints']['Messages']['LimitEnergy']);
				
			if(($char_data[COLUMN_COMMAND] + $_POST['Command']) > MAX_COMMAND && $this->functions->ClassIsLord($char_data['Class']))
				$error->addError($this->lang->words['UserPanel']['DistributePoints']['Messages']['LimitCommand']);
				
			if($error->count[0] > 0)
			{
				setResult(showMessage($this->lang->words['UserPanel']['DistributePoints']['Messages']['Error_Message']."<br /><br />".$error->showError(0), 2));
			}
			else
			{
				$columns_update = array
				(
					"LevelUpPoint" => "minus:".$points_total,
					"Strength" => "plus:".$_POST['Strength'],
					"Dexterity" => "plus:".$_POST['Dexterity'],
					"Vitality" => "plus:".$_POST['Vitality'],
					"Energy" => "plus:".$_POST['Energy']
				);
				
				if($this->functions->ClassIsLord($char_data['Class']))
					$columns_update[COLUMN_COMMAND] = "plus:".$_POST['Command'];
					
				$this->DB->ForceDataType("LevelUpPoint", "integer");
				$this->DB->ForceDataType("Strength", "integer");
				$this->DB->ForceDataType("Dexterity", "integer");
				$this->DB->ForceDataType("Vitality", "integer");
				$this->DB->ForceDataType("Energy", "integer");
				$this->DB->ForceDataType(COLUMN_COMMAND, "integer");
				
				$this->DB->Arguments($this->character, USER_ACCOUNT);
				$this->DB->Update(MUGEN_CORE."@Character", $columns_update, "Name = '%s' AND AccountID = '%s'");
				
				$vsprintf = array();
				$vsprintf[] = number_format($char_data['Strength'] + $_POST['Strength'], 0, false, ".");
				$vsprintf[] = number_format($char_data['Dexterity'] + $_POST['Dexterity'], 0, false, ".");
				$vsprintf[] = number_format($char_data['Vitality'] + $_POST['Vitality'], 0, false, ".");
				$vsprintf[] = number_format($char_data['Energy'] + $_POST['Energy'], 0, false, ".");
				
				$message = $this->lang->words['UserPanel']['DistributePoints']['Messages']['Success'];
				$lord_command = $char_data[COLUMN_COMMAND] + $_POST['Command'];
				
				if(!$this->functions->ClassIsLord($char_data['Class']))
				{
					$message = preg_replace("/#CLASS_LORD#(.*?)#\/CLASS_LORD#/is", NULL, $message);
				}
				else
				{
					$message = str_replace(array("#CLASS_LORD#", "#/CLASS_LORD#"), NULL, $message);
					$vsprintf[] = number_format($char_data[COLUMN_COMMAND] + $_POST['Command'], 0, false, ".");
				}
				
				$vsprintf[] = number_format($char_data['LevelUpPoint'] - $points_total, 0, false, ".");
				
				$this->WriteLog(array
				(
					"option" => "Distribute Points",
					"character" => true,
					"data" => array
					(
						"[Before] Points: ".number_format($char_data['LevelUpPoint'], 0, false, "."),
						"[Before] Strength: ".number_format($char_data['Strength'], 0, false, "."),
						"[Before] Dexterity: ".number_format($char_data['Dexterity'], 0, false, "."),
						"[Before] Vitality: ".number_format($char_data['Vitality'], 0, false, "."),
						"[Before] Energy: ".number_format($char_data['Energy'], 0, false, "."),
						"[Before] Command: ".number_format($this->functions->ClassIsLord($char_data['Class']) ? $char_data[COLUMN_COMMAND] : 0, 0, false, "."),
						"[After] Points: ".number_format($char_data['LevelUpPoint'] - $points_total, 0, false, "."),
						"[After] Strength: ".number_format($char_data['Strength'] + $_POST['Strength'], 0, false, "."),
						"[After] Dexterity: ".number_format($char_data['Dexterity'] + $_POST['Dexterity'], 0, false, "."),
						"[After] Vitality: ".number_format($char_data['Vitality'] + $_POST['Vitality'], 0, false, "."),
						"[After] Energy: ".number_format($char_data['Energy'] + $_POST['Energy'], 0, false, "."),
						"[After] Command: ".number_format($this->functions->ClassIsLord($char_data['Class']) ? $lord_command : 0, 0, false, ".")
					),
				));
					
				setResult(showMessage(vsprintf($message, $vsprintf), 3));
			}
		}
		
		$GLOBALS['userpanel']['distribute_points']['before_points']['points'] = number_format($char_data['LevelUpPoint'], 0, false, ".");
		$GLOBALS['userpanel']['distribute_points']['before_points']['strength'] = number_format($char_data['Strength'], 0, false, ".");
		$GLOBALS['userpanel']['distribute_points']['before_points']['dexterity'] = number_format($char_data['Dexterity'], 0, false, ".");
		$GLOBALS['userpanel']['distribute_points']['before_points']['vitality'] = number_format($char_data['Vitality'], 0, false, ".");
		$GLOBALS['userpanel']['distribute_points']['before_points']['energy'] = number_format($char_data['Energy'], 0, false, ".");
		$GLOBALS['userpanel']['distribute_points']['before_points']['command'] = number_format($char_data[COLUMN_COMMAND], 0, false, ".");
		$GLOBALS['userpanel']['distribute_points']['class_is_lord'] = $this->functions->ClassIsLord($char_data['Class']);
	}
	/**
	 *	Option: Clear Character
	 *	Clear inventory, skills, quests and money from character
	 *
	 *	@return	void
	*/
	public function ClearCharacter()
	{
		if($_GET['write'] == true)
		{
			$char_data = $this->MuLib('Member')->LoadChar($this->character, "Class");
			$count = 0;
			
			if($_POST['ClearInventory'] == 1) $count++;
			if($_POST['ClearSkill'] == 1) $count++;
			if($_POST['ClearQuest'] == 1) $count++;
			if($_POST['ClearMoney'] == 1) $count++;
			
			if($count == 0)
			{
				setResult(showMenssage($this->lang->words['UserPanel']['ClearCharacter']['Messages']['Error'], 1));
			}
			else
			{
				$update_columns = array();
				
				if($_POST['ClearInventory'] == 1)$update_columns['Inventory'] = "0x".str_repeat("FF", CTM_INVENTORY_SIZE);
				if($_POST['ClearSkill'] == 1) $update_columns['MagicList'] = "0x".str_repeat("FF0000", CTM_SKILL_SIZE / 6);
				if($_POST['ClearQuest'] == 1) $update_columns['Quest'] = "0x".str_repeat("FF", 50);
				if($_POST['ClearQuest'] == 1) $update_columns['Class'] = $this->functions->CharInitialClass($char_data['Class']);
				if($_POST['ClearMoney'] == 1) $update_columns['Money'] = 0;
				
				$this->DB->ForceDataType("Inventory", "*");
				$this->DB->ForceDataType("MagicList", "*");
				$this->DB->ForceDataType("Quest", "*");
				$this->DB->ForceDataType("Money", "integer");
				
				$this->DB->Arguments($this->character, USER_ACCOUNT);
				$this->DB->Update(MUGEN_CORE."@Character", $update_columns, "Name = '%s' AND AccountID = '%s'");
				
				$message = "<strong>".$this->lang->words['UserPanel']['ClearCharacter']['Messages']['Success'][0]."</strong><br /><br />";
				
				if($_POST['ClearInventory'] == 1) $message .= "&raquo; ".$this->lang->words['UserPanel']['ClearCharacter']['Messages']['Success'][1]."<br />";
				if($_POST['ClearSkill'] == 1) $message .= "&raquo; ".$this->lang->words['UserPanel']['ClearCharacter']['Messages']['Success'][2]."<br />";
				if($_POST['ClearQuest'] == 1) $message .= "&raquo; ".$this->lang->words['UserPanel']['ClearCharacter']['Messages']['Success'][3]."<br />";
				if($_POST['ClearMoney'] == 1) $message .= "&raquo; ".$this->lang->words['UserPanel']['ClearCharacter']['Messages']['Success'][4]."<br />";
				
				$this->WriteLog(array
				(
					"option" => "Clear Character",
					"character" => true,
					"data" => array
					(
						"Clear Inventory: ".($_POST['ClearInventory'] == 1 ? "Yes" : "No"),
						"Clear Skill: ".($_POST['ClearSkill'] == 1 ? "Yes" : "No"),
						"Clear Quest: ".($_POST['ClearQuest'] == 1 ? "Yes" : "No"),
						"Clear Money: ".($_POST['ClearMoney'] == 1 ? "Yes" : "No"),
						"Before Class: ".$this->functions->ClassInfo($char_data['Class']),
						"After Class: ".$this->functions->ClassInfo($this->functions->CharInitialClass($char_data['Class']))
					),
				));
				
				setResult(showMessage($message, 3));
			}
		}
	}
}