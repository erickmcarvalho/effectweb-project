	<div class="box-content">
  <div class="header"><span>{$this->lang->words['UserPanel']['ConvertCoin']['Title']}</span></div>
        <form name="ConvertCoin" id="ConvertCoin" class="frm" style="float:left">
        	<label>{$this->lang->words['UserPanel']['ConvertCoin']['Select']}</label>
			<select name="ConvertOption" id="ConvertOption">
				<option value="" disabled="disabled" selected="selected">{$this->lang->words['Words']['Select']}</option>
				<optgroup label="{$this->lang->words['UserPanel']['ConvertCoin']['Options'][1]}">
					<foreach loop="$this->settings['USERPANEL']['FINANCIAL']['CONVERT_COIN']['OPTIONS']['2_TO_1'] as $key => $value">
					<option value="0#{$key}">{$value} {const="COIN_NAME_2"} => {$key} {const="COIN_NAME_1"}</option>
					</foreach>
				</optgroup>
				<if syntax="COIN_NUMBER == 3">
				<optgroup label="{$this->lang->words['UserPanel']['ConvertCoin']['Options'][2]}">
					<foreach loop="$this->settings['USERPANEL']['FINANCIAL']['CONVERT_COIN']['OPTIONS']['3_TO_1'] as $key => $value">
					<option value="1#{$key}">{$value} {const="COIN_NAME_3"} => {$key} {const="COIN_NAME_1"}</option>
					</foreach>
				</optgroup>
				<optgroup label="{$this->lang->words['UserPanel']['ConvertCoin']['Options'][3]}">
					<foreach loop="$this->settings['USERPANEL']['FINANCIAL']['CONVERT_COIN']['OPTIONS']['3_TO_2'] as $key => $value">
					<option value="2#{$key}">{$value} {const="COIN_NAME_3"} => {$key} {const="COIN_NAME_2"}</option>
					</foreach>
				</optgroup>
				</if>
			</select>
			<br />
			<input type="button" class="btn" value="{$this->lang->words['UserPanel']['ConvertCoin']['Button']}" onClick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=convertCoin&amp;write=true', 'Command', 'ConvertCoin');">
		</form>
        <div class="description">
        	<ul style="width:200px">
                <li>
                	<strong>{$this->lang->words['UserPanel']['ConvertCoin']['Balance_Coin'][1]}</strong>
                    <span class="green" id="Balance_1">{$userpanel['convertcoin']['balance_coin'][1]}</span>
                </li>
                <li>
                	<strong>{$this->lang->words['UserPanel']['ConvertCoin']['Balance_Coin'][2]}</strong>
                    <span class="green" id="Balance_2">{$userpanel['convertcoin']['balance_coin'][2]}</span>
                </li>
                <if syntax="COIN_NUMBER == 3">
                <li>
                	<strong>{$this->lang->words['UserPanel']['ConvertCoin']['Balance_Coin'][3]}</strong>
                    <span class="green" id="Balance_3">{$userpanel['convertcoin']['balance_coin'][3]}</span>
                </li>
                </if>
			</ul>
		</div>
	</div>
    <div id="Command"></div>