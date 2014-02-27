<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Database Layer
 * Author: $CTM['Erick-Master']
 * Last Update: 26/04/2012 - 20:01h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

if(CTM_Framework::CheckValues() == false)
{
	print "<h1>CTM Fatal Error</h1><hr>You do not have permission to use this API.";
	print "<hr><address>Cetemaster Framework - www.cetemaster.com</address>";
	exit();
}

class CTM_Driver extends CTM_Framework
{
	public $settings				= NULL;
	
	private $arguments				= array();
	private $parameters				= array();
	private $noEscapeFields			= array();
	private $forceDataType			= array();
	private $fields					= array();
	
	protected $drivers				= array();
	protected $localDriver			= NULL;
	protected $tempDriver			= NULL;
	protected $queryResource		= NULL;
	
	private static $instanceClass	= NULL;
	
	/**
	 *	Connect to Driver
	 *	Instantiate and connect to Driver
	 *
	 *	@param	string	Driver name
	 *	@param	boolean	Set default driver
	 *	@return	boolean
	*/
	public function Connect($driver, $default = FALSE)
	{
		require_once(self::LibGetRealPath(self::DRIVER_LIB_FOLDER."driverInstance.lib.php"));

		if(!$this->drivers[$driver])
		{
			if(!file_exists(self::LibGetRealPath(self::DRIVER_LIB_FOLDER).strtolower($driver)."Client.lib.php"))
				return FALSE;
			
			require_once(self::LibGetRealPath(self::DRIVER_LIB_FOLDER).strtolower($driver)."Client.lib.php");
			$this->drivers[$callClient->Name] = $callClient;
		}
		else
			$callClient = $this->drivers[$driver];
		
		if($default || !$this->localDriver)
			$this->localDriver = $callClient->Name;
		else
			$this->tempDriver = $callClient->Name;
		
		$callClient->settings = $this->settings[$driver];
		$callClient->StartConnection();
		
		switch($callClient->Result()->Connect)
		{
			case "NO_PHP_EXTENSION" :
				$this->DebugSQL(self::instanceClass()->LoadMessages($callClient->Name, "logExtensionNotLoaded"));
				$this->ErrorSQL(self::instanceClass()->LoadMessages($callClient->Name, "extensionNotLoaded"));
			break;
			case "CONNECTION_FAILED" :
				$this->DebugSQL(self::instanceClass()->LoadMessages($callClient->Name, "logConnectionFailed"));
				$this->ErrorSQL(self::instanceClass()->LoadMessages($callClient->Name, "connectionFailed"));
			break;
			case "DATABASE_FAILED" :
				$this->DebugSQL(self::instanceClass()->LoadMessages($callClient->Name, "logDatabaseFailed"));
				$this->ErrorSQL(self::instanceClass()->LoadMessages($callClient->Name, "databaseFailed"));
			break;
			case "CONNECTED" :
				$this->tempDriver = NULL;
				return TRUE;
			break;
		}
		
		$this->tempDriver = NULL;
	}
	/**
	 *	Execute Query
	 *	Execute query string
	 *
	 *	@param	string		Query String
	 *	@param	&resource	Query Resource
	 *	@return	resource
	*/
	public function Query($string, &$resource = NULL)
	{
		$this->Clear(TRUE, FALSE, FALSE);
		$string = self::loadCompileString($string);
		
		$resource = self::callClient()->ExecuteQuery($string);
		
		if(!$resource)
		{
			$this->DebugSQL(self::instanceClass()->LoadMessages(self::callClient()->Name, "logQueryFailed")." ".$string);
			$this->ErrorSQL(self::instanceClass()->LoadMessages(self::callClient()->Name, "queryFailed"), $string);
				
			$this->Clear(TRUE, TRUE);
			return FALSE;
		}
		else
		{
			$this->Clear(TRUE, TRUE);
			$this->queryResource = $resource;
			return $this->queryResource;
		}
	}
	/**
	 *	Driver Change Link
	 *	Change link of driver connection
	 *
	 *	@param	integer	Link Number
	 *	@return	void
	*/
	public function ChangeLink($new_link)
	{
		return self::callClient()->ChangeConnection($new_link);
	}
	/**
	 *	Select Database
	 *	Change database of current connection
	 *
	 *	@param	string	Database name
	 *	@return	void
	*/
	public function SelectDataBase($database)
	{
		return self::callClient()->SelectDataBase($database);
	}
	/**
	 *	Is Connected
	 *	Check connection status
	 *
	 *	@return	boolean
	*/
	public function IsConnected()
	{
		if(!self::callClient()) return FALSE;
		return self::callClient()->IsConnected();
	}
	/**
	 *	Close Connection
	 *	Close connection driver
	 *
	 *	@return	void
	*/
	public function Close()
	{
		self::callClient()->Close();
		$this->tempDriver = NULL;
	}
	/**
	 *	Set Arguments
	 *	Set arguments for escape strings
	 *	http://php.net/manual/en/function.sprintf.php
	 *
	 *	@param	string	Arguments
	 *	@param	string	[..]
	 *	@return	void
	*/
	public function Arguments()
	{
		$arguments = func_get_args();
		$this->arguments = array_merge($this->arguments, $arguments);
	}
	/**
	 *	Set Parameters
	 *	Set parameters for escape strings
	 *	array: Parameter => Value
	 *
	 *	@param	array	Arguments
	 *	@return	void
	*/
	public function Parameters(array $parameters)
	{
		$this->parameters = array_merge($parameters, $this->parameters);
	}
	/**
	 *	Clear Work Methods
	 *	Clear and retore default methods
	 *
	 *	@param	boolean	Clear current query resource
	 *	@param	boolean	Clear temp driver
	 *	@param	boolean	Reset all methods and fields
	 *	@return	void
	*/
	public function Clear($resource = FALSE, $driver = FALSE, $resetAll = TRUE)
	{
		if($resetAll)
		{
			$this->arguments = array();
			$this->parameters = array();
			$this->forceDataType = array();
			$this->noEscapeFields = array();
			$this->fields = array();
		}
		
		if($resource) $this->queryResource = NULL;
		if($driver) $this->tempDriver = NULL;
	}
	//-----------------------------------------------------------------------------------
	// Query Commands
	//-----------------------------------------------------------------------------------
	/**
	 *	Query: Select Command
	 *	Build a SELECT query string and execute
	 *
	 *	@param	string		Select fields (separated by ',')
	 *	@param	string		Table for SELECT
	 *	@param	string		WHERE command
	 *	@param	string		ORDER BY command
	 *	@param	integer		Select limit
	 *	@return	resource	Query resource
	*/
	public function Select($select, $table, $where = NULL, $order = NULL, $limit = 0)
	{
		$string = self::callClient()->BuildSelect($select, $table, $where, $order, $limit);
		
		return $this->Query($string);
	}
	/**
	 *	Query: Insert Command
	 *	Build a INSERT query string and execute
	 *
	 *	@param	string		Table for INSERT
	 *	@param	array		Fields (Column => Value)
	 *	@return	resource	Query resource
	*/
	public function Insert($table, array $fields)
	{
		$fieldsName = NULL;
		$fieldsValue = NULL;
		
		foreach($fields as $key => $value)
		{
			if(!isset($this->noEscapeFields[$key]) && !$this->noEscapeFields[$key])
				$value = self::callClient()->EscapeString($value);
				
			$fieldsName .= self::callClient()->fieldEncapsulate('name', $key).", ";
			
			if(isset($this->forceDataType[$key]) && $this->forceDataType[$key])
			{
				switch(strtolower($this->forceDataType[$key]))
				{
					case "string" :
						$fieldsValue .= self::callClient()->fieldEncapsulate('value', $value).", ";
					break;
					case "integer" :
						$fieldsValue .= $value.", ";
					break;
					case "float" :
						$fieldsValue .= floatval($value).", ";
					break;
					case "bool" :
						$fieldsValue .= strval($value).", ";
					break;
					case "null" :
						$fieldsValue .= "NULL, ";
					break;
					default :
						$fieldsValue .= $value.", ";
					break;
				}
			}
			else
			{
				if(is_numeric($value) && strcmp(intval($value), $value) === 0)
					$fieldsValue .= $value.", ";
				else
					$fieldsValue .= self::callClient()->fieldEncapsulate('value', $value).",";
			}
		}
		
		$fieldsName = rtrim($fieldsName, ", ");
		$fieldsValue = rtrim($fieldsValue, ", ");
		
		$string = self::callClient()->BuildInsert($table, $fieldsName, $fieldsValue);
		return $this->Query($string);
	}
	/**
	 *	Query: Update Command
	 *	Build a UPDATE query string and execute
	 *
	 *	@param	string		Table for UPDATE
	 *	@param	array		Fields (Column => New Value)
	 *	@param	string		WHERE command
	 *	@return	resource	Query resource
	*/
	public function Update($table, $fields, $where = FALSE)
	{
		$string = NULL;
		
		foreach($fields as $key => $value)
		{
			if(!isset($this->noEscapeFields[$key]) && !$this->noEscapeFields[$key])
				$value = self::callClient()->EscapeString($value);
				
			if(isset($this->forceDataType[$key]) && $this->forceDataType[$key])
			{
				switch(strtolower($this->forceDataType[$key]))
				{
					case "string" :
						$string .= $key." = ".self::callClient()->fieldEncapsulate('value', $value).", ";
					break;
					case "integer" :
						if(strstr($value, "plus:"))
							$string .= $key." = ".$key." + ".str_replace("plus:", NULL, $value).", ";
						elseif(strstr($value, "minus:"))
							$string .= $key." = ".$key." - ".str_replace("minus:", NULL, $value).", ";
						elseif(strstr($value, "times:"))
							$string .= $key." = ".$key." * ".str_replace("times:", NULL, $value).", ";
						elseif(strstr($value, "divide:"))
							$string .= $key." = ".$key." / ".str_replace("divide:", NULL, $value).", ";
						else
							$string .= $key." = ".$value.", ";
					break;
					case "float" :
						$string .= $key." = ".floatval($value).", ";
					break;
					case "bool" :
						$string .= $key." = ".strval($value).", ";
					break;
					case "null" :
						$string .= $key." = NULL, ";
					break;
					default :
						$string .= $key." = ".str_replace("{#KEY}", $key, $value).", ";
					break;
				}
			}
			else
			{
				if(is_numeric($value) && strcmp(intval($value), $value) === 0)
					$string .= $key." = ".$value.", ";
				else
					$string .= $key." = ".self::callClient()->fieldEncapsulate('value', $value).", ";
			}
			
			$key = self::callClient()->fieldEncapsulate('name', $key);
		}
		
		$string = rtrim($string, ", ");
		$string = self::callClient()->BuildUpdate($table, $string, $where, $order, $limit);
		
		return $this->Query($string);
	}
	/**
	 *	Query: Delete Command
	 *	Build a DELETE query string and execute
	 *
	 *	@param	string		Table for DELETE
	 *	@param	string		WHERE command
	 *	@return	resource	Query resource
	*/
	public function Delete($table, $where = NULL)
	{
		return $this->Query(self::callClient()->BuildDelete($table, $where));
	}
	//-----------------------------------------------------------------------------------
	// Query Records
	//-----------------------------------------------------------------------------------
	/**
	 *	Record: Count Rows
	 *	Gets the number of rows in result
	 *
	 *	@param	resource	Query resource
	 *	@return	integer		Number rows
	*/
	public function CountRows($resource = NULL)
	{
		if(!$resource) $resource = $this->queryResource;
		return self::callClient()->num_rows($resource);
	}
	/**
	 *	Record: Fetch Row
	 *	Get row as enumerated array
	 *
	 *	@param	resource	Query resource
	 *	@return	array		Fields
	*/
	public function FetchRow($resource = NULL)
	{
		if(!$resource) $resource = $this->queryResource;
		$fields = self::callClient()->fetch_row($resource);
		
		$this->Clear(TRUE, TRUE);
		$this->fields = (array)$fields;
		return $fields;
	}
	/**
	 *	Record: Fetch Array
	 *	Returns an associative array of the current row in the result
	 *
	 *	@param	resource	Query resource
	 *	@return	array		Fields
	*/
	public function FetchArray($resource = NULL)
	{
		if(!$resource) $resource = $this->queryResource;
		$fields = self::callClient()->fetch_array($resource);
		
		$this->Clear(TRUE, TRUE);
		$this->fields = (array)$fields;
		return $fields;
	}
	/**
	 *	Record: Fetch Object
	 *	Fetch row as object
	 *
	 *	@param	resource	Query resource
	 *	@return	object		Fields
	*/
	public function FetchObject($resource = NULL)
	{
		if(!$resource) $resource = $this->queryResource;
		$fields = self::callClient()->fetch_object($resource);
		
		$this->Clear(TRUE, TRUE);
		$this->fields = (array)$fields;
		return $fields;
	}
	/**
	 *	Record: Free Result
	 *	Free result memory
	 *
	 *	@param	resource	Query resource
	 *	@return	void
	*/
	public function FreeResult($resource = NULL)
	{
		if(!$resource) $resource = $this->queryResource;
		
		self::callClient()->free_result($resource);
		$this->Clear(TRUE, TRUE);
	}
	//-----------------------------------------------------------------------------------
	// Others Query Commands
	//-----------------------------------------------------------------------------------
	/**
	 *	Record: Get Current Id
	 *	Get the current identify from table
	 *
	 *	@param	string	Table name
	 *	@param	string	Id column name
	 *	@return	integer	Current ID
	*/
	public function GetCurrentId($table, $id = NULL)
	{
		$table = $id."[!]".$table;
		return self::callClient()->GetCurrentId($table);
	}
	/**
	 *	Record: Get Lasted Id
	 *	Get the ID generated in the last query
	 *
	 *	@return	integer	ID generated
	*/
	public function GetLastedId()
	{
		return self::callClient()->GetLastedId();
	}
	//-----------------------------------------------------------------------------------
	// Misc Functions
	//-----------------------------------------------------------------------------------
	/**
	 *	Get Field Value
	 *	Return the value from field or all fields values
	 *
	 *	@param	string	Field key
	 *	@return	string/object
	*/
	public function Field($field = -1)
	{
		if($this->queryResource && !$this->fields)
			$this->FetchArray();
		
		if($field != -1)
		{
			if(is_numeric($field)) return $this->fields[$field];
			return (object)$this->fields->{$field};
		}
		
		return (object)$this->fields;
	}
	/**
	 *	Force Data Type
	 *	Set data type to fields
	 *
	 *	@param	string	Field name
	 *	@param	string	Data type (string / integer / float / bool / null / none type)
	 *	@return	void
	*/
	public function ForceDataType($field, $type = NULL)
	{
		if(is_array($field))
			foreach($field as $key => $value)
				$this->forceDataType[$key] = $value;
		else
			$this->forceDataType[$field] = $type;
	}
	/**
	 *	No Escape Fields
	 *	Set the fields whete no will be escaped
	 *
	 *	@param	string	Field name
	 *	@param	string	[...]
	 *	@return	void
	*/
	public function NoEscapeFields()
	{
		return $this->noEscapeFields = array_merge(func_get_args(), $this->noEscapeFields);
	}
	/**
	 *	Escape String
	 *	Escapes special characters in a string for use in an SQL statement
	 *
	 *	@param	string	String that is to be escaped
	 *	@return	string
	*/
	public function EscapeString($string)
	{
		return self::callClient()->EscapeString($string);
	}
	//-----------------------------------------------------------------------------------
	// Class Privated: Build Functions
	//-----------------------------------------------------------------------------------
	/**
	 *	Privated: Compile String
	 *	Load all arguments and parameters to compile string
	 *
	 *	@param	string	String that is to be compiled
	 *	@return	string	String compiled
	*/
	private function loadCompileString($string)
	{
		if(count($this->arguments) > 0)
		{
			$args = array(); $i = 0;
			
			foreach($this->arguments as $value)
			{
				$args[$i] = self::callClient()->EscapeString($value);
				$i++;
			}
			
			$string = vsprintf($string, $args);
			
		}
		if(count($this->parameters) > 0)
		{
			foreach($this->parameters as $key => $value)
			{
				$string = str_replace($key, self::callClient()->EscapeString($value), $string);
			}
		}
		
		return $string;
	}
	//-----------------------------------------------------------------------------------
	// Class Privated: Driver and Instance
	//-----------------------------------------------------------------------------------
	/**
	 *	Private: Call Client
	 *	Return the current driver client class
	 *
	 *	@return	object	Driver Client Class
	*/
	private function callClient()
	{
		return $this->drivers[self::loadDriver()];
	}
	/**
	 *	Private: Get Current Driver
	 *	Return the current driver name
	 *
	 *	@return	object	Driver Client Name
	*/
	private function loadDriver()
	{
		return $this->tempDriver ? $this->tempDriver : $this->localDriver;
	}
	/**
	 *	Private: Instance Class
	 *	Return the library instance class
	 *
	 *	@return	object	Library instance class
	*/
	private function instanceClass()
	{
		if(!self::$instanceClass)
			self::$instanceClass = new DriverInstance();
		
		return self::$instanceClass;
	}
	//-----------------------------------------------------------------------------------
	// Class Privated: Misc Functions
	//-----------------------------------------------------------------------------------
	/**
	 *	Debug SQL
	 *	Save the SQL Debug Log on a file
	 *
	 *	@param	string	SQL Log
	 *	@return	void
	*/
	private function DebugSQL($writeLog)
	{
		if($this->settings[$this->loadDriver()]['debug'])
		{
			if(!file_exists(self::LibGetLogPath($this->settings[$this->loadDriver()]['log_folder']."/", false)))
				mkdir(self::LibGetLogPath($this->settings[$this->loadDriver()]['log_folder']."/", false));

			if($fp = fopen(self::LibGetLogPath($this->settings[$this->loadDriver()]['log_folder']."/".date("d-m-Y")), "a+"))
			{
				$write = "[".date("H:i:s")."] Request: ".CTM_URLEngine::URIString()."\r\n";
				$write .= "[".date("H:i:s")."] ".$writeLog."\r\n";
				$write .= "[".date("H:i:s")."] Server Message: ".self::callClient()->GetErrorMessage()."\r\n";
				$write .= "==========================================================================================\r\n";
				
				fwrite($fp, $write);
				fclose($fp);
			}
		}
	}
	/**
	 *	Error SQL
	 *	Write the SQL Log
	 *
	 *	@param	string	SQL Log
	 *	@return	void
	*/
	private function ErrorSQL($error, $subString = NULL)
	{
		if(!$this->settings[$this->loadDriver()]['hideErrors'])
			return CTM_Error::DriverError($error, $subString);
	}
	//-----------------------------------------------------------------------------------
	// Public: Call Client Functions
	//-----------------------------------------------------------------------------------
	/**
	 *	Get Client Class
	 *	Return the driver client class
	 *
	 *	@param	string	Driver Client
	 *	@return	object	Client Class
	*/
	public function Client($driver = FALSE)
	{
		$driver = strtolower($driver);
		if($driver)
			if(file_exists(self::LibGetRealPath(self::DRIVER_LIB_FOLDER).$driver."Client.lib.php"))
				$this->tempDriver = $driver;
				
		return self::callClient();
	}
	/**
	 *	Magic Method: __call
	 *	Set a driver client and return the library class
	 *
	 *	@return	object	Library Class
	*/
	public function __call($name, $arguments)
	{
		$name = strtolower($name);
		
		if(file_exists(self::LibGetRealPath(self::DRIVER_LIB_FOLDER).$name."Client.lib.php"))
		{
			$this->tempDriver = $name;
			return $this;
		}
	}
}