	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['ChangeName']['Title']}</span></div>
        <p>
			{$this->lang->words['UserPanel']['ChangeName']['CurrentName']} <strong id="currentCharName">{$userpanel['character']}</strong>.
		</p>
		<form name="RenameCharacter" id="RenameCharacter" class="frm">
        	<label>{$this->lang->words['UserPanel']['ChangeName']['NewName']}</label>
            <input type="text" name="NewName" id="NewName" maxlength="10" />
            <br /><br />
			<img src="{$this->vars['captcha_image']}" style="border:none;" id="loadCaptcha" /> 
			<a href="javascript: void();" onclick="CTM.RefreshCaptcha('loadCaptcha');">
				<img src="{$this->vars['style_dirs']['images']}icons/refresh.png" border="0" title="{$this->lang->words['Global']['Captcha']['Refresh']}" />
			</a>
			<label>{$this->lang->words['Global']['Captcha']['Captcha']} </label>
			<input type="text" name="Captcha" id="Captcha" size="30" />
		</form>
        <input type="button" class="btn" value="{$this->lang->words['UserPanel']['ChangeName']['Button']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=changeName&amp;write=true','Command', 'RenameCharacter');" />
	</div>
	<div id="Command"></div>