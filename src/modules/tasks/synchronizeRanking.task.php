<?php
/**
 *	Cetemaster: Effect Web 2
 *	CronJob Script System
 *
 *	Task Name: (EW.MU) Synchronize Ranking Cache
 *	Description: Update the web ranking database cache
 *
 *	Author: Erick-Master
 *	Revision: 09/06/2013 - 17:45h
 *
 *	Cetemaster Services
 *	www.cetemaster.com.br
*/

class TaskClass_SynchronizeRanking extends CronJobCommand
{
	public $taskKey		= NULL;
	
	private $time		= NULL;
	private $result		= array();
	private $count		= 0;

	//------------------------------------------
	// Hi guys!
	// Come on, start the task?
	//------------------------------------------	
	public function __construct($taskKey = NULL)
	{
		$this->taskKey = !$taskKey ? mt_rand() : $taskKey;
	}
	public function runTask()
	{
		//------------------------------------------
		// Well... gerate the rankings, right?
		//------------------------------------------
		$time = CTM_LoadTime::startTime();
		$this->time = time();
		$this->loadWrite("Starting the procedure...");
		
		//------------------------------------------
		// Resets General
		//------------------------------------------
		$this->loadWrite("Updating: Resets General");
		$this->loadSetCharRanking("RESETS", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], COLUMN_RESET);
		
