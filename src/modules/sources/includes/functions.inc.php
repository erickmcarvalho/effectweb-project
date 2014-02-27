<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Extension includes: Global functions
 * Last Update: 09/06/2013 - 21:19h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

/**
 *	Check Load Is Ajax
 *	Check if the request page it's ajax
 *
 *	@return	boolean
*/
function loadIsAjax()
{
	$requestURI = CTM_URLEngine::URIString();
	
	if(substr_count($requestURI, "&ajaxLoadSet=true") > 0) return TRUE;
	if(substr_count($requestURI, "&ajaxLoadCache=") > 0) return TRUE;
	
	return FALSE;
}

/**
 *	Gerate Rand Text
 *	Gerate a rand text
 *
 *	@param	integer	Length
 *	@param	string	Words
 *	@return	string
*/
function gerateRandText($count = 50, $words = NULL)
{
	$return = NULL;
	for($i = 0; $i < $count; $i++)
			if(strlen($words) > 0)
				$return .= $words{mt_rand(0, strlen($words) - 1)};
			else
				$return .= chr(mt_rand(65, 90));
				
	return $return;
}

/**
 *	Set Numeric
 *	Convert to numeric text
 *
 *	@param	string	Text
 *	@return	string
*/
function setNumeric($string)
{
	return preg_replace("/[^0-9]/is", NULL, $string);
}

/**
 *	HTML Encode
 *	Encode the text in HTML tags
 *
 *	@param	string	HTML Text
 *	@param	boolean	ENT_QUOTES
 *	@return	string
*/
function htmlEncode($string, $all = TRUE)
{
	return htmlentities($string, ENT_QUOTES, "UTF-8", $all); 
}

/**
 *	HTML Decode
 *	Decode the HTML tags in text
 *
 *	@param	string	HTML Text
 *	@param	boolean	All decode
 *	@param	boolean	ENT_QUOTES
 *	@return	string
*/
function htmlDecode($string, $entQuotes = FALSE)
{
	return stripslashes(htmlspecialchars_decode($string, $entQuotes ? ENT_QUOTES : ENT_NOQUOTES));
}

/**
 *	SQL Escape String
 *	Escape the SQL string
 *
 *	@param	string	Input
 *	@return	string
*/
function sql_escape($string)
{
	if(substr($string, 0, 1) == "'")
		$string = substr_replace($string, "''", 0, 1);

	return $string;
}

/**
 *	Get Link
 *	Get the real link
 *
 *	@param	string	Link
 *	@return	string
*/
function getLink($link)
{
	$link = str_replace("?page=", NULL, $link);
	$link = str_replace("?pag=", NULL, $link);
	return "?pag=".$link;
}

/**
 *	Gerate Full Link
 *	Get the real link complete
 *
 *	@param	string	Link
 *	@param	string	Host (Default -> NULL)
 *	@param	string	PHP Self (Default -> NULL)
 *	@param	string	Auto Get Link (Default -> FALSE)
 *	@return	string
*/
function gerateFullLink($link, $host = NULL, $self = NULL, $autoGet = FALSE)
{
	if(empty($host)) $host = $_SERVER['HTTP_HOST'];
	if(empty($self)) $self = $_SERVER['PHP_SELF'];
	
	$link = $autoGet ? getLink($link) : $link;
	$protocol = $_SERVER['HTTPS'] == "on" ? "https" : "http";
	
	$setSelf = substr($self, -(strrpos($self, ".") - 1));
	$cutSelf[0] = substr($setSelf, 0, strrpos($setSelf, "."));
	$cutSelf[1] = substr($setSelf, -(strrpos($setSelf, ".") - 1));
	$self = $cutSelf[0] == "index" ? str_replace($cutSelf[0].$cutSelf[1], NULL, $self) : $self;
	
	return $protocol."://".$host.$self.$link;
}

/**
 *	Show Message
 *	Get the message text
 *
 *	@param	string	Message
 *	@param	integer	Type [0 = Info | 1 = Warning | 2 = Error | 3 = Success]
 *	@param	string	Auto show message type (Default -> *)
 *	@return	string
*/
function showMessage($message, $type = 0, $autoShow = "*")
{
	$switch = $autoShow != "*" ? $autoShow : SHOW_MESSAGE_TYPE;
	$style = "box";
	
	if(substr((string)$type, 0, 1) == "-")
	{
		$style = "min";
		$type = (int)substr($type, 1);
	}
	
	switch($switch)
	{
		case 1 :
		$message = str_replace("'", "\'", $message);
		$message = str_replace(array("\n", "\r"), array("\\\n", "\\\r"), $message);
		$begin = "<script type=\"text/javascript\">\n$"."(document).ready(function()"."{\n";
		$end = "});\n</script>";
		switch($type)
		{
			case 1 : return $begin."Sexy.alert('{$message}');\n".$end; break;
			case 2 : return $begin."Sexy.error('{$message}');\n".$end; break;
			default : return $begin."Sexy.info('{$message}');\n".$end; break;
		}
		break;
		default :
		switch($type)
		{
			case 1 : return "<div class=\"warning-{$style}\"> {$message}</div>"; break;
			case 2 : return "<div class=\"error-{$style}\"> {$message}</div>"; break;
			case 3 : return "<div class=\"success-{$style}\"> {$message}</div>"; break;
			default : return "<div class=\"info-{$style}\"> {$message}</div>"; break;
		}
		break;
	}
}

