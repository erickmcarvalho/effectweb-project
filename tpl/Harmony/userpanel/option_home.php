	<script type="text/javascript">
	$(document).ready(function(e)
	{
		$(".ManageChar").click(function()
		{
			var charName = encodeURIComponent($(this).attr("rel"));
			CTM.AjaxLoad('?app=core&module=userpanel&option=manageChar&write=true&character='+charName, "HomeCommand");
		});
		
		<if syntax="$userpanel['home_block_info']">
		if(e)
		{
			blockMessage = "<strong>{$this->lang->words['UserPanel']['Home']['BlockMessage']['Title']}</strong><br /><br />\n";
			blockMessage += "<strong>{$this->lang->words['UserPanel']['Home']['BlockMessage']['Reason']}</strong> {$userpanel['home_block_info']['reason']}<br />\n";
			blockMessage += "<strong>{$this->lang->words['UserPanel']['Home']['BlockMessage']['Responsible']}</strong> {$userpanel['home_block_info']['responsible']}<br />\n";
			blockMessage += "<strong>{$this->lang->words['UserPanel']['Home']['BlockMessage']['Expiration']}</strong> {$userpanel['home_block_info']['expiration']}";
			
			Sexy.alert(blockMessage);
		}
		</if>
	});
    </script>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['Home']['Title']}</span></div>
        <table width="100%" border="0" align="center" cellpadding="7" class="tableBackColumn">
			<tr>
            	<td width="50%"><em>{$this->lang->words['UserPanel']['Home']['Member']['Plan']}</em></td>
                <td width="50%">
                	{$userpanel['home_informations']['member_level']}
                    ({$this->lang->words['UserPanel']['Home']['Member']['Expiration']} {$userpanel['home_informations']['member_vip']['end']})
                </td>
        	</tr>
            <tr>
            	<td><em>{$this->lang->words['UserPanel']['Home']['Member']['CoinBalance'][1]}</em></td>
                <td>{$userpanel['home_informations']['member_coin'][1]}</td>
        	</tr>
            <if syntax="COIN_NUMBER >= 2">
            <tr>
            	<td><em>{$this->lang->words['UserPanel']['Home']['Member']['CoinBalance'][2]}</em></td>
                <td>{$userpanel['home_informations']['member_coin'][2]}</td>
        	</tr>
            </if>
            <if syntax="COIN_NUMBER == 3">
            <tr>
            	<td><em>{$this->lang->words['UserPanel']['Home']['Member']['CoinBalance'][3]}</em></td>
                <td>{$userpanel['home_informations']['member_coin'][3]}</td>
        	</tr>
            </if>
        </table>
    </div>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['Home']['LastConnection']['Title']}</span></div>
        <table width="100%" border="0" align="center" cellpadding="7" class="tableBackColumn">
        	<tr>
            	<td width="50%"><em>{$this->lang->words['UserPanel']['Home']['LastConnection']['Date']}</em></td>
                <td width="50%">{$userpanel['home_lastconnection']['date']}</td>
        	</tr>
            <tr>
            	<td><em>{$this->lang->words['UserPanel']['Home']['LastConnection']['Hour']}</em></td>
                <td>{$userpanel['home_lastconnection']['hour']}</td>
        	</tr>
            <tr>
            	<td><em>{$this->lang->words['UserPanel']['Home']['LastConnection']['Server']}</em></td>
                <td>{$userpanel['home_lastconnection']['server']}</td>
        	</tr>
            <tr>
            	<td><em>{$this->lang->words['UserPanel']['Home']['LastConnection']['IP']}</em></td>
                <td>{$userpanel['home_lastconnection']['ip']}</td>
        	</tr>
            <tr>
            	<td><em>{$this->lang->words['UserPanel']['Home']['LastConnection']['Status']}</em></td>
                <td>
                	<if syntax="$userpanel['home_lastconnection']['status'] == 1">
                    <span style="color: green;">Online</span>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['ACCOUNT']['DISCONNECT_GAME'][$userpanel['user_level'] + 1] == true">
                    <a href="javascript: void(0);" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=disconnectGame&amp;do=process', 'HomeCommand');">
                    	[{$this->lang->words['UserPanel']['Home']['LastConnection']['Disconnect']}]
                    </a>
                    </if>
                    <else />
                    <span style="color: red;">Offline</span>
                    </if>
				</td>
        	</tr>
    	</table>
    </div>
    <if syntax="count($userpanel['home_characters']) > 0">
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['Home']['Characters']['Title']}</span></div>
        <table width="100%" border="0" align="center" cellpadding="7" class="tableBackColumn">
        	<tr>
            	<td><em><strong>{$this->lang->words['UserPanel']['Home']['Characters']['Name']}</strong></em></td>
                <td><em><strong>{$this->lang->words['UserPanel']['Home']['Characters']['Class']}</strong></em></td>
                <td><em><strong>{$this->lang->words['UserPanel']['Home']['Characters']['Level']}</strong></em></td>
                <td><em><strong>{$this->lang->words['UserPanel']['Home']['Characters']['Guild']}</strong></em></td>
                <td><em><strong>{$this->lang->words['UserPanel']['Home']['Characters']['Manage']}</strong></em></td>
        	</tr>
            <foreach loop="$userpanel['home_characters'] as $character">
            <tr>
                <td>{$character['name']}</td>
                <td>{$character['class']}</td>
                <td>{$character['level']}</td>
                <td>{$character['guild']}</td>
                <td><a href="javascript: void(0);" class="ManageChar" rel="{$character['name']}">[{$this->lang->words['UserPanel']['Home']['Characters']['ManageLink']}]</a></td>
        	</tr>
            </foreach>
    	</table>
    </div>
    </if>
    <div id="HomeCommand"></div>
    <if syntax="count($userpanel['home_chars_blocked']) > 0">
    <foreach loop="$userpanel['home_chars_blocked'] as $message">
    <div class="error-box">{$message}</div>
    </foreach>
    </if>