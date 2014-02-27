<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: Members Control - Accounts
 * Last Update: 01/10/2012 - 14:31h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_Members_Accounts extends Core_Admin_Members
{
	/**
	 *	Init module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		switch($_GET['index'])
		{
			case "manageAccount" :
				if($this->CheckPermissionModule("accounts_manageAccount") == true)
				{
					$this->loadManageAccount();
				}
			break;
			case "validatingAccounts" :
				if($this->CheckPermissionModule("accounts_validatingAccounts") == true)
				{
					$this->loadValidatingAccounts();
					$this->output->setContent("accounts_validatingAccounts");
				}
			break;
			case "bannedAccounts" :
				if($this->CheckPermissionModule("accounts_bannedAccounts") == true)
				{
					$this->loadBannedAccounts();
					$this->output->setContent("accounts_bannedAccounts");
				}
			break;
			default :
				$this->loadSearchAccounts();
				$this->output->setContent("accounts_search");
			break;
		}
	}
	/**
	 *	Private: Search Account
	 *	Search the account in database
	 *
	 *	@return	void
	*/
	private function loadSearchAccounts($scape_write = FALSE, $set_message = NULL)
	{
		if(!empty($set_message))
		{
			$GLOBALS['result_command'] = $set_message;
		}

		if($_GET['write'] == true && $scape_write == false)
		{
			if(empty($_POST['Reference']) || empty($_POST['SearchCase']) || empty($_POST['SearchType']))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['Search']['Messages']['FieldsVoid'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
			}
			else
			{
				$GLOBALS['accounts_located'] = array();

				switch($_POST['SearchType'])
				{
					case "startingWith" : $search = "LIKE '@/s|%'"; break;
					case "endingWith" : $search = "LIKE '%@/s|'"; break;
					case "containing" : $search = "LIKE '%@/s|%'"; break;
					default : $search = "= '@/s|'"; break;
				}

				switch($_POST['SearchCase'])
				{
					case "mail" :
						$ma = MUACC_CORE.".dbo.MEMB_INFO";
						$ms = MUACC_CORE.".dbo.MEMB_STAT";

						$queryString = "SELECT {$ma}.memb___id, {$ma}.memb_name, {$ma}.mail_addr, {$ms}.IP";
						$queryString .= " FROM {$ma} LEFT JOIN {$ms} ON ({$ms}.memb___id = {$ma}.memb___id) WHERE {$ma}.mail_addr {$search} ORDER BY {$ma}.memb_name DESC";
					break;
					case "ip" :
						$ma = MUACC_CORE.".dbo.MEMB_INFO";
						$ms = MUACC_CORE.".dbo.MEMB_STAT";

						$queryString = "SELECT {$ma}.memb___id, {$ma}.memb_name, {$ma}.mail_addr, {$ms}.IP";
						$queryString .= " FROM {$ma} LEFT JOIN {$ms} ON ({$ms}.memb___id = {$ma}.memb___id) WHERE {$ms}.IP {$search} ORDER BY {$ma}.memb_name DESC";
					break;
					default :
						$ma = MUACC_CORE.".dbo.MEMB_INFO";
						$ms = MUACC_CORE.".dbo.MEMB_STAT";

						$queryString = "SELECT {$ma}.memb___id, {$ma}.memb_name, {$ma}.mail_addr, {$ms}.IP";
						$queryString .= " FROM {$ma} LEFT JOIN {$ms} ON ({$ms}.memb___id = {$ma}.memb___id) WHERE {$ma}.memb___id {$search} ORDER BY {$ma}.memb_name DESC";
					break;
				}

				$this->DB->Parameters(array("@/s|" => $_POST['Reference']));
				$this->DB->Query($queryString, $queryResult);

				if(($count = $this->DB->CountRows($queryResult)) > 0)
				{
					while($located = $this->DB->FetchObject($queryResult))
					{
						$GLOBALS['accounts_located'][$located->memb___id] = array
						(
							"name" => $located->memb_name,
							"mail" => $located->mail_addr,
							"ip" => $located->IP
						);
					}

					$GLOBALS['result_command'] = sprintf($this->lang->words['Members']['Accounts']['Search']['Messages']['Success'], $count);
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
				}
				else
				{
					$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['Search']['Messages']['NoResults'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
				}
			}
		}
	}
	/**
	 *	Private: Check Account
	 *	Check if the account exists
	 *
	 *	@param	string	Login or Mail
	 *	@return	void
	*/
	private function loadCheckAccount($login_or_mail, $force_key = FALSE)
	{
		if($force_key == "login")
			$where = "memb___id = '%s'";
		elseif($force_key == "mail")
			$where = "mail_addr = '%s'";
		else
			$where = "memb___id = '%s' OR mail_addr = '%s'";

		$this->DB->Arguments($login_or_mail, $login_or_mail);
		$this->DB->Query("SELECT 1 FROM ".MUACC_CORE.".dbo.MEMB_INFO WHERE ".$where, $check_account_query);

		return $this->DB->CountRows($check_account_query) > 0;
	}
	/**
	 *	Private: Manage Account
	 *	Manage a account from database
	 *
	 *	@return	void
	*/
	private function loadManageAccount()
	{
		if($this->loadCheckAccount($_GET['username'], "login"))
		{
			$user_data = $this->MuLib('Member')->Load(($_GET['username'] = urldecode($_GET['username'])));

			switch($_GET['do'])
			{
				case "ban" :
					if($this->CheckPermissionItem("accounts_manageAccount_ban") == true)
					{
						if($_GET['write'] == true)
						{
							if(empty($_POST['banReason']) || empty($_POST['banExpiration']))
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['BanAccount']['Messages']['FieldsVoid'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
							}
							else
							{
								$date = explode("/", $_POST['banExpiration']);

								if(count($date) != 3 || (strlen($date[0]) != 2 || strlen($date[1]) != 2 || strlen($date[2]) != 4))
								{
									$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['BanAccount']['Messages']['DateInvalid'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								}
								elseif($user_data['info']['bloc_code'] == 1 && $user_data['info']['MemberStatus'] == 0)
								{
									$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['BanAccount']['Messages']['AccountBanned'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								}
								else
								{
									$insert_columns = array
									(
										"Responsible" => USER_ACCOUNT,
										"Account" => $_GET['username'],
										"Expiration" => ($expiration = mktime(23, 59, 59, $date[0], $date[1], $date[2])),
										"Reason" => htmlEncode($_POST['banReason'])
									);

									$this->DB->Arguments($_GET['username']);
									$this->DB->Delete("CTM_AccountsBanneds", "Account = '%s'");

									$this->DB->Arguments($_GET['username']);
									$this->DB->Update(MUACC_CORE."@MEMB_INFO", array("bloc_code" => 1), "memb___id = '%s'");

									$this->DB->Insert("CTM_AccountsBanneds", $insert_columns);

									$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['BanAccount']['Messages']['Success'];
									$GLOBALS['result_command'] = adminShowMessage(sprintf($GLOBALS['result_command'], date("d/m/Y", $expiration)), 3);
								}
							}

							if(loadIsAjax() == true)
								exit($GLOBALS['result_command']);
						}

						$this->output->setContent("accounts_banAccount");
					}
				break;
				case "unban" :
					if($this->CheckPermissionItem("accounts_manageAccount_unban") == true)
					{
						if($_GET['write'] == true)
						{
							if($user_data['info']['bloc_code'] == 0)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['UnbanAccount']['Messages']['NoBanned'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							else
							{
								$this->DB->Arguments($_GET['username']);
								$this->DB->Delete("CTM_AccountsBanneds", "Account = '%s'");

								$this->DB->Arguments($_GET['username']);
								$this->DB->Update(MUACC_CORE."@MEMB_INFO", array("bloc_code" => 0), "memb___id = '%s'");

								if(loadIsAjax() == false)
								{
									$_GET['write'] = FALSE;

									$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['UnbanAccount']['Messages']['Success'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);

									if($_GET['go'] == "banneds")
									{
										$this->loadBannedAccounts();
										$this->output->setContent("accounts_bannedAccounts");
									}
									else
									{
										$this->loadSearchAccounts();
										$this->output->setContent("accounts_search");
									}
									
									return NULL;
								}
							}

							if(loadIsAjax() == true)
								exit($GLOBALS['result_command']);
						}

						if($user_data['info']['bloc_code'] == 1 && $user_data['info']['MemberStatus'] == 0)
						{
							$this->DB->Arguments($_GET['username']);
							$accountBlockInfoQ = $this->DB->Select("Responsible,Expiration,Reason", "CTM_AccountsBanneds", "Account = '%s'");
							
							if($this->DB->CountRows($accountBlockInfoQ) > 0)
							{
								$accountBlockInfo = $this->DB->FetchObject($accountBlockInfoQ);
								
								$GLOBALS['block_info']['responsible'] = $accountBlockInfo->Responsible;
								$GLOBALS['block_info']['expiration'] = date("d/m/Y - H:i", $accountBlockInfo->Expiration);
								$GLOBALS['block_info']['reason'] = $accountBlockInfo->Reason;
							}
							else
							{
								$GLOBALS['block_info']['responsible'] = $this->lang->words['Words']['None'];
								$GLOBALS['block_info']['expiration'] = $this->lang->words['Words']['Never'];
								$GLOBALS['block_info']['reason'] = $this->lang->words['Words']['None'];
							}
						}

						$this->output->setContent("accounts_unbanAccount");
					}
				break;
				case "manageVIP" :
					if($this->CheckPermissionItem("accounts_manageAccount_manageVIP") == true)
					{
						if($_GET['command'] == "write")
						{
							if($_POST['VIPType'] != 1 && $_POST['VIPType'] != 2 && $_POST['VIPType'] != 3 && $_POST['VIPType'] != 4 && $_POST['VIPType'] != 5)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['ManageVIP']['Messages']['VIPInvalid'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
							}
							else
							{
								if(empty($_POST['VIPDays']) || $_POST['VIPDays'] < 0)
									$_POST['VIPDays'] = 0;

								$timeVIP = $user_data['vip'][VIP_TIME] + $_POST['VIPDays'];
								$beginVIP = strlen($user_data['vip'][VIP_BEGIN]) == 10 ? $user_data['vip'][VIP_BEGIN] : time();
								$commandVIP = "Added";
								
								if($user_data['vip'][VIP_COLUMN] > 0)
								{
									if(strlen($user_data['vip'][VIP_TIME]) == 10)
										$timeVIP = strtotime("+ ".$_POST['VIPDays']." days", $user_data['vip'][VIP_TIME]);
									
									if($_POST['VIPDays'] == 0)
										$commandVIP = "Transformed";
									else
										$commandVIP = "Added";
								}
								
								$this->DB->Arguments($_POST['VIPType'], $beginVIP, $timeVIP, $_GET['username']);
								$this->DB->Query("UPDATE ".VIP_CORE.".dbo.".VIP_TABLE." SET ".VIP_COLUMN." = %d, ".VIP_BEGIN." = %d, ".VIP_TIME." = %d WHERE ".VIP_LOGIN." = '%s'");
							
								$_timeVIP = $timeVIP;
								$timeVIP = strlen($timeVIP) == 10 ? $timeVIP : strtotime("+ ".$timeVIP." days");
								
								$result_1 = $this->lang->words['Members']['Accounts']['ManageAccount']['ManageVIP']['Messages']['Success'][$commandVIP];
								$result_1 = sprintf($result_1, $this->functions->AccountLevel($_POST['VIPType']), $_GET['username']);

								$result_2 = $this->lang->words['Members']['Accounts']['ManageAccount']['ManageVIP']['Messages']['Success']['Expiration'];
								$result_2 = sprintf($result_2, date("d/m/Y", $timeVIP), $_POST['VIPDays']);

								$GLOBALS['result_command'] = "<strong>".$result_1."</strong><br />\n".$result_2;
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);

								if(loadIsAjax() == false)
								{
									$user_data['vip'] = array
									(
										VIP_COLUMN => $_POST['VIPType'],
										VIP_BEGIN => $beginVIP,
										VIP_TIME => $_timeVIP,
									);
								}
							}

							if(loadIsAjax() == true)
								exit($GLOBALS['result_command']);
						}
						elseif($_GET['command'] == "remove")
						{
							self::DB()->Arguments($_GET['username']);
							self::DB()->Query("UPDATE ".VIP_CORE.".dbo.".VIP_TABLE." SET ".VIP_COLUMN." = 0, ".VIP_BEGIN." = 0, ".VIP_TIME." = 0 WHERE ".VIP_LOGIN." = '%s'");

							$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['ManageVIP']['Messages']['Success']['Removed'];
							$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);

							if(loadIsAjax() == true)
							{
								exit($GLOBALS['result_command']);
							}
							else
							{
									$user_data['vip'] = array
									(
										VIP_COLUMN => 0,
										VIP_BEGIN => 0,
										VIP_TIME => 0,
									);
							}
						}

						/*$GLOBALS['vip_info'] = array
						(
							"type" => $this->functions->AccountLevel($user_data['vip'][VIP_COLUMN]),
							"begin" => $this->functions->MakeVIPTime($user_data['vip'][VIP_BEGIN]),
							"end" => $this->functions->MakeVIPTime($user_data['vip'][VIP_TIME])
						);*/
						
						$this->output->setContent("accounts_manageVIP");
					}
				break;
				case "manageCoin" :
					if($this->CheckPermissionItem("accounts_manageAccount_manageCoin") == true)
					{
						if($_GET['command'] == "insert" || $_GET['command'] == "remove")
						{
							$_POST['Coin'] = intval($_POST['Coin']);
							$_POST['Quantity'] = intval($_POST['Quantity']);

							if(empty($_POST['Quantity']))
								$_POST['Quantity'] = 0;

							if($_POST['Coin'] != 1 && $_POST['Coin'] != 2 && $_POST['Coin'] != 3)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['ManageCoin']['Messages']['CoinInvalid'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							else
							{
								if($_GET['command'] == "insert")
								{
									$coin_command = "Insert";
									$coin_signal = "+";
								}
								elseif($_GET['command'] == "remove")
								{
									$coin_command = "Remove";
									$coin_signal = "-";
								}

								$coin_column = $_POST['Coin'];
								$coin_name = constant("COIN_NAME_".$_POST['Coin']);

								if($user_data['coin'][$coin_column] < $_POST['Quantity'] && $_GET['command'] == "remove")
								{
									$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['ManageCoin']['Messages']['NoCoin'];
									$GLOBALS['result_command'] = adminShowMessage(sprintf($GLOBALS['result_command'], $coin_name), 2);
								}
								else
								{
									$this->DB->Arguments($_GET['username'], $coin_column, $_POST['Quantity'], intval(COIN_USE_CACHE));
									$this->DB->Query("EXEC dbo.CTM_PlusAccountCoin '%s', %d, %d, %d");
								
									$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['ManageCoin']['Messages']['Success'][$coin_command];
									$GLOBALS['result_command'] = adminShowMessage(sprintf($GLOBALS['result_command'], $_POST['Quantity'], $coin_name), 3);
								}
							}

							if(loadIsAjax() == true)
								exit($GLOBALS['result_command']);
						}

						$this->output->setContent("accounts_manageCoin");
					}
				break;
				case "disconnect" :
					if($user_data['stat']['ConnectStat'] < 1)
					{
						$message = $this->lang->words['Members']['Accounts']['ManageAccount']['DisconnectAccount']['Messages']['UserOffline'];
						$type = 2;
					}
					elseif($this->MuLib('JoinServer')->ForceLogout($_GET['username']))
					{
						$message = $this->lang->words['Members']['Accounts']['ManageAccount']['DisconnectAccount']['Messages']['Success'];
						$type = 3;
					}
					else
					{
						$message = sprintf($this->lang->words['Members']['Accounts']['ManageAccount']['DisconnectAccount']['Messages']['Error'], 11);
						$type = 2;
					}

					$this->loadSearchAccounts(true, adminShowMessage($message, $type));
					$this->output->setContent("accounts_search");
				break;
				default :
					if($this->CheckPermissionItem("accounts_manageAccount_edit") == true)
					{
						if($_GET['write'] == "name" && loadIsAjax() == true)
						{
							if(empty($_POST['NewName']))
							{
								exit(adminShowMessage($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangeName']['Messages']['NameVoid'], 1));
							}
							elseif(strlen($_POST['NewName']) > 10)
							{
								exit(adminShowMessage($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangeName']['Messages']['MaxLength'], 2));
							}
							else
							{
								$this->DB->Arguments($_GET['username']);
								$this->DB->Update(MUACC_CORE."@MEMB_INFO", array("memb_name" => utf8_encode($_POST['NewName'])), "memb___id = '%s'");

								exit("<script>editAccount_writeSuccess('name', '".str_replace("'", "\'", $_POST['NewName'])."');</script>");
							}
						}
						elseif($_GET['write'] == "email" && loadIsAjax() == true)
						{
							if(empty($_POST['NewMail']))
							{
								exit(adminShowMessage($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangeMail']['Messages']['MailVoid'], 1));
							}
							elseif(!CTM_Text::CheckMail($_POST['NewMail']))
							{
								exit(adminShowMessage($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangeMail']['Messages']['InvalidMail'], 2));
							}
							else
							{
								$this->DB->Arguments($_GET['username']);
								$this->DB->Update(MUACC_CORE."@MEMB_INFO", array("mail_addr" => $_POST['NewMail']), "memb___id = '%s'");

								exit("<script>editAccount_writeSuccess('email', '".str_replace("'", "\'", $_POST['NewMail'])."');</script>");
							}
						}
						elseif($_GET['write'] == "password" && loadIsAjax() == true)
						{
							if(empty($_POST['NewPassword']))
							{
								exit(adminShowMessage($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangePassword']['Messages']['PasswordVoid'], 1));
							}
							elseif(empty($_POST['ConfirmNewPassword']))
							{
								exit(adminShowMessage($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangePassword']['Messages']['ConfirmPasswordVoid'], 1));
							}
							elseif(eregi("[^a-zA-Z0-9_!=?&-]", $_POST['NewPassword']))
							{
								exit(adminShowMessage($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangePassword']['Messages']['CaractersInvalid'], 2));
							}
							elseif($_POST['NewPassword'] != $_POST['ConfirmNewPassword'])
							{
								exit(adminShowMessage($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangePassword']['Messages']['PasswordError'], 2));
							}
							else
							{
								$this->MuLib('Member')->ChangePassword($_GET['username'], $_POST['NewPassword']);
								exit("<script>editAccount_writeSuccess('password');</script>");
							}
						}
						elseif($_GET['write'] == "pid" && loadIsAjax() == true)
						{
							if(empty($_POST['NewPID']))
							{
								exit(adminShowMessage($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangePID']['Messages']['PIDVoid'], 1));
							}
							elseif(strlen($_POST['NewPID']) <> 7)
							{
								exit(adminShowMessage($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangePID']['Messages']['ErrorLength'], 2));
							}
							elseif(!is_numeric($_POST['NewPID']))
							{
								exit(adminShowMessage($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangePID']['Messages']['ErrorCaracters'], 2));
							}
							else
							{
								$this->DB->Arguments($_GET['username']);
								$this->DB->Update(MUACC_CORE."@MEMB_INFO", array("sno__numb" => str_pad($_POST['NewPID'], 13, 1, STR_PAD_LEFT)), "memb___id = '%s'");

								exit("<script>editAccount_writeSuccess('pid', '".str_replace("'", "\'", $_POST['NewPID'])."');</script>");
							}
						}
						elseif($_GET['write'] == "save")
						{
							if(is_null($_POST['MemberStatus']) || is_null($_POST['AccountLevel']) || empty($_POST['SecureQuestion']) || empty($_POST['SecureAnswer']))
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Save']['Messages']['FieldsVoid'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
							}
							elseif(empty($_POST['BirthDay']) || empty($_POST['BirthMonth']) || empty($_POST['BirthYear']))
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Save']['Messages']['FieldsVoid'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
							}
							elseif(is_null($_POST['CoinBalance_1']) || (is_null($_POST['CoinBalance_2']) && COIN_NUMBER >= 2) || (is_null($_POST['CoinBalance_3']) && COIN_NUMBER == 3))
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Save']['Messages']['FieldsVoid'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
							}
							elseif($_POST['AccountLevel'] < 0 || $_POST['AccountLevel'] > VIP_NUMBER)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Save']['Messages']['ErrorAccountLevel'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							elseif($_POST['MemberStatus'] != 0 && $_POST['MemberStatus'] != 1)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Save']['Messages']['ErrorStatus'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							else
							{
								$_POST['BirthDay'] = eregi_replace("[^0-9]", NULL, $_POST['BirthDay']);
								$_POST['BirthMonth'] = eregi_replace("[^0-9]", NULL, $_POST['BirthMonth']);
								$_POST['BirthYear'] = eregi_replace("[^0-9]", NULL, $_POST['BirthYear']);

								$save_data = array
								(
									"info" => array
									(
										"fpas_ques" => utf8_encode($_POST['SecureQuestion']),
										"fpas_answ" => utf8_encode($_POST['SecureAnswer']),
										"MemberBirth" => $_POST['BirthDay']."/".$_POST['BirthMonth']."/".$_POST['BirthYear'],
										"MemberStatus" => intval($_POST['MemberStatus']),
									),
									"vip" => array
									(
										VIP_COLUMN => intval($_POST['AccountLevel'])
									),
									"coin" => array
									(
										COIN_COLUMN_1 => intval($_POST['CoinBalance_1'])
									),
								);

								if(COIN_NUMBER >= 2)
								{
									$save_data['coin'][COIN_COLUMN_2] = intval($_POST['CoinBalance_2']);

									if(COIN_NUMBER == 3)
									{
										$save_data['coin'][COIN_COLUMN_3] = intval($_POST['CoinBalance_3']);
									}
								}

								$this->MuLib('Member')->UpdateAccount($_GET['username'], $save_data);

								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Save']['Messages']['Success'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);

								$user_data = $this->MuLib('Member')->Load(($_GET['username'] = urldecode($_GET['username'])));
							}
						}
						elseif($_GET['write'] == "delete")
						{
							if(USER_ACCOUNT == $_GET['username'])
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['DeleteAccount']['NoDelSelf'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							elseif(in_array($_GET['username'], $this->settings['ADMINCONTROLPANEL']['SADMIN_ACCOUNTS']))
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['DeleteAccount']['NoDelUser'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							else
							{
								$this->MuLib('Member')->DeleteAccount($_GET['username']);
								$this->loadSearchAccounts(true, adminShowMessage($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['DeleteAccount']['Success'], 3));
								$this->output->setContent("accounts_search");

								return NULL;
							}
						}
						elseif($_GET['command'] == "disconnect")
						{
							if($user_data['stat']['ConnectStat'] < 1)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['DisconnectAccount']['Messages']['UserOffline'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							elseif($this->MuLib('JoinServer')->ForceLogout($_GET['username']))
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ManageAccount']['DisconnectAccount']['Messages']['Success'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
							}
							else
							{
								$GLOBALS['result_command'] = sprintf($this->lang->words['Members']['Accounts']['ManageAccount']['DisconnectAccount']['Messages']['Error'], 11);
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								$GLOBALS['result_command'] .= "\r\n<script>$('#userStatus').html(\"<span style='color: red;'>Offline</span>\");</script>";
							}
							
						}

						$GLOBALS['account_info'] = array
						(
							"info" => array
							(
								"register_date" => $user_data['info']['RegisterDate'],
								"sex" => utf8_decode($user_data['info']['MemberSex'])
							),
							"data" => array
							(
								"name" => utf8_decode($user_data['info']['memb_name']),
								"mail" => $user_data['info']['mail_addr'],
								"pid" => substr($user_data['info']['sno__numb'], 6),
								"status" => $user_data['info']['MemberStatus'],
								"account_level" => $user_data['vip'][VIP_COLUMN],
								"coin_1" => $user_data['coin'][COIN_COLUMN_1],
								"coin_2" => $user_data['coin'][COIN_COLUMN_2],
								"coin_3" => $user_data['coin'][COIN_COLUMN_3],
								"secure_question" => utf8_decode($user_data['info']['fpas_ques']),
								"secure_answer" => utf8_decode($user_data['info']['fpas_answ']),
								"birth" => explode("/", $user_data['info']['MemberBirth'])
							),
							"stat" => array
							(
								"server" => $this->functions->GetServerName($user_data['stat']['ServerName']),
								"ip" => $user_data['stat']['IP'],
								"date" => date("d/m/Y - h:i a", strtotime($user_data['stat']['ConnectTM'])),
								"status" => $user_data['stat']['ConnectStat'] > 0
							)
						);

						$this->output->setContent("accounts_editAccount");
					}
				break;
			}
		}
	}
	/**
	 *	Private: Validating Accounts
	 *	Manage the validating accounts
	 *
	 *	@return	void
	*/
	public function loadValidatingAccounts()
	{
		if($_GET['write'] == true)
		{
			switch($_POST['Action'])
			{
				case "approve" :
					$count = 0;

					if(count($_POST) > 0)
					{
						foreach($_POST as $key => $value)
						{
							if(substr($key, 0, 9) == "account__" && $value == 1)
							{
								$account = substr($key, 9);
								$this->MuLib('Member')->UpdateAccount($key, array("info" => array("bloc_code" => 0, "MemberStatus" => 0)));

								$this->DB->Arguments($account);
								$this->DB->Delete("CTM_ValidatingAccounts", "Account = '%s'");

								$count++;
							}
						}
					}

					if($count > 0)
					{
						$GLOBALS['result_command'] = sprintf($this->lang->words['Members']['Accounts']['ValidatingAccounts']['Messages']['Success']['Approve'], $count);
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
					}
					else
					{
						$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ValidatingAccounts']['Messages']['SelectAccount'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
					}
				break;
				case "resend_email" :
					$success = 0;
					$error = 0;

					if(count($_POST) > 0)
					{
						foreach($_POST as $key => $value)
						{
							if(substr($key, 0, 9) == "account__" && $value == 1)
							{
								$account = substr($key, 9);

								$this->DB->Arguments($account);
								$this->DB->Query("SELECT * FROM dbo.CTM_ValidatingAccounts WHERE Account = '%s'", $data_q);
								
								if($this->DB->CountRows($data_q) > 0)
								{
									$user_info = $this->MuLib('Member')->Load($account, array("info" => "fpas_ques,fpas_answ"));
									$data_info = $this->DB->FetchArray($data_q);

									$this->email->arguments = array
									(
										"NAME" => htmlEncode(utf8_decode($data_info['Name'])),
										"LOGIN" => $data_info['Account'],
										"EMAIL" => $data_info['Mail'],
										"SECURE_QUESTION" => htmlEncode(utf8_decode($user_info['info']['fpas_ques'])),
										"SECURE_ANSWER" => htmlEncode(utf8_decode($user_info['info']['fpas_answ'])),
										"VALIDATION_LINK" => $data_info['Id'],
										"VALIDATION_CODE" => $data_info['ConfirmCode'],
										"SYSTEM_LINK" => gerateFullLink("?/register/confirm")
									);
									$this->email->LoadTemplate("RegisterNewMember");
									$this->email->GetMailContent($mail);
									
									$this->mailer->AddAddress($data_info['Mail'], utf8_decode($data_info['Name']));
									$this->mailer->SetSubject($mail['subject']);
									$this->mailer->SetBody($mail['content']);

									if($this->mailer->SendMail() == true)
										$success++;
									else
										$error++;
								}
								else
								{
									$error++;
								}
							}
						}
					}

					if($success > 0 || $error > 0)
					{
						$GLOBALS['result_command'] = sprintf($this->lang->words['Members']['Accounts']['ValidatingAccounts']['Messages']['Success']['ResendEmail'], $success, $error);
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
					}
					else
					{
						$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ValidatingAccounts']['Messages']['SelectAccount'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
					}
				break;
				case "delete" :
					$count = 0;

					if(count($_POST) > 0)
					{
						foreach($_POST as $key => $value)
						{
							if(substr($key, 0, 9) == "account__" && $value == 1)
							{
								$account = substr($key, 9);
								$this->MuLib('Member')->DeleteAccount($account);

								$count++;
							}
						}
					}

					if($count > 0)
					{
						$GLOBALS['result_command'] = sprintf($this->lang->words['Members']['Accounts']['ValidatingAccounts']['Messages']['Success']['Delete'], $count);
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
					}
					else
					{
						$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['ValidatingAccounts']['Messages']['SelectAccount'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
					}
				break;
			}
		}
		
		$a = "dbo.CTM_ValidatingAccounts";
		$m = MUACC_CORE.".dbo.MEMB_INFO";

		$GLOBALS['validating_accounts'] = array();
		$query = $this->DB->Query("SELECT * FROM dbo.CTM_ValidatingAccounts WHERE Confirmed = 0 ORDER BY Id DESC");

		if($this->DB->CountRows($query) > 0)
		{
			while($account = $this->DB->FetchObject($query))
			{
				$GLOBALS['validating_accounts'][$account->Account] = array
				(
					"name" => utf8_decode($account->Name),
					"mail" => $account->Mail,
					"code" => $account->ConfirmCode
				);
			}
		}
	}
	/**
	 *	Private: Banned Accounts
	 *	Manage the banned accounts
	 *
	 *	@return	void
	*/
	private function loadBannedAccounts()
	{
		if($_GET['do'] == "unban")
		{
			$count = 0;

			if(count($_POST) > 0)
			{
				foreach($_POST as $key => $value)
				{
					if(substr($key, 0, 9) == "account__" && $value == 1)
					{
						$this->DB->Arguments(substr($key, 9));
						$this->DB->Update(MUACC_CORE."@MEMB_INFO", array("bloc_code" => 0), "memb___id = '%s'");
					
						$this->DB->Arguments(substr($key, 9));
						$this->DB->Delete("CTM_AccountsBanneds", "Account = '%s'");

						$count++;
					}
				}
			}

			if($count > 0)
			{
				$GLOBALS['result_command'] = sprintf($this->lang->words['Members']['Accounts']['BannedAccounts']['Messages']['Success'], $count);
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
			}
			else
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Accounts']['BannedAccounts']['Messages']['SelectAccount'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
			}
		}

		$a = "dbo.CTM_AccountsBanneds";
		$m = MUACC_CORE.".dbo.MEMB_INFO";

		$GLOBALS['banned_accounts'] = array();
		$query = $this->DB->Query("SELECT {$a}.Responsible, {$a}.Expiration, {$a}.Reason, {$m}.memb___id FROM {$m} LEFT JOIN {$a} ON ({$a}.Account = {$m}.memb___id) WHERE {$m}.bloc_code = 1 AND {$m}.MemberStatus = 0 ORDER BY {$a}.BanId DESC");

		if($this->DB->CountRows($query) > 0)
		{
			while($account = $this->DB->FetchObject($query))
			{
				$GLOBALS['banned_accounts'][$account->memb___id] = array
				(
					"responsible" => strlen($account->Responsible) > 0 ? $account->Responsible : $this->lang->words['Words']['None'],
					"expiration" => strlen($account->Expiration) > 0 ? date("d/m/Y - h:i a", $account->Expiration) : $this->lang->words['Words']['Never'],
					"reason" => strlen($account->Reason) > 0 ? $account->Reason : NULL
				);
			}
		}
	}
}