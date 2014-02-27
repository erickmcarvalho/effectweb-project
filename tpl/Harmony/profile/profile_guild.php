	<div class="box-content">
        <div class="header"><span>{$guild_name}</span></div>
        <if syntax="$guild_profile == 'GUILD_NOT_FOUND'">
        <div class="error-box">{$this->lang->words['Profile']['GuildProfile']['Messages']['NotFound']}</div>
        <else />
        <table width="100%" border="0">
        	<tr>
            	<td>
                	<br />
                    <div align="center">
                        <img src="{$guild_profile['image']}" width="120" height="120" style="border: 1px solid #B3B3B3;" class="image" />
                    </div>
                </td>
                <td>
                	<div class="description">
                        <ul style="width:240px">
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['GuildProfile']['GuildMaster']}</strong> 
                                <span><a href="javascript: void(0);" onclick="CTM.Load('?/char/{$guild_profile['master']}', 'content');">{$guild_profile['master']}</a></span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['GuildProfile']['Score']}</strong> 
                                <span class="red">{$guild_profile['score']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['GuildProfile']['Notice']['Title']}</strong> 
                                <span><a href="javascript: void(0);" rel="tooltip" title="{$guild_profile['notice']}">{$this->lang->words['Profile']['GuildProfile']['Notice']['Link']}</a></span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['GuildProfile']['MemberCount']}</strong> 
                                <span class="green">{$guild_profile['member_count']}</span>
                            </li>
                        </ul>
                    </div>
            	</td>
        	</tr>
        </table>
        <div style="clear:both"></div>
        </if>
    </div>
    <if syntax="$guild_profile != 'GUILD_NOT_FOUND'">
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['Profile']['GuildProfile']['Members']['Title']}</span></div>
        <table width="100%" border="0" align="center" cellpadding="7" class="tableBackColumn">
        	<tr>
            	<td><em><strong>{$this->lang->words['Profile']['GuildProfile']['Members']['Name']}</strong></em></td>
                <td><em><strong>{$this->lang->words['Profile']['GuildProfile']['Members']['Class']}</strong></em></td>
                <td><em><strong>{$this->lang->words['Profile']['GuildProfile']['Members']['Level']}</strong></em></td>
                <td><em><strong>{$this->lang->words['Profile']['GuildProfile']['Members']['Status']}</strong></em></td>
        	</tr>
            <foreach loop="$guild_profile['members'] as $name => $character">
            <tr>
                <td><a href="javascript: void(0);" onclick="CTM.Load('?/char/{$name}', 'content');"><strong>{$name}</strong></a></td>
                <td>{$character['class']}</td>
                <td>{$character['level']}</td>
                <td>{$character['status']}</td>
        	</tr>
            </foreach>
    	</table>
    </div>
    </if>
        	