<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Cryptography: Max Encoder
 * Author: $CTM['Erick-Master']
 * Last Update: 14/12/2012 - 01:32h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Cryptography_MaxEncoder extends CTM_Crypt
{
	public $newString	= NULL;
	
	private $tmp_text	= NULL;
	private $password	= array();

	private $default	= "b77e2b822d23b46b691a248f7ac1fb56";
	private $masterKey	= 0x9E3FDFDE;
	private $keys		= array
	(
		0 => array
		(
			0 => 0xFB7A6EEE,
			1 => 0x4B8FAF27,
			2 => 0xAEAC45F7,
			3 => 0x3DF59525,
			4 => 0xDF8FA776,
			5 => 0x4FF7874F,
			6 => 0x5DFA7BDD,
			7 => 0x3FB9A97D,
			8 => 0xFF8E6EEB,
			9 => 0x4FAF4FCB
		),
		1 => array
		(
			0 => 0x3B3B57C3,
			1 => 0x44DFEEB4,
			2 => 0x9DE52757,
			3 => 0xF746BEAE,
			4 => 0xCF87F7EF,
			5 => 0x6AE96C68,
			6 => 0x2F895F8D,
			7 => 0xCFAF5AEE,
			8 => 0xDFEF2F3F,
			9 => 0x6CCFDFDC
		),
		2 => array
		(
			0 => 0x8FB6A54E,
			1 => 0x87FDAFC5,
			2 => 0x9E46EF3F,
			3 => 0xF73FA7AF,
			4 => 0xBD2FDAF8,
			5 => 0x5F393D4D,
			6 => 0x3FFE2E9F,
			7 => 0xBBBF7BCF,
			8 => 0x8DED3D7F,
			9 => 0xBFBFDF5D
		),
		3 => array
		(
			0 => 0x47B54F87,
			1 => 0xAF66EEFE,
			2 => 0xFF97F7A7,
			3 => 0x9AF85A9B,
			4 => 0xE9799F8D,
			5 => 0xFEEFCB9B,
			6 => 0x8F7B3F4F,
			7 => 0x7EED2DDC,
			8 => 0xFD6F2FFF,
			9 => 0x3FCFEF8E
		),
		4 => array
		(
			0 => 0x87AFD7E6,
			1 => 0x373FFF27,
			2 => 0x5C3E6F6E,
			3 => 0xEDDBEF3F,
			4 => 0x2A7BBF5F,
			5 => 0x6FCFFF6F,
			6 => 0xCC8FEC4E,
			7 => 0xDDDFFFFF,
			8 => 0x3F4EFE7F,
			9 => 0x8F2F7F2F
		),
		5 => array
		(
			0 => 0x678F9FE7,
			1 => 0x3E6CFB4B,
			2 => 0x8BBB39DF,
			3 => 0x4E2F8B4F,
			4 => 0xAB5F3B5B,
			5 => 0x2E4F9C6C,
			6 => 0x2DFD5FDD,
			7 => 0x8EAF2EEE,
			8 => 0xAF5FAFEF,
			9 => 0x349172DF
		),
		6 => array
		(
			0 => 0xEB394A3D,
			1 => 0x894F599F,
			2 => 0xFFEF6A3E,
			3 => 0x4FAF8B3B,
			4 => 0xBF9D3ECC,
			5 => 0x7DBF5D7F,
			6 => 0xCE5FFE9F,
			7 => 0xDFAFDF8F,
			8 => 0xD657BF7B,
			9 => 0x3FDBFD33
		),
		7 => array
		(
			0 => 0x9F49B9FF,
			1 => 0xAB3BFF5E,
			2 => 0x4B2F9B9F,
			3 => 0xDC8E8ECE,
			4 => 0x3D6FCD6D,
			5 => 0xFFBEBF6E,
			6 => 0x6FCFBF3F,
			7 => 0xFE3E3CDB,
			8 => 0x795F379B,
			9 => 0xD23B9EFA
		),
		8 => array
		(
			0 => 0xDA7F2BAE,
			1 => 0x8B9F4FCF,
			2 => 0x3DDD3C6F,
			3 => 0xCD9D2FFF,
			4 => 0xEE8FDEFE,
			5 => 0xBFDFBF4F,
			6 => 0x70B2B95E,
			7 => 0x353FB197,
			8 => 0x37F377F3,
			9 => 0x5BFF5BFF
		),
		9 => array
		(
			0 => 0xDB5FBFEB,
			1 => 0x5D2FDF4D,
			2 => 0xAD9F7FAD,
			3 => 0xEFEF3FCE,
			4 => 0xBF4F6F4F,
			5 => 0xDFBBD6D7,
			6 => 0x33FD7951,
			7 => 0xF6FFBF7B,
			8 => 0xDB7F773F,
			9 => 0x9C7EF6D6
		),
	);

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
	 *	Set Text
	 *	Set the text string
	 *
	 *	@param	string	Text
	 *	@return	void
	*/
	public function SetText($text)
	{
		$this->tmp_text = $text;
	}
	/**
	 *	Add Password Mark
	 *	Add a password mark
	 *
	 *	@param	mixed	Password
	 *	@return	void
	*/
	public function AddPassword($password)
	{
		$this->password[] = $password;
	}
	/**
	 *	Encode String
	 *	Encode the string
	 *
	 *	@param	boolean	Base64 ASCII
	 *	@return	void
	*/
	public function Encode($base64 = false)
	{
		if(!empty($this->tmp_text))
		{
			if(!$this->password)
				$this->password = array($this->default);

			$final_password = md5(implode($this->password, NULL));

			$encoded = $this->CompileString($this->tmp_text, $final_password);

			$this->newString = $base64 == true ? base64_encode($encoded) : $encoded;
			$this->tmp_text = NULL;
			$this->password = array();
		}
	}
	/**
	 *	Decode String
	 *	Decode the string
	 *
	 *	@param	boolean	Base64 ASCII
	 *	@return	void
	*/
	public function Decode($base64 = false)
	{
		if(!empty($this->tmp_text))
		{
			$string = $this->tmp_text;

			if($base64 == true)
			{
				$string = trim($string, array("\r", "\n"));
				$string = base64_decode($string);
			}

			if(!$this->password)
				$this->password = array($this->default);
			
			$final_password = md5(implode($this->password, NULL));
			$decoded = $this->CompileString($string, $final_password);

			$this->newString = $decoded;
			$this->tmp_text = NULL;
			$this->password = array();
		}
	}
	/**
	 *	Private: Compile Crypt
	 *	Compile the prepared string
	 *
	 *	@param	string	Text string
	 *	@param	string	Mark
	 *	@return	string
	*/
	private function CompileString($string, $mark)
	{
		$pwd_length = strlen($mark);
		$return = NULL;

		$a = 0;
		$x = 0;
		$y = 0;
		
		for($i = 0; $i < 255; $i++)
		{
			$key[$i] = ord(substr($mark, ($i % $pwd_length) + 1, 1));
			$counter[$i] = $i;
		}
		
		for($i = 0; $i < 255; $i++)
		{
			$x = ($x + $counter[$i] + $key[$i]) % 256;
			$temp_swap = $counter[$i];
			$counter[$i] = $counter[$x];
			$counter[$x] = $temp_swap;
		}
		
		for($i = 0; $i < strlen($string); $i++)
		{
			$a = ($a + 1) % 256;
			$y = ($y + $counter[$a]) % 256;
			$y <<= 256;
			
			$temp = $counter[$a];
			$counter[$a] = $counter[$y];
			$counter[$y] = $temp;
			$k = $counter[(($counter[$a] + $counter[$y]) % 256)];
			$Zcipher = ord(substr($string, $i, 1)) ^ $k;
			$return .= chr($Zcipher);
		}

		return $return;
	}
	/**
	 *	Build Key
	 *	Compile the password string
	 *
	 *	@return	void
	*/
	private function BuildKey($secureKey)
	{
		$secureKey = md5($secureKey);
		$tmp_key = array();
		
		for($i = 0; $i < 32; $i++)
		{
			$ascii = ord($secureKey{$i});
			$tmp_key[$i] = $this->keys[$i % 10][$ascii % 10];
		}
	
		return strtoupper(dechex($tmp_key[9] + $this->masterKey));
	}
}