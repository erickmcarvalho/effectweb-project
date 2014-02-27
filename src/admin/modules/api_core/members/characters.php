<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: Members Control - Characters
 * Last Update: 03/10/2012 - 19:25h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_Members_Characters extends Core_Admin_Members
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
			case "manageCharacter" :
				if($this->CheckPermissionModule("characters_manageCharacter") == true)
				{
					$this->loadManageCharacter();
				}
			break;
			case "bannedCharacter" :
				if($this->CheckPermissionModule("characters_bannedCharacter") == true)
				{
					$this->loadBannedCharacters();
					$this->output->setContent("characters_bannedCharacter");
				}
			break;
			default :
				$this->loadSearchCharacters();
				$this->output->setContent("characters_search");
			break;
		}
	}
	/**
	 *	Private: Search Character
	 *	Search the character in database
	 *
	 *	@return	void
	*/
	private function loadSearchCharacters($scape_write = FALSE, $set_message = NULL)
	{
		if(!empty($set_message))
		{
			$GLOBALS['result_command'] = $set_message;
		}

		if($_GET['write'] == true && $scape_write == false)
		{
			if(empty($_POST['Reference']) || empty($_POST['SearchCase']) || empty($_POST['SearchType']))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['Search']['Messages']['FieldsVoid'];
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
					case "account" :
						$ca = MUGEN_CORE.".dbo.Character";
						$ms = MUACC_CORE.".dbo.MEMB_STAT";

						$queryString = "SELECT {$ca}.Name, {$ca}.AccountID, {$ca}.cLevel, {$ca}.Class, {$ms}.IP";
						$queryString .= " FROM {$ca} LEFT JOIN {$ms} ON ({$ms}.memb___id = {$ca}.AccountID) WHERE {$ca}.AccountID {$search} ORDER BY {$ca}.Name DESC";
					break;
					case "guild" :
						$ca = MUGEN_CORE.".dbo.Character";
						$gm = MUGEN_CORE.".dbo.GuildMember";
						$ms = MUACC_CORE.".dbo.MEMB_STAT";

						$queryString = "SELECT {$ca}.Name, {$ca}.AccountID, {$ca}.cLevel, {$ca}.Class, {$ms}.IP";
						$queryString .= " FROM {$gm} LEFT JOIN {$ca} ON ({$ca}.Name = {$gm}.Name) LEFT JOIN {$ms} ON ({$ms}.memb___id = {$ca}.AccountID) WHERE {$gm}.G_Name {$search} ORDER BY {$gm}.Name DESC";
					break;
					default :
						$ca = MUGEN_CORE.".dbo.Character";
						$ms = MUACC_CORE.".dbo.MEMB_STAT";

						$queryString = "SELECT {$ca}.Name, {$ca}.AccountID, {$ca}.cLevel, {$ca}.Class, {$ms}.IP";
						$queryString .= " FROM {$ca} LEFT JOIN {$ms} ON ({$ms}.memb___id = {$ca}.AccountID) WHERE {$ca}.Name {$search} ORDER BY {$ca}.Name DESC";
					break;
				}

				$this->DB->Parameters(array("@/s|" => $_POST['Reference']));
				$this->DB->Query($queryString, $queryResult);

				if(($count = $this->DB->CountRows($queryResult)) > 0)
				{
					while($located = $this->DB->FetchObject($queryResult))
					{
						$GLOBALS['characters_located'][$located->Name] = array
						(
							"login" => $located->AccountID,
							"class" => $this->functions->ClassInfo($located->Class),
							"level" => intval($located->cLevel)
						);
					}

					$GLOBALS['result_command'] = sprintf($this->lang->words['Members']['Characters']['Search']['Messages']['Success'], $count);
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
				}
				else
				{
					$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['Search']['Messages']['NoResults'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
				}
			}
		}
	}
	/**
	 *	Private: Check Character
	 *	Check if the character exists
	 *
	 *	@param	string	Char name
	 *	@return	void
	*/
	private function loadCheckCharacter($char_name)
	{
		$this->DB->Arguments($char_name);
		$this->DB->Query("SELECT 1 FROM ".MUACC_CORE.".dbo.Character WHERE Name = '%s'", $check_character_query);

		return $this->DB->CountRows($check_character_query) > 0;
	}
	/**
	 *	Private: Manage Character
	 *	Manage a character from database
	 *
	 *	@return	void
	*/
	private function loadManageCharacter()
	{
		if($this->loadCheckCharacter($_GET['charname']))
		{
			$char_data = $this->MuLib('Member')->LoadChar(($_GET['charname'] = urldecode($_GET['charname'])));

			switch($_GET['do'])
			{
				case "ban" :
					if($this->CheckPermissionItem("characters_manageCharacter_ban") == true)
					{
						if($_GET['write'] == true)
						{
							if(empty($_POST['banReason']) || empty($_POST['banExpiration']))
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['BanCharacter']['Messages']['FieldsVoid'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
							}
							else
							{
								$date = explode("/", $_POST['banExpiration']);

								if(count($date) != 3 || (strlen($date[0]) != 2 || strlen($date[1]) != 2 || strlen($date[2]) != 4))
								{
									$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['BanCharacter']['Messages']['DateInvalid'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								}
								elseif($char_data['CtlCode'] == 1)
								{
									$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['BanCharacter']['Messages']['CharacterBanned'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								}
								else
								{
									$insert_columns = array
									(
										"Responsible" => USER_ACCOUNT,
										"Account" => $char_data['AccountID'],
										"Character" => $_GET['charname'],
										"Expiration" => ($expiration = mktime(23, 59, 59, $date[0], $date[1], $date[2])),
										"Reason" => htmlEncode($_POST['banReason'])
									);

									$this->DB->Arguments($_GET['charname']);
									$this->DB->Delete("CTM_CharactersBanneds", "Character = '%s'");

									$this->DB->Arguments($_GET['charname']);
									$this->DB->Update(MUGEN_CORE."@Character", array("CtlCode" => 1), "Name = '%s'");

									$this->DB->Insert("CTM_CharactersBanneds", $insert_columns);

									$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['BanCharacter']['Messages']['Success'];
									$GLOBALS['result_command'] = adminShowMessage(sprintf($GLOBALS['result_command'], date("d/m/Y", $expiration)), 3);
								}
							}

							if(loadIsAjax() == true)
								exit($GLOBALS['result_command']);
						}

						$this->output->setContent("characters_banCharacter");
					}
				break;
				case "unban" :
					if($this->CheckPermissionItem("characters_manageCharacter_unban") == true)
					{
						if($_GET['write'] == true)
						{
							if($char_data['CtlCode'] != 1)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['UnbanCharacter']['Messages']['NoBanned'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							else
							{
								$this->DB->Arguments($_GET['charname']);
								$this->DB->Delete("CTM_CharactersBanneds", "Account = '%s'");

								$this->DB->Arguments($_GET['charname']);
								$this->DB->Update(MUGEN_CORE."@Character", array("CtlCode" => 0), "Name = '%s'");

								if(loadIsAjax() == false)
								{
									$_GET['write'] = FALSE;

									$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['UnbanCharacter']['Messages']['Success'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);

									if($_GET['go'] == "banneds")
									{
										$this->loadBannedCharacters();
										$this->output->setContent("accounts_bannedCharacters");
									}
									else
									{
										$this->loadSearchCharacters();
										$this->output->setContent("characters_search");
									}
									
									return NULL;
								}
							}

							if(loadIsAjax() == true)
								exit($GLOBALS['result_command']);
						}

						if($char_data['CtlCode'] == 1)
						{
							$this->DB->Arguments($_GET['charname']);
							$characterBlockInfoQ = $this->DB->Select("Responsible,Expiration,Reason", "CTM_CharactersBanneds", "Character = '%s'");
							
							if($this->DB->CountRows($characterBlockInfoQ) > 0)
							{
								$characterBlockInfo = $this->DB->FetchObject($characterBlockInfoQ);
								
								$GLOBALS['block_info']['responsible'] = $characterBlockInfo->Responsible;
								$GLOBALS['block_info']['expiration'] = date("d/m/Y - H:i", $characterBlockInfo->Expiration);
								$GLOBALS['block_info']['reason'] = $characterBlockInfo->Reason;
							}
							else
							{
								$GLOBALS['block_info']['responsible'] = $this->lang->words['Words']['None'];
								$GLOBALS['block_info']['expiration'] = $this->lang->words['Words']['Never'];
								$GLOBALS['block_info']['reason'] = $this->lang->words['Words']['None'];
							}
						}

						$this->output->setContent("characters_unbanCharacter");
					}
				break;
				default :
					if($this->CheckPermissionItem("characters_manageCharacter_edit") == true)
					{
						if($_GET['write'] == "name" && loadIsAjax() == true)
						{
							if(empty($_POST['NewName']))
							{
								exit(adminShowMessage($this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeName']['Messages']['NameVoid'], 1));
							}
							elseif(strlen($_POST['NewName']) > 10)
							{
								exit(adminShowMessage($this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeName']['Messages']['MaxLength'], 2));
							}
							elseif(eregi("[^a-zA-Z0-9_!=?&-]", $_POST['NewName']))
							{
								exit(adminShowMessage($this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeName']['Messages']['CaractersInvalid'], 2));
							}
							else
							{
								$rename = $this->MuLib('Member')->RenameCharacter($_GET['charname'], $char_data['AccountID'], $_POST['NewName']);

								if($rename == "NAME_IN_USE")
								{
									exit(adminShowMessage($this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeName']['Messages']['NameInUse'], 2));
								}
								elseif($rename == "ALL_OK")
								{
									exit("<script>editCharacter_writeSuccess('name', '".str_replace("'", "\'", $_POST['NewName'])."');</script>");
								}
								else
								{
									exit(adminShowMessage(sprintf($this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeName']['Messages']['Error'], 12), 2));
								}
							}
						}
						elseif($_GET['write'] == "account" && loadIsAjax() == true)
						{
							if(empty($_POST['NewAccount']))
							{
								exit(adminShowMessage($this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeAccount']['Messages']['AccountVoid'], 1));
							}
							elseif(strlen($_POST['NewAccount']) > 10)
							{
								exit(adminShowMessage($this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeAccount']['Messages']['MaxLength'], 2));
							}
							else
							{
								$change_command = $this->MuLib('Member')->ChangeCharacterAccount($_GET['charname'], $char_data['AccountID'], $_POST['NewAccount']);

								if($change_command == "ACCOUNT_NO_EXISTS")
								{
									exit(adminShowMessage($this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeAccount']['Messages']['AccountNoExists'], 2));
								}
								elseif($change_command == "ID_ERROR")
								{
									exit(adminShowMessage($this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeAccount']['Messages']['NoSlot'], 2));
								}
								else
								{
									exit("<script>editCharacter_writeSuccess('account', '".str_replace("'", "\'", $_POST['NewAccount'])."');</script>");
								}
							}
						}
						elseif($_GET['write'] == "save")
						{
							if
							(
								strlen($_POST['C_Level']) < 1 ||
								strlen($_POST['C_LevelUpPoint']) < 1 ||
								strlen($_POST['C_Class']) < 1 ||
								strlen($_POST['C_Experience']) < 1 ||
								strlen($_POST['C_Money']) < 1 ||
								strlen($_POST['C_MapNumber']) < 1 ||
								strlen($_POST['C_MapPosX']) < 1 ||
								strlen($_POST['C_MapPosY']) < 1 ||
								strlen($_POST['C_PkCount']) < 1 ||
								strlen($_POST['C_PkLevel']) < 1 ||
								strlen($_POST['C_PkTime']) < 1 ||
								strlen($_POST['C_CtlCode']) < 1 ||
								strlen($_POST['C_HeroCount']) < 1 ||
								strlen($_POST['C_Resets']) < 1 ||
								strlen($_POST['C_RDaily']) < 1 ||
								strlen($_POST['C_RWeekly']) < 1 ||
								strlen($_POST['C_RMonthly']) < 1 ||
								strlen($_POST['C_MResets']) < 1 ||
								strlen($_POST['C_MRDaily']) < 1 ||
								strlen($_POST['C_MRWeekly']) < 1 ||
								strlen($_POST['C_MRMonthly']) < 1 ||
								strlen($_POST['C_Strength']) < 1 ||
								strlen($_POST['C_Dexterity']) < 1 ||
								strlen($_POST['C_Vitality']) < 1 ||
								strlen($_POST['C_Energy']) < 1 ||
								(strlen($_POST['C_Command']) < 1 && MUSERVER_VERSION >= 1)
							)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Save']['Messages']['FieldsVoid'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
							}
							elseif($_POST['C_Level'] < 1 || $_POST['C_Level'] > MAX_LEVEL)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Save']['Messages']['InvalidLevel'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							elseif($_POST['C_Strength'] > MAX_STRENGTH)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Save']['Messages']['MaxStrength'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							elseif($_POST['C_Dexterity'] > MAX_DEXTERITY)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Save']['Messages']['MaxDexterity'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							elseif($_POST['C_Vitality'] > MAX_VITALITY)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Save']['Messages']['MaxVitality'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							elseif($_POST['C_Energy'] > MAX_ENERGY)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Save']['Messages']['MaxEnergy'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							elseif($_POST['C_Command'] > MAX_COMMAND && MUSERVER_VERSION >= 1)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Save']['Messages']['MaxCommand'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							elseif($_POST['C_PkLevel'] < 0 || $_POST['C_PkLevel'] > 7)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Save']['Messages']['InvalidPkLevel'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							elseif(!in_array($_POST['C_CtlCode'], array(0, 1, CTLCODE_GAMEMASTER)))
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Save']['Messages']['InvalidCtlCode'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							else
							{
								$class_index = substr($_POST['C_Class'], 0, 1);
								$class_id = substr($_POST['C_Class'], 2);
								$class_number = $this->settings['CLASSCODE'][$class_id][0];

								if(!array_key_exists($class_id, $this->settings['CLASSCODE']))
								{
									$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Save']['Messages']['InvalidClass'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
								}
								else
								{
									$update_columns = array
									(
										"cLevel" => intval($_POST['C_Level']),
										"LevelUpPoint" => intval($_POST['C_LevelUpPoint']),
										"Experience" => intval($_POST['C_Experience']),
										"Strength" => intval($_POST['C_Strength']),
										"Dexterity" => intval($_POST['C_Dexterity']),
										"Vitality" => intval($_POST['C_Vitality']),
										"Energy" => intval($_POST['C_Energy']),
										"Money" => intval($_POST['C_Money']),
										"MapNumber" => intval($_POST['C_MapNumber']),
										"MapPosX" => intval($_POST['C_MapPosX']),
										"MapPosY" => intval($_POST['C_MapPosY']),
										"PkLevel" => intval($_POST['C_PkLevel']),
										"PkTime" => intval($_POST['C_PkTime']),
										"CtlCode" => intval($_POST['C_CtlCode']),	
										COLUMN_RESET => intval($_POST['C_Resets']),
										COLUMN_RDAILY => intval($_POST['C_RDaily']),
										COLUMN_RWEEKLY => intval($_POST['C_RWeekly']),
										COLUMN_RMONTHLY => intval($_POST['C_RMonthly']),
										COLUMN_MRESET => intval($_POST['C_MResets']),
										COLUMN_MRDAILY => intval($_POST['C_MRDaily']),
										COLUMN_MRWEEKLY => intval($_POST['C_MRWeekly']),
										COLUMN_MRMONTHLY => intval($_POST['C_MRMonthly']),
										COLUMN_PKCOUNT => intval($_POST['C_PkCount']),
										COLUMN_HEROCOUNT => intval($_POST['C_HeroCount'])
									);
									
									if(MUSERVER_VERSION >= 1)
									{
										$update_columns[COLUMN_COMMAND] = intval($_POST['C_Command']);
									}

									if($class_number != $char_data['Class'])
									{
										$this->MuLib('Quest')->OpenQuest($_GET['charname']);
										$this->MuLib('Quest')->GetAllQuestStatus($quests);
										$this->MuLib('Quest')->GetQuestDatabase(-1, $quest_db);

										switch($class_index)
										{
											case 2 :
												if($class_id != "LE" && $class_id != "DM" && $class_id != "FM")
												{
													$this->MuLib('Quest')->SetQuestStatus(0, 2);
													$this->MuLib('Quest')->SetQuestStatus(1, 2);
													
													if(MUSERVER_VERSION >= 4)
													{
														$this->MuLib('Quest')->SetQuestStatus(4, 3);
														$this->MuLib('Quest')->SetQuestStatus(5, 3);
														$this->MuLib('Quest')->SetQuestStatus(6, 3);
														$this->MuLib('Quest')->SetQuestStatus(7, 3);
													}
												}
											break;
											case 3 :
												if($class_id != "LE" && $class_id != "DM" && $class_id != "FM")
												{
													$this->MuLib('Quest')->SetQuestStatus(0, 2);
													$this->MuLib('Quest')->SetQuestStatus(1, 2);
													//$this->MuLib('Quest')->SetQuestStatus(2, 2);
												}
												
												$this->MuLib('Quest')->SetQuestStatus(4, 2);
												$this->MuLib('Quest')->SetQuestStatus(5, 2);
												$this->MuLib('Quest')->SetQuestStatus(6, 2);
												$this->MuLib('Quest')->SetQuestStatus(7, 2);
											break;
											default :
												$this->MuLib('Quest')->SetAllQuestStatus(3); 
											break;
										}

										$update_columns['Class'] = $this->settings['CLASSCODE'][$class_id][0];
										$update_columns['Quest'] = "0x".$this->MuLib('Quest')->CloseQuest(false);
									}

									$this->MuLib('Member')->UpdateCharacter($_GET['charname'], $update_columns);

									$GLOBALS['result_command'] = $this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Save']['Messages']['Success'];
									$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
								}
							}
						}
						elseif($_GET['write'] == "delete")
						{
							$this->MuLib('Member')->DeleteCharacter($_GET['charname'], $char_data['AccountID'], false);
							$this->loadSearchCharacters(true, adminShowMessage($this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['DeleteCharacter']['Success'], 3));
							$this->output->setContent("characters_search");

							return NULL;
						}

						$this->DB->Arguments($char_data['AccountID']);
						$this->DB->Query("SELECT * FROM ".MUACC_CORE.".dbo.MEMB_STAT WHERE memb___id = '%s'", $stat_query);

						if($this->DB->CountRows($stat_query) > 0)
						{
							$stat_fetch = $this->DB->FetchObject($stat_query);

							$stat_array = array
							(
								"server" => $this->functions->GetServerName($stat_fetch->ServerName),
								"ip" => $stat_fetch->IP,
								"date" => date("d/m/Y - h:i a", strtotime($stat_fetch->ConnectTM))
							);
						}
						else
						{
							$stat_array = array
							(
								"server" => $this->lang->words['Words']['None'],
								"ip" => $this->lang->words['Words']['None'],
								"date" => $this->lang->words['Words']['Never']
							);
						}

						$class[0] = array();
						$class[1] = array();
						$clsss[2] = array();
						
						$class[0]['DW'] = $this->settings['CLASSCODE']['DW'][1];
						$class[0]['DK'] = $this->settings['CLASSCODE']['DK'][1];
						$class[0]['FE'] = $this->settings['CLASSCODE']['FE'][1];
						
						if(MUSERVER_VERSION >= 5)
							$class[0]['SU'] = $this->settings['CLASSCODE']['SU'][1];
						
						$class[1]['SM'] = $this->settings['CLASSCODE']['SM'][1];
						$class[1]['BK'] = $this->settings['CLASSCODE']['BK'][1];
						$class[1]['ME'] = $this->settings['CLASSCODE']['ME'][1];
						
						if(MUSERVER_VERSION >= 5)
							$class[1]['BS'] = $this->settings['CLASSCODE']['BS'][1];
							
						$class[1]['MG'] = $this->settings['CLASSCODE']['MG'][1];
						
						if(MUSERVER_VERSION >= 1)
							$class[1]['DL'] = $this->settings['CLASSCODE']['DL'][1];
						
						if(MUSERVER_VERSION >= 4)
						{
							$class[2]['GM'] = $this->settings['CLASSCODE']['GM'][1];
							$class[2]['BM'] = $this->settings['CLASSCODE']['BM'][1];
							$class[2]['HE'] = $this->settings['CLASSCODE']['HE'][1];
							
							if(MUSERVER_VERSION >= 5)
								$class[2]['DIM'] = $this->settings['CLASSCODE']['DIM'][1];
							
							$class[2]['DM'] = $this->settings['CLASSCODE']['DM'][1];
							$class[2]['LE'] = $this->settings['CLASSCODE']['LE'][1];
						}
						
						if(MUSERVER_VERSION == 8)
						{
							$class[1]['RF'] = $this->settings['CLASSCODE']['RF'][1];
							$class[2]['FM'] = $this->settings['CLASSCODE']['FM'][1];
						}

						$GLOBALS['class_info'] = array
						(
							0 => $class[0],
							1 => $class[1],
							2 => $class[2]
						);

						$GLOBALS['character_info'] = array
						(
							"info" => array
							(
								"photo" => $this->functions->GetCharImage($char_data[COLUMN_CHARIMAGE]),
							),
							"data" => array
							(
								"name" => $_GET['charname'],
								"account" => $char_data['AccountID'],
								"class" => $char_data['Class'],
								"level" => $char_data['cLevel'],
								"experience" => $char_data['Experience'],
								"points" => $char_data['LevelUpPoint'],
								"money" => $char_data['Money'],
								"strength" => $char_data['Strength'],
								"dexterity" => $char_data['Dexterity'],
								"vitality" => $char_data['Vitality'],
								"energy" => $char_data['Energy'],
								"command" => $char_data[COLUMN_COMMAND] ? $char_data[COLUMN_COMMAND] : 0,
								"ctlcode" => $char_data['CtlCode'],
								"map_number" => $char_data['MapNumber'],
								"map_pos_x" => $char_data['MapPosX'],
								"map_pos_y" => $char_data['MapPosY'],
								"pk_level" => $char_data['PkLevel'],
								"pk_time" => $char_data['PkTime'],
								"pk_count" => $char_data[COLUMN_PKCOUNT],
								"hero_count" => $char_data[COLUMN_HEROCOUNT],
								"resets_general" => $char_data[COLUMN_RESET],
								"resets_daily" => $char_data[COLUMN_RDAILY],
								"resets_weekly" => $char_data[COLUMN_RWEEKLY],
								"resets_monthly" => $char_data[COLUMN_RMONTHLY],
								"mresets_general" => $char_data[COLUMN_MRESET],
								"mresets_daily" => $char_data[COLUMN_MRDAILY],
								"mresets_weekly" => $char_data[COLUMN_MRWEEKLY],
								"mresets_monthly" => $char_data[COLUMN_MRMONTHLY]
							),
							"stat" => $stat_array
						);

						$this->output->setContent("characters_editCharacter");
					}
				break;
			}
		}
	}
}