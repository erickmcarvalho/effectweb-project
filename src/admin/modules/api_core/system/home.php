<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: System Control - Home
 * Last Update: 15/04/2012 - 18:05h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_System_Home extends Core_Admin_System
{
	/**
	 *	Init module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		$total_accounts_q = $this->DB->Query("SELECT count(1) FROM ".MUACC_CORE.".dbo.MEMB_INFO");
		$total_accounts = $this->DB->FetchRow($total_accounts_q);
		
		$total_characters_q = $this->DB->Query("SELECT count(1) FROM ".MUGEN_CORE.".dbo.Character");
		$total_characters = $this->DB->FetchRow($total_characters_q);
		
		$total_guilds_q = $this->DB->Query("SELECT count(1) FROM ".MUGEN_CORE.".dbo.Guild");
		$total_guilds = $this->DB->FetchRow($total_guilds_q);
		
		$total_online_q = $this->DB->Query("SELECT count(1) FROM ".MUACC_CORE.".dbo.MEMB_STAT WHERE ConnectStat > 0");
		$total_online = $this->DB->FetchRow($total_online_q);
		
		$total_accounts_vip_1_q = $this->DB->Query("SELECT count(1) FROM ".VIP_CORE.".dbo.".VIP_TABLE." WHERE ".VIP_COLUMN." = 1");
		$total_accounts_vip_1 = $this->DB->FetchRow($total_accounts_vip_1_q);
		
		if(VIP_NUMBER >= 2)
		{
			$total_accounts_vip_2_q = $this->DB->Query("SELECT count(1) FROM ".VIP_CORE.".dbo.".VIP_TABLE." WHERE ".VIP_COLUMN." = 2");
			$total_accounts_vip_2 = $this->DB->FetchRow($total_accounts_vip_2_q);
			
			if(VIP_NUMBER >= 3)
			{
				$total_accounts_vip_3_q = $this->DB->Query("SELECT count(1) FROM ".VIP_CORE.".dbo.".VIP_TABLE." WHERE ".VIP_COLUMN." = 3");
				$total_accounts_vip_3 = $this->DB->FetchRow($total_accounts_vip_3_q);
				
				if(VIP_NUMBER >= 4)
				{
					$total_accounts_vip_4_q = $this->DB->Query("SELECT count(1) FROM ".VIP_CORE.".dbo.".VIP_TABLE." WHERE ".VIP_COLUMN." = 4");
					$total_accounts_vip_4 = $this->DB->FetchRow($total_accounts_vip_4_q);
					
					if(VIP_NUMBER == 5)
					{
						$total_accounts_vip_5_q = $this->DB->Query("SELECT count(1) FROM ".VIP_CORE.".dbo.".VIP_TABLE." WHERE ".VIP_COLUMN." = 5");
						$total_accounts_vip_5 = $this->DB->FetchRow($total_accounts_vip_5_q);
					}
				}
			}
		}
		
		$GLOBALS['system_home']['system_name'] = "Effect Web 2";
		$GLOBALS['system_home']['system_version'] = EW_PUBLIC_VERSION;
		$GLOBALS['system_home']['admincp_version'] = ACP_PUBLIC_VERSION;
		$GLOBALS['system_home']['system_build'] = EW_BUILD_VERSION;
		$GLOBALS['system_home']['admincp_build'] = ACP_BUILD_VERSION;
		
		$GLOBALS['system_home']['total_accounts'] = number_format($total_accounts[0], 0, false, ".");
		$GLOBALS['system_home']['total_characters'] = number_format($total_characters[0], 0, false, ".");
		$GLOBALS['system_home']['total_guilds'] = number_format($total_guilds[0], 0, false, ".");
		$GLOBALS['system_home']['total_online'] = number_format($total_online[0], 0, false, ".");
		$GLOBALS['system_home']['total_accounts_vip_1'] = number_format($total_accounts_vip_1[0], 0, false, ".");
		
		if(VIP_NUMBER >= 2)
		{
			$GLOBALS['system_home']['total_accounts_vip_2'] = number_format($total_accounts_vip_2[0], 0, false, ".");
			
			if(VIP_NUMBER >= 3)
			{
				$GLOBALS['system_home']['total_accounts_vip_3'] = number_format($total_accounts_vip_3[0], 0, false, ".");
				
				if(VIP_NUMBER >= 4)
				{
					$GLOBALS['system_home']['total_accounts_vip_4'] = number_format($total_accounts_vip_4[0], 0, false, ".");
					
					if(VIP_NUMBER == 5)
					{
						$GLOBALS['system_home']['total_accounts_vip_5'] = number_format($total_accounts_vip_5[0], 0, false, ".");
					}
				}
			}
		}
	}
}