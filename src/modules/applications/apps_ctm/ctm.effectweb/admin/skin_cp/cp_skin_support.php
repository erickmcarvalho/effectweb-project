<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * Effect Web ACP: Application Skin
 * Last Update: 23/12/2012 - 21:55h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_ACPSkin_Support extends CTM_ACPCommand
{
	/**
	 *	Global Sidebar
	 *
	 *	@return	string	HTML String
	*/
	public function core_global_sidebar()
	{
		$CTM_HTML = NULL;
		if($this->checkPermission("modules", "effectweb_support_tickets") == true)
		{
			$CTM_HTML .= <<<HTML
<div class="box info">
                <h2>{$this->lang->words['EWSupport']['Sidebar']['Tickets']['Title']}</h2>
				<section>
					<ul>
						<li><a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=support&amp;section=tickets&amp;index=openTicket">{$this->lang->words['EWSupport']['Sidebar']['Tickets']['OpenTicket']}</a></li>
                        <li><a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=support&amp;section=tickets&amp;index=manageTickets">{$this->lang->words['EWSupport']['Sidebar']['Tickets']['ManageTickets']}</a></li>
					</ul>
				</section>
			</div>
HTML;
		}

		return $CTM_HTML;
	}
	/**
	 *	Support: Home
	 *
	 *	@return	string	HTML String
	*/
	public function support_home()
	{
		$CTM_HTML = <<<HTML
<article id="dashboard">
				<h1>{$this->lang->words['EWSupport']['Home']['Title']}</h1>
				
				<h2>{$this->lang->words['EWSupport']['Home']['Links']['Title']}</h2>
				<section class="icons">
					<ul>
						<li>
							<a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=support&amp;section=tickets">
								<img src="{$this->acp_vars['acp_url']}skin_cp/images/eleganticons/Paper.png" />
								<span>{$this->lang->words['EWSupport']['Home']['Links']['Tickets']}</span>
							</a>
						</li>
					</ul>
				</section>
HTML;

		return $CTM_HTML;
	}
	/**
	 *	Tickets: Manage Tickets
	 *
	 *	@return	string	HTML String
	*/
	public function tickets_manageTickets()
	{
		global $result_message, $all_tickets;
		
		$CTM_HTML = <<<HTML
			<script type="text/javascript">
			$(function()
			{
				$("a[rel*=Close]").click(function()
				{
					TicketId = $(this).attr("tid");
					Sexy.confirm("{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Messages']['Close']}", { onComplete : function(result)
					{
						if(result)
						{
							window.location = "{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&cmd=close&return=true&id="+TicketId;
						}
					}});
				});
				$('#datatable').dataTable(
				{
					"aaSorting": [[ 0, "desc" ],],
					'bJQueryUI': true,
					'sPaginationType': 'full_numbers',
					"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
					"oLanguage": 
					{
						"sLengthMenu": "{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['Infos']['Display']}".replace("{_MENU_}", "_MENU_"),
						"sZeroRecords": "{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['Infos']['NotResult']}",
						"sInfo": "{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['Infos']['Show']}".replace("{_START_}","_START_").replace("{_END_}","_END_").replace("{_TOTAL_}","_TOTAL_"),
						"sInfoEmpty": "{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['Infos']['Show']}".replace("{_START_}",0).replace("{_END_}",0).replace("{_TOTAL_}",0),
						"sInfoFiltered": "{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['Infos']['Filter']}".replace("{_MAX_}", "_MAX_")
					}
				});
			});
			</script>
			<article>
				<h1>{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Title']}</h1>
                {$result_message}
               
HTML;

				if(count($all_tickets) > 0)
                {
                	$CTM_HTML .= <<<HTML
                    
                	<table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
						<thead>
							<tr>
								<th>{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['Id']}</th>
								<th>{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['Subject']}</th>
								<th>{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['Departament']}</th>
								<th>{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['Account']}</th>
								<th>{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['OpenDate']}</th>
                                <th>{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['Status']}</th>
                                <th>{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Table']['Command']}</th>
							</tr>
						</thead>
						<tbody>
HTML;

					$i = 0;
                    
					foreach($all_tickets as $id => $ticket)
                    {
                    	switch($ticket['status'])
                        {
                            case 0 :
                                $ticketGrade = "gradeC";
                                $status = "<span style='color: blue;'>".$this->lang->words['EWSupport']['Tickets']['Status']['Opened']."</span>";
                            break;
                            case 1 :
                                $ticketGrade = "gradeA";
                                $status = "<span style='color: green;'>".$this->lang->words['EWSupport']['Tickets']['Status']['Responded']."</span>";
                            break;
                            case 2 :
                                $ticketGrade = "gradeU";
                                $status = "<span style='color: orange;'>".$this->lang->words['EWSupport']['Tickets']['Status']['Progress']."</span>";
                            break;
                            case 3 :
                                $ticketGrade = "gradeX";
                                $status = "<span style='color: red;'>".$this->lang->words['EWSupport']['Tickets']['Status']['Closed']."</span>";
                            break;
                        }
                        
                        $grade_type = ($i % 2) == 0 ? "odd" : "even";
                        $i++;
                        
                    	$CTM_HTML .= <<<HTML
                        
							<tr class="{$grade_type} {$ticketGrade}">
								<td><a href="{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$id}">{$id}</a></td>
								<td><a href="{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$id}">{$ticket['subject']}</a></td>
								<td>{$ticket['departament']}</td>
								<td><a href="{$this->acp_vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$ticket['account']}">{$ticket['account']}</a></td>
                                <td>{$ticket['open_date']}</td>
                                <td>{$status}</td>
								<td class="center">
									<a href="{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$id}" title="Edit"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/edit.png" alt="Edit" /></a>
									<a href="javascript: void(0);" title="Close" rel="Close" tid="{$id}"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/cross.png" alt="Delete" /></a>
                                </td>
							</tr>
HTML;
					}
                    
                    $CTM_HTML .= <<<HTML
                    
						</tbody>
					</table>
HTML;
				}
                else
                {
                	$CTM_HTML .= <<<HTML
                    
				<div class="information msg">{$this->lang->words['EWSupport']['Tickets']['ManageTickets']['Messages']['None']}</div>
HTML;
                }
                
                $CTM_HTML .= <<<HTML
                
			</article>
HTML;

		return $CTM_HTML;
	}
	/**
	 *	Tickets: View Ticket
	 *
	 *	@return	string	HTML String
	*/
	public function tickets_viewTicket()
	{
		global $result_message, $view_ticket;
        
        switch($view_ticket['status'])
		{
			case 0 : 
				$status = "<span style='color: blue;'>".$this->lang->words['EWSupport']['Tickets']['Status']['Opened']."</span>";
			break;
			case 1 : 
				$status = "<span style='color: green;'>".$this->lang->words['EWSupport']['Tickets']['Status']['Responded']."</span>";
			break;
			case 2 : 
				$status = "<span style='color: orange;'>".$this->lang->words['EWSupport']['Tickets']['Status']['Progress']."</span>";
			break;
			case 3 : 
				$status = "<span style='color: red;'>".$this->lang->words['EWSupport']['Tickets']['Status']['Closed']."</span>";
			break;
		}
		
		$CTM_HTML = <<<HTML
            <script type="text/javascript">
            $(function()
            {
                $("#AccountLink").click(function()
                {
                    window.location = "{$this->acp_vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$view_ticket['account']}";
                });
                
                $("#closeTicket").click(function()
                {
                    Sexy.confirm("<strong>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Messages']['Confirm']['Close']}</strong>", {onComplete : function(confirm)
                    {
                        if(confirm)
                            CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$view_ticket['id']}&cmd=close", "ResultCommand");
                    }});
                });
                
                $("#replyTicket").click(function()
                {
                    if($("#ReplyText").val().length < 1)
                        Sexy.alert("{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['ReplyTicket']['Messages']['FieldVoid']}");
                    else
                        CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$view_ticket['id']}&cmd=reply", "ResultCommand", "ReplyTicketForm");
                });
                
                $("#editTicket").click(function()
                {
                	if(ticketInEditing == false)
                    {
                    	ticketInEditing = true;
                        departaments = "";
                        status = "";
                        
                        for(i in ticketDepartaments)
                        {
                            selected = ticketDepartament == i ? " selected=\"selected\"" : "";
                            departaments += "<option value=\""+i+"\""+selected+">"+ticketDepartaments[i]+"</option>\\n";
                        }
                        
                        status = '<select name="Status" id="Status">\\n';
                        status += "<option value=\"0\""+(ticketStatus == 0 ? " selected=\"selected\"" : "")+">{$this->lang->words['EWSupport']['Tickets']['Status']['Opened']}</option>\\n";
                        status += "<option value=\"1\""+(ticketStatus == 1 ? " selected=\"selected\"" : "")+">{$this->lang->words['EWSupport']['Tickets']['Status']['Responded']}</option>\\n";
                        status += "<option value=\"2\""+(ticketStatus == 2 ? " selected=\"selected\"" : "")+">{$this->lang->words['EWSupport']['Tickets']['Status']['Progress']}</option>\\n";
                        status += "<option value=\"3\""+(ticketStatus == 3 ? " selected=\"selected\"" : "")+">{$this->lang->words['EWSupport']['Tickets']['Status']['Closed']}</option>\\n";
                        status += "</select>";
                        
                        messageField = '<textarea id="Message" name="Message" class="big" rows="15" cols="70">'+$("#ticketMessage").html()+'</textarea>\\n';
                        messageField += "<p>\\n";
                        messageField += "<button type=\"button\" onclick=\"sendEditTicketCommand();\" class=\"button\">{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['EditTicket']['Button']}</button>\\n";
                        messageField += "</p>";
                        
                        $("#ticketSubject").html('<input type="text" id="Subject" name="Subject" value="'+$("#ticketSubject").html()+'" class="medium" />');
                        $("#ticketDepartament").html('<select name="Departament" id="Departament">\\n'+departaments+'</select>');
                        $("#ticketStatus").html(status);
                        $("#ticketMessage").html(messageField);
                        $("#Message").wysiwyg();
                        
                        CTM.Scroll("ticketBody");
                        //CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$view_ticket['id']}&cmd=editTicket", "editResult");
                	}
                });
HTML;

		if(DELETE_TICKET_ACCESS == TRUE)
		{
			$CTM_HTML .= <<<HTML
                
                $("#deleteTicket").click(function()
                {
                    Sexy.confirm("<strong>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Messages']['Confirm']['Delete']}</strong>", {onComplete : function(confirm)
                    {
                        if(confirm)
                            CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$view_ticket['id']}&cmd=delete", "ResultCommand");
                    }});
                });
HTML;
		}
            
		$CTM_HTML .= <<<HTML
            
                $("a[rel*=editReply]").click(function()
                {
                    /*$.fancybox(
                    {
                        ajax :
                        {
                            type : "GET",
                            data : "fancybox=true&id={$view_ticket['id']}&rid="+$(this).attr("id")
                        },
                        href : "{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&cmd=editReply",
                    });*/
                    id = $(this).attr("id");
                    CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$view_ticket['id']}&cmd=editReply&rid="+id, "replyId-"+id+" .replyMessage");
                });
                $("a[rel*=deleteReply]").click(function()
                {
                    id = $(this).attr("id");
                    
                    Sexy.confirm("<strong>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Messages']['Confirm']['DeleteReply']}</strong>", {onComplete : function(confirm)
                    {
                        if(confirm)
                        {
                            CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$view_ticket['id']}&cmd=deleteReply&rid="+id, "ResultCommand");
                        }
                    }});
                });
            });
            
            function closeThisTicket()
            {
                $("#ticketStatus").html("<span style='color: red;'>{$this->lang->words['EWSupport']['Tickets']['Status']['Closed']}</span>");
                $("#ResultCommand").html("<div class='success msg'>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['CloseTicket']['Messages']['Success']}</div>");
                
                ticketStatus = 3;
            }
            
            function addReplyTicket(message, author, sendDate, id)
            {
                var data = "<li id=\"replyId-"+id+"\" style=\"display:none\">\
                                            <div class=\"comment-body clearfix\">\
                                                <img class=\"comment-avatar\" src=\"{$this->acp_vars['acp_url']}skin_cp/images/avatars/team.png\" />\
                                                <a href=\"#\">"+author+"</a> - <font color=\"blue\">Staff</font>:\
                                                <div class=\"replyMessage\">"+message+"</div>\
                                            </div>\
                                            <div class=\"links\">\
                                                <span class=\"date\">"+sendDate+"</span>\
                                                <a href=\"javascript: void(0);\" class=\"reply\" onclick=\"editOrDeleteReply(1,"+id+");\">{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Replies']['Edit']}</a>\
                                                <a href=\"javascript: void(0);\" class=\"delete\" onclick=\"editOrDeleteReply(2,"+id+");\">{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Replies']['Delete']}</a>\
                                            </div>\
                                        </li>";
                $("#tickerReplies").append(data);
                $("#replyId-"+id).show("slow", function()
                {
                    CTM.Scroll("replyId-"+id);
                });
                $("#ticketStatus").html("<span style='color: green;'>{$this->lang->words['EWSupport']['Tickets']['Status']['Responded']}</span>");
            }
            
            function editTicketReply(message, id)
            {
                $.fancybox.close();
                
                $("#replyId-"+id+" .replyMessage").fadeOut("slow", function()
                {
                    $("#replyId-"+id+" .replyMessage").html(message);
                });
                $("#replyId-"+id+" .replyMessage").fadeIn("slow");
            }
            
            function editOrDeleteReply(command, id)
            {
                if(command == 1) 
                {
                    /*$.fancybox(
                    {
                        ajax :
                        {
                            type : "GET",
                            data : "fancybox=true&id={$view_ticket['id']}&rid="+$(this).attr("id")
                        },
                        href : "{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&cmd=editReply",
                    });*/
                    CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$view_ticket['id']}&cmd=editReply&rid="+id, "replyId-"+id+" .replyMessage");
                }
                if(command == 2)
                {
                    Sexy.confirm("<strong>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Messages']['Confirm']['DeleteReply']}</strong>", {onComplete : function(confirm)
                    {
                        if(confirm)
                        {
                            CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$view_ticket['id']}&cmd=deleteReply&rid="+id, "ResultCommand");
                        }
                    }});
                }
            }
