<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Profile and search: Show guild profile
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

		if(strlen($_GET['guild']) > 0)
			$guild = $_GET['guild'];
		elseif($this->URLData[1] == "guild")
			$guild = $this->URLData[2];
		else
			$guild = $this->URLData[1];

		$this->DB->Arguments($guild);
		$guild_profile_q = $this->DB->Query("SELECT * FROM ".MUGEN_CORE.".dbo.Guild WHERE G_Name = '%s'");

		if($this->DB->CountRows($guild_profile_q) < 1)
		{
			$GLOBALS['guild_profile'] = "GUILD_NOT_FOUND";
			$GLOBALS['guild_name'] = "Error";
		}
		else
		{
			$guild_profile = $this->DB->FetchObject($guild_profile_q);
			$_members = array();

			$this->DB->Arguments($guild);
			$members_q = $this->DB->Query("SELECT ".MUGEN_CORE.".dbo.GuildMember.Name, ".MUGEN_CORE.".dbo.Character.Class, ".MUGEN_CORE.".dbo.Character.cLevel, ".MUACC_CORE.".dbo.MEMB_STAT.ConnectStat FROM ".MUGEN_CORE.".dbo.GuildMember LEFT JOIN ".MUGEN_CORE.".dbo.Character ON (".MUGEN_CORE.".dbo.Character.Name = ".MUGEN_CORE.".dbo.GuildMember.Name) LEFT JOIN ".MUACC_CORE.".dbo.MEMB_STAT ON (".MUACC_CORE.".dbo.MEMB_STAT.memb___id = ".MUGEN_CORE.".dbo.Character.AccountID) WHERE ".MUGEN_CORE.".dbo.GuildMember.G_Name = '%s' ORDER BY G_Level DESC");

			if($this->DB->CountRows($members_q) > 0)
			{
				while($members = $this->DB->FetchObject($members_q))
				{
					$_members[$members->Name] = array
					(
						"level" => $members->cLevel,
						"class" => $this->functions->ClassInfo($members->Class),
						"status" => $members->ConnectStat > 0 ? "<font color=\"green\">Online</span>" : "<font color=\"red\">Offline</font>"
					);
				}
			}

			$GLOBALS['guild_name'] = $guild_profile->G_Name;
			$GLOBALS['guild_profile'] = array
			(
				"master" => $guild_profile->G_Master,
				"score" => number_format($guild_profile, 0, false, "."),
				"notice" => htmlEncode($this->lang->words['Profile']['GuildProfile']['Notice']['Content'].$guild_profile->G_Notice),
				"image" => $this->functions->GetGuildMark($guild_profile->G_Mark),
				"members" => $_members,
				"member_count" => count($_members)
			);
		}

		$this->output->loadSkinCache("profile", "profile_guild");
	}
}