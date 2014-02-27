	<div class="box-content" style="width: 700px">
    	<div class="header"><span>{$this->lang->words['UserPanel']['Payments']['ShowPayment']['Title']}</span></div>
        
        <h3>{$this->lang->words['UserPanel']['Payments']['ShowPayment']['PaymentInfos']['Title']}</h3>
        <table width="100%" border="0" class="tableBackColumn">
			<tr>
				<td>{$this->lang->words['UserPanel']['Payments']['ShowPayment']['PaymentInfos']['Method']}</td>
				<td width="60%"><strong>{$userpanel['payments']['show_payment']['method']}</strong></td>
			</tr>
			<tr>
				<td>{$this->lang->words['UserPanel']['Payments']['ShowPayment']['PaymentInfos']['SendDate']}</td>
				<td>{$userpanel['payments']['show_payment']['confirm_date']}</td>
			</tr>
			<tr>
				<td>{$this->lang->words['UserPanel']['Payments']['ShowPayment']['PaymentInfos']['Status']}</td>
				<td>{$userpanel['payments']['show_payment']['status']}</td>
			</tr>
			<if syntax="$userpanel['payments']['show_payment']['annex']">
			<tr>
				<td>{$this->lang->words['UserPanel']['Payments']['ShowPayment']['PaymentInfos']['Annex']}</td>
				<td><a href="{$userpanel['payments']['show_payment']['annex']['link']}" target="_blank">[ {$userpanel['payments']['show_payment']['annex']['name']} ]</a></td>
			</tr>
			</if>
		</table>
        
        <h3>{$this->lang->words['UserPanel']['Payments']['ShowPayment']['BuyData']['Title']}</h3>
        <table width="100%" border="0" class="tableBackColumn">
			<tr>
				<td>{$this->lang->words['UserPanel']['Payments']['ShowPayment']['BuyData']['Date']}</td>
				<td width="60%">{$userpanel['payments']['show_payment']['date']}</td>
			</tr>
			<tr>
				<td>{$this->lang->words['UserPanel']['Payments']['ShowPayment']['BuyData']['Hour']}</td>
				<td>{$userpanel['payments']['show_payment']['hour']}</td>
			</tr>
			<tr>
				<td>{$this->lang->words['UserPanel']['Payments']['ShowPayment']['BuyData']['Local']}</td>
				<td>{$userpanel['payments']['show_payment']['local']}</td>
			</tr>
		</table>
        
        <h3>{$this->lang->words['UserPanel']['Payments']['ShowPayment']['PaymentData']}</h3>
        <table width="100%" border="0" class="tableBackColumn">
			<if syntax="count($userpanel['payments']['show_payment']['payment_data']) > 0">
            <foreach loop="$userpanel['payments']['show_payment']['payment_data'] as $key => $value">
			<tr>
				<td>{$key}</td>
				<td width="60%">{$value}</td>
			</tr>
			</foreach>
            </if>
		</table>
        
        <h3>{$this->lang->words['UserPanel']['Payments']['ShowPayment']['Message']}</h3>
        <div class="blockquote">{$userpanel['payments']['show_payment']['message']}</div>
	</div>