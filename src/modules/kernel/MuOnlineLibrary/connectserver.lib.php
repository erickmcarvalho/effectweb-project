<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * MuOnline Library: ConnectServer
 * Author: $CTM['Erick-Master']
 * Last Update: 06/06/2012 - 17:23h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class MuOnline_ConnectServer extends CTM_MuOnline
{
	public $CSHost		= "127.0.0.1";
	public $CSPort		= 44405;
	public $CSVersion	= 2;
	public $Timeout		= 10;
	
	public $romsCount	= 0;
	public $CSRoms		= array();
	
	private $socket		= NULL;
	private $started	= FALSE;
	
	/**
	 *	Library Factory
	 *
	 *	@return	void
	*/
	public function LibFactory()
	{
		
	}
	/**
	 *	Init Connection
	 *	Connect to ConnectServer and start Socket
	 *
	 *	@return	boolean
	*/
	public function init()
	{
		$this->socket = CTM_Communication::Lib('Sockets');
		$this->socket->CreateSocket();
		
		return $this->started = (boolean)$this->socket->ConnectSocket($this->CSHost, $this->CSPort, $this->Timeout);
	}
	/**
	 *	Load ConnectServer Roms
	 *	Load the roms from ConnectServer
	 *
	 *	@return	boolean
	*/
	public function LoadConnectServerRoms()
	{
		if($this->started == true)
		{
			$break = FALSE;
			$timeStart = time();
			$time = 0;
			
			while($CS_Pack = $this->socket->ReadPacks(4096))
			{
				if(time() - $timeStart != $time)
				{
					if($this->Timeout <= time() - $timeStart)
					{
						$break = TRUE;
						break;
					}
				}
				
				$CS_Pack = strtoupper(bin2hex($CS_Pack));
				
				if($CS_Pack == "C1040001")
				{
					$packet = $this->loadConvertHexaToASCII("C104F40".($this->CSVersion == 1 ? 2 : 6));
					$this->socket->WritePack($packet);
				}
				elseif(substr($CS_Pack, 0, 2) == "C2")
				{
					$this->romsCount = hexdec(substr($CS_Pack, 10, $this->CSVersion == 1 ? 2 : 4));
					for($i = 0; $i < $this->romsCount; $i++)
					{
						$GameServer = substr($CS_Pack, $i * 8 + ($this->CSVersion == 1 ? 12 : 14), 8);
						$idLow = substr($GameServer, 0, 2);
						$idHigh = substr($GameServer, 2, 2);
						
						$this->CSRoms[$i]['GS_ID'] = hexdec($idHigh.$idLow);
						$this->CSRoms[$i]['USER_COUNT'] =  hexdec(substr($GameServer, 4, 2));
					}
					break;
				}
			}
			
			$this->socket->CloseSocket();
			$this->started = false;
			
			if($break == true)
				return false;
			else
				return true;
		}
		return false;
	}
	/**
	 *	Convert Hexa to ASCII
	 *
	 *	@param	string	Input
	 *	@return	string
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