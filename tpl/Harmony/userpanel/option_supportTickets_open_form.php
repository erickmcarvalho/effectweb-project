	<script type="text/javascript">
	$(function()
	{
		$("#openNow").click(function()
		{
			var message = "";
		
			if($("#Subject").val().length < 1) message += "&raquo; {$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['SubjectVoid']}<br />";
			if($("#Character option:selected").val().length < 1) message += "&raquo; {$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['SelectCharacter']}<br />";
			if($("#Text").val().length < 1) message += "&raquo; {$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['MessageVoid']}<br />";
		
			if(message.length > 0)
			{
				beginMessage = "<strong>{$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['VoidMessage']}</strong><br /><br />";
				CTM.Message(beginMessage+message, 1, "Command");
			}
			else
				CTM.AjaxLoad("?app=core&module=userpanel&option=supportTickets&section=open&departament={$userpanel['support_tickets']['open_ticket']['departament']}&write=true",'Command','openTicket');
		});
		$('#file_upload').uploadify(
		{
			'buttonText' : "{$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Buttons']['Annex']}",
			'uploader'  : "{$this->vars['board_url']}{$this->vars['style_dirs']['js']}uploadify/uploadify.swf",
			'script'    : "{$this->vars['board_url']}?run=uploadify",
			'cancelImg' : "{$this->vars['board_url']}{$this->vars['style_dirs']['js']}uploadify/cancel.png",
			'folder'    : "{$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['TICKET_ANNEX']}",
			'fileExt' : '*.jpg;*.jpeg;*.png;*.gif;*.txt;*.log;',
			'fileDesc'    : 'Images / Log Files (*.jpg, *.jpeg, *.png, *.gif / *.txt, *.log)',
			'auto'      : false,
			'sizeLimit'   : "{$this->settings['WEBDATA']['UPLOADS']['FILESIZE']['TICKET_ANNEX']}",
			'onSelect'    : function(event,ID,fileObj)
			{
				$("#u_sendFile").val(1);
			},
			'onComplete': function(event, queueID, fileObj, response, data)
			{
				$("#u_fileUploaded").val(response);
				
				CTM.AjaxLoad("?app=core&module=userpanel&option=supportTickets&section=open&departament={$userpanel['support_tickets']['open_ticket']['departament']}&write=true",'Command','openTicket');
				
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
		
		$('#file_upload').uploadifySettings('scriptData',{'fileSyntax':'.gif|.png|.jpg|.jpeg|.txt|.log','fileName':uploadName,'fileSize':"{$this->settings['WEBDATA']['UPLOADS']['FILESIZE']['TICKET_ANNEX']}",'tmp_session':tmp_session},false);
		$('#file_upload').uploadifyUpload();
	}
	</script>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Title']}</span></div>
        <form name="openTicket" id="openTicket" class="frm">
        	<input type="hidden" name="u_sendFile" id="u_sendFile" value="0" />
            <input type="hidden" name="u_fileUploaded" id="u_fileUploaded" value="" />
            <input type="hidden" name="u_ready" id="u_ready" value="1" />
            <table width="100%" border="0" class="tableBackColumn">
            	<tr>
                	<td>{$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Subject']}</td>
                    <td><input type="text" name="Subject" id="Subject" size="40" /></td>
				</tr>
                <tr>
                	<td>{$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Character']}</td>
                    <td>
                    	<select name="Character" id="Character">
                        	<option value="" disabled="disabled" selected="selected">{$this->lang->words['Words']['Select']}</option>
                            <if syntax="count($userpanel['support_tickets']['open_ticket']['characters']) > 0">
                            <foreach loop="$userpanel['support_tickets']['open_ticket']['characters'] as $name">
                            <option value="{$name}">{$name}</option>
                            </foreach>
                            </if>
                    	</select>
                    </td>
				</tr>
			</table>
            <table width="100%" border="0" class="tableBackColumn">
            	<tr align="center">
                	<td>
                    	<label>{$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Message']}</label>
            			<textarea name="Text" id="Text" rows="10" cols="55"></textarea>
                    </td>
           		</tr>
			</table>
            <table width="100%" border="0" class="tableBackColumn">
                <tr>
                	<td>{$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Annex']}</td>
                    <td><input id="file_upload" name="file_upload" type="file" /></td>
			</table> 
            <input type="button" value="{$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Buttons']['Continue']}" id="openNow" class="btn" />
		</form>
	</div>
	<div id="Command"></div>