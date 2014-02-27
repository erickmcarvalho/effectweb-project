    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['ChangeMail']['Title']}</span></div>
        <form name="ChangeMail" id="ChangeMail" class="frm">
        	<table width="100%" border="0">
            	<tr>
                	<td><label>{$this->lang->words['UserPanel']['ChangeMail']['NewMail']}</label></td>
                    <td><input type="text" name="NewMail" id="NewMail" onKeyUp="this.value = this.value.toLowerCase();" size="32" /></td>
        		</tr>
                <tr>
                	<td><label>{$this->lang->words['UserPanel']['ChangeMail']['ConfirmCode']}</label></td>
                    <td><input type="text" name="ConfirmCode" id="ConfirmCode" onKeyUp="this.value = this.value.toUpperCase();" maxlength="23" size="32" /></td>
        		</tr>
        	</table>
        	<input type="button" value="{$this->lang->words['UserPanel']['ChangeMail']['Button_Process']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=changeMail&amp;do=process','Command','ChangeMail');" class="btn" />
            <input type="button" value="{$this->lang->words['UserPanel']['ChangeMail']['Button_SendCode']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=changeMail&amp;do=send_code','Command');" class="btn" />
        </form>
    </div>
    <div id="Command"></div>