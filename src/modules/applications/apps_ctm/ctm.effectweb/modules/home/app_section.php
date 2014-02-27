<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Home Page
 * Last Update: 09/06/2013 - 17:35h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Home extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->lang->loadLanguageFile("home");
		
		$GLOBALS['home_module']['rankingData'] = $this->checkTopRankEnabled(TRUE);
		$GLOBALS['home_module']['webNotices'] = $this->loadNotices();
		$this->loadModules();
		$this->loadCastleSiege();
		
		$this->output->loadSkinCache("home", "homePage");
	}
	/**
	 *	Load Modules
	 *
	 *	@return	void
	*/
	private function loadModules()
	{
		if($this->settings['HOME']['FORUM']['SHOW'] == true)
		{
			require_once(THIS_APPLICATION_PATH."modules/home/forumnotices.php");
			$forumNotices = new Home_ForumNotices();
			$forumNotices->registry();
			$forumNotices->initSection();
		}
		if($GLOBALS['home_module']['rankingData'] != "NONE_RANK")
		{
			require_once(THIS_APPLICATION_PATH."modules/home/toprankings.php");
			$topRankings = new Home_TopRankings();
			$topRankings->registry();
			$topRankings->initSection();
		}
	}
	/**
	 *	Check Top Rank Enabled
	 *
	 *	@param	boolean	Return Primary Ranking
	 *	@return	boolean/string
	*/
	private function checkTopRankEnabled($return = FALSE)
	{
		$check = NULL;
		
		if($this->settings['HOME']['TOP_RANK']['RESETS'][0] == true) $check .= "ResetsGeneral|";
		if($this->settings['HOME']['TOP_RANK']['MRESETS'][0] == true) $check .= "MResetsGeneral|";
		if($this->settings['HOME']['TOP_RANK']['R_DAILY'][0] == true) $check .= "ResetsDaily|";
		if($this->settings['HOME']['TOP_RANK']['R_WEEK'][0] == true) $check .= "ResetsWeek|";
		if($this->settings['HOME']['TOP_RANK']['R_MONTH'][0] == true) $check .= "ResetsMonth|";
		if($this->settings['HOME']['TOP_RANK']['MR_DAILY'][0] == true) $check .= "MResetsDaily|";
		if($this->settings['HOME']['TOP_RANK']['MR_WEEK'][0] == true) $check .= "MResetsWeek|";
		if($this->settings['HOME']['TOP_RANK']['MR_MONTH'][0] == true) $check .= "MResetsMonth|";
		if($this->settings['HOME']['TOP_RANK']['LEVEL'][0] == true) $check .= "RankLevel|";
		if($this->settings['HOME']['TOP_RANK']['PK_KILLS'][0] == true) $check .= "PK_Kills|";
		if($this->settings['HOME']['TOP_RANK']['HERO_KILLS'][0] == true) $check .= "Hero_Kills|";
		if($this->settings['HOME']['TOP_RANK']['GUILDS'][0] == true) $check .= "Guilds|";
		
		if(MUSERVER_VERSION >= 5)
			if($this->settings['HOME']['TOP_RANK']['MASTER_LEVEL'][0] == true) $check .= "RankMLevel|";
		
		if($return) return strlen($check) > 0 ? substr($check, 0, strpos($check, "|")) : "NONE_RANK";
		return strlen($check) > 0;
	}
	/**
	 *	Notices from Site
	 *
	 *	@return	array	Result
	*/
	private function loadNotices()
	{
		if($this->settings['HOME']['NOTICES']['SHOW'] == true)
		{
			$build = $this->DB->Query("SELECT TOP ".$this->settings['HOME']['NOTICES']['LIMIT']." Title,[Date],Id FROM dbo.CTM_Notices ORDER BY Id DESC");
			$notices = array();
			
			if($this->DB->CountRows($build) > 0)
			{
				while($notice = $this->DB->FetchObject($build))
				{
					$notices[] = array
					(
						"id" => $notice->Id,
						"title" => htmlDecode($notice->Title, true),
						"post_date" => date("d/m/Y - h:i a", $notice->Date)
					);
				}
			}
			
			return $notices;
		}
	}
	/**
	 *	Castle Siege Informations
	 *
	 *	@return	void
	*/
	private function loadCastleSiege()
	{
		if($this->settings['HOME']['SIEGE']['SHOW'] == true)
		{
			$query = $this->DB->Query("EXEC dbo.CTM_GetCastleSiege");
			$data = $this->DB->FetchObject($query);
			$owner = strlen($data->GuildOwner) < 2 ? $this->lang->words['Home']['CastleSiege']['No_Owner'] : $data->GuildOwner;
			$date = explode("/", $data->SiegeEndDate);
			$date = ($date[0] - 1)."/".$date[1];
			$date = !empty($data->SiegeEndDate) ? $date : $data->SiegeEndDate;
			$date = $this->settings['HOME']['SIEGE']['DATE'] == "*" ? $date : htmlEncode($this->settings['HOME']['SIEGE']['DATE']);
			$date = empty($date) ? $this->lang->words['Home']['CastleSiege']['No_Date'] : $date;
			
			$GLOBALS['home_module']['CastleSiege'] =  array
			(
				"guildName" => $owner,
				"guildMark" => $this->functions->GetGuildMark($data->GuildMark),
				"invasionDate" => $date,
				"invasionHour" => $this->settings['HOME']['SIEGE']['HOUR']
			);
		}
	}
}