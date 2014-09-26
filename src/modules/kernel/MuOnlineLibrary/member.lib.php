<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * MuOnline Library: Member database manage
 * Author: $CTM['Erick-Master']
 * Last Update: 06/06/2012 - 14:20h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class MuOnline_Member extends CTM_Framework
{
	private $settings			= array();
	
	/**
	 *	Library Factory
	 *	Set up the lib settings
	 *
	 *	@param	array	Lib Settings
	 *	@return	void
	*/	
	public function LibFactory($settings)
	{
		if(MUSERVER_VERSION >= 3)
			$settings['VaultSize'] = 1920;
		elseif(MUSERVER_VERSION >= 9)
			$settings['VaultSize'] = 3840;
		else
			$settings['VaultSize'] = 1200;	
		
		$this->settings = $settings;
	}
	/**
	 *	Load Member Data
	 *	Load the account data
	 *
	 *	@param	string		Member Key (Login/E-Mail)
	 *	@param	array		Data for loading
	 *	@return	array|bool	Member Data
	*/
	public function Load($member_key, $findData = array())
	{
		if(strstr($member_key, "@"))
			$source = "mail_addr";
		else
			$source = "memb___id";
		
		$ma = "[".MUACC_CORE."].dbo.MEMB_INFO";
		$ms = "[".MUACC_CORE."].dbo.MEMB_STAT";
		$mv = "[".VIP_CORE."].dbo.".VIP_TABLE;
		
		if(count($findData) == 0)
		{
			$queryString = "SELECT {$ma}.memb_guid, {$ma}.memb___id, {$ma}.memb_name, {$ma}.mail_addr, {$ma}.sno__numb, {$ma}.tel__numb, {$ma}.fpas_ques";
			$queryString .= ", {$ma}.fpas_answ, {$ma}.bloc_code, {$ma}.RegisterDate, {$ma}.MemberBirth, {$ma}.MemberSex, {$ma}.MemberStatus";
			$queryString .= ", {$ms}.ConnectStat, {$ms}.ServerName, {$ms}.IP, {$ms}.ConnectTM, {$ms}.DisConnectTM";
			$queryString .= ", {$mv}.".VIP_COLUMN.", {$mv}.".VIP_BEGIN.", {$mv}.".VIP_TIME;
			$queryString .= " FROM ".MUACC_CORE.".dbo.MEMB_INFO LEFT JOIN {$ms} ON ({$ms}.memb___id = {$ma}.memb___id)";
			$queryString .= (VIP_TABLE != "MEMB_INFO" ? " LEFT JOIN {$mv} ON ({$mv}.".VIP_LOGIN." = {$ma}.memb___id)" : NULL);
			$queryString .= " WHERE {$ma}.{$source} = '%s'";
			
			$_all = TRUE;
		}
		else
		{
			$queryString = "SELECT {$ma}.mail_addr,{$ma}.memb___id,";
			
			if(!empty($findData['info']) && $findData['info'])
			{
				foreach(explode(",", $findData['info']) as $column)
					if($column != "mail_addr" && $column != "memb___id")
						$queryString .= $ma.".".$column.",";
						
				$_findData = TRUE;
			}
			
			if(!empty($findData['stat']) && $findData['stat'])
			{
				foreach(explode(",", $findData['stat']) as $column)
					$queryString .= $ms.".".$column.",";
					
				$_findStat = TRUE;
			}
			
			if(!empty($findData['vip']) && $findData['vip'])
			{
				foreach(explode(",", $findData['vip']) as $column)
					$queryString .= $mv.".".$column.",";
					
				$_findVIP = TRUE;
			}
			
			$queryString = trim($queryString, ",");
			$queryString .= " FROM ".MUACC_CORE.".dbo.MEMB_INFO ";
			
			if($_findStat == true)
				$queryString .= "LEFT JOIN {$ms} ON ({$ms}.memb___id = {$ma}.memb___id) ";
				
			if($_findVIP == true && VIP_TABLE != "MEMB_INFO")
				$queryString .= "LEFT JOIN {$mv} ON ({$mv}.".VIP_LOGIN." = {$ma}.memb___id) ";
				
			$queryString .= "WHERE {$ma}.{$source} = '%s'";
		}
		
		self::Driver()->Arguments($member_key);
		self::Driver()->Query($queryString, $memberDataQuery);
		
		if(self::Driver()->CountRows($memberDataQuery) < 1)
			return false;
			
		$memberData = self::Driver()->FetchObject($memberDataQuery);
		$returnData = array();
		
		if($_all == true || $_findData == true)
		{
			$returnData['info']['memb_guid'] = $memberData->memb_guid;
			$returnData['info']['memb___id'] = $memberData->memb___id;
			$returnData['info']['memb_name'] = $memberData->memb_name;
			$returnData['info']['mail_addr'] = $memberData->mail_addr;
			$returnData['info']['sno__numb'] = $memberData->sno__numb;
			$returnData['info']['tel__numb'] = $memberData->tel__numb;
			$returnData['info']['fpas_ques'] = $memberData->fpas_ques;
			$returnData['info']['fpas_answ'] = $memberData->fpas_answ;
			$returnData['info']['bloc_code'] = $memberData->bloc_code;
			
			$returnData['info']['RegisterDate'] = $memberData->RegisterDate;
			$returnData['info']['MemberBirth'] = $memberData->MemberBirth;
			$returnData['info']['MemberSex'] = $memberData->MemberSex;
			$returnData['info']['MemberStatus'] = intval($memberData->MemberStatus);
		}
		
		if($_all == true || $_findStat == true)
		{
			$returnData['stat']['ConnectStat'] = $memberData->ConnectStat;
			$returnData['stat']['ServerName'] = $memberData->ServerName;
			$returnData['stat']['IP'] = $memberData->IP;
			$returnData['stat']['ConnectTM'] = $memberData->ConnectTM;
			$returnData['stat']['DisConnectTM'] = $memberData->DisConnectTM;
		}
		
		if($_all == true || $_findVIP == true)
		{
			$returnData['vip'][VIP_COLUMN] = intval($memberData->{VIP_COLUMN});
			$returnData['vip'][VIP_BEGIN] = intval($memberData->{VIP_BEGIN});
			$returnData['vip'][VIP_TIME] = intval($memberData->{VIP_TIME});
		}
		
		if($_all == true || $_findCoin == true)
		{
			self::Driver()->Arguments($member_key);
			$getCoin = self::Driver()->Query("EXEC dbo.CTM_GetAccountCoin '%s'");
			$fetchCoin = self::Driver()->FetchObject($getCoin);

			$returnData['coin'][COIN_COLUMN_1] = intval($fetchCoin->RowValue_1);
			$returnData['coin'][COIN_COLUMN_2] = intval($fetchCoin->RowValue_2);
			$returnData['coin'][COIN_COLUMN_3] = intval($fetchCoin->RowValue_3);
		}
		
		self::Driver()->FreeResult($memberDataQuery);
		return $returnData;
	}
	/**
	 *	Load Character Data
	 *	Load the character data
	 *
	 *	@param	string		Character name
	 *	@param	string		Data for loading
	 *	@return	array|bool	Character Data
	*/
	public function LoadChar($character, $findData = NULL)
	{
		$_all = empty($findData);
		
		$queryString = "SELECT ";
		
		if($_all == true)
		{
			$queryString .= "AccountID, Name, cLevel, LevelUpPoint, Class, Experience, Strength, Dexterity, Vitality, Energy, Money, MapNumber, MapPosX, MapPosY";
			$queryString .= ", PkLevel, PkTime, CtlCode, ".(MUSERVER_VERSION >= 1 ? COLUMN_COMMAND.", " : NULL).COLUMN_PKCOUNT.", ".COLUMN_HEROCOUNT.", ";
			$queryString .= COLUMN_RESET.", ".COLUMN_RDAILY.", ".COLUMN_RWEEKLY.", ".COLUMN_RMONTHLY.", ".COLUMN_MRESET.", ".COLUMN_MRDAILY.", ".COLUMN_MRWEEKLY.", ".COLUMN_MRMONTHLY;
			$queryString .= ", ".COLUMN_CHARIMAGE;
		}
		else
		{
			$queryString .= MUSERVER_VERSION < 1 ? str_replace(array(",".COLUMN_COMMAND, COLUMN_COMMAND), NULL, $findData) : $findData;
		}
		
		$queryString .= " FROM ".MUGEN_CORE.".dbo.Character WHERE Name = '%s'";
			
		self::Driver()->Arguments($character);
		self::Driver()->Query($queryString, $charQuery);
		
		if(self::Driver()->CountRows($charQuery) < 1)
			return false;
			
		$charData = self::Driver()->FetchObject($charQuery);
		
		if($_all == true)
		{
			$returnData = array
			(
				"AccountID" => $charData->AccountID,
				"Name" => $charData->Name,
				"cLevel" => $charData->cLevel,
				"LevelUpPoint" => $charData->LevelUpPoint,
				"Class" => $charData->Class,
				"Experience" => $charData->Experience,
				"Strength" => $charData->Strength,
				"Dexterity" => $charData->Dexterity,
				"Vitality" => $charData->Vitality,
				"Energy" => $charData->Energy,
				"Money" => $charData->Money,
				"MapNumber" => $charData->MapNumber,
				"MapPosX" => $charData->MapPosX,
				"MapPosY" => $charData->MapPosY,
				"PkLevel" => $charData->PkLevel,
				"PkTime" => $charData->PkTime,
				"CtlCode" => $charData->CtlCode,
				
				COLUMN_COMMAND => $charData->{COLUMN_COMMAND},
				COLUMN_PKCOUNT => $charData->{COLUMN_PKCOUNT},
				COLUMN_HEROCOUNT => $charData->{COLUMN_HEROCOUNT},
				COLUMN_RESET => $charData->{COLUMN_RESET},
				COLUMN_RDAILY => $charData->{COLUMN_RDAILY},
				COLUMN_RWEEKLY => $charData->{COLUMN_RWEEKLY},
				COLUMN_RMONTHLY => $charData->{COLUMN_RMONTHLY},
				COLUMN_MRESET => $charData->{COLUMN_MRESET},
				COLUMN_MRDAILY => $charData->{COLUMN_MRDAILY},
				COLUMN_MRWEEKLY => $charData->{COLUMN_MRWEEKLY},
				COLUMN_MRMONTHLY => $charData->{COLUMN_MRMONTHLY},
				COLUMN_CHARIMAGE => $charData->{COLUMN_CHARIMAGE}
			);
		}
		else
		{
			foreach(explode(",", $findData) as $column)
				$returnData[$column] = $charData->{$column};
		}
		
		self::Driver()->FreeResult($charQuery);
		return $returnData;
	}
	/**
	 *	Update Account Data
	 *	Change the account data
	 *
	 *	@param	string	Member Login
	 *	@param	array	Change Data
	 *	@return	void
	*/
	public function UpdateAccount($member_login, $change_data = array())
	{
		if(count($change_data) > 0)
		{
			if(count($change_data['info']) > 0)
			{
				if($change_data['info']['memb__pwd'])
				{
					$set_pasword = TRUE;
					$_password = $change_data['info']['memb__pwd'];
					
					unset($change_data['info']['memb__pwd']);
				}
				
				if(strlen($change_data['info']['sno__numb']) < 13)
				{
					$change_data['info']['sno__numb'] = str_pad($change_data['info']['sno__numb'], 13, 1, STR_PAD_LEFT);
				}
				
				self::Driver()->Arguments($member_login);
				self::Driver()->Update(MUACC_CORE."@MEMB_INFO", $change_data['info'], "memb___id = '%s'");
				
				if($set_password == true)
					$this->ChangePassword($member_login, $_password);
			}
			
			if(count($change_data['vip']) > 0)
			{
				self::Driver()->Arguments($member_login);
				self::Driver()->Update(VIP_CORE."@".VIP_TABLE, $change_data['vip'], VIP_LOGIN." = '%s'");
			}
			
			if(count($change_data['coin']) > 0)
			{
				self::Driver()->Arguments($member_login);
				self::Driver()->Update(COIN_CORE."@".COIN_TABLE, $change_data['coin'], COIN_LOGIN." = '%s'");
			}
		}
	}
	/**
	 *	Change Account Password
	 *	Change the password of account
	 *
	 *	@param	string	Member Account
	 *	@param	string	New Password
	 *	@return	void
	*/
	public function ChangePassword($account, $new_password)
	{
		self::Driver()->Arguments($account, $new_password, USE_MD5);
		self::Driver()->Query("EXEC dbo.CTM_ChangePassword '%s', '%s', %d");
	}
	/**
	 *	Update Character Data
	 *	Change the character data
	 *
	 *	@param	string	Char name
	 *	@param	array	Change Data
	 *	@return	void
	*/
	public function UpdateCharacter($charname, $change_data = array())
	{
		if(count($change_data) > 0)
		{
			if($change_data['Inventory'])
				self::Driver()->ForceDataType("Inventory", "*");

			if($change_data['MagicList'])
				self::Driver()->ForceDataType("MagicList", "*");

			if($change_data['Quest'])
				self::Driver()->ForceDataType("Quest", "*");

			self::Driver()->Arguments($charname);
			self::Driver()->Update(MUGEN_CORE."@Character", $change_data, "Name = '%s'");
		}
	}
	/**
	 *	Delete Account
	 *	Delete the full account
	 *
	 *	@param	string	Member Login
	 *	@param	boolean	Delete Char Guild
	 *	@return	void
	*/
	public function DeleteAccount($account, $deleteGuild = FALSE)
	{
		global $CTM_SETTINGS;
		
		$query = "DELETE FROM ".MUACC_CORE.".dbo.MEMB_INFO WHERE memb___id = ':ACCOUNT:';\n";
		$query .= "DELETE FROM ".MUACC_CORE.".dbo.MEMB_STAT WHERE memb___id = ':ACCOUNT:';\n";
		$query .= "DELETE FROM ".MUGEN_CORE.".dbo.AccountCharacter WHERE Id = ':ACCOUNT:';\n";
		$query .= "DELETE FROM ".MUGEN_CORE.".dbo.warehouse WHERE AccountID = ':ACCOUNT:';\n";
		
		if(VI_CURR_INFO == TRUE)
			$query .= "DELETE FROM ".MUGEN_CORE.".dbo.VI_CURR_INFO WHERE memb___id = ':ACCOUNT:';\n";
			
		if(VIP_TABLE != "MEMB_INFO")
			$query .= "DELETE FROM ".VIP_CORE.".dbo.".VIP_TABLE." WHERE ".VIP_LOGIN." = ':ACCOUNT:';\n";
			
		if(COIN_TABLE != "MEMB_INFO")
			$query .= "DELETE FROM ".COIN_CORE.".dbo.".COIN_TABLE." WHERE ".COIN_LOGIN." = ':ACCOUNT:';\n";
		
		switch(SERVER_FILES)
		{
			case 0 :
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.ExtWarehouse WHERE AccountID = ':ACCOUNT:';\n";
			break;
			case 1 :
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.ExtWarehouse WHERE AccountID = ':ACCOUNT:';\n";
			break;
			case 2 :
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.ExtendedWarehouse WHERE AccountID = ':ACCOUNT:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.BotPet WHERE AccountID = ':ACCOUNT:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.LuckyCoinsRank WHERE Account = ':ACCOUNT:';\n";
			break;
			case 3 :
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.ExtWarehouse WHERE AccountID = ':ACCOUNT:';\n";
			break;
			default :
				if($CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['CORE']['USE'] == true)
				{
					$query .= "DELETE FROM ".MUGEN_CORE.".dbo.".$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['DATA']['TABLE'];
					$query .= " WHERE ".$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['DATA']['LOGIN']." = ':ACCOUNT:';\n";
				}
			break;
		}
		
		if(CTM_SYSTEM_NAME == "EffectWeb")
		{	
			$query .= "DELETE FROM dbo.CTM_AccountsBanneds WHERE Account = ':ACCOUNT:';\n";
			$query .= "DELETE FROM dbo.CTM_RecoverData WHERE Account = ':ACCOUNT:';\n";
			$query .= "DELETE FROM dbo.CTM_TeamMembers WHERE Account = ':ACCOUNT:';\n";
			$query .= "DELETE FROM dbo.CTM_TeamPermission WHERE RowType = 'user' AND RowValue = ':ACCOUNT:';\n";
			$query .= "DELETE FROM dbo.CTM_ValidatingAccounts WHERE Account = ':ACCOUNT:';\n";
			$query .= "DELETE FROM ".MUGEN_CORE.".dbo.EffectWebVirtualVault WHERE Account = ':ACCOUNT:';\n";
			$query .= "DELETE FROM ".MUGEN_CORE.".dbo.EffectWebCoinCache WHERE Account = ':ACCOUNT:';\n";
		}
		
		$findChars = self::Driver()->Query("SELECT Name FROM ".MUGEN_CORE.".dbo.Character WHERE AccountID = '".sql_escape($account)."'");
		
		if(self::Driver()->CountRows($findChars) > 0)
			while($name = self::Driver()->FetchObject($findChars))
				self::DeleteCharacter($name->Name, $account, $deleteGuild);
		
		self::Driver()->Parameters(array(":ACCOUNT:" => $account));
		self::Driver()->Query($query);
		
		if(CTM_SYSTEM_NAME == "EffectWeb")
		{
			self::Driver()->Arguments($account);
			$tickets_q = self::Driver()->Query("SELECT Id FROM dbo.CTM_Tickets WHERE Account = '%s'");
			
			if(self::Driver()->CountRows($tickets_q) > 0)
			{
				$query = NULL;
				while($tickets = self::Driver()->FetchRow($tickets_q))
				{
					$query .= "DELETE FROM dbo.CTM_Tickets WHERE Id = ".$tickets[0].";\n";
					$query .= "DELETE FROM dbo.CTM_TicketReplies WHERE TicketID = ".$tickets[0].";\n";
				}
				
				self::Driver()->Query($query);
			}
		}
	}
	/**
	 *	Delete Character
	 *	Delete the full character
	 *
	 *	@param	string	Char name
	 *	@param	string	Account
	 *	@param	boolean	Delete Char Guild
	 *	@return	void
	*/
	public function DeleteCharacter($charname, $account, $deleteGuild = FALSE)
	{
		global $CTM_SETTINGS;
		
		$arguments = array(":NAME:" => $charname, ":ACCOUNT:" => $account);
		
		$GameID = self::Driver()->Query("SELECT * FROM ".MUGEN_CORE.".dbo.AccountCharacter WHERE Id = '".sql_escape($account)."'");
		$GameIDSet = self::Driver()->FetchArray($GameID);
		$GameIDC = NULL;
		
		if($GameIDSet['GameID1'] == $charname) $GameID = "GameID1";
		if($GameIDSet['GameID2'] == $charname) $GameID = "GameID2";
		if($GameIDSet['GameID3'] == $charname) $GameID = "GameID3";
		if($GameIDSet['GameID4'] == $charname) $GameID = "GameID4";
		if($GameIDSet['GameID5'] == $charname) $GameID = "GameID5";
		if($GameIDSet['GameIDC'] == $charname) $GameIDC = ",GameIDC = NULL";
		
		$query = "UPDATE ".MUGEN_CORE.".dbo.AccountCharacter SET {$GameID} = NULL{$GameIDC} WHERE Id = ':ACCOUNT:';\n";
		$query .= "DELETE FROM ".MUGEN_CORE.".dbo.Character WHERE Name = ':NAME:' AND AccountID = ':ACCOUNT:';\n";
		$query .= "DELETE FROM ".MUGEN_CORE.".dbo.GuildMember WHERE Name = ':NAME:';\n";
		
		if(MUSERVER_VERSION >= 2)
		{
			$build = self::Driver()->Query("SELECT GUID FROM ".MUGEN_CORE.".dbo.T_CGuid WHERE Name = '".sql_escape($charname)."'");
			$guid = self::Driver()->FetchRow($build);
			$arguments[':GUID:'] = $guid[0];
			
			$query .= "DELETE FROM ".MUGEN_CORE.".dbo.OptionData WHERE Name = ':NAME:';\n";
			$query .= "DELETE FROM ".MUGEN_CORE.".dbo.T_CGuid WHERE Name = ':NAME:';\n";
			$query .= "DELETE FROM ".MUGEN_CORE.".dbo.T_FriendList WHERE GUID = ':GUID:' OR FriendName = ':NAME:';\n";
			$query .= "DELETE FROM ".MUGEN_CORE.".dbo.T_FriendMail WHERE GUID = ':GUID:' OR FriendName = ':NAME:';\n";
			$query .= "DELETE FROM ".MUGEN_CORE.".dbo.T_FriendMain WHERE GUID = ':GUID:' OR Name = ':NAME:';\n";
			$query .= "DELETE FROM ".MUGEN_CORE.".dbo.T_WaitFriend WHERE GUID = ':GUID:' OR FriendName = ':NAME:';\n";
		}
		
		if($deleteGuild == true)
		{
			$build = self::Driver()->Query("SELECT G_Name FROM ".MUGEN_CORE.".dbo.Guild WHERE G_Master = '".sql_escape($charname)."'");
			
			if(self::Driver()->CountRows($build) > 0)
			{
				$G_Name = self::Driver()->FetchRow($build);
				$arguments[':G_NAME:'] = $G_Name;
				
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.Guild WHERE G_Name = ':G_NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.GuildMember WHERE G_Name = ':G_NAME:';\n";
				
				if(MUSERVER_VERSION >= 2)
				{
					$query .= "UPDATE ".MUGEN_CORE.".dbo.MuCastle_DATA SET OWNER_GUILD = NULL, CASTLE_OCCUPY = 0 WHERE OWNER_GUILD = ':G_NAME:';\n";
				}
				if(SERVER_FILES == 2)
				{
					$query .= "DELETE FROM ".MUGEN_CORE.".dbo.GuildWarehouse WHERE G_Name = ':G_NAME:';\n";
				}
			}
		}
		
		switch(SERVER_FILES)
		{
			case 0 :
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.MasterSkillTree WHERE Name = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.QuestWorld WHERE Name = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.QuestKillCount WHERE Name = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.RankingBloodCastle WHERE Name = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.RankingDevilSquare WHERE Name = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.RankingChaosCastle WHERE Name = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.RankingIllusionTemple WHERE Name = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.RankingDuel WHERE Name = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.Gens_Rank WHERE Name = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.Gens_Reward WHERE Name = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.EventSantaClaus WHERE Name = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.EventLeoTheHelper WHERE Name = ':NAME:';\n";
			break;
			case 1 :
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.T_MasterLevelSystem WHERE CHAR_NAME = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.T_QUEST_MONSTERKILL WHERE CHAR_NAME = ':NAME:';\n";
			break;
			case 2 :
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.SCFS5Quest WHERE Name = ':NAME:';\n";
			break;
			case 3 :
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.T_MasterLevelSystem WHERE CHAR_NAME = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.T_QUEST_MONSTERKILL WHERE CHAR_NAME = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.T_QUESTS WHERE CHAR_NAME = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.T_GensSystem WHERE CHAR_NAME = ':NAME:';\n";
			break;
		}
			
		if(CTM_SYSTEM_NAME == "EffectWeb")
		{
			$_query = self::Driver()->Query("SELECT ".COLUMN_CHARIMAGE." FROM ".MUGEN_CORE.".dbo.Character WHERE Name = '".sql_escape($charname)."'");
			$image = self::Driver()->FetchRow($_query);
		
			$query .= "DELETE FROM dbo.CTM_CharactersBanneds WHERE Character = ':NAME:';\n";
			
			if(file_exists($CTM_SETTINGS['WEBDATA']['UPLOADS']['DIRECTORY']['CHARIMAGE'].$image[0]))
				unlink($CTM_SETTINGS['WEBDATA']['UPLOADS']['DIRECTORY']['CHARIMAGE'].$image[0]);
		}
		
		self::Driver()->Parameters($arguments);
		self::Driver()->Query($query);
	}
	/**
	 *	Rename Character
	 *	Change the name from character
	 *
	 *	@param	string	Current name
	 *	@param	string	Account
	 *	@param	string	New name
	 *	@return	string	NAME_IN_USE | ID_ERROR | ALL_OK
	*/
	public function RenameCharacter($charname, $account, $newName)
	{
		self::Driver()->Arguments(strtolower($newName));
		self::Driver()->Query("SELECT Name FROM ".MUGEN_CORE.".dbo.Character WHERE LOWER(Name) = '%s'", $name_exists);
		
		if(self::Driver()->CountRows($name_exists) > 0)
			return "NAME_IN_USE";
		
		self::Driver()->Arguments($account);
		self::Driver()->Query("SELECT * FROM ".MUGEN_CORE.".dbo.AccountCharacter WHERE Id = '%s'", $GameIDSet);
		$GameIDSet = self::Driver()->FetchArray($GameIDSet);
		
		$GameID = NULL;
		$GameIDC = NULL;
		
		if($GameIDSet['GameID1'] == $charname) $GameID = "GameID1";
		if($GameIDSet['GameID2'] == $charname) $GameID = "GameID2";
		if($GameIDSet['GameID3'] == $charname) $GameID = "GameID3";
		if($GameIDSet['GameID4'] == $charname) $GameID = "GameID4";
		if($GameIDSet['GameID5'] == $charname) $GameID = "GameID5";
		if($GameIDSet['GameIDC'] == $charname) $GameIDC = ",GameIDC = ':NEW_NAME:'";
		
		if($GameID == NULL)
			return "ID_ERROR";
		
		$query = "UPDATE ".MUGEN_CORE.".dbo.AccountCharacter SET {$GameID} = ':NEW_NAME:'{$GameIDC} WHERE Id = ':ACCOUNT:';\n";
		$query .= "UPDATE ".MUGEN_CORE.".dbo.Character SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
		$query .= "UPDATE ".MUGEN_CORE.".dbo.Guild SET G_Master = ':NEW_NAME:' WHERE G_Master = ':NAME:';\n";
		$query .= "UPDATE ".MUGEN_CORE.".dbo.GuildMember SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
		
		if(MUSERVER_VERSION >= 2)
		{
			$query .= "UPDATE ".MUGEN_CORE.".dbo.OptionData SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
			$query .= "UPDATE ".MUGEN_CORE.".dbo.T_CGuid SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
			$query .= "UPDATE ".MUGEN_CORE.".dbo.T_FriendList SET FriendName = ':NEW_NAME:' WHERE FriendName = ':NAME:';\n";
			$query .= "UPDATE ".MUGEN_CORE.".dbo.T_FriendMail SET FriendName = ':NEW_NAME:' WHERE FriendName = ':NAME:';\n";
			$query .= "UPDATE ".MUGEN_CORE.".dbo.T_FriendMain SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
			$query .= "UPDATE ".MUGEN_CORE.".dbo.T_WaitFriend SET FriendName = ':NEW_NAME:' WHERE FriendName = ':NAME:';\n";
		}
		
		switch(SERVER_FILES)
		{
			case 0 : // X-Team Servers: Season 6 [EP1/EP2/EP3]
				$query .= "UPDATE ".MUGEN_CORE.".dbo.MasterSkillTree SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.QuestWorld SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.QuestKillCount SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.RankingBloodCastle SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.RankingDevilSquare SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.RankingChaosCastle SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.RankingIllusionTemple SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.RankingDuel SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.Gens_Rank SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.Gens_Reward SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.EventSantaClaus SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.EventLeoTheHelper SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
			break;
			case 1 : // WH Team: Season 4.6 JPN
				$query .= "UPDATE ".MUGEN_CORE.".dbo.T_MasterLevelSystem SET CHAR_NAME = ':NEW_NAME:' WHERE CHAR_NAME = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.T_QUEST_MONSTERKILL SET CHAR_NAME = ':NEW_NAME:' WHERE CHAR_NAME = ':NAME:';\n";
			break;
			case 2 : // SCFMuTeam: Season 5 / Season 6 [EP1/EP2/EP3]
				$query .= "UPDATE ".MUGEN_CORE.".dbo.SCFS5Quest SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
				$query .= "DELETE FROM ".MUGEN_CORE.".dbo.SCFS5Quest WHERE Name = ':NAME:';\n";
			break;
			case 3 : // ENCGames: Season 6 EP1
				$query .= "UPDATE ".MUGEN_CORE.".dbo.T_MasterLevelSystem SET CHAR_NAME = ':NEW_NAME:' WHERE CHAR_NAME = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.T_QUEST_MONSTERKILL SET CHAR_NAME = ':NEW_NAME:' WHERE CHAR_NAME = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.T_QUESTS SET CHAR_NAME = ':NEW_NAME:' WHERE CHAR_NAME = ':NAME:';\n";
				$query .= "UPDATE ".MUGEN_CORE.".dbo.T_GensSystem SET CHAR_NAME = ':NEW_NAME:' WHERE CHAR_NAME = ':NAME:';\n";
			break;
		}
		
		if(CTM_SYSTEM_NAME == "EffectWeb")
		{
			$query .= "UPDATE dbo.CTM_CharactersBanneds SET Character = ':NEW_NAME:' WHERE Character = ':NAME:';\n";
			$query .= "UPDATE dbo.CTM_NoticeComments SET Author = ':NEW_NAME:' WHERE Author = ':NAME:';\n";
			$query .= "UPDATE dbo.CTM_TeamMembers SET Name = ':NEW_NAME:' WHERE Name = ':NAME:';\n";
			$query .= "UPDATE dbo.CTM_Tickets SET Character = ':NEW_NAME:' WHERE Character = ':NAME:';\n";
			$query .= "UPDATE dbo.CTM_TicketReplies SET Author = ':NEW_NAME:' WHERE Author = ':NAME:';\n";
		}
		
		self::Driver()->Parameters(array(":NAME:" => $charname, ":ACCOUNT:" => $account, ":NEW_NAME:" => $newName));
		self::Driver()->Query($query);
		
		return "ALL_OK";
	}
	/**
	 *	Change Character Account
	 *	Change the account from character
	 *
	 *	@param	string	Char name
	 *	@param	string	Current account
	 *	@param	string	New account
	 *	@return	string	ACCOUNT_NO_EXISTS | ID_ERROR | ALL_OK
	*/
	public function ChangeCharacterAccount($charname, $current_account, $new_account)
	{
		self::Driver()->Arguments($_POST['NewAccount']);
		self::Driver()->Query("SELECT 1 FROM ".MUACC_CORE.".dbo.MEMB_INFO WHERE memb___id = '%s'", $check_account_exists);

		if(self::Driver()->CountRows($check_account_exists) < 1)
			return "ACCOUNT_NO_EXISTS";

		self::Driver()->Arguments($current_account);
		self::Driver()->Query("SELECT * FROM ".MUGEN_CORE.".dbo.AccountCharacter WHERE Id = '%s'", $GameIDSetOld);
		$GameIDSetOld = self::Driver()->FetchArray($GameIDSetOld);

		self::Driver()->Arguments($new_account);
		self::Driver()->Query("SELECT * FROM ".MUGEN_CORE.".dbo.AccountCharacter WHERE Id = '%s'", $GameIDSet);
		$GameIDSet = self::Driver()->FetchArray($GameIDSet);
		
		$GameIDOld = NULL;
		$gameIDC = NULL;
		$GameID = NULL;

		if($GameIDSetOld['GameID1'] == $charname) $GameIDOld = "GameID1";
		if($GameIDSetOld['GameID2'] == $charname) $GameIDOld = "GameID2";
		if($GameIDSetOld['GameID3'] == $charname) $GameIDOld = "GameID3";
		if($GameIDSetOld['GameID4'] == $charname) $GameIDOld = "GameID4";
		if($GameIDSetOld['GameID5'] == $charname) $GameIDOld = "GameID5";
		if($GameIDSetOld['GameIDC'] == $charname) $GameIDC = TRUE;
		
		if(strlen($GameIDSet['GameID1']) < 2 && $GameID == NULL) $GameID = "GameID1";
		if(strlen($GameIDSet['GameID2']) < 2 && $GameID == NULL) $GameID = "GameID2";
		if(strlen($GameIDSet['GameID3']) < 2 && $GameID == NULL) $GameID = "GameID3";
		if(strlen($GameIDSet['GameID4']) < 2 && $GameID == NULL) $GameID = "GameID4";
		if(strlen($GameIDSet['GameID5']) < 2 && $GameID == NULL) $GameID = "GameID5";

		if($GameID == NULL)
			return "ID_ERROR";


		$old_update = array($GameIDOld => NULL);

		if($GameIDC == true)
		{
			self::Driver()->ForceDatatype("GameIDC", "null");
			$old_update['GameIDC'] = NULL;
		}

		self::Driver()->Arguments($current_account);
		self::Driver()->ForceDatatype($GameIDOld, "null");
		self::Driver()->Update(MUGEN_CORE."@AccountCharacter", $old_update, "Id = '%s'");

		self::Driver()->Arguments($new_account);
		self::Driver()->Update(MUGEN_CORE."@AccountCharacter", array($GameID => $charname), "Id = '%s'");

		self::Driver()->Arguments($charname, $current_account);
		self::Driver()->Update(MUGEN_CORE."@Character", array("AccountID" => $new_account), "Name = '%s' AND AccountID = '%s'");

		if(CTM_SYSTEM_NAME == "EffectWeb")
		{
			self::Driver()->Arguments($charname, $current_account);
			self::Driver()->Update("CTM_CharactersBanneds", array("Account" => $new_account), "Name = '%s' AND AccountID = '%s'");
		}

		return "ALL_OK";
	}
	public function CreateAccount($data)
	{
		$password = USE_MD5 == 1 ? "CONVERT(varbinary(16),'0x00')" : "'".sql_escape($data['Password'])."'";
		
		$query = "INSERT INTO ".MUACC_CORE.".dbo.MEMB_INFO (memb___id,memb__pwd,memb_name,sno__numb,post_code,addr_info,addr_deta,tel__numb,mail_addr,phon_numb,";
		$query .= "fpas_ques,fpas_answ,job__code,appl_days,modi_days,out__days,true_days,mail_chek,bloc_code,ctl1_code";
		$query .= ",RegisterDate,MemberBirth,MemberSex,MemberStatus) VALUES ('%s',{$password},'%s','%s','s-n','11111','','%s','%s','','%s','%s','1',";
		$query .= "'2003-11-23','2003-11-23','2003-11-23','2003-11-23',1,'%d','1',%d,'%s','%s',%d);\n";
		
		if(VI_CURR_INFO == TRUE)
		{
			$query .= "INSERT INTO ".MUACC_CORE.".dbo.VI_CURR_INFO (ends_days,chek_code,used_time,memb___id,memb_name,memb_guid,sno__numb,";
			$query .= "Bill_Section,Bill_value,Bill_Hour,Surplus_Point,Surplus_Minute,Increase_Days)";
			$query .= " VALUES ('2005','1',1234,'%s','%s',1,'7','6','3','6','6','2003-11-23 10:36:00','0');\n";
		}
		
		if(VIP_TABLE != "MEMB_INFO")
			$query .= "INSERT INTO ".VIP_CORE.".dbo.".VIP_TABLE." (".VIP_LOGIN.",".VIP_COLUMN.",".VIP_TIME.",".VIP_BEGIN.") VALUES ('%s',%s,%d,%d);\n";
		
		if(COIN_TABLE != "MEMB_INFO")
			$query .= "INSERT INTO ".COIN_CORE.".dbo.".COIN_TABLE." (".COIN_LOGIN.") VALUES ('%s');\n";
		
		$query .= "INSERT INTO ".MUGEN_CORE.".dbo.warehouse (AccountID,Items,Money,DbVersion,pw) VALUES ('%s',%s,%d,%d,NULL);\n";
		
		if(USE_MD5 == 1)
			$query .= "EXEC dbo.CTM_EncodePassword '%s','%s';\n";
		
		self::Driver()->Arguments($data['Login'], $data['Name'], "111111".$data['PID'], $data['Phone'], $data['Mail']);
		self::Driver()->Arguments($data['SecureQuestion'][0], $data['SecureQuestion'][1], (bool)$data['Lock'] ? 1 : 0);
		self::Driver()->Arguments(time(), $data['Birth'], $data['Sex'], (bool)$data['Status'] ? 1 : 0);
		
		if(VI_CURR_INFO == TRUE)
			self::Driver()->Arguments($data['Login'], $data['Name']);
			
		if(VIP_TABLE != "MEMB_INFO")
			self::Driver()->Arguments($data['Login'], 0, 0, 0);
			
		if(COIN_TABLE != "MEMB_INFO")
			self::Driver()->Arguments($data['Login']);
			
		self::Driver()->Arguments($data['Login'], "0x".str_repeat("FF", $this->settings['VaultSize']), 0, MUSERVER_VERSION >= 3 ? 3 : 1);
		
		if(USE_MD5 == 1)
			self::Driver()->Arguments($data['Login'], $data['Password']);
		
		self::Driver()->Query($query);
		self::Driver()->Clear();
		
		unset($query);
		return NULL;
	}
	/**
	 *	Remove Master Skill Tree
	 *	Remove all Master Skill Tree of character
	 *
	 *	@param	string	Char name
	 *	@return	void
	*/
	public function RemoveSkillTree($charname)
	{
		if(MUSERVER_VERSION >= 5)
		{
			switch(SERVER_FILES)
			{
				case 0 :
					$query = "DELETE FROM ".MUGEN_CORE.".dbo.MasterSkillTree WHERE Name = '%s'";
				break;
				case 1 :
					$query = "DELETE FROM ".MUGEN_CORE.".dbo.T_MasterLevelSystem WHERE CHAR_NAME = '%s'";
				break;
				case 2 :
					$query = "UPDATE ".MUGEN_CORE.".dbo.Character SET SCFMasterLevel = 1,SCFMasterPoints = 0 WHERE Name = '%s'";
				break;
				case 3 :
					$query = "DELETE FROM ".MUGEN_CORE.".dbo.T_MasterLevelSystem WHERE CHAR_NAME = '%s'";
				break;
				default :
					$ML = $CTM_SETTINGS['MASTERLEVEL'];
					
					if($ML['DATA']['TABLE'] != "Character")
						$query = "DELETE FROM ".MUGEN_CORE.".dbo.".$ML['DATA']['TABLE']." WHERE ".$ML['DATA']['NAME']." = '%s'";
					else
						$query = "UPDATE ".MUGEN_CORE.".dbo.Character SET ".$ML['DATA']['LEVEL']." = 0,".$ML['DATA']['POINTS']." = 0 WHERE Name = '%s'";
				break;
			}
			
			self::Driver()->Arguments($charname);
			self::Driver()->Query($query);
		}
	}
}