		//------------------------------------------
		// Resets Daily
		//------------------------------------------
		$this->loadWrite("Updating: Resets Daily");
		$this->loadSetCharRanking("RDAILY", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], COLUMN_RDAILY);
		
		//------------------------------------------
		// Resets Week
		//------------------------------------------
		$this->loadWrite("Updating: Resets Weekly");
		$this->loadSetCharRanking("RWEEKLY", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], COLUMN_RWEEKLY);
		
		//------------------------------------------
		// Resets Month
		//------------------------------------------
		$this->loadWrite("Updating: Resets Monthly");
		$this->loadSetCharRanking("RMONTHLY", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], COLUMN_RMONTHLY);
		
		//------------------------------------------
		// Master Resets
		//------------------------------------------
		$this->loadWrite("Updating: Master Resets");
		$this->loadSetCharRanking("MRESETS", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], COLUMN_MRESET);
		
		//------------------------------------------
		// Master Resets Daily
		//------------------------------------------
		$this->loadWrite("Updating: Master Resets Daily");
		$this->loadSetCharRanking("MRDAILY", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], COLUMN_MRDAILY);
		
		//------------------------------------------
		// Master Resets Week
		//------------------------------------------
		$this->loadWrite("Updating: Master Resets Weekly");
		$this->loadSetCharRanking("MRWEEKLY", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], COLUMN_MRWEEKLY);
		
		//------------------------------------------
		// Master Resets Month
		//------------------------------------------
		$this->loadWrite("Updating: Master Resets Monthly");
		$this->loadSetCharRanking("MRMONTHLY", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], COLUMN_MRMONTHLY);
		
		//------------------------------------------
		// Level
		//------------------------------------------
		$this->loadWrite("Updating: Level");
		$this->loadSetCharRanking("LEVEL", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], "cLevel");
		
		//------------------------------------------
		// Master Level
		// If MUSERVER_VERSION >= 4 (xD)
		//------------------------------------------
		if(MUSERVER_VERSION >= 4)
		{
			$ML = $this->functions->GetMasterLevelData();
			
			$db['TABLE'] = $ML['DATA']['TABLE'];
			$db['COLUMN_NAME'] = $ML['DATA']['NAME'];
			
			$this->loadWrite("Updating: Master Level");
			$this->loadSetCharRanking("MASTER_LEVEL", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], $ML['DATA']['LEVEL'], $db);
		}
		
		//------------------------------------------
		// Pk Kills
		//------------------------------------------
		$this->loadWrite("Updating: Pk Kills");
		$this->loadSetCharRanking("PK_KILLS", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], COLUMN_PKCOUNT);
		
		//------------------------------------------
		// Hero Kills
		//------------------------------------------
		$this->loadWrite("Updating: Hero Kills");
		$this->loadSetCharRanking("HERO_KILLS", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], COLUMN_HEROCOUNT);
		
		//------------------------------------------
		// Guild Score
		//------------------------------------------
		$this->loadWrite("Updating: Guild Score");
		$this->loadSetGuildRanking("GUILD_SCORE", $this->settings['WEBCACHE']['RANKINGS']['LIMIT'], "G_Score");
		
		//------------------------------------------
		// That's it
		//------------------------------------------
		$this->loadWrite("Updating XML Cache");
		
		if($fp = fopen(CTM_CACHE_PATH."server_cache/db_xml/mu_rankings.xml", "wb"))
		{
			fwrite($fp, $this->loadCacheXML());
			fclose($fp);
			
			$this->loadWrite("Finished! Updated ".$this->count." results in ".CTM_LoadTime::resultTime($time)." seconds");
			$this->loadWrite("Next Update: ".date("d/m/Y - H:i:s", strtotime("+ ".$this->settings['WEBCACHE']['RANKINGS']['MINUTES']." minutes")));
		}
		else
		{
			//------------------------------------------
			// Failed?
			//------------------------------------------
			$this->loadWrite("Failure to update the XML Cache");
			return $this->setTaskResult($this->taskKey, "ERROR");
		}
		
		//------------------------------------------
		// End?
		//------------------------------------------
		$this->setTaskOptions($this->taskKey, array(0, 0, 0, 0, $this->settings['WEBCACHE']['RANKINGS']['MINUTES']));
		#this->setTaskOptions($this->taskKey, array(Days, Weeks, Months, Hours, Minutes));
		return NULL;
	}
	/*
	 *	Set Ranking Data (Character)
	 *
	 *	@param 	string	Ranking Name
	 *	@param	integer	Result Limit
	 *	@param	string	Result Column
	 *	@param	array	DB Settings (DATA => DataBase, TABLE => Table, COLUMN_NAME => Column Name)
	 *	@return	void
	*/
	private function loadSetCharRanking($name, $limit, $result, $db = array())
	{
		$data = !$db['DATA'] ? MUGEN_CORE : $db['DATA'];
		$table = !$db['TABLE'] ? "Character" : $db['TABLE'];
		$columnName = !$db['COLUMN_NAME'] ? "[".$data."].[dbo].[".$table."].[Name]" : "[".$data."].[dbo].[".$table."].[".$db['COLUMN_NAME']."]";
		
		$queryString = "USE [".$data."]; ";
		$queryString .= "SELECT TOP ".intval($limit)." {$columnName},[".$data."].[dbo].[".$table."].[".$result."]";
		$queryString .= ",[".MUGEN_CORE."].[dbo].[Character].[".COLUMN_CHARIMAGE."],[".MUGEN_CORE."].[dbo].[GuildMember].[G_Name] FROM {*TABLE*}";
		
		if($table != "Character")
			$queryString .= " LEFT JOIN [".MUGEN_CORE."].[dbo].[Character] ON ([".MUGEN_CORE."].[dbo].[Character].[Name] = {$columnName})";
			
		$queryString .= " LEFT JOIN [".MUGEN_CORE."].[dbo].[GuildMember] ON ([".MUGEN_CORE."].[dbo].[GuildMember].[Name] = {$columnName})";
		$queryString .= " ORDER BY ".$result." DESC; USE [".CTMEW_CORE."]";
		
		$findCharactersQ = $this->DB->Query($queryString, $data, $table);
		
		if($this->DB->CountRows($findCharactersQ) < 1)
		{
			//------------------------------------------
			// Oh shit, no result?
			//------------------------------------------
			$this->loadWrite("No result");
		}
		else
		{
			//------------------------------------------
			// Excellent, load data ;D
			//------------------------------------------
			$count = 0; $i = 1;
			
			while($findCharacters = $this->DB->FetchRow($findCharactersQ))
			{
				$this->result[$name][$i]['NAME'] = $findCharacters[0];
				$this->result[$name][$i]['RESULT'] = $findCharacters[1];
				$this->result[$name][$i]['GUILD'] = $findCharacters[3];
				$this->result[$name][$i]['IMAGE'] = $findCharacters[2];
				$count++; $i++; $this->count++;
			}
			
			$this->loadWrite("Updated: {$count} results");
		}
	}
	/*
	 *	Set Ranking Data (Guild)
	 *
	 *	@param 	string	Ranking Name
	 *	@param	integer	Result Limit
	 *	@param	string	Result Column
	 *	@return	void
	*/
	private function loadSetGuildRanking($name, $limit, $result)
	{
		$findGuildsQ = $this->DB->Query("SELECT TOP {$limit} G_Name,G_Master,G_Mark,{$result} FROM {*TABLE*} ORDER BY {$result} DESC", MUGEN_CORE, "Guild");
		
		if($this->DB->CountRows($findGuildsQ) < 1)
		{
			//------------------------------------------
			// Oh shit, no result?
			//------------------------------------------
			$this->loadWrite("No result");
		}
		else
		{
			//------------------------------------------
			// Excellent, load data ;D
			//------------------------------------------
			$count = 0; $i = 1;
			
			while($findGuilds = $this->DB->FetchRow($findGuildsQ))
			{
				$this->result[$name][$i]['NAME'] = $findGuilds[0];
				$this->result[$name][$i]['MASTER'] = $findGuilds[1];
				$this->result[$name][$i]['RESULT'] = $findGuilds[3];
				$this->result[$name][$i]['MARK'] = base64_encode($findGuilds[2]);
				$count++; $i++; $this->count++;
			}
			
			$this->loadWrite("Updated: {$count} results");
		}
	}
	/*
	 *	Return Cache in XML
	 *
	 *	@return	string
	*/
	private function loadCacheXML()
	{
		$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
		$xml .= "<rankingCache creator=\"(CTM) Cetemaster Services\" system=\"Effect Web CronJob\" version=\"".EW_BUILD_VERSION."\">\n";
		$xml .= "	<information date=\"".date("d/m/Y", $this->time)."\" hour=\"".date("H:i:s", $this->time)."\" timestamp=\"".$this->time."\" count=\"".$this->count."\" />\n";
		$xml .= "	<rankingResetsGeneral results=\"".count($this->result['RESETS'])."\">\n";
		
		if(count($this->result['RESETS']) > 0)
		{
			foreach($this->result['RESETS'] as $key => $value)
			{
				$xml .= "		<charInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<guild>".$value['GUILD']."</guild>\n";
				$xml .= "			<image>".$value['IMAGE']."</image>\n";
				$xml .= "		</charInfo>\n";
			}
		}
		
		$xml .= "	</rankingResetsGeneral>\n";
		$xml .= "	<rankingResetsDaily results=\"".count($this->result['RDAILY'])."\">\n";
		
		if(count($this->result['RDAILY']) > 0)
		{
			foreach($this->result['RDAILY'] as $key => $value)
			{
				$xml .= "		<charInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<guild>".$value['GUILD']."</guild>\n";
				$xml .= "			<image>".$value['IMAGE']."</image>\n";
				$xml .= "		</charInfo>\n";
			}
		}
		
		$xml .= "	</rankingResetsDaily>\n";
		$xml .= "	<rankingResetsWeekly results=\"".count($this->result['RWEEK'])."\">\n";
		
		if(count($this->result['RWEEKLY']) > 0)
		{
			foreach($this->result['RWEEKLY'] as $key => $value)
			{
				$xml .= "		<charInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<guild>".$value['GUILD']."</guild>\n";
				$xml .= "			<image>".$value['IMAGE']."</image>\n";
				$xml .= "		</charInfo>\n";
			}
		}
		
		$xml .= "	</rankingResetsWeekly>\n";
		$xml .= "	<rankingResetsMonthly results=\"".count($this->result['RMONTH'])."\">\n";;
		
		if(count($this->result['RMONTHLY']) > 0)
		{
			foreach($this->result['RMONTHLY'] as $key => $value)
			{
				$xml .= "		<charInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<guild>".$value['GUILD']."</guild>\n";
				$xml .= "			<image>".$value['IMAGE']."</image>\n";
				$xml .= "		</charInfo>\n";
			}
		}
		
		$xml .= "	</rankingResetsMonthly>\n";
		$xml .= "	<rankingMResetsGeneral results=\"".count($this->result['MRESETS'])."\">\n";
		
		if(count($this->result['MRESETS']) > 0)
		{
			foreach($this->result['MRESETS'] as $key => $value)
			{
				$xml .= "		<charInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<guild>".$value['GUILD']."</guild>\n";
				$xml .= "			<image>".$value['IMAGE']."</image>\n";
				$xml .= "		</charInfo>\n";
			}
		}
		
		$xml .= "	</rankingMResetsGeneral>\n";
		$xml .= "	<rankingMResetsDaily results=\"".count($this->result['MRDAILY'])."\">\n";
		
		if(count($this->result['MRDAILY']) > 0)
		{
			foreach($this->result['MRDAILY'] as $key => $value)
			{
				$xml .= "		<charInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<guild>".$value['GUILD']."</guild>\n";
				$xml .= "			<image>".$value['IMAGE']."</image>\n";
				$xml .= "		</charInfo>\n";
			}
		}
		
		$xml .= "	</rankingMResetsDaily>\n";
		$xml .= "	<rankingMResetsWeekly results=\"".count($this->result['MRWEEK'])."\">\n";
		
		if(count($this->result['MRWEEKLY']) > 0)
		{
			foreach($this->result['MRWEEKLY'] as $key => $value)
			{
				$xml .= "		<charInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<guild>".$value['GUILD']."</guild>\n";
				$xml .= "			<image>".$value['IMAGE']."</image>\n";
				$xml .= "		</charInfo>\n";
			}
		}
		
		$xml .= "	</rankingMResetsWeekly>\n";
		$xml .= "	<rankingMResetsMonthly results=\"".count($this->result['MRMONTH'])."\">\n";
		
		if(count($this->result['MRMONTHLY']) > 0)
		{
			foreach($this->result['MRMONTHLY'] as $key => $value)
			{
				$xml .= "		<charInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<guild>".$value['GUILD']."</guild>\n";
				$xml .= "			<image>".$value['IMAGE']."</image>\n";
				$xml .= "		</charInfo>\n";
			}
		}
		
		$xml .= "	</rankingMResetsMonthly>\n";
		$xml .= "	<rankingLevel results=\"".count($this->result['LEVEL'])."\">\n";;
		
		if(count($this->result['LEVEL']) > 0)
		{
			foreach($this->result['LEVEL'] as $key => $value)
			{
				$xml .= "		<charInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<guild>".$value['GUILD']."</guild>\n";
				$xml .= "			<image>".$value['IMAGE']."</image>\n";
				$xml .= "		</charInfo>\n";
			}
		}
		
		$xml .= "	</rankingLevel>\n";
		$xml .= "	<rankingMasterLevel results=\"".count($this->result['MASTER_LEVEL'])."\">\n";
		
		if(count($this->result['MASTER_LEVEL']) > 0)
		{
			foreach($this->result['MASTER_LEVEL'] as $key => $value)
			{
				$xml .= "		<charInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<guild>".$value['GUILD']."</guild>\n";
				$xml .= "			<image>".$value['IMAGE']."</image>\n";
				$xml .= "		</charInfo>\n";
			}
		}
		
		$xml .= "	</rankingMasterLevel>\n";
		$xml .= "	<rankingPkKills results=\"".count($this->result['PK_KILLS'])."\">\n";
		
		if(count($this->result['PK_KILLS']) > 0)
		{
			foreach($this->result['PK_KILLS'] as $key => $value)
			{
				$xml .= "		<charInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<guild>".$value['GUILD']."</guild>\n";
				$xml .= "			<image>".$value['IMAGE']."</image>\n";
				$xml .= "		</charInfo>\n";
			}
		}
		
		$xml .= "	</rankingPkKills>\n";
		$xml .= "	<rankingHeroKills results=\"".count($this->result['HERO_KILLS'])."\">\n";
		
		if(count($this->result['HERO_KILLS']) > 0)
		{
			foreach($this->result['HERO_KILLS'] as $key => $value)
			{
				$xml .= "		<charInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<guild>".$value['GUILD']."</guild>\n";
				$xml .= "			<image>".$value['IMAGE']."</image>\n";
				$xml .= "		</charInfo>\n";
			}
		}
		
		$xml .= "	</rankingHeroKills>\n";
		$xml .= "	<rankingGuildScore results=\"".count($this->result['GUILD_SCORE'])."\">\n";
		
		if(count($this->result['GUILD_SCORE']) > 0)
		{
			foreach($this->result['GUILD_SCORE'] as $key => $value)
			{
				$xml .= "		<guildInfo name=\"".$value['NAME']."\" rank=\"".$key."\">\n";
				$xml .= "			<master>".$value['MASTER']."</master>\n";
				$xml .= "			<result>".$value['RESULT']."</result>\n";
				$xml .= "			<mark>".$value['MARK']."</mark>\n";
				$xml .= "		</guildInfo>\n";
			}
		}
		
		$xml .= "	</rankingGuildScore>\n";
		$xml .= "</rankingCache>";
		
		return $xml;
	}
}