<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Informations Page - Server Team
 * Last Update: 07/05/2012 - 21:03h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Infos_ServerTeam extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		$ma = MUACC_CORE.".dbo."; $mg = MUGEN_CORE.".dbo.";
		$queryString = "SELECT CTM_TeamMembers.*, CTM_TeamGroups.Name AS GroupName, CTM_TeamGroups.GroupTitle, CTM_TeamGroups.FormatPrefix, CTM_TeamGroups.FormatSuffix";
		$queryString .= ", {$ma}MEMB_STAT.ConnectStat, {$ma}MEMB_STAT.ServerName, {$mg}Character.Class, {$mg}Character.".COLUMN_CHARIMAGE;
		$queryString .= " FROM ".CTMEW_CORE.".dbo.CTM_TeamMembers LEFT JOIN ".CTMEW_CORE.".dbo.CTM_TeamGroups ON (CTM_TeamGroups.Id = CTM_TeamMembers.PrimaryGroup)";
		$queryString .= " LEFT JOIN ".MUACC_CORE.".dbo.MEMB_STAT ON ({$ma}MEMB_STAT.memb___id = CTM_TeamMembers.Account)";
		$queryString .= " LEFT JOIN ".MUGEN_CORE.".dbo.Character ON ({$mg}Character.Name = CTM_TeamMembers.Name) ORDER BY CTM_TeamMembers.Id ASC";
		
		$query = $this->DB->Query($queryString);
		$members = array();
		
		if($this->DB->CountRows($query) > 0)
		{
			while($member = $this->DB->FetchObject($query))
			{
				$title = strlen($member->CustomTitle) < 2 ? $member->GroupTitle : $member->CustomTitle;
				$status = $member->ConnectStat > 0 ? "<font color=\"green\">Online</span>" : "<font color=\"red\">Offline</font>";
				$server = $this->functions->GetServerName($member->ServerName);
			
				$members[] = array
				(
					"name" => utf8_decode($member->Name),
					"contact" => $member->Contact,
					"group" => utf8_decode($member->GroupName),
					"title" => utf8_decode($title),
					"image" => $this->functions->GetCharImage($member->{COLUMN_CHARIMAGE}),
					"class" => $this->functions->ClassInfo($member->Class),
					"status" => $status,
					"server" => $server,
					"format_prefix" => htmlDecode($member->FormatPrefix, TRUE),
					"format_suffix" => htmlDecode($member->FormatSuffix, TRUE)
				);
			}
		}
		
		$GLOBALS['team_members'] = $members;
		unset($members);
	}
}