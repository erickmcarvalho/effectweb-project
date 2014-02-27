<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Effect Web: Financial - Invoices - View
 * Last Update: 10/03/2013 - 10:10h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_EffectWeb_Admin_Financial_Invoices_View extends CTM_EffectWeb_Admin_Financial_Invoices
{
	/**
	 *	Init Module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		$this->DB->Arguments($_GET['id']);
		$find_invoice_q = $this->DB->Query("SELECT * FROM dbo.CTM_Invoices WHERE Id = %d");

		if($this->DB->CountRows($find_ticket_q) > 0)
		{
			$invoice = $this->DB->FetchObject($find_invoice_q);
			
			define("EDIT_INVOICE_ACCESS", $this->CheckPermissionItem("edit_ticket"));
			define("DELETE_INVOICE_ACCESS", $this->CheckPermissionItem("delete_ticket"));

			switch($_GET['cmd'])
			{
				case "approve" :
					if($invoice->Status != 0 && $invoice->Status != 1)
					{
						exit(adminShowMessage($this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Messages']['IsClosed'], 2));
					}
					else
					{
						$quantity = (int)$_GET['quantity'];

						if($quantity < 0)
						{
							exit(adminShowMessage($this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['ApproveInvoice']['Messages']['SetNumber'], 2));
						}
						else
						{
							$this->DB->Arguments($invoice->Account, 1, $quantity, intval(COIN_USE_CACHE));
							$this->DB->Query("EXEC dbo.CTM_PlusAccountCoin '%s', %d, %d, %d");

							$this->DB->Arguments($_GET['id']);
							$this->DB->ForceDataType("Status", "integer");
							$this->DB->Update("CTM_Invoices", array("Status" => 2), "Id = %d");

							exit("<script>approveThisInvoice('".$quantity."', '".$invoice->Account."');");
						}
					}
				break;
				case "reject" :
					if($invoice->Status != 0 && $invoice->Status != 1)
					{
						exit(adminShowMessage($this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Messages']['IsClosed'], 2));
					}
					else
					{
						$this->DB->Arguments($_GET['id']);
						$this->DB->ForceDataType("Status", "integer");
						$this->DB->Update("CTM_Invoices", array("Status" => 3), "Id = %d");

						exit("<script>rejectThisInvoice();");
					}
				break;
				case "edit" :
					if(EDIT_INVOICE_ACCESS == TRUE)
					{
						if($_POST['Quantity'] == NULL || $_POST['Value'] == NULL || $_POST['Status'] == NULL)
						{
							exit(adminShowMessage($this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['EditInvoice']['Messages']['FieldsVoid'], 1));
						}
						elseif(!is_numeric($_POST['Quantity']))
						{
							exit(adminShowMessage($this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['EditInvoice']['Messages']['InvalidQuantity'], 2));
						}
						elseif($_POST['Status'] != 0 && $_POST['Status'] != 1 && $_POST['Status'] != 2 && $_POST['Status'] != 3 && $_POST['Status'] != 4)
						{
							exit(adminShowMessage($this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['EditInvoice']['Messages']['InvalidStatus'], 2));
						}
						else
						{
							$update = array
							(
								"CoinQuantity" => $_POST['Quantity'],
								"Value" => $_POST['Value'],
								"Status" => $_POST['Status']
							);

							$this->DB->ForceDataType("Quantity", "integer");
							$this->DB->ForceDataType("Value", "string");
							$this->DB->ForceDataType("Status", "integer");

							$this->DB->Arguments($_GET['id']);
							$this->DB->Update("CTM_Invoices", $update, "Id = %d");

							switch($_POST['Status'])
							{
								case 0 :
									$status = "<span style='color: #C00;'>".$this->lang->words['EWFinancial']['Invoices']['Status']['Pending']."</span>";
								break;
								case 1 :
									$status = "<span style='color: blue;'>".$this->lang->words['EWFinancial']['Invoices']['Status']['InProgress']."</span>";
								break;
								case 2 :
									$status = "<span style='color: green;'>".$this->lang->words['EWFinancial']['Invoices']['Status']['Paid']."</span>";
								break;
								case 3 :
									$status = "<span style='color: red;'>".$this->lang->words['EWFinancial']['Invoices']['Status']['Rejected']."</span>";
								break;
								case 4 :
									$status = "<span style='color: #666;'>".$this->lang->words['EWFinancial']['Invoices']['Status']['Canceled']."</span>";
								break;
							}

							exit("<script>completeEditInvoice('".$_POST['Quantity']."', '".str_replace("'", "\'", $_POST['Value'])."', '".str_replace("'", "\'", $status)."', ".$_POST['Status'].");</script>");
						}
					}
				break;
				case "reopen" :
					if($invoice->Status == 0)
					{
						exit(adminShowMessage($this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Messages']['IsOpened'], 2));
					}
					else
					{
						$this->DB->Arguments($_GET['id']);
						$this->DB->ForceDataType("Status", "integer");
						$this->DB->Update("CTM_Invoices", array("Status" => 0), "Id = %d");

						exit("<script>reopenThisInvoice();");
					}
				break;
				case "delete" :
					if(DELETE_INVOICE_ACCESS)
					{
						$query = "DELETE FROM dbo.CTM_Invoices WHERE Id = %d;\n";
						$query .= "DELETE FROM dbo.CTM_Payments WHERE InvoiceID = %d;";
						
						$this->DB->Arguments($_GET['id'], $_GET['id']);
						$this->DB->Query($query);
						
						if(!empty($ticket->Annex))
							if(file_exists("../".$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['PAYMENT_ANNEX'].$ticket->Annex))
								unlink("../".$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['PAYMENT_ANNEX'].$ticket->Annex);
						
						exit("<script>location.href='".$this->acp_vars['acp_url']."?app=effectweb&module=financial&section=invoices&message=deleted';</script>");
					}
				break;
			}

			$GLOBALS['view_invoice'] = array
			(
				"id" => $_GET['id'],
				"method_key" => $invoice->PaymentMethod,
				"document" => $invoice->Document,
				"start_date" => date("d/m/Y - h:i a", $invoice->StartDate),
				"quantity" => number_format($invoice->CoinQuantity, 0, false, "."),
				"value" => CTM_Text::MoneyFormat(MONEY_SYMBOL, $invoice->Value),
				"account" => $invoice->Account,
				"status" => $invoice->Status,
				"canceled" => $invoice->Status == 4
			);

			if($invoice->Status > 0 && $invoice->PaymentMethod != "none")
			{
				if(!$payment_data = unserialize($invoice->PaymentData))
					$payment_data = array();

				switch($invoice->PaymentMethod)
				{
					case "bank" :
						$method_name = $this->lang->words['EWFinancial']['Invoices']['Methods']['Bank'];

						$this->DB->Arguments($invoice->Id);
						$this->DB->Query("SELECT * FROM dbo.CTM_Payments WHERE InvoiceId = %d", $find_payment);

						if($this->DB->CountRows($find_payment) > 0)
						{
							$payment = $this->DB->FetchObject($find_payment);

							switch($payment->Status)
							{
								case 0 : 
									$status = "<span style='color: blue;'>".$this->lang->words['EWFinancial']['Invoices']['PaymentStatus']['Opened']."</span>";
								break;
								case 1 : 
									$status = "<span style='color: green;'>".$this->lang->words['EWFinancial']['Invoices']['PaymentStatus']['Confirmed']."</span>";
								break;
								case 2 : 
									$status = "<span style='color: red;'>".$this->lang->words['EWFinancial']['Invoices']['PaymentStatus']['Rejected']."</span>";
								break;
							}

							if(!$_payment_data = unserialize($payment->ConfirmData))
								$_payment_data = array();

							$GLOBALS['view_invoice']['bank_payment'] = array
							(
								"method" => htmlEncode($this->settings['PAYMENTMETHOD']['FORM'][$payment->Method][0]),
								"confirm_date" => date("d/m/Y - h:i a", $payment->ConfirmDate),
								"status" => $status,
								"quantity" => number_format($payment->Quantity, 0, false, ".")." ".COIN_NAME_1,
								"date" => $payment->Date,
								"hour" => $payment->Hour,
								"value" => $payment->Value,
								"local" => utf8_decode($payment->Local),
								"message" => htmlDecode($payment->Message),
								"payment_data" => $_payment_data
							);

							if(strlen($payment->Annex) > 1)
							{
								$GLOBALS['view_invoice']['bank_payment']['annex'] = array
								(
									"link" => $this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['PAYMENT_ANNEX'].$payment->Annex,
									"name" => $payment->Annex
								);
							}
						}
					break;
				}
	
				$GLOBALS['view_invoice']['payment_method'] = array
				(
					"method" => $method_name,
					"data" => $payment_data,
					"key" => $invoice->PaymentMethod
				);
			}
			
			if($noOpenCache == false)
				$this->output->setContent("invoices_viewInvoice");
		}
	}
}
		