<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Register Account
 * Last Update: 17/07/2012 - 03:08h
 * Author: $CTM['Erick-Master']['Litlle']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Register_RegisterAccount extends CTM_EWCore
{
	/**
	 *	Init Moduçe
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		if(!SESSION_USER_LOGGED)
		{
			$this->loadAjaxCheckFields();
			$this->loadRegisterAccount();
			$this->loadRegisterSetVars();

			$this->output->loadSkinCache("register", "registerAccount");
		}
		else
		{
			$this->output->showError($this->lang->words['Register']['LoggedError']);
		}
	}
	/**
	 *	Register Account
	 *
	 *	@return	void
	*/
	private function loadRegisterAccount()
	{
		if($_GET['write'] == true)
		{
			if($_POST['Terms'] != 1)
				setResult(showMessage($this->lang->words['Register']['Register']['Messages']['CheckTerms'], 2));
			else
			{
				$error = NULL;
				$finishRegister = FALSE;
				$PID = $this->settings['REGISTER']['REGISTER_PID'];
				
				/* Variables to lower */
				$_POST['Login'] = strtolower($_POST['Login']);
				$_POST['Mail'] = strtolower($_POST['Mail']);
				$_POST['CMail'] = strtolower($_POST['CMail']);
		
				/* Check Void Fields */
				if(empty($_POST['Login'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_Login']."<br />\n";
				if(empty($_POST['Password'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_Password']."<br />\n";
				if(empty($_POST['CPassword'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_CPassword']."<br />\n";
				if(empty($_POST['Mail'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_Mail']."<br />\n";
				if(empty($_POST['CMail'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_CMail']."<br />\n";
				if(empty($_POST['PersonalID']) && $PID) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_PID']."<br />\n";
				if(empty($_POST['Name'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_Name']."<br />\n";
				if(empty($_POST['Phone'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_Phone']."<br />\n";
				if(empty($_POST['Sex'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_Sex']."<br />\n";
				if(empty($_POST['BirthDay'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_BirthDay']."<br />\n";
				if(empty($_POST['BirthMonth'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_BirthMonth']."<br />\n";
				if(empty($_POST['BirthYear'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_BirthYear']."<br />\n";
				if(empty($_POST['SecureQuestion'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_SecureQuestion']."<br />\n";
				if(empty($_POST['SecureAnswer'])) $error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['NULL_SecureAnswer']."<br />\n";
				if(empty($_POST['Captcha'])) $error .= "&raquo; ".$this->lang->words['Global']['Captcha']['Messages']['Void'];
				
				if(strlen($error) > 0)
					return setResult(showMessage($this->lang->words['Register']['Register']['Messages']['NULL_Message']."<br /><br />".$error, 1));
					
				/* Check Error Fields */
				if(!CTM_Captcha::Check($_POST['Captcha']))
					$error .= "&raquo; ".$this->lang->words['Global']['Captcha']['Messages']['Invalid']."<br />\n";
					
				if(strlen($_POST['Login']) <= 3 || strlen($_POST['Login']) > 10)
					$error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Error_LoginLength']."<br />\n";
					
				if(strlen($_POST['Password']) <= 3 || strlen($_POST['Password']) > 10)
					$error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Error_PassLength']."<br />\n";
					
				if(strlen($_POST['PersonalID']) <> 7  && $PID)
					$error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Error_PIDLength']."<br />\n";
				
				if(eregi("[^a-zA-Z0-9_!=?&-]", $_POST['Login']))
					$error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Error_LoginWords']."<br />\n";
					
				if(eregi("[^a-zA-Z0-9_!=?&-]", $_POST['Password']))
					$error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Error_PassWords']."<br />\n";
					
				if(!CTM_Text::checkMail($_POST['Mail']))
					$error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Error_MailWords']."<br />\n";
					
				if(!is_numeric($_POST['PersonalID']) && $PID)
					$error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Error_PIDWords']."<br />\n";
				
				if(strcmp($_POST['Password'], $_POST['CPassword']) <> 0)
					$error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Error_ConfirmPass']."<br />\n";
					
				if(strcmp($_POST['Mail'], $_POST['CMail']) <> 0)
					$error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Error_ConfirmMail']."<br />\n";
				
				$this->DB->Arguments($_POST['Login']);
				$this->DB->Query("SELECT 1 FROM ".MUACC_CORE.".dbo.MEMB_INFO WHERE LOWER(memb___id) = '%s'", $checkLoginQ);
				
				if($this->DB->CountRows($checkLoginQ) > 0)
					$error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Error_LoginExists']."<br />\n";
					
				$this->DB->Arguments($_POST['Mail']);
				$this->DB->Query("SELECT 1 FROM ".MUACC_CORE.".dbo.MEMB_INFO WHERE LOWER(mail_addr) = '%s'", $checkMailQ);
				
				if($this->DB->CountRows($checkMailQ) > 0)
					$error .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Error_MailExists']."<br />\n";
				
				if(strlen($error) > 0)
					return setResult(showMessage($this->lang->words['Register']['Register']['Messages']['Error_Message']."<br /><br />".$error, 2));
				
				/* Finish and save fields values */
				CTM_MuOnline::Lib('Member')->CreateAccount(array
				(
					"Name" => utf8_encode($_POST['Name']),
					"Login" => $_POST['Login'],
					"Password" => $_POST['Password'],
					"Mail" => $_POST['Mail'],
					"PID" => $PID ? $_POST['PersonalID'] : $this->settings['REGISTER']['DEFAULT_PID'],
					"Phone" => $_POST['Phone'],
					"Sex" => $_POST['Sex'],
					"Birth" => $_POST['BirthDay']."/".$_POST['BirthMonth']."/".$_POST['BirthYear'],
					"SecureQuestion" => array(utf8_encode($_POST['SecureQuestion']), utf8_encode($_POST['SecureAnswer'])),
					"Lock" => $this->settings['REGISTER']['CONFIRM_MAIL'] == true ? 1 : 0,
					"Status" => $this->settings['REGISTER']['CONFIRM_MAIL'] == true ? 1 : 0
				));
				
				$bonusCount = 0;
				$VIPBonus = FALSE;
				$coinBonus = FALSE;
				$vaultBonus = FALSE;
					
				if($this->settings['REGISTER']['VIP']['SWITCH'] == TRUE && $_POST['VIPBonus'] == 1)
				{
					$this->DB->Arguments($this->settings['REGISTER']['VIP']['TYPE'], $this->settings['REGISTER']['VIP']['TIME'], time(), $_POST['Login']);
					$this->DB->Query("UPDATE ".VIP_CORE.".dbo.".VIP_TABLE." SET ".VIP_COLUMN." = %d, ".VIP_TIME." = %d, ".VIP_BEGIN." = %d WHERE ".VIP_LOGIN." = '%s'");
					$VIPBonus = TRUE;
					$bonusCount++;
				}
				
				if($this->settings['REGISTER']['COIN']['SWITCH'] == true && $_POST['CoinBonus'] == 1)
				{
					$column = constant("COIN_COLUMN_".$this->settings['REGISTER']['COIN']['TYPE']);
					
					$this->DB->Arguments($column, $this->settings['REGISTER']['COIN']['NUMBER'], $_POST['Login']);
					$this->DB->Query("UPDATE ".COIN_CORE.".dbo.".COIN_TABLE." SET %s = %d WHERE ".COIN_LOGIN."= '%s'");
					$coinBonus = TRUE;
					$bonusCount++;
				}
				
				if($this->settings['REGISTER']['VAULT_BONUS']['SWITCH'] == true && $_POST['VaultBonus'] != NULL)
				{
					if(array_key_exists($_POST['VaultBonus'], $this->settings['REGISTER']['VAULT_BONUS']['OPTIONS']))
					{
						$this->loadVaultBonus($_POST['VaultBonus'], $_POST['Login']);
						$vaultBonus = TRUE;
						$bonusCount++;
					}
				}
					
				if($this->settings['REGISTER']['CONFIRM_MAIL'] == true)
				{
					$dechex = create_function("\$integer", "return str_pad(dechex(\$integer >= 255 ? 255 : \$integer), 2, 0, STR_PAD_LEFT);");
					$currentId = $this->DB->GetCurrentId("CTM_ValidingAccounts") + 1;
						
					$confirmCode = $dechex($currentId);
					$confirmCode .= ":".$dechex(0xFF - strlen($_POST['Account']) + mt_rand(0, 50));
					$confirmCode .= ":".$dechex(strlen($_POST['Mail']) + mt_rand(0, 50));
					$confirmCode .= ":".$dechex(mt_rand(0, 150));
					$confirmCode .= ":".$dechex(mt_rand(151, 255));
					$confirmCode .= ":".$dechex(0xFF / intval(date("d")) + intval(date("H")) + intval(date("m")) + intval(date("s")) + mt_rand(0, 50));
					$confirmCode .= ":".$dechex(0xFF / intval(date("m")) + intval(date("H")) + intval(date("m")) + intval(date("s")) + mt_rand(0, 50));
					$confirmCode .= ":".$dechex(intval(date("Y")) / 0xFF + intval(date("H")) + intval(date("m")) + intval(date("s")) + mt_rand(0, 50));
					
					$confirmCode = strtoupper($confirmCode);
					$link = gerateFullLink("?/register/confirm");
						
					$this->DB->Arguments($_POST['Login'], utf8_encode($_POST['Name']), $_POST['Mail'], $confirmCode);
					$this->DB->Query("INSERT INTO dbo.CTM_ValidatingAccounts (Account,Name,Mail,ConfirmCode) VALUES ('%s','%s','%s','%s')");
						
					$this->email->arguments = array
					(
						"NAME" => htmlEncode($_POST['Name']),
						"LOGIN" => $_POST['Login'],
						"EMAIL" => $_POST['Mail'],
						"SECURE_QUESTION" => htmlEncode($_POST['SecureQuestion']),
						"SECURE_ANSWER" => htmlEncode($_POST['SecureAnswer']),
						"VALIDATION_LINK" => $currentId,
						"VALIDATION_CODE" => $confirmCode,
						"SYSTEM_LINK" => $link
					);
					$this->email->LoadTemplate("RegisterNewMember");
					$this->email->GetMailContent($mail);
					
					$this->mailer->AddAddress($_POST['Mail'], $_POST['Name']);
					$this->mailer->SetSubject($mail['subject']);
					$this->mailer->SetBody($mail['content']);
					
					if($this->mailer->SendMail() == true)
					{
						$finishRegister = TRUE;
						$this->lang->setArguments("Register,Register,Messages,Success,NotCompleted", $_POST['Mail']);
						
						$success = "<strong>".$this->lang->words['Register']['Register']['Messages']['Success'][1]."</strong><br /><br />\n";
						$success .= $this->lang->words['Register']['Register']['Messages']['Success']['NotCompleted'];
						
					}
					else
					{
						CTM_MuOnline::Lib('Member')->DeleteAccount($_POST['Login']);
						
						$this->lang->setArguments("Register,Register,Messages,Error_SendMail", CoreVariables::ErrorsCode()->SendMailError);
						setResult(showMessage($this->lang->words['Register']['Register']['Messages']['Error_SendMail'], 2));
					}
				}
				else
				{
					$finishRegister = TRUE;
						
					$success = "<strong>".$this->lang->words['Register']['Register']['Messages']['Success'][1]."</strong><br /><br />\n";
					$success .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Success'][2]."<strong> ".htmlEncode($_POST['Name'])."</strong><br />\n";
					$success .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Success'][3]."<strong> ".strtolower($_POST['Login'])."</strong><br />\n";
					$success .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Success'][4]."<strong> ".$_POST['Mail']."</strong>\n";
				}
					
				if($finishRegister == true)
				{
					if($bonusCount > 0)
					{
						$success .= "<br /><br />\n";
						$success .= "<strong>".$this->lang->words['Register']['Register']['Messages']['Success'][5]."</strong><br /><br />\n";
					
						if($VIPBonus)
						{
							$this->lang->setTags
							(
								"Register,Register,Messages,Success,6", $this->settings['REGISTER']['VIP']['TIME'], 
								constant("VIP_NAME_".$this->settings['REGISTER']['VIP']['TYPE'])
							);
							
							$success .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Success'][6]."<br />\n";
						}

						if($coinBonus)
						{
							$this->lang->setTags
							(
								"Register,Register,Messages,Success,7", $this->settings['REGISTER']['COIN']['NUMBER'], 
								constant("COIN_NAME_".$this->settings['REGISTER']['COIN']['TYPE'])
							);
							
							$success .= "&raquo; ".$this->lang->words['Register']['Register']['Messages']['Success'][7]."<br />\n";
						}
		
						if($vaultBonus)
						{
							$success .= "&raquo; ".htmlEncode($this->settings['REGISTER']['VAULT_BONUS']['OPTIONS'][$_POST['VaultBonus']])."<br />\n";
						}	
					}
					
					$success .= "<br />\n";
					$success .= $this->lang->words['Register']['Register']['Messages']['Success'][8];
					
					CTM_Captcha::gerateCaptchaText(); 
					setResult(showMessage($success, 3));
				}
			}
		}
	}
	/**
	 *	Load Vault Bonus
	 *
	 *	@return	void
	*/
	private function loadVaultBonus($bonus, $account)
	{
		$serialize_file = CTM_FileManage::Lib('ReadScript')->CheckSerializeFile("Web_RegisterVault.serialize.dat") == false;
		$structure_file = CTM_FileManage::Lib('ReadScript')->StructureFile(CTM_CONTROL_PATH."Data/RegisterVault.txt", "Web_RegisterVault.serialize.dat", FALSE);
		$serialize_data = CTM_FileManage::Lib('ReadScript')->ReadScript();
		
		CTM_MuOnline::Lib('Item')->Vault()->OpenVault($account);
		$itemCount = 0;
		
		foreach($serialize_data[$bonus] as $value)
		{
			$itemSize = array();
			$hexItem = NULL;
			
			if(preg_replace("/(.*?),(.*?)/i", "$1", $value[15]) > -2) $value[14] = "0,0";
			elseif(preg_replace("/(.*?),(.*?)/i", "$1", $value[16]) > -2) $value[14] = "0,0";
			elseif(preg_replace("/(.*?),(.*?)/i", "$1", $value[17]) > -2) $value[14] = "0,0";
			elseif(preg_replace("/(.*?),(.*?)/i", "$1", $value[18]) > -2) $value[14] = "0,0";
			elseif(preg_replace("/(.*?),(.*?)/i", "$1", $value[19]) > -2) $value[14] = "0,0";
			
			CTM_MuOnline::Lib('Item')->Database()->GetItemSize($value[0], $value[1], $itemSize);
			CTM_MuOnline::Lib('Item')->MakeItemHex($value[0], $value[1], array
			(
				"Level" => $value[2],
				"Option" => $value[5],
				"Skill" => $value[4] == 1,
				"Luck" => $value[3] == 1,
				"Excellent" => array
				(
					0 => $value[6] == 1,
					1 => $value[7] == 1,
					2 => $value[8] == 1,
					3 => $value[9] == 1,
					4 => $value[10] == 1,
					5 => $value[11] == 1
				),
				"Ancient" => $value[12],
				"Refine" => $value[13] == 1,
				"Harmony" => explode(",", $value[14]),
				"SocketOption" => array
				(
					0 => explode(",", $value[15]),
					1 => explode(",", $value[16]),
					2 => explode(",", $value[17]),
					3 => explode(",", $value[18]),
					4 => explode(",", $value[19]),
				),
			), $hexItem);
			
			CTM_MuOnline::Lib('Item')->Vault()->FindSlotFree($itemSize['x'], $itemSize['y'], $itemCount);
			CTM_MuOnline::Lib('Item')->Vault()->InsertItem($hexItem, $itemCount++);
		}
		
		CTM_MuOnline::Lib('Item')->Vault()->CloseVault(true);
		unset($itemData, $itemCount);
	}
	/**
	 *	Register Set Vars
	 *
	 *	@return	void
	*/
	private function loadRegisterSetVars()
	{
		$GLOBALS['register_module']['countBonus'] = 0;
		$string = "Register,Register,RegisterBonus,";
		
		if($this->settings['REGISTER']['VIP']['SWITCH'] == true) $GLOBALS['register_module']['countBonus']++;
		if($this->settings['REGISTER']['COIN']['SWITCH'] == true) $GLOBALS['register_module']['countBonus']++;
		if($this->settings['REGISTER']['VAULT_BONUS']['SWITCH'] == true) $GLOBALS['register_module']['countBonus']++;
		
		$this->lang->setTags($string."VIPBonus", $this->settings['REGISTER']['VIP']['TIME'], constant("VIP_NAME_".$this->settings['REGISTER']['VIP']['TYPE']));
		$this->lang->setTags($string."CoinBonus", $this->settings['REGISTER']['COIN']['NUMBER'], constant("COIN_NAME_".$this->settings['REGISTER']['COIN']['TYPE']));
	}
	/**
	 *	Ajax Check Fields
	 *
	 *	@return	void
	*/
	private function loadAjaxCheckFields()
	{
		if($_GET['do'] == "ajaxCheck")
		{
			switch($_GET['command'])
			{
				case "login" :
					if(empty($_GET['username']))
						setAjaxField($this->lang->words['Register']['Register']['AjaxCheck']['Void'], array("Login", "LoginResult"), 0);
					elseif(strlen(urldecode($_GET['username'])) < 4)
						setAjaxField($this->lang->words['Register']['Register']['AjaxCheck']['MinLogin'], array("Login", "LoginResult"), 1);
					elseif(strlen(urldecode($_GET['username'])) > 10)
						setAjaxField($this->lang->words['Register']['Register']['AjaxCheck']['MaxLogin'], array("Login", "LoginResult"), 1);
					else
					{
						$this->DB->Arguments(urldecode($_GET['username']));
						$this->DB->Query("SELECT 1 FROM ".MUACC_CORE.".dbo.MEMB_INFO WHERE LOWER(memb___id) = '%s'");
						
						if($this->DB->CountRows() > 0)
							setAjaxField($this->lang->words['Register']['Register']['AjaxCheck']['LoginExists'], array("Login", "LoginResult"), 1);
						else
							setAjaxField($this->lang->words['Register']['Register']['AjaxCheck']['LoginValid'], array("Login", "LoginResult"), 2);
					}
				break;
				case "mail" :
					if(empty($_GET['email']))
						setAjaxField($this->lang->words['Register']['Register']['AjaxCheck']['Void'], array("Mail", "MailResult"), 0);
					elseif(!CTM_Text::checkMail(urldecode($_GET['email'])))
						setAjaxField($this->lang->words['Register']['Register']['AjaxCheck']['MailInvalid'], array("Mail", "MailResult"), 1);
					else
					{
						$this->DB->Arguments(urldecode($_GET['email']));
						$this->DB->Query("SELECT 1 FROM ".MUACC_CORE.".dbo.MEMB_INFO WHERE LOWER(mail_addr) = '%s'");
						
						if($this->DB->CountRows() > 0)
							setAjaxField($this->lang->words['Register']['Register']['AjaxCheck']['MailExists'], array("Mail", "MailResult"), 1);
						else
							setAjaxField($this->lang->words['Register']['Register']['AjaxCheck']['MailValid'], array("Mail", "MailResult"), 2);
					}
				break;
			}
			exit();
		}
	}
}