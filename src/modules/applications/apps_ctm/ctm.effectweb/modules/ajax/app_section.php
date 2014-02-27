<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Ajax Module
 * Last Update: 03/05/2012 - 16:31h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Ajax extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		if($_GET['ajax'])
		{
			switch($_GET['ajax'])
			{
				case "refreshServers" :
					$this->loadRefreshServers();
				break;
				case "poll" :
					require_once(THIS_APPLICATION_PATH."modules/ajax/webpoll.php");
					$AjaxPoll = new Ajax_WebPoll();
					$AjaxPoll->registry();
					$AjaxPoll->initSection();
				break;
				case "gamemasters" :
					self::loadGameMasters();
				break;
				default :
					exit("Ajax Command Error");
				break;
			}
		}
	}
	/**
	 *	Command: Refresh ServerList
	 *
	 *	@return	void
	*/
	private static function loadRefreshServers()
	{
		if(self::instance()->settings['SERVERLIST']['SWITCH'] == true)
		{
			if(self::instance()->settings['SERVERLIST']['CONNECTSERVER']['REQUEST'] == true)
			{
				self::MuLib('ConnectServer')->CSHost = self::instance()->settings['SERVERLIST']['CONNECTSERVER']['HOST'];
				self::MuLib('ConnectServer')->CSPort = self::instance()->settings['SERVERLIST']['CONNECTSERVER']['PORT'];
				self::MuLib('ConnectServer')->CSVersion = MUSERVER_VERSION >= 3 ? 2 : 1;
				self::MuLib('ConnectServer')->Timeout = self::instance()->settings['SERVERLIST']['CONNECTSERVER']['TIMEOUT'];
				
				if(self::MuLib('ConnectServer')->init() == true)
					if(self::MuLib('ConnectServer')->LoadConnectServerRoms() == true)
						$loop = self::MuLib('ConnectServer')->CSRoms;
			}
			else
			{
				$loop = self::instance()->settings['SERVERLIST']['ROOM_LIST'];
			}

			foreach($loop as $GS_ID => $GameServer)
			{
				if(self::instance()->settings['SERVERLIST']['ROOM_LIST'][$GS_ID][3] == true)
				{
					$gameserver = self::instance()->settings['SERVERLIST']['ROOM_LIST'][$GS_ID][0];
					
					if(self::instance()->settings['SERVERLIST']['CONNECTSERVER']['REQUEST'] == true)
					{
						$GS_ID = $GameServer['GS_ID'];
						$count = $GameServer['USER_COUNT'];
					}
					else
					{
						$countQ = self::DB()->Select("count(memb___id)", MUGEN_CORE."@MEMB_STAT", "ConnectStat > 0 AND ServerName = '{$gameserver}'");
						$count = self::DB()->FetchRow($countQ);
						$count = ceil($count[0] * 100 / self::instance()->settings['SERVERLIST']['ROOM_LIST'][$GS_ID][2]);
					}
				}
							
				$html .= "updateServerCount('".$GS_ID."', {$count});\n";
			}
		}
		
		$totalOnline = self::DB()->Select("count(memb___id)", MUGEN_CORE."@MEMB_STAT", "ConnectStat > 0");
		$totalOnline = self::DB()->FetchRow($totalOnline);
		
		echo("<script>\n");
		echo($html);
		echo("$('#TotalOnline').html(".$totalOnline[0].");\n");
		exit("</script>");
	}
	/**
	 *	Show characters with CtlCode = CTLCODE_GAMEMASTER
	 *
	 *	@return	void
	*/
	private static function loadGameMasters()
	{
		$queryString = "USE [".MUGEN_CORE."]; ";
		$queryString .= "SELECT Character.Name, MEMB_STAT.ConnectStat FROM ".MUGEN_CORE.".dbo.Character JOIN ".MUACC_CORE.".dbo.MEMB_STAT";
		$queryString .= " ON (Character.AccountID = MEMB_STAT.memb___id) WHERE Character.CtlCode = %d ORDER BY Character.Name";
		$queryString .= "; USE [".CTMEW_CORE."];";
		
		self::DB()->Arguments(CTLCODE_GAMEMASTER);
		self::DB()->Query($queryString, $resource);
		
		if(self::DB()->CountRows() > 0)
		{
			$loop = array(); $i = 0;
			while($member = self::DB()->FetchObject($resource))
			{
				$loop[$i]['name'] = $member->Name;
				$loop[$i]['status'] = $member->ConnectStat > 0 ? 1 : 0;
				$i++;
			}
			
			$GLOBALS['ajax_gamemasters'] = $loop;
			unset($loop); self::DB()->FreeResult($resource);
		}
		
		self::instance()->lang->loadLanguageFile("ajax");
		self::instance()->output->loadSkinCache("ajax", "GameMasters");
		self::instance()->output->noSetCache(true);
	}
}