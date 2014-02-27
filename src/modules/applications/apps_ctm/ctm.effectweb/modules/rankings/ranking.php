<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Rankings Page - Show Ranking
 * Last Update: 10/05/2012 - 20:40h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Rankings_Ranking extends CTM_EffectWeb_Rankings
{
	/**
	 *	Init Module
	 *
	 *	@param	string	Ranking
	 *	@param	integer	Limit
	 *	@return	void
	*/
	public function initSection($rank, $limit)
	{
		switch($rank)
		{
			# Reset: General
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "resetsGeneral" :
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
					)
				);
					
				$page = "resets";
				$cache = "rankingResetsGeneral";
			break;
			# Reset: Daily {Cerberus Edition}
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "resetsDaily" :
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
					)
				);
					
				$page = "rdaily";
				$cache = "rankingResetsDaily";
			break;
			# Reset: Weekly {Cerberus Edition}
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "resetsWeekly" :
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
					)
				);
					
				$page = "rweekly";
				$cache = "rankingResetsWeekly";
			break;
			# Reset: Monthly {Cerberus Edition}
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "resetsMonthly" :
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
					)
				);
					
				$page = "rmonthly";
				$cache = "rankingResetsMonthly";
			break;
			# Master Reset: General
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "masterResets" :
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
					)
				);
				
				$page = "mresets";
				$cache = "rankingMResetsGeneral";
			break;
			# Master Reset: Daily {Cerberus Edition}
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "mresetsDaily" :
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
					)
				);
				
				$page = "mrdaily";
				$cache = "rankingMResetsDaily";
			break;
			# Master Reset: Weekly {Cerberus Edition}
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "mresetsWeekly" :
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
					)
				);
				
				$page = "mrweekly";
				$cache = "rankingMResetsWeekly";
			break;
			# Master Reset: Monthly {Cerberus Edition}
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "mresetsMonthly" :
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
					)
				);
				
				$page = "mrmonthly";
				$cache = "rankingMResetsMonthly";
			break;
			# Level
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "level" :
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
					)
				);
				
				$page = "level";
				$cache = "rankingLevel";
			break;
			# Master Level
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "masterLevel" :
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
					)
				);
					
				$page = "mlevel";
				$cache = "rankingMasterLevel";
			break;
			# Pk Kills
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "pkKills" :
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
					)
				);
					
				$page = "pkkills";
				$cache = "rankingPkKills";
			break;
			# Hero Kills
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "heroKills" :
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
					)
				);
					
				$page = "herokills";
				$cache = "rankingHeroKills";
			break;
			# Guilds
			# $CTM: Erick-Master
			# 10/05/2012 - 21:04h
			case "guilds" :
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
					)
				);
					
				$page = "guilds";
				$cache = "rankingGuildScore";
			break;
		}
		
		$GLOBALS['ranking_result'] = $this->loadRankingData($rank, $data, $limit, $rank == "guilds" ? 2 : 1, $cache);
			
		$this->output->loadSkinCache("rankings", "ranking_".$rank);
		$this->output->noSetCache(true);
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
		$return = array();
		
		if($this->settings['WEBCACHE']['RANKINGS']['SWITCH'] == false)
		{
			$string = "USE [".$db['RANK']['DB']."]; ";
			$string .= "SELECT TOP ".(int)$limit." [".$db['RANK']['TABLE']."].[".$db['RANK']['NAME']."],[".$db['RANK']['TABLE']."].[".$db['RANK']['COLUMN']."]";
			$string .= ",[".$db['IMAGE']['TABLE']."].[".$db['IMAGE']['COLUMN']."]".($image < 2 ? ",[".MUGEN_CORE."].[dbo].[GuildMember].[G_Name]" : NULL);
			$string .= " FROM [".$db['RANK']['DB']."].[dbo].[".$db['RANK']['TABLE']."]";
			
			if($image < 2)
			{
				$string .= " INNER JOIN [".MUGEN_CORE."].[dbo].[GuildMember] ON ([".MUGEN_CORE."].[dbo].[GuildMember].[Name] = ";
				$string .= "[".$db['RANK']['DB']."].[dbo].[".$db['RANK']['TABLE']."].[".$db['RANK']['NAME']."])";
			}
			if($db['RANK']['DB'].$db['RANK']['TABLE'] != $db['IMAGE']['DB'].$db['IMAGE']['TABLE'])
			{
				$string .= " INNER JOIN [".$db['IMAGE']['DB']."].dbo.[".$db['IMAGE']['TABLE']."] ON ([".$db['IMAGE']['TABLE']."].[".$db['IMAGE']['NAME']."]";
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
						if($image == 2)
						{
							$setImage = self::instance()->functions->GetGuildMark($data->{$db['IMAGE']['COLUMN']});
							$setSecondary = $data->G_Master;
						}
						else
						{
							$setImage = self::instance()->functions->GetCharImage($data->{$db['IMAGE']['COLUMN']});
							$setSecondary = $data->G_Name;
						}
					}
					
					if($this->settings['HOME']['TOP_RANK']['FORMAT']) 
						$result = number_format($data->{$db['RANK']['COLUMN']}, 0, FALSE, ".");
					else 
						$result = $data->{$db['RANK']['COLUMN']};
					
					$return[$i + 1] = array
					(
						"name" => $data->{$db['RANK']['NAME']},
						"result" => $result,
						"image" => $setImage,
						"secondary" => $setSecondary
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
					if($i >= $limit) 
						break;
					$i++;
					
					if($image > 0)
					{
						if($image == 2) 
							$setImage = self::instance()->functions->GetGuildMark(base64_decode($data->mark));
						else 
							$setImage = self::instance()->functions->GetCharImage($data->image);
					}
					
					if($this->settings['RANKING']['FORMAT'] == true)
						$result = number_format($data->result, 0, false, ".");
					else
						$result = $data->result;
					
					if($image == 1)
					{
						if(empty($data->guild))
							$setSecondary = $this->lang->words['Words']['None'];
						else
							$setSecondary = $data->guild;
					}
					if($image == 2)
						$setSecondary = $data->master;
					
					$return[intval($data['rank'])] = array
					(
						"name" => $data['name'],
						"result" => $result,
						"image" => $setImage,
						"secondary" => $setSecondary
					);
				}
			}
		}
		
		return $return;
	}
}