<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Communication: Sockets
 * Author: $CTM['Erick-Master']
 * Last Update: 17/05/2013 - 15:30h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Communication_Sockets extends CTM_Communication
{
	private $socket			= NULL;
	private $error			= NULL;
	private $msg			= NULL;
	private $useFsockopen	= TRUE;

	/**
	 *	Library Factory
	 *	Set up a library setting
	 *
	 *	@param	array	Library Settings
	 *	@return	void
	*/
	public function LibFactory($settings)
	{
		//self::$settings = $settings;
	}
	/**
	 *	Create Socket
	 *	Create a new socket instance
	 *
	 *	@return	void
	*/
	public function CreateSocket()
	{
		if(function_exists("socket_create"))
			$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		else
			$this->useFsockopen = true;
	}
	/**
	 *	Connect to Server
	 *	Connect socket instance to server
	 *
	 *	@param	string	Host
	 *	@param	integer	Port
	 *	@param	integer	Timeout
	 *	@return	boolean
	*/
	public function ConnectSocket($host, $port, $timeout = 2)
	{
		if($this->useFsockopen == false)
		{
			socket_set_option($this->socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => $timeout, "usec" => 0));
			return socket_connect($this->socket, $host, $port);
		}
		else
		{
			return $this->socket = fsockopen($host, $port, $this->error, $this->msg, $timeout);
		}
	}
	/**
	 *	Write Pack
	 *	Write pack to socket
	 *
	 *	@param	mixed	The buffer to be written
	 *	@param	integer	The optional parameter length
	 *	@return	boolean
	*/
	public function WritePack($buffer, $length = false)
	{
		$length = $length ? $length : strlen($buffer);
		
		if($this->useFsockopen == false)
			return socket_write($this->socket, $buffer, $length);
		else
			return fwrite($this->socket, $buffer, $length);
	}
	/**
	 *	Read Packs
	 *	Reads a maximum of length bytes from a socket
	 *
	 *	@param	integer	Length
	 *	@param	const	Type (default -> PHP_BINARY_READ)
	 *	@return	mixed
	*/
	public function ReadPacks($length, $type = PHP_BINARY_READ)
	{
		if($this->useFsockopen == false)
			return socket_read($this->socket, $length, $type);
		else
			return fread($this->socket, $length);
	}
	/**
	 *	Get Error
	 *	Get last socket error
	 *
	*	@return	string
	*/
	public function GetError()
	{
		if($this->useFsockopen == false)
		{
			$error_number = socket_last_error();
			$error_string = socket_strerror($error_number);
		}
		else
		{
			$error_number = $this->error;
			$error_string = $this->msg;
		}

		return "[".$error_number."] ".$error_string;
	}
	/**
	 *	Close Socket
	 *	Close the socket connection and unset the resource
	 *
	 *	@return	void
	*/
	public function CloseSocket()
	{
		if($this->useFsockopen == false)
			$return = socket_close($this->socket);
		else
			$return = fclose($this->socket);

		$this->socket = NULL;
		$this->error = NULL;
		$this->msg = NULL;
		$this->useFsockopen = FALSE;

		return $return;
	}
}