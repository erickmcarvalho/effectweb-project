<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Effect Web ACP: Application Skin
 * Last Update: 04/03/2012 - 18:46h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_ACPSkin_Financial extends CTM_ACPCommand
{
	/**
	 *	Global Sidebar
	 *
	 *	@return	string	HTML String
	*/
	public function core_global_sidebar()
	{
		$CTM_HTML = NULL;
		if($this->checkPermission("modules", "effectweb_financial_invoices") == true)
		{
			$CTM_HTML .= <<<HTML
<div class="box info">
                <h2>{$this->lang->words['EWFinancial']['Sidebar']['Invoices']['Title']}</h2>
				<section>
					<ul>
						<li><a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=financial&amp;section=invoices&amp;index=openInvoice">{$this->lang->words['EWFinancial']['Sidebar']['Invoices']['OpenInvoices']}</a></li>
                        <li><a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=financial&amp;section=invoices&amp;index=manageInvoices">{$this->lang->words['EWFinancial']['Sidebar']['Invoices']['ManageInvoices']}</a></li>
					</ul>
				</section>
			</div>
HTML;
		}

		return $CTM_HTML;
	}
	/**
	 *	Financial: Home
	 *
	 *	@return	string	HTML String
	*/
	public function financial_home()
	{
		$CTM_HTML = <<<HTML
<article id="dashboard">
				<h1>{$this->lang->words['EWFinancial']['Home']['Title']}</h1>
				
				<h2>{$this->lang->words['EWFinancial']['Home']['Links']['Title']}</h2>
				<section class="icons">
					<ul>
						<li>
							<a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=financial&amp;section=invoices">
								<img src="{$this->acp_vars['acp_url']}skin_cp/images/eleganticons/Paper.png" />
								<span>{$this->lang->words['EWFinancial']['Home']['Links']['Invoices']}</span>
							</a>
						</li>
					</ul>
				</section>
HTML;

		return $CTM_HTML;
	}
	/**
	 *	Invoices: Manage Invoices
	 *
	 *	@return	string	HTML String
	*/
	public function invoices_manageInvoices()
	{
		global $result_message, $all_invoices;
		
		$CTM_HTML = <<<HTML
			<script type="text/javascript">
			$(function()
			{
				$("a[rel*=Close]").click(function()
				{
					TicketId = $(this).attr("tid");
					Sexy.confirm("{$this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Messages']['Close']}", { onComplete : function(result)
					{
						if(result)
						{
							window.location = "{$this->acp_vars['acp_url']}?app=effectweb&module=financial&section=invoices&do=view&cmd=close&return=true&id="+TicketId;
						}
					}});
				});
				$('#datatable').dataTable(
				{
					"aaSorting": [[ 0, "desc" ],],
					'bJQueryUI': true,
					'sPaginationType': 'full_numbers',
					"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
					"oLanguage": 
					{
						"sLengthMenu": "{$this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Table']['Infos']['Display']}".replace("{_MENU_}", "_MENU_"),
						"sZeroRecords": "{$this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Table']['Infos']['NotResult']}",
						"sInfo": "{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['Infos']['Show']}".replace("{_START_}","_START_").replace("{_END_}","_END_").replace("{_TOTAL_}","_TOTAL_"),
						"sInfoEmpty": "{$this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Table']['Infos']['Show']}".replace("{_START_}",0).replace("{_END_}",0).replace("{_TOTAL_}",0),
						"sInfoFiltered": "{$this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Table']['Infos']['Filter']}".replace("{_MAX_}", "_MAX_")
					}
				});
			});
			</script>
			<article>
				<h1>{$this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Title']}</h1>
                {$result_message}
               
HTML;

				if(count($all_invoices) > 0)
                {
                	$CTM_HTML .= <<<HTML
                    
                	<table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
						<thead>
							<tr>
								<th>{$this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Table']['Document']}</th>
                                <th>{$this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Table']['Quantity']}</th>
                                <th>{$this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Table']['Value']}</th>
                                <th>{$this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Table']['Date']}</th>
                                <th>{$this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Table']['Status']}</th>
							</tr>
						</thead>
						<tbody>
HTML;

					$i = 0;
                    
					foreach($all_invoices as $id => $invoice)
                    {
                    	switch($invoice['status'])
                        {
                            case 0 :
                                $financialGrade = "gradeX";
                                $status = "<span style='color: #C00;'>".$this->lang->words['EWFinancial']['Invoices']['Status']['Pending']."</span>";
                            break;
                            case 1 :
                                $financialGrade = "gradeC";
                                $status = "<span style='color: blue;'>".$this->lang->words['EWFinancial']['Invoices']['Status']['InProgress']."</span>";
                            break;
                            case 2 :
                                $financialGrade = "gradeA";
                                $status = "<span style='color: green;'>".$this->lang->words['EWFinancial']['Invoices']['Status']['Paid']."</span>";
                            break;
                            case 3 :
                                $financialGrade = "gradeU";
                                $status = "<span style='color: red;'>".$this->lang->words['EWFinancial']['Invoices']['Status']['Rejected']."</span>";
                            break;
                            case 4 :
                                $financialGrade = "gradeU";
                                $status = "<span style='color: #666;'>".$this->lang->words['EWFinancial']['Invoices']['Status']['Canceled']."</span>";
                            break;
                        }
                        
                        $grade_type = ($i % 2) == 0 ? "odd" : "even";
                        $i++;
                        
                    	$CTM_HTML .= <<<HTML
                        
							<tr class="{$grade_type} {$financialGrade}">
								<td><a href="{$this->acp_vars['acp_url']}?app=effectweb&module=financial&section=invoices&do=view&id={$id}">{$invoice['document']}</a></td>
								<td>{$invoice['quantity']}</td>
								<td>{$invoice['value']}</td>
								<td>{$invoice['date']}</td>
                                <td>{$status}</td>
							</tr>
HTML;
					}
                    
                    $CTM_HTML .= <<<HTML
                    
						</tbody>
					</table>
HTML;
				}
                else
                {
                	$CTM_HTML .= <<<HTML
                    
				<div class="information msg">{$this->lang->words['EWFinancial']['Invoices']['ManageInvoices']['Messages']['None']}</div>
HTML;
                }
                
                $CTM_HTML .= <<<HTML
                
			</article>
HTML;

		return $CTM_HTML;
	}
	/**
	 *	Invoices: View Invoice
	 *
	 *	@return	string	HTML String
	*/
	public function invoices_viewInvoice()
	{
		global $result_message, $view_invoice;
        
        switch($view_invoice['status'])
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
		
		$CTM_HTML = <<<HTML
            <script type="text/javascript">
            $(function()
            {
                $("#AccountLink").click(function()
                {
                    window.location = "{$this->acp_vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$view_invoice['account']}";
                });
                
                $("#openPaymentInfoDiv").click(function()
                {
                	$.fancybox($("#paymentInfoDiv").html());
                });
                
                $("#approveInvoice").click(function()
                {
                	if(invoiceStatus != 0 && invoiceStatus != 1)
                    {
                        $("#ResultCommand").html("<div class='error msg'>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Messages']['IsClosed']}</div>");
                    }
                    else
                    {
                        Sexy.prompt("{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['ApproveInvoice']['Messages']['Confirm']}", {}, { "input" : {$view_invoice['quantity']}, onComplete : function(number)
                        {
                            if(number)
                            {
                                if(number < 0)
                                    Sexy.alert("{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['ApproveInvoice']['Messages']['SetNumber']}");
                                else
                                    CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=financial&section=invoices&do=view&id={$view_invoice['id']}&cmd=approve&quantity="+number, "ResultCommand");
                            }
                        }});
                    }
                });
                
                $("#rejectInvoice").click(function()
                {
                	if(invoiceStatus != 0 && invoiceStatus != 1)
                    {
                        $("#ResultCommand").html("<div class='error msg'>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Messages']['IsClosed']}</div>");
                    }
                    else
                    {
                        Sexy.confirm("<strong>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['RejectInvoice']['Messages']['Confirm']}</strong>", {onComplete : function(confirm)
                        {
                            if(confirm)
                                CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=financial&section=invoices&do=view&id={$view_invoice['id']}&cmd=reject", "ResultCommand");
                        }});
                	}
                });
                
                $("#reopenInvoice").click(function()
                {
                	if(invoiceStatus == 0)
                    {
                        $("#ResultCommand").html("<div class='error msg'>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Messages']['IsOpened']}</div>");
                    }
                    else
                    {
                        Sexy.confirm("<strong>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['ReopenInvoice']['Messages']['Confirm']}</strong>", {onComplete : function(confirm)
                        {
                            if(confirm)
                                CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=financial&section=invoices&do=view&id={$view_invoice['id']}&cmd=reopen", "ResultCommand");
                        }});
                	}
                });
                
                $("#editInvoice").click(function()
                {
                	if(invoiceInEditing == false)
                    {
                    	invoiceInEditing = true;
                        var status = "";
                        
                        status = '<select name="Status" id="Status">\\n';
                        status += "<option value=\"0\""+(invoiceStatus == 0 ? " selected=\"selected\"" : "")+">{$this->lang->words['EWFinancial']['Invoices']['Status']['Pending']}</option>\\n";
                        status += "<option value=\"1\""+(invoiceStatus == 1 ? " selected=\"selected\"" : "")+">{$this->lang->words['EWFinancial']['Invoices']['Status']['InProgress']}</option>\\n";
                        status += "<option value=\"2\""+(invoiceStatus == 2 ? " selected=\"selected\"" : "")+">{$this->lang->words['EWFinancial']['Invoices']['Status']['Paid']}</option>\\n";
                        status += "<option value=\"3\""+(invoiceStatus == 3 ? " selected=\"selected\"" : "")+">{$this->lang->words['EWFinancial']['Invoices']['Status']['Rejected']}</option>\\n";
                        status += "<option value=\"4\""+(invoiceStatus == 4 ? " selected=\"selected\"" : "")+">{$this->lang->words['EWFinancial']['Invoices']['Status']['Canceled']}</option>\\n";
                        status += "</select>";
                        
                        
                        $("#invoiceQuantity").html('<input type="text" id="Quantity" name="Quantity" value="'+$("#invoiceQuantity").html()+'" size="15" onkeypress="return CTM.NumbersOnly(event);" />');
                        $("#invoiceValue").html('<input type="text" id="Value" name="Value" value="'+$("#invoiceValue").html()+'" size="15" />');
                        $("#invoiceStatus").html(status);
                        $("#editInvoiceButton").slideDown(341);
                        
                        CTM.Scroll("invoiceBody");
                	}
                });
HTML;

		if(DELETE_INVOICE_ACCESS == TRUE)
		{
			$CTM_HTML .= <<<HTML
                
                $("#deleteInvoice").click(function()
                {
                    Sexy.confirm("<strong>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['DeleteInvoice']['Messages']['Confirm']}</strong>", {onComplete : function(confirm)
                    {
                        if(confirm)
                            CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=financial&section=invoices&do=view&id={$view_invoice['id']}&cmd=delete", "ResultCommand");
                    }});
                });
HTML;
		}
            
		$CTM_HTML .= <<<HTML
            
            });
            
            function approveThisInvoice(quantity, account)
            {
                $("#invoiceStatus").html("<span style='color: green;'>{$this->lang->words['EWFinancial']['Invoices']['Status']['Paid']}</span>");
                $("#ResultCommand").html("<div class='success msg'>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['ApproveInvoice']['Messages']['Success']}</div>".replace("#QUANTITY#", quantity).replace("#ACCOUNT#", account));
                $("#reopenInvoice").slideDown(341);
                
                invoiceStatus = 2;
            }
            
            function rejectThisInvoice()
            {
                $("#invoiceStatus").html("<span style='color: red;'>{$this->lang->words['EWFinancial']['Invoices']['Status']['Rejected']}</span>");
                $("#ResultCommand").html("<div class='success msg'>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['RejectInvoice']['Messages']['Success']}</div>");
                $("#reopenInvoice").slideDown(341);
                
                invoiceStatus = 3;
            }
            
            function reopenThisInvoice()
            {
                $("#invoiceStatus").html("<span style='color: #C00;'>{$this->lang->words['EWFinancial']['Invoices']['Status']['Pending']}</span>");
                $("#ResultCommand").html("<div class='success msg'>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['ReopenInvoice']['Messages']['Success']}</div>");
                $("#reopenInvoice").slideUp(341);
                
                invoiceStatus = 0;
            }
HTML;

		if(EDIT_INVOICE_ACCESS == TRUE)
        {
        	$CTM_HTML .= <<<HTML
            		
            function completeEditInvoice(newQuantity, newValue, newStatus, newStatusNumber)
            {
                $("#invoiceQuantity").html(newQuantity);
                $("#invoiceValue").html(newValue);
                $("#invoiceStatus").html(newStatus);
                $("#editInvoiceButton").slideUp(341);
                
                invoiceStatus = newStatusNumber;
                
                if(newStatusNumber != 0)
                {
                	if($("#reopenInvoice").is(":visible") == false)
                		$("#reopenInvoice").slideDown(341);
                }    
                else
                {
                	if($("#reopenInvoice").is(":visible") == true)
                		$("#reopenInvoice").slideUp(341);
            	}
                
                invoiceInEditing = false;
            }
            
            function sendEditInvoiceCommand()
            {
                CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=financial&section=invoices&do=view&id={$view_invoice['id']}&cmd=edit", "ResultCommand", "invoiceEdit");
            }
HTML;
		}
            
		$CTM_HTML .= <<<HTML
        
            var invoiceStatus = {$view_invoice['status']};
            var invoiceInEditing = false;
            </script>

HTML;
		if($view_invoice['method_key'] == "bank")
        {
        	$CTM_HTML .= <<<HTML
            
            <div id="paymentInfoDiv" style="display:none;">
            	<div style="width:600px">
                    <table width="100%" border="0" class="gtable">
                        <thead>
                            <tr>
                                <th>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['BankPayment']['Title']['Infos']}</th>
                                <th></th>
                            </tr>
                        </thead>        
                        <tbody>
                            <tr> 
                                <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['BankPayment']['Method']}</td>
                                <td>{$view_invoice['bank_payment']['method']}</td>          
                            </tr>
                            <tr> 
                                <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['BankPayment']['SendDate']}</td>
                                <td>{$view_invoice['bank_payment']['confirm_date']}</td>          
                            </tr>
                            <tr> 
                                <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['BankPayment']['Status']}</td>
                                <td>{$view_invoice['bank_payment']['status']}</td>          
                            </tr>
HTML;
		
        	if($view_invoice['bank_payment']['annex'])
        	{
        		$CTM_HTML .= <<<HTML
            
                            <tr> 
                                <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['BankPayment']['Annex']}</td>
                                <td>{$view_invoice['bank_payment']['annex']}</td>          
                            </tr>
HTML;
			}
        
        	$CTM_HTML .= <<<HTML
        
                        </tbody>
                    </table>
                    <table width="100%" border="0" class="gtable">
                        <thead>
                            <tr>
                                <th>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['BankPayment']['Title']['BuyData']}</th>
                                <th></th>
                            </tr>
                        </thead>        
                        <tbody>
                            <tr> 
                                <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['BankPayment']['Date']}</td>
                                <td>{$view_invoice['bank_payment']['date']}</td>          
                            </tr>
                            <tr> 
                                <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['BankPayment']['Hour']}</td>
                                <td>{$view_invoice['bank_payment']['hour']}</td>          
                            </tr>
                            <tr> 
                                <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['BankPayment']['Local']}</td>
                                <td>{$view_invoice['bank_payment']['local']}</td>          
                            </tr>
                        </tbody>
                    </table>
                    <table width="100%" border="0" class="gtable">
                        <thead>
                            <tr>
                                <th>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['BankPayment']['Title']['PaymentData']}</th>
                                <th></th>
                            </tr>
                        </thead>        
                        <tbody>
