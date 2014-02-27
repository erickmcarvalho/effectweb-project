<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Database Layer - Instance Class
 * Author: $CTM['Erick-Master']
 * Last Update: 26/04/2012 - 20:11h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class DriverInstance
{
	private $messages	= array
	(
		"mssql" => array
		(
			"extensionNotLoaded" => "[#0] The MSSQL extension is not loaded.",
			"connectionFailed" => "[#1] Could not connect to MSSQL server.",
			"databaseFailed" => "[#2] Unable to select the MSSQL DataBase.",
			"queryFailed" => "[#3] Could not execute Query.",
			"logExtensionNotLoaded" => "Connection to MSSQL Server Failed: No Extension",
			"logConnectionFailed" => "Connection to MSSQL Server Failed: Connection",
			"logDatabaseFailed" => "Connection to MSSQL Server Failed: Select DB",
			"logQueryFailed" => "Query Failed:",
		),
		"mysql" => array
		(
			"extensionNotLoaded" => "[#0] The MySQL extension is not loaded.",
			"connectionFailed" => "[#1] Could not connect to MySQL server.",
			"databaseFailed" => "[#2] Unable to select the MySQL DataBase.",
			"queryFailed" => "[#3] Could not execute Query.",
			"logExtensionNotLoaded" => "Connection to MySQL Server Failed: No Extension",
			"logConnectionFailed" => "Connection to MySQL Server Failed: Connection",
			"logDatabaseFailed" => "Connection to MySQL Server Failed: Select DB",
			"logQueryFailed" => "Query Failed:",
		)
								
	);
								
	public function LoadMessages($client, $message)
	{
		return $this->messages[$client][$message];
	}
}