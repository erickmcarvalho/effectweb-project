    <if syntax="empty($link_error)">
	<script type="text/javascript">
	$(function()
	{
		$("#NewPassword").keyup(function()
        {
            return CTM.PasswordLevel("NewPassword", "PassResult");
        });
        $("#CNewPassword").blur(function()
        {
            if($(this).val().length < 1)
				CTM.setFieldHover("CNewPassword", "CPassResult", "{$this->lang->words['Recovery']['Process']['FieldCheck']['Void']}", "#EFDC75", "exclamation");
            else if($("#NewPassword").val() != $(this).val())
				CTM.setFieldHover("CNewPassword", "CPassResult", "{$this->lang->words['Recovery']['Process']['FieldCheck']['PassConfirm']}", "#FF0000", "cross");
            else
				CTM.setFieldHover("CNewPassword", "CPassResult", "{$this->lang->words['Recovery']['Process']['FieldCheck']['PassConfirmed']}", "#093", "tick");
        });
	});
    </script>
    </if>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['Recovery']['Process']['Title']}</span></div>
        <if syntax="empty($link_error)">
        <form name="RedefinePassword" id="RedefinePassword" class="frm">
        	<table width="100%" border="0">
            	<tr>
                	<td><label>{$this->lang->words['Recovery']['Process']['NewPassword']}</label></td>
                    <td>
                    	<input type="password" name="NewPassword" id="NewPassword" onkeyup="this.value = this.value.toLowerCase();" maxlength="10" size="32" />
                        <span id="PassResult"></span>
        			</td>
                </tr>
                <tr>
                	<td><label>{$this->lang->words['Recovery']['Process']['CNewPassword']}</label></td>
                    <td>
                    	<input type="password" name="CNewPassword" id="CNewPassword" onkeyup="this.value = this.value.toLowerCase();" maxlength="10" size="32" />
                        <span id="CPassResult"></span>
        			</td>
        		</tr>
                <if syntax="empty($link_id)">
                <tr>
                	<td><label>{$this->lang->words['Recovery']['Process']['Code']}</label></td>
                    <td>
                    	<input type="text" name="RedefineCode" id="RedefineCode" onkeyup="this.value = this.value.toUpperCase();" maxlength="23" size="32" />
        			</td>
        		</tr>
                </if>
        	</table>
        	<input type="button" value="{$this->lang->words['Recovery']['Process']['Button']}" onclick="CTM.AjaxLoad('?app=core&module=recovery&do=process&write=true<if syntax='!empty($link_id)'>&id={$link_id}</if>','Command','RedefinePassword');" class="btn" />
        </form>
        <else />
        <div class="error-box">{$link_error}</div>
        </if>
    </div>
    <div id="Command"></div>