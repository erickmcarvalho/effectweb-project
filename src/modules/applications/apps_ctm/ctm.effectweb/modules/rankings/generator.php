<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Rankings Page - Generator
 * Last Update: 10/05/2012 - 20:40h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Rankings_Generator extends CTM_EffectWeb_Rankings
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		if($_GET['gerate'] == TRUE)
		{
			if(empty($_POST['Ranking']))
				exit("<div class=\"warning-box\">".$this->lang->words['Rankings']['Generator']['Messages']['SelectRank']."</div>");
			elseif(empty($_POST['Limit']))
				exit("<div class=\"warning-box\">".$this->lang->words['Rankings']['Generator']['Messages']['SelectLimit']."</div>");
			elseif(!in_array($_POST['Ranking'], $this->rankings))
				exit("<div class=\"error-box\">".$this->lang->words['Rankings']['Generator']['Messages']['InvalidRank']."</div>");
			elseif(!in_array($_POST['Limit'], $this->settings['RANKING']['GENERATOR']['LIMIT']))
				exit("<div class=\"error-box\">".$this->lang->words['Rankings']['Generator']['Messages']['InvalidLimit']."</div>");
			elseif(!self::loadCheckEnableRanking($_POST['Ranking']))
				exit("<div class=\"error-box\">".$this->lang->words['Rankings']['Generator']['Messages']['Disabled']."</div>");
			else
				$this->loadRanking($_POST['Ranking'], $_POST['Limit']);
		}
		else
		{
			$count = array();
			foreach($this->categorys as $key => $value)
			{
				if(!array_key_exists($key, $count)) $count[$key] = 0;
				
				foreach($value as $ranking)
					if($this->settings['RANKING'][$this->_settings[$ranking]][0] == true)
						$count[$key]++;
						
				$GLOBALS['ranking_generator']['one_'.$key.'_enabled'] = $count > 0;
			}
			
			if(!empty($_GET['rank']) || (!empty($this->URLData[1]) && substr($this->URLData[1], 0, 1) != "&"))
			{
				$ranking = $_GET['rank'] ? $_GET['rank'] : $this->URLData[1];
				$GLOBALS['ranking_generator']['auto_load_ranking'] = $ranking;
			}
			
			$this->lang->setArguments("Rankings,Generator,Cache", $this->settings['WEBCACHE']['RANKINGS']['MINUTES']);
			$this->output->loadSkinCache("rankings", "rankingPage");
		}
	}
	/**
	 *	Load Ranking
	 *
	 *	@param	string	Ranking String
	 *	@param	integer	Ranking Limit
	 *	@return	void
	*/
	private function loadRanking($ranking, $limit)
	{
		require_once(THIS_APPLICATION_PATH."modules/rankings/ranking.php");
			
		$showRanking = new Rankings_Ranking();
		$showRanking->registry();
		$showRanking->initSection($ranking, $limit);
	}
}