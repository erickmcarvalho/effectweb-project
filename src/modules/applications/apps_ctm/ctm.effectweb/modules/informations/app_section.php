<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Informations Page
 * Last Update: 17/07/2012 - 13:49h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Informations extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->lang->loadLanguageFile("informations");

		switch($_GET['do'] ? $_GET['do'] : $this->URLData[1])
		{
			case "team" :
				require_once(THIS_APPLICATION_PATH."modules/informations/team.php");
				$serverTeam = new Infos_ServerTeam();
				$serverTeam->registry();
				$serverTeam->initSection();
				$this->output->loadSkinCache("informations", "serverTeam");
			break;
			case "terms" :
				require_once(THIS_APPLICATION_PATH."modules/informations/terms.php");
				$serverTerms = new Infos_ServerTerms();
				$serverTerms->registry();
				$serverTerms->initSection();
			break;
			default : 
				$this->loadServerInformations();
				$this->output->loadSkinCache("informations", "serverInfos");
			break;
		}
	}
	/**
	 *	Server Informations
	 *
	 *	@return	void
	*/
	private function loadServerInformations()
	{
		if(loadIsAjax() == true)
		{
			$CTM_EWGeneral = new CTM_EWGeneral();
			$CTM_EWGeneral->registry();
			$CTM_EWGeneral->loadHeaderQuerys();
		}
		
		$yes = "<font color=\"red\">".$this->lang->words['Words']['Yes']."</font>";
		$no = "<font color=\"green\">".$this->lang->words['Words']['No']."</font>";
		$MResetCoin = constant("COIN_NAME_".$this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['COIN_NUMBER']);
		
		$this->lang->setArguments("Infos,ResetTable,Title", $this->functions->GetResetInfo("TYPE", TRUE));
		$this->lang->setArguments("Infos,MResetTable,CoinAward", $MResetCoin);
		
		switch(SERVER_STATUS)
		{
			case 1 :
				$fp = fsockopen(GAMESERVER_HOST, GAMESERVER_PORT, $error, $msg, 1);
				$status = $fp ? "<font color=\"green\">Online</span>" : "<font color=\"red\">Offline</font>";
			break;
			case 2 :
				$status = "<font color=\"red\">".$this->lang->words['Infos']['Maintenance']."</font>";
			break;
		}
		
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
		
		$queryCharsPk = self::DB()->Query("SELECT count(Name) FROM ".MUGEN_CORE.".dbo.Character WHERE PkLevel > 3");
		$queryCharsHero = self::DB()->Query("SELECT count(Name) FROM ".MUGEN_CORE.".dbo.Character WHERE PkLevel < 3");
		//$queryOnlines = self::DB()->Query("SELECT count(memb___id) FROM ".MUACC_CORE.".dbo.MEMB_STAT WHERE ConnectStat > 0");
		
		$countCharsPk = self::DB()->FetchRow($queryCharsPk);
		$countCharsHero = self::DB()->FetchRow($queryCharsHero);
		//$countOnlines = self::DB()->FetchRow($queryOnlines);
		
		$GLOBALS['informations'] = array
		(
			"count" => array
			(
				"chars_pk" => number_format($countCharsPk[0], 0, false, "."),
				"chars_hero" => number_format($countCharsHero[0], 0, false, "."),
				//"chars_online" => number_format($countCharsHero[0], 0, false, ".")
			),
			"status" => $status,
			"resetTable" => $resetTable,
			"masterResetTable" => $mresetTable
		);
	}
}