/**
 *	Set Ajax Field
 *	Set the ajax field in form
 *
 *	@param	string	Message
 *	@param	string	Field id
 *	@param	integer	Type [0 = Warning | 1 = Error | 2 = Success]
 *	@return	void
*/
function setAjaxField($message, $location, $type = 0)
{
	if(is_array($location) && count($location) == 2)
	{
		switch($type)
		{
			case 0 : 
				$color = "#EFDC75"; 
				$image = "exclamation";
			break;
			case 1 : 
				$color = "#FF0000"; 
				$image = "cross";
			break;
			case 2 : 
				$color = "#093"; 
				$image = "tick";
			break;
			default :
				$color = NULL;
				$image = NULL;
			break;
		}
		
		exit("<script>CTM.setFieldHover('{$location[0]}', '{$location[1]}', '{$message}', '{$color}', '{$image}');</script>");
	}
}

/**
 *	Set Result
 *	Set template result
 *
 *	@param	string	Text
 *	@return	void
*/
function setResult($string)
{
	if(loadIsAjax())
		exit($string);
	else
		$GLOBALS['write_result'] = $string;
}

/**
 *	My Error Type
 *	Get the php error constant
 *
 *	@param	integer	Error number
 *	@return	string
*/
function myErrorType($errno)
{
	switch($errno)
	{
		case 1 : return "E_ERROR"; break;
		case 2 : return "E_WARNING"; break;
		case 4 : return "E_PARSE"; break;
		case 8 : return "E_NOTICE"; break;
		case 16 : return "E_CORE_ERROR"; break;
		case 32 : return "E_CORE_WARNING"; break;
		case 64 : return "E_COMPILE_ERROR"; break;
		case 128 : return "E_COMPILE_WARNING"; break;
		case 256 : return "E_USER_ERROR"; break;
		case 512 : return "E_USER_WARNING"; break;
		case 1024 : return "E_USER_NOTICE"; break;
		case 2048 : return "E_STRICT"; break;
		case 4096 : return "E_RECOVERABLE_ERROR"; break;
		case 8192 : return "E_DEPRECATED"; break;
		case 16384 : return "E_USER_DEPRECATED"; break;
		case 32767 : return "E_ALL"; break;
		default : return "E_UNKNOWN"; break;
	}
}

/**
 *	My User Error Number
 *	Get the php error constant by user
 *
 *	@param	integer	Error number
 *	@return	string
*/
function myUserErrorNumber($errno)
{
	switch($errno)
	{
		case E_ERROR : return E_USER_ERROR; break;
		case E_WARNING : return E_USER_WARNING; break;
		case E_PARSE : return E_USER_ERROR; break;
		case E_NOTICE : return E_USER_NOTICE; break;
		case E_DEPRECATED : return E_USER_DEPRECATED; break;
		case E_STRICT : return E_NOTICE; break;
		default : return 0; break;
	}
}

/**
 *	My Directory
 *	Get the self directory
 *
 *	@param	string	File name
 *	@return	string
*/
function myDirectory($file = FALSE)
{
	$self = str_replace(basename($_SERVER['PHP_SELF']), NULL, $_SERVER['PHP_SELF']);
	
	if($file)
	{
		$cut = explode($self, str_replace("\\", "/", $file));
		return $cut[1];
	}
	
	return $self;
}

/**
 *	Real Format Bytes
 *	Get the real format bytes
 *
 *	@param	integer	Bytes number
 *	@return	string
*/
function realFormatBytes($bytes)
{
	if($bytes < 1024)
		return $bytes." bytes";
	elseif($bytes < 1048576)
		return round($bytes / 1024, 2). " Kb";
	elseif($bytes < 1073741824)
		return round($bytes / 1048576, 2)." Mb";
	elseif($bytes < 1099511627776)
		return round($bytes / 1073741824, 2)." Gb";
	elseif($bytes < 1125899906842624)
		return round($bytes / 1099511627776, 2)." Tb";
	elseif($bytes < 1152921504606846976)
		return round($bytes / 1125899906842624, 2)." Pb";
	elseif($bytes < 1180591620717411303424)
		return round($bytes / 1152921504606846976, 2)." Eb";
	elseif($bytes < 1208925819614629174706176)
		return round($bytes / 1180591620717411303424, 2)." Zb";
	else
		return round($bytes / 1208925819614629174706176, 2)." Yb";
}

/**
 *	Show File Download
 *	Show the download file in browse
 *
 *	@param	string	File name
 *	@param	string	File content
 *	@return	void
*/
function showFileDownload($file_name, $file_content)
{
	$length = strlen($file_content) + 3;

	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"".$file_name."\"");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".$length);
	
	ob_end_flush();
	ob_end_clean();
	
	exit($file_content);
}