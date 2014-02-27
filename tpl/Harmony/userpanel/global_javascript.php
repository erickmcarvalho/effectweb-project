<script type="text/javascript">
	$(document).ready(function(e)
	{
		var VIP_NUMBER  = {const="VIP_NUMBER"};
		var PANEL_PAGE = "{$userpanel['this_option']}";
		var PANEL_OPTIONS = new Array();
		
		PANEL_OPTIONS['HOME'] = new Array();
		PANEL_OPTIONS['CHANGE_DATA'] = new Array();
		PANEL_OPTIONS['CHANGE_MAIL'] = new Array();
		PANEL_OPTIONS['CHANGE_PID'] = new Array();
		PANEL_OPTIONS['VIRTUAL_VAULT'] = new Array();
		PANEL_OPTIONS['DISCONNECT_GAME'] = new Array();
		
		PANEL_OPTIONS['CHANGE_DATA'][0] = {$userpanel['permissions']['CHANGE_DATA'][0]};
		PANEL_OPTIONS['CHANGE_MAIL'][0] = {$userpanel['permissions']['CHANGE_MAIL'][0]};
		PANEL_OPTIONS['CHANGE_PID'][0] = {$userpanel['permissions']['CHANGE_PID'][0]};
		PANEL_OPTIONS['VIRTUAL_VAULT'][0] = {$userpanel['permissions']['VIRTUAL_VAULT'][0]};
		PANEL_OPTIONS['DISCONNECT_GAME'][0] = {$userpanel['permissions']['DISCONNECT_GAME'][0]};
		
		PANEL_OPTIONS['CHANGE_DATA'][1] = {$userpanel['permissions']['CHANGE_DATA'][1]};
		PANEL_OPTIONS['CHANGE_MAIL'][1] = {$userpanel['permissions']['CHANGE_MAIL'][1]};
		PANEL_OPTIONS['CHANGE_PID'][1] = {$userpanel['permissions']['CHANGE_PID'][1]};
		PANEL_OPTIONS['VIRTUAL_VAULT'][1] = {$userpanel['permissions']['VIRTUAL_VAULT'][1]};
		PANEL_OPTIONS['DISCONNECT_GAME'][1] = {$userpanel['permissions']['DISCONNECT_GAME'][1]};
		
		<if syntax="VIP_NUMBER >= 2">
		PANEL_OPTIONS['CHANGE_DATA'][2] = {$userpanel['permissions']['CHANGE_DATA'][2]};
		PANEL_OPTIONS['CHANGE_MAIL'][2] = {$userpanel['permissions']['CHANGE_MAIL'][2]};
		PANEL_OPTIONS['CHANGE_PID'][2] = {$userpanel['permissions']['CHANGE_PID'][2]};
		PANEL_OPTIONS['VIRTUAL_VAULT'][2] = {$userpanel['permissions']['VIRTUAL_VAULT'][2]};
		PANEL_OPTIONS['DISCONNECT_GAME'][2] = {$userpanel['permissions']['DISCONNECT_GAME'][2]};
		</if>
		
		<if syntax="VIP_NUMBER >= 3">
		PANEL_OPTIONS['CHANGE_DATA'][3] = {$userpanel['permissions']['CHANGE_DATA'][3]};
		PANEL_OPTIONS['CHANGE_MAIL'][3] = {$userpanel['permissions']['CHANGE_MAIL'][3]};
		PANEL_OPTIONS['CHANGE_PID'][3] = {$userpanel['permissions']['CHANGE_PID'][3]};
		PANEL_OPTIONS['VIRTUAL_VAULT'][3] = {$userpanel['permissions']['VIRTUAL_VAULT'][3]};
		PANEL_OPTIONS['DISCONNECT_GAME'][3] = {$userpanel['permissions']['DISCONNECT_GAME'][3]};
		</if>
		
		<if syntax="VIP_NUMBER >= 4">
		PANEL_OPTIONS['CHANGE_DATA'][4] = {$userpanel['permissions']['CHANGE_DATA'][4]};
		PANEL_OPTIONS['CHANGE_MAIL'][4] = {$userpanel['permissions']['CHANGE_MAIL'][4]};
		PANEL_OPTIONS['CHANGE_PID'][4] = {$userpanel['permissions']['CHANGE_PID'][4]};
		PANEL_OPTIONS['VIRTUAL_VAULT'][4] = {$userpanel['permissions']['VIRTUAL_VAULT'][4]};
		PANEL_OPTIONS['DISCONNECT_GAME'][4] = {$userpanel['permissions']['DISCONNECT_GAME'][4]};
		</if>
		
		<if syntax="VIP_NUMBER == 5">
		PANEL_OPTIONS['CHANGE_DATA'][5] = {$userpanel['permissions']['CHANGE_DATA'][5]};
		PANEL_OPTIONS['CHANGE_MAIL'][5] = {$userpanel['permissions']['CHANGE_MAIL'][5]};
		PANEL_OPTIONS['CHANGE_PID'][5] = {$userpanel['permissions']['CHANGE_PID'][5]};
		PANEL_OPTIONS['VIRTUAL_VAULT'][5] = {$userpanel['permissions']['VIRTUAL_VAULT'][5]};
		PANEL_OPTIONS['DISCONNECT_GAME'][5] = {$userpanel['permissions']['DISCONNECT_GAME'][5]};
		</if>
		
		<if syntax="$userpanel['character']">
		PANEL_OPTIONS['RESET_SYSTEM'] = new Array();
		PANEL_OPTIONS['MASTER_RESET'] = new Array();
		PANEL_OPTIONS['TRANSFER_RESETS'] = new Array();
		PANEL_OPTIONS['CLEAR_PK'] = new Array();
		PANEL_OPTIONS['CHANGE_CLASS'] = new Array();
		PANEL_OPTIONS['CHANGE_NAME'] = new Array();
		PANEL_OPTIONS['MOVE_CHARACTER'] = new Array();
		PANEL_OPTIONS['MANAGE_PROFILE'] = new Array();
		PANEL_OPTIONS['CHANGE_AVATAR'] = new Array();
		PANEL_OPTIONS['REPAIR_POINTS'] = new Array();
		PANEL_OPTIONS['REDISTRIBUTE_POINTS'] = new Array();
		PANEL_OPTIONS['DISTRIBUTE_POINTS'] = new Array();
		PANEL_OPTIONS['CLEAR_CHARACTER'] = new Array();
		PANEL_OPTIONS['CLOSE_CHARACTER'] = new Array();
		
		PANEL_OPTIONS['RESET_SYSTEM'][0] = {$userpanel['permissions']['RESET_SYSTEM'][0]};
		PANEL_OPTIONS['MASTER_RESET'][0] = {$userpanel['permissions']['MASTER_RESET'][0]};
		PANEL_OPTIONS['TRANSFER_RESETS'][0] = {$userpanel['permissions']['TRANSFER_RESETS'][0]};
		PANEL_OPTIONS['CLEAR_PK'][0] = {$userpanel['permissions']['CLEAR_PK'][0]};
		PANEL_OPTIONS['CHANGE_CLASS'][0] = {$userpanel['permissions']['CHANGE_CLASS'][0]};
		PANEL_OPTIONS['CHANGE_NAME'][0] = {$userpanel['permissions']['CHANGE_NAME'][0]};
		PANEL_OPTIONS['MOVE_CHARACTER'][0] = {$userpanel['permissions']['MOVE_CHARACTER'][0]};
		PANEL_OPTIONS['MANAGE_PROFILE'][0] = {$userpanel['permissions']['MANAGE_PROFILE'][0]};
		PANEL_OPTIONS['CHANGE_AVATAR'][0] = {$userpanel['permissions']['CHANGE_AVATAR'][0]};
		PANEL_OPTIONS['REPAIR_POINTS'][0] = {$userpanel['permissions']['REPAIR_POINTS'][0]};
		PANEL_OPTIONS['REDISTRIBUTE_POINTS'][0] = {$userpanel['permissions']['REDISTRIBUTE_POINTS'][0]};
		PANEL_OPTIONS['DISTRIBUTE_POINTS'][0] = {$userpanel['permissions']['DISTRIBUTE_POINTS'][0]};
		PANEL_OPTIONS['CLEAR_CHARACTER'][0] = {$userpanel['permissions']['CLEAR_CHARACTER'][0]};
		
		PANEL_OPTIONS['RESET_SYSTEM'][1] = {$userpanel['permissions']['RESET_SYSTEM'][1]};
		PANEL_OPTIONS['MASTER_RESET'][1] = {$userpanel['permissions']['MASTER_RESET'][1]};
		PANEL_OPTIONS['TRANSFER_RESETS'][1] = {$userpanel['permissions']['TRANSFER_RESETS'][1]};
		PANEL_OPTIONS['CLEAR_PK'][1] = {$userpanel['permissions']['CLEAR_PK'][1]};
		PANEL_OPTIONS['CHANGE_CLASS'][1] = {$userpanel['permissions']['CHANGE_CLASS'][1]};
		PANEL_OPTIONS['CHANGE_NAME'][1] = {$userpanel['permissions']['CHANGE_NAME'][1]};
		PANEL_OPTIONS['MOVE_CHARACTER'][1] = {$userpanel['permissions']['MOVE_CHARACTER'][1]};
		PANEL_OPTIONS['MANAGE_PROFILE'][1] = {$userpanel['permissions']['MANAGE_PROFILE'][1]};
		PANEL_OPTIONS['CHANGE_AVATAR'][1] = {$userpanel['permissions']['CHANGE_AVATAR'][1]};
		PANEL_OPTIONS['REPAIR_POINTS'][1] = {$userpanel['permissions']['REPAIR_POINTS'][1]};
		PANEL_OPTIONS['REDISTRIBUTE_POINTS'][1] = {$userpanel['permissions']['REDISTRIBUTE_POINTS'][1]};
		PANEL_OPTIONS['DISTRIBUTE_POINTS'][1] = {$userpanel['permissions']['DISTRIBUTE_POINTS'][1]};
		PANEL_OPTIONS['CLEAR_CHARACTER'][1] = {$userpanel['permissions']['CLEAR_CHARACTER'][1]};
		
		<if syntax="VIP_NUMBER >= 2">
		PANEL_OPTIONS['RESET_SYSTEM'][2] = {$userpanel['permissions']['RESET_SYSTEM'][2]};
		PANEL_OPTIONS['MASTER_RESET'][2] = {$userpanel['permissions']['MASTER_RESET'][2]};
		PANEL_OPTIONS['TRANSFER_RESETS'][2] = {$userpanel['permissions']['TRANSFER_RESETS'][2]};
		PANEL_OPTIONS['CLEAR_PK'][2] = {$userpanel['permissions']['CLEAR_PK'][2]};
		PANEL_OPTIONS['CHANGE_CLASS'][2] = {$userpanel['permissions']['CHANGE_CLASS'][2]};
		PANEL_OPTIONS['CHANGE_NAME'][2] = {$userpanel['permissions']['CHANGE_NAME'][2]};
		PANEL_OPTIONS['MOVE_CHARACTER'][2] = {$userpanel['permissions']['MOVE_CHARACTER'][2]};
		PANEL_OPTIONS['MANAGE_PROFILE'][2] = {$userpanel['permissions']['MANAGE_PROFILE'][2]};
		PANEL_OPTIONS['CHANGE_AVATAR'][2] = {$userpanel['permissions']['CHANGE_AVATAR'][2]};
		PANEL_OPTIONS['REPAIR_POINTS'][2] = {$userpanel['permissions']['REPAIR_POINTS'][2]};
		PANEL_OPTIONS['REDISTRIBUTE_POINTS'][2] = {$userpanel['permissions']['REDISTRIBUTE_POINTS'][2]};
		PANEL_OPTIONS['DISTRIBUTE_POINTS'][2] = {$userpanel['permissions']['DISTRIBUTE_POINTS'][2]};
		PANEL_OPTIONS['CLEAR_CHARACTER'][2] = {$userpanel['permissions']['CLEAR_CHARACTER'][2]};
		</if>
		
		<if syntax="VIP_NUMBER >= 3">
		PANEL_OPTIONS['RESET_SYSTEM'][3] = {$userpanel['permissions']['RESET_SYSTEM'][3]};
		PANEL_OPTIONS['MASTER_RESET'][3] = {$userpanel['permissions']['MASTER_RESET'][3]};
		PANEL_OPTIONS['TRANSFER_RESETS'][3] = {$userpanel['permissions']['TRANSFER_RESETS'][3]};
		PANEL_OPTIONS['CLEAR_PK'][3] = {$userpanel['permissions']['CLEAR_PK'][3]};
		PANEL_OPTIONS['CHANGE_CLASS'][3] = {$userpanel['permissions']['CHANGE_CLASS'][3]};
		PANEL_OPTIONS['CHANGE_NAME'][3] = {$userpanel['permissions']['CHANGE_NAME'][3]};
		PANEL_OPTIONS['MOVE_CHARACTER'][3] = {$userpanel['permissions']['MOVE_CHARACTER'][3]};
		PANEL_OPTIONS['MANAGE_PROFILE'][3] = {$userpanel['permissions']['MANAGE_PROFILE'][3]};
		PANEL_OPTIONS['CHANGE_AVATAR'][3] = {$userpanel['permissions']['CHANGE_AVATAR'][3]};
		PANEL_OPTIONS['REPAIR_POINTS'][3] = {$userpanel['permissions']['REPAIR_POINTS'][3]};
		PANEL_OPTIONS['REDISTRIBUTE_POINTS'][3] = {$userpanel['permissions']['REDISTRIBUTE_POINTS'][3]};
		PANEL_OPTIONS['DISTRIBUTE_POINTS'][3] = {$userpanel['permissions']['DISTRIBUTE_POINTS'][3]};
		PANEL_OPTIONS['CLEAR_CHARACTER'][3] = {$userpanel['permissions']['CLEAR_CHARACTER'][3]};
		</if>
		
		<if syntax="VIP_NUMBER >= 4">
		PANEL_OPTIONS['RESET_SYSTEM'][4] = {$userpanel['permissions']['RESET_SYSTEM'][4]};
		PANEL_OPTIONS['MASTER_RESET'][4] = {$userpanel['permissions']['MASTER_RESET'][4]};
		PANEL_OPTIONS['TRANSFER_RESETS'][4] = {$userpanel['permissions']['TRANSFER_RESETS'][4]};
		PANEL_OPTIONS['CLEAR_PK'][4] = {$userpanel['permissions']['CLEAR_PK'][4]};
		PANEL_OPTIONS['CHANGE_CLASS'][4] = {$userpanel['permissions']['CHANGE_CLASS'][4]};
		PANEL_OPTIONS['CHANGE_NAME'][4] = {$userpanel['permissions']['CHANGE_NAME'][4]};
		PANEL_OPTIONS['MOVE_CHARACTER'][4] = {$userpanel['permissions']['MOVE_CHARACTER'][4]};
		PANEL_OPTIONS['MANAGE_PROFILE'][4] = {$userpanel['permissions']['MANAGE_PROFILE'][4]};
		PANEL_OPTIONS['CHANGE_AVATAR'][4] = {$userpanel['permissions']['CHANGE_AVATAR'][4]};
		PANEL_OPTIONS['REPAIR_POINTS'][4] = {$userpanel['permissions']['REPAIR_POINTS'][4]};
		PANEL_OPTIONS['REDISTRIBUTE_POINTS'][4] = {$userpanel['permissions']['REDISTRIBUTE_POINTS'][4]};
		PANEL_OPTIONS['DISTRIBUTE_POINTS'][4] = {$userpanel['permissions']['DISTRIBUTE_POINTS'][4]};
		PANEL_OPTIONS['CLEAR_CHARACTER'][4] = {$userpanel['permissions']['CLEAR_CHARACTER'][4]};
		</if>
		
		<if syntax="VIP_NUMBER == 5">
		PANEL_OPTIONS['RESET_SYSTEM'][5] = {$userpanel['permissions']['RESET_SYSTEM'][5]};
		PANEL_OPTIONS['MASTER_RESET'][5] = {$userpanel['permissions']['MASTER_RESET'][5]};
		PANEL_OPTIONS['TRANSFER_RESETS'][5] = {$userpanel['permissions']['TRANSFER_RESETS'][5]};
		PANEL_OPTIONS['CLEAR_PK'][5] = {$userpanel['permissions']['CLEAR_PK'][5]};
		PANEL_OPTIONS['CHANGE_CLASS'][5] = {$userpanel['permissions']['CHANGE_CLASS'][5]};
		PANEL_OPTIONS['CHANGE_NAME'][5] = {$userpanel['permissions']['CHANGE_NAME'][5]};
		PANEL_OPTIONS['MOVE_CHARACTER'][5] = {$userpanel['permissions']['MOVE_CHARACTER'][5]};
		PANEL_OPTIONS['MANAGE_PROFILE'][5] = {$userpanel['permissions']['MANAGE_PROFILE'][5]};
		PANEL_OPTIONS['CHANGE_AVATAR'][5] = {$userpanel['permissions']['CHANGE_AVATAR'][5]};
		PANEL_OPTIONS['REPAIR_POINTS'][5] = {$userpanel['permissions']['REPAIR_POINTS'][5]};
		PANEL_OPTIONS['REDISTRIBUTE_POINTS'][5] = {$userpanel['permissions']['REDISTRIBUTE_POINTS'][5]};
		PANEL_OPTIONS['DISTRIBUTE_POINTS'][5] = {$userpanel['permissions']['DISTRIBUTE_POINTS'][5]};
		PANEL_OPTIONS['CLEAR_CHARACTER'][5] = {$userpanel['permissions']['CLEAR_CHARACTER'][5]};
		</if>
		</if>
		
		$("a[rel*=panel]").click(function()
		{
			switch($(this).attr("id"))
			{
				/* Account and General */
				case "HOME" : panelLink = "home"; break;
				case "CHANGE_DATA" : panelLink = "changeData"; break;
				case "CHANGE_MAIL" : panelLink = "changeMail"; break;
				case "CHANGE_PID" : panelLink = "changePID"; break;
				case "MANAGE_CHAR" : panelLink = "manageChar"; break;
				case "VIRTUAL_VAULT" : panelLink = "virtualVault"; break;
				case "DISCONNECT_GAME" : panelLink = "disconnectGame"; break;
				/* Character */
				case "VIEW_CHARACTER" : panelLink = "viewCharacter"; break;
				case "RESET_SYSTEM" : panelLink = "resetSystem"; break;
				case "MASTER_RESET" : panelLink = "masterReset"; break;
				case "TRANSFER_RESETS" : panelLink = "transferResets"; break;
				case "CLEAR_PK" : panelLink = "clearPk"; break;
				case "CHANGE_CLASS" : panelLink = "changeClass"; break;
				case "CHANGE_NAME" : panelLink = "changeName"; break;
				case "MOVE_CHARACTER" : panelLink = "moveCharacter"; break;
				case "MANAGE_PROFILE" : panelLink = "manageProfile"; break;
				case "CHANGE_AVATAR" : panelLink = "changeAvatar"; break;
				case "REPAIR_POINTS" : panelLink = "repairPoints"; break;
				case "REDISTRIBUTE_POINTS" : panelLink = "redistributePoints"; break;
				case "DISTRIBUTE_POINTS" : panelLink = "distributePoints"; break;
				case "CLEAR_CHARACTER" : panelLink = "clearCharacter"; break;
				case "CLOSE_CHARACTER" : panelLink = "closeCharacter"; break;
				/* Support and Financial */
				case "SUPPORT_TICKETS" : panelLink = "supportTickets"; break;
				case "INVOICES" : panelLink = "invoices"; break;
				case "CONVERT_COIN" : panelLink = "convertCoin"; break;
				case "BUY_VIP" : panelLink = "buyVIP"; break;
			}
			CTM.Load("?/userpanel/"+panelLink, "PanelContent");
		});
		
		switch(PANEL_PAGE)
		{
			/* Account and General */
			case "home" : default :
				tab_number = 0;
			break;
			case "changeData" :
				tab_number = 0;
			break;
			case "changeMail" :
				tab_number = 0;
			break;
			case "changePID" :
				tab_number = 0;
			break;
			case "manageChar" :
				tab_number = 0;
			break;
			case "virtualVault" :
				tab_number = 0;
			break;
			case "disconnectGame" :
				tab_number = 0;
			break;
			/* Character */
			case "viewCharacter" :
				tab_number = 1;
			break;
			case "resetSystem" :
				tab_number = 1;
			break;
			case "masterReset" :
				tab_number = 1;
			break;
			case "transferResets" :
				tab_number = 1;
			break;
			case "clearPk" :
				tab_number = 1;
			break;
			case "changeClass" :
				tab_number = 1;
			break;
			case "changeName" :
				tab_number = 1;
			break;
			case "moveCharacter" :
				tab_number = 1;
			break;
			case "manageProfile" :
				tab_number = 1;
			break;
			case "changeAvatar" :
				tab_number = 1;
			break;
			case "repairPoints" :
				tab_number = 1;
			break;
			case "redistributePoints" :
				tab_number = 1;
			break;
			case "distributePoints" :
				tab_number = 1;
			break;
			case "clearCharacter" :
				tab_number = 1;
			break;
			case "closeCharacter" :
				tab_number = 1;
			break;
			/* Support and Financial */
			case "supportTickets" :
				tab_number = 2;
			break;
			case "invoices" :
				tab_number = 2;
			break;
			case "convertCoin" :
				tab_number = 2;
			break;
			case "buyVIP" :
				tab_number = 2;
			break;
		}
		
		for(i in PANEL_OPTIONS)
		{
			if(Object.keys(PANEL_OPTIONS[i]).length > 0)
			{
				var Text = "<span class=\"h1\">" + $("#"+i).text() + "</span><br />";
				var Yes = "<b><span style=\"color: green\">"+CTM.LANG['Words[Yes]']+"</span></b>";
				var No = "<b><span style=\"color: red\">"+CTM.LANG['Words[No]']+"</span></b>";
			
				Text += "Free: ";
				Text += (PANEL_OPTIONS[i][0] == 1) ? Yes  : No;
				Text += "<br />";
				Text += "{const='VIP_NAME_1'}: ";
				Text += (PANEL_OPTIONS[i][1] == 1) ? Yes  : No;
				Text += "<br />";
				if(VIP_NUMBER >= 2)
				{
					Text += "{const='VIP_NAME_2'}: ";
					Text += (PANEL_OPTIONS[i][2] == 1) ? Yes  : No;
					Text += "<br />";
				}
				if(VIP_NUMBER >= 3)
				{
					Text += "{const='VIP_NAME_3'}: ";
					Text += (PANEL_OPTIONS[i][3] == 1) ? Yes  : No;
					Text += "<br />";
				}
				if(VIP_NUMBER >= 4)
				{
					Text += "{const='VIP_NAME_4'}: ";
					Text += (PANEL_OPTIONS[i][4] == 1) ? Yes  : No;
					Text += "<br />";
				}
				if(VIP_NUMBER == 5)
				{
					Text += "{const='VIP_NAME_5'}: ";
					Text += (PANEL_OPTIONS[i][5] == 1) ? Yes  : No;
					Text += "<br />";
				}
				
				$("#"+i).tooltip(Text, {width: 200});
			}
		}
		
		$('#tabs').tabs({ fx: { opacity: 'toggle' }, selected: tab_number });
		
		if(e)
		{
			if(PANEL_PAGE != "home" && PANEL_PAGE != "")
			{
				//$(".optpanel").hide("slow");
				//$("#tabs").slideUp(341);
			}
			$("span.panelTitle").css('cursor', 'pointer');
			$("span.panelTitle").click(function()
			{
				if($("#tabs").is(":visible"))
				{
					//$("#tabs").fadeOut("slow");
					$("#tabs").slideUp(341);
				}
				else
				{
					//$("#tabs").fadeIn("slow");
					$("#tabs").slideDown(341);
				}
			});
		}
	});
	</script>