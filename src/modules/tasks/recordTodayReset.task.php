<?php
/**
 *	Cetemaster: Effect Web 2
 *	CronJob Script System
 *
 *	Task Name: (EW) Record Today Reset
 *	Description: Update the record daily for zero
 *
 *	Author: Erick-Master
 *	Revision: 27/08/2012
 *
 *	Cetemaster Services
 *	www.cetemaster.com.br
*/

class TaskClass_RecordTodayReset extends CronJobCommand
{
	private $taskKey	= NULL;
	
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
		if(file_exists(CTM_CACHE_PATH."server_cache/db_ini/ew_record.ini"))
		{
			$currentData = file_get_contents(CTM_CACHE_PATH."server_cache/db_ini/ew_record.ini"); // Oh shit, this is a record today?
			$recordToday = parse_ini_file(CTM_CACHE_PATH."server_cache/db_ini/ew_record.ini", true); // What? This is a ini file?
			
			//------------------------------------------
			// Ok, file opened, and now?
			// Now, don't is day of ini, right?
			//------------------------------------------
			if($recordToday['EW.TodayRecord']['EW.RecordDate'] != date("d/m/Y"))
			{
				$newData = CTM_FileManage::Lib('IniFiles')->EditIniString("EW.TodayRecord", "EW.RecordDate", date("d/m/Y"), $currentData);
				$newData = CTM_FileManage::Lib('IniFiles')->EditIniString("EW.TodayRecord", "EW.RecordHour", "00:00:00", $newData);
				$newData = CTM_FileManage::Lib('IniFiles')->EditIniString("EW.TodayRecord", "EW.RecordCount", 0, $newData);
				
				/* CTM_FileManage::Lib('IniFiles')->EditIniString($section, $key, $newValue, $content) - Nice Function ;D */
			
				//------------------------------------------
				// Good, this is excellent!
				// Now? Now... update the ini file, right?
				//------------------------------------------
				if($fp = fopen(CTM_CACHE_PATH."server_cache/db_ini/ew_record.ini", "w"))
				{
					fwrite($fp, $newData);
					fclose($fp);
					
					//------------------------------------------
					// That's it?
					//------------------------------------------
					$this->loadWrite("Record Today reseted with success!");
				}
				else
				{
					//------------------------------------------
					// Fuck, no reset the Record Today :(
					//------------------------------------------
					return $this->setTaskResult($this->taskKey, "ERROR");
				}
			}
			else
			{
				//------------------------------------------
				// Ah, is not yet time ;D
				//------------------------------------------
				$this->loadWrite("Out of time command");
			}
		}
		else
		{
			//------------------------------------------
			// Failed?
			//------------------------------------------
			$this->loadWrite("The file of Record System not exists");
			return $this->setTaskResult($this->taskKey, "ERROR");
		}
		
		//------------------------------------------
		// End?
		//------------------------------------------
		return NULL;
	}
}