<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Library - Install
 * Last Update: 24/04/2013 - 18:33h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Installer_Install extends CTM_Command
{
	public $max_sections	= 6;
	private $sections		= array();

	/**
	 *	Class constructor
	 *
	 *	@return	void
	*/
	public function __construct()
	{
		$this->registry();

		$this->loadLibrary("Session", "session");
		$this->session->StartSession($_POST['session'] ? $_POST['session'] : $_SESSION['SETUP_SESSION']);
		$this->session->GetSession("sections", $this->sections);
	}
	/**
	 *	Check Section
	 *
	 *	@return	boolean
	*/
	public function CheckSection()
	{
		if($this->section > 1)
		{
			if($this->sections['requirements'] == false)
				return false;

			if($this->section > 2)
			{
				if($this->sections['eula'] == false)
					return false;

				if($this->section > 3)
				{
					if(!$this->sections['db_settings']['sql_host'])
						return false;

					if(!$this->sections['db_settings']['db_port'])
						return false;

					if(!$this->sections['db_settings']['db_user'])
						return false;

					if(!$this->sections['db_settings']['db_pass'])
						return false;

					if(!$this->sections['db_settings']['db_name'])
						return false;

					if($this->section > 4)
					{
						if(!$this->sections['admin_account']['account'])
							return false;

						if(!$this->sections['admin_account']['name'])
							return false;

						if(!$this->sections['admin_account']['contact'])
							return false;
					}
				}
			}
		}

		return true;
	}
}