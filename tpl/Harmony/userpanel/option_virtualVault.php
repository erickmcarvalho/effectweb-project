    <link href="{%PUBLIC_DIRECTORY%}/styles/MuItemData.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript">
    var items = new Array();
    $(document).ready(function()
    {
        <if syntax="count($userpanel['virtual_vault']['game_vault_items']) > 0">
        <foreach loop="$userpanel['virtual_vault']['game_vault_items'] as $item">
        //---------------------------------------------------------------------------------------------------------------------------------
        items['{$item['serial']}'] = "<div id='itemDetails'>\
        <h2 class='{$item['tooltip']['set_item']}'>{$item['name']}</h2>\
        <p class='info'>{$item['tooltip']['begin']}</p>\
        {$item['tooltip']['requirement']}\
        {$item['tooltip']['class_use']}\
        <br />\
        {$item['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$item['tooltip']['options']}\
        </p>\
        {$item['tooltip']['socket']}</div>";
        $('#itemVault_{$item['serial']}').tooltip(items['{$item['serial']}'], { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
        </foreach>
        </if>
		
		<if syntax="count($userpanel['virtual_vault']['virtual_vault_items']) > 0">
        <foreach loop="$userpanel['virtual_vault']['virtual_vault_items'] as $item">
        //---------------------------------------------------------------------------------------------------------------------------------
        items['{$item['serial']}'] = "<div id='itemDetails'>\
        <h2 class='{$item['tooltip']['set_item']}'>{$item['name']}</h2>\
        <p class='info'>{$item['tooltip']['begin']}</p>\
        {$item['tooltip']['requirement']}\
        {$item['tooltip']['class_use']}\
        <br />\
        {$item['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$item['tooltip']['options']}\
        </p>\
        {$item['tooltip']['socket']}</div>";
        $('#itemVirtual_{$item['serial']}').tooltip(items['{$item['serial']}'], { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
        </foreach>
        </if>
    });
    <if syntax="$this->settings['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['INSERT_ITEM'] == true">
    function transferItemVault(itemSerial)
    {
        itemName = $("#itemVault_"+itemSerial).text();
            
        $("#itemVault_"+itemSerial).fadeOut("slow", function()
        {
            $(this).html("");
            
            $("#itemsVirtualVault").prepend("<li id=\"itemVirtual_"+itemSerial+"\" onclick=\"commandTransferVirtual('"+itemSerial+"');\" style=\"display:none;\">"+itemName+"</li>");
            $("#itemVirtual_"+itemSerial).tooltip(items[itemSerial], { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
			$("#itemVirtual_"+itemSerial).fadeIn("slow");
        });
    }
    </if>
    function transferItemVirtual(itemSerial)
    {
        itemName = $("#itemVirtual_"+itemSerial).text();
            
        $("#itemVirtual_"+itemSerial).fadeOut("slow", function()
        {
            $(this).html("");
            
            $("#itemsVault").prepend("<li id=\"itemVault_"+itemSerial+"\" onclick=\"commandTransferVault('"+itemSerial+"');\" style=\"display:none;\">"+itemName+"</li>");
            $("#itemVault_"+itemSerial).tooltip(items[itemSerial], { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
			$("#itemVault_"+itemSerial).fadeIn("slow");
        });
    }
    <if syntax="$this->settings['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['INSERT_ITEM'] == true">
    function commandTransferVault(itemSerial)
    {
        CTM.AjaxLoad("?app=core&module=userpanel&option=virtualVault&do=transferToVirtual&itemSerial="+itemSerial, "loadCommand");
    }
    </if>
    function commandTransferVirtual(itemSerial)
    {
        CTM.AjaxLoad("?app=core&module=userpanel&option=virtualVault&do=transferToVault&itemSerial="+itemSerial, "loadCommand");
    }
    </script>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['VirtualVault']['Title']}</span></div>
        <if syntax="$this->settings['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['INSERT_ITEM'] == false">
    	<p>{$this->lang->words['UserPanel']['VirtualVault']['OnlyRetire']}</p>
    	</if>
    </div>
    <div id="loadCommand"></div>
    <div class="box-content">
    	<table width="100%" border="0">
        	<tr>
            	<td>
                    <div id="itemDetailsBox">
                        <table>
                            <tr>
                                <td style="margin: 0px; padding: 0px;">
                                    <div class="vaultBox">
                                        <div id="vaultName">{$this->lang->words['UserPanel']['VirtualVault']['GameVault']}</div>
                                        <ul id="itemsVault" class="items">
                                        <if syntax="count($userpanel['virtual_vault']['game_vault_items']) > 0">
										<foreach loop="$userpanel['virtual_vault']['game_vault_items'] as $item">
                                            <if syntax="$this->settings['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['INSERT_ITEM'] == true">
                                            <li id="itemVault_{$item['serial']}" onclick="commandTransferVault('{$item['serial']}');">{$item['name']}</li>
                                            <else />
                                            <li id="itemVault_{$item['serial']}">{$item['name']}</li>
                                            </if>
                                        </foreach>
                                        </if>
                                        </ul>
                                    </div>
                                </td>                                                     
                                <td style="margin: 0px; padding: 0px; width: 100%;"></td>
                            </tr>
                        </table>
                    </div>
				</td>
                <td>
                    <div id="itemDetailsBox">
                        <table>
                            <tr>
                                <td style="margin: 0px; padding: 0px;">
                                    <div class="vaultBox">
                                        <div id="vaultName">{$this->lang->words['UserPanel']['VirtualVault']['VirtualVault']}</div>
                                        <ul id="itemsVirtualVault" class="items">
                                        <if syntax="count($userpanel['virtual_vault']['virtual_vault_items']) > 0">
										<foreach loop="$userpanel['virtual_vault']['virtual_vault_items'] as $item">
                                            <li id="itemVirtual_{$item['serial']}" onclick="commandTransferVirtual('{$item['serial']}');">{$item['name']}</li>
                                        </foreach>
                                        </if>
                                        </ul>
                                    </div>
                                </td>                                                     
                                <td style="margin: 0px; padding: 0px; width: 100%;"></td>
                            </tr>
                        </table>
                    </div>
				</td>
			</tr>
    	</table>
    </div>