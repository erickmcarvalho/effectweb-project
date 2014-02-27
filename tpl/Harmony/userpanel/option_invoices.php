	<if syntax="$userpanel['payments']['auto_load_invoice']">
	<script type="text/javascript">
	$(document).ready(function(e)
	{
		if(e)
			CTM.AjaxLoad("?app=core&module=userpanel&option=invoices&section=list&showinvoice={$userpanel['invoices']['auto_load_invoice']}", 'loadSection');
	});
	</script>
    </if>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['Invoices']['Title']}</span></div>
        <div align="center">
            <input type="button" value="{$this->lang->words['UserPanel']['Invoices']['Menu']['List']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=invoices&amp;section=list','loadSection');" class="btn" />
            <input type="button" value="{$this->lang->words['UserPanel']['Invoices']['Menu']['Open']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=invoices&amp;section=open','loadSection');" class="btn" />
		</div>
    </div>
	<div id="loadSection"></div>