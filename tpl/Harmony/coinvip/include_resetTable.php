<if syntax="$this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] < 4">
        <table width="100%" border="0" align="center" cellpadding="7" class="tableBackColumn" style="text-align:center;">
        	<thead>
            	<tr width="100%">
                	<th>#</th>
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
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['LevelReset']}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['level_reset'][0]}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['level_reset'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['resetTable']['level_reset'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['resetTable']['level_reset'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['resetTable']['level_reset'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['resetTable']['level_reset'][5]}</td>
                    </if>
                </tr>
                <tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['MoneyReset']}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['money_require'][0]}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['money_require'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['resetTable']['money_require'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['resetTable']['money_require'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['resetTable']['money_require'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['resetTable']['money_require'][5]}</td>
                    </if>
                </tr>
                <tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['LevelAfter']}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['level_after'][0]}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['level_after'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['resetTable']['level_after'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['resetTable']['level_after'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['resetTable']['level_after'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['resetTable']['level_after'][5]}</td>
                    </if>
                </tr>
                <if syntax="$this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] > 0">
                <tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['SetPoints']}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['set_points'][0]}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['set_points'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['resetTable']['set_points'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['resetTable']['set_points'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['resetTable']['set_points'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['resetTable']['set_points'][5]}</td>
                    </if>
                </tr>
                </if>
                <tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['ClearInvent']}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_invent'][0]}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_invent'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_invent'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_invent'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_invent'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_invent'][5]}</td>
                    </if>
                </tr>
                <tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['ClearSkill']}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_skill'][0]}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_skill'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_skill'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_skill'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_skill'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_skill'][5]}</td>
                    </if>
                </tr>
                <tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['ClearQuest']}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_quest'][0]}</td>
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_quest'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_quest'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_quest'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_quest'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['resetTable']['clear_quest'][5]}</td>
                    </if>
                </tr>
			</tbody>
		</table>
        <else />
        <foreach loop="$coinvip['vip_advantages']['resetTable'] as $key => $table">
        <h4>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['Table']} {$key}</h4>
        <table width="100%" border="0" align="center" cellpadding="7" class="tableBackColumn" style="text-align:center;">
        	<thead>
            	<tr width="100%">
                	<th>#</th>
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
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['LevelReset']}</td>
                    <td>{$table['level_reset'][0]}</td>
                    <td>{$table['level_reset'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$table['level_reset'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$table['level_reset'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$table['level_reset'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$table['level_reset'][5]}</td>
                    </if>
                </tr>
                <tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['MoneyReset']}</td>
                    <td>{$table['money_require'][0]}</td>
                    <td>{$table['money_require'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$table['money_require'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$table['money_require'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$table['money_require'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$table['money_require'][5]}</td>
                    </if>
                </tr>
                <tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['LevelAfter']}</td>
                    <td>{$table['level_after'][0]}</td>
                    <td>{$table['level_after'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$table['level_after'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$table['level_after'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$table['level_after'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$table['level_after'][5]}</td>
                    </if>
                </tr>
                <if syntax="$this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] > 0">
                <tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['SetPoints']}</td>
                    <td>{$table['set_points'][0]}</td>
                    <td>{$table['set_points'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$table['set_points'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$table['set_points'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$table['set_points'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$table['set_points'][5]}</td>
                    </if>
                </tr>
                </if>
                <tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['ClearInvent']}</td>
                    <td>{$table['clear_invent'][0]}</td>
                    <td>{$table['clear_invent'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$table['clear_invent'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$table['clear_invent'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$table['clear_invent'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$table['clear_invent'][5]}</td>
                    </if>
                </tr>
                <tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['ClearSkill']}</td>
                    <td>{$table['clear_skill'][0]}</td>
                    <td>{$table['clear_skill'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$table['clear_skill'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$table['clear_skill'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$table['clear_skill'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$table['clear_skill'][5]}</td>
                    </if>
                </tr>
                <tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['ResetTable']['ClearQuest']}</td>
                    <td>{$table['clear_quest'][0]}</td>
                    <td>{$table['clear_quest'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$table['clear_quest'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$table['clear_quest'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$table['clear_quest'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$table['clear_quest'][5]}</td>
                    </if>
                </tr>
			</tbody>
		</table>
        </foreach>
        </if>