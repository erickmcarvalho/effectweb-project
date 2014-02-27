<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Confirm Register
 * Last Update: 20/05/2012 - 21:34h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Register_ConfirmAccount extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		$GLOBALS['link_id'] = $_GET['id'] ? $_GET['id'] : $this->URLData[2];
		
		if(!empty($GLOBALS['link_id']))
		{
			$this->DB->Arguments($GLOBALS['link_id']);
			$this->DB->Query("SELECT Account FROM dbo.CTM_ValidatingAccounts WHERE Id = %d", $findDataQuery);
				
			if($this->DB->CountRows($findDataQuery) < 1)
			{
				$GLOBALS['confirm_error'] = $this->lang->words['Register']['Confirm']['Messages']['Link']['Invalid'];
			}
			else
			{
				$rows = $this->DB->FetchObject($findDataQuery);
					
				if($rows->Confirmed == 1)
				{
					$GLOBALS['confirm_error'] = $this->lang->words['Register']['Confirm']['Messages']['Link']['Confirmed'];
				}
				else
				{
					$this->DB->Arguments($GLOBALS['link_id'], $rows->Account);
					$this->DB->Delete("CTM_ValidatingAccounts", "Id = %d");
					
					$this->DB->Arguments($rows->Account);
					$this->DB->Update(MUACC_CORE."@MEMB_INFO", array("bloc_code" => 0, "MemberStatus" => 0), "memb___id = '%s'");
						
					$GLOBALS['confirm_error'] = FALSE;
				}
			}
		}
		else
		{
			if($_GET['write'] == true)
			{
				$put = "((0|1|2|3|4|5|6|7|8|9|A|B|C|D|E|F)(0|1|2|3|4|5|6|7|8|9|A|B|C|D|E|F))";
				
				if(!preg_match("/{$put}\:{$put}\:{$put}\:{$put}\:{$put}\:{$put}\:{$put}\:{$put}/i", $_POST['ConfirmCode']))
				{
					exit(showMessage($this->lang->words['Register']['Confirm']['Messages']['Code']['Format'], 2));
				}
				else
				{
					self::DB()->Arguments($_POST['ConfirmCode']);
					$query = self::DB()->Query("SELECT Account,Confirmed FROM dbo.CTM_ValidatingAccounts WHERE ConfirmCode = '%s'");
					
					$this->DB->Arguments($_POST['ConfirmCode']);
					$this->DB->Query("SELECT Account FROM dbo.CTM_ValidatingAccounts WHERE ConfirmCode = '%s'", $findDataQuery);
						
					if($this->DB->CountRows($findDataQuery) < 1)
					{
						exit(showMessage($this->lang->words['Register']['Confirm']['Messages']['Code']['Invalid'], 2));
					}
					else
					{
						$rows = $this->DB->FetchObject($findDataQuery);
							
						if($rows->Confirmed == 1)
						{
							exit(showMessage($this->lang->words['Register']['Confirm']['Messages']['Code']['Confirmed'], 2));
						}
						else
						{
							$this->DB->Arguments($_POST['ConfirmCode'], $rows->Account);
							$this->DB->Delete("CTM_ValidatingAccounts", "ConfirmCode = '%s'");
							
							$this->DB->Arguments($rows->Account);
							$this->DB->Update(MUACC_CORE."@MEMB_INFO", array("bloc_code" => 0, "MemberStatus" => 0), "memb___id = '%s'");
								
							exit(showMessage($this->lang->words['Register']['Confirm']['Messages']['Code']['Success'], 3));
						}
					}
				}
			}
		}
		
		$this->output->loadSkinCache("register", "confirmRegister");
	}
}