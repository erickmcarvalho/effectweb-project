<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Profile and search: Show char profile
 * Last Update: 05/09/2013 - 01:52h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Profile extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->lang->loadLanguageFile("profile");

		if(strlen($_GET['char']) > 0)
			$character = $_GET['char'];
		elseif($this->URLData[1] == "char")
			$character = $this->URLData[2];
		else
			$character = $this->URLData[1];

		$full_profile = $this->MuLib('Member')->LoadChar($character);

		if($full_profile == false)
		{
			$GLOBALS['char_profile'] = "CHAR_NOT_FOUND";
			$GLOBALS['char_name'] = "Error";
		}
		else
		{
			$GLOBALS['char_name'] = $full_profile['Name'];

			$this->DB->Arguments($character);
			$this->DB->Query("SELECT * FROM dbo.CTM_CharProfile WHERE Name = '%s'", $profile_settings_q);

			if($this->DB->CountRows($profile_settings_q) < 1)
			{
				$profile_settings['ShowProfile'] = 1;
				$GLOBALS['profile_settings'] = array
				(
					"ShowProfile" => true,
					"ShowSkills" => true,
					"ShowResets" => true,
					"ShowMap" => true,
					"ShowStatus" => true
				);
			}
			else
			{
				$profile_settings = $this->DB->FetchArray($profile_settings_q);

				if($profile_settings['ShowProfile'] == 1)
				{
					$GLOBALS['profile_settings'] = array
					(
						"ShowProfile" => $profile_settings['ShowProfile'] == 1,
						"ShowSkills" => $profile_settings['ShowSkills'] == 1,
						"ShowResets" => $profile_settings['ShowResets'] == 1,
						"ShowMap" => $profile_settings['ShowMap'] == 1,
						"ShowStatus" => $profile_settings['ShowStatus'] == 1
					);
				}
			}

			if($profile_settings['ShowProfile'] == 1)
			{
				$this->DB->Query("SELECT ServerName, ConnectStat FROM ".MUACC_CORE.".dbo.MEMB_STAT WHERE memb___id = '".$full_profile['AccountID']."'", $server_stat_q);
				$this->DB->Query("SELECT ".MUGEN_CORE.".dbo.Guild.G_Name, ".MUGEN_CORE.".dbo.Guild.G_Mark FROM ".MUGEN_CORE.".dbo.GuildMember JOIN ".MUGEN_CORE.".dbo.Guild ON (".MUGEN_CORE.".dbo.Guild.G_Name = ".MUGEN_CORE.".dbo.GuildMember.G_Name) WHERE ".MUGEN_CORE.".dbo.GuildMember.Name = '".$full_profile['Name']."'", $guild_q);

				if($this->DB->CountRows($server_stat_q) < 1)
				{
					$GLOBALS['char_status'] = array
					(
						"server" => $this->lang->words['None'],
						"status" => "<font color=\"red\">Offline</font>"
					);
				}
				else
				{
					$server_stat = $this->DB->FetchObject($server_stat_q);

					$GLOBALS['char_status'] = array
					(
						"server" => $this->functions->GetServerName($server_stat->ServerName),
						"status" => $server_stat->ConnectStat > 0 ? "<font color=\"green\">Online</span>" : "<font color=\"red\">Offline</font>"
					);
				}

				if($this->DB->CountRows($guild_q) < 1)
				{
					$GLOBALS['char_guild'] = array
					(
						"name" => $this->lang->words['Words']['None'],
						"image" => $this->functions->GetGuildMark(false)
					);
				}
				else
				{
					$guild = $this->DB->FetchObject($guild_q);

					$GLOBALS['char_guild'] = array
					(
						"name" => $guild->G_Name,
						"image" => $this->functions->GetGuildMark($guild->G_Mark)
					);
				}

				if(MUSERVER_VERSION >= 5)
				{
					$_ML_DATA = $this->functions->GetMasterLevelData();

					$this->DB->Query("SELECT ".$_ML_DATA['DATA']['LEVEL']." FROM ".MUGEN_CORE.".dbo.".$_ML_DATA['DATA']['TABLE']." WHERE ".$_ML_DATA['DATA']['NAME']." = '".$full_profile['Name']."'", $masterlevel_q);

					if($this->DB->CountRows($masterlevel_q))
					{
						$GLOBALS['char_masterlevel'] = 0;
					}
					else
					{
						$masterlevel = $this->DB->FetchObject($masterlevel_q);
						$GLOBALS['char_masterlevel'] = $masterlevel->{$_ML_DATA['LEVEL']};
					}
				}

				$GLOBALS['char_profile'] = $full_profile;
			}
			else
			{
				$GLOBALS['char_profile'] = "PROFILE_DISABLED";
			}
		}

		$this->output->loadSkinCache("profile", "profile_char");
	}
}