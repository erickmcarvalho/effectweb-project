	<script type="text/javascript">
	$(function()
	{
		$("#open_bank_window").click(function()
		{
			$.facebox({ div: "#bank_window" });
		});
	});
	
	function confirm_bank_payment()
	{
		//$(document).trigger('close.facebox');
		$.fancybox(
		{
			ajax :
			{
				type : "GET",
			},
			href : "?app=core&module=userpanel&option=invoices&section=show&id={$userpanel['invoices']['show_invoice']['id']}&do=payment&ajaxLoadSet=true"
		});
		
		//$.facebox({ ajax: "?app=core&module=userpanel&option=invoices&section=show&id={$userpanel['invoices']['show_invoice']['id']}&do=payment&ajaxLoadSet=true" });
	}
	</script>
    <div id="bank_window" style="display: none">
    	<div class="box-content">
            <div class="header"><span>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['BankWindow']['Title']}</span></div>
            <p> 
                <strong>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['BankWindow']['Info'][1]}</strong><br />
                &raquo; {$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['BankWindow']['Info'][2]}<br /><br />
                <strong>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['BankWindow']['Info'][3]}</strong><br />
                &raquo; {$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['BankWindow']['Info'][4]}<br /><br />
            </p>
            <if syntax="count($this->settings['PAYMENTMETHOD']['BANK']) > 0">
            <foreach loop="$this->settings['PAYMENTMETHOD']['BANK'] as $_key => $trash">
            <div class="blockquote">
                <foreach loop="$this->settings['PAYMENTMETHOD']['BANK'][$_key] as $k => $_trash">
                <foreach loop="$this->settings['PAYMENTMETHOD']['BANK'][$_key][$k] as $key => $value">
                &raquo; <strong>{$key}</strong> {$value}<br />
                </foreach>
                </foreach>
            </div>
            </foreach>
            </if>
            <div align="center">
                <input type="button" value="{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['BankWindow']['Confirm']}" class="btn" onclick="confirm_bank_payment();" />
            </div>
        </div>
    </div>
    </if>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['Title']}</span></div>
        <br />
        
        <h4>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['InvoiceInfos']['Title']}</h4>
        <table width="100%" border="0" class="tableBackColumn">
			<tr>
				<td>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['InvoiceInfos']['Document']}</td>
				<td width="60%">{$userpanel['invoices']['show_invoice']['document']}</td>
			</tr>
            <tr>
				<td>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['InvoiceInfos']['StartDate']}</td>
				<td>{$userpanel['invoices']['show_invoice']['start_date']}</td>
			</tr>
            <tr>
				<td>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['InvoiceInfos']['Quantity']}</td>
				<td>{$userpanel['invoices']['show_invoice']['quantity']}</td>
			</tr>
            <tr>
				<td>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['InvoiceInfos']['Value']}</td>
				<td>{$userpanel['invoices']['show_invoice']['value']}</td>
			</tr>
			<tr>
				<td>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['InvoiceInfos']['Status']}</td>
				<td>{$userpanel['invoices']['show_invoice']['status']}</td>
			</tr>
		</table>
        
        <if syntax="$userpanel['invoices']['show_invoice']['payment_method']">
        <br />
        
        <h4>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['PaymentMethod']['Title']}</h4>
        <table width="100%" border="0" class="tableBackColumn">
			<tr>
				<td>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['PaymentMethod']['Method']}</td>
				<td width="60%">{$userpanel['invoices']['show_invoice']['payment_method']['method']}</td>
			</tr>
            <if syntax="$userpanel['invoices']['show_invoice']['payment_method']['key'] == 'bank'">
            <tr>
				<td>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['PaymentMethod']['Bank']['Title']}</td>
				<td width="60%"><a href="javascript: void();" onclick="confirm_bank_payment();">[ {$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['PaymentMethod']['Bank']['Value']} ]</a></td>
			</tr>
            <else />
			<if syntax="count($userpanel['invoices']['show_invoice']['payment_method']['data']) > 0">
            <foreach loop="$userpanel['invoices']['show_invoice']['payment_method']['data'] as $key => $value">
			<tr>
				<td>{$key}</td>
				<td>{$value}</td>
			</tr>
			</foreach>
            </if>
            </if>
		</table>
        <else />
        <if syntax="$userpanel['invoices']['show_invoice']['canceled'] == false">
        <br />
        
        <h4>{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['Pay']['Title']}</h4>
        <div align="center">
            <input type="button" value="{$this->lang->words['UserPanel']['Invoices']['ShowInvoice']['Pay']['Bank']}" id="open_bank_window" class="btn" />
		</div>
        </if>
        </if>
	</div>