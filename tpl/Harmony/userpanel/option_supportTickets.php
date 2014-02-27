	<if syntax="$userpanel['support_tickets']['auto_load_ticket']">
	<script type="text/javascript">
	$(document).ready(function(e)
	{
		if(e)
			CTM.AjaxLoad("?app=core&module=userpanel&option=supportTickets&section=list&showticket={$userpanel['support_tickets']['auto_load_ticket']}", 'loadSection');
	});
	</script>
    </if>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['SupportTickets']['Title']}</span></div>
        <div align="center">
            <input type="button" value="{$this->lang->words['UserPanel']['SupportTickets']['Menu']['List']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=supportTickets&amp;section=list','loadSection');" class="btn" />
            <input type="button" value="{$this->lang->words['UserPanel']['SupportTickets']['Menu']['Open']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=supportTickets&amp;section=open','loadSection');" class="btn" />
		</div>
    </div>
	<div id="loadSection"></div>