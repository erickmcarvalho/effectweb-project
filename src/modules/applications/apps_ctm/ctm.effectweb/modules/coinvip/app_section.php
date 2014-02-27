<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Application VIP/Coin Page
 * Last Update: 16/08/2012 - 17:09h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_CoinVIP extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->lang->loadLanguageFile("coinvip");
		$auto_load = $_GET['do'] ? $_GET['do'] : $this->URLData[1];
		
		if($auto_load == "advantages" || $auto_load == "howtobuy" || $auto_load == "bankdata")
			$GLOBALS['coinvip']['auto_load_page'] = $auto_load;
			
		switch($_GET['load'])
		{
			case "advantages" :
				$this->loadVIP_Advantages();
				$this->output->loadSkinCache("coinvip", "vip_advantages");
				$this->output->noSetCache(true);
			break;
			case "howtobuy" :
				$this->output->loadSkinCache("coinvip", "howtobuy");
				$this->output->noSetCache(true);
			break;
			case "bankdata" :
				$this->output->loadSkinCache("coinvip", "bankdata");
				$this->output->noSetCache(true);
			break;
			default :
				$this->output->loadSkinCache("coinvip", "coinvip");
			break;
		}
	}
	/**
	 *	Page: VIP Advantages
	 *	Advantages from VIP plans
	 *
	 *	@return	void
	*/
	private function loadVIP_Advantages()
	{
		require_once(THIS_APPLICATION_PATH."sources/variables/userpanel_options.php");
		$permission = $this->settings['USERPANEL']['PERMISSION'];
		
		foreach($userpanel_options as $key => $value)
		{
			foreach($value as $k => $v)
			{
				if($v['privilegy'] == true)
				{
					$GLOBALS['coinvip']['vip_advantages']['advantages'][$k][0] = $permission[$key][$k][1] == true ? "tick" : "cross";
					$GLOBALS['coinvip']['vip_advantages']['advantages'][$k][1] = $permission[$key][$k][2] == true ? "tick" : "cross";
					
					if(VIP_NUMBER >= 2)
					{
						$GLOBALS['coinvip']['vip_advantages']['advantages'][$k][2] = $permission[$key][$k][3] == true ? "tick" : "cross";
						
						if(VIP_NUMBER >= 3)
						{
							$GLOBALS['coinvip']['vip_advantages']['advantages'][$k][3] = $permission[$key][$k][4] == true ? "tick" : "cross";
							
							if(VIP_NUMBER >= 4)
							{
								$GLOBALS['coinvip']['vip_advantages']['advantages'][$k][4] = $permission[$key][$k][5] == true ? "tick" : "cross";
								
								if(VIP_NUMBER == 5)
								{
									$GLOBALS['coinvip']['vip_advantages']['advantages'][$k][5] = $permission[$key][$k][+6] == true ? "tick" : "cross";
								}
							}
						}
					}
				}
			}
		}
					
		$yes = "<font color=\"red\">".$this->lang->words['Words']['Yes']."</font>";
		$no = "<font color=\"green\">".$this->lang->words['Words']['No']."</font>";
		$MResetCoin = constant("COIN_NAME_".$this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['COIN_NUMBER']);
		
		if($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] < 4)
		{
			$MODE = self::instance()->functions->GetResetInfo(0, "MODE");
			
			for($i = 0; $i < VIP_NUMBER + 1; $i++)
			{
				$resetTable['level_reset'][$i] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_RESET'][$i];
				$resetTable['money_require'][$i] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MONEY_REQUIRE'][$i];
				$resetTable['level_after'][$i] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_AFTER'][$i];
				$resetTable['clear_invent'][$i] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_INVENT'][$i] == true ? $yes : $no;
				$resetTable['clear_skill'][$i] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_SKILL'][$i] == true ? $yes : $no;
				$resetTable['clear_quest'][$i] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_QUEST'][$i] == true ? $yes : $no;
				
				if($MODE == 0xC1 || $MODE == 0xC2)
					$resetTable['set_points'][$i] = $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][$MODE]['SET_POINTS'][$i];
			}
		}
		else
		{
			$serialize_file = CTM_FileManage::Lib('ReadScript')->CheckSerializeFile("Web_ResetTable.serialize.dat") == false;
			$structure_file = CTM_FileManage::Lib('ReadScript')->StructureFile(CTM_CONTROL_PATH."Data/ResetTable.txt", "Web_ResetTable.serialize.dat", FALSE);
			$serialize_data = CTM_FileManage::Lib('ReadScript')->ReadScript();
			
			foreach($serialize_data as $key => $value)
			{
				for($i = 0; $i < VIP_NUMBER + 1; $i++)
				{
					$resetTable[$key]['level_reset'][$i] = $value[0][$i];
					$resetTable[$key]['money_require'][$i] = $value[1][$i];
					$resetTable[$key]['level_after'][$i] = $value[2][$i];
					$resetTable[$key]['clear_invent'][$i] = $value[3][$i] == 1 ? $yes : $no;
					$resetTable[$key]['clear_skill'][$i] = $value[4][$i] == 1 ? $yes : $no;
					$resetTable[$key]['clear_quest'][$i] = $value[5][$i] == 1 ? $yes : $no;
					$resetTable[$key]['set_points'][$i] = $value[6][$i];
				}
			}
			
			unset($tData);
		}
		
		switch($this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MODE'])
		{
			case 1 : $MRMODE = 0xC0; break;
			case 2 : $MRMODE = 0xC1; break;
		}
			
		for($i = 0; $i < VIP_NUMBER + 1; $i++)
		{
			$mresetTable['level_reset'][$i] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['LEVEL_RESET'][$i];
			$mresetTable['money_require'][$i] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MONEY_REQUIRE'][$i];
			$mresetTable['reset_points'][$i] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['RESET_POINTS'][$i] == true ? $yes : $no;
			$mresetTable['clear_invent'][$i] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_INVENT'][$i] == true ? $yes : $no;
			$mresetTable['clear_skill'][$i] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_SKILL'][$i] == true ? $yes : $no;
			$mresetTable['clear_quest'][$i] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_QUEST'][$i] == true ? $yes : $no;
			$mresetTable['coin_award'][$i] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['COIN_AWARD'][$i];
				
			if($this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MODE'] < 3)
			{
				$mresetTable['resets_require'][$i] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][$MRMODE]['RESETS_REQUIRE'][$i];
				if($MRMODE == 192)
					$mresetTable['resets_remove'][$i] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][$MRMODE]['RESETS_REMOVE'][$i];
			}
		}
		
		$mresetTable['strength_require'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_REQUIRE'][0];
		$mresetTable['dexterity_require'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_REQUIRE'][1];
		$mresetTable['vitality_require'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_REQUIRE'][2];
		$mresetTable['energy_require'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_REQUIRE'][3];
		$mresetTable['command_require'] = $this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_REQUIRE'][4];
		
		$this->lang->setArguments("CoinVIP,VIP_Advantages,Advantages,ResetTable,Title", $this->functions->GetResetInfo("TYPE", TRUE));
		$this->lang->setArguments("CoinVIP,VIP_Advantages,Advantages,MResetTable,CoinAward", $MResetCoin);
		
		$GLOBALS['coinvip']['vip_advantages']['resetTable'] = $resetTable;
		$GLOBALS['coinvip']['vip_advantages']['masterResetTable'] = $mresetTable;
	}
}