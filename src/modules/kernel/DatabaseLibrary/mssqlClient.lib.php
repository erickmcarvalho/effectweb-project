<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Database Layer - Microsoft SQL Server Client
 * Author: $CTM['Erick-Master']
 * Last Update: 26/04/2012 - 20:11h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class MSSQL_DriverClient
{
	public $Name			= "mssql";
	public $settings		= array();
	
	private $useSqlsrv		= FALSE;
	private $connections	= array();
	private $databases		= array();
	private $results		= array();
	private $currentLink	= 0;
	private $id				= 0;
	
	/**
	 *	Start Connection Server
	 *	Connect to Microsoft SQL Server
	 *
	 *	@return	void
	*/
	public function StartConnection()
	{
		if(!extension_loaded("mssql"))
		{
			if(!extension_loaded("sqlsrv"))
				return $this->results['Connect'] = "NO_PHP_EXTENSION";
			else
				$this->useSqlsrv = TRUE;
		}
		
		if(!$this->settings['hostport'])
			$this->settings['hostport'] = 1433;
		
		$new_link = count($this->connections) > 0;
		$port = (strtoupper(substr(PHP_OS, 0, 3)) === "WIN" ? "," : ":").$this->settings['hostport'];
		
		if(!$this->useSqlsrv)
		{
			if($this->settings['persistent'])
				$this->connections[$this->id] = mssql_pconnect($this->settings['hostname'].$port, $this->settings['username'], $this->settings['password'], $new_link);
			else
				$this->connections[$this->id] = mssql_connect($this->settings['hostname'].$port, $this->settings['username'], $this->settings['password'], $new_link);
		}
		
		if(!$this->connections[$this->id])
			return $this->results['Connect'] = "CONNECTION_FAILED";
				
		if(!$this->SelectDataBase($this->settings['database'], $this->id))
			return $this->results['Connect'] = "DATABASE_FAILED";
		
		$this->id++;
		$this->connected = TRUE;
		$this->currentLink = $this->id - 1;
		return $this->results['Connect'] = "CONNECTED";
	}
	/**
	 *	Select Database
	 *	Select the Database SQL Connection
	 *
	 *	@param	string	Database name
	 *	@param	integer	Connection number
	 *	@return	boolean
	*/
	public function SelectDataBase($database, $link = -1)
	{
		$link = $link == -1 ? $this->currentLink : $link;
		
		if(!$this->useSqlsrv)
		{
			if(!mssql_select_db($database, $this->GetConnection($link, FALSE)))
				return FALSE;
		}
		
		$this->databases[$link] = $database;
		return TRUE;
	}
	/**
	 *	Is Connected
	 *	Checks if there are active connections
	 *
	 *	@param	integer	Connection number
	 *	@param	boolean	Checks for an active connection
	 *	@return	boolean
	*/
	public function IsConnected($link = -1, $all = TRUE)
	{
		$link = $link == -1 ? $this->currentLink : $link;
		
		if($all)
			if(!$this->connected) return FALSE;
		
		if(!is_resource($this->connections[$link])) return FALSE;
		
		return TRUE;
	}
	/**
	 *	Change Connection
	 *	Change the current connection link
	 *
	 *	@param	integer	Link number
	 *	@return	void
	*/
	public function ChangeConnection($link)
	{
		if(isset($this->connections[$link]) && $this->IsConnected($link))
			$this->currentLink = $link;
	}
	/**
	 *	Close Connection
	 *	Close a connection
	 *
	 *	@param	integer	Link number
	 *	@return	void
	*/
	public function Close($link = -1)
	{
		if(!$this->useSqlsrv)
			mssql_close($this->GetConnection($link));
			
		if($link == -1)
		{
			unset($this->connections[$this->currentLink]);
			unset($this->databases[$this->currentLink]);
		}
		else
		{
			unset($this->connections[$link]);
			unset($this->databases[$link]);
		}
	}
	/**
	 *	Execute Query
	 *	Send MS SQL query
	 *
	 *	@param	string	Query String
	 *	@return	resource
	*/
	public function ExecuteQuery($string)
	{
		if(!$this->useSqlsrv)
		{
			return mssql_query($string, $this->GetConnection());
		}
	}
	/**
	 *	Get Connection
	 *	Get the connection resource
	 *
	 *	@param	integer	Link number
	 *	@param	boolean	Checks for an active connection
	 *	@return	resource
	*/
	private function GetConnection($link = -1, $checkAll = TRUE)
	{
		$link = $link == -1 ? $this->currentLink : $link;
		
		if($this->IsConnected($link, $checkAll))
			return $this->connections[$link];
	}
	/**
	 *	Get Database
	 *	Get the database name
	 *
	 *	@param	integer	Link number
	 *	@return	string
	*/
	private function GetDataBase($link = -1)
	{
		$link = $link == -1 ? $this->currentLink : $link;
		
		if($this->IsConnected($link))
			return $this->databases[$link];
	}
	/**
	 *	Build Query String: SELECT
	 *	Build the SELECT query string
	 *
	 *	@param	string	Select fields
	 *	@param	string	Select table
	 *	@param	string	WHERE command
	 *	@param	string	ORDER BY command
	 *	@param	integer	Select limit
	 *	@return	strung	Query string
	*/
	public function BuildSelect($select, $table, $where = NULL, $order = NULL, $limit = 0)
	{	
		$string = "SELECT ".($limit > 0 ? "TOP ".$limit." " : NULL).$select;
		$string .= " FROM ".$this->TableString($table).($where ? " WHERE ".$where : NULL);
		$string .= $order ? " ORDER BY ".$order : NULL;
		
		return $string;
	}
	/**
	 *	Build Query String: INSERT
	 *	Build the INSERT query string
	 *
	 *	@param	string	Insert table
	 *	@param	array	Fields name
	 *	@param	array	Fields value
	 *	@return	string	Query string
	*/
	public function BuildInsert($table, $names, $values)
	{
		return "INSERT INTO ".$this->TableString($table)." (".$names.") VALUES (".$values.")";
	}
	/**
	 *	Build Query String: UPDATE
	 *	Build the UPDATE query string
	 *
	 *	@param	string	Update table
	 *	@param	string	Fields data
	 *	@param	string	WHERE command
	 *	@return	string	Query string
	*/
	public function BuildUpdate($table, $data, $where = NULL)
	{
		$string = "UPDATE ".$this->TableString($table)." SET ".$data;
		$string .= $where ? " WHERE ".$where : NULL;
		
		return $string;
	}
	/**
	 *	Build Query String: DELETE
	 *	Build the DELETE query string
	 *
	 *	@param	string	Delete table
	 *	@param	string	WHERE command
	 *	@return	string	Query string
	*/
	public function BuildDelete($table, $where = NULL)
	{
		$string = "DELETE FROM ".$this->TableString($table);
		$string .= $where ? " WHERE ".$where : NULL;
		
		return $string;
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
		return str_replace("'", "''", $string);
	}
	/**
	 *	Field Encapsulate
	 *	Return the SQL Field Encapsulate
	 *
	 *	@param	string	Encapsulate Typé (name = Column / value = Value)
	 *	@param	string	Column/Value to compile
	 *	@return	string
	*/
	public function fieldEncapsulate($type, $string = NULL)
	{
		if(strtolower($type) == "name")
		{
			if($string)
				return "[".$string."]";
			else
				return "[";
		}
		if(strtolower($type) == "name2")
			return "]";
		if(strtolower($type) == "value")
		{
			if($string)
				return "'".$string."'";
			else
				return "'";
		}
	}
	/**
	 *	Table String
	 *	Return the table string compiled
	 *
	 *	Starting with '#' = Replace '#' to table prefix
	 *	Starting with '!' = Only return the string
	 *	Containing '@' = Set database and table [DBName@TableName]
	 *	In any case = Return [Current Database].[dbo].[Table name]
	 *
	 *	@param	string	Table name
	 *	@return	string
	*/
	public function TableString($table)
	{
		if(strstr($table, "#")) 
			$table = $this->settings['table_prefix'].str_replace("#", NULL, $table);
		
		if(strstr($table, "!"))
			return str_replace("!", NULL, $table);
		elseif(strstr($table, "@"))
		{
			$explode = explode("@", $table);
			return "[".$explode[0]."].[dbo].[".$explode[1]."]";
		}
		else
			return "[".$this->GetDataBase()."].[dbo].[".$table."]";
	}
	/**
	 *	Get Command Result
	 *	Get the result from last command
	 *
	 *	@return	string
	*/
	public function Result()
	{
		return (object)$this->results;
	}
	/**
	 *	Get Current Id
	 *	Run 'IDENT_CURRENT' for get the current identify from table
	 *
	 *	@param	string	Table name
	 *	@return	integer	Current table identify
	*/
	public function GetCurrentId($table)
	{
		list($trash, $_table) = explode("[!]", $table);
		$_table = $this->TableString("!".$_table);
		
		$build = self::ExecuteQuery("SELECT IDENT_CURRENT('{$_table}') AS 'ReturnCurrentId'");
		$fetch = self::fetch_object($build);
		
		return $fetch->ReturnCurrentId;
	}
	/**
	 *	Get Lasted Id
	 *	Run '@@IDENTIFY' for get ID generated in last query
	 *
	 *	@return	integer	ID generated
	*/
	public function GetLastedId()
	{
		$build = self::ExecuteQuery("SELECT @@IDENTITY AS 'ReturnLastedId'");
		$fetch = self::fetch_row($build);
		
		return intval($fetch[0]);
	}
	/**
	 *	Get Last Message
	 *	http://www.php.net/manual/en/function.mssql-get-last-message.php
	 *
	 *	@return	string
	*/
	public function GetLastMessage()
	{
		if(!$this->useSqlsrv)
			return mssql_get_last_message();
	}
	/**
	 *	Get Error Message
	 *	http://www.php.net/manual/en/function.mssql-get-last-message.php
	 *
	 *	@return	string
	*/
	public function GetErrorMessage()
	{
		return $this->GetLastMessage();
	}
	/**
	 *	Count Rows
	 *	http://www.php.net/manual/en/function.mssql-num-rows.php
	 *
	 *	@param	resource	Query Result
	 *	@return	integer
	*/
	public function num_rows($resource)
	{
		if(!$this->useSqlsrv)
			return mssql_num_rows($resource);
	}
	/**
	 *	Fetch Row
	 *	http://www.php.net/manual/en/function.mssql-fetch-row.php
	 *
	 *	@param	resource	Query Result
	 *	@return	array
	*/
	public function fetch_row($resource)
	{
		if(!$this->useSqlsrv)
			return mssql_fetch_row($resource);
	}
	/**
	 *	Fetch Array
	 *	http://www.php.net/manual/en/function.mssql-fetch-assoc.php
	 *
	 *	@param	resource	Query Result
	 *	@return	array
	*/
	public function fetch_array($resource, $result_type = MSSQL_ASSOC)
	{
		if(!$this->useSqlsrv)
			return mssql_fetch_array($resource, $result_type);
	}
	/**
	 *	Fetch Object
	 *	http://www.php.net/manual/en/function.mssql-fetch-object.php
	 *
	 *	@param	resource	Query Result
	 *	@return	object
	*/
	public function fetch_object($resource)
	{
		if(!$this->useSqlsrv)
			return mssql_fetch_object($resource);
	}
	/**
	 *	Free Result
	 *	http://www.php.net/manual/en/function.mssql-free-result.php
	 *
	 *	@param	resource	Query Result
	 *	@return	void
	*/
	public function free_result($resource)
	{
		if(!$this->useSqlsrv)
			return mssql_free_result($resource);
	}
}

$callClient = new MSSQL_DriverClient();