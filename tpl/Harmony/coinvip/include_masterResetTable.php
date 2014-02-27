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
            	<if syntax="$this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MODE'] < 3">
            	<tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['ResetsRequire']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['resets_require'][0]}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['resets_require'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['resets_require'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['resets_require'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['resets_require'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['resets_require'][5]}</td>
                    </if>
                </tr>
                </if>
            	<tr>
                	<td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['LevelReset']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['level_reset'][0]}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['level_reset'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['level_reset'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['level_reset'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['level_reset'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['level_reset'][5]}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['StrengthRequire']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['strength_require']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['strength_require']}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['strength_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['strength_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['strength_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['strength_require']}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['DexterityRequire']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['dexterity_require']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['dexterity_require']}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['dexterity_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['dexterity_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['dexterity_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['dexterity_require']}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['VitalityRequire']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['vitality_require']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['vitality_require']}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['vitality_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['vitality_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['vitality_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['vitality_require']}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['EnergyRequire']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['energy_require']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['energy_require']}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['energy_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['energy_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['energy_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['energy_require']}</td>
                    </if>
                </tr>
                <if syntax="MUSERVER_VERSION >= 1">
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['CommandRequire']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['command_require']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['command_require']}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['command_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['command_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['command_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['command_require']}</td>
                    </if>
                </tr>
                </if>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['MoneyReset']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['money_require'][0]}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['money_require'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['money_require'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['money_require'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['money_require'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['money_require'][5]}</td>
                    </if>
                </tr>
                <if syntax="$this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MODE'] == 1">
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['ResetsRemove']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['resets_remove'][0]}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['resets_remove'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['resets_remove'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['resets_remove'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['resets_remove'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['resets_remove'][5]}</td>
                    </if>
                </tr>
                </if>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['ResetPoints']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['reset_points'][0]}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['reset_points'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['reset_points'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['reset_points'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['reset_points'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['reset_points'][5]}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['ClearInvent']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_invent'][0]}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_invent'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_invent'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_invent'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_invent'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_invent'][5]}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['ClearSkill']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_skill'][0]}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_skill'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_skill'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_skill'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_skill'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_skill'][5]}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['ClearQuest']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_quest'][0]}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_quest'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_quest'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_quest'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_quest'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['clear_quest'][5]}</td>
                    </if>
                </tr>
                <tr>
                    <td style="color:#FF0000">{$this->lang->words['CoinVIP']['VIP_Advantages']['Advantages']['MResetTable']['CoinAward']}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['coin_award'][0]}</td>
                    <td>{$coinvip['vip_advantages']['masterResetTable']['coin_award'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['coin_award'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['coin_award'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['coin_award'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$coinvip['vip_advantages']['masterResetTable']['coin_award'][5]}</td>
                    </if>
                </tr>
            </tbody>
        </table>