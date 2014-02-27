<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * MuOnline Library: JoinServer
 * Author: $CTM['Erick-Master']
 * Last Update: 06/06/2012 - 14:20h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class MuOnline_JoinServer extends CTM_MuOnline
{
	private $settings	= array();
	private $socket		= array();
	private $started	= FALSE;
	
	private $packetsLogout	= array
	(
		"WZ" => "C11AA00000000000{ACCOUNT(20)}0000000000000000",
		"XT" => "C10E30{ACCOUNT(10)}00",
	);
	private $packetsGlobMsg	= array("WZ" => "C144A1");
	
	/**
	 *	Library Factory
	 *	Set up a library setting
	 *
	 *	@param	array	Library Settings
	 *	@return	void
	*/
	public function LibFactory($settings)
	{
		if(!$settings['JoinServer'])
			$settings['JoinServer'] = "WZ";
		elseif($settings['JoinServer'] != "WZ" && $settings['JoinServer'] != "XT")
			$settings['JoinServer'] = "WZ";
		
		$this->settings = $settings;
	}
	/**
	 *	Init Connection
	 *	Connect to JoinServer and start Socket
	 *
	 *	@return	boolean
	*/
	public function init()
	{
		$this->socket = CTM_Communication::Lib('Sockets');
		$this->socket->CreateSocket();
		
		return $this->started = (bool)$this->socket->ConnectSocket($this->settings['JSHost'], $this->settings['JSPort'], $this->settings['Timeout']);
	}
	/**
	 *	Force Logout
	 *	Force logout by the JoinServer
	 *
	 *	@param	string	Username
	 *	@return	boolean
	*/
	public function ForceLogout($account)
	{
		if($this->settings['JoinServer'] != "WZ" && $this->settings['JoinServer'] != "XT")
			return false;
			
		if(!$this->started)
			if(!$this->init())
				return false;
		
		$packet = $this->packetsLogout[$this->settings['JoinServer']];
		preg_match("/\{ACCOUNT\((.*?)\)\}/i", $packet, $account_size);
		
		$account_packet = str_pad($this->loadConvertASCIIToHexa($account), $account_size[1] * 2, 0, STR_PAD_RIGHT);
		$packet_final = $this->loadConvertHexaToASCII(preg_replace("/\{ACCOUNT\((.*?)\)\}/i", $account_packet, $packet));
		
		$this->socket->WritePack($packet_final);
		$this->socket->CloseSocket();

		$this->started = false;
		return true;
	}
	/**
	 *	Send Global Message
	 *	Send a global message by the JoinServer
	 *
	 *	@param	string	Message
	 *	@return	void
	*/
	public function SendGlobalMessage($message)
	{
		if($this->settings['JoinServer'] != "WZ")
			return false;
			
		if(!$this->started)
			if(!$this->init())
				return false;

		if(strlen($message) > 34)
			$message = substr($message, 0, 34);
		
		$packet = $this->packetsGlobMsg['WZ']."0024000000";
		$packet .= str_pad($this->loadConvertASCIIToHexa(CTM_Text::UTF8Text($message)), 68, 0, STR_PAD_RIGHT);
		
		$packet = $this->loadConvertHexaToASCII($packet.str_repeat("00", 26));
		
		$this->socket->WritePack($packet);
		$this->socket->CloseSocket();
		
		$this->started = false;
		return true;
	}
	/**
	 *	Private: Convert ASCII to Hexa
	 *
	 *	@param	string	String ASCII
	 *	@return	string	String hexa
	*/
	private function loadConvertASCIIToHexa($string)
	{
		$hexa = NULL;
		
		for($i = 0; $i < strlen($string); $i++)
		{
			$byte = strtoupper(dechex(ord($string{$i})));
			$hexa .= str_pad($byte, 2, 0, STR_PAD_LEFT);
		}
		
		return $hexa;
	}
	/**
	 *	Private: Convert Hexa to ASCII
	 *
	 *	@param	string	String Hexa
	 *	@return	string	String ASCII
	*/
	private function loadConvertHexaToASCII($string)
	{
		$ascii = NULL;
		$string = str_replace(" ", NULL, $string);
		
		for($i = 0; $i < strlen($string); $i += 2)
		{
			$ascii .= chr(hexdec(substr($string, $i, 2)));
		}
		
		return $ascii;
	}
}