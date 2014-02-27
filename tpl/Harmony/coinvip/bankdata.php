	<div class="box-content">
		<div class="header"><span>{$this->lang->words['CoinVIP']['BankData']['Title']}</span></div>
		<p> 
			<strong>{$this->lang->words['CoinVIP']['BankData']['Info'][1]}</strong><br />
			&raquo; {$this->lang->words['CoinVIP']['BankData']['Info'][2]}<br /><br />
			<strong>{$this->lang->words['CoinVIP']['BankData']['Info'][3]}</strong><br />
			&raquo; {$this->lang->words['CoinVIP']['BankData']['Info'][4]}<br /><br />
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
	</div>