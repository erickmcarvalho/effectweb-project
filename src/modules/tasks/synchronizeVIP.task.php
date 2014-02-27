<?php
/**
 *	Cetemaster: Effect Web 2
 *	CronJob Script System
 *
 *	Task Name: (MU) Synchronize VIP Accounts
 *	Description: Update to "Free" the accounts with VIP expired
 *
 *	Author: Erick-Master
 *	Revision: 27/08/2012 - 18:02h
 *
 *	Cetemaster Services
 *	www.cetemaster.com.br
*/

class TaskClass_SynchronizeVIP extends CronJobCommand
{
	private $taskKey	= NULL;
	
	//------------------------------------------
	// Hi guys!
	// Come on, start the task?
	//------------------------------------------
	public function __construct($taskKey = NULL)
	{
		$this->taskKey = !$taskKey ? mt_rand() : $taskKey;
	}
	public function runTask()
	{
		/* Well, we have all accounts VIP, right? */
		$this->loadWrite("Loading all VIP Accounts");
		$findAccountsVIPQ = $this->DB->Query("SELECT ".VIP_LOGIN.",".VIP_COLUMN.",".VIP_TIME." FROM {*TABLE*} WHERE ".VIP_COLUMN." > 0", VIP_CORE, VIP_TABLE);
		
		//------------------------------------------
		// Query Failed?
		//------------------------------------------
		if(!$findAccountsVIPQ)
		{
			return $this->setTaskResult($this->taskKey, "ERROR");
		}
		
		//------------------------------------------
		// Check number of VIP
		//------------------------------------------
		$this->loadWrite("Checking quantity of accounts VIP");
		
		//------------------------------------------
		// Oh shit, nothing accounts VIP?
		//------------------------------------------
		if($this->DB->countRows($findAccountsVIPQ) < 0)
		{
			//------------------------------------------
			// And now? End task? :(
			//------------------------------------------
			$this->loadWrite("None VIP Account");
			$this->loadClose();
		}
		else
		{
			//------------------------------------------
			// Ah Yeah, go to Loop ;D
			//------------------------------------------
			$this->loadWrite("Begin Loop, starting procedure...");
			$count = 0;
			
			while($findAccountsVIP = $this->DB->fetchObject($findAccountsVIPQ))
			{
				//------------------------------------------
				// What you does?
				//------------------------------------------
				$checkTime = strlen($findAccountsVIP->{VIP_TIME}) == 10 ? time() : 0;
				
				//------------------------------------------
				// Ok, you is really VIP?
				//------------------------------------------
				if($findAccountsVIP->{VIP_TIME} <= $checkTime)
				{
					//------------------------------------------
					// What happens?
					//------------------------------------------
					$this->loadWrite("#".$findAccountsVIP->{VIP_LOGIN}.": ".self::AccountLevel($findAccountsVIP->{VIP_COLUMN})." expired and removed;");
					
					//------------------------------------------
					// Remove?
					//------------------------------------------
					$this->DB->Arguments($findAccountsVIP->{VIP_LOGIN});
					$this->DB->Query("UPDATE {*TABLE*} SET ".VIP_COLUMN." = 0,".VIP_BEGIN." = 0,".VIP_TIME." = 0 WHERE ".VIP_LOGIN." = '%s'", VIP_CORE, VIP_TABLE);
					
					//------------------------------------------
					// More one!
					//------------------------------------------
					$count++;
				}
			}
			
			//------------------------------------------
			// End?
			//------------------------------------------
			$this->loadWrite("End. Removed VIP from ".$count." accounts");
			return NULL;
		}
	}
	/*
	*	Return Account Level Name
	*
	*	@return string
	*/
	private static function AccountLevel($level)
	{
		switch($level)
		{
			case 0 : return "Free"; break;
			case 1 : return VIP_NAME_1; break;
			case 2 : return VIP_NAME_2; break;
			case 3 : return VIP_NAME_3; break;
			case 4 : return VIP_NAME_4; break;
			case 5 : return VIP_NAME_5; break;
			default: return "Error"; break;
		}
	}
}