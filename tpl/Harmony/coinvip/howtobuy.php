	<div class="box-content">
		<div class="header"><span>{$this->lang->words['CoinVIP']['HowToBuy']['Title']}</span></div>
		<p>
			<strong>{$this->lang->words['CoinVIP']['HowToBuy']['What']}</strong><br />
			&raquo; {$this->lang->words['CoinVIP']['HowToBuy']['What_R']}<br /><br />
            
			<strong>{$this->lang->words['CoinVIP']['HowToBuy']['Obtain']}</strong><br />
			&raquo; {$this->lang->words['CoinVIP']['HowToBuy']['Obtain_R']}<br /><br />
            
			<strong>{$this->lang->words['CoinVIP']['HowToBuy']['Buy']}</strong><br />
			&raquo; {$this->lang->words['CoinVIP']['HowToBuy']['Buy_R']}<br /><br />
            
			<strong>{$this->lang->words['CoinVIP']['HowToBuy']['Bank'][1]}</strong><br />
			&raquo; {$this->lang->words['CoinVIP']['HowToBuy']['Bank'][2]}<br /><br />
			<strong>{$this->lang->words['CoinVIP']['HowToBuy']['Bank'][3]}</strong><br />
			&raquo; {$this->lang->words['CoinVIP']['HowToBuy']['Bank'][4]}<br /><br />
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
            
		<p>
			<strong>{$this->lang->words['CoinVIP']['HowToBuy']['Confirm']}</strong><br />
			&raquo; {$this->lang->words['CoinVIP']['HowToBuy']['Confirm_R']}<br /><br />
			<strong>{$this->lang->words['CoinVIP']['HowToBuy']['Time']}</strong><br />
			&raquo; {$this->lang->words['CoinVIP']['HowToBuy']['Time_R']}<br /><br />
		</p>
	</div>