HTML;
		
        	if(count($view_invoice['bank_payment']['payment_data']) > 0)
        	{
        		foreach($view_invoice['bank_payment']['payment_data'] as $key => $value)
            	{
        			$CTM_HTML .= <<<HTML
            
                            <tr> 
                                <td>{$key}</td>
                                <td>{$value}</td>          
                            </tr>
HTML;
			}
		}
        
        	$CTM_HTML .= <<<HTML
        
                        </tbody>
                    </table>
                </div>
            </div>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        
			<article>
				<h1>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Title']} #{$view_invoice['id']}</h1>
                <div id="ResultCommand"></div>
HTML;

		if(EDIT_INVOICE_ACCESS == TRUE)
        {
        	$CTM_HTML .= <<<HTML
            
            			<form name="invoiceEdit" id="invoiceEdit" class="uniform">
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        
                        <table width="100%" border="0" class="gtable">
                            <thead>
                                <th id="invoiceBody">{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Table']['InvoiceInfos']}</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Table']['Document']}</td>
                                    <td>{$view_invoice['document']}</td>
                                </tr>
                                <tr>
                                    <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Table']['StartDate']}</td>
                                    <td>{$view_invoice['start_date']}</td>
                                </tr>
                                <tr>
                                    <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Table']['Quantity']}</td>
                                    <td id="invoiceQuantity">{$view_invoice['quantity']}</td>
                                </tr>
                                <tr>
                                    <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Table']['Value']}</td>
                                    <td id="invoiceValue">{$view_invoice['value']}</td>
                                </tr>
                                <tr>
                                    <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Table']['Account']}</td>
                                    <td><a href="javascript: void(0);" id="AccountLink">{$view_invoice['account']}</a></td>
                                </tr>
                                <tr>
                                    <td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Table']['Status']}</td>
                                    <td id="invoiceStatus">{$status}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div id="editInvoiceButton" style="display:none">
                        	<br />
                        	<button type="button" onclick="sendEditInvoiceCommand();" class="button">{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['EditInvoice']['Button']}</button>
                            <br /><br />
                        </div>
