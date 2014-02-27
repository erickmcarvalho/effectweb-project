<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Application User Control Panel
 * Last Update: 06/08/2012 - 17:39h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_UserPanel extends CTM_EWCore
{
	/**
	 *	Section Class
	 *
	 *	@access	private
	 *	@var	array
	*/
	private $sectionClass		= array();
	/**
	 *	Permission Error
	 *
	 *	@access	private
	 *	@var	boolean
	*/
	private $permissionError	= FALSE;
	/**
	 *	Not Load Page
	 *
	 *	@access	private
	 *	@var	boolean
	*/
	private $notLoadPage		= FALSE;
	/**
	 *	Not Load General
	 *
	 *	@access	private
	 *	@var	bolean
	*/
	private $notLoadGeneral		= FALSE;
	/**
	 *	User Data
	 *
	 *	@access	protected
	 *	@var	array
	*/
	protected $userData			= array();
	/**
	 *	Character Selected
	 *
	 *	@access	protected
	 *	@var	string
	*/
	protected $character		= NULL;
	/**
	 *	This Option
	 *
	 *	@access	protected
	 *	@var	string
	*/
	protected $thisOption		= NULL;
		
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		if(!SESSION_USER_LOGGED)
			return exit("<script>window.location='?app=core&module=global&section=login';</script>");
			
		$this->lang->loadLanguageFile("userpanel");
		$this->FactoryCP();
		
		$GLOBALS['userpanel']['this_option'] = $this->thisOption;
		$GLOBALS['userpanel']['character'] = $this->character;
		$GLOBALS['userpanel']['user_level'] = $this->userData['vip'][VIP_COLUMN];
		
		switch($GLOBALS['userpanel']['this_option'])
		{
			case "home" :
				$this->LoadClass("Account", "options_account")->Home();
				$this->LoadPage("option_home");
				$this->AjaxSetLoad(loadIsAjax() == true);
			break;
			case "changeData" :
				if($this->CheckPermission("ACCOUNT,CHANGE_DATA", true, true, true, true, false) == true)
				{
					$this->LoadClass("Account", "options_account")->ChangeData();
					$this->LoadPage("option_changeData");
				}
			break;
			case "changeMail" :
				if($this->CheckPermission("ACCOUNT,CHANGE_MAIL", true, true, true, true, false) == true)
				{
					$this->LoadClass("Account", "options_account")->ChangeMail();
					$this->LoadPage("option_changeMail");
				}
			break;
			case "changePID" :
				if($this->CheckPermission("ACCOUNT,CHANGE_PID", true, true, true, true, false) == true)
				{
					$this->LoadClass("Account", "options_account")->ChangePersonalID();
					$this->LoadPage("option_changePID");
				}
			break;
			case "virtualVault" :
				if($this->CheckPermission("ACCOUNT,VIRTUAL_VAULT", true, true, true, true, false, "#3:virtualVault") == true)
				{
					$this->LoadClass("Account", "options_account")->VirtualVault();
					$this->LoadPage("option_virtualVault");
				}
			break;
			case "manageChar" :
				if($this->CheckPermission("ACCOUNT,MANAGE_CHAR", false, false, true, false, false) == true)
				{
					$this->LoadClass("Account", "options_account")->ManageChar();
					$this->LoadPage("option_manageChar");
				}
			break;
			case "disconnectGame" :
				if($this->CheckPermission("ACCOUNT,DISCONNECT_GAME", true, true, true, false, false, "license:2") == true)
				{
					$this->LoadClass("Account", "options_account")->DisconnectGame();
					$this->LoadPage("option_disconnectGame");
				}
			break;
			case "viewCharacter" :
				if($this->CheckPermission("CHARACTER,VIEW_CHARACTER", false, false, false, false, true) == true)
				{
					$this->LoadClass("Character", "options_character")->ViewCharacter();
					$this->LoadPage("option_viewCharacter");
				}
			break;
			case "resetSystem" :
				if($this->CheckPermission("CHARACTER,RESET_SYSTEM", true, true, true, true, true) == true)
				{
					$this->LoadClass("Character", "options_character")->ResetSystem();
					$this->LoadPage("option_resetSystem");
				}
			break;
			case "masterReset" :
				if($this->CheckPermission("CHARACTER,MASTER_RESET", true, true, true, true, true) == true)
				{
					$this->LoadClass("Character", "options_character")->MasterReset();
					$this->LoadPage("option_masterReset");
				}
			break;
			case "transferResets" :
				if($this->CheckPermission("CHARACTER,TRANSFER_RESETS", true, true, true, true, true) == true)
				{
					$this->LoadClass("Character", "options_character")->TransferResets();
					$this->LoadPage("option_transferResets");
				}
			break;
			case "clearPk" :
				if($this->CheckPermission("CHARACTER,CLEAR_PK", true, true, true, true, true) == true)
				{
					$this->LoadClass("Character", "options_character")->ClearPk();
					$this->LoadPage("option_clearPk");
				}
			break;
			case "changeClass" :
				if($this->CheckPermission("CHARACTER,CHANGE_CLASS", true, true, true, true, true) == true)
				{
					$this->LoadClass("Character", "options_character")->ChangeClass();
					$this->LoadPage("option_changeClass");
				}
			break;
			case "changeName" :
				if($this->CheckPermission("CHARACTER,CHANGE_NAME", true, true, true, true, true) == true)
				{
					$this->LoadClass("Character", "options_character")->ChangeName();
					$this->LoadPage("option_changeName");
				}
			break;
			case "moveCharacter" :
				if($this->CheckPermission("CHARACTER,MOVE_CHARACTER", true, true, true, true, true) == true)
				{
					$this->LoadClass("Character", "options_character")->MoveCharacter();
					$this->LoadPage("option_moveCharacter");
				}
			break;
			case "manageProfile" :
				if($this->CheckPermission("CHARACTER,MANAGE_PROFILE", true, true, true, false, true) == true)
				{
					$this->LoadClass("Character", "options_character")->ManageProfile();
					$this->LoadPage("option_manageProfile");
				}
			break;
			case "changeAvatar" :
				if($this->CheckPermission("CHARACTER,CHANGE_AVATAR", true, true, true, false, true) == true)
				{
					$this->LoadClass("Character", "options_character")->ChangeAvatar();
					$this->LoadPage("option_changeAvatar");
				}
			break;
			case "repairPoints" :
				if($this->CheckPermission("CHARACTER,REPAIR_POINTS", true, true, true, true, true) == true)
				{
					$this->LoadClass("Character", "options_character")->RepairPoints();
					$this->LoadPage("option_repairPoints");
				}
			break;
			case "redistributePoints" :
				if($this->CheckPermission("CHARACTER,REDISTRIBUTE_POINTS", true, true, true, true, true) == true)
				{
					$this->LoadClass("Character", "options_character")->RedistributePoints();
					$this->LoadPage("option_redistributePoints");
				}
			break;
			case "distributePoints" :
				if($this->CheckPermission("CHARACTER,DISTRIBUTE_POINTS", true, true, true, true, true) == true)
				{
					$this->LoadClass("Character", "options_character")->DistributePoints();
					$this->LoadPage("option_distributePoints");
				}
			break;
			case "clearCharacter" :
				if($this->CheckPermission("CHARACTER,CLEAR_CHARACTER", true, true, true, true, true) == true)
				{
					$this->LoadClass("Character", "options_character")->ClearCharacter();
					$this->LoadPage("option_clearCharacter");
				}
			break;
			case "supportTickets" :
				if($this->CheckPermission("SUPPORT,TICKETS", true, true, true, true, false, "license:1") == true)
				{
					$this->LoadClass("Support", "options_support")->SupportTickets();
					$this->LoadPage("option_supportTickets");
				}
			break;
			case "invoices" :
				if($this->CheckPermission("FINANCIAL,INVOICES", true, true, true, true, false) == true)
				{
					$this->LoadClass("Financial", "options_financial")->Invoices();
					$this->LoadPage("option_invoices");
				}
			break;
			case "convertCoin" :
				if($this->CheckPermission("FINANCIAL,CONVERT_COIN", true, true, true, true, false) == true)
				{
					$this->LoadClass("Financial", "options_financial")->ConvertCoin();
					$this->LoadPage("option_convertCoin");
				}
			break;
			case "buyVIP" :
				if($this->CheckPermission("FINANCIAL,BUY_VIP", true, true, true, true, false) == true)
				{
					$this->LoadClass("Financial", "options_financial")->BuyVIP();
					$this->LoadPage("option_buyVIP");
				}
			break;
			default :
				$this->LoadClass("Account", "options_account")->Home();
				$this->LoadPage("option_home");
				$this->AjaxSetLoad(false);
			break;
		}
		
		if($this->permissionError == false)
		{
			$this->GlobalModules();
			$this->LoadPage();
		}
	}
	/**
	 *	Protected: Factory CP
	 *	Load the user cp modules
	 *
	 *	@return	void
	*/
	protected function FactoryCP()
	{
		$this->thisOption = $_GET['option'] ? $_GET['option'] : $this->URLData[1];
		
		$this->userData = Authentication::GetAuthData();
		$this->userData = $this->userData['ACCOUNT'];
		
		if(!empty($_SESSION['USERCP_CHARACTER_SELECTED']))
			$this->character = $_SESSION['USERCP_CHARACTER_SELECTED'];
	}
	/**
	 *	Protected: Load Class
	 *	Load user panel class module
	 *
	 *	@param	string	Class name
	 *	@param	string	Class file
	 *	@return	class|bool
	*/
	protected function LoadClass($class_name, $class_file)
	{
		if(!$this->sectionClass[$class_name])
		{
			if(!file_exists(THIS_APPLICATION_PATH."modules/userpanel/".$class_file.".php"))
				return false;
				
			require_once(THIS_APPLICATION_PATH."modules/userpanel/".$class_file.".php");
			$load_class = "UserPanel_".$class_name;
			
			$this->sectionClass[$class_name] = new $load_class();
			$this->sectionClass[$class_name]->initClass();
		}
		
		return $this->sectionClass[$class_name] ? $this->sectionClass[$class_name] : false;
	}
	/**
	 *	Protected: Load Page
	 *	Load the skin cache of page
	 *
	 *	@param	string	Page name
	 *	@param	boolean	Block page load
	 *	@return	void
	*/
	protected function LoadPage($page_name = NULL, $notLoad = FALSE)
	{
		if($GLOBALS['local_usercp']['notLoadPage'] == false)
		{
			$real_page = empty($page_name) ? "global_header" : $page_name;
			$real_content = empty($page_name) ? "subContent" : "userpanelContent";
			
			$this->output->loadSkinCache("userpanel", $real_page, false, $real_content);
			$GLOBALS['local_usercp']['notLoadPage'] = $notLoad;
			
			$this->AjaxSetLoad();
		}
		else
		{
			$this->NotLoadGeneral(true);
		}
	}
	/**
	 *	Protected: Write Log
	 *	Write in log file
	 *
	 *	@param	array	Log String
	 *	@param	boolean	Character Option
	 *	@return	void
	*/
	protected function WriteLog($writeString)
	{
		if(!file_exists(EW_LOG_PATH."UserPanel/"))
			mkdir(EW_LOG_PATH."UserPanel/");
			
		if($fp = fopen(EW_LOG_PATH."UserPanel/".date("d-m-Y").EW_LOG_EXT, "a+"))
		{
			$GLOBALS['begin'] = "[".date("H:i:s")."] ";
			$log = create_function("\$string", "global \$begin; return \$begin.\$string.'\r\n';");
			
			$writeLog = $log("Username: ".USER_ACCOUNT);
			$writeLog .= $writeString['character'] == true ? $log("Character: ".$this->character) : NULL;
			$writeLog .= $log("Option: ".$writeString['option']);
			
			if($writeString['data'] && count($writeString['data']) > 0)
			{
				$writeLog .= "\r\n";
				foreach($writeString['data'] as $string)
					$writeLog .= $log($string);
			}
			
			fwrite($fp, $writeLog."==========================================================================================\r\n");
			fclose($fp);
		}
	}
	/**
	 *	Protected: Not Load General Modules
	 *	Block the loading of genenal modules
	 *
	 *	@param	boolean	Set not of yes
	 *	@return	void
	*/
	protected function NotLoadGeneral($set)
	{
		$this->notLoadGeneral = $set;
	}
	/**
	 *	Private: Ajax Set Load
	 *	Set the permission for load page by ajax
	 *
	 *	@return	void
	*/
	private function AjaxSetLoad($notLoadGeneral = true)
	{
		if(loadIsAjax() == true)
			$this->NotLoadGeneral($notLoadGeneral);
	}
	/**
	 *	Private: Check Connect Stat
	 *	Check if the user is logged in game
	 *
	 *	@return	boolean
	*/
	private function CheckConnectStat()
	{
		$this->DB->Arguments(USER_ACCOUNT);
		$this->DB->Query("SELECT ConnectStat FROM ".MUACC_CORE.".dbo.MEMB_STAT WHERE memb___id = '%s'", $check_logged_query);
		
		if($this->DB->CountRows($check_logged_query) < 1)
			return false;

		$fetch = $this->DB->FetchRow($check_logged_query);
		
		return $fetch[0] == 1;
	}
	/**
	 *	Private: Check UserCP Permission
	 *	Check the permission from account in CP page
	 *
	 *	@param	string	The option
	 *	@param	boolean	Check if is enabled
	 *	@param	boolean	Check the privilegy
	 *	@param	boolean	Check if is blocked
	 *	@param	boolean	Check if is connected
	 *	@param	boolean	Check the character
	 *	@param	boolean	Check the license
	 *	@return	boolean
	*/
	private function CheckPermission($option, $enabled = FALSE, $privilegy = FALSE, $blocked = FALSE, $connected = FALSE, $character = FALSE)
	{
		if(count(($option = explode(",", $option))) == 2)
		{			
			/* Option enabled? */
			if($enabled == true)
			{
				if($this->settings['USERPANEL']['PERMISSION'][$option[0]][$option[1]][0] == false)
				{
					$this->output->showError($this->lang->words['UserPanel']['Global']['Messages']['OptionDisabled']);
					$this->permissionError = true;
					$this->AjaxSetLoad();
					
					return false;
				}
			}
			
			/* You have privilegy? */
			if($privilegy == true)
			{
				if($this->settings['USERPANEL']['PERMISSION'][$option[0]][$option[1]][$this->userData['vip'][VIP_COLUMN] + 1] == false)
				{
					$this->output->showError($this->lang->words['UserPanel']['Global']['Messages']['Privilegy']);
					$this->permissionError = true;
					$this->AjaxSetLoad();
					
					return false;
				}
			}
			
			/* You is blocked? */
			if($blocked == true)
			{
				if($this->functions->AccountBlocked(USER_ACCOUNT) == true)
				{
					$this->output->showError($this->lang->words['UserPanel']['Global']['Messages']['Blocked']);
					$this->permissionError = true;
					$this->AjaxSetLoad();
					
					return false;
				}
			}
			
			/* Is connected in game? */
			if($connected == true)
			{
				if($this->CheckConnectStat() == true)
				{
					$this->output->showError($this->lang->words['UserPanel']['Global']['Messages']['Connected']);
					$this->permissionError = true;
					$this->AjaxSetLoad();
					
					return false;
				}
			}
			
			/* Is with character selected and is your? */
			if($character == true)
			{
				if(empty($_SESSION['USERCP_CHARACTER_SELECTED']))
				{
					$this->LoadClass("Account", "options_account")->ManageChar();
					$this->LoadPage("option_manageChar");
					
					return false;
				}
				else
				{
					$this->DB->Arguments($_SESSION['USERCP_CHARACTER_SELECTED'], USER_ACCOUNT);
					$this->DB->Query("SELECT 1 FROM ".MUGEN_CORE.".dbo.Character WHERE Name = '%s' AND AccountID = '%s'", $checkCharacterQ);
					
					if($this->DB->CountRows($checkCharacterQ) < 1)
					{
						$this->LoadClass("Account", "options_account")->ManageChar();
						$this->LoadPage("option_manageChar");
						
						unset($_SESSION['USERCP_CHARACTER_SELECTED']);
						return false;
					}
				}
			}
			
			/* All ok */
			return true;
		}
	}
	/**
	 *	Private: User Panel Global Modules
	 *
	 *	@return	void
	*/
	private function GlobalModules()
	{
		if(loadIsAjax() == true && $this->notLoadGeneral == true)
			exit($this->output->returnContent(false, "userpanelContent"));
		
		if($this->notLoadGeneral == false)
		{
			$GLOBALS['userpanel']['content'] = $this->output->returnContent(false, "userpanelContent");
			require_once(THIS_APPLICATION_PATH."sources/variables/userpanel_options.php");
			
			foreach($userpanel_options as $key => $options)
			{
				foreach($options as $name => $value)
				{
					if($value['privilegy'] == true)
					{
						$GLOBALS['userpanel']['permissions'][$name] = array
						(
							0 => $this->settings['USERPANEL']['PERMISSION'][$key][$name][1] == true ? 1 : 0,
							1 => $this->settings['USERPANEL']['PERMISSION'][$key][$name][2] == true ? 1 : 0,
							2 => $this->settings['USERPANEL']['PERMISSION'][$key][$name][3] == true ? 1 : 0,
							3 => $this->settings['USERPANEL']['PERMISSION'][$key][$name][4] == true ? 1 : 0,
							4 => $this->settings['USERPANEL']['PERMISSION'][$key][$name][5] == true ? 1 : 0,
							5 => $this->settings['USERPANEL']['PERMISSION'][$key][$name][6] == true ? 1 : 0
						);
					}
				}
			}
		}
	}
}