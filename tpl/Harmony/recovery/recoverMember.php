    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['Recovery']['Recover']['Title']}</span></div>
        <form name="RecoverData" id="RecoverData" class="frm">
        	<table width="100%" border="0">
            	<tr>
                	<td><label>{$this->lang->words['Recovery']['Recover']['Login']}</label></td>
                    <td><input type="text" name="Login" id="Login" onKeyUp="this.value = this.value.toLowerCase();" maxlength="10" size="32" /></td>
        		</tr>
                <tr>
                	<td><label>{$this->lang->words['Recovery']['Recover']['Mail']}</label></td>
                    <td><input type="text" name="Mail" id="Mail" onKeyUp="this.value = this.value.toLowerCase();" size="32" /></td>
        		</tr>
        	</table>
        	<input type="button" value="{$this->lang->words['Recovery']['Recover']['Button']}" onclick="CTM.AjaxLoad('?app=core&module=recovery&write=true','Command','RecoverData');" class="btn" />
        </form>
    </div>
    <div id="Command"></div>