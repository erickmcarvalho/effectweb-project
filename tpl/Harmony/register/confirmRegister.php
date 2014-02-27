	<div id="Verify" style="display: none;"></div>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['Register']['Confirm']['Title']}</span></div>
        <if syntax="empty($link_id)">
        <form name="ConfirmRegister" id="ConfirmRegister" class="frm">
        	<table width="100%" border="0">
            	<tr>
                	<td><label>{$this->lang->words['Register']['Confirm']['Code']}</label></td>
                    <td><input type="text" name="ConfirmCode" id="ConfirmCode" onKeyUp="this.value = this.value.toUpperCase();" maxlength="23" size="23" /></td>
        		</tr>
        	</table>
        	<input type="button" value="{$this->lang->words['Register']['Confirm']['Button']}" onclick="CTM.AjaxLoad('?app=core&module=register&do=confirm&write=true','Command','ConfirmRegister');" class="btn" />
        </form>
        <else />
        <if syntax="!empty($confirm_error)">
        <div class="error-box">{$confirm_error}</div>
        <else />
        <p>{$this->lang->words['Register']['Confirm']['Messages']['Link']['Success']}</p>
        </if>
        </if>
    </div>
    <div id="Command"></div>