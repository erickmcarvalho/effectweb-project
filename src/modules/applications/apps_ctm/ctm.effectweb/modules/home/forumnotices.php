<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Home Page - Forum Notices
 * Last Update: 02/05/2012 - 02:40h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Home_ForumNotices extends CTM_EWCore
{
	private $config	= array();
	
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		if($this->settings['HOME']['FORUM']['SHOW'] == true)
		{
			$this->config = $this->settings['HOME']['FORUM'];
			switch($this->config['MODULE'])
			{
				case 1 : //Invision Power Board
					$setData['TABLE'] = "topics";
					$setData['FORUM_COLUMN'] = "forum_id";
					$setData['ID_COLUMN'] = "tid";
					$setData['TITLE'] = "title";
					$setData['DATE'] = "start_date";
					$setData['LINK'] = "index.php?showtopic";
				break;
				case 2 : //vBulletin
					$setData['TABLE'] = "thread";
					$setData['FORUM_COLUMN'] = "forumid";
					$setData['ID_COLUMN'] = "threadid";
					$setData['TITLE'] = "title";
					$setData['DATE'] = "dateline";
					$setData['LINK'] = "showthread.php?t";
				break;
				case 3 : //phpBB
					$setData['TABLE'] = "topics";
					$setData['FORUM_COLUMN'] = "forum_id";
					$setData['ID_COLUMN'] = "topic_id";
					$setData['TITLE'] = "topic_title";
					$setData['DATE'] = "topic_time";
					$setData['LINK'] = "viewtopic.php?t";
				break;
				case 4 : //Simple Machines Forum
					$setData['TABLE'] = "topics";
					$setData['FORUM_COLUMN'] = "id_board";
					$setData['ID_COLUMN'] = "id_topic";
					$setData['LINK'] = "index.php?topic";
					
					$setData['POST']['TABLE'] = "messages";
					$setData['POST']['TITLE'] = "subject";
					$setData['POST']['DATE'] = "poster_time";
					$setData['POST']['TOPIC_ID'] = "id_topic";
					$setData['POST']['ID'] = "id_msg";
				break;
				default : //None
					$setData = FALSE;
				break;
			}
		
			if($setData)
			{
				if($loopData = $this->loadBoardNoticesData($setData))
				{
					$GLOBALS['home_module']['forumNotices'] = $loopData;
				}
			}
			return NULL;
		}
	}
	/**
	 *	Board Notices Data
	 *	Get notice from Board System
	 *
	 *	@param	array	Settings
	 *	@return	array	Result
	*/
	private function loadBoardNoticesData($data)
	{
		$this->DB->settings['mysql']['hostname'] = $this->config['MySQL']['HOST'];
		$this->DB->settings['mysql']['hostport'] = $this->config['MySQL']['PORT'];
		$this->DB->settings['mysql']['username'] = $this->config['MySQL']['USER'];
		$this->DB->settings['mysql']['password'] = $this->config['MySQL']['PASS'];
		$this->DB->settings['mysql']['database'] = $this->config['MySQL']['DATA'];
		$this->DB->settings['mysql']['log_folder'] = "MySQL";
		$this->DB->settings['mysql']['debug'] = in_array("mysql", explode(",", CTM_SQL_DEBUG_MODE));
		$this->DB->settings['mysql']['hideErrors'] = TRUE;
		
		if($this->DB->Connect("mysql"))
		{
			$query = "SELECT * FROM ".$this->config['PREFIX'].$data['TABLE']." WHERE ";
			
			for($i = 1; $i <= sizeof($this->config['FORUM_ID']); $i++)
			{
				$this->DB->MySQL()->Arguments($this->config['FORUM_ID'][$i - 1]);
				
				if($i < count($this->config['FORUM_ID'])) $query .= $data['FORUM_COLUMN']." = %d OR ";
				else $query .= $data['FORUM_COLUMN']." = %d ";
			}
			
			$query .= "ORDER BY ".$data['ID_COLUMN']." DESC LIMIT ".$this->config['LIMIT'];
			
			$this->DB->MySQL()->Arguments($this->config['LIMIT']);
			
			if($topics = $this->DB->MySQL()->Query($query))
			{
				if($this->DB->MySQL()->CountRows($topics) > 0)
				{
					$notices = array();
					while($notice = $this->DB->MySQL()->FetchObject($topics))
					{
						if(isset($data['POST']) && is_array($data['POST']))
						{
							$this->DB->MySQL()->Arguments($data['POST']['TITLE'], $data['POST']['DATE'], $this->config['PREFIX'].$data['POST']['TABLE']);
							$this->DB->MySQL()->Arguments($data['POST']['TOPIC_ID'], $notice->{$data['ID_COLUMN']}, $data['POST']['ID']);
							
							$query = $this->DB->MySQL()->Query("SELECT %s,%s FROM %s WHERE %s = %d ORDER BY %s ASC");
							$fetch = $this->DB->MySQL()->FetchObject($query);
							
							$title = $fetch->{$data['POST']['TITLE']};
							$date = $fetch->{$data['POST']['DATE']};
						}
						else
						{
							$title = $notice->{$data['TITLE']};
							$date = $notice->{$data['DATE']};
						}
						
						$link = $this->config['LINK'];
						$link .= substr($this->config['LINK'], strlen($this->config['LINK']) - 1, 1) != "/" ? "/" : NULL;
						$link .= $data['LINK']."=".$notice->{$data['ID_COLUMN']};
						
						$notices[] = array
						(
							"title" => $this->config['UTF8_DECODE'] == true ? CTM_Text::UTF8Text($title) : $title,
							"postDate" => date("d/m/Y - h:i a", $date),
							"topicLink" => $link
						);
					}
					
					$this->DB->Clear(true, true);
					return $notices;
				}
				else
				{
					$this->DB->Clear(true, true);
					return 255;
				}
			}
			$this->DB->Clear(true, true);
			$this->DB->MySQL()->Close();
		}
		
		return false;
	}
}