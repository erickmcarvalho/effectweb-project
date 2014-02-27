<?php
/**
 * Cetemaster Services
 * Cetemaster Framework v1.0
 *
 * Communication: HTTP Request
 * Author: $CTM['Erick-Master']
 * Last Update: 21/08/2013 - 15:20h
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Communication_HTTPRequest extends CTM_Communication
{
	public $responseCode	= 0;
	
	private $address		= NULL;
	private $port			= 80;
	private $timeout		= 2;
	private $sslVersion		= 0;
	private $encoding		= NULL;	
	private $follow			= FALSE;
	private $sslVerifyPeer	= FALSE;
	private $post			= array();
	private $fields			= array();
	private $authorization	= array();
	private $headers		= array();

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
	 *	Create Instance
	 *	Create the instance for request
	 *
	 *	@param	string	Address
	 *	@param	integer	Timeout
	 *	@return	void
	*/
	public function CreateInstance($address, $port = 80, $timeout = 2)
	{
		$this->address = $address;
		$this->port = $port;
		$this->timeout = $timeout;
	}
	/**
	 *	Set POST Request
	 *	Set the method request to POST
	 *
	 *	@param	boolean	Set POST
	 *	@param	string	Type (form or json)
	 *	@return	void
	*/
	public function SetPost($set, $type = "form")
	{
		$this->post['enable'] = $set;
		$this->post['type'] = $type;
	}
	/**
	 *	Add POST Fields
	 *	Add a new POST fields
	 *
	 *	@param	array	Fields
	 *	@return	void
	*/
	public function AddPostFields($fields)
	{
		if($this->post['enable'] == true)
		{
			$this->fields = array_merge($this->fields, $fields);
		}
	}
	/**
	 *	Add Header
	 *	Add a new header to request
	 *
	 *	@param	string	Header
	 *	@return	void
	*/
	public function AddHeader($header)
	{
		$this->headers[] = $header;
	}
	/**
	 *	Follow Location
	 *	Set to follow location (Location:) in request
	 *
	 *	@param	boolean	Follow location
	 *	@return	void
	*/
	public function FollowLocation($follow)
	{
		$this->follow = $follow;
	}
	/**
	 *	SSL Verify
	 *	Set if the request verify the peer
	 *
	 *	@param	boolean	Verify peer
	 *	@return	void
	*/
	public function SSLVerify($set)
	{
		$this->sslVerifyPeer = $set;
	}
	/**
	 *	SSL Version
	 *	Set the SSL version
	 *
	 *	@param	integer	SSL Version (0 -> none, 2 -> SSL 2, 3 -> SSL 3)
	 *	@return	void
	*/
	public function SSLVersion($ssl)
	{
		$this->sslVersion = $ssl;
	}
	/**
	 *	Set Encoding
	 *	Set the request encoding
	 *
	 *	@param	string	Encoding
	 *	@return	void
	*/
	public function SetEncoding($encoding)
	{
		$this->encoding = $encoding;
	}
	/**
	 *	Set Authorization
	 *	Set the authorization in request
	 *
	 *	@param	string	User
	 *	@param	string	Password
	 *	@return	void
	*/
	public function SetAuthorization($user, $password)
	{
		$this->authorization['user'] = $user;
		$this->authorization['password'] = $password;
	}
	/**
	 *	Execute Request
	 *	Execute the request
	 *
	 *	@param	&mixed	Return variable
	 *	@return	mixed
	*/
	public function Execute(&$_return = NULL)
	{
		if($this->address && $this->port)
		{
			if(function_exists("curl_init") && function_exists("curl_exec"))
			{
				if(($cURL = curl_init()))
				{
					if(!strstr($this->address, "http://") && !strstr($this->address, "https://"))
					{
						$type = ($this->sslVersion > 0 ? "https" : "http")."://";
						$address = $type.$this->address;
					}
					else
					{
						$address = $this->address;
					}

					curl_setopt($cURL, CURLOPT_URL, $this->address);
					curl_setopt($cURL, CURLOPT_TIMEOUT, $this->timeout);
					curl_setopt($cURL, CURLOPT_RETURNTRANSFER, TRUE);
					curl_setopt($cURL, CURLOPT_USERAGENT, "Cetemaster PHP Communication 1.0 / HTTP/1.1");
					curl_setopt($cURL, CURLOPT_SSL_VERIFYPEER, $this->sslVerifyPeer);
					curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, $this->follow);
					curl_setopt($cURL, CURLOPT_ENCODING, $this->encoding);

					if($this->post['enable'] == true)
					{
						if($this->post['type'] == "json")
						{
							$post_back = json_encode($this->fields);
						}
						else
						{
							$post_back = $this->fields;
						}

						curl_setopt($cURL, CURLOPT_POST, TRUE);
						curl_setopt($cURL, CURLOPT_POSTFIELDS, $post_back);
					}

					if($this->sslVersion != 0)
					{
						curl_setopt($cURL, CURLOPT_SSLVERSION, $this->sslVersion);
					}

					if($this->authorization)
					{
						curl_setopt($cURL, CURLOPT_USERPWD, $this->authorization['user'].":".$this->authorization['password']);
					}

					if(count($this->headers) > 0)
					{
						curl_setopt($cURL, CURLOPT_HEADER, $this->headers);
					}

					$return = curl_exec($cURL);
					$this->responseCode = curl_getinfo($cURL, CURLINFO_HTTP_CODE);

					curl_close($cURL);
					return $_return = $return ? $return : false;
				}
			}
			else
			{
				list($host, $path) = explode("/", str_replace(array("https://", "http://"), NULL, $this->address), 2);

				$port = $this->port != 80 && $this->port != 443 ? $this->port : ($this->sslVersion > 0 ? 443 : 80);
				$path = (substr($path, 0, 1) != "/" ? "/" : NULL).$path;

				if(($fp = fsockopen(($this->sslVersion > 0 ? "ssl://" : NULL).$host, $port, $errno, $errstr, $this->timeout)))
				{
					$header = ($this->post['enable'] == true ? "POST" : "GET")." {$path} HTTP/1.1\r\n";
					$header .= "Host: ".$host."\r\n";
					$header .= "User-Agent: Cetemaster PHP Communication 1.0 / HTTP/1.1\r\n";

					if($this->encoding)
					{
						$header .= "Accept-Encoding: ".$this->encoding."\r\n";
					}

					if($this->post['enable'] == true)
					{
						$post_back = NULL;
						$tmp_post_back = array();

						if(count($this->fields) > 0)
						{
							if($this->post['type'] == "json")
							{
								$post_back = json_encode($this->fields);
							}
							else
							{
								foreach($this->fields as $key => $value)
								{
									$tmp_post_back[] = urlencode($key)."=".urlencode($value);
								}

								$post_back = implode("&", $tmp_post_back);
							}
						}

						$header .= "Content-Type: ".($this->post['type'] == "json" ? "application/json" : "application/x-www-form-urlencoded")."\r\n";
						$header .= "Content-Length: ".strlen($post_back)."\r\n";
					}

					if(count($this->headers) > 0)
					{
						foreach($this->headers as $key => $value)
						{
							$header .= $key.": ".$value."\r\n";
						}
					}

					$header .= "\r\n";
					$header .= $post_back;

					if(!fwrite($fp, $header))
					{
						$this->responseCode = 0;
						return false;
					}

					if($this->authorization)
					{
						$_header = "Authorization: Basic ".base64_encode($this->authorization['user'].":".$this->authorization['password'])."\r\n\r\n";

						if(!fwrite($fp, $_header))
						{
							$this->responseCode = 0;
							return false;
						}
					}

					$content = 0;
					$code = false;

					while(!feof($fp))
					{
						$response = fgets($fp);
						
						if(substr($response, 0, 4) == "HTTP" && $code == false)
						{
							$this->responseCode = substr($response, 9, 3);
							$code = true;
							continue;
						}
						elseif($content == 2)
						{
							$content = 1;
							continue;
						}
						elseif($response == "\r\n" && $content == 0)
						{
							$content = 2;
							continue;
						}
						elseif($content == 1)
						{
							$_content .= $response;
						}
					}

					fclose($fp);
					$_content = substr($_content, 0, strlen($_content) - 7);

					return $_return = $_content;
				}
			}
		}

		return false;
	}
	/**
	 *	Clear Variables
	 *	Clear all variables
	 *
	 *	@return	void
	*/
	public function ClearAll()
	{
		$this->address = NULL;
		$this->port = 80;
		$this->timeout = 2;
		$this->sslVersion = 0;
		$this->encoding = NULL;	
		$this->follow = FALSE;
		$this->sslVerifyPeer = FALSE;
		$this->post = array();
		$this->fields = array();
		$this->authorization = array();
		$this->headers = array();
	}
}