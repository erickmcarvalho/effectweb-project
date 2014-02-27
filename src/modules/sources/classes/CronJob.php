<?php
/**
 * Cetemaster Tech Services
 * CTM.EffectWeb *$ewVersion*
 *
 * CronJob Board
 * Last Update: 27/08/2012 - 16:07h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CronJob extends CTM_Command
{
	protected static $dbLibrary	= FALSE;
	protected static $dbDriver	= FALSE;
	protected static $dbConnect	= FALSE;
	protected static $subClass	= NULL;
	protected static $tasks		= array();
	
	private static $execResult	= NULL;
	private static $timeId		= NULL;
	private static $running		= FALSE;
	private static $debug		= FALSE;
	
	protected $DB				= NULL;
	
	/**
	 *	Init Class
	 *
	 *	@return	void
	*/
	public function Start($debug = FALSE)
	{
		self::$timeId = CTM_LoadTime::startTime();
		self::$debug = $debug;
		self::SetDB();
		
		if(!self::$dbDriver->IsConnected())
		{
			self::$dbDriver->settings['mssql']['hostname'] = MSSQL_HOSTNAME;
			self::$dbDriver->settings['mssql']['portname'] = MSSQL_PORTNAME;
			self::$dbDriver->settings['mssql']['username'] = MSSQL_USERNAME;
			self::$dbDriver->settings['mssql']['password'] = MSSQL_PASSWORD;
			self::$dbDriver->settings['mssql']['database'] = CTMEW_CORE;
			self::$dbDriver->settings['mssql']['debug'] = FALSE;
			self::$dbDriver->settings['mssql']['hideErrors'] = TRUE;
			self::$dbDriver->Connect("mssql");
			self::$dbConnect = TRUE;
		}
	}
	/**
	 *	Finish CronJob
	 *	Reset all variables
	 *
	 *	@return	void
	*/
	public function Finish()
	{
		self::$tasks = array();
		
		self::$execResult = NULL;
		self::$timeId = NULL;
	}
	/**
	 *	Get CronJob Log
	 *	Return the full log from CronJob's operation
	 *
	 *	@return	string
	*/
	public function GetCronJobLog(&$log = NULL)
	{
		return $log = self::$execResult;
	}
	/**
	 *	Run All Tasks
	 *	Find and run all CronTasks
	 *
	 *	@return	void
	*/
	public function RunAllTasks()
	{
		self::$running = TRUE;
		
		$this->loadWrite("CronJob Started");
		$this->loadGetAndRunAllTasks();
		
		$this->loadWrite("Finish CronJob operation");
		$this->loadClose();
	}
	/**
	 *	Run Task
	 *	Run a CronTask
	 *
	 *	@param	integer	Task Id
	 *	@return	void
	*/
	public function RunTask($taskId)
	{
		self::$running = TRUE;
		
		$this->loadWrite("CronJob Started");
		$this->loadWrite("Execute Task #".$taskId);
		$this->loadWrite(":CUT");
		
		$this->DB->Arguments($taskId);
		$findTaskQuery = $this->DB->Query("SELECT * FROM {*TABLE*} WHERE Id = %d", CTMEW_CORE, "CTM_CronJob");
		
		if($this->DB->CountRows($findTaskQuery) < 0)
		{
			$this->loadWrite("Task not found");
			$this->loadClose();
		}
		else
		{
			$task = $this->DB->FetchObject($findTaskQuery);
			$taskKey = md5($task->Id);
			
			$this->loadWrite("Task found: ".$task->TaskName);
			
			if(file_exists(CTM_ROOT_PATH."modules/tasks/".$task->TaskFile.".task.php"))
			{
				$this->loadExecuteTask($taskKey, $task->TaskFile);
				$this->setNextExecution($task->Id, $taskKey, explode(",", $task->OccurOptions));
						
				switch(self::$tasks[$taskKey]['result'])
				{
					case "success" :
						$this->loadWrite("Task executed with success!", 1);
						$this->loadWrite("Task executed in ".self::$tasks[$taskKey]['time']." seconds");
						$this->loadWrite(":CUT");
					break;
					case "error" :
						$this->loadWrite("Error to execute the task");
						$this->loadWrite("Task executed in ".self::$tasks[$taskKey]['time']." seconds");
						$this->loadWrite(":CUT");
					break;
					case "break" :
						return $this->loadBreakCronJob();
					break;
				}
			}
			else
			{
				$this->loadWrite("Task Script Error (404)");
				$this->loadWrite(":CUT");
			}
		}
		
		$this->loadWrite("Finish CronJob operation");
		$this->loadClose();
	}
	/**
	 *	Private: Execute Task
	 *	Execute the CronTask
	 *
	 *	@param	string	Task key
	 *	@param	string	Task file name
	 *	@return	void
	*/
	private function loadExecuteTask($taskKey, $TaskFile)
	{
		$time = CTM_LoadTime::startTime();
		
		$scriptSource = file_get_contents(CTM_ROOT_PATH."modules/tasks/".$TaskFile.".task.php");
		$dataSource = trim($scriptSource);
		$endSource = substr($dataSource, strlen($dataSource) - 2) == "?>" ? "<?" : NULL;
		
		if(substr($dataSource, 0, 2) == "<?")
			require_once(CTM_ROOT_PATH."modules/tasks/".$TaskFile.".task.php");
		else
			@eval($scriptSource.$endSource);
			
		$className = "TaskClass_";
		$className .= strtoupper(substr($TaskFile, 0, 1));
		$className .= substr($TaskFile, 1);
		
		if(class_exists($className))
		{
			$LoadTaskClass = new $className($taskKey);
			$LoadTaskClass->registry();
			$LoadTaskClass->SetDB();
			$LoadTaskClass->runTask();
		}
		else
		{
			$taskResult = "error";
		}
		
		if($scriptError)
			$taskResult = "error";
		elseif(self::$tasks[$taskKey]['result'])
			$taskResult = self::$tasks[$taskKey]['result'];
		else
			$taskResult = "success";
		
		self::$tasks[$taskKey]['result'] = $taskResult;
		self::$tasks[$taskKey]['time'] = CTM_LoadTime::resultTime($time);
		
		return NULL;
	}
	/**
	 *	Private: Set Next Execution
	 *	Set the next execution of task
	 *
	 *	@param	integer	Task ID
	 *	@param	string	Task key
	 *	@param	array	Occur options
	 *	@return	void
	*/
	private function setNextExecution($id, $key, $options)
	{
		if(self::$tasks[$key]['options']) 
			$options = self::$tasks[$key]['options'];
		
		$string = "+ ";
		
		if($options[0] > 0) $string .= $options[0]." days ";
		if($options[1] > 0) $string .= $options[1]." weeks ";
		if($options[2] > 0) $string .= $options[2]." months ";
		if($options[3] > 0) $string .= $options[3]." hours ";
		if($options[4] > 0) $string .= $options[4]." minutes ";
		
		$time = strtotime($string);
		$time = strlen($time) <> 10 ? time() : $time;
		
		$this->DB->Query("UPDATE {*TABLE*} SET LastExecution = ".time().", NextExecution = {$time} WHERE Id = {$id}", CTMEW_CORE, "CTM_CronJob");
	}
	/**
	 *	Protected: Call DB Class
	 *	Call the DB Class
	 *
	 *	@return	class	DBClass
	*/
	protected function SetDB()
	{
		if(parent::DB())
			self::$dbDriver = parent::DB();
		elseif(!self::$dbDriver)
			self::$dbDriver = new CTM_Driver();
			
		if(!self::$dbLibrary)
			self::$dbLibrary = new DBClass("mssql");
			
		return $this->DB = self::$dbLibrary;
	}
	/**
	 *	Protected: Write
	 *	Write log
	 *
	 *	@param	string	Log message (:CUT = Cut lines | :SKIP = Skip log | Misc Message)
	 *	@param	integer	Quantity of prefix
	 *	@return	void
	*/
	protected function loadWrite($message, $prefix = 1)
	{
		if(self::$running == true)
		{
			if($message == ":CUT")
				for($i = 0; $i < $prefix; $i++)
					self::$execResult .= "\r\n";
			elseif($message == ":SKIP")
				self::$execResult .= str_repeat("-", 60)."\r\n";
			else
				self::$execResult .= str_repeat("-", $prefix)." [".date("H:i:s")."] ".$message."\r\n";
		}
	}
	/**
	 *	Protected: Break CronJob
	 *	End all operations and break the CronJob
	 *
	 *	@return	void
	*/
	protected function loadBreakCronJob()
	{
		if(self::$running == true)
		{
			$this->loadWrite(":CUT");
			$this->loadWrite("Force Break CronJob");
			$this->loadClose();
		}
	}
	/**
	 *	Private: Get CronTasks
	 *	Get and run all tasks
	 *
	 *	@return	void
	*/
	private function loadGetAndRunAllTasks()
	{
		$time = time();
		
		$this->loadWrite("Get all Tasks");
		$this->loadWrite(":CUT");
		$Query = $this->DB->Query("SELECT * FROM {*TABLE*} WHERE Switch = 1 AND BeginDate <= {$time} AND (EndDate >= {$time} OR EndDate = 0)", CTMEW_CORE, "CTM_CronJob", 1);
		
		if($Query)
		{
			if($this->DB->CountRows($Query) < 1)
			{
				$this->loadWrite("It has no Task");
				$this->loadClose();
				
				return NULL;
			}
			
			while($task = $this->DB->FetchObject($Query))
			{
				$this->loadWrite("Task found: ".$task->TaskName);
				$taskKey = md5($task->Id);
				
				if(time() >= $task->NextExecution)
				{
					if(file_exists(CTM_ROOT_PATH."modules/tasks/".$task->TaskFile.".task.php"))
					{
						$this->loadExecuteTask($taskKey, $task->TaskFile);
						$this->setNextExecution($task->Id, $taskKey, explode(",", $task->OccurOptions));
						
						switch(self::$tasks[$taskKey]['result'])
						{
							case "success" :
								$this->loadWrite("Task executed with success!", 1);
								$this->loadWrite("Task executed in ".self::$tasks[$taskKey]['time']." seconds");
								$this->loadWrite(":CUT");
							break;
							case "error" :
								$this->loadWrite("Error to execute the task");
								$this->loadWrite("Task executed in ".self::$tasks[$taskKey]['time']." seconds");
								$this->loadWrite(":CUT");
							break;
							case "break" :
								return $this->loadBreakCronJob();
							break;
						}
					}
					else
					{
						$this->loadWrite("Task Script Error (404)");
						$this->loadWrite(":CUT");
						continue;
					}
				}
				else
				{
					$this->loadWrite("Task in scheduling");
					$this->loadWrite(":CUT");
					continue;
				}
			}
			
			$this->loadWrite("All CronTasks executed");
		}
	}
	/**
	 *	Private: Close
	 *	Save debug log (if self::$debug == true) and close CronJob
	 *
	 *	@return	void
	*/
	private function loadClose()
	{
		if(self::$running == true)
		{	
			$this->loadWrite("Close Operation");
			$this->loadWrite("Operation executed in ".CTM_LoadTime::resultTime(self::$timeId)." seconds");
			
			if(self::$debug == true)
			{
				if(!file_exists(EW_LOG_PATH."CronJob/"))
					mkdir(EW_LOG_PATH."CronJob/");
					
				$fp = fopen(EW_LOG_PATH."CronJob/".date("d-m-Y").EW_LOG_EXT, "a+");
				fwrite($fp, self::$execResult.(substr(self::$execResult, strlen(self::$execResult) - 2) != "\r\n" ? "\r\n" : NULL).str_repeat("=", 90)."\r\n");
				fclose($fp);
			}
			
			self::$running = FALSE;
		}
	}
}

