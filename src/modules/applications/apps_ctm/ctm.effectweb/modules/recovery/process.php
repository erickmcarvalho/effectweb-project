<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * Core App: Recovery - Process
 * Last Update: 23/05/2012 - 19:41h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Recovery_Process extends CTM_EWCore
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		$this->loadWriteProcess();
		$this->output->loadSkinCache("recovery", "redefinePassword");
	}
	/**
	 *	Write Process
	 *
	 *	@return	void
	*/
	private function loadWriteProcess()
	{
		$GLOBALS['link_id'] = $_GET['id'] ? $_GET['id'] : $this->URLData[2];
		
		if(!empty($GLOBALS['link_id']))
		{
			$_link_id = TRUE;
			
			$this->DB->Arguments($GLOBALS['link_id']);
			$this->DB->Query("SELECT Account,Expiration FROM dbo.CTM_RecoverData WHERE Id = %d", $findDataQuery);
				
			if($this->DB->CountRows($findDataQuery) < 1)
			{
				$GLOBALS['link_error'] = $this->lang->words['Recovery']['Process']['Messages']['Link']['Invalid'];
			}
			else
			{
				$rows = $this->DB->FetchObject($findDataQuery);
				$_account = $rows->Account;
					
				if($rows->Expiration <= time())
				{
					$GLOBALS['link_error'] = $this->lang->words['Recovery']['Process']['Messages']['Link']['Expirated'];
				}
			}
		}
		
		if($_GET['write'] == true)
		{
			if(!empty($GLOBALS['link_error']))
				return setResult(showMessage($GLOBALS['link_error'], 2));
				
			if(empty($_POST['NewPassword']) || empty($_POST['CNewPassword']) || (empty($_POST['RedefineCode']) && $_link_id == false))
				return setResult(showMessage($this->lang->words['Recovery']['Process']['Messages']['Write']['Void'], 1));
				
			if($_link_id == false)
			{
				$put = "((0|1|2|3|4|5|6|7|8|9|A|B|C|D|E|F)(0|1|2|3|4|5|6|7|8|9|A|B|C|D|E|F))";
				if(!preg_match("/{$put}\:{$put}\:{$put}\:{$put}\:{$put}\:{$put}\:{$put}\:{$put}/i", $_POST['RedefineCode']))
					return setResult(showMessage($this->lang->words['Recovery']['Process']['Messages']['Code']['Format'], 2));
					
				$this->DB->Arguments($_POST['RedefineCode']);
				$findRedefineQuery = $this->DB->Select("Account,Expiration", "CTM_RecoverData", "RedefineCode = '%s'");
				
				if($this->DB->CountRows($findRedefineQuery) < 1)
					return setResult(showMessage($this->lang->words['Recovery']['Process']['Messages']['Code']['Invalid'], 2));
					
				$findRedefine = $this->DB->FetchArray($findRedefineQuery);
				
				if($findRedefine['Expiration'] <= time())
					return setResult(showMessage($this->lang->words['Recovery']['Process']['Messages']['Code']['Expired'], 2));
					
				$_account = $findRedefine['Account'];
			}
			
			if(strcmp($_POST['NewPassword'], $_POST['CNewPassword']) <> 0)
				return setResult(showMessage($this->lang->words['Recovery']['Process']['Messages']['Write']['PassError'], 2));
			
			/* Success */	
			if($_link_id == true)
			{
				$where = "Id = %d";
				$argument = $GLOBALS['link_id'];
			}
			else
			{
				$where = "RedefineCode = '%s'";
				$argument = $_POST['RedefineCode'];
			}
			
			$this->DB->Arguments($argument);
			$this->DB->Delete("CTM_RecoverData", $where);
				
			$this->MuLib('Member')->ChangePassword($_account, $_POST['NewPassword']);
			return setResult(showMessage($this->lang->words['Recovery']['Process']['Messages']['Write']['Success'], 3));
		}
	}
}