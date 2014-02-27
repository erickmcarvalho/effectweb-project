<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Effect Web: Support - Tickets - All
 * Last Update: 23/12/2012 - 20:27h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Admin_Support_Tickets_All extends CTM_EffectWeb_Admin_Support_Tickets
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{		
		switch($_GET['message'])
		{
			case "isClosed" :
				$GLOBALS['result_message'] = adminShowMessage($this->lang->words['EWSupport']['Tickets']['ManageTickets']['Messages']['IsClosed'], 2);
			break;
			case "deleted" :
				$GLOBALS['result_message'] = adminShowMessage($this->lang->words['EWSupport']['Tickets']['ManageTickets']['Messages']['Deleted'], 3);
			break;
			case "closed" :
				$GLOBALS['result_message'] = adminShowMessage($this->lang->words['EWSupport']['Tickets']['ManageTickets']['Messages']['Closed'], 3);
			break;
		}
		
		$GLOBALS['all_tickets'] = array();
		$find_tickets = $this->DB->Query("SELECT Id, Subject, Departament, Account, [Date], Status FROM CTM_Tickets ORDER BY Id DESC, Status ASC");
		
		if($this->DB->CountRows($find_tickets) > 0)
		{
			while($ticket = $this->DB->FetchObject($find_tickets))
			{
				$GLOBALS['all_tickets'][$ticket->Id] = array
				(
					"subject" => $ticket->Subject,
					"departament" => $this->settings['USERPANEL']['SUPPORT']['TICKETS']['DEPARTAMENTS'][$ticket->Departament],
					"account" => $ticket->Account,
					"open_date" => date("d/m/Y G:i a", $ticket->Date),
					"status" => $ticket->Status
				);
			}
		}

		$this->output->setContent("tickets_manageTickets");
	}
}
		