class CronJobCommand extends CronJob
{
	/**
	 *	Set Task Result
	 *	Set the result in current task
	 *
	 *	@param	string	Task key
	 *	@param	string	Result string
	 *	@return	void
	*/
	protected function setTaskResult($key, $result)
	{
		return self::$tasks[$key]['result'] = $result;
	}
	/**
	 *	Set Task Occur Options
	 *	Set the occur options in current task
	 *
	 *	@param	string	Task key
	 *	@param	array	Options array
	 *	@return	void
	*/
	protected function setTaskOptions($key, $options)
	{
		return self::$tasks[$key]['options'] = $options;
	}
}

class DBClass extends CronJob
{
	private static $driver	= "mysql";
	
	public final function __construct($driver)
	{
		self::$driver = strtolower($driver);
	}
	public function Arguments()
	{
		$arguments = func_get_args();
		
		foreach($arguments as $value)
			parent::$dbDriver->Arguments($value);
		
		return NULL;
	}
	public function Query($string, $db = NULL, $table = NULL, $writePrefix = 1)
	{
		$setTable = $db ? $db.".dbo.".$table : $table;
		$string = str_replace("{*TABLE*}", $setTable, $string);
		
		$Query = self::$dbDriver->Query($string);
				
		if(!$Query)
		{
			parent::loadWrite("QUERY ERROR: ".$string, $writePrefix);
			return FALSE;
		}
				
		return $Query;
	}
	public function FetchRow($Query)
	{
		return parent::$dbDriver->FetchRow($Query);
	}
	public function FetchArray($Query)
	{
		return parent::$dbDriver->FetchArray($Query);
	}
	public function FetchObject($Query)
	{
		return parent::$dbDriver->FetchObject($Query);
	}
	public function CountRows($Query)
	{
		return parent::$dbDriver->CountRows($Query);
	}
}