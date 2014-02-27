<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP: Application Command
 * Last Update: 19/08/2012 - 15:08h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_ACPCommand extends CTM_Command
{
	protected $settings			= array();
	protected $acp_vars			= array();
	protected $member			= array();
	protected $output			= NULL;
	protected $lang				= NULL;
	protected $functions		= NULL;
	protected $email			= NULL;
	protected $mailer			= NULL;
	protected $DB				= NULL;
	
	private static $instance	= NULL;
	
	/**
	 *	Registry instance
	 *
	 *	@return	void
	*/
	public function registry()
	{
		parent::instance()->registry();
		
		$this->settings = CTM_Registry::fetchSettings();
		$this->acp_vars = CTM_ACPRegistry::fetchVariables();
		$this->output = CTM_ACPBoard::output();
		$this->lang = CTM_Command::instance()->lang;
		$this->email = CTM_Command::instance()->email;
		$this->functions = CTM_Command::instance()->functions;
		$this->mailer = $GLOBALS['CTM_Mailer'];
		$this->DB = CTM_Registry::fetchDriver();
		$this->member = CTM_ACPRegistry::fetchMember();
	}
	/**
	 *	Update ACP Vars
	 *
	 *	@param	mixed	Key
	 *	@param	mixed	Value
	 *	@return	void
	*/
	protected function updateACPVars($key, $value)
	{
		$this->acp_vars[$key] = $value;
		CTM_ACPRegistry::setVars($key, $value);
	}
	/**
	 *	Get self instance
	 *
	 *	@return	object
	*/
	protected static function acp_instance()
	{
		if(!self::$instance)
			self::$instance = new self();
			
		return self::$instance;
	}
	/**
	 *	Check Permission
	 *
	 *	@param	string	Row type [applications | modules | items]
	 *	@param	string	Row value
	 *	@param	boolean	Block access
	 *	@return	boolean
	*/
	protected function checkPermission($row_type, $row_value = FALSE, $block_access = FALSE)
	{
		if($row_type == "applications" || $row_type == "modules" || $row_type == "items")
		{
			if($this->member['account']['permissions'] == "*")
				return true;
				
			if(!in_array($row_value, $this->member['account']['permissions'][$row_type]))
			{
				if($block_access == true)
					define("ACP_PERMISSION_ACCESS_ERROR", 1);

				return false;
			}
			
			return true;
		}
		elseif($row_type == "admin")
		{
			if($this->member['account']['permissions'] == "*")
				return true;

			if(!$this->member['account']['is_admin'])
			{
				if($block_access == true)
					define("ACP_PERMISSION_ACCESS_ERROR", 1);
					
				return false;
			}

			return true;
		}
	}
}