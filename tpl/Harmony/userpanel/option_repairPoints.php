	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['RepairPoints']['Title']}</span></div>
	   	<p>
        	<span class="red">{$this->lang->words['UserPanel']['RepairPoints']['Message']}</span><br /><br />
			<input class="btn" type="button" value="{$this->lang->words['UserPanel']['RepairPoints']['Button']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=repairPoints&amp;write=true','Command');" />
		</p>
	</div>
	<div id="Command"></div>