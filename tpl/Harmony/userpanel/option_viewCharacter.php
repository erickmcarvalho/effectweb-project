    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['ViewCharacter']['Title']}</span></div>
        <table width="100%" border="0">
			<tr>
            	<td width="122"><img src="{$userpanel['view_char']['image']}" width="120" height="120" style="border: 1px solid #B3B3B3;" class="image" /></td>
                <td>
                    <table width="100%" border="0" align="center" cellpadding="7" class="tableBackColumn">
                        <tr>
                            <td width="50%"><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['Class']}</em></td>
                            <td width="50%">{$userpanel['view_char']['class_name']}</td>
                        </tr>
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['Level']}</em></td>
                            <td>{$userpanel['view_char']['level']}</td>
                        </tr>
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['Experience']}</em></td>
                            <td>{$userpanel['view_char']['experience']}</td>
                        </tr>
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['Points']}</em></td>
                            <td>{$userpanel['view_char']['points']}</td>
                        </tr>
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['Resets']}</em></td>
                            <td>{$userpanel['view_char']['resets']}</td>
                        </tr>
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['MasterResets']}</em></td>
                            <td>{$userpanel['view_char']['master_resets']}</td>
                        </tr>
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['Strength']}</em></td>
                            <td>{$userpanel['view_char']['strength']}</td>
                        </tr>
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['Dexterity']}</em></td>
                            <td>{$userpanel['view_char']['dexterity']}</td>
                        </tr>
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['Vitality']}</em></td>
                            <td>{$userpanel['view_char']['vitality']}</td>
                        </tr>
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['Energy']}</em></td>
                            <td>{$userpanel['view_char']['energy']}</td>
                        </tr>
                        <if syntax="$userpanel['view_char']['class_is_lord'] == true">
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['Command']}</em></td>
                            <td>{$userpanel['view_char']['command']}</td>
                        </tr>
                        </if>
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['MapName']}</em></td>
                            <td>{$userpanel['view_char']['map_name']}</td>
                        </tr>
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['MapPosX']}</em></td>
                            <td>{$userpanel['view_char']['map_posx']}</td>
                        </tr>
                        <tr>
                            <td><em>{$this->lang->words['UserPanel']['ViewCharacter']['Infos']['MapPosY']}</em></td>
                            <td>{$userpanel['view_char']['map_posy']}</td>
                        </tr>
                    </table>
        		</td>
        	</tr>
		</table>
		<input type="button" value="{$this->lang->words['UserPanel']['ViewCharacter']['Buttons']['Inventory']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=viewCharacter&amp;do=inventory','loadOption');" class="btn" style="float:left" />
    </div>
    <div id="loadOption"></div>