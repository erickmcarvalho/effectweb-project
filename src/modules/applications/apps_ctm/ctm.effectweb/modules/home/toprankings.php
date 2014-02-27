<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Home Page - Top Rankings
 * Last Update: 01/05/2012 - 04:27h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Home_TopRankings extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		$settings = $this->settings['HOME']['TOP_RANK'];
		$enableML = $settings['MASTER_LEVEL'][0] && MUSERVER_VERSION >= 5 ? TRUE : FALSE;
		
		# Reset: General
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($settings['RESETS'][0] == true)
		{
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_RESET,
					"WHERE" => "CtlCode < 8 OR CtlCode = ''"
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_CHARIMAGE
				),
			);
			$this->loadRankingData("resetsGeneral", $data, $settings['RESETS'][1], $settings['RESETS'][2] == true ? 1 : 0, "rankingResetsGeneral");
		}
		# Reset: Daily
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($settings['R_DAILY'][0] == true)
		{
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_RDAILY,
					"WHERE" => "CtlCode < 8 OR CtlCode = ''"
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_CHARIMAGE
				),
			);
			$this->loadRankingData("resetsDaily", $data, $settings['R_DAILY'][1], $settings['R_DAILY'][2] == true ? 1 : 0, "rankingResetsDaily");
		}
		# Reset: Weekly
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($settings['R_WEEKLY'][0] == true)
		{
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_RWEEKLY,
					"WHERE" => "CtlCode < 8 OR CtlCode = ''"
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_CHARIMAGE
				),
			);
			$this->loadRankingData("resetsWeekly", $data, $settings['R_WEEKLY'][1], $settings['R_WEEKLY'][2] == true ? 1 : 0, "rankingResetsWeekly");
		}
		# Reset: Monthly
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($settings['R_MONTHLY'][0] == true)
		{
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_RMONTHLY,
					"WHERE" => "CtlCode < 8 OR CtlCode = ''"
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_CHARIMAGE
				),
			);
			$this->loadRankingData("resetsMonthly", $data, $settings['R_MONTHLY'][1], $settings['R_MONTHLY'][2] == true ? 1 : 0, "rankingResetsMonthly");
		}
		# Master Reset: General
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($settings['MRESETS'][0] == true)
		{
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_MRESET,
					"WHERE" => "CtlCode < 8 OR CtlCode = ''"
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_CHARIMAGE
				),
			);
			$this->loadRankingData("mresetsGeneral", $data, $settings['MRESETS'][1], $settings['MRESETS'][2] == true ? 1 : 0, "rankingMResetsGeneral");
		}
		# Master Reset: Daily
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($settings['MR_DAILY'][0] == true)
		{
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_MRDAILY,
					"WHERE" => "CtlCode < 8 OR CtlCode = ''"
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_CHARIMAGE
				),
			);
			$this->loadRankingData("mresetsDaily", $data, $settings['MR_DAILY'][1], $settings['MR_DAILY'][2] == true ? 1 : 0, "rankingMResetsDaily");
		}
		# Master Reset: Weekly
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($settings['MR_WEEKLY'][0] == true)
		{
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_MRWEEKLY,
					"WHERE" => "CtlCode < 8 OR CtlCode = ''"
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_CHARIMAGE
				),
			);
			$this->loadRankingData("mresetsWeekly", $data, $settings['MR_WEEKLY'][1], $settings['MR_WEEKLY'][2] == true ? 1 : 0, "rankingMResetsWeekly");
		}
		# Master Reset: Monthly
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($settings['MR_MONTHLY'][0] == true)
		{
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_MRMONTHLY,
					"WHERE" => "CtlCode < 8 OR CtlCode = ''"
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_CHARIMAGE
				),
			);
			$this->loadRankingData("mresetsMonthly", $data, $settings['MR_MONTHLY'][1], $settings['MR_MONTHLY'][2] == true ? 1 : 0, "rankingMResetsMonthly");
		}
		# Level
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($settings['LEVEL'][0] == true)
		{
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => "cLevel",
					"WHERE" => "CtlCode < 8 OR CtlCode = ''"
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_CHARIMAGE
				),
			);
			$this->loadRankingData("level", $data, $settings['LEVEL'][1], $settings['LEVEL'][2] == true ? 1 : 0, "rankingLevel");
		}
		# Master Level
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($enableML == true)
		{
			$MASTER_LEVEL = self::instance()->functions->GetMasterLevelData();
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => $MASTER_LEVEL['DATA']['TABLE'],
					"NAME" => $MASTER_LEVEL['DATA']['NAME'],
					"COLUMN" => $MASTER_LEVEL['DATA']['LEVEL']
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_CHARIMAGE
				),
			);
			$this->loadRankingData("masterLevel", $data, $settings['MASTER_LEVEL'][1], $settings['MASTER_LEVEL'][2] == true ? 1 : 0, "rankingMasterLevel");
		}
		# Pk Kills
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($settings['PK_KILLS'][0] == true)
		{
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_PKCOUNT,
					"WHERE" => "CtlCode < 8 OR CtlCode = ''"
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_CHARIMAGE
				),
			);
			$this->loadRankingData("pkKills", $data, $settings['PK_KILLS'][1], $settings['PK_KILLS'][2] == true ? 1 : 0, "rankingPkKills");
		}
		# Hero Kills
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($settings['HERO_KILLS'][0] == true)
		{
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_HEROCOUNT,
					"WHERE" => "CtlCode < 8 OR CtlCode = ''"
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Character",
					"NAME" => "Name",
					"COLUMN" => COLUMN_CHARIMAGE
				),
			);
			$this->loadRankingData("heroKills", $data, $settings['LEVEL'][1], $settings['HERO_KILLS'][2] == true ? 1 : 0, "rankingHeroKills");
		}
		# Guilds
		# $CTM: Erick-Master
		# 01/05/2012 - 04:40h
		if($settings['GUILDS'][0] == true)
		{
			$data = array
			(
				"RANK" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Guild",
					"NAME" => "G_Name",
					"COLUMN" => "G_Score"
				),
				"IMAGE" => array
				(
					"DB" => MUGEN_CORE,
					"TABLE" => "Guild",
					"NAME" => "G_Name",
					"COLUMN" => "G_Mark"
				),
			);
			$this->loadRankingData("guilds", $data, $settings['GUILDS'][1], $settings['GUILDS'][2] == true ? 2 : 0, "rankingGuildScore");
		}
			
		$this->lang->setArguments("Home,TopRank,Cache", $this->settings['WEBCACHE']['RANKINGS']['MINUTES']);
	}
	/**
	 *	Ranking Data
	 *	Generate the ranking result
	 *
	 *	@param	string	Template var name
	 *	@param	array	Databases
	 *	@param	integer	Result Limit
	 *	@param	integer	Profile Image
	 *	@param	string	Cache Key
	 *	@return	void
	*/
	private function loadRankingData($name, $db, $limit = 5, $image = 1, $cache = NULL)
	{
		if($limit < 1) $limit = 1;
		if($limit > 5) $limit = 5;
		
		$return = array(); $i = 0;
		
		if($this->settings['WEBCACHE']['RANKINGS']['SWITCH'] == false)
		{
			$string = "USE [".$db['RANK']['DB']."]; ";
			$string .= "SELECT TOP ".(int)$limit." [".$db['RANK']['TABLE']."].[".$db['RANK']['NAME']."],[".$db['RANK']['TABLE']."].[".$db['RANK']['COLUMN']."]";
			$string .= ",[".$db['IMAGE']['TABLE']."].[".$db['IMAGE']['COLUMN']."] FROM [".$db['RANK']['DB']."].[dbo].[".$db['RANK']['TABLE']."]";
			
			if($db['RANK']['DB'].$db['RANK']['TABLE'] != $db['IMAGE']['DB'].$db['IMAGE']['TABLE'])
			{
				$string .= " JOIN [".$db['IMAGE']['DB']."].dbo.[".$db['IMAGE']['TABLE']."] ON ([".$db['IMAGE']['TABLE']."].[".$db['IMAGE']['NAME']."]";
				$string .= " = [".$db['RANK']['TABLE']."].[".$db['RANK']['NAME']."])";
			}
			
			$string .= " ".(!empty($db['RANK']['WHERE']) ? "WHERE ".$db['RANK']['WHERE']." " : NULL);
			$string .= "ORDER BY ".$db['RANK']['COLUMN']." DESC; USE [".CTMEW_CORE."];";
			
			$query = $this->DB->Query($string); 
			
			if($this->DB->CountRows($query) > 0)
			{
				while($data = $this->DB->FetchObject($query))
				{
					if($image > 0)
					{
						if($image == 2) $setImage = self::instance()->functions->GetGuildMark($data->{$db['IMAGE']['COLUMN']});
						else $setImage = self::instance()->functions->GetCharImage($data->{$db['IMAGE']['COLUMN']});
					}
					
					if($this->settings['HOME']['TOP_RANK']['FORMAT']) $result = number_format($data->{$db['RANK']['COLUMN']}, 0, FALSE, ".");
					else $result = $data->{$db['RANK']['COLUMN']};
					
					$return[] = array
					(
						"order" => $i + 1,
						"name" => $data->{$db['RANK']['NAME']},
						"result" => $result,
						"image" => $setImage
					);
					$i++;
				}
			}
		}
		else
		{
			if(file_exists(CTM_CACHE_PATH."server_cache/db_xml/mu_rankings.xml"))
			{
				$xml = CTM_FileManage::Lib('XML')->ParseXML(CTM_CACHE_PATH."server_cache/db_xml/mu_rankings.xml");
				$i = 0;
				
				foreach($xml->{$cache}->{$image == 2 ? "guildInfo" : "charInfo"} as $key => $data)
				{
					if($i >= $limit) break;
					$i++;
					
					if($image > 0)
					{
						if($image == 2) $setImage = self::instance()->functions->GetGuildMark(base64_decode($data->mark));
						else $setImage = self::instance()->functions->GetCharImage($data->image);
					}
					
					if($_HOME['TOP_RANK']['FORMAT']) $result = number_format($data->result, 0, FALSE, ".");
					else $result = $data->result;
					
					if($image == 1)
					{
						if(empty($data->guild)) $setSecondary = $this->lang->words['Words']['None'];
						else $setSecondary = $data->guild;
					}
					if($image == 2)
						$setSecondary = $data->master;
					
					$return[] = array
					(
						"order" => $data['rank'],
						"name" => $data['name'],
						"result" => $result,
						"image" => $setImage,
						"secondary" => $setSecondary
					);
				}
			}
		}
		
		$GLOBALS['home_module']['rankings'][$name] = $return;
	}
}