HTML;

		if(EDIT_TICKETS_ACCESS == TRUE)
        {
        	$CTM_HTML .= <<<HTML
            		
            function completeEditTicket(newSubject, newDepartament, newStatus, newMessage)
            {
                $("#ticketSubject").html(newSubject);
                $("#ticketDepartament").html(newDepartament);
                $("#ticketStatus").html(newStatus);
                $("#ticketMessage").html(newMessage);
                
                ticketInEditing = false;
            }
            
            function sendEditTicketCommand()
            {
                CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$view_ticket['id']}&cmd=edit", "ResultCommand", "ticketEdit");
            }
HTML;
		}
            
		$CTM_HTML .= <<<HTML
        
            var ticketDepartament = {$view_ticket['departament']['id']};
            var ticketStatus = {$view_ticket['status']};
            var ticketDepartaments = new Array();
            var ticketInEditing = false;
HTML;

		foreach($this->settings['USERPANEL']['SUPPORT']['TICKETS']['DEPARTAMENTS'] as $id => $title)
        {
        	$CTM_HTML .= <<<HTML
            
            ticketDepartaments[{$id}] = "{$title}";
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        
            </script>
			<article>
				<h1>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Title']} #{$view_ticket['id']}</h1>
                <div id="ResultCommand"></div>
HTML;

		if(EDIT_TICKET_ACCESS == TRUE)
        {
        	$CTM_HTML .= <<<HTML
            
            			<form name="ticketEdit" id="ticketEdit" class="uniform">
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        
                        <table width="100%" border="0" class="gtable">
                            <thead>
                                <th id="ticketBody">{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Table']['Details']}</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Table']['Subject']}</td>
                                    <td id="ticketSubject">{$view_ticket['subject']}</td>
                                </tr>
                                <tr>
                                    <td>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Table']['Departament']}</td>
                                    <td id="ticketDepartament">{$view_ticket['departament']['title']}</td>
                                </tr>
                                <tr>
                                    <td>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Table']['Protocol']}</td>
                                    <td>{$view_ticket['protocol']}</td>
                                </tr>
                                <tr>
                                    <td>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Table']['Open_Date']}</td>
                                    <td>{$view_ticket['open_date']}</td>
                                </tr>
                                <tr>
                                    <td>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Table']['Account']}</td>
                                    <td><a href="javascript: void(0);" id="AccountLink">{$view_ticket['account']}</a></td>
                                </tr>
                                <tr>
                                    <td>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Table']['Status']}</td>
                                    <td id="ticketStatus">{$status}</td>
                                </tr>
HTML;

		if(!empty($view_ticket['annex']))
        {
        	$CTM_HTML .= <<<HTML
            
                                <tr>
                                    <td>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Table']['Annex']}</td>
                                    <td><a href="{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$view_ticket['id']}&cmd=annex" target="_blank">{$view_ticket['annex']}</a></td>
                                </tr>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                            </tbody>
                        </table>
                        <table width="100%" border="0" class="gtable">
                            <thead>
                                <th>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Table']['Message']}</th>
                            </thead>
                            <tbody>
                            	<tr>
                                	<td id="ticketMessage">{$view_ticket['message']}</td>
                                </tr>
                            </tbody>
                        </table>
HTML;

		if(EDIT_TICKETS_ACCESS == TRUE)
        {
        	$CTM_HTML .= <<<HTML
            			</form>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        
                        <table width="100%" border="0" class="gtable">
                            <thead>
                                <th>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Replies']['Title']}</th>
                            </thead>
                        </table>
                        <ul class="comments" id="tickerReplies">
HTML;

		if(count($view_ticket['replies']) > 0)
        {
        	foreach($view_ticket['replies'] as $id => $reply)
            {
            	$avatar = $reply['is_team'] == true ? "team" : "player";
                $type = $reply['is_team'] == true ? "<font color=\"blue\">Staff</font>" : "<font color=\"red\">Player</font>";
                
            	$CTM_HTML .= <<<HTML

                            <li id="replyId-{$id}">
                                <div class="comment-body clearfix">
                                    <img class="comment-avatar" src="{$this->acp_vars['acp_url']}skin_cp/images/avatars/{$avatar}.png" />
                                    <a href="#">{$reply['author']}</a> - {$type}:
                                    <div class="replyMessage">{$reply['message']}</div>
                                </div>
                                <div class="links">
                                    <span class="date">{$reply['send_date']}</span>


                                    <a href="javascript: void(0);" class="reply" rel="editReply" id="{$id}">{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Replies']['Edit']}</a>
                                    <a href="javascript: void(0);" class="delete" rel="deleteReply" id="{$id}">{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Replies']['Delete']}</a>
                                </div>
                            </li>
HTML;
            }
		}
        
        $CTM_HTML .= <<<HTML

                        </ul>
                        <table width="100%" border="0" class="gtable">
                            <thead>
                                <th>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Manage']['Title']}</th>
                            </thead>
                        </table>
                         <form name="ReplyTicketForm" id="ReplyTicketForm" class="uniform">
							<fieldset>
                            	<legend>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['ReplyTicket']['Title']}</legend>
                            	<dl>
									<dd><textarea id="ReplyText" name="ReplyText" set="htmlEditor" class="big" rows="15"></textarea></dd>
								</dl>
								<p>
									<button type="button" id="replyTicket" class="button">{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['ReplyTicket']['Button']}</button>
								</p>
							</fieldset>
						</form>
                        <form name="ticketOptions" id="ticketOptions" class="uniform">
                        	<fieldset>
                        		<legend>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Manage']['Options']}</legend>
                        		<section>
									<button type="button" id="closeTicket" class="button red">{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Manage']['CloseTicket']}</button>
HTML;
		if(EDIT_TICKET_ACCESS == TRUE)
        {
        	$CTM_HTML .= <<<HTML
            
									<button type="button" id="editTicket" class="button white">{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Manage']['EditTicket']}</button>
HTML;
		}

		if(DELETE_TICKET_ACCESS == TRUE)
        {
        	$CTM_HTML .= <<<HTML
            
                            		<button type="button" id="deleteTicket" class="button black">{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['Manage']['DeleteTicket']}</button>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
								</section>
                    		</fieldset>
                        </form>
			</article>
HTML;

		return $CTM_HTML;
	}
    /**
	 *	Tickets: View Ticket - Edit Reply Form
	 *
	 *	@return	string	HTML String
	*/
	public function tickets_viewTicket_editReply()
	{
		global $edit_reply;
		
        $CTM_HTML = <<<HTML
<script type="text/javascript">
$(function()
{
	$("#EditReplyNow-{$edit_reply['reply_id']}").click(function()
	{
		if($("#ReplyMessage-{$edit_reply['reply_id']}").val().length < 1)
			Sexy.alert("{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['EditReply']['Messages']['FieldsVoid']}");
		else
			CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=effectweb&module=support&section=tickets&do=view&id={$edit_reply['ticket_id']}&cmd=editReply&rid={$edit_reply['reply_id']}&write=true", "ResultCommand", "EditReply-{$edit_reply['reply_id']}");
	});
	$("#EditReplyCancel-{$edit_reply['reply_id']}").click(function()
	{
		editTicketReply('{$edit_reply['reply_message']}', {$edit_reply['reply_id']});
	});
    
    $("#ReplyMessage-{$edit_reply['reply_id']}").wysiwyg();
});
</script>
	<form name="EditReply-{$edit_reply['reply_id']}" id="EditReply-{$edit_reply['reply_id']}" class="uniform">
		<fieldset>
			<legend>{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['EditReply']['Title']}</legend>
			<dl>
				<dd><textarea id="ReplyMessage-{$edit_reply['reply_id']}" name="ReplyMessage" class="big" rows="15" cols="70">{$edit_reply['reply_message']}</textarea></dd>
			</dl>
			<p>
				<button type="button" id="EditReplyNow-{$edit_reply['reply_id']}" class="button">{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['EditReply']['Button']}</button>
                <button type="button" id="EditReplyCancel-{$edit_reply['reply_id']}" class="button">{$this->lang->words['EWSupport']['Tickets']['ViewTicket']['EditReply']['Cancel']}</button>
			</p>
		</fieldset>
	</form>
HTML;

		return $CTM_HTML;
	}
    /**
     *	Polls: Add Poll
     *
     *	@return	string	HTML String
    */
    public function polls_addPoll()
    {
    	global $result_command;
        
        $answer_count = $_POST['answerCount'] >= 2 ? $_POST['answerCount'] : 2;
        
        $CTM_HTML .= <<<HTML
			<script type="text/javascript">
			var answerInput = "<div style=\"display: none;\" id=\"AnswerFade_{answerNumber}\">\
											<dt><label for=\"Answer_{answerNumber}\">{$this->lang->words['EWMain']['Polls']['AddPoll']['FieldAnswer']} {answerNumber}</label></dt>\
											<dd><input type=\"text\" id=\"Answer_{answerNumber}\" name=\"Answer_{answerNumber}\" class=\"medium\" /></dd>\
										</div>";
			$(function()
			{
				answerCount = {$answer_count};
				$("#addAnswers").click(function()
				{
					Sexy.prompt("{$this->lang->words['EWMain']['Polls']['AddPoll']['Messages']['AddAnswer']}", {}, { "input" : 1, "textBoxBtnOk" : "{$this->lang->words['EWMain']['Polls']['AddPoll']['Buttons']['AddAnswer']['Add']}", "textBoxBtnCancel" : "{$this->lang->words['EWMain']['Polls']['AddPoll']['Buttons']['AddAnswer']['Cancel']}", "onComplete" : 
					function(returnvalue)
					{
						if(returnvalue)
						{
							if(!isNaN(returnvalue) && returnvalue > 0)
							{
								for(i = 1; i <= returnvalue; i++)
								{
									send = answerInput.replace(/{answerNumber}/gi, answerCount + 1);
									$("#pollAnswers").append(send);
									$("#AnswerFade_"+(answerCount + 1)).show("slow");
									$("#answerCount").val(++answerCount);
								}
							}
						}
					}});
				});
			});
			</script>
			<article>
				<h1>{$this->lang->words['EWMain']['Polls']['AddPoll']['Title']}</h1>
                {$result_command}
				
				<form name="addPoll" id="addPoll" action="{$this->vars['acp_url']}?app=effectweb&amp;module=main&amp;section=polls&amp;index=addPoll&amp;write=true" method="post">
                    <input type="hidden" name="answerCount" id="answerCount" value="{$answer_count}" />
                    <fieldset>
                    	<legend>{$this->lang->words['EWMain']['Polls']['AddPoll']['Settings']}</legend>
                    	<dl>
							<dt><label for="fieldQuestion">{$this->lang->words['EWMain']['Polls']['AddPoll']['FieldQuestion']}</label></dt>
							<dd><input type="text" id="fieldQuestion" name="fieldQuestion" value="{$_POST['fieldQuestion']}" class="medium" /></dd>
                        
                        	<dt><label for="expiration">{$this->lang->words['EWMain']['Polls']['AddPoll']['FieldDate']}</label></dt>
							<dd><input type="text" id="expiration" name="expiration" readonly="readonly" value="{$_POST['expiration']}" maxlength="10" class="small" set="dateSet" /></dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                    	<legend>{$this->lang->words['EWMain']['Polls']['AddPoll']['Answers']} <a href="javascript: void(0);" id="addAnswers">[ {$this->lang->words['EWMain']['Polls']['AddPoll']['AddAnswers']} ]</a></legend>
                    	<dl id="pollAnswers">
HTML;
		for($i = 1; $i <= $answer_count; $i++)
        {
        	$value = $_POST['Answer_'.$i];
        	$CTM_HTML .= <<<HTML
                        	<dt><label for="Answer_{$i}">{$this->lang->words['EWMain']['Polls']['AddPoll']['FieldAnswer']} {$i}</label></dt>
							<dd><input type="text" id="Answer_{$i}" name="Answer_{$i}" value="{$value}" class="medium" /></dd>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
						</dl>
                    </fieldset>
					<p>
						<button type="submit" class="button">{$this->lang->words['EWMain']['Polls']['AddPoll']['Buttons']['Submit']}</button>
					</p>
				</form>
			</article>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	Polls: Manage Poll
	 *
	 *	@return	string	HTML String
	*/
	public function polls_managePolls()
	{
		global $poll_list, $result_command;
		
		$CTM_HTML = NULL;
		
		if(count($poll_list) > 0)
        {
			$CTM_HTML .= <<<HTML
			<script type="text/javascript">
			$(function()
			{
				$("#DeletePollsButton").click(function()
				{
					Sexy.confirm("{$this->lang->words['EWMain']['Polls']['ManagePolls']['Messages']['ConfirmDelete']}", { onComplete : function(result)
					{
						if(result)
						{
							$("#DeletePollsForm").submit();
						}
					}});
				});
				$("#AddNewPoll").click(function()
				{
					window.location = "{$this->vars['acp_url']}?app=effectweb&module=main&section=polls&index=addPoll";
				});
			});
            </script>
HTML;
		}
        
		$CTM_HTML .= <<<HTML
			<article>
				<h1>{$this->lang->words['EWMain']['Polls']['ManagePolls']['Title']}</h1>
                {$result_command}
HTML;
		if(count($poll_list) > 0)
        {
        	$CTM_HTML .= <<<HTML
                <form name="DeletePollsForm" id="DeletePollsForm" method="post" action="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=main&amp;section=polls&amp;index=managePolls&amp;do=deletePolls">
					<table id="table1" class="gtable sortable">
						<thead>
							<tr>
								<th><input type="checkbox" class="checkall" /></th>
								<th>{$this->lang->words['EWMain']['Polls']['ManagePolls']['Table']['Question']}</th>
								<th>{$this->lang->words['EWMain']['Polls']['ManagePolls']['Table']['BeginDate']}</th>
								<th>{$this->lang->words['EWMain']['Polls']['ManagePolls']['Table']['EndDate']}</th>
                                <th>{$this->lang->words['EWMain']['Polls']['ManagePolls']['Table']['Status']}</th>
							</tr>
						</thead>
						<tbody>
HTML;
			foreach($poll_list as $id => $poll)
            {
            	$CTM_HTML .= <<<HTML
							<tr>
								<td><input type="checkbox" name="poll__{$id}" id="poll__{$id}" value="1" /></td>
								<td><a href="{$this->vars['acp_url']}?app=effectweb&amp;module=main&amp;section=polls&amp;index=editPoll&amp;id={$id}">{$poll['question']}</a></td>
								<td>{$poll['begin_date']}</td>
								<td>{$poll['end_date']}</td>
                                <td>{$poll['status']}</td>
							</tr>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
						</tbody>
					</table>
					<div class="tablefooter clearfix">
						<div class="actions">
                        	<p>
                                <button type="button" id="DeletePollsButton" class="button small">{$this->lang->words['EWMain']['Polls']['ManagePolls']['Table']['DeletePolls']}</button>
                                <button type="button" id="AddNewPoll" class="button small">{$this->lang->words['EWMain']['Polls']['ManagePolls']['Table']['AddNewPoll']}</button>
							</p>
                        </div>
					</div>
				</form>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            	<div class="information msg">{$this->lang->words['EWMain']['Polls']['ManagePolls']['Messages']['NoPolls']}</div>
HTML;
        }
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;
	
    	return $CTM_HTML;
    }
    /**
     *	Polls: Edit Poll
     *
     *	@return	string	HTML String
    */
    public function polls_editPoll()
    {
    	global $edit_poll, $poll_exists, $result_command;
        
        $CTM_HTML = NULL;
        
        if($poll_exists == true)
        {
        	$poll_question = $_GET['write'] == true ? $_POST['fieldQuestion'] : $edit_poll['question'];
        	$poll_expiration = $_GET['write'] == true ? $_POST['expiration'] : $edit_poll['end_date'];
        
        	$status_yes = ($_GET['write'] == true ? $_POST['PollStatus'] == 0 : $edit_poll['status'] == 0) ? " checked=\"checked\"" : NULL;
        	$status_no = ($_GET['write'] == true ? $_POST['PollStatus'] == 1 : $edit_poll['status'] == 1) ? " checked=\"checked\"" : NULL;
        
        	$answer_count = $_POST['answerCount'] >= $edit_poll['answer_after_count'] ? $_POST['answerCount'] : $edit_poll['answer_after_count'];
            
        	$CTM_HTML .= <<<HTML
			<script type="text/javascript">
			var answerInput = "<div style=\"display: none;\" id=\"AnswerFade_{answerNumber}\">\
											<dt><label for=\"Answer_{answerNumber}\">{$this->lang->words['EWMain']['Polls']['AddPoll']['FieldAnswer']} {answerNumber}</label></dt>\
											<dd>\
												<input type=\"text\" id=\"Answer_{answerNumber}\" name=\"Answer_{answerNumber}\" class=\"medium\" />\
												<input type=\"text\" id=\"VotesAnswers_{answerNumber}\" name=\"VotesAnswers_{answerNumber}\" value=\"0\" size=\"5\" onkeypress=\"return CTM.NumbersOnly(event);\" />\
											</dd>\
										</div>";
			$(function()
			{
				answerCount = {$answer_count};
				$("#addAnswers").click(function()
				{
					Sexy.prompt("{$this->lang->words['EWMain']['Polls']['EditPoll']['Messages']['AddAnswer']}", {}, { "input" : 1, "textBoxBtnOk" : "{$this->lang->words['EWMain']['Polls']['AddPoll']['Buttons']['AddAnswer']['Add']}", "textBoxBtnCancel" : "{$this->lang->words['EWMain']['Polls']['EditPoll']['Buttons']['AddAnswer']['Cancel']}", "onComplete" : 
					function(returnvalue)
					{
						if(returnvalue)
						{
							if(!isNaN(returnvalue) && returnvalue > 0)
							{
								for(i = 1; i <= returnvalue; i++)
								{
									send = answerInput.replace(/{answerNumber}/gi, answerCount + 1);
									$("#pollAnswers").append(send);
									$("#AnswerFade_"+(answerCount + 1)).show("slow");
									$("#answerCount").val(++answerCount);
								}
							}
						}
					}});
				});
			});
			</script>
HTML;
		}

		$CTM_HTML .= <<<HTML
			<article>
				<h1>{$this->lang->words['EWMain']['Polls']['EditPoll']['Title']}</h1>
                {$result_command}

HTML;

		if($poll_exists == true)
        {
        	$CTM_HTML .= <<<HTML
				<form name="editPoll" id="editPoll" action="{$this->vars['acp_url']}?app=effectweb&amp;module=main&amp;section=polls&amp;index=editPoll&amp;id={$_GET['id']}&amp;write=true" method="post">
                    <input type="hidden" name="answerCount" id="answerCount" value="{$answer_count}" />
                    <input type="hidden" name="answerAfterCount" id="answerAfterCount" value="{$edit_poll['answer_after_count']}" />
                    <fieldset>
                    	<legend>{$this->lang->words['EWMain']['Polls']['EditPoll']['Settings']}</legend>
                    	<dl>
							<dt><label for="fieldQuestion">{$this->lang->words['EWMain']['Polls']['EditPoll']['FieldQuestion']}</label></dt>
							<dd><input type="text" id="fieldQuestion" name="fieldQuestion" value="{$poll_question}" class="medium" /></dd>
                        
                        	<dt><label for="expiration">{$this->lang->words['EWMain']['Polls']['EditPoll']['FieldDate']}</label></dt>
							<dd><input type="text" id="expiration" name="expiration" readonly="readonly" value="{$poll_expiration}" maxlength="10" class="small" set="dateSet" /></dd>
                            
                            <dt><label for="PollStatus">{$this->lang->words['EWMain']['Polls']['EditPoll']['FieldStatus']}</label></dt>
							<dd>
                        		<span class="yesno_yes"><input type="radio" name="PollStatus" id="PollStatus_YES" value="0"{$status_yes} />
									<label for="PollStatus_YES">{$this->lang->words['Words']['Opened']}</label></span><span class="yesno_no">
									<input type="radio" name="PollStatus" id="PollStatus_NO" value="1"{$status_no} />
									<label for="PollStatus_NO">{$this->lang->words['Words']['Closed']}</label>
								</span>
							</dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                    	<legend>{$this->lang->words['EWMain']['Polls']['EditPoll']['Answers']} <a href="javascript: void(0);" id="addAnswers">[ {$this->lang->words['EWMain']['Polls']['EditPoll']['AddAnswers']} ]</a></legend>
                    	<dl id="pollAnswers">
HTML;

		for($i = 1; $i <= $answer_count; $i++)
        {
        	$value = $_GET['write'] == true ? $_POST['Answer_'.$i] : $edit_poll['answers'][$i]['answer'];
            $votes = $_GET['write'] == true ? $_POST['VotesAnswers_'.$i] : $edit_poll['answers'][$i]['votes'];
           
        	$CTM_HTML .= <<<HTML
            				<input type="hidden" id="IdAnswer_{$i}" name="IdAnswer_{$i}" value="{$edit_poll['answers'][$i]['id']}" />
                        	<dt><label for="Answer_{$i}">{$this->lang->words['EWMain']['Polls']['EditPoll']['FieldAnswer']} {$i}</label></dt>
							<dd>
                            	<input type="text" id="Answer_{$i}" name="Answer_{$i}" value="{$value}" class="medium" />
                                <input type="text" id="VotesAnswers_{$i}" name="VotesAnswers_{$i}" value="{$votes}" size="5" onkeypress="return CTM.NumbersOnly(event);" />
                            </dd>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
						</dl>
                    </fieldset>
					<p>
						<button type="submit" class="button">{$this->lang->words['EWMain']['Polls']['EditPoll']['Buttons']['Submit']}</button>
					</p>
				</form>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            	<div class="information msg">{$this->lang->words['EWMain']['Polls']['EditPoll']['Messages']['NoExists']}</div>
HTML;
        }
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;

		return $CTM_HTML;
    }
}

$callSkinCache = new CTM_ACPSkin_Support();
$callSkinCache->registry();