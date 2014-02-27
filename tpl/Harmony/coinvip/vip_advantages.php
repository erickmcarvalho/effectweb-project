    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['CoinVIP']['VIP_Advantages']['Title']}</span></div>
    	<p>
        	{$this->lang->words['CoinVIP']['VIP_Advantages']['Text']}
		</p>
    </div>
    <div class="box-content">
        <div class="header"><span>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Title']}</span></div>
        <table width="100%" border="0" align="center" cellpadding="7" class="tableBackColumn" style="text-align:center;">
            <thead>
                <tr width="100%">
                    <th>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Service']}</th>
                    <th>{$this->lang->words['Words']['Free']}</th>
                    <th>{const="VIP_NAME_1"}</th>
                    <if syntax="VIP_NUMBER >= 2">
                    <th>{const="VIP_NAME_2"}</th>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <th>{const="VIP_NAME_3"}</th>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <th>{const="VIP_NAME_4"}</th>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <th>{const="VIP_NAME_5"}</th>
                    </if>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['ChangeData']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_DATA'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_DATA'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_DATA'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_DATA'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_DATA'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_DATA'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['ChangeMail']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_MAIL'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_MAIL'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_MAIL'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_MAIL'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_MAIL'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_MAIL'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['ChangePID']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_PID'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_PID'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_PID'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_PID'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_PID'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_PID'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['VirtualVault']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['VIRTUAL_VAULT'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['VIRTUAL_VAULT'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['VIRTUAL_VAULT'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['VIRTUAL_VAULT'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['VIRTUAL_VAULT'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['VIRTUAL_VAULT'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['DisconnectGame']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['DISCONNECT_GAME'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['DISCONNECT_GAME'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['DISCONNECT_GAME'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['DISCONNECT_GAME'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['DISCONNECT_GAME'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['DISCONNECT_GAME'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['ResetSystem']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['RESET_SYSTEM'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['RESET_SYSTEM'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['RESET_SYSTEM'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['RESET_SYSTEM'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['RESET_SYSTEM'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['RESET_SYSTEM'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['MasterReset']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MASTER_RESET'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MASTER_RESET'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MASTER_RESET'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MASTER_RESET'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MASTER_RESET'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MASTER_RESET'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['TransferResets']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['TRANSFER_RESETS'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['TRANSFER_RESETS'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['TRANSFER_RESETS'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['TRANSFER_RESETS'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['TRANSFER_RESETS'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['TRANSFER_RESETS'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['ClearPk']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CLEAR_PK'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CLEAR_PK'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CLEAR_PK'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CLEAR_PK'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CLEAR_PK'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CLEAR_PK'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['ChangeClass']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_CLASS'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_CLASS'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_CLASS'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_CLASS'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_CLASS'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_CLASS'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['ChangeName']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_NAME'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_NAME'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_NAME'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_NAME'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_NAME'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_NAME'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['MoveCharacter']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MOVE_CHARACTER'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MOVE_CHARACTER'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MOVE_CHARACTER'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MOVE_CHARACTER'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MOVE_CHARACTER'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MOVE_CHARACTER'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['ManageProfile']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MANAGE_PROFILE'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MANAGE_PROFILE'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MANAGE_PROFILE'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MANAGE_PROFILE'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MANAGE_PROFILE'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['MANAGE_PROFILE'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['ChangeAvatar']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_AVATAR'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_AVATAR'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_AVATAR'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_AVATAR'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_AVATAR'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['CHANGE_AVATAR'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['RepairPoints']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['REPAIR_POINTS'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['REPAIR_POINTS'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['REPAIR_POINTS'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['REPAIR_POINTS'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['REPAIR_POINTS'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['REPAIR_POINTS'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['RedistributePoints']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['REDISTRIBUTE_POINTS'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['REDISTRIBUTE_POINTS'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['REDISTRIBUTE_POINTS'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['REDISTRIBUTE_POINTS'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['REDISTRIBUTE_POINTS'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['REDISTRIBUTE_POINTS'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['Services']['DistributePoints']}</td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['DISTRIBUTE_POINTS'][0]}.png" style="border: none;" /></td>
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['DISTRIBUTE_POINTS'][1]}.png" style="border: none;" /></td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['DISTRIBUTE_POINTS'][2]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['DISTRIBUTE_POINTS'][3]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['DISTRIBUTE_POINTS'][4]}.png" style="border: none;" /></td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td><img src="{$this->vars['style_dirs']['images']}icons/{$coinvip['vip_advantages']['advantages']['DISTRIBUTE_POINTS'][5]}.png" style="border: none;" /></td>
                    </if>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="box-content">
        <div class="header"><span>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['Title']}</span></div>
        {template="include_resetTable"}
    </div>
    <div class="box-content">
        <div class="header"><span>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['Title']}</span></div>
        {template="include_masterResetTable"}
    </div>