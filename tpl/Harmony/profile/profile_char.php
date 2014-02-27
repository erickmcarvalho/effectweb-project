	<div class="box-content">
        <div class="header"><span>{$char_name}</span></div>
        <if syntax="$char_profile == 'CHAR_NOT_FOUND'">
        <div class="error-box">{$this->lang->words['Profile']['CharProfile']['Messages']['NotFound']}</div>
        <else />
        <if syntax="$char_profile == 'PROFILE_DISABLED'">
        <div class="error-box">{$this->lang->words['Profile']['CharProfile']['Messages']['ProfileDisabled']}</div>
        <else />
        <table width="100%" border="0">
        	<tr>
            	<td>
                	<br />
                    <div align="center">
                        <img src="{$this->functions->GetCharImage($char_profile[COLUMN_CHARIMAGE])}" width="120" height="120" style="border: 1px solid #B3B3B3;" class="image" />
                    </div>
                    <if syntax="$profile_settings['ShowSkills'] == true">
                    <div class="description">
                        <ul style="width:240px">
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Strength']}</strong> 
                                <span class="green">{$char_profile['Strength']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Dexterity']}</strong> 
                                <span class="green">{$char_profile['Dexterity']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Vitality']}</strong> 
                                <span class="green">{$char_profile['Vitality']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Energy']}</strong> 
                                <span class="green">{$char_profile['Energy']}</span>
                            </li>
                            <if syntax="$this->functions->ClassIsLord($char_profile['Name']) == true">
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Command']}</strong> 
                                <span class="green">{$char_profile[COLUMN_COMMAND]}</span>
                            </li>
                            </if>
                        </ul>
                    </div>
                    </if>
                </td>
                <td>
                	<div class="description" style="float:right">
                        <ul style="width:340px">
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Level']}</strong> 
                                <span>{$char_profile['cLevel']}</span>
                            </li>
                            <if syntax="MUSERVER_VERSION >= 5">
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['MasterLevel']}</strong> 
                                <span>{$char_masterlevel}</span>
                            </li>
                            </if>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Class']}</strong> 
                                <span>{$this->functions->ClassInfo($char_profile['Class'])}</span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Guild']}</strong> 
                                <span><a href="javascript: void(0);" onclick="CTM.Load('?/guild/{$char_guild['name']}', 'content');">{$char_guild['name']} <img src="{$char_guild['image']}" width="15" height="15" /></a></span>
                            </li>
                            <if syntax="$profile_settings['ShowMap'] == true">
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Map']}</strong> 
                                <span>{$this->functions->MapInfo($char_profile['MapNumber'])}</span>
                            </li>
                            </if>
                            <if syntax="$profile_settings['ShowStatus'] == true">
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Server']}</strong> 
                                <span>{$char_status['server']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Status']}</strong> 
                                <span>{$char_status['status']}</span>
                            </li>
                            </if>
                        </ul>
                    </div>
            	</td>
        	</tr>
        </table>
        <div style="clear:both"></div>
        <if syntax="$profile_settings['ShowResets'] == true">
		<div class="description">
			<ul style="width:240px">
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['ResetsGeneral']}</strong> 
                    <span class="red">{$char_profile[COLUMN_RESET]}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['ResetsDaily']}</strong> 
                    <span class="red">{$char_profile[COLUMN_RDAILY]}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['ResetsWeekly']}</strong> 
                    <span class="red">{$char_profile[COLUMN_RWEEKLY]}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['ResetsMonthly']}</strong> 
                    <span class="red">{$char_profile[COLUMN_RMONTHLY]}</span>
                </li>
			</ul>
    	</div>
        <div class="description" style="float: right">
			<ul style="width:340px">
            	<li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['MResetsGeneral']}</strong> 
                    <span class="red">{$char_profile[COLUMN_MRESET]}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['MResetsDaily']}</strong> 
                    <span class="red">{$char_profile[COLUMN_MRDAILY]}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['MResetsWeekly']}</strong> 
                    <span class="red">{$char_profile[COLUMN_MRWEEKLY]}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['MResetsMonthly']}</strong> 
                    <span class="red">{$char_profile[COLUMN_MRMONTHLY]}</span>
                </li>
        	</ul>
        </div>
        </if>
        </if>
        </if>
    </div>
        	