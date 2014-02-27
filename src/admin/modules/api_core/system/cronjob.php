<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: System Control - CronJob
 * Last Update: 22/08/2012 - 17:39h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_System_CronJob extends Core_Admin_System
{
	/**
	 *	Init module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		switch($_GET['index'])
		{
			case "addTask" :
				$this->loadAddTask();
				$this->output->setContent("cronjob_addTask");
			break;
			case "runTask" :
				$this->loadRunTask();
				$this->output->setContent("cronjob_runTask");
			break;
			case "editTask" :
				$this->loadEditTask();
				$this->output->setContent("cronjob_editTask");
			break;
			default :
				$this->loadManageTasks();
				$this->output->setContent("cronjob_manageTasks");
			break;
		}
	}
	/**
	 *	Private: Add Task
	 *	Add the task for run in CronJob
	 *
	 *	@return	void
	*/
	private function loadAddTask()
	{
		$GLOBALS['cronTasks'] = array();
		$GLOBALS['task_error'] = FALSE;
		
		$open_dir = opendir(CTM_ROOT_PATH."modules/tasks");
		$tasks = array();
		
		if(!$open_dir)
			return $GLOBALS['task_error'] = TRUE;
			
		while($read_dir = readdir($open_dir))
		{
			$extension = substr($read_dir, -9, 9);
			
			if($extension == ".task.php")
			{
				$tasks[] = substr($read_dir, 0, strlen($read_dir) - 9);
			}
		}
		
		if(count($tasks) < 1)
			return $GLOBALS['task_error'] = TRUE;
			
		$GLOBALS['cronTasks'] = $tasks;
		
		if($_GET['write'] == true)
		{	
			if(empty($_POST['TaskName']))
			{
				$GLOBALS['result_command'] = adminShowMessage($this->lang->words['System']['CronJob']['AddTask']['Messages']['NameVoid'], 1);
			}
			elseif(!in_array($_POST['TaskFile'], $tasks))
			{
				$GLOBALS['result_command'] = adminShowMessage($this->lang->words['System']['CronJob']['AddTask']['Messages']['InvalidFile'], 2);
			}
			else
			{
				if(empty($_POST['EveryDays']))
				{
					$_POST['EveryDays'] = 0;
					$count++;
				}
				if(empty($_POST['EveryWeeks']))
				{
					$_POST['EveryWeeks'] = 0;
					$count++;
				}
				if(empty($_POST['EveryMonths']))
				{
					$_POST['EveryMonths'] = 0;
					$count++;
				}
				if(empty($_POST['EveryHours']))
				{
					$_POST['EveryHours'] = 0;
					$count++;
				}
				if(empty($_POST['EveryMinutes']))
				{
					$_POST['EveryMinutes'] = 0;
					$count++;
				}
				
				if($count == 5)
				{
					$GLOBALS['result_command'] = adminShowMessage($this->lang->words['System']['CronJob']['AddCronTab']['Messages']['SetOccur'], 2);
				}
				else
				{
					$time = time();
					
					$occurOptions = $_POST['EveryDays'].",";
					$occurOptions .= $_POST['EveryWeeks'].",";
					$occurOptions .= $_POST['EveryMonths'].",";
					$occurOptions .= $_POST['EveryHours'].",";
					$occurOptions .= $_POST['EveryMinutes'];
					
					$beginDate = 0;
					$endDate = 0;
					
					if($_POST['BeginDate'])
					{
						$date = explode("/", $_POST['BeginDate']);
						$hour = $_POST['BeginHour'] ? explode(":", $_POST['BeginHour']) : array(date("H"), date("i"));
						$beginDate = mktime($hour[0], $hour[1], 0, $date[0], $date[1], $date[2]);
					}
					
					if($_POST['EndDate'])
					{
						$date = explode("/", $_POST['EndDate']);
						$hour = $_POST['EndDate'] ? explode(":", $_POST['EndDate']) : array(23, 59);
						$endDate = mktime($hour[0], $hour[1], 0, $date[0], $date[1], $date[2]);
					}
					
					$beginDate = strlen($beginDate) <> 10 ? 0 : $beginDate;
					$endDate = strlen($endDate) <> 10 ? 0 : $endDate;
					
					if(!$_POST['EndEnable']) $endDate = 0;
					
					$insert_columns = array
					(
						"TaskName" => utf8_encode($_POST['TaskName']),
						"TaskDescription" => utf8_encode($_POST['TaskDescription']),
						"TaskFile" => $_POST['TaskFile'],
						"Switch" => $_POST['Switch'] == 1 ? 1 : 0,
						"NextExecution" => $time,
						"BeginDate" => $beginDate,
						"EndDate" => $endDate,
						"OccurOptions" => $occurOptions,
					);
					
					$this->DB->ForceDataType("Switch", "integer");
					$this->DB->ForceDataType("NextExecution", "integer");
					$this->DB->ForceDataType("BeginDate", "integer");
					$this->DB->ForceDataType("EndDate", "integer");
					$this->DB->Insert("CTM_CronJob", $insert_columns);
					
					$id = $this->DB->GetLastedId();
					
					if($_GET['run'] == true)
						exit("<script>window.location = '?app=core&module=system&section=cronjob&index=runTask&id={$id}';</script>");
					
					$GLOBALS['result_command'] = $this->lang->words['System']['CronJob']['AddTask']['Messages']['Success'];
					$GLOBALS['result_command'] = sprintf($GLOBALS['result_command'], $id, date("d/m/Y - H:i:s", $beginDate));
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
				}
			}
		}
	}
	/**
	 *	Private: Manage Tasks
	 *	Manage all CronTasks
	 *
	 *	@return	void
	*/
	private function loadManageTasks()
	{
		if(!empty($_GET['remove']))
		{
			$this->DB->Arguments($_GET['remove']);
			$this->DB->Query("SELECT 1 FROM dbo.CTM_CronJob WHERE Id = %d", $check_task);
			
			if($this->DB->CountRows($check_task) < 1)
			{
				$GLOBALS['result_command'] = adminShowMessage($this->lang->words['System']['CronJob']['ManageTasks']['RemoveTask']['Messages']['NotExists'], 2);
			}
			else
			{
				$this->DB->Arguments($_GET['remove']);
				$this->DB->Delete("CTM_CronJob", "Id = %d");
				$GLOBALS['result_command'] = adminShowMessage($this->lang->words['System']['CronJob']['ManageTasks']['RemoveTask']['Messages']['Success'], 3);
			}
		}
		
		$findCronTasksQ = $this->DB->Select("*", "CTM_CronJob", NULL, "Switch DESC, Id DESC");
		$tasks = array();
		
		if($this->DB->CountRows($findCronTasksQ) > 0)
		{
			while($findCronTasks = $this->DB->FetchObject($findCronTasksQ))
			{
				$last_execution = $findCronTasks->LastExecution == 0 ? "Never" : date("d/m/Y - H:i:s", $findCronTasks->LastExecution);
				$next_execution = $findCronTasks->NextExecution == 0 ? "Never" : date("d/m/Y - H:i:s", $findCronTasks->NextExecution);
				//$beginDate = $findCronTasks->BeginDate == 0 ? "Never" : date("d/m/Y - H:i:s", $findCronTasks->BeginDate);
				//$endDate = $findCronTasks->EndDate == 0 ? "Never" : date("d/m/Y - H:i:s", $findCronTasks->EndDate);
				
				$tasks[$findCronTasks->Id] = array
				(
					"name" => $findCronTasks->TaskName,
					"description" => $findCronTasks->TaskDescription,
					"switch" => $findCronTasks->Switch,
					"last_execution" => $last_execution,
					"next_execution" => $next_execution,
					//"begin_date" => $beginDate,
					//"end_date" => $endDate,
					"occur_options" => explode(",", $findCronTasks->OccurOptions)
				);
			}
			
			$GLOBALS['manage_tasks'] = $tasks;
		}
	}
	/**
	 *	Private: Run Task
	 *	Run a CronTask
	 *
	 *	@return	void
	*/
	private function loadRunTask()
	{
		$GLOBALS['task_error'] = FALSE;
		
		$this->DB->Arguments($_GET['id']);
		$this->DB->Query("SELECT 1 FROM dbo.CTM_CronJob WHERE Id = %d", $check_exists);
		
		if($this->DB->CountRows($check_exists) < 1)
			return $GLOBALS['task_error'] = TRUE;
			
		$CronJob = new CronJob();
		$CronJob->Start(FALSE);
		$CronJob->RunTask($_GET['id']);
		$CronJob->GetCronJobLog($CronJobResult);
		$CronJob->Finish();
		
		$GLOBALS['cronjob_result'] = $CronJobResult;
	}
	/**
	 *	Private: Edit Task
	 *	Edit the task registed
	 *
	 *	@return	void
	*/
	private function loadEditTask()
	{
		$GLOBALS['cronTasks'] = array();
		$GLOBALS['task_error'] = 0;
		
		$this->DB->Arguments($_GET['id']);
		$this->DB->Query("SELECT 1 FROM dbo.CTM_CronJob WHERE Id = %d", $checkTask);
		
		if($this->DB->CountRows($checkTask) < 1)
			return $GLOBALS['task_error'] = 1;
		
		$open_dir = opendir(CTM_ROOT_PATH."modules/tasks");
		$tasks = array();
		
		if(!$open_dir)
			return $GLOBALS['task_error'] = 2;
			
		while($read_dir = readdir($open_dir))
		{
			$extension = substr($read_dir, -9, 9);
			
			if($extension == ".task.php")
			{
				$tasks[] = substr($read_dir, 0, strlen($read_dir) - 9);
			}
		}
		
		if(count($tasks) < 1)
			return $GLOBALS['task_error'] = 2;
			
		$GLOBALS['cronTasks'] = $tasks;
		
		if($_GET['write'] == true)
		{	
			if(empty($_POST['TaskName']))
			{
				$GLOBALS['result_command'] = adminShowMessage($this->lang->words['System']['CronJob']['AddTask']['Messages']['NameVoid'], 1);
			}
			elseif(!in_array($_POST['TaskFile'], $tasks))
			{
				$GLOBALS['result_command'] = adminShowMessage($this->lang->words['System']['CronJob']['AddTask']['Messages']['InvalidFile'], 2);
			}
			else
			{
				if(empty($_POST['EveryDays']))
				{
					$_POST['EveryDays'] = 0;
					$count++;
				}
				if(empty($_POST['EveryWeeks']))
				{
					$_POST['EveryWeeks'] = 0;
					$count++;
				}
				if(empty($_POST['EveryMonths']))
				{
					$_POST['EveryMonths'] = 0;
					$count++;
				}
				if(empty($_POST['EveryHours']))
				{
					$_POST['EveryHours'] = 0;
					$count++;
				}
				if(empty($_POST['EveryMinutes']))
				{
					$_POST['EveryMinutes'] = 0;
					$count++;
				}
				
				if($count == 5)
				{
					$GLOBALS['result_command'] = adminShowMessage($this->lang->words['System']['CronJob']['AddCronTab']['Messages']['SetOccur'], 2);
				}
				else
				{
					$time = time();
					
					$occurOptions = $_POST['EveryDays'].",";
					$occurOptions .= $_POST['EveryWeeks'].",";
					$occurOptions .= $_POST['EveryMonths'].",";
					$occurOptions .= $_POST['EveryHours'].",";
					$occurOptions .= $_POST['EveryMinutes'];
					
					$beginDate = 0;
					$endDate = 0;
					
					if($_POST['BeginDate'])
					{
						$date = explode("/", $_POST['BeginDate']);
						$hour = $_POST['BeginHour'] ? explode(":", $_POST['BeginHour']) : array(date("H"), date("i"));
						$beginDate = mktime($hour[0], $hour[1], 0, $date[0], $date[1], $date[2]);
					}
					
					if($_POST['EndDate'])
					{
						$date = explode("/", $_POST['EndDate']);
						$hour = $_POST['EndDate'] ? explode(":", $_POST['EndDate']) : array(23, 59);
						$endDate = mktime($hour[0], $hour[1], 0, $date[0], $date[1], $date[2]);
					}
					
					$beginDate = strlen($beginDate) <> 10 ? 0 : $beginDate;
					$endDate = strlen($endDate) <> 10 ? 0 : $endDate;
					
					if(!$_POST['EndEnable']) $endDate = 0;
					
					$update_columns = array
					(
						"TaskName" => utf8_encode($_POST['TaskName']),
						"TaskDescription" => utf8_encode($_POST['TaskDescription']),
						"TaskFile" => $_POST['TaskFile'],
						"Switch" => $_POST['Switch'] == 1 ? 1 : 0,
						"NextExecution" => $time,
						"BeginDate" => $beginDate,
						"EndDate" => $endDate,
						"OccurOptions" => $occurOptions,
					);
					
					$this->DB->ForceDataType("Switch", "integer");
					$this->DB->ForceDataType("NextExecution", "integer");
					$this->DB->ForceDataType("BeginDate", "integer");
					$this->DB->ForceDataType("EndDate", "integer");
					
					$this->DB->Arguments($_GET['id']);
					$this->DB->Update("CTM_CronJob", $update_columns, "Id = %d");
					
					if($_GET['run'] == true)
						exit("<script>window.location = '?app=core&module=system&section=cronjob&index=runTask&id={$id}';</script>");
					
					$GLOBALS['result_command'] = $this->lang->words['System']['CronJob']['EditTask']['Messages']['Success'];
					$GLOBALS['result_command'] = sprintf($GLOBALS['result_command'], $_GET['id'], date("d/m/Y - H:i:s", $beginDate));
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
				}
			}
		}
		
		$this->DB->Arguments($_GET['id']);
		$findCronTasksQ = $this->DB->Select("*", "CTM_CronJob", "Id = %d");
		$findCronTask = $this->DB->FetchObject($findCronTaskQ);
		
		$GLOBALS['cron_task'] = array
		(
			"id" => intval($findCronTask->Id),
			"name" => utf8_decode(htmlEncode($findCronTask->TaskName)),
			"description" => utf8_decode(htmlEncode($findCronTask->TaskDescription)),
			"file" => $findCronTask->TaskFile,
			"switch" => $findCronTask->Switch,
			"begin_date" => date("m/d/Y", $findCronTask->BeginDate),
			"begin_hour" => date("H:i", $findCronTask->BeginDate),
			"end_date" => strlen($findCronTask->EndDate) == 10 ? date("m/d/Y", $findCronTask->EndDate) : NULL,
			"end_hour" => strlen($findCronTask->EndDate) == 10 ? date("H:i", $findCronTask->EndDate) : "00:00",
			"end_enabled" => strlen($findCronTask->EndDate) == 10,
			"occur_options" => explode(",", $findCronTask->OccurOptions),
		);
	}
}