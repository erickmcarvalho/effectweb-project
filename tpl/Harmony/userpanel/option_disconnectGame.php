    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['DisconnectGame']['Title']}</span></div>
        <if syntax="$userpanel['disconnect_game']['status'] == 1">
        <p>{$this->lang->words['UserPanel']['DisconnectGame']['Message']}</p>
        <input type="button" name="disconnectGame" id="disconnectGame" value="{$this->lang->words['UserPanel']['DisconnectGame']['Button']}" class="btn" onclick="CTM.AjaxLoad('?app=core&module=userpanel&option=disconnectGame&do=process', 'loadCommand');" />
        <else />
        <div class="error-box"> {$this->lang->words['UserPanel']['DisconnectGame']['Messages']['Offline']}</div>
        </if>
    </div>
    <div id="loadCommand"></div>