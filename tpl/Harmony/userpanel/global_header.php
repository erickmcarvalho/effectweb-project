	{template="global_javascript"}
	<div id="boxGeneral" class="box-content">
        <div class="header"><span class="panelTitle">{$this->lang->words['UserPanel']['Global']['Title']}</span></div>
        <div id="tabs">
        	<ul>
				<li><a href="#tabs-1">{$this->lang->words['UserPanel']['Global']['Tabs'][1]}</a></li>
                <if syntax="$userpanel['character']">
				<li><a href="#tabs-2">{$this->lang->words['UserPanel']['Global']['Tabs'][2]}</a></li>
                </if>
				<li><a href="#tabs-3">{$this->lang->words['UserPanel']['Global']['Tabs'][3]}</a></li>
			</ul>
			<div id="tabs-1">
            	<ul class="optpanel">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="HOME">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['Home']}</a></li>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_DATA'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="CHANGE_DATA">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['ChangeData']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_MAIL'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="CHANGE_MAIL">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['ChangeMail']}</a></li>
                    </if>
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="CHANGE_PID">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['ChangePID']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['ACCOUNT']['VIRTUAL_VAULT'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="VIRTUAL_VAULT">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['VirtualVault']}</a></li>
                	</if>
                </ul>
        	</div>
            <if syntax="$userpanel['character']">
            <div id="tabs-2">
                <ul class="optpanel">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="VIEW_CHARACTER">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['CharSelected']} <span id="cpCharSelected">{$userpanel['character']}</span></a></li>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['RESET_SYSTEM'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="RESET_SYSTEM">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['ResetSystem']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['MASTER_RESET'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="MASTER_RESET">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['MasterReset']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['TRANSFER_RESETS'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="TRANSFER_RESETS">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['TransferResets']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_PK'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="CLEAR_PK">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['ClearPk']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_CLASS'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="CHANGE_CLASS">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['ChangeClass']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_NAME'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="CHANGE_NAME">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['ChangeName']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['MOVE_CHARACTER'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="MOVE_CHARACTER">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['MoveCharacter']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['MANAGE_PROFILE'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="MANAGE_PROFILE">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['ManageProfile']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_AVATAR'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="CHANGE_AVATAR">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['ChangeAvatar']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['REPAIR_POINTS'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="REPAIR_POINTS">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['RepairPoints']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['REDISTRIBUTE_POINTS'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="REDISTRIBUTE_POINTS">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['RedistributePoints']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['DISTRIBUTE_POINTS'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="DISTRIBUTE_POINTS">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['DistributePoints']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_CHARACTER'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="CLEAR_CHARACTER">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['ClearCharacter']}</a></li>
                    </if>
                </ul>
        	</div>
            </if>
            <div id="tabs-3">
            	<ul class="optpanel">
                	<if syntax="$this->settings['USERPANEL']['PERMISSION']['SUPPORT']['TICKETS'][0] == true">
                	<li class="focus"><a href="javascript: void(0);" rel="panel" id="SUPPORT_TICKETS">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['SupportTickets']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['FINANCIAL']['INVOICES'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="INVOICES">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['Invoices']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['FINANCIAL']['CONVERT_COIN'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="CONVERT_COIN">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['ConvertCoin']}</a></li>
                    </if>
                    <if syntax="$this->settings['USERPANEL']['PERMISSION']['FINANCIAL']['BUY_VIP'][0] == true">
                    <li class="focus"><a href="javascript: void(0);" rel="panel" id="BUY_VIP">&raquo; {$this->lang->words['UserPanel']['Global']['Menu']['BuyVIP']}</a></li>
                    </if>
                </ul>
        	</div>
        </div>
	</div>
    <div id="PanelContent">
    	{$userpanel['content']}
	</div>