HTML;

		if($view_invoice['payment_method'])
        {
			$CTM_HTML .= <<<HTML
            
                        <table width="100%" border="0" class="gtable">
                            <thead>
                                <th>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Table']['Payment']}</th>
                                <th></th>
                            </thead>
                            <tbody>
                            	<tr>
                                	<td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['PaymentMethod']['Method']}</td>
                                	<td>{$view_invoice['payment_method']['method']}</td>
                                </tr>
HTML;
			if($view_invoice['payment_method']['key'] == "bank")
            {
            	$CTM_HTML .= <<<HTML
                
                                <tr>
                                	<td>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['PaymentMethod']['Bank']['Title']}</td>
                                	<td><a href="javascript: void();" id="openPaymentInfoDiv">[ {$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['PaymentMethod']['Bank']['Value']} ]</a></td>
                                </tr>
HTML;
			}
            
            if(count($view_invoice['payment_method']['data']) > 0)
            {
            	foreach($view_invoice['payment_method']['data'] as $key => $value)
                {
            		$CTM_HTML .= <<<HTML
                
                                <tr>
                                	<td>{$key}</td>
                                	<td>{$value}</td>
                                </tr>
HTML;
				}
			}
            
            $CTM_HTML .= <<<HTML
            
                            </tbody>
                        </table>
