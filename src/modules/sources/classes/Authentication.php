<?php
/**
 * Cetemaster Tech Services
 * CTM.EffectWeb *$ewVersion*
 *
 * Authentication Board
 * Last Update: 06/08/2012 - 15:55h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Authentication extends CTM_Command
{
	/**
	 *	Init Auth
	 *
	 *	@return	void
	*/
	public static function init()
	{
		if(self::Check() == true)
		{
			define("USER_ACCOUNT", str_replace("'", NULL, self::Decode(CTM_Cookies::GetCookie("AuthLogin"))));
			$_SESSION['ACCOUNT_DATA'] = CTM_MuOnline::Lib('Member')->Load(USER_ACCOUNT);
			
			if(!$_SESSION['AUTH_SESSION'])
				$_SESSION['AUTH_SESSION'] = CTM_Cookies::GetCookie("AuthSession");
		}
	}
	/**
	 *	Check Auth
	 *
	 *	@return	boolean
	*/
	public static function Check($destroy = FALSE)
	{
		if(strlen(CTM_Cookies::GetCookie("AuthLogin")) < 1)
			return $destroy ? self::loadDestroyLogin() : FALSE;
		if(strlen(CTM_Cookies::GetCookie("AuthSession")) < 1)
			return $destroy ? self::loadDestroyLogin() : FALSE;
		if(strlen(CTM_Cookies::GetCookie("AuthKey")) < 1)
			return $destroy ? self::loadDestroyLogin() : FALSE;
		if($_SESSION['AUTH_SESSION'] && !($_SESSION['AUTH_SESSION'] == CTM_Cookies::GetCookie("AuthSession")))
			return $destroy ? self::loadDestroyLogin() : FALSE;
		if(CTM_Cookies::GetCookie("AuthKey") != self::EncodeKey(self::Decode(CTM_Cookies::GetCookie("AuthLogin")), CTM_Cookies::GetCookie("AuthSession")))
			return $destroy ? self::loadDestroyLogin() : FALSE;
			
		return true;
	}
	/**
	 *	Login Module
	 *
	 *	@param	boolean	Process
	 *	@return void
	*/
	public static function LoginModule($proccess = FALSE)
	{
		self::instance()->lang->loadLanguageFile("auth");
		
		if($proccess == TRUE)
		{
			$_username = str_replace("'", NULL, $_REQUEST['username']);
			$_password = str_replace("'", NULL, $_REQUEST['password']);
			$_referer = $_REQUEST['referer'];
			
			$warning = $_GET['min_login'] == true ? -1 : 1;
			$error = $_GET['min_login'] == true ? -2 : 2;
			
			if(empty($_username) || empty($_password))
				return setResult(showMessage(self::instance()->lang->words['Auth']['Login']['Process']['EmptyFields'], $warning));
			else
			{
				self::DB()->Arguments($_username, $_password, USE_MD5);
				$checkLoginQ = self::DB()->Query("EXEC dbo.CTM_CheckAccount '%s','%s',%d");
				$checkLogin = self::DB()->FetchRow($checkLoginQ);
				
				$resultLogin = "0x".bin2hex($checkLogin[0]);
				
				if($resultLogin == "0x02")
					return setResult(showMessage(self::instance()->lang->words['Auth']['Login']['Process']['LoginFailed'], $error));
				elseif($resultLogin == "0x03")
				{
					$authSession = md5($_username."&".$_password."&".time()."&".mt_rand());
					$authKey = self::EncodeKey($_username, $authSession);
					
					CTM_Cookies::setCookie("AuthLogin", self::Encode($_username));
					CTM_Cookies::setCookie("AuthSession", $authSession);
					CTM_Cookies::setCookie("AuthKey", $authKey);
					
					$_SESSION['AUTH_SESSION'] = $authSession;
					$_SESSION['ACCOUNT_DATA'] = CTM_MuOnline::Lib('Member')->Load($_username);
					
					if(loadIsAjax() == true)
					{
						$location = CTM_URLEngine::URLBase()."?app=core&amp;module=global&amp;section=login&amp;do=process";
						
						$data = "<form action='{$location}' method='post' name='continue'>";
						$data .= "<input type='hidden' name='referer' value='".$_referer."' />";
						$data .= "<input type='hidden' name='username' value='".$_username."' />";
						$data .= "<input type='hidden' name='password' value='".$_password."' />";
						$data .= "</form>";
						$data .= "<script> document.continue.submit(); </script>";
						exit($data);
					}
					
					self::instance()->output->redirectPage(self::instance()->lang->words['Auth']['Redirect']['Login'], NULL, $_referer);
				}
			}
		}
	}
	/**
	 *	Logout Module
	 *
	 * @return void
	*/
	public static function LogoutModule($onlyDestroy = FALSE)
	{
		if(loadIsAjax() == true)
		{
			$location = CTM_URLEngine::URLBase()."?app=core&module=global&section=login&do=logout";
			exit("<script>window.location = '{$location}'</script>");
		}

		CTM_Cookies::setCookie("AuthLogin", NULL);
		CTM_Cookies::setCookie("AuthSession", NULL);
		CTM_Cookies::setCookie("AuthKey", NULL);
		
		unset($_SESSION['USERCP_CHARACTER_SELECTED']);
		unset($_SESSION['ACCOUNT_DATA']);
		unset($_SESSION['AUTH_SESSION']);
		
		if($onlyDestroy == false)
		{
			self::instance()->lang->loadLanguageFile("auth");
			self::instance()->output->redirectPage(self::instance()->lang->words['Auth']['Redirect']['Logout'], NULL);
		}
	}
	/**
	 * Get Auth Session Data
	 *
	 * @return array
	*/
	public static function GetAuthData()
	{
		return array("ACCOUNT" => $_SESSION['ACCOUNT_DATA'], "SESSION" => $_SESSION['AUTH_SESSION']);
	}
	/**
	 * Auth Session Update
	 *
	 *	@param	string	Var key
	 *	@param	string	Var new value
	 *	@return	void
	*/
	public static function UpdateSession($key, $value)
	{
		$new_key = explode(",", $key);
		$eval = "$"."_SESSION";
		
		foreach($new_key as $k => $v)
			$eval .= "['".$v."']";
			
		eval($eval." = \"".$value."\";");
	}
	/**
	 *	Reload Auth Session
	 *
	 *	@return	void
	*/
	public static function ReloadSession()
	{
		$_SESSION['ACCOUNT_DATA'] = CTM_MuOnline::Lib('Member')->Load(USER_ACCOUNT);
		$_SESSION['AUTH_SESSION'] = CTM_Cookies::GetCookie("AuthSession");
	}
	/**
	 *	Destroy Login
	 *
	 *	@return	void
	*/
	private static function loadDestroyLogin()
	{
		CTM_Cookies::setCookie("AuthLogin", NULL);
		CTM_Cookies::setCookie("AuthSession", NULL);
		CTM_Cookies::setCookie("AuthKey", NULL);
		
		unset($_SESSION['ACCOUNT_DATA']);
		unset($_SESSION['AUTH_SESSION']);
		
		self::LoginModule();
		return FALSE;
	}
	/**
	 *	Encode String (CTM.Crypt:Base64)
	 *
	 *	@param	string	Real String
	 *	@return string	Encoded String
	*/
	private static function Encode($string)
	{
		return CTM_Crypt::Lib('Base64')->Encode($string, EffectWebData::AUTH_LOGIN_KEY);
	}
	/**
	 *	Decode String (CTM.Crypt:Base64)
	 *
	 *	@param	string	Encoded String
	 *	@return string	Decoded String
	*/
	private static function Decode($string)
	{
		return CTM_Crypt::Lib('Base64')->Decode($string, EffectWebData::AUTH_LOGIN_KEY);
	}
	/**
	 *	Encode Auth Key (MD5 HASH)
	 *
	 *	@param	string	Login String
	 *	@param	string	Session String
	 *	@return string	Auth Key
	*/
	private static function EncodeKey($login, $session)
	{
		return md5(sha1($login.":".$login, TRUE)."&".md5($session.":".$session, TRUE));
	}
}