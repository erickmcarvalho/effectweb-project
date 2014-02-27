	<script type="text/javascript">
	$(function()
	{
		$("#NewPassword").keyup(function()
        {
            return CTM.PasswordLevel("NewPassword", "NewPassResult");
        });
		$("#ChangeDataNow").click(function()
		{
			CTM.AjaxLoad("?app=core&module=userpanel&option=changeData&process=data", "ResultCommand", "ChangeData");
		});
		$("#ChangePasswordNow").click(function()
		{
			CTM.AjaxLoad("?app=core&module=userpanel&option=changeData&process=password", "ResultCommand", "ChangePassword");
		});
	});
	</script>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['ChangeData']['Title']}</span></div>
        <h3 style="float:left; display:inherit; clear:none; width:300px">{$this->lang->words['UserPanel']['ChangeData']['Data']['Title']}</h3>
		<h3 style="float:right; display:inherit; clear:none; width:380px"">{$this->lang->words['UserPanel']['ChangeData']['Password']['Title']}</h3>
        <form name="ChangeData" id="ChangeData" class="frm" style="float:left">
			<label>{$this->lang->words['UserPanel']['ChangeData']['Data']['Name']} </label>
			<input type="text" name="Name" id="Name" value="{$userpanel['change_data_infos']['name']}" size="30" />
            
			<label>{$this->lang->words['UserPanel']['ChangeData']['Data']['Mail']} </label>
			<input type="text" name="Mail" id="Mail" value="{$userpanel['change_data_infos']['mail']}" readonly="readonly" size="30" />
            
			<label>{$this->lang->words['UserPanel']['ChangeData']['Data']['Phone']} </label>
			<input type="text" name="Phone" id="Phone" value="{$userpanel['change_data_infos']['phone']}" size="30" />
            
            <br />
            <input type="button" id="ChangeDataNow" class="btn" value="{$this->lang->words['UserPanel']['ChangeData']['Data']['Button']}" />
		</form>
		<form name="ChangePassword" id="ChangePassword" class="frm" style="float:right; width:360px"">
			<label>{$this->lang->words['UserPanel']['ChangeData']['Password']['CurrentPassword']} </label>
			<input type="password" name="CurrentPassword" id="CurrentPassword" maxlength="10" size="30" />
            
			<label>{$this->lang->words['UserPanel']['ChangeData']['Password']['NewPassword']} </label>
			<input type="password" name="NewPassword" id="NewPassword" maxlength="10" size="30" /><span id="NewPassResult"></span>
            
			<label>{$this->lang->words['UserPanel']['ChangeData']['Password']['CNewPassword']} </label>
			<input type="password" name="CNewPassword" id="CNewPassword" maxlength="10" size="30" />
            
			<label>{$this->lang->words['UserPanel']['ChangeData']['Password']['SecureQuestion']} </label>
			<input type="text" name="SecureAnswer" id="SecureAnswer" size="30" />
            
            <br />
            <input type="button" id="ChangePasswordNow" class="btn" value="{$this->lang->words['UserPanel']['ChangeData']['Password']['Button']}" /> 
		</form>   
    </div>
    <div id="ResultCommand"></div>