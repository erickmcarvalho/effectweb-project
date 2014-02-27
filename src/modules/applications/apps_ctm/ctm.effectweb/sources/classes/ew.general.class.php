<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Class: General Load
 * Last Update: 15/08/2012 - 16:44h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EWGeneral extends CTM_EWCore implements EffectWebData
{
	/**
	 *	Init Class
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->registry();
		$this->loadGlobalArguments();
		$this->loadGlobalTags();
		
		if(loadIsAjax() == true && (!($_GET['pag'] || !$_GET['module']) && !$this->URLData[1]) && !$_GET['ajax'])
		{
			$this->loadWebRecordOnline();
			$this->loadWebServerList();
			$this->loadHeaderQuerys();
			$this->loadHeaderArguments();
		}
		elseif(loadIsAjax() == false)
		{
			$this->loadWebRecordOnline();
			$this->loadWebServerList();
			$this->loadHeaderQuerys();
			$this->loadHeaderArguments();
		}
	}
	/**
	 *	Private: Global Tags
	 *
	 *	@return	void
	*/
	private function loadGlobalTags()
	{
		$this->updateVars("title_site", utf8_decode(utf8_encode(TITLE_SITE)));
		$this->updateVars("server_name", SERVER_NAME);
		$this->updateVars("web_version", EW_PUBLIC_VERSION);
		$this->updateVars("web_footer", "Effect Web ".EW_PUBLIC_VERSION." - MuOnline Suite Software");
		$this->updateVars("captcha_image", self::CAPTCHA_URL);
		
		$this->updateVars("loading_page_ajax", LOADING_PAGE_AJAX ? "1" : "0");
		$this->updateVars("friend_url", HTACCESS_FRIEND_URL ? "1" : "0");
		$this->updateVars("show_message_type", SHOW_MESSAGE_TYPE);

		$this->updateVars("login_url", $this->settings['WEBREFERER']['REDIRECT']['LOGIN']['REDIRECT_TO_CP'] == true ? "?app=core&module=userpanel" : NULL);
		
		$this->lang->loadLanguageFile("header", self::$application);
	}
	/**
	 *	Header Querys [Server Informations]
	 *
	 *	@return	void
	*/
	public function loadHeaderQuerys()
	{
		switch(strval(SERVER_BUGBLESS))
		{
			case "0" : $this->updateVars("sidebar,infos,bug_bless", "<font color=\"red\">Offline</font>"); break;
			case "1" : $this->updateVars("sidebar,infos,bug_bless", "<font color=\"green\">Online</font>"); break;
			default : $this->updateVars("sidebar,infos,bug_bless", "<font color=\"blue\">".SERVER_BUGBLESS."</font>"); break;
		}
		
		if(!function_exists("numberFormat"))
			$numberFormat = create_function("\$integer", "return number_format(\$integer, 0, false, '.');");

		$vip_lang = "sidebar,infos,count,totalVIPAccounts,";
		$this->updateVars("sidebar,infos,count,totalAccounts", $numberFormat($this->ServerInfo(MUACC_CORE, "MEMB_INFO", "memb___id")));
		$this->updateVars("sidebar,infos,count,totalCharacters", $numberFormat($this->ServerInfo(MUACC_CORE, "Character", "Name")));
		$this->updateVars("sidebar,infos,count,totalGuilds", $numberFormat($this->ServerInfo(MUACC_CORE, "Guild", "G_Name")));
		$this->updateVars($vip_lang."1", $numberFormat($this->ServerInfo(VIP_CORE, VIP_TABLE, VIP_LOGIN, VIP_COLUMN." = 1")));
		
		if(VIP_NUMBER >= 2)
			$this->updateVars($vip_lang."2", $numberFormat($this->ServerInfo(VIP_CORE, VIP_TABLE, VIP_LOGIN, VIP_COLUMN." = 2")));
		if(VIP_NUMBER >= 3)
			$this->updateVars($vip_lang."3", $numberFormat($this->ServerInfo(VIP_CORE, VIP_TABLE, VIP_LOGIN, VIP_COLUMN." = 3")));
		if(VIP_NUMBER >= 4)
			$this->updateVars($vip_lang."4", $numberFormat($this->ServerInfo(VIP_CORE, VIP_TABLE, VIP_LOGIN, VIP_COLUMN." = 4")));
		if(VIP_NUMBER == 5)
			$this->updateVars($vip_lang."5", $numberFormat($this->ServerInfo(VIP_CORE, VIP_TABLE, VIP_LOGIN, VIP_COLUMN." = 5")));
		
		$this->updateVars("sidebar,infos,count,totalBanned,accounts", $numberFormat($this->ServerInfo(MUACC_CORE, "MEMB_INFO", "memb___id", "bloc_code = 1 AND MemberStatus = 0")));
		$this->updateVars("sidebar,infos,count,totalBanned,characters", $numberFormat($this->ServerInfo(MUACC_CORE, "Character", "Name", "CtlCode = 1")));
		$this->updateVars("sidebar,infos,reset_type", $this->functions->getResetInfo(0, 'TYPE'));
		
		$this->lang->setArguments("Footer,LoadTime", CTM_LoadTime::resultTime());
	}
	/**
	 *	Private: Global Arguments
	 *
	 *	@return	void
	*/
	private function loadGlobalArguments()
	{
		if(SESSION_USER_LOGGED == true)
		{
			$this->DB->Arguments(USER_ACCOUNT);
			$findChars = $this->DB->Query("SELECT Name, ".COLUMN_RESET." FROM ".MUGEN_CORE.".dbo.Character WHERE AccountID = '%s'");
			
			while($characters = $this->DB->FetchRow($findChars))
				$GLOBALS['user_logged_data']['characters'][] = $characters[0];
			
			$this->DB->FreeResult($findChars);
			unset($findChars, $characters);
		}
	}
	/**
	 *	Private: Header Arguments
	 *
	 *	@return	void
	*/
	private function loadHeaderArguments()
	{
		if(SESSION_USER_LOGGED)
		{
			$member = Authentication::GetAuthData();
			$member = $member['ACCOUNT'];
			
			$GLOBALS['user_logged_data']['info'] = array
			(
				"member_name" => htmlEncode($member['info']['memb_name']),
				"member_level" => $this->functions->AccountLevel($member['vip'][VIP_COLUMN]),
				"member_coin" => array
				(
					1 => number_format($member['coin'][COIN_COLUMN_1], 0, false, "."),
					2 => number_format($member['coin'][COIN_COLUMN_2], 0, false, "."),
					3 => number_format($member['coin'][COIN_COLUMN_3], 0, false, ".")
				),
			);
		}
	}
	/**
	 *	Private: Web Server List
	 *
	 *	@return	void
	*/
	private function loadWebServerList()
	{
		$servers = array(); 
		$loop = array(); 
		$settings = $this->settings['SERVERLIST'];

		if($settings['SWITCH'] == true)
		{
			if($settings['CONNECTSERVER']['REQUEST'] == true)
			{
				$this->MuLib('ConnectServer')->CSHost = $settings['CONNECTSERVER']['HOST'];
				$this->MuLib('ConnectServer')->CSPort = $settings['CONNECTSERVER']['PORT'];
				$this->MuLib('ConnectServer')->CSVersion = MUSERVER_VERSION >= 3 ? 2 : 1;
				$this->MuLib('ConnectServer')->Timeout = $settings['CONNECTSERVER']['TIMEOUT'];
				
				if($this->MuLib('ConnectServer')->init() == true)
					if($this->MuLib('ConnectServer')->LoadConnectServerRoms() == true)
						$loop = $this->MuLib('ConnectServer')->CSRoms;
			}
			else
			{
				$loop = $settings['ROOM_LIST'];
			}
			
			foreach($loop as $GS_ID => $GameServer)
			{
				if($settings['ROOM_LIST'][$GS_ID][3] == true)
				{
					$gameserver = $settings['ROOM_LIST'][$GS_ID][0];
					
					if($settings['CONNECTSERVER']['REQUEST'] == true)
					{
						$GS_ID = $GameServer['GS_ID'];
						$count = $GameServer['USER_COUNT'];
					}
					else
					{
						$countQ = $this->DB->Select("count(IP)", MUGEN_CORE."@MEMB_STAT", "ConnectStat > 0 AND ServerName = '{$gameserver}'");
						$count = $this->DB->FetchRow($countQ);
						$count = ceil($count[0] * 100 / $settings['ROOM_LIST'][$GS_ID][2]);
					}
					
					$servers[$GS_ID] = array
					(
						"gameserver" => $gameserver,
						"name" => htmlentities($settings['ROOM_LIST'][$GS_ID][1], ENT_QUOTES, "UTF-8"),
						"count" => $count
					);
				}
			}
		}
		
		$totalOnline = $this->DB->Select("count(IP)", MUGEN_CORE."@MEMB_STAT", "ConnectStat > 0");
		$totalOnline = $this->DB->FetchRow($totalOnline);
		
		$GLOBALS['global_serverlist']['servers'] = $servers;
		$GLOBALS['global_serverlist']['totalOnline'] = number_format($totalOnline[0], 0, false, ".");
	}
	/**
	 *	Private: Web Record Online [Players online]
	 *
	 *	@return	void
	*/
	private function loadWebRecordOnline()
	{
		$timeCache = time();
		$totalQuery = $this->DB->Query("SELECT count(IP) FROM ".MUACC_CORE.".dbo.MEMB_STAT WHERE ConnectStat > 0");
		$totalOnline = $this->DB->FetchRow($totalQuery);
		//$this->DB->FreeResult($totalQuery);
		
		if(!function_exists("returnRecordArray"))
		{
			function returnRecordArray($recordGeneral, $recordToday)
			{
				return array
				(
					"EW.GeneralRecord" => array
					(
						"EW.RecordDate" => date("d/m/Y", $recordGeneral[0]),
						"EW.RecordHour" => date("H:i:s", $recordGeneral[0]),
						"EW.RecordCount" => $recordGeneral[1]
					),
					"EW.TodayRecord" => array
					(
						"EW.RecordDate" => date("d/m/Y", $recordToday[0]),
						"EW.RecordHour" => date("H:i:s", $recordToday[0]),
						"EW.RecordCount" => $recordToday[1]
					)
				);
			}
		}
		
		if(!file_exists(CTM_CACHE_PATH."server_cache/db_ini/ew_record.ini"))
		{
			$create = "[EW.GeneralRecord]\r\n";
			$create .= "EW.RecordDate	= ".date("d/m/Y", $timeCache)."\r\n";
			$create .= "EW.RecordHour	= ".date("H:i:s", $timeCache)."\r\n";
			$create .= "EW.RecordCount	= ".$totalOnline[0]."\r\n";
			
			$create .= "\r\n";
			$create .= "[EW.TodayRecord]\r\n";
			$create .= "EW.RecordDate	= ".date("d/m/Y", $timeCache)."\r\n";
			$create .= "EW.RecordHour	= ".date("H:i:s", $timeCache)."\r\n";
			$create .= "EW.RecordCount	= ".$totalOnline[0];
			
			$webRecord = returnRecordArray(array($timeCache, $totalOnline[0]), array($timeCache, $totalOnline[0]));
			$fp = fopen(CTM_CACHE_PATH."server_cache/db_ini/ew_record.ini", "w");
			fwrite($fp, $create);
			fclose($fp);
		}
		else
		{
			$webRecord = parse_ini_file(CTM_CACHE_PATH."server_cache/db_ini/ew_record.ini", TRUE);
			
			if($totalOnline[0] > $webRecord['EW.GeneralRecord']['EW.RecordCount'])
			{
				$currentData = file_get_contents(CTM_CACHE_PATH."server_cache/db_ini/ew_record.ini");
				$newData = CTM_FileManage::Lib('IniFiles')->EditIniString("EW.GeneralRecord", "EW.RecordDate", date("d/m/Y", $timeCache), $currentData);
				$newData = CTM_FileManage::Lib('IniFiles')->EditIniString("EW.GeneralRecord", "EW.RecordHour", date("H:i:s", $timeCache), $newData);
				$newData = CTM_FileManage::Lib('IniFiles')->EditIniString("EW.GeneralRecord", "EW.RecordCount", $totalOnline[0], $newData);
				
				$newData = CTM_FileManage::Lib('IniFiles')->EditIniString("EW.TodayRecord", "EW.RecordDate", date("d/m/Y", $timeCache), $newData);
				$newData = CTM_FileManage::Lib('IniFiles')->EditIniString("EW.TodayRecord", "EW.RecordHour", date("H:i:s", $timeCache), $newData);
				$newData = CTM_FileManage::Lib('IniFiles')->EditIniString("EW.TodayRecord", "EW.RecordCount", $totalOnline[0], $newData);
				
				$webRecord = returnRecordArray(array($timeCache, $totalOnline[0]), array($timeCache, $totalOnline[0]));
				$fp = fopen(CTM_CACHE_PATH."server_cache/db_ini/ew_record.ini", "w");
				fwrite($fp, $newData);
				fclose($fp);
				
				$this->DB->Arguments(date("d/m/Y", $timeCache), date("H:i:s", $timeCache), $totalOnline[0]);
				$this->DB->Query("INSERT INTO dbo.CTM_RecordLogs ([Date],Hour,Record) VALUES ('%s','%s',%d)");
			}
			elseif($totalOnline[0] > $webRecord['EW.TodayRecord']['EW.RecordCount'])
			{
				$currentData = file_get_contents(CTM_CACHE_PATH."server_cache/db_ini/ew_record.ini");
				$newData = CTM_FileManage::Lib('IniFiles')->EditIniString("EW.TodayRecord", "EW.RecordDate", date("d/m/Y", $timeCache), $currentData);
				$newData = CTM_FileManage::Lib('IniFiles')->EditIniString("EW.TodayRecord", "EW.RecordHour", date("H:i:s", $timeCache), $newData);
				$newData = CTM_FileManage::Lib('IniFiles')->EditIniString("EW.TodayRecord", "EW.RecordCount", $totalOnline[0], $newData);
				
				$webRecord['EW.TodayRecord']['EW.RecordDate'] = date("d/m/Y", $timeCache);
				$webRecord['EW.TodayRecord']['EW.RecordHour'] = date("H:i:s", $timeCache);
				$webRecord['EW.TodayRecord']['EW.RecordCount'] = $totalOnline[0];
				
				$fp = fopen(CTM_CACHE_PATH."server_cache/db_ini/ew_record.ini", "w");
				fwrite($fp, $newData);
				fclose($fp);
			}
		}
		
		$x1 = "<strong>".$webRecord['EW.GeneralRecord']['EW.RecordDate']."</strong>";
		$x2 = "<strong>".$webRecord['EW.GeneralRecord']['EW.RecordHour']."</strong>";
		$x3 = "<strong>".$webRecord['EW.GeneralRecord']['EW.RecordCount']."</strong>";
		
		$y1 = "<strong>".$webRecord['EW.TodayRecord']['EW.RecordDate']."</strong>";
		$y2 = "<strong>".$webRecord['EW.TodayRecord']['EW.RecordHour']."</strong>";
		$y3 = "<strong>".$webRecord['EW.TodayRecord']['EW.RecordCount']."</strong>";
		
		$this->updateVars("sidebar,infos,recordOnline,general", $webRecord['EW.GeneralRecord']['EW.RecordCount']);
		$this->updateVars("sidebar,infos,recordOnline,today", $webRecord['EW.TodayRecord']['EW.RecordCount']);
		
		$this->lang->setTags("Sidebar,Infos,RecordOnline,Messages,General", $x1, $x2, $x3);
		$this->lang->setTags("Sidebar,Infos,RecordOnline,Messages,Today", $y1, $y2, $y3);
	}
	/**
	 *	Server Info [function]
	 *
	 *	@param	string	Database
	 *	@param	string	Table
	 *	@param	string	Column for count()
	 *	@param	string	Where
	 *	@return	integer
	*/
	public function ServerInfo($db, $table, $count, $where = NULL)
	{
		if($db && $table && $count)
		{
			if($where)
				$this->DB->Select("count(".$count.")", $db."@".$table, $where);
			else
				$this->DB->Select("count(".$count.")", $db."@".$table);
			
			list($return) = $this->DB->FetchRow();

			return $return;
		}
	}
}