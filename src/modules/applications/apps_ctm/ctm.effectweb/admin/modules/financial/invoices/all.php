<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Effect Web: Financial - Invoices - All
 * Last Update: 04/03/2013 - 17:34h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Admin_Financial_Invoices_All extends CTM_EffectWeb_Admin_Financial_Invoices
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
				$GLOBALS['result_message'] = adminShowMessage($this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Messages']['IsClosed'], 2);
			break;
			case "deleted" :
				$GLOBALS['result_message'] = adminShowMessage($this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Messages']['Deleted'], 3);
			break;
		}
		
		$GLOBALS['all_invoices'] = array();
		$find_invoices = $this->DB->Query("SELECT Id, Document, Status, StartDate, [Value], CoinQuantity FROM dbo.CTM_Invoices ORDER BY Id DESC, Status ASC");
		
		if($this->DB->CountRows($find_invoices) > 0)
		{
			while($all_invoices = $this->DB->FetchObject($find_invoices))
			{
				$GLOBALS['all_invoices'][$all_invoices->Id] = array
				(
					"document" => $all_invoices->Document,
					"quantity" => number_format($all_invoices->CoinQuantity, 0, false, ".")." ".COIN_NAME_1,
					"value" => CTM_Text::MoneyFormat(MONEY_SYMBOL, $all_invoices->Value),
					"date" => date("d/m/Y - h:i a", $all_invoices->StartDate),
					"status" => $all_invoices->Status
				);
			}
		}

		$this->output->setContent("invoices_manageInvoices");
	}
}
		