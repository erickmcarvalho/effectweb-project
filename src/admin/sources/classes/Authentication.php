<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Authentication CP
 * Last Update: 19/08/2012 - 15:08h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Authentication extends CTM_Command
{
	private static $_tmp_team_info	= array();
	
	/**
	 *	Init Auth
	 *
	 *	@return	void
	*/
	public static function init()
	{
		if(self::Check() == true)
		{
			define("USER_ACCOUNT", str_replace("'", NULL, self::Decode(CTM_Cookies::GetCookie("ACP_AuthLogin"))));
			self::LoadData();
			
			if(!$_SESSION['ACP_AUTH_SESSION'])
				$_SESSION['ACP_AUTH_SESSION'] = CTM_Cookies::GetCookie("ACP_AuthSession");
				
			$_SESSION['ACP_AUTH_SECURE_TIMER'] = strtotime("+ 30 minutes");
			define("ACP_SESSION_LOGGED", TRUE);
		}
		else
			define("ACP_SESSION_LOGGED", FALSE);
	}
	/**
	 *	Check Auth
	 *
	 *	@return	boolean
	*/
	public static function Check($destroy = FALSE)
	{
		if(strlen(CTM_Cookies::GetCookie("ACP_AuthLogin")) < 1)
			return $destroy ? self::loadDestroyLogin() : false;
		if(strlen(CTM_Cookies::GetCookie("ACP_AuthSession")) < 1)
			return $destroy ? self::loadDestroyLogin() : false;
		if(strlen(CTM_Cookies::GetCookie("ACP_AuthKey")) < 1)
			return $destroy ? self::loadDestroyLogin() : false;
		if($_SESSION['ACP_AUTH_SESSION'] && !($_SESSION['ACP_AUTH_SESSION'] == CTM_Cookies::GetCookie("ACP_AuthSession")))
			return $destroy ? self::loadDestroyLogin() : false;
		if(!$_SESSION['ACP_AUTH_SECURE_TIMER'] || $_SESSION['ACP_AUTH_SECURE_TIMER'] < time())
			return $destroy ? self::loadDestroyLogin("SessionExpired") : false;
		if(CTM_Cookies::GetCookie("ACP_AuthKey") != self::EncodeKey(self::Decode(CTM_Cookies::GetCookie("ACP_AuthLogin")), CTM_Cookies::GetCookie("ACP_AuthSession")))
			return $destroy ? self::loadDestroyLogin() : false;
		
		if(!$_SESSION['ACP_ACCOUNT_DATA']['data'])
		{
			self::DB()->Arguments(USER_ACCOUNT);
			$team_info_q = self::DB()->Select("*", "CTM_TeamMembers", "Account = '%s'");
			
			if(self::DB()->CountRows($team_info_q) < 1)
				return $destroy ? self::loadDestroyLogin("NoPermission") : false;
				
			$team_info = self::DB()->FetchArray($team_info_q);
		}
		else
			$team_info = $_SESSION['ACP_ACCOUNT_DATA']['data'];
		
		
		if($team_info['ACP_Access'] != 1)
			return $destroy ? self::loadDestroyLogin("NoPermission") : false;
		
		if(!$_SESSION['ACP_ACCOUNT_DATA']['data'])	
			self::$_tmp_team_info = (array)$team_info;
			
		return true;
	}
	/**
	 *	Load Data
	 *
	 *	@return	void
	*/
	public static function LoadData($force_load = FALSE)
	{
		if(!$_SESSION['ACP_ACCOUNT_DATA']['info'] || $force_load == true)
		{
			$_SESSION['ACP_ACCOUNT_DATA']['info'] = CTM_MuOnline::Lib('Member')->Load(USER_ACCOUNT, array("info" => "memb_name,bloc_code,MemberStatus"));
		}
		
		if(!$_SESSION['ACP_ACCOUNT_DATA']['data'] || $force_load == true)
		{
			if(!self::$_tmp_team_info)
			{
				self::DB()->Arguments(USER_ACCOUNT);
				$team_info_q = self::DB()->Select("*", "CTM_TeamMembers", "Account = '%s'");
				$_SESSION['ACP_ACCOUNT_DATA']['data'] = (array)self::DB()->FetchArray($team_info_q);
				
				self::$_tmp_team_info = array();
			}
			else
				$_SESSION['ACP_ACCOUNT_DATA']['data'] = self::$_tmp_team_info;
		}

		$team_info = $_SESSION['ACP_ACCOUNT_DATA']['data'];
		
		if(!$_SESSION['ACP_ACCOUNT_DATA']['permissions'] || $force_load == true)
		{
			self::DB()->Arguments(intval($team_info['PrimaryGroup']));
			$permissions_g_q = self::DB()->Select("PermissionCache", "CTM_TeamPermission", "RowType = 'group' AND RowValue = %d");
			
			self::DB()->Arguments(USER_ACCOUNT);
			$permissions_m_q = self::DB()->Select("PermissionCache", "CTM_TeamPermission", "RowType = 'member' AND RowValue = '%s'");
			
			if(self::DB()->CountRows($permissions_g_q) > 0)
			{
				$permissions = self::DB()->FetchRow($permissions_g_q);
				$_group_permission = true;
				
				if(!($_g_permissions = unserialize($permissions[0])))
					$_g_permissions = array("applications" => array(), "modules" => array(), "items" => array());
			}
			
			if(self::DB()->CountRows($permissions_m_q) > 0)
			{
				$permissions = self::DB()->FetchRow($permissions_m_q);
				$_member_permission = true;
				
				if(!($_m_permissions = unserialize($permissions[0])))
					$_m_permissions = array("applications" => array(), "modules" => array(), "items" => array());
			}
			
			$member_permissions = is_array($_g_permissions) ? $_g_permissions : array("applications" => array(), "modules" => array(), "items" => array());
			
			if(self::DB()->CountRows($permissions_m_q) > 0)
			{
				foreach($_m_permissions['applications'] as $app)
					if(!in_array($app, $member_permissions['applications']))
						$member_permissions['applications'][] = $app;
						
				foreach($_m_permissions['modules'] as $module)
					if(!in_array($module, $member_permissions['modules']))
						$member_permissions['modules'][] = $module;
						
				foreach($_m_permissions['items'] as $item)
					if(!in_array($item, $member_permissions['items']))
						$member_permissions['items'][] = $item;
			}
			
			$_SESSION['ACP_ACCOUNT_DATA']['permissions'] = !$_member_permission && !$_group_permission ? "*" : $member_permissions;
		}

		if(!$_SESSION['ACP_ACCOUNT_DATA']['is_admin'] || $force_load == true)
		{
			self::DB()->Arguments(intval($team_info['PrimaryGroup']));
			$permissions_g_q = self::DB()->Select("IsAdmin", "CTM_TeamPermission", "RowType = 'group' AND RowValue = %d");
			
			self::DB()->Arguments(USER_ACCOUNT);
			$permissions_m_q = self::DB()->Select("IsAdmin", "CTM_TeamPermission", "RowType = 'member' AND RowValue = '%s'");
			
			if(self::DB()->CountRows($permissions_g_q) > 0)
			{
				$is_Admin = self::DB()->FetchRow($permissions_g_q);
				$_group_admin = $is_admin[0];
			}
			
			if(self::DB()->CountRows($permissions_m_q) > 0)
			{
				$permissions = self::DB()->FetchRow($permissions_m_q);
				$_member_admin = $is_admin[0];
			}
			
			$_SESSION['ACP_ACCOUNT_DATA']['is_admin'] = $_group_admin == 1 || $_member_admin == 1;
		}
		
		return $_SESSION['ACP_ACCOUNT_DATA'];
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
			$set_result = create_function("\$content, \$msg", "
			\$requestURI = CTM_URLEngine::URIString();
			\$is_ajax = false;
	
			if(substr_count(\$requestURI, \"&ajaxLoadSet=true\") > 0) \$is_ajax = true;
			if(substr_count(\$requestURI, \"&ajaxLoadCache=\") > 0) \$is_ajax = true;
			
			if(\$is_ajax == true)
				exit(adminShowMessage(\$content, \$msg));
			else \$GLOBALS['auth_login']['message'] = \$content;
			");
			
			$_username = str_replace("'", NULL, $_REQUEST['username']);
			$_password = str_replace("'", NULL, $_REQUEST['password']);
			$_referer = $_REQUEST['referer'];
			
			$warning = $_GET['min_login'] == true ? -1 : 1;
			$error = $_GET['min_login'] == true ? -2 : 2;
			
			if(empty($_username) || empty($_password))
			{
				return $set_result(self::instance()->lang->words['Auth']['Login']['Process']['EmptyFields'], $warning);
			}
			else
			{
				self::DB()->Arguments($_username, $_password, USE_MD5);
				$checkLoginQ = self::DB()->Query("EXEC dbo.CTM_CheckAccount '%s','%s',%d");
				$checkLogin = self::DB()->FetchRow($checkLoginQ);
				
				$resultLogin = "0x".bin2hex($checkLogin[0]);
				
				if($resultLogin == "0x02")
				{
					return $set_result(self::instance()->lang->words['Auth']['Login']['Process']['LoginFailed'], $error);
				}
				elseif($resultLogin == "0x03")
				{
					self::DB()->Arguments($_username);
					$get_info = self::DB()->Select("*", "CTM_TeamMembers", "Account = '%s'");
					
					if(self::DB()->CountRows($get_info) < 1)
						return $set_result(self::instance()->lang->words['Auth']['Login']['Process']['NoPermission'], $error);
					else
					{
						$_info = self::DB()->FetchArray($get_info);
						
						if($_info['ACP_Access'] != 1)
						{
							return $set_result(self::instance()->lang->words['Auth']['Login']['Process']['NoPermission'], $error);
						}
						else
						{
							self::$_tmp_team_info = (array)$_info;
							
							$authSession = md5($_username."&".$_password."&".time()."&".mt_rand());
							$authKey = self::EncodeKey($_username, $authSession);
							
							CTM_Cookies::setCookie("ACP_AuthLogin", self::Encode($_username));
							CTM_Cookies::setCookie("ACP_AuthSession", $authSession);
							CTM_Cookies::setCookie("ACP_AuthKey", $authKey);

							define("USER_ACCOUNT", $_username);
							
							$_SESSION['ACP_AUTH_SESSION'] = $authSession;
							$_SESSION['ACP_ACCOUNT_DATA'] = self::LoadData();
							$_SESSION['ACP_AUTH_SECURE_TIMER'] = strtotime("+ 30 minutes");
							
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
							
							CTM_ACPBoard::output()->redirectPage(self::instance()->lang->words['Auth']['Redirect']['Login'], NULL, $_referer);
						}
					}
				}
			}
		}
	}
	/**
	 *	Logout Module
	 *
	 *	@return void
	*/
	public static function LogoutModule($onlyDestroy = FALSE)
	{
		CTM_Cookies::setCookie("ACP_AuthLogin", NULL);
		CTM_Cookies::setCookie("ACP_AuthSession", NULL);
		CTM_Cookies::setCookie("ACP_AuthKey", NULL);
		
		unset($_SESSION['ACP_ACCOUNT_DATA']);
		unset($_SESSION['ACP_AUTH_SESSION']);
		unset($_SESSION['ACP_AUTH_SECURE_TIMER']);
		session_destroy();
		
		if($onlyDestroy == false)
		{
			self::instance()->lang->loadLanguageFile("auth");
			CTM_ACPBoard::output()->redirectPage(self::instance()->lang->words['Auth']['Redirect']['Logout'], NULL);
		}
	}
	/**
	 * Get Auth Session Data
	 *
	 *	@return array
	*/
	public static function GetAuthData()
	{
		return array("account" => $_SESSION['ACP_ACCOUNT_DATA'], "session" => $_SESSION['ACP_AUTH_SESSION']);
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
		$_SESSION['ACP_ACCOUNT_DATA'] = CTM_MuOnline::Lib('Member')->Load(USER_ACCOUNT);
		$_SESSION['ACP_AUTH_SESSION'] = CTM_Cookies::GetCookie("ACP_AuthSession");
	}
	/**
	 *	Destroy Login
	 *
	 *	@param	string	Show message
	 *	@return	void
	*/
	private static function loadDestroyLogin($message = NULL)
	{
		CTM_Cookies::setCookie("ACP_AuthLogin", NULL);
		CTM_Cookies::setCookie("ACP_AuthSession", NULL);
		CTM_Cookies::setCookie("ACP_AuthKey", NULL);
		
		unset($_SESSION['ACP_ACCOUNT_DATA']);
		unset($_SESSION['ACP_AUTH_SESSION']);
		unset($_SESSION['ACP_AUTH_SECURE_TIMER']);
		session_destroy();
		
		if(!empty($message))
		{
			self::instance()->lang->loadLanguageFile("auth");
			$GLOBALS['auth_login']['message'] = self::instance()->lang->words['Auth']['Login']['Messages'][$message];
		}
		
		self::LoginModule();
	}
	/**
	 *	Encode String (CTM.Crypt:Base64)
	 *
	 *	@param	string	Real String
	 *	@return string	Encoded String
	*/
	private static function Encode($string)
	{
		return CTM_Crypt::Lib('Base64')->Encode($string, EffectWebData::ACP_AUTH_LOGIN_KEY);
	}
	/**
	 *	Decode String (CTM.Crypt:Base64)
	 *
	 *	@param	string	Encoded String
	 *	@return string	Decoded String
	*/
	private static function Decode($string)
	{
		return CTM_Crypt::Lib('Base64')->Decode($string, EffectWebData::ACP_AUTH_LOGIN_KEY);
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
		return md5("ACP::".sha1($login.":".$login, TRUE)."&".md5($session.":".$session, TRUE));
	}
}