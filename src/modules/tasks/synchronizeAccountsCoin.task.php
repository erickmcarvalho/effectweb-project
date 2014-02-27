<?php
/**
 *	Effect Web Project
 *	CronJob Script System
 *
 *	Task Name: (EW.MU) Synchronize Accounts Coin
 *	Description: Send coin's cache to real coin's table
 *
 *	Author: Erick-Master
 *	Revision: 20/10/2013
 *
 *	Effect Web Project
 *	www.effectweb.net
*/

class TaskClass_SynchronizeAccountsCoin extends CronJobCommand
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
		//------------------------------------------
		// But, get the cache :D
		//------------------------------------------
		$this->loadWrite("Starting the procedure...");

		$loadAllCacheQ = $this->DB->Query("SELECT C.* FROM ".MUGEN_CORE.".dbo.EffectWebCoinCache C LEFT JOIN ".MUACC_CORE.".dbo.MEMB_STAT S ON (S.memb___id = C.Account) WHERE S.ConnectStat = 0");

		//------------------------------------------
		// It's ok?
		//------------------------------------------
		if($this->DB->CountRows($loadAllCacheQ) < 1)
		{
			//------------------------------------------
			// No rows? :'(
			//------------------------------------------
			$this->loadWrite("No rows, end procedure!");
		}
		else
		{
			//------------------------------------------
			// Go loop, go loop, GO LOOP!!!
			//------------------------------------------
			$count = 0;
			$this->loadWrite("Updating all accounts...");

			while($fetch = $this->DB->FetchObject($loadAllCacheQ))
			{
				$update_values = array
				(
					COIN_COLUMN_1 => "plus:".$fetch->RowValue_1,
					COIN_COLUMN_2 => "plus:".$fetch->RowValue_2,
					COIN_COLUMN_3 => "minus:".$fetch->RowValue_3
				);

				$this->DB->Arguments($fetch->Account);
				$this->DB->Query("UPDATE ".COIN_CORE.".dbo.".COIN_TABLE." SET ".COIN_COLUMN_1." = ".COIN_COLUMN_1." + ".intval($fetch->RowValue_1).", ".COIN_COLUMN_2." = ".COIN_COLUMN_2." + ".intval($fetch->RowValue_2).", ".COIN_COLUMN_3." = ".COIN_COLUMN_3." + ".intval($fetch->RowValue_3)." WHERE ".COIN_LOGIN." = '%s'");
				
				$this->DB->Arguments($fetch->Account);
				$this->DB->Query("UPDATE ".MUGEN_CORE.".dbo.EffectWebCoinCache SET RowValue_1 = 0, RowValue_2 = 0, RowValue_3 = 0 WHERE Account = '%s'");
				$count++;
			}

			//------------------------------------------
			// End! xD
			//------------------------------------------
			$this->loadWrite("Updated ".$count." accounts.");
			$this->loadWrite("End procedure!");
		}
	}
}