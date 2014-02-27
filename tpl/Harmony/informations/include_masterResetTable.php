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
                    <td>{$this->lang->words['Infos']['MResetTable']['ResetsRequire']}</td>
                    <td>{$informations['masterResetTable']['resets_require'][0]}</td>
                    <td>{$informations['masterResetTable']['resets_require'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['resets_require'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['resets_require'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['resets_require'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['resets_require'][5]}</td>
                    </if>
                </tr>
                </if>
            	<tr>
                	<td>{$this->lang->words['Infos']['MResetTable']['LevelReset']}</td>
                    <td>{$informations['masterResetTable']['level_reset'][0]}</td>
                    <td>{$informations['masterResetTable']['level_reset'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['level_reset'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['level_reset'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['level_reset'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['level_reset'][5]}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['Infos']['MResetTable']['StrengthRequire']}</td>
                    <td>{$informations['masterResetTable']['strength_require']}</td>
                    <td>{$informations['masterResetTable']['strength_require']}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['strength_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['strength_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['strength_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['strength_require']}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['Infos']['MResetTable']['DexterityRequire']}</td>
                    <td>{$informations['masterResetTable']['dexterity_require']}</td>
                    <td>{$informations['masterResetTable']['dexterity_require']}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['dexterity_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['dexterity_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['dexterity_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['dexterity_require']}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['Infos']['MResetTable']['VitalityRequire']}</td>
                    <td>{$informations['masterResetTable']['vitality_require']}</td>
                    <td>{$informations['masterResetTable']['vitality_require']}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['vitality_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['vitality_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['vitality_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['vitality_require']}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['Infos']['MResetTable']['EnergyRequire']}</td>
                    <td>{$informations['masterResetTable']['energy_require']}</td>
                    <td>{$informations['masterResetTable']['energy_require']}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['energy_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['energy_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['energy_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['energy_require']}</td>
                    </if>
                </tr>
                <if syntax="MUSERVER_VERSION >= 1">
                <tr>
                    <td>{$this->lang->words['Infos']['MResetTable']['CommandRequire']}</td>
                    <td>{$informations['masterResetTable']['command_require']}</td>
                    <td>{$informations['masterResetTable']['command_require']}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['command_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['command_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['command_require']}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['command_require']}</td>
                    </if>
                </tr>
                </if>
                <tr>
                    <td>{$this->lang->words['Infos']['MResetTable']['MoneyReset']}</td>
                    <td>{$informations['masterResetTable']['money_require'][0]}</td>
                    <td>{$informations['masterResetTable']['money_require'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['money_require'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['money_require'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['money_require'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['money_require'][5]}</td>
                    </if>
                </tr>
                <if syntax="$this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MODE'] == 1">
                <tr>
                    <td>{$this->lang->words['Infos']['MResetTable']['ResetsRemove']}</td>
                    <td>{$informations['masterResetTable']['resets_remove'][0]}</td>
                    <td>{$informations['masterResetTable']['resets_remove'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['resets_remove'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['resets_remove'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['resets_remove'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['resets_remove'][5]}</td>
                    </if>
                </tr>
                </if>
                <tr>
                    <td>{$this->lang->words['Infos']['MResetTable']['ResetPoints']}</td>
                    <td>{$informations['masterResetTable']['reset_points'][0]}</td>
                    <td>{$informations['masterResetTable']['reset_points'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['reset_points'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['reset_points'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['reset_points'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['reset_points'][5]}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['Infos']['MResetTable']['ClearInvent']}</td>
                    <td>{$informations['masterResetTable']['clear_invent'][0]}</td>
                    <td>{$informations['masterResetTable']['clear_invent'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['clear_invent'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['clear_invent'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['clear_invent'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['clear_invent'][5]}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['Infos']['MResetTable']['ClearSkill']}</td>
                    <td>{$informations['masterResetTable']['clear_skill'][0]}</td>
                    <td>{$informations['masterResetTable']['clear_skill'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['clear_skill'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['clear_skill'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['clear_skill'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['clear_skill'][5]}</td>
                    </if>
                </tr>
                <tr>
                    <td>{$this->lang->words['Infos']['MResetTable']['ClearQuest']}</td>
                    <td>{$informations['masterResetTable']['clear_quest'][0]}</td>
                    <td>{$informations['masterResetTable']['clear_quest'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['clear_quest'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['clear_quest'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['clear_quest'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['clear_quest'][5]}</td>
                    </if>
                </tr>
                <tr>
                    <td style="color:#FF0000">{$this->lang->words['Infos']['MResetTable']['CoinAward']}</td>
                    <td>{$informations['masterResetTable']['coin_award'][0]}</td>
                    <td>{$informations['masterResetTable']['coin_award'][1]}</td>
                    <if syntax="VIP_NUMBER >= 2">
                    <td>{$informations['masterResetTable']['coin_award'][2]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 3">
                    <td>{$informations['masterResetTable']['coin_award'][3]}</td>
                    </if>
                    <if syntax="VIP_NUMBER >= 4">
                    <td>{$informations['masterResetTable']['coin_award'][4]}</td>
                    </if>
                    <if syntax="VIP_NUMBER == 5">
                    <td>{$informations['masterResetTable']['coin_award'][5]}</td>
                    </if>
                </tr>
            </tbody>
        </table>