<?php
/***********************************************************/
/* Cetemaster Services, Limited                            */
/* Copyright (c) 2010-2013. All Rights Reserved,           */
/* www.cetemaster.com.br / www.cetemaster.com              */
/***********************************************************/
/* File generated by Cetemaster PHP Template Engine        */
/* Template: Harmony                                       */
/* DB file: skin_profile                                   */
/* DB generated in 20/10/2013 - 04:34h                     */
/***********************************************************/
/* This is a cache file generated by                       */
/* DO NOT EDIT DIRECTLY                                    */
/* The changes are not saved to the cache automatically    */
/***********************************************************/

/********** Begin: profile_char **********/
$CTM_TEMPLATE_DATABASE['profile_char'] = <<<HTML
	<div class="box-content">
        <div class="header"><span>{::x####$####x::char_name}</span></div>
        <if syntax="::x####$####x::char_profile == 'CHAR_NOT_FOUND'">
        <div class="error-box">{::x####$####x::this->lang->words['Profile']['CharProfile']['Messages']['NotFound']}</div>
        <else />
        <if syntax="::x####$####x::char_profile == 'PROFILE_DISABLED'">
        <div class="error-box">{::x####$####x::this->lang->words['Profile']['CharProfile']['Messages']['ProfileDisabled']}</div>
        <else />
        <table width="100%" border="0">
        	<tr>
            	<td>
                	<br />
                    <div align="center">
                        <img src="{::x####$####x::this->functions->GetCharImage(::x####$####x::char_profile[COLUMN_CHARIMAGE])}" width="120" height="120" style="border: 1px solid #B3B3B3;" class="image" />
                    </div>
                    <if syntax="::x####$####x::profile_settings['ShowSkills'] == true">
                    <div class="description">
                        <ul style="width:240px">
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['Strength']}</strong> 
                                <span class="green">{::x####$####x::char_profile['Strength']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['Dexterity']}</strong> 
                                <span class="green">{::x####$####x::char_profile['Dexterity']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['Vitality']}</strong> 
                                <span class="green">{::x####$####x::char_profile['Vitality']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['Energy']}</strong> 
                                <span class="green">{::x####$####x::char_profile['Energy']}</span>
                            </li>
                            <if syntax="::x####$####x::this->functions->ClassIsLord(::x####$####x::char_profile['Name']) == true">
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['Command']}</strong> 
                                <span class="green">{::x####$####x::char_profile[COLUMN_COMMAND]}</span>
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
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['Level']}</strong> 
                                <span>{::x####$####x::char_profile['cLevel']}</span>
                            </li>
                            <if syntax="MUSERVER_VERSION >= 5">
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['MasterLevel']}</strong> 
                                <span>{::x####$####x::char_masterlevel}</span>
                            </li>
                            </if>
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['Class']}</strong> 
                                <span>{::x####$####x::this->functions->ClassInfo(::x####$####x::char_profile['Class'])}</span>
                            </li>
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['Guild']}</strong> 
                                <span><a href="javascript: void(0);" onclick="CTM.Load('?/guild/{::x####$####x::char_guild['name']}', 'content');">{::x####$####x::char_guild['name']} <img src="{::x####$####x::char_guild['image']}" width="15" height="15" /></a></span>
                            </li>
                            <if syntax="::x####$####x::profile_settings['ShowMap'] == true">
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['Map']}</strong> 
                                <span>{::x####$####x::this->functions->MapInfo(::x####$####x::char_profile['MapNumber'])}</span>
                            </li>
                            </if>
                            <if syntax="::x####$####x::profile_settings['ShowStatus'] == true">
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['Server']}</strong> 
                                <span>{::x####$####x::char_status['server']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['Status']}</strong> 
                                <span>{::x####$####x::char_status['status']}</span>
                            </li>
                            </if>
                        </ul>
                    </div>
            	</td>
        	</tr>
        </table>
        <div style="clear:both"></div>
        <if syntax="::x####$####x::profile_settings['ShowResets'] == true">
		<div class="description">
			<ul style="width:240px">
                <li>
                	<strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['ResetsGeneral']}</strong> 
                    <span class="red">{::x####$####x::char_profile[COLUMN_RESET]}</span>
                </li>
                <li>
                	<strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['ResetsDaily']}</strong> 
                    <span class="red">{::x####$####x::char_profile[COLUMN_RDAILY]}</span>
                </li>
                <li>
                	<strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['ResetsWeekly']}</strong> 
                    <span class="red">{::x####$####x::char_profile[COLUMN_RWEEKLY]}</span>
                </li>
                <li>
                	<strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['ResetsMonthly']}</strong> 
                    <span class="red">{::x####$####x::char_profile[COLUMN_RMONTHLY]}</span>
                </li>
			</ul>
    	</div>
        <div class="description" style="float: right">
			<ul style="width:340px">
            	<li>
                	<strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['MResetsGeneral']}</strong> 
                    <span class="red">{::x####$####x::char_profile[COLUMN_MRESET]}</span>
                </li>
                <li>
                	<strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['MResetsDaily']}</strong> 
                    <span class="red">{::x####$####x::char_profile[COLUMN_MRDAILY]}</span>
                </li>
                <li>
                	<strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['MResetsWeekly']}</strong> 
                    <span class="red">{::x####$####x::char_profile[COLUMN_MRWEEKLY]}</span>
                </li>
                <li>
                	<strong>&raquo; {::x####$####x::this->lang->words['Profile']['CharProfile']['MResetsMonthly']}</strong> 
                    <span class="red">{::x####$####x::char_profile[COLUMN_MRMONTHLY]}</span>
                </li>
        	</ul>
        </div>
        </if>
        </if>
        </if>
    </div>
        	
HTML;
/********** End: profile_char **********/

/********** Begin: profile_guild **********/
$CTM_TEMPLATE_DATABASE['profile_guild'] = <<<HTML
	<div class="box-content">
        <div class="header"><span>{::x####$####x::guild_name}</span></div>
        <if syntax="::x####$####x::guild_profile == 'GUILD_NOT_FOUND'">
        <div class="error-box">{::x####$####x::this->lang->words['Profile']['GuildProfile']['Messages']['NotFound']}</div>
        <else />
        <table width="100%" border="0">
        	<tr>
            	<td>
                	<br />
                    <div align="center">
                        <img src="{::x####$####x::guild_profile['image']}" width="120" height="120" style="border: 1px solid #B3B3B3;" class="image" />
                    </div>
                </td>
                <td>
                	<div class="description">
                        <ul style="width:240px">
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['GuildProfile']['GuildMaster']}</strong> 
                                <span><a href="javascript: void(0);" onclick="CTM.Load('?/char/{::x####$####x::guild_profile['master']}', 'content');">{::x####$####x::guild_profile['master']}</a></span>
                            </li>
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['GuildProfile']['Score']}</strong> 
                                <span class="red">{::x####$####x::guild_profile['score']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['GuildProfile']['Notice']['Title']}</strong> 
                                <span><a href="javascript: void(0);" rel="tooltip" title="{::x####$####x::guild_profile['notice']}">{::x####$####x::this->lang->words['Profile']['GuildProfile']['Notice']['Link']}</a></span>
                            </li>
                            <li>
                                <strong>&raquo; {::x####$####x::this->lang->words['Profile']['GuildProfile']['MemberCount']}</strong> 
                                <span class="green">{::x####$####x::guild_profile['member_count']}</span>
                            </li>
                        </ul>
                    </div>
            	</td>
        	</tr>
        </table>
        <div style="clear:both"></div>
        </if>
    </div>
    <if syntax="::x####$####x::guild_profile != 'GUILD_NOT_FOUND'">
    <div class="box-content">
    	<div class="header"><span>{::x####$####x::this->lang->words['Profile']['GuildProfile']['Members']['Title']}</span></div>
        <table width="100%" border="0" align="center" cellpadding="7" class="tableBackColumn">
        	<tr>
            	<td><em><strong>{::x####$####x::this->lang->words['Profile']['GuildProfile']['Members']['Name']}</strong></em></td>
                <td><em><strong>{::x####$####x::this->lang->words['Profile']['GuildProfile']['Members']['Class']}</strong></em></td>
                <td><em><strong>{::x####$####x::this->lang->words['Profile']['GuildProfile']['Members']['Level']}</strong></em></td>
                <td><em><strong>{::x####$####x::this->lang->words['Profile']['GuildProfile']['Members']['Status']}</strong></em></td>
        	</tr>
            <foreach loop="::x####$####x::guild_profile['members'] as ::x####$####x::name => ::x####$####x::character">
            <tr>
                <td><a href="javascript: void(0);" onclick="CTM.Load('?/char/{::x####$####x::name}', 'content');"><strong>{::x####$####x::name}</strong></a></td>
                <td>{::x####$####x::character['class']}</td>
                <td>{::x####$####x::character['level']}</td>
                <td>{::x####$####x::character['status']}</td>
        	</tr>
            </foreach>
    	</table>
    </div>
    </if>
        	
HTML;
/********** End: profile_guild **********/