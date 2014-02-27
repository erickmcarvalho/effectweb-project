<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Database Layer - MySQL Server Client
 * Author: $CTM['Erick-Master']
 * Last Update: 26/04/2012 - 20:11h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class MySQL_DriverClient
{
	public $Name			= "mysql";
	public $settings		= array();
	
	private $useMySQLOld	= FALSE;
	private $connections	= array();
	private $databases		= array();
	private $results		= array();
	private $mysettings		= array();
	private $currentLink	= 0;
	private $id				= 0;
	
	/**
	 *	Start Connection Server
	 *	Connect to MySQL Server
	 *
	 *	@return	void
	*/
	public function StartConnection()
	{
		if(!extension_loaded("mysqli"))
		{
			if(!extension_loaded("mysql"))
				return $this->results['Connect'] = "NO_PHP_EXTENSION";
			else
				$this->useMySQLOld = TRUE;
		}
		
		if(!$this->settings['hostport'] || $this->settings['hostport'] == "*")
		{
			if(!$this->useMySQLOld)
				$this->settings['hostport'] = ini_get("mysqli.default_port");
			else
				$this->settings['hostport'] = ini_get("mysql.default_port");
		}
		
		if(!$this->settings['hostport'])
			$this->settings['hostport'] = 3306;
		
		if(!$this->useMySQLOld)
		{
			$hostname = ($this->settings['persistent'] ? "p:" : NULL).$this->settings['hostname'];
			$this->connections[$this->id] = new MySQLi($hostname, $this->settings['username'], $this->settings['password'], NULL, $this->settings['hostport']);
		}
		else
		{
			$new_link = count($this->connections) > 0;
			$port = ":".$this->settings['hostport'];
			
			if($this->settings['persistent'])
				$this->connections[$this->id] = mysql_pconnect($this->settings['hostname'].$port, $this->settings['username'], $this->settings['password'], $new_link);
			else
				$this->connections[$this->id] = mysql_connect($this->settings['hostname'].$port, $this->settings['username'], $this->settings['password'], $new_link);
		}
		
		if(!$this->connections[$this->id])
			return $this->results['Connect'] = "CONNECTION_FAILED";
				
		if(!$this->SelectDataBase($this->settings['database'], $this->id))
			return $this->results['Connect'] = "DATABASE_FAILED";
		
		$this->id++;
		$this->connected = TRUE;
		$this->currentLink = $this->id - 1;
		
		$this->mysettings[$this->currentLink] = $this->settings;
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
		
		if(!$this->useMySQLOld)
		{
			if(!$this->MySQLi($link)->select_db($database))
				return FALSE;
		}
		else
		{
			if(!mysql_select_db($database, $this->GetConnection($link, FALSE)))
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
		
		if($all && !$this->connected)
			return FALSE;
		
		if(!$this->useMySQLOld && !$this->connections[$link])
			return FALSE;
		
		if($this->useMySQLOld && is_resource($this->connections[$link]))	
			return FALSE;
		
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
		$link = $link == -1 ? $this->currentLink : $link;
		
		if($this->IsConnected($link))
		{
			if(!$this->useMySQLOld)
				$this->MySQLi($link)->close();
			else
				mysql_close($this->GetConnection());
					
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
	}
	/**
	 *	Execute Query
	 *	Send MySQL query
	 *
	 *	@param	string	Query String
	 *	@return	resource
	*/
	public function ExecuteQuery($string)
	{
		if(!$this->useMySQLOld)
			return $this->MySQLi()->query($string);
		else
			return mysql_query($string, $this->GetConnection());
	}
	/**
	 *	Get Connection
	 *	Get the connection resource
	 *
	 *	@param	integer	Link number
	 *	@param	boolean	Checks for an active connection
	 *	@return	resource
	*/
	private function GetConnection($link = -1, $all = TRUE)
	{
		$link = $link == -1 ? $this->currentLink : $link;
		
		if($this->IsConnected($link, $all))
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
	 *	Get MySQLi Class
	 *	Get the MySQLi class instance
	 *
	 *	@param	integer	Link number
	 *	@return	class	MySQLi
	*/
	private function MySQLi($link = -1)
	{
		if(!$this->useMySQLOld)
		{
			$link = $link == -1 ? $this->currentLink : $link;
			return $this->GetConnection($link, FALSE);
		}
	}
	/**
	 *	Get Class Settings
	 *	Get the class settings
	 *
	 *	@return	object
	*/
	private function settings()
	{
		return (object)$this->mysettings[$this->currentLink];
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
		if(!$this->useMySQLOld)
			return $this->MySQLi()->real_escape_string($string);
		else
			return mysql_real_escape_string($string, $this->GetConnection());
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
				return "`".$string."`";
			else
				return "`";
		}
		if(strtolower($type) == "name2")
			return "`";
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
			$table = $this->settings()->table_prefix.str_replace("#", NULL, $table);
		
		if(strstr($table, "!"))
			return str_replace("!", NULL, $table);
		elseif(strstr($table, "@"))
		{
			$explode = explode("@", $table);
			return "`".$explode[0]."`.`".$explode[1]."`";
		}
		else
			return "`".$this->GetDataBase()."`.`".$table."`";
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
	 *	Get Lasted Id
	 *	Run 'IDENT_CURRENT' for get the current identify from table
	 *
	 *	@param	string	Table name
	 *	@return	integer	Current table identify
	*/
	public function GetLastedId($table, $database = NULL)
	{
		$table = explode("#", $table);
		
		$build = self::ExecuteQuery("SELECT `".$table[0]."` FROM ".($database ? "`".$database."`." : NULL)."`".$table[1]."` AS 'ReturnLastedId'");
		$fetch = self::fetch_object($build);
		
		return intval($fetch->ReturnLastedId) + 1;
	}
	/**
	 *	Get Lasted Id
	 *	Run '@@IDENTIFY' for get ID generated in last query
	 *
	 *	@return	integer	ID generated
	*/
	public function GetInsertedId()
	{
		$build = self::GetConnection()->insert_id();
		
		return intval($build);
	}
	/**
	 *	Get Error Message
	 *	http://www.php.net/manual/en/function.mysql-error.php
	 *
	 *	@return	string
	*/
	public function GetErrorMessage()
	{
		if(!$this->IsConnected())
			return "Server not connected";
		else
			return !$this->useMySQLOld ? $this->MySQLi()->error : mysql_error($this->GetConnection());
	}
	/**
	 *	Count Rows
	 *	http://www.php.net/manual/en/function.mysql-num-rows.php
	 *
	 *	@param	resource	Query Result
	 *	@return	integer
	*/
	public function num_rows($resource)
	{
		if(!$this->useMySQLOld)
			return $resource->num_rows;
		else
			return mysql_num_rows($resource);
	}
	/**
	 *	Fetch Row
	 *	http://www.php.net/manual/en/function.mysql-fetch-row.php
	 *
	 *	@param	resource	Query Result
	 *	@return	array
	*/
	public function fetch_row($resource)
	{
		if(!$this->useMySQLOld)
			return $resource->fetch_row();
		else
			return mysql_fetch_row($resource);
	}
	/**
	 *	Fetch Array
	 *	http://www.php.net/manual/en/function.mysql-fetch-assoc.php
	 *
	 *	@param	resource	Query Result
	 *	@return	array
	*/
	public function fetch_array($resource)
	{
		if(!$this->useMySQLOld)
			return $resource->fetch_array(MYSQLI_BOTH);
		else
			return mysql_fetch_array($resource, MYSQL_BOTH);
	}
	/**
	 *	Fetch Object
	 *	http://www.php.net/manual/en/function.mysql-fetch-object.php
	 *
	 *	@param	resource	Query Result
	 *	@return	object
	*/
	public function fetch_object($resource)
	{
		if(!$this->useMySQLOld)
			return $resource->fetch_object();
		else
			return mysql_fetch_object($resource);
	}
	/**
	 *	Free Result
	 *	http://www.php.net/manual/en/function.mysql-free-result.php
	 *
	 *	@param	resource	Query Result
	 *	@return	void
	*/
	public function free_result($resource)
	{
		if(!$this->useMySQLOld)
			return $resource->FreeResult();
		else
			return mysql_free_result($resource);
	}
}

$callClient = new MySQL_DriverClient();