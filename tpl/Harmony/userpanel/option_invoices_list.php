	<script type="text/javascript">
	$(function()
	{
		$('#invoice_tabs').tabs({ fx: { opacity: 'toggle' } });
	});
	<if syntax="$userpanel['invoices']['auto_load_invoice']">
	$(document).ready(function(e)
	{
		if(e) showInvoice("{$userpanel['invoices']['auto_load_invoice']}");
	});
	</if>
	function showInvoice(id)
	{
		CTM.AjaxLoad('?app=core&module=userpanel&option=invoices&section=show&id='+id, '*showInvoice');
	}
	</script>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Title']}</span></div>
        <br />
		<div id="invoice_tabs">
			<ul>
				<li><a href="#invoice_tabs-1">{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Tabs']['Opened']}</a></li>
				<li><a href="#invoice_tabs-2">{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Tabs']['Finalized']}</a></li>
                <li><a href="#invoice_tabs-3">{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Tabs']['Canceled']}</a></li>
			</ul>
			<div id="invoice_tabs-1">
            	<if syntax="count($userpanel['invoices']['list_invoices']['opened']) > 0">
                <table width="100%" border="0" class="tableBackColumn">
                    <thead>
                        <tr>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['ID']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['Quantity']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['Value']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['Date']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['Status']}</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <foreach loop="$userpanel['invoices']['list_invoices']['opened'] as $id => $invoice">
                        <tr onclick="showInvoice({$id});" style="cursor: pointer;">
                            <td>#{$invoice['document']}</td>
                            <td>{$invoice['quantity']}</td>
                            <td>{$invoice['value']}</td>
                            <td>{$invoice['date']}</td>
                            <td>{$invoice['status']}</td>
                        </tr>
                        </foreach>
                    </tbody>
                </table>
            	<else />
            	<div class="info-box">{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Messages']['NoOpened']}</div>
            	</if>
            </div>
            
			<div id="invoice_tabs-2">
            	<if syntax="count($userpanel['invoices']['list_invoices']['finalized']) > 0">
                <table width="100%" border="0" class="tableBackColumn">
                    <thead>
                        <tr>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['ID']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['Quantity']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['Value']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['Date']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['Status']}</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <foreach loop="$userpanel['invoices']['list_invoices']['finalized'] as $id => $invoice">
                        <tr onclick="showInvoice({$id});" style="cursor: pointer;">
                            <td>#{$invoice['document']}</td>
                            <td>{$invoice['quantity']}</td>
                            <td>{$invoice['value']}</td>
                            <td>{$invoice['date']}</td>
                            <td>{$invoice['status']}</td>
                        </tr>
                        </foreach>
                    </tbody>
                </table>
            	<else />
            	<div class="info-box">{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Messages']['NoFinalized']}</div>
            	</if>
            </div>
            
            <div id="invoice_tabs-3">
            	<if syntax="count($userpanel['invoices']['list_invoices']['canceled']) > 0">
                <table width="100%" border="0" class="tableBackColumn">
                    <thead>
                        <tr>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['ID']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['Quantity']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['Value']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['Date']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Table']['Status']}</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <foreach loop="$userpanel['invoices']['list_invoices']['canceled'] as $id => $invoice">
                        <tr onclick="showInvoice({$id});" style="cursor: pointer;">
                            <td>#{$invoice['document']}</td>
                            <td>{$invoice['quantity']}</td>
                            <td>{$invoice['value']}</td>
                            <td>{$invoice['date']}</td>
                            <td>{$invoice['status']}</td>
                        </tr>
                        </foreach>
                    </tbody>
                </table>
            	<else />
            	<div class="info-box">{$this->lang->words['UserPanel']['Invoices']['ListInvoices']['Messages']['NoCanceled']}</div>
            	</if>
            </div>
		</div>
	</div>
    <div id="showInvoice"></div>