	<script type="text/javascript">
	$(function()
	{
		$("#confirmNow").click(function()
		{
			message = "";
		
			if($("#Date").val().length < 1) message += "&raquo; {$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['DateVoid']}<br />\n";
			if($("#Hour").val().length < 1) message += "&raquo; {$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['HourVoid']}<br />\n";
			if($("#Value").val().length < 1) message += "&raquo; {$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['ValueVoid']}<br />\n";
			if($("#Local option:selected").val().length < 1) message += "&raquo; {$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['LocalVoid']}<br />\n";
			<if syntax="count($userpanel['payments']['confirm_payment']['method_fields']) > 0">
			<foreach loop="$userpanel['payments']['confirm_payment']['method_fields'] as $key => $value">
			if($("#{$key}").val().length < 1) message += "&raquo; {$value}<br />\n";
			</foreach>
			</if>
		
			if(message != "")
			{
				beginMessage = "<strong>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['VoidMessage']}</strong><br /><br />";
				CTM.Message(beginMessage+message, 1, "Command");
			}
			else
			{
				Sexy.confirm("{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['Warning']}", {onComplete : function(setClose)
				{
					if(setClose)
						CTM.AjaxLoad("?app=core&module=userpanel&option=invoices&section=show&id={$userpanel['payments']['confirm_payment']['invoice_id']}&do=payment&method={$userpanel['payments']['confirm_payment']['method_id']}&write=true",'Command','confirmPayment');
				}});
			}
		});
		$('#file_upload').uploadify(
		{
			'buttonText' : "{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Annex']['Button']}",
			'uploader'  : "{$this->vars['board_url']}{$this->vars['style_dirs']['js']}uploadify/uploadify.swf",
			'script'    : "{$this->vars['board_url']}?run=uploadify",
			'cancelImg' : "{$this->vars['board_url']}{$this->vars['style_dirs']['js']}uploadify/cancel.png",
			'folder'    : "{$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['PAYMENT_ANNEX']}",
			'fileExt' : '*.jpg;*.jpeg;*.png;*.gif;',
			'fileDesc'    : 'Images (*.jpg, *.jpeg, *.png, *.gif)',
			'auto'      : false,
			'sizeLimit'   : "{$this->settings['WEBDATA']['UPLOADS']['FILESIZE']['PAYMENT_ANNEX']}",
			'onSelect'    : function(event,ID,fileObj)
			{
				$("#u_sendFile").val(1);
			},
			'onComplete': function(event, queueID, fileObj, response, data)
			{
				$("#u_fileUploaded").val(response);
				
				CTM.AjaxLoad("?app=core&module=userpanel&option=invoices&section=show&id={$userpanel['payments']['confirm_payment']['invoice_id']}&do=payment&method={$userpanel['payments']['confirm_payment']['method_id']}&write=true",'Command','confirmPayment');
				
				$("#u_ready").val(1);
			},
			'onCancel'    : function(event,ID,fileObj)
			{
				$("#u_ready").val(1);
				$("#u_sendFile").val(0)
				$("#u_fileUploaded").val("");
			}
		});
	});
	function startUpload(uploadName, tmp_session)
	{
		$("#u_ready").val(0);
		
		$('#file_upload').uploadifySettings('scriptData',{'fileSyntax':'.gif|.png|.jpg|.jpeg','fileName':uploadName,'fileSize':'{$this->settings['WEBDATA']['UPLOADS']['FILESIZE']['PAYMENT_ANNEX']}','tmp_session':tmp_session},false);
		$('#file_upload').uploadifyUpload();
	}
	</script>
    <div class="box-content" style="width: 700px">
    	<div class="header"><span>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Title']}</span></div>
        <p>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['MethodSelected']} <strong>{$userpanel['payments']['confirm_payment']['method_name']}</strong></p>
        <form name="confirmPayment" id="confirmPayment" class="frm">
        	<input type="hidden" name="u_sendFile" id="u_sendFile" value="0" />
            <input type="hidden" name="u_fileUploaded" id="u_fileUploaded" value="" />
            <input type="hidden" name="u_ready" id="u_ready" value="1" />
            
            <h3>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['BuyData']['Title']}</h3>
            <table width="100%" border="0" class="tableBackColumn">
				<tr>
					<td>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['BuyData']['Date']}</td>
					<td><input type="text" name="Date" id="Date" value="Ex: 01/01/" onfocus="CTM.clearField(this)" /></td>
				</tr>
				<tr>
					<td>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['BuyData']['Hour']}</td>
					<td><input type="text" name="Hour" id="Hour" value="Ex: 00:00" onfocus="CTM.clearField(this)" /></td>
				</tr>
				<tr>
					<td>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['BuyData']['Value']}</td>
					<td><input type="text" name="Value" id="Value" value="R$ 0,00" onfocus="CTM.clearField(this)" /></td>
				</tr>
				<tr>
					<td>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['BuyData']['Local']}</td>
					<td>
                    	<select name="Local" id="Local">
                            <option value="{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['BuyData']['LocalField']['Attendant']}">{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['BuyData']['LocalField']['Attendant']}</option>
                            <option value="{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['BuyData']['LocalField']['ElectronicBox']}">{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['BuyData']['LocalField']['ElectronicBox']}</option>
                            <option value="{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['BuyData']['LocalField']['BankTransfer']}">{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['BuyData']['LocalField']['BankTransfer']}</option>
                        </select>
					</td>
				</tr>
			</table>
            
            <if syntax="count($userpanel['payments']['confirm_payment']['method_fields']) > 0">
            <h3>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['PaymentData']}</h3>
            <table width="100%" border="0" class="tableBackColumn">
				<foreach loop="$userpanel['payments']['confirm_payment']['method_fields'] as $key => $value">
				<tr>
					<td>{$value}</td>
					<td width="60%"><input type="text" name="{$key}" id="{$key}" /></td>
				</tr>
				</foreach>
			</table>
            </if>
            
            <h3>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Annex']['Title']}</h3>
            <table width="100%" border="0" class="tableBackColumn">
				<tr>
					<td><input id="file_upload" name="file_upload" type="file" /></td>
				</tr>
			</table>
            
            <h3>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Message']}</h3>
            <table width="100%" border="0" class="tableBackColumn">
				<tr align="center">
					<td><textarea name="Message" id="Message" rows="10" cols="55"></textarea></td>
				</tr>
			</table>
            
            <input type="button" value="{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Button']}" id="confirmNow" class="btn" />
		</form>
	</div>
    <div id="Command"></div>