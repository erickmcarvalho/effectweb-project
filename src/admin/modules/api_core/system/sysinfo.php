<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: System Control - SysInfo
 * Last Update: 30/12/2012 - 00:29h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_System_SysInfo extends Core_Admin_System
{
	/**
	 *	Init module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		$ew_version = EW_PUBLIC_VERSION;
		$acp_version = ACP_PUBLIC_VERSION;

		$ew_build = EW_BUILD_VERSION;
		$acp_build = ACP_BUILD_VERSION;

		echo <<<HTML
<div align="center">
	<a href="http://www.cetemaster.com.br" target="_blank"><img src="skin_cp/images/logo.png" border="0" /></a><br />
	<a href="http://www.cetemaster.com.br" target="_blank">www.cetemaster.com.br</a> / <a href="http://www.cetemaster.com" target="_blank">www.cetemaster.com</a><br /><br />
    Effect Web 2 - MuOnline Suite Software (<strong style="color:rgb(6, 62, 80);">2013</strong>)<br />
    Suite and control developed by <strong style="color:rgb(6, 62, 80);">Cetemaster Services</strong><br /><br />
    Effect Web Version: <strong>{$ew_version} (Build: {$ew_build})</strong><br />
    Admin Control Panel Version: <strong>{$acp_version} (Build: {$acp_build})</strong><br /><br />
    <strong style="color:rgb(6, 62, 80);">Cetemaster Services, Limited</strong><br />
    Copyright (c) 2010-2013. All Rights Reserved,<br />
    <a href="http://www.cetemaster.com.br" target="_blank">www.cetemaster.com.br</a> / <a href="http://www.cetemaster.com" target="_blank">www.cetemaster.com</a>

</div>
HTML;
		exit();
	}
}