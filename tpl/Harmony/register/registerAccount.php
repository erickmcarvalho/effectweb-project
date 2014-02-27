	<script type="text/javascript">
    $(function()
    {
        $("#Login").blur(function()
        {
            if($(this).val().length < 1)
				CTM.setFieldHover("Login", "LoginResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['Void']}", "#EFDC75", "exclamation");
            else if($(this).val().length < 4)
				CTM.setFieldHover("Login", "LoginResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['MinLogin']}", "#FF0000", "cross");
			else if($(this).val().length > 10)
				CTM.setFieldHover("Login", "LoginResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['MaxLogin']}", "#FF0000", "cross");
            else
				CTM.AjaxLoad('?app=core&module=register&do=ajaxCheck&command=login&username='+encodeURIComponent($(this).val()), 'ajaxVerify');
        });
        $("#Password").keyup(function()
        {
            return CTM.PasswordLevel("Password", "PassResult");
        });
        $("#CPassword").blur(function()
        {
            if($(this).val().length < 1)
				CTM.setFieldHover("CPassword", "CPassResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['Void']}", "#EFDC75", "exclamation");
            else if($("#Password").val() != $(this).val())
				CTM.setFieldHover("CPassword", "CPassResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['PassConfirm']}", "#FF0000", "cross");
            else
				CTM.setFieldHover("CPassword", "CPassResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['PassConfirmed']}", "#093", "tick");
        });
        $("#Mail").blur(function()
        {
            if($(this).val().length < 1)
				CTM.setFieldHover("Mail", "MailResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['Void']}", "#EFDC75", "exclamation");
            else if(!CTM.CheckMail($(this).val()))
				CTM.setFieldHover("Mail", "MailResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['MailInvalid']}", "#FF0000", "cross");
            else
				CTM.AjaxLoad('?app=core&module=register&do=ajaxCheck&command=mail&email='+encodeURIComponent($(this).val()), 'ajaxVerify');
        });
        $("#CMail").blur(function()
        {
            if($(this).val().length < 1)
				CTM.setFieldHover("CMail", "CMailResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['Void']}", "#EFDC75", "exclamation");
            else if($("#Mail").val() != $(this).val())
				CTM.setFieldHover("CMail", "CMailResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['MailConfirm']}", "#FF0000", "cross");
            else
				CTM.setFieldHover("CMail", "CMailResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['MailConfirmed']}", "#093", "tick");
        });
        <if syntax="$this->settings['REGISTER']['REGISTER_PID'] == true">
        $("#PersonalID").blur(function()
        {
            if($(this).val().length < 1)
				CTM.setFieldHover("PersonalID", "PIDResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['Void']}", "#EFDC75", "exclamation");
            else if($(this).val().length != 7)
				CTM.setFieldHover("PersonalID", "PIDResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['PIDLength']}", "#FF0000", "cross");
            else if(isNaN($(this).val()))
				CTM.setFieldHover("PersonalID", "PIDResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['PIBWords']}", "#FF0000", "cross");
            else
				CTM.setFieldHover("PersonalID", "PIDResult", "{$this->lang->words['Register']['Register']['AjaxCheck']['PIDValid']}", "#093", "tick");
        });
        </if>
        
        $("#CompleteRegister").click(function()
        {
            if($("#Terms:checked").val() != 1)
				CTM.Message("{$this->lang->words['Register']['Register']['Messages']['CheckTerms']}", 2, "RegisterCommand");
            else
            {
                message = "";
            
                if($("#Login").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_Login']}<br />";
                if($("#Password").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_Password']}<br />";
                if($("#CPassword").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_CPassword']}<br />";
                if($("#Mail").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_Mail']}<br />";
                if($("#CMail").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_CMail']}<br />";
				<if syntax="$this->settings['REGISTER']['REGISTER_PID'] == true">
                if($("#PersonalID").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_PID']}<br />";
                </if>
                if($("#Name").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_Name']}<br />";
				if($("#Phone").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_Phone']}<br />";
                if(!$("#Sex:checked").val()) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_Sex']}<br />";
                if($("#BirthDay option:selected").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_BirthDay']}<br />";
                if($("#BirthMonth option:selected").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_BirthMonth']}<br />";
                if($("#BirthYear").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_BirthYear']}<br />";
                if($("#SecureQuestion option:selected").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_SecureQuestion']}<br />";
                if($("#SecureAnswer").val().length < 1) message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['NULL_SecureAnswer']}<br />";
                if($("#Captcha").val().length < 1) message += "&raquo; {$this->lang->words['Global']['Captcha']['Messages']['Void']}";
                
                if(message != "")
					CTM.Message("{$this->lang->words['Register']['Register']['Messages']['NULL_Message']}<br /><br />"+message, 1, "RegisterCommand");
                else
                {
                    message = "";
                    
                    if($("#Login").val().length < 3 || $("#Login").val().length > 10)
						message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['Error_LoginLength']}<br />";
						
					if($("#Password").val().length < 3 || $("#Password").val().length > 10)
						message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['Error_PassLength']}<br />";	
						
					<if syntax="$this->settings['REGISTER']['REGISTER_PID'] == true">
					if($("#PersonalID").val().length != 7)
						message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['Error_PIDLength']}<br />";
					</if>
					
                    if($("#Login").val().match(/[^a-zA-Z0-9_!=?&-]/i))
						message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['Error_LoginWords']}<br />";
						
					if($("#Password").val().match(/[^a-zA-Z0-9_!=?&-]/i))
						message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['Error_PassWords']}<br />";
						
					if(!CTM.CheckMail($("#Mail").val()))
						message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['Error_MailWords']}<br />";
						
					<if syntax="$this->settings['REGISTER']['REGISTER_PID'] == true">
					if(isNaN($("#PersonalID").val()))
						message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['Error_PIDWords']}<br />";
					</if>
					
					if(strcmp($("#Password").val(), $("#CPassword").val()) != 0)
						message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['Error_ConfirmPass']}<br />";
						
					if(strcmp($("#Mail").val(), $("#CMail").val()) != 0)
						message += "&raquo; {$this->lang->words['Register']['Register']['Messages']['Error_ConfirmMail']}<br />";
                    
                    if(message != "")
						CTM.Message("{$this->lang->words['Register']['Register']['Messages']['Error_Message']}<br /><br />"+message, 2, "RegisterCommand");
                    else
						CTM.AjaxLoad("?app=core&module=register&write=true", "RegisterCommand", "RegisterAccount");
                }
            }
        });
		
		$("#OpenTerms").click(function()
		{
			/*$.fancybox(
			{
				ajax :
				{
					type : "GET",
					data : "only=true"
				},
				href : "?app=core&module=informations&do=terms"
			});*/
			
			$.facebox({ ajax: "?app=core&module=informations&do=terms&only=true" });
		});
    });
    
    CTM.RefreshCaptcha('loadCaptcha');
    </script>
	<div id="ajaxVerify" style="display: none;"></div>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['Register']['Register']['Title']}</span></div>
		<form name="RegisterAccount" id="RegisterAccount" class="frm">
        	<h4>{$this->lang->words['Register']['Register']['AccountData']['Title']}</h4>
        	<table width="100%" border="0" align="center" cellpadding="7">
                <tbody>
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['AccountData']['Login']}</td>
                        <td width="60%"><input type="text" name="Login" id="Login" maxlength="10" onkeyup="this.value = this.value.toLowerCase();" /> <span id="LoginResult"></span></td>
                    </tr>
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['AccountData']['Password']}</td>
                        <td><input type="password" name="Password" id="Password" maxlength="10" onkeyup="this.value = this.value.toLowerCase();" /> <span id="PassResult"></span></td>
                    </tr>
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['AccountData']['CPassword']}</td>
                        <td><input type="password" name="CPassword" id="CPassword" maxlength="10" onkeyup="this.value = this.value.toLowerCase();" /> <span id="CPassResult"></span></td>
                    </tr>
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['AccountData']['Mail']}</td>
                        <td><input type="text" name="Mail" id="Mail" /> <span id="MailResult"></span></td>
                    </tr>
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['AccountData']['CMail']}</td>
                        <td><input type="text" name="CMail" id="CMail" /> <span id="CMailResult"></span></td>
                    </tr>
                    <if syntax="$this->settings['REGISTER']['REGISTER_PID'] == true">
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['AccountData']['PID']}</td>
                        <td><input type="text" name="PersonalID" id="PersonalID" maxlength="7" onkeypress="return CTM.NumbersOnly(event);" /> <span id="PIDResult"></span></td>
                    </tr>
                    </if>
                </tbody>
            </table>
        	<h4>{$this->lang->words['Register']['Register']['AccountDetails']['Title']}</h4>
        	<table width="100%" border="0" align="center" cellpadding="7">
                <tbody>
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['AccountDetails']['Name']}</td>
                        <td width="60%"><input type="text" name="Name" id="Name" maxlength="30" /></td>
                    </tr>
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['AccountDetails']['Phone']}</td>
                        <td><input type="text" name="Phone" id="Phone" maxlength="10" onkeyup="this.value = this.value.toLowerCase();" /></td>
                    </tr>
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['AccountDetails']['Sex']['Field']}</td>
                        <td>
                            <input name="Sex" type="radio" id="Sex" value="{$this->lang->words['Register']['Register']['AccountDetails']['Sex']['Male']}"> {$this->lang->words['Register']['Register']['AccountDetails']['Sex']['Male']}<br>
                            <input name="Sex" type="radio" id="Sex" value="{$this->lang->words['Register']['Register']['AccountDetails']['Sex']['Female']}"> {$this->lang->words['Register']['Register']['AccountDetails']['Sex']['Female']}
                        </td>
                    </tr>
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['AccountDetails']['Birth']['Field']}</td>
                        <td>
                            <select name="BirthDay" id="BirthDay">
                                <option value="" selected="selected">{$this->lang->words['Register']['Register']['AccountDetails']['Birth']['Day']}</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                            <select name="BirthMonth" id="BirthMonth">
                                <option value="" selected="selected">{$this->lang->words['Register']['Register']['AccountDetails']['Birth']['Month']}</option>
                                <option value="01">01</option>
                                <option value="02">02</option>
                                <option value="03">03</option>
                                <option value="04">04</option>
                                <option value="05">05</option>
                                <option value="06">06</option>
                                <option value="07">07</option>
                                <option value="08">08</option>
                                <option value="09">09</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <input type="text" name="BirthYear" id="BirthYear" size="3" maxlength="4" onkeypress="return CTM.NumbersOnly(event);" placeholder="{$this->lang->words['Register']['Register']['AccountDetails']['Birth']['Year']}" />
                        </td>
                    </tr>
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['AccountDetails']['SecureQuestion']['Question']}</td>
                        <td>
                            <select name="SecureQuestion" id="SecureQuestion">
                                <option value="" selected="selected" disabled="disabled">{$this->lang->words['Register']['Register']['AccountDetails']['SecureQuestion']['Select']}</option>
                                <foreach loop="$this->lang->words['Register']['Register']['AccountDetails']['SecureQuestion']['Questions'] as $question">
                                <option value="{$question}">{$question}</option>
                                </foreach>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['AccountDetails']['SecureQuestion']['Answer']}</td>
                        <td><input type="text" name="SecureAnswer" id="SecureAnswer" maxlength="30" onkeyup="this.value = this.value.toLowerCase();" /></td>
                    </tr>
              </tbody>
            </table>
        	<if syntax="$register_module['countBonus'] > 0">
        	<h4>{$this->lang->words['Register']['Register']['RegisterBonus']['Title']}</h4>
            <table width="100%" border="0" align="center" cellpadding="7">
                <tbody>
                    <if syntax="$this->settings['REGISTER']['VAULT_BONUS']['SWITCH'] == true">
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['RegisterBonus']['VaultBonus']}</td>
                        <td width="60%">
                            <select name="VaultBonus" id="VaultBonus">
                                <option value="">{$this->lang->words['Words']['None']}</option>
                                <foreach loop="$this->settings['REGISTER']['VAULT_BONUS']['OPTIONS'] as $key => $value">
                                <option value="{$key}">--> {$value}</option>
                                </foreach>
                            </select>
                        </td>
                    </tr>
                    </if>
                    <if syntax="$this->settings['REGISTER']['VIP']['SWITCH'] == true">
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['RegisterBonus']['VIPBonus']}</td>
                        <td width="60%"><input type="checkbox" name="VIPBonus" id="VIPBonus" value="1" /></td>
                    </tr>
                    </if>
                    <if syntax="$this->settings['REGISTER']['COIN']['SWITCH'] == true">
                    <tr>
                        <td>{$this->lang->words['Register']['Register']['RegisterBonus']['CoinBonus']}</td>
                        <td width="60%"><input type="checkbox" name="CoinBonus" id="CoinBonus" value="1" /></td>
                    </tr>
                    </if>
              </tbody>
            </table>
            </if>
            <h4>{$this->lang->words['Global']['Captcha']['Captcha']}</h4>
            <div align="center">
            	<img src="{$this->vars['captcha_image']}" style="border:none;" id="loadCaptcha" /> 
                <a href="javascript: void(0);" onclick="CTM.RefreshCaptcha('loadCaptcha');">
                <img src="{$this->vars['style_dirs']['images']}icons/refresh.png" border="0" title="{$this->lang->words['Global']['Captcha']['Refresh']}" /></a>
			</div>
            <table width="100%" border="0" align="center" cellpadding="7">
                <tbody>
                    <tr>
                        <td>{$this->lang->words['Global']['Captcha']['Code']}</td>
                        <td width="60%"><input type="text" name="Captcha" id="Captcha" /></td>
                    </tr>
              </tbody>
            </table>
            <br />
            <div align="center">
            	<input type="checkbox" name="Terms" id="Terms" value="1" /> <a href="javascript: void(0);" id="OpenTerms">{$this->lang->words['Register']['Register']['Terms']}</a><br /><br />
            	<input type="button" name="CompleteRegister" id="CompleteRegister" value="{$this->lang->words['Register']['Register']['Button']}" class="btn" />
            </div>
		</form>
	</div>
    <div id="RegisterCommand"></div>