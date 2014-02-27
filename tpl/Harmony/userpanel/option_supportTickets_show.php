	<script type="text/javascript">
	$(function()
	{
		$("#closeTicket").click(function()
		{
			Sexy.confirm("{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Messages']['CloseWarning']}", {onComplete : function(setClose)
			{
				if(setClose)
					CTM.AjaxLoad("?app=core&module=userpanel&option=supportTickets&section=show&id={$userpanel['support_tickets']['show_ticket']['id']}&do=close",'ticketCommand');
			}});
		});
		$("#replyTicket").click(function()
		{
			if($("#ReplyMessage").val().length < 1)
				CTM.Message("{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Messages']['ReplyVoid']}", 1, "ticketCommand");
			else
				CTM.AjaxLoad("?app=core&module=userpanel&option=supportTickets&section=show&id={$userpanel['support_tickets']['show_ticket']['id']}&do=reply",'ticketCommand','replyTicketForm');
		});
	});
	</script>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Title']}</span></div>
		<table width="100%" border="0" class="tableBackColumn">
			<tr>
				<td><strong>{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Departament']}</strong></td>
				<td>{$userpanel['support_tickets']['show_ticket']['departament']}</td>
			</tr>
			<tr>
				<td><strong>{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Subject']}</strong></td>
				<td>{$userpanel['support_tickets']['show_ticket']['subject']}</td>
			</tr>
			<tr>
				<td><strong>{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Character']}</strong></td>
				<td>{$userpanel['support_tickets']['show_ticket']['character']}</td>
			</tr>
			<tr>
				<td><strong>{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Date']}</strong></td>
				<td>{$userpanel['support_tickets']['show_ticket']['date']}</td>
			</tr>
			<tr>
				<td><strong>{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Status']}</strong></td>
				<td id="ticketStatus">{$userpanel['support_tickets']['show_ticket']['status']}</td>
			</tr>
			<if syntax="$userpanel['support_tickets']['show_ticket']['annex']">
			<tr>
				<td><strong>{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Annex']}</strong></td>
				<td><a href="{$userpanel['support_tickets']['show_ticket']['annex']['link']}" target="_blank">[ {$userpanel['support_tickets']['show_ticket']['annex']['name']} ]</a></td>
			</tr>
			</if>
		</table>
		<div class="blockquote">
        	{$userpanel['support_tickets']['show_ticket']['message']}
        </div>
	</div>
    
    <if syntax="count($userpanel['support_tickets']['show_ticket']['_replies']) > 0">
    <foreach loop="$userpanel['support_tickets']['show_ticket']['_replies'] as $reply">
    <div class="box-content">
		<table width="100%" border="0" class="tableBackColumn">
			<tr>
				<td><strong>{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Replies']['Character']}</strong></td>
				<td>{$reply['author']}</td>
			</tr>
			<tr>
				<td><strong>{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Replies']['Date']}</strong></td>
				<td>{$reply['date']}</td>
			</tr>
		</table>
        <div class="blockquote">
        	{$reply['message']}
        </div>
	</div>
	</foreach>
    </if>
    
	<if syntax="$userpanel['support_tickets']['show_ticket']['_opened'] == true">
    <div id="ticketManage" class="box-content">
        <div align="center">
        	<h3>{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['ReplyTicket']}</h3>
            <form name="replyTicketForm" id="replyTicketForm" class="frm">
                <textarea name="ReplyMessage" id="ReplyMessage" rows="8" cols="60"></textarea>
            </form>
            <input type="button" value="{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Buttons']['Reply']}" id="replyTicket" class="btn" /> 
			<input type="button" value="{$this->lang->words['UserPanel']['SupportTickets']['ShowTicket']['Buttons']['Close']}" id="closeTicket" class="btn" />
		</div>
    </div>
	</if>
	<div id="ticketCommand"></div>