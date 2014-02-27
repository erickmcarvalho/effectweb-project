<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: Server Control - Game Control
 * Last Update: 10/09/2012 - 23:14h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_Server_GameControl extends Core_Admin_Server
{
	/**
	 *	Init module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		switch($_GET['index'])
		{
			case "usersOnline" :
				$this->loadUsersOnline();
			break;
			case "sendGlobalMessage" :
				$this->loadSendGlobalMessage();
			break;
		}
	}
	/**
	 *	Private: Users Onlines
	 *	View the users online and disconnect user by JoinServer
	 *
	 *	@return	void
	*/
	private function loadUsersOnline()
	{
		if(!empty($_GET['disconnect']))
		{
			$this->DB->Arguments($_GET['disconnect']);
			$this->DB->Query("SELECT memb___id FROM ".MUACC_CORE.".dbo.MEMB_STAT WHERE memb___id = '%s' AND ConnectStat > 0", $check_query);

			if($this->DB->CountRows($check_query) < 1)
			{
				$GLOBALS['result_message'] = adminShowMessage($this->lang->words['Server']['GameControl']['UsersOnline']['Messages']['UserError'], 2);
			}
			else
			{
				if(!$this->MuLib('JoinServer')->ForceLogout($_GET['disconnect']))
				{
					$GLOBALS['result_message'] = sprintf($this->lang->words['Server']['GameControl']['UsersOnline']['Messages']['DisconnectError'], CoreVariables::ErrorsCode()->JoinServerFail);
					$GLOBALS['result_message'] = adminShowMessage($GLOBALS['result_message'], 2);
				}
				else
				{
					$GLOBALS['result_message'] = adminShowMessage($this->lang->words['Server']['GameControl']['UsersOnline']['Messages']['DisconnectSuccess'], 3);
				}
			}
		}

		$GLOBALS['users_online'] = array();

		$g = MUGEN_CORE.".dbo.";
		$a = MUACC_CORE.".dbo.";

		$find_onlines_q = $this->DB->Query("SELECT {$a}MEMB_STAT.memb___id, DATEDIFF(s, '19700101', {$a}MEMB_STAT.ConnectTM) AS ConnectTM, {$a}MEMB_STAT.ServerName, {$a}MEMB_STAT.IP, {$g}AccountCharacter.GameIDC FROM {$a}MEMB_STAT LEFT JOIN {$g}AccountCharacter ON ({$g}AccountCharacter.Id = {$a}MEMB_STAT.memb___id) WHERE {$a}MEMB_STAT.ConnectStat = 1");

		if($this->DB->CountRows($find_onlines_q) > 0)
		{
			while($find_onlines = $this->DB->FetchObject($find_onlines_q))
			{
				$GLOBALS['users_online'][$find_onlines->memb___id] = array
				(
					"character" => $find_onlines->GameIDC,
					"server" => $this->functions->GetServerName($find_onlines->ServerName),
					"gameserver" => $find_onlines->ServerName,
					"ip" => $find_onlines->IP,
					"connecttime" => date("d/m/Y - G:i a", $find_onlines->ConnectTM)
				);
			}
		}

		$this->output->setContent("gamecontrol_usersOnline");
	}
	/**
	 *	Private: Send Global Message
	 *	Send a message in global display from all players by JoinServer
	 *
	 *	@return	void
	*/
	public function loadSendGlobalMessage()
	{
		if($_GET['write'] == true)
		{
			if(empty($_POST['message']))
			{
				$GLOBALS['result_message'] = adminShowMessage($this->lang->words['Server']['GameControl']['SendGlobalMessage']['Messages']['MessageVoid'], 1);
			}
			else
			{
				if(!$this->MuLib('JoinServer')->SendGlobalMessage($_POST['message']))
				{
					$GLOBALS['result_message'] = sprintf($this->lang->words['Server']['GameControl']['SendGlobalMessage']['Messages']['SendError'], CoreVariables::ErrorsCode()->JoinServerFail);
					$GLOBALS['result_message'] = adminShowMessage($GLOBALS['result_message'], 2);
				}
				else
				{
					$GLOBALS['result_message'] = adminShowMessage($this->lang->words['Server']['GameControl']['SendGlobalMessage']['Messages']['Success'], 3);
				}
			}
		}

		$this->output->setContent("gamecontrol_sendGlobalMessage");
	}
}