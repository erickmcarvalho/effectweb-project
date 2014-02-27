<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: Library - Repair
 * Last Update: 08/06/2013 - 20:57h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Installer_Repair extends CTM_Command
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
			if($this->sections['authentication'] == false)
				return false;

			if($this->section > 2)
			{
				if($this->sections['options'] == false)
					return false;

				if($this->section > 3)
				{
					if($this->sections['repair_db'] == false)
						return false;

					if($this->section > 4)
					{
						if($this->sections['admin_account'] == false)
							return false;
					}
				}
			}
		}

		return true;
	}
}