HTML;

		}

		if(EDIT_INVOICE_ACCESS == TRUE)
        {
        	$CTM_HTML .= <<<HTML
            
            			</form>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        
                        <table width="100%" border="0" class="gtable">
                            <thead>
                                <th>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Manage']['Title']}</th>
                            </thead>
                        </table>
                        <form name="invoiceOptions" id="invoiceOptions" class="uniform">
                        	<fieldset>
                        		<legend>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Manage']['Options']}</legend>
                        		<section>
									<button type="button" id="approveInvoice" class="button green">{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Manage']['Approve']}</button>
									<button type="button" id="rejectInvoice" class="button red">{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Manage']['Reject']}</button>
									<button type="button" id="reopenInvoice" class="button orange"
HTML;
		if($view_invoice['status'] == 0)
        {
        	$CTM_HTML .= <<<HTML
style="display:none"
HTML;
		}
        
        $CTM_HTML .= <<<HTML
>{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Manage']['Reopen']}</button>
HTML;
		if(EDIT_INVOICE_ACCESS == TRUE)
        {
        	$CTM_HTML .= <<<HTML
            
									<button type="button" id="editInvoice" class="button white">{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Manage']['EditInvoice']}</button>
HTML;
		}

		if(DELETE_INVOICE_ACCESS == TRUE)
        {
        	$CTM_HTML .= <<<HTML
            
                            		<button type="button" id="deleteInvoice" class="button black">{$this->lang->words['EWFinancial']['Invoices']['ViewInvoice']['Manage']['DeleteInvoice']}</button>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
								</section>
                    		</fieldset>
                        </form>
			</article>
HTML;

		return $CTM_HTML;
	}
}

$callSkinCache = new CTM_ACPSkin_Financial();
$callSkinCache->registry();