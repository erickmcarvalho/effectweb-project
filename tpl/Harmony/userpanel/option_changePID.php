	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['ChangePID']['Title']}</span></div>
        <p>
			{$this->lang->words['UserPanel']['ChangePID']['Message']}
		</p>
		<form name="ChangePID" id="ChangePID" class="frm">
        	<label>{$this->lang->words['UserPanel']['ChangePID']['NewPID']}</label>
            	<input type="password" name="SetNewPID" id="SetNewPID" onkeypress="return CTM.NumbersOnly(event);" maxlength="7" size="10" />
           	<label>{$this->lang->words['UserPanel']['ChangePID']['Password']}</label>
				<input type="password" name="Password" id="Password" maxlength="10" size="15" />
            <label>{$this->lang->words['UserPanel']['ChangePID']['SecureQuestion']}</label>
				<input type="text" name="SecureAnswer" id="SecureAnswer" size="32" />
		</form>
        <input type="button" class="btn" value="{$this->lang->words['UserPanel']['ChangePID']['Button']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=changePID&amp;write=true','Command', 'ChangePID');" />
	</div>
	<div id="Command"></div>