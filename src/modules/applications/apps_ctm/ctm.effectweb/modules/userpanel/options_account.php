<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Application User Control Panel - Account Options
 * Last Update: 28/07/2012 - 13:55h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class UserPanel_Account extends CTM_EffectWeb_UserPanel
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
	 *	Option: Home
	 *	Show the account informations
	 *
	 *	@return	void
	*/
	public function Home()
	{
		$GLOBALS['userpanel']['home_informations']['member_id'] = "#".$this->userData['info']['memb_guid'];
		$GLOBALS['userpanel']['home_informations']['member_login'] = $this->userData['info']['memb___id'];
		$GLOBALS['userpanel']['home_informations']['member_coin'][1] = number_format($this->userData['coin'][COIN_COLUMN_1], 0, false, ".");
		$GLOBALS['userpanel']['home_informations']['member_coin'][2] = number_format($this->userData['coin'][COIN_COLUMN_2], 0, false, ".");
		$GLOBALS['userpanel']['home_informations']['member_coin'][3] = number_format($this->userData['coin'][COIN_COLUMN_3], 0, false, ".");
		$GLOBALS['userpanel']['home_informations']['member_level'] = $this->functions->AccountLevel($this->userData['vip'][VIP_COLUMN]);
		$GLOBALS['userpanel']['home_informations']['member_vip']['begin'] = $this->functions->MakeVIPTime($this->userData['vip'][VIP_BEGIN]);
		$GLOBALS['userpanel']['home_informations']['member_vip']['end'] = $this->functions->MakeVIPTime($this->userData['vip'][VIP_TIME]);
		$GLOBALS['userpanel']['home_informations']['member_birth'] = $this->userData['info']['MemberBirth'];
		
		$GLOBALS['userpanel']['home_lastconnection']['date'] = date("d/m/Y", $lastConnectionTime = strtotime($this->userData['stat']['ConnectTM']));
		$GLOBALS['userpanel']['home_lastconnection']['hour'] = date("H:i:s", $lastConnectionTime);
		$GLOBALS['userpanel']['home_lastconnection']['server'] = $this->functions->GetServerName($this->userData['stat']['ServerName']);
		$GLOBALS['userpanel']['home_lastconnection']['ip'] = $this->userData['stat']['IP'];
		$GLOBALS['userpanel']['home_lastconnection']['status'] = $this->userData['stat']['ConnectStat'];
		
		$queryString = "SELECT ".MUGEN_CORE.".dbo.Character.Name, ".MUGEN_CORE.".dbo.Character.Class, ".MUGEN_CORE.".dbo.Character.cLevel";
		$queryString .= ", ".MUGEN_CORE.".dbo.GuildMember.G_Name FROM ".MUGEN_CORE.".dbo.Character LEFT JOIN ".MUGEN_CORE.".dbo.GuildMember";
		$queryString .= " ON (".MUGEN_CORE.".dbo.GuildMember.Name = ".MUGEN_CORE.".dbo.Character.Name) WHERE ".MUGEN_CORE.".dbo.Character.AccountID = '%s'";
		
		$this->DB->Arguments(USER_ACCOUNT);
		$this->DB->Query($queryString, $accountChars);
		
		if($this->DB->CountRows($accountChars) > 0)
		{
			$GLOBALS['userpanel']['home_characters'] = array();
			
			while($charData = $this->DB->FetchObject($accountChars))
			{
				$GLOBALS['userpanel']['home_characters'][] = array
				(
					"name" => $charData->Name,
					"class" => $this->functions->ClassInfo($charData->Class),
					"level" => $charData->cLevel,
					"guild" => strlen($charData->G_Name) > 0 ? $charData->G_Name : $this->lang->words['Words']['None']
				);
			}
		}
		
		if($this->userData['info']['bloc_code'] == 1 && $this->userData['info']['MemberStatus'] == 0)
		{
			$this->DB->Arguments(USER_ACCOUNT);
			$accountBlockInfoQ = $this->DB->Select("Responsible,Expiration,Reason", "CTM_AccountsBanneds", "Account = '%s'");
			
			if($this->DB->CountRows($accountBlockInfoQ) > 0)
			{
				$accountBlockInfo = $this->DB->FetchObject($accountBlockInfoQ);
				
				$GLOBALS['userpanel']['home_block_info']['responsible'] = $accountBlockInfo->Responsible;
				$GLOBALS['userpanel']['home_block_info']['expiration'] = date("d/m/Y - H:i", $accountBlockInfo->Expiration);
				$GLOBALS['userpanel']['home_block_info']['reason'] = CTM_Text::UTF8Text($accountBlockInfo->Reason);
			}
			else
			{
				$GLOBALS['userpanel']['home_block_info']['responsible'] = $this->lang->words['Words']['None'];
				$GLOBALS['userpanel']['home_block_info']['expiration'] = $this->lang->words['Words']['Never'];
				$GLOBALS['userpanel']['home_block_info']['reason'] = $this->lang->words['Words']['None'];
			}
		}
		
		$GLOBALS['userpanel']['home_chars_blocked'] = array();
		
		$queryString = "SELECT ".MUGEN_CORE.".dbo.Character.Name, CTM_CharactersBanneds.Expiration FROM ".MUGEN_CORE.".dbo.Character";
		$queryString .= " LEFT JOIN dbo.CTM_CharactersBanneds ON (CTM_CharactersBanneds.Account = ".MUGEN_CORE.".dbo.Character.AccountID)";
		$queryString .= " WHERE ".MUGEN_CORE.".dbo.Character.AccountID = '%s' AND CtlCode = 1";
		
		$this->DB->Arguments(USER_ACCOUNT);
		$charsBlockedQ = $this->DB->Select("Name", MUGEN_CORE."@Character", "AccountID = '%s' AND CtlCode = 1");
		
		if($this->DB->CountRows($charsBlockedQ) > 0)
		{
			while($charsBlocked = $this->DB->FetchArray($charsBlockedQ))
			{
				$this->DB->Arguments($charsBlocked['Name']);
				$findExpiration = $this->DB->Select("Expiration", "CTM_CharactersBanneds", "Character = '%s'");
				$findExpiration = $this->DB->CountRows($findExpiration) > 0 ? $this->DB->FetchRow($findExpiration) : array(0);
			
				$expiration = strlen($findExpiration[0]) <> 10 ? $this->lang->words['Words']['Ever'] : date("d/m/Y - H:i", $findExpiration[0]);
				$GLOBALS['userpanel']['home_chars_blocked'][] = sprintf($this->lang->words['UserPanel']['Home']['CharBlocked'], $charsBlocked['Name'], $expiration);
			}
		}
	}
	/**
	 *	Option: Change Data
	 *	Change the data from account
	 *
	 *	@return	void
	*/
	public function ChangeData()
	{
		$error = $this->LoadClass("Error", "class_sources");
		
		$GLOBALS['userpanel']['change_data_infos']['name'] = $this->userData['info']['memb_name'];
		$GLOBALS['userpanel']['change_data_infos']['phone'] = $this->userData['info']['tel__numb'];
		$GLOBALS['userpanel']['change_data_infos']['mail'] = $this->userData['info']['mail_addr'];
		
		$this->lang->setArguments("UserPanel,ChangeData,Password,SecureQuestion", $this->userData['info']['fpas_ques']);
		
		switch($_GET['process'])
		{
			case "data" :
				if(empty($_POST['Name']))
					$error->addError($this->lang->words['UserPanel']['ChangeData']['Data']['Messages']['NULL_Name']);
				if(empty($_POST['Phone']))
					$error->addError($this->lang->words['UserPanel']['ChangeData']['Data']['Messages']['NULL_Phone']);
			
				if($error->count[0] > 0)
				{
					$message = $this->lang->words['UserPanel']['ChangeData']['Data']['Messages']['NULL_Message'];
					$message .= "<br /><br />".$error->showError();
					
					return setResult(showMessage($message, 1));
				}
				else
				{
					$this->MuLib('Member')->UpdateAccount(USER_ACCOUNT, array
					(
						"info" => array
						(
							"memb_name" => utf8_encode($_POST['Name']),
							"tel__numb" => $_POST['Phone']
						)
					));
	
					$this->WriteLog(array
					(
						"option" => "Change Data",
						"data" => array
						(
							"Process: Change Data",
							"New Name: ".$_POST['Name'],
							"New Phone: ".$_POST['Phone']
						),
					));
					
					Authentication::ReloadSession();
					return setResult(showMessage($this->lang->words['UserPanel']['ChangeData']['Data']['Messages']['Success'], 3));
				}
			break;
			case "password" :
				if(empty($_POST['CurrentPassword']))
					$error->addError($this->lang->words['UserPanel']['ChangeData']['Password']['Messages']['NULL_Password']);
				if(empty($_POST['NewPassword']))
					$error->addError($this->lang->words['UserPanel']['ChangeData']['Password']['Messages']['NULL_NewPassword']);
				if(empty($_POST['CNewPassword']))
					$error->addError($this->lang->words['UserPanel']['ChangeData']['Password']['Messages']['NULL_CNewPassword']);
				if(empty($_POST['SecureAnswer']))
					$error->addError($this->lang->words['UserPanel']['ChangeData']['Password']['Messages']['NULL_SecureAnswer']);
					
				if($error->count[0] > 0)
				{
					$message = $this->lang->words['UserPanel']['ChangeData']['Password']['Messages']['NULL_Message'];
					$message .= "<br /><br />".$error->showError();
					
					return setResult(showMessage($message, 1));
				}
				
				$this->DB->Arguments(USER_ACCOUNT, $_POST['CurrentPassword'], USE_MD5);
				$this->DB->Query("EXEC dbo.CTM_CheckAccount '%s','%s',%d", $checkPasswordQ);
				$checkPassword = $this->DB->FetchRow($checkPasswordQ);
			
				if(eregi("[^a-zA-Z0-9_!=?&-]", $_POST['NewPassword']))
					$error->addError($this->lang->words['UserPanel']['ChangeData']['Password']['Messages']['Error_Words'], 1);
				if(strcmp($_POST['NewPassword'], $_POST['CNewPassword']) <> 0)
					$error->addError($this->lang->words['UserPanel']['ChangeData']['Password']['Messages']['Error_Confirm'], 1);
				if("0x".bin2hex($checkPassword[0]) != "0x03")
					$error->addError($this->lang->words['UserPanel']['ChangeData']['Password']['Messages']['Error_Password'], 1);
				if(strcmp(strtolower($_POST['SecureAnswer']), strtolower($this->userData['info']['fpas_answ'])) <> 0)
					$error->addError($this->lang->words['UserPanel']['ChangeData']['Password']['Messages']['Error_Answer'], 1);
					
				if($error->count[1] > 0)
				{
					$message = $this->lang->words['UserPanel']['ChangeData']['Password']['Messages']['Error_Message'];
					$message .= "<br /><br />".$error->showError(1);
					
					return setResult(showMessage($message, 2));
				}
				else
				{
					$this->MuLib('Member')->ChangePassword(USER_ACCOUNT, $_POST['NewPassword']);
					$this->WriteLog(array
					(
						"option" => "Change Data",
						"data" => array
						(
							"Process: Change Password"
						),
					));
					
					return setResult(showMessage($this->lang->words['UserPanel']['ChangeData']['Password']['Messages']['Success'], 3));
				}
			break;
			default :
				if(loadIsAjax() == true && LOADING_PAGE_AJAX == false)
					exit();
			break;
		}
	}
	/**
	 *	Option: Change Mail
	 *	Change the e-mail from account
	 *
	 *	@return	void
	*/
	public function ChangeMail()
	{
		switch($_GET['do'])
		{
			case "send_code" :
				$currentId = $this->DB->GetCurrentId("CTM_ChangeMail") + 1;
				$dechex = create_function("\$integer", "return str_pad(dechex(\$integer >= 255 ? 255 : \$integer), 2, 0, STR_PAD_LEFT);");
							
				$confirmCode = $dechex($currentId);
				$confirmCode .= ":".$dechex(0xBB - strlen($this->userData['memb___id']) + mt_rand(0, 50));
				$confirmCode .= ":".$dechex(strlen($this->userData['mail_addr']) + mt_rand(0, 50));
				$confirmCode .= ":".$dechex(mt_rand(0, 70));
				$confirmCode .= ":".$dechex(mt_rand(71, 170));
				$confirmCode .= ":".$dechex(0xBB / intval(date("d")) + intval(date("H")) + intval(date("m")) + intval(date("s")) + mt_rand(0, 50));
				$confirmCode .= ":".$dechex(0xBB / intval(date("m")) + intval(date("H")) + intval(date("m")) + intval(date("s")) + mt_rand(0, 50));
				$confirmCode .= ":".$dechex(intval(date("Y")) / 0xBB + intval(date("H")) + intval(date("m")) + intval(date("s")) + mt_rand(0, 50));
						
				$confirmCode = strtoupper($confirmCode);
				$link = gerateFullLink("?/userpanel/changeMail");
				
				$this->DB->Insert("CTM_ChangeMail", array
				(
					"Account" => $this->userData['info']['memb___id'],
					"ConfirmCode" => $confirmCode,
					"Expiration" => strtotime("+ 24 hours")
				));
					
				$this->email->arguments = array
				(
					"NAME" => htmlEncode($this->userData['info']['memb_name']),
					"CONFIRM_CODE" => $confirmCode,
					"SYSTEM_LINK" => $link
				);
				$this->email->LoadTemplate("ChangeMemberMail");
				$this->email->GetMailContent($mail);
				
				$this->mailer->AddAddress($this->userData['info']['mail_addr'], $this->userData['info']['memb_name']);
				$this->mailer->SetSubject($mail['subject']);
				$this->mailer->SetBody($mail['content']);
				
				if($this->mailer->SendMail() == true)
				{
					$this->WriteLog(array
					(
						"option" => "Change Mail",
						"data" => array
						(
							"Process: Send Confirm Code",
							"Result: Success"
						),
					));
					
					return setResult(showMessage($this->lang->words['UserPanel']['ChangeMail']['Messages']['SendCode']['Success'], 3));
				}
				else
				{
					$this->WriteLog(array
					(
						"option" => "Change Mail",
						"data" => array
						(
							"Process: Send Confirm Code",
							"Result: Error"
						),
					));
					
					$this->lang->setArguments("UserPanel,ChangeMail,Messages,Error_SendMail", CoreVariables::ErrorsCode()->SendMailError);
					return setResult(showMessage($this->lang->words['UserPanel']['ChangeMail']['Messages']['SendCode']['Error_SendMail'], 2));
				}
			break;
			case "process" :
				if(empty($_POST['NewMail']) || empty($_POST['ConfirmCode']))
					return setResult(showMessage($this->lang->words['UserPanel']['ChangeMail']['Messages']['Process']['Void'], 1));
					
				if(!CTM_Text::CheckMail($_POST['NewMail']))
					return setResult(showMessage($this->lang->words['UserPanel']['ChangeMail']['Messages']['Process']['MailInvalid'], 2));
					
				$this->DB->Arguments($_POST['ConfirmCode'], USER_ACCOUNT);
				$findConfirmCodeQ = $this->DB->Select("Expiration", "CTM_ChangeMail", "ConfirmCode = '%s' AND Account = '%s'");
				
				if($this->DB->CountRows($findConfirmCodeQ) < 1)
					return setResult(showMessage($this->lang->words['UserPanel']['ChangeMail']['Messages']['Process']['CodeInvalid'], 2));
					
				$findConfirmCode = $this->DB->FetchRow($findConfirmCodeQ);
				
				if(time() >= $findConfirmCode[0])
					return setResult(showMessage($this->lang->words['UserPanel']['ChangeMail']['Messages']['Process']['CodeExpired'], 2));
					
				$this->MuLib('Member')->UpdateAccount(USER_ACCOUNT, array("info" => array("mail_addr" => $_POST['NewMail'])));
				$this->DB->Arguments(USER_ACCOUNT, $_POST['ConfirmCode']);
				$this->DB->Delete("CTM_ChangeMail", "Account = '%s' AND ConfirmCode = '%s'");
				
				$this->WriteLog(array
				(
					"option" => "Change Mail",
					"data" => array
					(
						"Process: Change Mail",
						"New Mail: ".$_POST['NewMail']
					),
				));
					
				
				return setResult(showMessage($this->lang->words['UserPanel']['ChangeMail']['Messages']['Process']['Success'], 3));
			break;
			default :
				if(loadIsAjax() == true && LOADING_PAGE_AJAX == false)
					exit();
			break;
		}
	}
	/**
	 *	Option: Change Personal ID
	 *	Change the PID from account
	 *
	 *	@return	void
	*/
	public function ChangePersonalID()
	{
		$this->lang->setArguments("UserPanel,ChangePID,SecureQuestion", $this->userData['info']['fpas_ques']);
		
		if($_GET['write'] == true)
		{
			if(empty($_POST['Password']) || empty($_POST['SecureAnswer']) || empty($_POST['SetNewPID']))
				return setResult(showMessage($this->lang->words['UserPanel']['ChangePID']['Messages']['Void'], 1));
			elseif(!is_numeric($_POST['SetNewPID']))
				return setResult(showMessage($this->lang->words['UserPanel']['ChangePID']['Messages']['Error_Words'], 1));
			elseif(strlen($_POST['SetNewPID']) <> 7)
				return setResult(showMessage($this->lang->words['UserPanel']['ChangePID']['Messages']['Error_Length'], 1));

			$this->DB->Arguments(USER_ACCOUNT, $_POST['Password'], USE_MD5);
			$this->DB->Query("EXEC dbo.CTM_CheckAccount '%s','%s',%d", $checkPasswordQ);
			$checkPassword = $this->DB->FetchRow($checkPasswordQ);
			
			if("0x".bin2hex($checkPassword[0]) != "0x03")
				setResult(showMessage($this->lang->words['UserPanel']['ChangePID']['Messages']['Error_Password'], 2));	
			if(strcmp(strtolower($_POST['SecureAnswer']), strtolower($this->userData['info']['fpas_answ'])) <> 0)
				setResult(showMessage($this->lang->words['UserPanel']['ChangePID']['Messages']['Error_Answer'], 2));	
			
			$this->MuLib('Member')->UpdateAccount(USER_ACCOUNT, array("info" => array("sno__numb" => $_POST['SetNewPID'])));
			$this->WriteLog(array
			(
				"option" => "Change Personal ID",
			));
				
			Authentication::ReloadSession();
			return setResult(showMessage($this->lang->words['UserPanel']['ChangePID']['Messages']['Success'], 3));
		}
	}
	/**
	 *	Option: Virtual Vault
	 *	Virtual Vault for items
	 *
	 *	@return	void
	*/
	public function VirtualVault()
	{
		$virtualVault = $this->LoadClass("VirtualVault", "class_virtualvault");
		$virtualVault->OpenVault();
		
		switch($_GET['do'])
		{
			case 'transferToVirtual' :
				switch($virtualVault->TransferItemToVirtual($_GET['itemSerial']))
				{
					case "ERROR" :
						exit();
					break;
					case "VAULT_FULL" :
						$limit = $this->settings['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['ITEMS_LIMIT'][$this->userData['vip'][VIP_COLUMN]];
						$this->lang->setArguments("UserPanel,VirtualVault,Messages,VirtualFull", $limit);
						exit(showMessage($this->lang->words['UserPanel']['VirtualVault']['Messages']['VirtualFull'], 2));
					break;
					case "ALL_OK" :
						exit("<script>transferItemVault('".$_GET['itemSerial']."');</script>");
					break;
					default :
						exit();
					break;
				}
			break;
			case "transferToVault" :
				switch($virtualVault->TransferItemToGame($_GET['itemSerial']))
				{
					case "ERROR" :
						exit();
					break;
					case "VAULT_FULL" :
						exit(showMessage($this->lang->words['UserPanel']['VirtualVault']['Messages']['VaultFull'], 2));
					break;
					case "ALL_OK" :
						exit("<script>transferItemVirtual('".$_GET['itemSerial']."');</script>");
					break;
					default :
						exit();
					break;
				}
			break;
			default :
				$items = $virtualVault->LoadItemsVaults();
				$GLOBALS['userpanel']['virtual_vault']['game_vault_items'] = $items['GameVault'];
				$GLOBALS['userpanel']['virtual_vault']['virtual_vault_items'] = $items['VirtualVault'];
			break;
		}
	}
	/**
	 *	Option: Manage Character
	 *	Select a char for manage
	 *
	 *	@return	void
	*/
	public function ManageChar()
	{
		if($_GET['write'] == true)
		{
			if(empty($_GET['character']))
				return exit(showMessage($this->lang->words['UserPanel']['ManageChar']['Messages']['Select'], 1));
				
			if(!$this->functions->CheckCharacter(urldecode($_GET['character'])))
				return exit(showMessage($this->lang->words['UserPanel']['ManageChar']['Messages']['Invalid'], 2));
				
			$_SESSION['USERCP_CHARACTER_SELECTED'] = urldecode($_GET['character']);
			exit("<script>window.location='?app=core&module=userpanel&option=viewCharacter';</script>");
		}
		
		$GLOBALS['userpanel']['manage_char']['characters'] = array();
		
		$c = MUGEN_CORE.".dbo.Character";
		$g = MUGEN_CORE.".dbo.GuildMember";
		$finalQ = "JOIN {$g} ON ({$g}.Name = {$c}.Name) WHERE {$c}.AccountID = '%s'";
		
		$this->DB->Arguments(USER_ACCOUNT); 
		$this->DB->Query("SELECT {$c}.Name,{$c}.cLevel,{$g}.G_Name,{$c}.".COLUMN_CHARIMAGE." FROM {$c} {$finalQ}", $charactersQ);
		
		if(($GLOBALS['userpanel']['manage_char']['count_chars'] = $this->DB->CountRows($charactersQ)) > 0)
		{
			 while($character = $this->DB->FetchObject($charactersQ))
			 {
				 $GLOBALS['userpanel']['manage_char']['characters'][] = array
				 (
				 	"name" => $character->Name,
					"level" => $character->cLevel,
					"guild" => $character->G_Name,
					"image" => $this->functions->GetCharImage($character->{COLUMN_CHARIMAGE})
				 );
			 }
		}
	}
	/**
	 *	Option: Disconnect from Game
	 *	Connect to JoinServer and disconnect the player
	 *
	 *	@return	void
	*/
	public function DisconnectGame()
	{
		if($_GET['do'] == "process")
		{
			if($this->userData['stat']['ConnectStat'] == 0)
				return setResult(showMessage($this->lang->words['UserPanel']['DisconnectGame']['Messages']['Offline'], 2));
				
			if(!$this->MuLib('JoinServer')->init())
				return setResult(showMessage(sprintf($this->lang->words['UserPanel']['DisconnectGame']['Messages']['Error'], CoreVariables::ErrorsCode()->JoinServerFail), 2));
				
			$this->MuLib('JoinServer')->ForceLogout(USER_ACCOUNT);
			return setResult(showMessage($this->lang->words['UserPanel']['DisconnectGame']['Messages']['Success'], 3));
		}
		
		$GLOBALS['userpanel']['disconnect_game']['status'] = $this->userData['stat']['ConnectStat'];
	}
}