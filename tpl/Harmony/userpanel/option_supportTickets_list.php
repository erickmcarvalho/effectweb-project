	<script type="text/javascript">
	$(function()
	{
		$('#ticket_tabs').tabs({ fx: { opacity: 'toggle' } });
	});
	<if syntax="$userpanel['support_tickets']['auto_load_ticket']">
	$(document).ready(function(e)
	{
		if(e) showTicket("{$userpanel['support_tickets']['auto_load_ticket']}");
	});
	</if>
	function showTicket(id)
	{
		CTM.AjaxLoad('?app=core&module=userpanel&option=supportTickets&section=show&id='+id, '*showTicket');
	}
	function changeTicketStatus(id, departament, subject, date, status, tab)
	{
		$("#ticket_tabs").tabs("select", tab - 1);
		$("#ticketID_"+id).html('');
		$("#tickets_"+tab).prepend('<tr id="ticketID_'+id+'" onclick="showTicket('+id+');" style="cursor: pointer;">\
						<td>#'+id+'</td>\
						<td>'+departament+'</td>\
						<td>'+subject+'</td>\
						<td>'+date+'</td>\
						<td>'+status+'</td>\
					</tr>\n');
		$('#ticketManage').hide('slow');
		$('#ticketStatus').html(status);
	}
	</script>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Title']}</span></div>
        <br />
		<div id="ticket_tabs">
			<ul>
				<li><a href="#ticket_tabs-1">{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Tabs']['Opened']}</a></li>
				<li><a href="#ticket_tabs-2">{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Tabs']['Progress']}</a></li>
				<li><a href="#ticket_tabs-3">{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Tabs']['Closed']}</a></li>
			</ul>
			<div id="ticket_tabs-1">
            	<if syntax="count($userpanel['support_tickets']['list_tickets']['opened']) > 0">
                <table width="100%" border="0" class="tableBackColumn">
                    <thead>
                        <tr>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['ID']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['Departament']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['Subject']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['Date']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['Status']}</strong></th>
                        </tr>
                    </thead>
                    <tbody id="tickets_1">
                        <foreach loop="$userpanel['support_tickets']['list_tickets']['opened'] as $id => $ticket">
                        <tr id="ticketID_{$id}" onclick="showTicket({$id});" style="cursor: pointer;">
                            <td>#{$id}</td>
                            <td>{$ticket['departament']}</td>
                            <td>{$ticket['subject']}</td>
                            <td>{$ticket['date']}</td>
                            <td id="infoStatus">{$ticket['status']}</td>
                        </tr>
                        </foreach>
                    </tbody>
                </table>
            	<else />
            	<div class="info-box">{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Messages']['NoOpened']}</div>
            	</if>
            </div>
            
			<div id="ticket_tabs-2">
            	<if syntax="count($userpanel['support_tickets']['list_tickets']['progress']) > 0">
                <table width="100%" border="0" class="tableBackColumn">
                    <thead>
                        <tr>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['ID']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['Departament']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['Subject']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['Date']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['Status']}</strong></th>
                        </tr>
                    </thead>
                    <tbody id="tickets_2">
                        <foreach loop="$userpanel['support_tickets']['list_tickets']['progress'] as $id => $ticket">
                        <tr id="ticketID_{$id}" onclick="showTicket({$id});" style="cursor: pointer;">
                            <td>#{$id}</td>
                            <td>{$ticket['departament']}</td>
                            <td>{$ticket['subject']}</td>
                            <td>{$ticket['date']}</td>
                            <td id="infoStatus">{$ticket['status']}</td>
                        </tr>
                        </foreach>
                    </tbody>
                </table>
            	<else />
            	<div class="info-box">{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Messages']['NoProgress']}</div>
            	</if>
            </div>
			
			<div id="ticket_tabs-3">
            	<if syntax="count($userpanel['support_tickets']['list_tickets']['closed']) > 0">
                <table width="100%" border="0" class="tableBackColumn">
                    <thead>
                        <tr>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['ID']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['Departament']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['Subject']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['Date']}</strong></th>
                            <th><strong>{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Table']['Status']}</strong></th>
                        </tr>
                    </thead>
                    <tbody id="tickets_3">
                        <foreach loop="$userpanel['support_tickets']['list_tickets']['closed'] as $id => $ticket">
                        <tr id="ticketID_{$id}" onclick="showTicket({$id});" style="cursor: pointer;">
                            <td>#{$id}</td>
                            <td>{$ticket['departament']}</td>
                            <td>{$ticket['subject']}</td>
                            <td>{$ticket['date']}</td>
                            <td id="infoStatus">{$ticket['status']}</td>
                        </tr>
                        </foreach>
                    </tbody>
                </table>
            	<else />
            	<div class="info-box">{$this->lang->words['UserPanel']['SupportTickets']['ListTickets']['Messages']['NoClosed']}</div>
            	</if>
            </div>
		</div>
	</div>
    <div id="showTicket"></div>