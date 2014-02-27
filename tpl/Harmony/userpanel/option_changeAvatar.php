	<script type="text/javascript">
	$(document).ready(function()
	{
		$('#file_upload').uploadify(
		{
			'buttonText' : "{$this->lang->words['UserPanel']['ChangeAvatar']['SelectImage']}",
			'uploader'  : "{$this->vars['board_url']}{$this->vars['style_dirs']['js']}uploadify/uploadify.swf",
			'script'    : "{$this->vars['board_url']}?run=uploadify",
			'cancelImg' : "{$this->vars['board_url']}{$this->vars['style_dirs']['js']}uploadify/cancel.png",
			'folder'    : "{$this->settings['WEBDATA']['UPLOADS']['DIRECTORY']['CHARIMAGE']}",
			'fileExt' : '*.jpg;*.jpeg;*.png;*.gif',
			'fileDesc'    : 'Images Files (*.jpg;*.jpeg, *.png;*.gif)',
			'auto'      : false,
			'sizeLimit'   : "{$this->settings['WEBDATA']['UPLOADS']['FILESIZE']['CHARIMAGE']}",
			'onComplete': function(event, queueID, fileObj, response, data)
			{
				$("#u_imageUploaded").val(response);
				$("#u_command").val("finish");
				CTM.AjaxLoad('?app=core&module=userpanel&option=changeAvatar&write=true','Command','ChangeAvatar');
				
				$("#u_command").val("begin");
			},
			'onSelect'    : function(event,ID,fileObj)
			{
				$("#u_imageChanged").val(1);
			},
			'onCancel'    : function(event,ID,fileObj)
			{
				$("#u_imageChanged").val(0);
			}
		});
		
		$(".ChangeCommand").click(function()
		{
			if($(this).val() == "no_image")
			{
				$("#upload_image").hide("slow");
				$("#c_command").val("no_image");
			}
			else
			{
				$("#upload_image").show("slow");
				$("#c_command").val("upload");
			}
		});
		<if syntax="$userpanel['change_avatar']['with_avatar'] == false">
		$("#upload_image").hide("slow");
		</if>
	});
	function startUpload(uploadName, tmp_session)
	{
		$('#file_upload').uploadifySettings('scriptData',{'loadFunction':'ajaxUpload','fileSyntax':'.gif|.png|.jpg|.jpeg','fileName':uploadName,'fileSize':"{$this->settings['WEBDATA']['UPLOADS']['FILESIZE']['CHARIMAGE']}",'tmp_session':tmp_session},false);
		$('#file_upload').uploadifyUpload();
	}
	</script>
	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['ChangeAvatar']['Title']}</span></div>
		<form name="ChangeAvatar" id="ChangeAvatar">
			<input type="hidden" name="u_imageChanged" id="u_imageChanged" value="0" />
			<input type="hidden" name="u_imageUploaded" id="u_imageUploaded" value="" />
            <input type="hidden" name="u_command" id="u_command" value="begin" />
            <input type="hidden" name="c_command" id="c_command" value="{$userpanel['change_avatar']['c_command']}" />
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableBackColumn">
            	<tr>
                	<td>
                     	{$this->lang->words['UserPanel']['ChangeAvatar']['NoImage']}
                        <php>$no_image_checked = $GLOBALS['userpanel']['change_avatar']['with_avatar'] == false ? " checked=\"checked\"" : NULL;</php>
                     	<input type="radio" name="ChangeCommand" class="ChangeCommand" value="no_image"{$no_image_checked} />
                     </td>
                </tr>
				<tr>
					 <td>
                     	{$this->lang->words['UserPanel']['ChangeAvatar']['SendImage']}
                        <php>$upload_checked = $GLOBALS['userpanel']['change_avatar']['with_avatar'] == true ? " checked=\"checked\"" : NULL;</php>
                     	<input type="radio" name="ChangeCommand" class="ChangeCommand" value="upload"{$upload_checked} />
                     </td>
    				 <td width="50%"><div id="upload_image"><input id="file_upload" name="file_upload" type="file" /></div></td>
				  </tr>
			</table>
		</form>
		<input type="button" class="btn" value="{$this->lang->words['UserPanel']['ChangeAvatar']['Button']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=changeAvatar&amp;write=true','Command','ChangeAvatar');" />
    </div>
    <div id="Command"></div>