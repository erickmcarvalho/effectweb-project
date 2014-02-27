<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Users Online
 * Last Update: 08/05/2012 - 12:51h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_UsersOnline extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->lang->loadLanguageFile("usersonline");
		$load_room = $_GET['room'] ? $_GET['room'] : $this->URLData[1];
		
		if($_GET['room'])
			$load_room = intval($_GET['room']);
		elseif(substr($this->URLData[1], 0, 5) == "room-")
			$load_room = str_replace("room-", NULL, $this->URLData[1]);
		
		if(!array_key_exists($load_room, $this->settings['SERVERLIST']['ROOM_LIST']))
			$load_room = NULL;
		
		$c = MUGEN_CORE.".dbo.Character";
		$m = MUACC_CORE.".dbo.MEMB_STAT";
		$a = MUGEN_CORE.".dbo.AccountCharacter";
		
		$queryString = "SELECT {$a}.GameIDC, {$c}.cLevel, {$c}.".COLUMN_RESET.", {$c}.Class, {$c}.MapNumber, {$m}.ServerName";
		$queryString .= " FROM {$m} LEFT JOIN {$a} ON ({$a}.ID = {$m}.memb___id) LEFT JOIN {$c} ON ({$c}.Name = {$a}.GameIDC)";
		$queryString .= " WHERE {$m}.ConnectStat > 0".($load_room ? " AND ServerName = '".$this->settings['SERVERLIST']['ROOM_LIST'][$load_room][0]."'" : NULL);
		
		$find_usersOnline = $this->DB->Query($queryString);
		$_users_online = array();
		
		if($this->DB->CountRows($find_usersOnline) > 0)
		{
			while($user = $this->DB->FetchObject($find_usersOnline))
			{
				$_users_online[$user->GameIDC] = array
				(
					"level" => intval($user->cLevel),
					"resets" => number_format(intval($user->{COLUMN_RESET}), 0, false, "."),
					"class" => $this->functions->ClassInfo(intval($user->Class)),
					"map_name" => $this->functions->MapInfo(intval($user->MapNumber))
				);
				
				if(!$load_room)
					$_users_online[$user->GameIDC]['room'] = $this->functions->GetServerName($user->ServerName);
			}
		}
		
		$GLOBALS['users_online'] = array
		(
			"users" => $_users_online,
			"is_room" => $load_room == true
		);
		
		$this->lang->setArguments("UsersOnline,Title", $load_room ? $this->functions->GetServerName($load_room) : $this->lang->words['UsersOnline']['Total']);
		$this->output->loadSkinCache("usersonline", "usersonline");
	}
}