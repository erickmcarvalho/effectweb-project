<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Rankings Page
 * Last Update: 10/05/2012 - 20:40h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Rankings extends CTM_EWCore
{
	protected $rankings		= array();
	protected $_settings	= array();
	protected $categorys	= array();
	
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function init()
	{
		$this->lang->loadLanguageFile("rankings");
		
		if(!empty($_GET['load']))
		{
			$this->setRankings();
			
			if(!in_array($_GET['load'], $this->rankings))
				exit("<div class=\"error-box\">".$this->lang->words['Rankings']['LoadRank']['Messages']['InvalidRank']."</div>");
			elseif($this->loadCheckEnableRanking($_GET['load']) == false)
				exit("<div class=\"error-box\">".$this->lang->words['Rankings']['LoadRank']['Messages']['Disabled']."</div>");
			
			require_once(THIS_APPLICATION_PATH."modules/rankings/ranking.php");
			
			$showRanking = new Rankings_Ranking();
			$showRanking->registry();
			$showRanking->initSection($_GET['load'], $this->settings['RANKING'][$this->_settings[array_search($_GET['load'], $this->rankings)]][1]);
		}
		else
		{
			require_once(THIS_APPLICATION_PATH."modules/rankings/generator.php");
			
			$rankGenerator = new Rankings_Generator();
			$rankGenerator->registry();
			$rankGenerator->setRankings();
			$rankGenerator->initSection();
		}
	}
	/**
	 *	Set Rankings
	 *
	 *	@return	void
	*/
	protected function setRankings()
	{
		require_once(THIS_APPLICATION_PATH."modules/rankings/set_rankings.php");
		
		$this->rankings = $_rankings;
		$this->_settings = $_settings;
		$this->categorys = $_categorys;
	}
	/**
	 *	Check Ranking Ebaled
	 *
	 *	@param	string	Ranking
	 *	@return	boolean
	*/
	protected function loadCheckEnableRanking($rank)
	{
		if($rank == "masterLevel")
			if(MUSERVER_VERSION < 5) return false;
			
		return $this->settings['RANKING'][$this->_settings[array_search($rank, $this->rankings)]][0] == true;
	}
}