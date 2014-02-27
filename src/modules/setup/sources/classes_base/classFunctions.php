<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Controller: Command Functions
 * Last Update: 14/12/2012 - 16:32h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTMCommand_Functions extends CTM_Command
{
	/**
	 *	Construct class
	 *
	 *	@return	void
	*/
	public function __construct()
	{
		$this->registry();
	}
	/**
	 *	Account Blocked
	 *	Chck if account is blocked
	 *
	 *	@param	string	Account
	 *	@return	boolean
	*/
	public function AccountBlocked($account)
	{
		$this->DB->Arguments($account);
		$this->DB->Query("SELECT bloc_code FROM ".MUACC_CORE.".dbo.MEMB_INFO WHERE memb___id = '%s' AND MemberStatus = 0", $findMemberInfoQ);
		
		$findMemberInfoC = $this->DB->CountRows($findMemberInfoQ);
		$findMemberInfo = $this->DB->FetchObject($findMemberInfoQ);
		
		return $findMemberInfoC > 0 && $findMemberInfo->bloc_code == 1;
	}
	/**
	 *	Check Team ACP
	 *	Check if the account has access in ACP
	 *
	 *	@param	string	Account
	 *	@return	boolean
	*/
	public function CheckTeamACP($account)
	{
		if(in_array($account, $this->settings['ADMINCONTROLPANEL']['SADMIN_ACCOUNTS']))
			return true;

		$this->DB->Arguments($account);
		$check_member_q = $this->DB->Query("SELECT ACP_Access, PrimaryGroup FROM dbo.CTM_TeamMembers WHERE Account = '%s'");

		if($this->DB->CountRows($check_member_q) < 1)
			return false;

		$fetch = $this->DB->FetchRow($check_member_q);

		if($fetch[0] == 1)
			return true;

		$this->DB->Arguments($fetch[1]);
		$check_group_q = $this->DB->Query("SELECT ACP_Access FROM dbo.CTM_TeamGroups WHERE Id = %d");

		if($this->DB->CountRows($check_group_q) < 1)
			return false;

		$fetch = $this->DB->FetchRow($check_group_q);

		return $fetch[0] == true;
	}
	/**
	 *	Check Character
	 *	Check if the character belongs the account
	 *
	 *	@param	string	Character
	 *	@param	string	Account (Default -> USER_ACCOUNT)
	 *	@return	boolean
	*/
	public function CheckCharacter($char, $account = USER_ACCOUNT)
	{
		$this->DB->Arguments($char, $account);
		$resource = $this->DB->Query("SELECT Name FROM ".MUGEN_CORE.".dbo.Character WHERE Name = '%s' AND AccountID = '%s'");
		
		return $this->DB->CountRows($resource) > 0;
	}
	/**
	 *	Word Wrap
	 *
	 *	@param	string	Text
	 *	@param	boolean	Run nl2br()
	 *	@return	string
	*/
	public function wordwrap($string, $setBR = FALSE)
	{
		$string = htmlspecialchars_decode($string);
		$string = stripslashes($string);
		if($setBR == TRUE) $string = nl2br($string);
		
		return $string;
	}
	/**
	 *	Get Master Level Data
	 *	Get the Master Level config
	 *
	 *	@return	array
	*/
	public function GetMasterLevelData()
	{
		if(MUSERVER_VERSION > 4)
		{
			$data = array();
			if(SERVER_FILES == 0)
			{
				$data['DATA']['TABLE'] = "MasterSkillTree";
				$data['DATA']['NAME'] = "Name";
				$data['DATA']['LEVEL'] = "MasterLevel";
				$data['DATA']['POINTS'] = "MasterPoint";
			}
			elseif(SERVER_FILES == 2)
			{
				$data['DATA']['TABLE'] = "Character";
				$data['DATA']['NAME'] = "Name";
				$data['DATA']['LEVEL'] = "SCFMasterLevel";
				$data['DATA']['POINTS'] = "SCFMasterPoints";
			}
			elseif(SERVER_FILES == 1 || SERVER_FILES == 3)
			{
				$data['DATA']['TABLE'] = "T_MasterLevelSystem";
				$data['DATA']['NAME'] = "CHAR_NAME";
				$data['DATA']['LEVEL'] = "MASTER_LEVEL";
				$data['DATA']['POINTS'] = "ML_POINT";	
			}
			else
			{
				$data['DATA']['TABLE'] = $this->settings['MASTERLEVEL']['DATA']['TABLE'];
				$data['DATA']['NAME'] = $this->settings['MASTERLEVEL']['DATA']['NAME'];
				$data['DATA']['LEVEL'] = $this->settings['MASTERLEVEL']['DATA']['LEVEL'];
				$data['DATA']['POINTS'] = $this->settings['MASTERLEVEL']['DATA']['POINTS'];	
			}
		}
		else $data = FALSE;
		
		return $data;
	}
	/**
	 *	Get Reset Info
	 *	Get the reset info
	 *
	 *	@param	integer	Type (Default -> 0)
	 *	@param	string	Info (Default -> FALSE)
	 *	@return	mixed
	*/
	public function GetResetInfo($type = 0, $info = FALSE)
	{
		if($info == FALSE) 
		{
			return $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'];
		}

		if($info == "TYPE")
		{
			if($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] < 3)
				return $this->lang->words['Words']['Accumulative'];
			if($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] == 3)  
				return $this->lang->words['Words']['Dynamic'];
			if($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] == 4)  
				return $this->lang->words['Words']['Tabulated'];
		}

		if($info == "MODE")
		{
			switch($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'])
			{
				case 1 : return 0xC0; break;
				case 2 : return 0xC1; break;
				case 3 : return 0xC2; break;
				case 4 : return 0xC3; break;
			}
		}

		switch($this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'])
		{
			case 1 :
				return $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC0][strtoupper($info)][$type];
			break;
			case 2 :
				return $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC1][strtoupper($info)][$type];
			break;
			case 3 :
				return $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC2][strtoupper($info)][$type];
			break;
			case 4 :
				return $this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC3][strtoupper($info)][$type];
			break;
		}
	}
	/**
	 *	Get Server Name
	 *	Get the real server name
	 *
	 *	@param	string	GameServer
	 *	@return	string
	*/
	public function GetServerName($GameServer)
	{
		$GameServer = !is_numeric($GameServer) ? $this->GetServerID($GameServer) : $GameServer;
		
		if(!array_key_exists($GameServer, $this->settings['SERVERLIST']['ROOM_LIST'])) return $GameServer;
		else return CTM_Text::UTF8Text($this->settings['SERVERLIST']['ROOM_LIST'][$GameServer][1]);
	}
	/**
	 *	Get ID
	 *	Get the server id
	 *
	 *	@param	string	GameServer
	 *	@return	integer
	*/
	public function GetServerID($GameServer)
	{
		foreach($this->settings['SERVERLIST']['ROOM_LIST'] as $key => $value)
		{
			if(strtolower($GameServer) == strtolower($value[0]))
			{
				$serverId = $key;
				break;
			}
		}
		
		return intval($serverId);
	}
	/**
	 *	Get Char Image
	 *	Get the image dir from char
	 *
	 *	@param	string	File name
	 *	@return	string
	*/
	public function GetCharImage($data)
	{
		$dir = (CTM_ROOT_AREA == "admin" ? "../" : NULL).$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['CHARIMAGE'];
		
		if(strlen($data) < 2 || !file_exists($dir.$data))
			$data = PUBLIC_DIRECTORY."/style_images/".$this->output->template."/no-image.png";
		else
			$data = $dir.$data;
		
		return $data;
	}
	/**
	 *	Get Guild Mark
	 *	Get the guild mark link
	 *
	 *	@param	string	Mark Hexa
	 *	@return	string
	*/
	public function GetGuildMark($hexa)
	{
		return EffectWebData::LOGOGUILD_URL."&hexa=".urlencode(bin2hex($hexa));
	}
	/**
	 *	Get Class Info
	 *	Get the class info
	 *
	 *	@param	string	Class key
	 *	@param	integer	Return key
	 *	@return	mixed
	*/
	public function ClassInfo($class, $return = 0)
	{
		switch($return)
		{
			case 0 :
				switch($class)
				{
					case $this->settings['CLASSCODE']['DW'][0] : return $this->settings['CLASSCODE']['DW'][1]; break;
					case $this->settings['CLASSCODE']['SM'][0] : return $this->settings['CLASSCODE']['SM'][1]; break;
					case $this->settings['CLASSCODE']['GM'][0] : return $this->settings['CLASSCODE']['GM'][1]; break;
					case $this->settings['CLASSCODE']['DK'][0] : return $this->settings['CLASSCODE']['DK'][1]; break;
					case $this->settings['CLASSCODE']['BK'][0] : return $this->settings['CLASSCODE']['BK'][1]; break;
					case $this->settings['CLASSCODE']['BM'][0] : return $this->settings['CLASSCODE']['BM'][1]; break;
					case $this->settings['CLASSCODE']['FE'][0] : return $this->settings['CLASSCODE']['FE'][1]; break;
					case $this->settings['CLASSCODE']['ME'][0] : return $this->settings['CLASSCODE']['ME'][1]; break;
					case $this->settings['CLASSCODE']['HE'][0] : return $this->settings['CLASSCODE']['HE'][1]; break;
					case $this->settings['CLASSCODE']['MG'][0] : return $this->settings['CLASSCODE']['MG'][1]; break;
					case $this->settings['CLASSCODE']['DM'][0] : return $this->settings['CLASSCODE']['DM'][1]; break;
					case $this->settings['CLASSCODE']['DL'][0] : return $this->settings['CLASSCODE']['DL'][1]; break;
					case $this->settings['CLASSCODE']['LE'][0] : return $this->settings['CLASSCODE']['LE'][1]; break;
					case $this->settings['CLASSCODE']['SU'][0] : return $this->settings['CLASSCODE']['SU'][1]; break;
					case $this->settings['CLASSCODE']['BS'][0] : return $this->settings['CLASSCODE']['BS'][1]; break;
					case $this->settings['CLASSCODE']['DIM'][0] : return $this->settings['CLASSCODE']['DIM'][1]; break;
					case $this->settings['CLASSCODE']['RF'][0] : return $this->settings['CLASSCODE']['RF'][1]; break;
					case $this->settings['CLASSCODE']['FM'][0] : return $this->settings['CLASSCODE']['FM'][1]; break;
					default : return "Error"; break;
				}
			break;
			default :
				return $this->settings['CLASSCODE'][$class][0];
			break;
		}
	}
	/**
	 *	Char Initial Points
	 *	Get initial points by class
	 *
	 *	@param	integer	Class number
	 *	@return	array
	*/
	public function CharInitialPoints($class_number)
	{
		switch($class_number)
		{
			case $this->settings['CLASSCODE']['DW'][0] : return $this->settings['INITIALPOINTS']['DW/SM/GM']; break;
			case $this->settings['CLASSCODE']['SM'][0] : return $this->settings['INITIALPOINTS']['DW/SM/GM']; break;
			case $this->settings['CLASSCODE']['GM'][0] : return $this->settings['INITIALPOINTS']['DW/SM/GM']; break;
			case $this->settings['CLASSCODE']['DK'][0] : return $this->settings['INITIALPOINTS']['DK/BK/BM']; break;
			case $this->settings['CLASSCODE']['BK'][0] : return $this->settings['INITIALPOINTS']['DK/BK/BM']; break;
			case $this->settings['CLASSCODE']['BM'][0] : return $this->settings['INITIALPOINTS']['DK/BK/BM']; break;
			case $this->settings['CLASSCODE']['FE'][0] : return $this->settings['INITIALPOINTS']['FE/ME/HE']; break;
			case $this->settings['CLASSCODE']['ME'][0] : return $this->settings['INITIALPOINTS']['FE/ME/HE']; break;
			case $this->settings['CLASSCODE']['HE'][0] : return $this->settings['INITIALPOINTS']['FE/ME/HE']; break;
			case $this->settings['CLASSCODE']['MG'][0] : return $this->settings['INITIALPOINTS']['MG/DM']; break;
			case $this->settings['CLASSCODE']['DM'][0] : return $this->settings['INITIALPOINTS']['MG/DM']; break;
			case $this->settings['CLASSCODE']['DL'][0] : return $this->settings['INITIALPOINTS']['DL/LE']; break;
			case $this->settings['CLASSCODE']['LE'][0] : return $this->settings['INITIALPOINTS']['DL/LE']; break;
			case $this->settings['CLASSCODE']['SU'][0] : return $this->settings['INITIALPOINTS']['SU/DS/DIM']; break;
			case $this->settings['CLASSCODE']['BS'][0] : return $this->settings['INITIALPOINTS']['SU/DS/DIM']; break;
			case $this->settings['CLASSCODE']['DIM'][0] : return $this->settings['INITIALPOINTS']['SU/DS/DIM']; break;
			case $this->settings['CLASSCODE']['RF'][0] : return $this->settings['INITIALPOINTS']['RF/FM']; break;
			case $this->settings['CLASSCODE']['FM'][0] : return $this->settings['INITIALPOINTS']['RF/FM']; break;
			default : return array(21, 21, 18, 23, 0); break;
		}
	}
	/**
	 *	Char Initial Class
	 *	Get initial class number by class
	 *
	 *	@param	integer	Class number
	 *	@return	array
	*/
	public function CharInitialClass($class_number)
	{
		switch($class_number)
		{
			case $this->settings['CLASSCODE']['DW'][0] : return $this->settings['CLASSCODE']['DW'][0]; break;
			case $this->settings['CLASSCODE']['SM'][0] : return $this->settings['CLASSCODE']['DW'][0]; break;
			case $this->settings['CLASSCODE']['GM'][0] : return $this->settings['CLASSCODE']['DW'][0]; break;
			case $this->settings['CLASSCODE']['DK'][0] : return $this->settings['CLASSCODE']['DK'][0]; break;
			case $this->settings['CLASSCODE']['BK'][0] : return $this->settings['CLASSCODE']['DK'][0]; break;
			case $this->settings['CLASSCODE']['BM'][0] : return $this->settings['CLASSCODE']['DK'][0]; break;
			case $this->settings['CLASSCODE']['FE'][0] : return $this->settings['CLASSCODE']['FE'][0]; break;
			case $this->settings['CLASSCODE']['ME'][0] : return $this->settings['CLASSCODE']['FE'][0]; break;
			case $this->settings['CLASSCODE']['HE'][0] : return $this->settings['CLASSCODE']['FE'][0]; break;
			case $this->settings['CLASSCODE']['MG'][0] : return $this->settings['CLASSCODE']['MG'][0]; break;
			case $this->settings['CLASSCODE']['DM'][0] : return $this->settings['CLASSCODE']['MG'][0]; break;
			case $this->settings['CLASSCODE']['DL'][0] : return $this->settings['CLASSCODE']['DL'][0]; break;
			case $this->settings['CLASSCODE']['LE'][0] : return $this->settings['CLASSCODE']['DL'][0]; break;
			case $this->settings['CLASSCODE']['SU'][0] : return $this->settings['CLASSCODE']['SU'][0]; break;
			case $this->settings['CLASSCODE']['BS'][0] : return $this->settings['CLASSCODE']['SU'][0]; break;
			case $this->settings['CLASSCODE']['DIM'][0] : return $this->settings['CLASSCODE']['SU'][0]; break;
			case $this->settings['CLASSCODE']['RF'][0] : return $this->settings['CLASSCODE']['RF'][0]; break;
			case $this->settings['CLASSCODE']['FM'][0] : return $this->settings['CLASSCODE']['RF'][0]; break;
			default : return 0; break;
		}
	}
	/**
	 *	Char Initial Map
	 *	Get initial map by class
	 *
	 *	@param	integer	Class number
	 *	@return	array
	*/
	public function CharInitialMap($class_number)
	{
		switch($class_number)
		{
			case $this->settings['CLASSCODE']['DW'][0] : return $this->settings['INITIALMAP']['DW/SM/GM']; break;
			case $this->settings['CLASSCODE']['SM'][0] : return $this->settings['INITIALMAP']['DW/SM/GM']; break;
			case $this->settings['CLASSCODE']['GM'][0] : return $this->settings['INITIALMAP']['DW/SM/GM']; break;
			case $this->settings['CLASSCODE']['DK'][0] : return $this->settings['INITIALMAP']['DK/BK/BM']; break;
			case $this->settings['CLASSCODE']['BK'][0] : return $this->settings['INITIALMAP']['DK/BK/BM']; break;
			case $this->settings['CLASSCODE']['BM'][0] : return $this->settings['INITIALMAP']['DK/BK/BM']; break;
			case $this->settings['CLASSCODE']['FE'][0] : return $this->settings['INITIALMAP']['FE/ME/HE']; break;
			case $this->settings['CLASSCODE']['ME'][0] : return $this->settings['INITIALMAP']['FE/ME/HE']; break;
			case $this->settings['CLASSCODE']['HE'][0] : return $this->settings['INITIALMAP']['FE/ME/HE']; break;
			case $this->settings['CLASSCODE']['MG'][0] : return $this->settings['INITIALMAP']['MG/DM']; break;
			case $this->settings['CLASSCODE']['DM'][0] : return $this->settings['INITIALMAP']['MG/DM']; break;
			case $this->settings['CLASSCODE']['DL'][0] : return $this->settings['INITIALMAP']['DL/LE']; break;
			case $this->settings['CLASSCODE']['LE'][0] : return $this->settings['INITIALMAP']['MG/DM']; break;
			case $this->settings['CLASSCODE']['SU'][0] : return $this->settings['INITIALMAP']['SU/DS/DIM']; break;
			case $this->settings['CLASSCODE']['BS'][0] : return $this->settings['INITIALMAP']['SU/DS/DIM']; break;
			case $this->settings['CLASSCODE']['DIM'][0] : return $this->settings['INITIALMAP']['SU/DS/DIM']; break;
			case $this->settings['CLASSCODE']['RF'][0] : return $this->settings['INITIALMAP']['RF/FM']; break;
			case $this->settings['CLASSCODE']['FM'][0] : return $this->settings['INITIALMAP']['RF/FM']; break;
			default : return array(0, 125, 125); break;
		}
	}
	/**
	 *	Return Class
	 *	Get the class info by number and order key
	 *
	 *	@param	integer	Class number
	 *	@param	integer	Order key
	 *	@param	integer	Return info	
	 *	@return	mixed
	*/
	public function ReturnClass($class_number, $key, $return = 1)
	{
		switch($class_number)
		{
			case "SM" :
				switch($key)
				{
					case 1 : return $this->settings['CLASSCODE']['DW'][$return]; break;
					case 2 : return $this->settings['CLASSCODE']['SM'][$return]; break;
					case 3 : return $this->settings['CLASSCODE']['GM'][$return]; break;
				}
			break;
			case "BK" :
				switch($key)
				{
					case 1 : return $this->settings['CLASSCODE']['DK'][$return]; break;
					case 2 : return $this->settings['CLASSCODE']['BK'][$return]; break;
					case 3 : return $this->settings['CLASSCODE']['BM'][$return]; break;
				}
			break;
			case "ME" :
				switch($key)
				{
					case 1 : return $this->settings['CLASSCODE']['FE'][$return]; break;
					case 2 : return $this->settings['CLASSCODE']['ME'][$return]; break;
					case 3 : return $this->settings['CLASSCODE']['HE'][$return]; break;
				}
			break;
			case "MG" :
				switch($key)
				{
					case 1 : return $this->settings['CLASSCODE']['MG'][$return]; break;
					case 2 : return $this->settings['CLASSCODE']['DM'][$return]; break;
				}
			break;
			case "DL" :
				switch($key)
				{
					case 1 : return $this->settings['CLASSCODE']['DL'][$return]; break;
					case 2 : return $this->settings['CLASSCODE']['LE'][$return]; break;
				}
			break;
			case "SU" :
				switch($key)
				{
					case 1 : return $this->settings['CLASSCODE']['SU'][$return]; break;
					case 2 : return $this->settings['CLASSCODE']['BS'][$return]; break;
					case 3 : return $this->settings['CLASSCODE']['DIM'][$return]; break;
				}
			break;
			case "RF" :
				switch($key)
				{
					case 1 : return $this->settings['CLASSCODE']['RF'][$return]; break;
					case 2 : return $this->settings['CLASSCODE']['FE'][$return]; break;
				}
			break;
		}
	}
	/**
	 *	Return Class Number
	 *	Get the class order key
	 *
	 *	@param	integer	Class number
	 *	@return	integer
	*/
	public function ReturnClassNumber($class_number)
	{
		switch($class_number)
		{
			case $this->settings['CLASSCODE']['DW'][0] : return 1; break;
			case $this->settings['CLASSCODE']['SM'][0] : return 2; break;
			case $this->settings['CLASSCODE']['GM'][0] : return 3; break;
			case $this->settings['CLASSCODE']['DK'][0] : return 1; break;
			case $this->settings['CLASSCODE']['BK'][0] : return 2; break;
			case $this->settings['CLASSCODE']['BM'][0] : return 3; break;
			case $this->settings['CLASSCODE']['FE'][0] : return 1; break;
			case $this->settings['CLASSCODE']['ME'][0] : return 2; break;
			case $this->settings['CLASSCODE']['HE'][0] : return 3; break;
			case $this->settings['CLASSCODE']['MG'][0] : return 1; break;
			case $this->settings['CLASSCODE']['DM'][0] : return 2; break;
			case $this->settings['CLASSCODE']['DL'][0] : return 1; break;
			case $this->settings['CLASSCODE']['LE'][0] : return 2; break;
			case $this->settings['CLASSCODE']['SU'][0] : return 1; break;
			case $this->settings['CLASSCODE']['BS'][0] : return 2; break;
			case $this->settings['CLASSCODE']['DIM'][0] : return 3; break;
			case $this->settings['CLASSCODE']['RF'][0] : return 1; break;
			case $this->settings['CLASSCODE']['FM'][0] : return 2; break;
		}
	}
	/**
	 *	Class Is Lord
	 *	Check if the class is Dark Lord of Lord Emperor
	 *
	 *	@param	ineteger	Class number
	 *	@return	boolean
	*/
	public function ClassIsLord($class_number)
	{
		if($class_number == $this->ClassInfo("DL", 1)) return true;
		if($class_number == $this->ClassInfo("LE", 1)) return true;
		
		return false;
	}
	/**
	 *	Get Map Info
	 *	Get the map info
	 *
	 *	@param	integer	Map number
	 *	@param	integer	Return info (Default -> 2)
	 *	@return	mixed
	*/
	public function MapInfo($mapNumber, $return = 2)
	{
		return $this->settings['MAPDATA'][$mapNumber][$return];
	}
	/**
	 *	Account Level
	 *	Get the account level name
	 *
	 *	@param	integer	Value number
	 *	@return	string
	*/
	public function AccountLevel($value)
	{
		switch($value)
		{
			case 0 : return $this->lang->words['Words']['Free']; break;
			case 1 : return VIP_NAME_1; break;
			case 2 : return VIP_NAME_2; break;
			case 3 : return VIP_NAME_3; break;
			case 4 : return VIP_NAME_4; break;
			case 5 : return VIP_NAME_5; break;
			default : return "Error"; break;
		}
	}
	/**
	 *	Make VIP Time
	 *	Get the real vip time
	 *
	 *	@param	integer	Time integer of Time Stamp
	 *	@return	string
	*/
	public function MakeVIPTime($time)
	{
		$is_time = $time > 0;
		$setTime = $is_time == true && strlen($time) <> 10 ? strtotime("+ ".$time." days") : $time;
		
		return $is_time == true ? date("d/m/Y", $setTime) : $this->lang->words['Words']['Never'];
	}
	/**
	 *	Item Info String
	 *	Get the item info string
	 *
	 *	@param	integer	Id
	 *	@param	integer	Return info
	 *	@return	mixed
	*/
	public function ItemInfoString($id, $return = 0)
	{
		return CTM_MuOnline::Lib('Item')->Strings()->GetItemInfo($id, $this->lang->language, $return);
	}
	/**
	 *	Check Use Item
	 *	Check if class use the item
	 *
	 *	@param	array	Class => array(order, key)
	 *	@param	integer	Min use
	 *	@return	boolean
	*/
	public function CheckUseItem($class = array(0, "DW"), $use)
	{
		$number = $this->ReturnClassNumber($class[0]);
		
		if($use < 1)
			return false;
		else
			if($class[0] == $this->ReturnClass($class[1], $number, 0))
				if($use <= $number)
					return true;
				
		return false;
	}
	/**
	 *	Load Item Details
	 *	Get the item details for tooltip
	 *
	 *	@param	array	Item parse
	 *	@param	array	Char parse
	 *	@return	array
	*/
	public function LoadItemDetails($parse, $char = array())
	{
		CTM_MuOnline::Lib('Item')->Database()->GetItemName($parse['Section'], $parse['Index'], $parse['Level'], $itemName);
		CTM_MuOnline::Lib('Item')->Database()->GetItemData($parse['Section'], $parse['Index'], $parse['Level'], $itemData);
		
		$setItem = 0;
		$use[0] = $itemData['ClassUse']['SM'];
		$use[1] = $itemData['ClassUse']['BK'];
		$use[2] = $itemData['ClassUse']['ME'];
		$use[3] = $itemData['ClassUse']['MG'];
		$use[4] = $itemData['ClassUse']['DL'];
		$use[5] = $itemData['ClassUse']['SU'];
		$use[6] = $itemData['ClassUse']['RF'];
		
		$req[0] = $itemData['Requirement']['Level'];
		$req[1] = $itemData['Requirement']['Strength'];
		$req[2] = $itemData['Requirement']['Dexterity'];
		$req[3] = $itemData['Requirement']['Vitality'];
		$req[4] = $itemData['Requirement']['Energy'];
		$req[5] = $itemData['Requirement']['Command'];
		
		if($req[0] > 0) $data['Requirement'][0] = $req[0];
		if($req[1] > 0) $data['Requirement'][1] = $req[1];
		if($req[2] > 0) $data['Requirement'][2] = $req[2];
		if($req[3] > 0) $data['Requirement'][3] = $req[3];
		if($req[4] > 0) $data['Requirement'][4] = $req[4];
		if($req[5] > 0) $data['Requirement'][5] = $req[5];
		
		if($char['Class'])
		{
			$tmp = $char['Class'];
			$class = array();
			$class[0] = !$this->CheckUseItem(array($tmp, "SM"), $use[0]) ? 1 : 0;
			$class[1] = !$this->CheckUseItem(array($tmp, "BK"), $use[1]) ? 1 : 0;
			$class[2] = !$this->CheckUseItem(array($tmp, "ME"), $use[2]) ? 1 : 0;
			$class[3] = !$this->CheckUseItem(array($tmp, "MG"), $use[3]) ? 1 : 0;
			$class[4] = !$this->CheckUseItem(array($tmp, "DL"), $use[4]) ? 1 : 0;
			$class[5] = !$this->CheckUseItem(array($tmp, "SU"), $use[5]) ? 1 : 0;
			$class[6] = !$this->CheckUseItem(array($tmp, "RF"), $use[6]) ? 1 : 0;
		}
		
		$data['Begin'] .= $this->ItemInfoString(0)." ".$parse['Durability'];
		
		if($use[0] > 0) $data['ClassUse'][0] = array($this->ReturnClass("SM", $use[0]), $class[0]);
		if($use[1] > 0) $data['ClassUse'][1] = array($this->ReturnClass("BK", $use[1]), $class[1]);
		if($use[2] > 0) $data['ClassUse'][2] = array($this->ReturnClass("ME", $use[2]), $class[2]);
		if($use[3] > 0) $data['ClassUse'][3] = array($this->ReturnClass("MG", $use[3]), $class[3]);
		if($use[4] > 0) $data['ClassUse'][4] = array($this->ReturnClass("DL", $use[4]), $class[4]);
		if($use[5] > 0) $data['ClassUse'][5] = array($this->ReturnClass("SU", $use[5]), $class[5]);
		if($use[6] > 0) $data['ClassUse'][6] = array($this->ReturnClass("RF", $use[6]), $class[6]);
			
		if($parse['Luck'] == 1) $data['Options'] .= $this->ItemInfoString(2, 0)."{#}";
		if($parse['Luck'] == 1) $data['Options'] .= $this->ItemInfoString(2, 1)."{#}";
		if($parse['Option'] > 0) $data['Options'] .= str_replace("{x}", $parse['Option'], $this->ItemInfoString(3, 0))."{#}";
		
		if($parse['Excellent']['Count'] > 0)
		{
			$excellent = CTM_MuOnline::Lib('Item')->Strings()->GetExcellentData($parse['Section'], $parse['Index'], $parse['Level'], $itemData['Slot']);
			$excellent = $excellent[$this->lang->language];
			$itemName = "Excellent ".$itemName;
			$setItem = 2;
			
			if($parse['Excellent'][0] == 1 && $excellent[0] != "NONE") $data['Options'] .= $excellent[0]."{#}";
			if($parse['Excellent'][1] == 1 && $excellent[1] != "NONE") $data['Options'] .= $excellent[1]."{#}";
			if($parse['Excellent'][2] == 1 && $excellent[2] != "NONE") $data['Options'] .= $excellent[2]."{#}";
			if($parse['Excellent'][3] == 1 && $excellent[3] != "NONE") $data['Options'] .= $excellent[3]."{#}";
			if($parse['Excellent'][4] == 1 && $excellent[4] != "NONE") $data['Options'] .= $excellent[4]."{#}";
			if($parse['Excellent'][5] == 1 && $excellent[5] != "NONE") $data['Options'] .= $excellent[5]."{#}";
		}
		if(MUSERVER_VERSION >= 3 && $parse['JewelOfHarmony'][0] > 0)
		{
			CTM_MuOnline::Lib('Item')->Strings()->GetHarmonyData($parse['Section'], $parse['JewelOfHarmony'][0], $parse['JewelOfHarmony'][1], $harmony);
			$data['Harmony'] = $harmony['Name']." + ".$harmony['Value'];
		}
		
		if(MUSERVER_VERSION >= 6 && $parse['SocketOption']['Count'] > 0)
		{
			$data['Socket'][0] = CTM_MuOnline::Lib('Item')->Strings()->GetSocketData(1, $parse['SocketOption'][0][0], $parse['SocketOption'][0][1]);
			$data['Socket'][1] = CTM_MuOnline::Lib('Item')->Strings()->GetSocketData(2, $parse['SocketOption'][1][0], $parse['SocketOption'][1][1]);
			$data['Socket'][2] = CTM_MuOnline::Lib('Item')->Strings()->GetSocketData(3, $parse['SocketOption'][2][0], $parse['SocketOption'][2][1]);
			$data['Socket'][3] = CTM_MuOnline::Lib('Item')->Strings()->GetSocketData(4, $parse['SocketOption'][3][0], $parse['SocketOption'][3][1]);
			$data['Socket'][4] = CTM_MuOnline::Lib('Item')->Strings()->GetSocketData(5, $parse['SocketOption'][4][0], $parse['SocketOption'][4][1]);
			$setItem = 3;
		}
		
		if($parse['Ancient'] > 0) $setItem = 1;
		
		$define = CTM_MuOnline::Lib('Item')->Database()->CheckDefineItemName($parse['Section'], $parse['Index'], $parse['Level']);
		$data['Name'] = $itemName.($parse['Level'] > 0 && $define == false ? " +".$parse['Level'] : NULL);
		$data['Set_Item'] = $setItem;
		
		$tooltip = array();
		$tooltip['Begin'] = $data['Begin'];
		$tooltip['Options'] = $data['Options'];
		
		if(count($char) < 1)
		{
			$char['cLevel'] = 700000;
			$char['Strength'] = 700000;
			$char['Dexterity'] = 700000;
			$char['Vitality'] = 700000;
			$char['Energy'] = 700000;
			$char[COLUMN_COMMAND] = 700000;
		}
		
		switch($data['Set_Item'])
		{
			case 1 : $tooltip['Set_Item'] = "ancient"; break;
			case 2 : $tooltip['Set_Item'] = "excellent"; break;
			case 3 : $tooltip['Set_Item'] = "socket"; break;
			default : $tooltip['Set_Item'] = NULL; break;
		}
					
		if($data['Requirement'][0] > 0)
		{
			$noReq = $char['cLevel'] < $data['Requirement'][0] ? " class='no'" : NULL;
			$tooltip['Requirement'] .= "<li{$noReq}>".$this->ItemInfoString(1, 0)." ".$data['Requirement'][0]."</li>\\\n";
		}
		if($data['Requirement'][1] > 0)
		{
			$noReq = $char['Strength'] < $data['Requirement'][1] ? " class='no'" : NULL;
			$tooltip['Requirement'] .= "<li{$noReq}>".$this->ItemInfoString(1, 1)." ".$data['Requirement'][1]."</li>\\\n";
		}
		if($data['Requirement'][2] > 0)
		{
			$noReq = $char['Dexterity'] < $data['Requirement'][2] ? " class='no'" : NULL;
			$tooltip['Requirement'] .= "<li{$noReq}>".$this->ItemInfoString(1, 2)." ".$data['Requirement'][2]."</li>\\\n";
		}
		if($data['Requirement'][3] > 0)
		{
			$noReq = $char['Vitality'] < $data['Requirement'][3] ? " class='no'" : NULL;
			$tooltip['Requirement'] .= "<li{$noReq}>".$this->ItemInfoString(1, 3)." ".$data['Requirement'][3]."</li>\\\n";
		}
		if($data['Requirement'][4] > 0)
		{
			$noReq = $char['Energy'] < $data['Requirement'][4] ? " class='no'" : NULL;
			$tooltip['Requirement'] .= "<li{$noReq}>".$this->ItemInfoString(1, 4)." ".$data['Requirement'][4]."</li>\\\n";
		}
		if($data['Requirement'][5] > 0)
		{
			$noReq = $char['Command'] < $data['Requirement'][5] ? " class='no'" : NULL;
			$tooltip['Requirement'] .= "<li{$noReq}>".$this->ItemInfoString(1, 5)." ".$data[0]['Requirement'][5]."</li>\\\n";
		}
		
		if(isset($data['ClassUse']))
		{
			$tooltip['ClassUse'] = NULL;
			foreach($data['ClassUse'] as $key => $value)
			{
				$noClass = $value[1] == 1 ? " class='no'" : NULL;
				$tooltip['ClassUse']  .= "<li{$noClass}>".$this->ItemInfoString(0, 1)." ".$value[0]."</li>\\\n";
			}
		}
		
		$tooltip['Harmony'] = isset($data['Harmony']) ? "<p class='harmony'>".$data['Harmony']."</p><br />\\" : "\\";
		
		if(isset($data['Socket']))
		{
			$tooltip['Socket'] = "<span class='socketTitle'>".$this->ItemInfoString(3, 3)."</span>{#}{#}";
			$tooltip['Socket'] .= "<ul class='itemBlue'>\\\n";
			
			if($parse['SocketOption'][0][0] > -2)
				$tooltip['Socket'] .= "<li".(strstr($data['Socket'][0], "Free Slot") ? " class='socketFree'" : NULL).">".$data['Socket'][0]."</li>\\\n";
				
			if($parse['SocketOption'][1][0] > -2)
				$tooltip['Socket'] .= "<li".(strstr($data['Socket'][1], "Free Slot") ? " class='socketFree'" : NULL).">".$data['Socket'][1]."</li>\\\n";
				
			if($parse['SocketOption'][2][0] > -2)
				$tooltip['Socket'] .= "<li".(strstr($data['Socket'][2], "Free Slot") ? " class='socketFree'" : NULL).">".$data['Socket'][2]."</li>\\\n";
				
			if($parse['SocketOption'][3][0] > -2)
				$tooltip['Socket'] .= "<li".(strstr($data['Socket'][3], "Free Slot") ? " class='socketFree'" : NULL).">".$data['Socket'][3]."</li>\\\n";
				
			if($parse['SocketOption'][4][0] > -2)
				$tooltip['Socket'] .= "<li".(strstr($data['Socket'][4], "Free Slot") ? " class='socketFree'" : NULL).">".$data['Socket'][4]."</li>\\\n";
				
			$tooltip['Socket'] .= "</ul>\\";
		}
		else $tooltip['Socket'] = NULL;
		
		return array("Name" => $data['Name'], "Tooltip" => $tooltip);
	}
}