	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['ClearPk']['Title']}</span></div>
        	<p>
                <span class="red"> {$this->lang->words['UserPanel']['ClearPk']['RequireMoney']}</span><br /><br />
                <b>{$this->lang->words['UserPanel']['ClearPk']['Message']}</b><br /><br />
                <input type="button" class="btn" value="{$this->lang->words['UserPanel']['ClearPk']['Button']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=clearPk&amp;write=true','Command');" />
            </p>
	</div>
	<div id="Command"></div>