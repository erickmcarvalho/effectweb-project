	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['TransferResets']['Title']}</span></div>
        <if syntax="$this->settings['USERPANEL']['CHARACTER']['TRANSFER_RESETS']['RESET_CHAR'] == true">
		<p><strong>{$this->lang->words['UserPanel']['TransferResets']['ResetChar']}</strong></p>
		</if>
		<form name="Transfer_Resets" id="Transfer_Resets" class="frm" style="float:left">
			<label>{$this->lang->words['UserPanel']['TransferResets']['Character']}</label>
            <select name="charDestination" id="charDestination">
				<if syntax="count($userpanel['transfer_resets']['characters']) > 0">
				<foreach loop="$userpanel['transfer_resets']['characters'] as $name => $resets">
				<option value="{$name}">{$name} ({$resets} {$this->lang->words['UserPanel']['TransferResets']['Resets']})</option>
				</foreach>
				</if>
			</select>
            <label>{$this->lang->words['UserPanel']['TransferResets']['Number']}</label>
            <input type="text" name="numberResets" id="numberResets" onkeypress="return CTM.NumbersOnly(event);" size="6" value="{$this->settings['USERPANEL']['CHARACTER']['TRANSFER_RESETS']['MIN_SEND']}" />
            <br />
			<input type="button" class="btn" value="{$this->lang->words['UserPanel']['TransferResets']['Button']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=transferResets&amp;write=true', 'Command', 'Transfer_Resets');">
		</form>
        <div class="description">
			<ul style="width:300px">
				<li>
					<strong>&raquo; {$this->lang->words['UserPanel']['TransferResets']['ResetsAvailable']}</strong> 
					<span class="blue">{$userpanel['transfer_resets']['resets_available']}</span>
				</li>
				<li>
					<strong>&raquo; {$this->lang->words['UserPanel']['TransferResets']['Require']}</strong> 
					<span class="blue">{$this->settings['USERPANEL']['CHARACTER']['TRANSFER_RESETS']['REQUIRE_RESETS']}</span>
				</li>
				<li>
					<strong>&raquo; {$this->lang->words['UserPanel']['TransferResets']['MinSend']}</strong> 
					<span class="blue">{$this->settings['USERPANEL']['CHARACTER']['TRANSFER_RESETS']['MIN_SEND']}</span>
				</li>
				<if syntax="$this->settings['USERPANEL']['CHARACTER']['TRANSFER_RESETS']['MAX_SEND'] > 0">
				<li>
					<strong>&raquo; {$this->lang->words['UserPanel']['TransferResets']['MaxSend']}</strong> 
					<span class="blue">{$this->settings['USERPANEL']['CHARACTER']['TRANSFER_RESETS']['MAX_SEND']}</span>
				</li>
				</if>
			</ul>
		</div>
	</div>
	<div id="Command"></div>