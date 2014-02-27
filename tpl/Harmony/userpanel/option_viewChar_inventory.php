	<script type="text/javascript">
    $(document).ready(function()
    {
		$('#tabs_inventory').tabs({ fx: { opacity: 'toggle' } });
		
		<if syntax="count($userpanel['view_char']['inventory']['equipments']['hand']['right']) > 1">
		setEquipmentsHandLeft = "<div id='itemDetails'>\
        <h2 class='{$userpanel['view_char']['inventory']['equipments']['hand']['left']['tooltip']['set_item']}'>{$userpanel['view_char']['inventory']['equipments']['hand']['left']['name']}</h2>\
        <p class='info'>{$userpanel['view_char']['inventory']['equipments']['hand']['left']['tooltip']['begin']}</p>\
        {$userpanel['view_char']['inventory']['equipments']['hand']['left']['tooltip']['requirement']}\
        {$userpanel['view_char']['inventory']['equipments']['hand']['left']['tooltip']['class_use']}\
        <br />\
        {$userpanel['view_char']['inventory']['equipments']['hand']['left']['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$userpanel['view_char']['inventory']['equipments']['hand']['left']['tooltip']['options']}\
        </p>\
        {$userpanel['view_char']['inventory']['equipments']['hand']['left']['tooltip']['socket']}</div>";
        $('#equipmentsHandLeft').tooltip(setEquipmentsHandLeft, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
		</if>
        <if syntax="count($userpanel['view_char']['inventory']['equipments']['hand']['right']) > 1">
		setEquipmentsHandRight = "<div id='itemDetails'>\
        <h2 class='{$userpanel['view_char']['inventory']['equipments']['hand']['right']['tooltip']['set_item']}'>{$userpanel['view_char']['inventory']['equipments']['hand']['right']['name']}</h2>\
        <p class='info'>{$userpanel['view_char']['inventory']['equipments']['hand']['right']['tooltip']['begin']}</p>\
        {$userpanel['view_char']['inventory']['equipments']['hand']['right']['tooltip']['requirement']}\
        {$userpanel['view_char']['inventory']['equipments']['hand']['right']['tooltip']['class_use']}\
        <br />\
        {$userpanel['view_char']['inventory']['equipments']['hand']['right']['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$userpanel['view_char']['inventory']['equipments']['hand']['right']['tooltip']['options']}\
        </p>\
        {$userpanel['view_char']['inventory']['equipments']['hand']['right']['tooltip']['socket']}</div>";
        $('#equipmentsHandRight').tooltip(setEquipmentsHandRight, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
		</if>
        <if syntax="count($userpanel['view_char']['inventory']['equipments']['set']['helm']) > 1">
		setEquipmentsSetHelm = "<div id='itemDetails'>\
        <h2 class='{$userpanel['view_char']['inventory']['equipments']['set']['helm']['tooltip']['set_item']}'>{$userpanel['view_char']['inventory']['equipments']['set']['helm']['name']}</h2>\
        <p class='info'>{$userpanel['view_char']['inventory']['equipments']['set']['helm']['tooltip']['begin']}</p>\
        {$userpanel['view_char']['inventory']['equipments']['set']['helm']['tooltip']['requirement']}\
        {$userpanel['view_char']['inventory']['equipments']['set']['helm']['tooltip']['class_use']}\
        <br />\
        {$userpanel['view_char']['inventory']['equipments']['set']['helm']['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$userpanel['view_char']['inventory']['equipments']['set']['helm']['tooltip']['options']}\
        </p>\
        {$userpanel['view_char']['inventory']['equipments']['set']['helm']['tooltip']['socket']}</div>";
        $('#equipmentsSetHelm').tooltip(setEquipmentsSetHelm, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
		</if>
        <if syntax="count($userpanel['view_char']['inventory']['equipments']['set']['armor']) > 1">
		setEquipmentsSetArmor = "<div id='itemDetails'>\
        <h2 class='{$userpanel['view_char']['inventory']['equipments']['set']['armor']['tooltip']['set_item']}'>{$userpanel['view_char']['inventory']['equipments']['set']['armor']['name']}</h2>\
        <p class='info'>{$userpanel['view_char']['inventory']['equipments']['set']['armor']['tooltip']['begin']}</p>\
        {$userpanel['view_char']['inventory']['equipments']['set']['armor']['tooltip']['requirement']}\
        {$userpanel['view_char']['inventory']['equipments']['set']['armor']['tooltip']['class_use']}\
        <br />\
        {$userpanel['view_char']['inventory']['equipments']['set']['armor']['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$userpanel['view_char']['inventory']['equipments']['set']['armor']['tooltip']['options']}\
        </p>\
        {$userpanel['view_char']['inventory']['equipments']['set']['armor']['tooltip']['socket']}</div>";
        $('#equipmentsSetArmor').tooltip(setEquipmentsSetArmor, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
		</if>
        <if syntax="count($userpanel['view_char']['inventory']['equipments']['set']['pants']) > 1">
		setEquipmentsSetPants = "<div id='itemDetails'>\
        <h2 class='{$userpanel['view_char']['inventory']['equipments']['set']['pants']['tooltip']['set_item']}'>{$userpanel['view_char']['inventory']['equipments']['set']['pants']['name']}</h2>\
        <p class='info'>{$userpanel['view_char']['inventory']['equipments']['set']['pants']['tooltip']['begin']}</p>\
        {$userpanel['view_char']['inventory']['equipments']['set']['pants']['tooltip']['requirement']}\
        {$userpanel['view_char']['inventory']['equipments']['set']['pants']['tooltip']['class_use']}\
        <br />\
        {$userpanel['view_char']['inventory']['equipments']['set']['pants']['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$userpanel['view_char']['inventory']['equipments']['set']['pants']['tooltip']['options']}\
        </p>\
        {$userpanel['view_char']['inventory']['equipments']['set']['pants']['tooltip']['socket']}</div>";
        $('#equipmentsSetPants').tooltip(setEquipmentsSetPants, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
		</if>
        <if syntax="count($userpanel['view_char']['inventory']['equipments']['set']['gloves']) > 1">
		setEquipmentsSetGloves = "<div id='itemDetails'>\
        <h2 class='{$userpanel['view_char']['inventory']['equipments']['set']['gloves']['tooltip']['set_item']}'>{$userpanel['view_char']['inventory']['equipments']['set']['gloves']['name']}</h2>\
        <p class='info'>{$userpanel['view_char']['inventory']['equipments']['set']['gloves']['tooltip']['begin']}</p>\
        {$userpanel['view_char']['inventory']['equipments']['set']['gloves']['tooltip']['requirement']}\
        {$userpanel['view_char']['inventory']['equipments']['set']['gloves']['tooltip']['class_use']}\
        <br />\
        {$userpanel['view_char']['inventory']['equipments']['set']['gloves']['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$userpanel['view_char']['inventory']['equipments']['set']['gloves']['tooltip']['options']}\
        </p>\
        {$userpanel['view_char']['inventory']['equipments']['set']['gloves']['tooltip']['socket']}</div>";
        $('#equipmentsSetGloves').tooltip(setEquipmentsSetGloves, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
		</if>
        <if syntax="count($userpanel['view_char']['inventory']['equipments']['set']['boots']) > 1">
		setEquipmentsSetBoots = "<div id='itemDetails'>\
        <h2 class='{$userpanel['view_char']['inventory']['equipments']['set']['boots']['tooltip']['set_item']}'>{$userpanel['view_char']['inventory']['equipments']['set']['boots']['name']}</h2>\
        <p class='info'>{$userpanel['view_char']['inventory']['equipments']['set']['boots']['tooltip']['begin']}</p>\
        {$userpanel['view_char']['inventory']['equipments']['set']['boots']['tooltip']['requirement']}\
        {$userpanel['view_char']['inventory']['equipments']['set']['boots']['tooltip']['class_use']}\
        <br />\
        {$userpanel['view_char']['inventory']['equipments']['set']['boots']['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$userpanel['view_char']['inventory']['equipments']['set']['boots']['tooltip']['options']}\
        </p>\
        {$userpanel['view_char']['inventory']['equipments']['set']['boots']['tooltip']['socket']}</div>";
        $('#equipmentsSetBoots').tooltip(setEquipmentsSetBoots, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
		</if>
        <if syntax="count($userpanel['view_char']['inventory']['equipments']['wing']) > 1">
		setEquipmentsWing = "<div id='itemDetails'>\
        <h2 class='{$userpanel['view_char']['inventory']['equipments']['wing']['tooltip']['set_item']}'>{$userpanel['view_char']['inventory']['equipments']['wing']['name']}</h2>\
        <p class='info'>{$userpanel['view_char']['inventory']['equipments']['wing']['tooltip']['begin']}</p>\
        {$userpanel['view_char']['inventory']['equipments']['wing']['tooltip']['requirement']}\
        {$userpanel['view_char']['inventory']['equipments']['wing']['tooltip']['class_use']}\
        <br />\
        {$userpanel['view_char']['inventory']['equipments']['wing']['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$userpanel['view_char']['inventory']['equipments']['wing']['tooltip']['options']}\
        </p>\
        {$userpanel['view_char']['inventory']['equipments']['wing']['tooltip']['socket']}</div>";
        $('#equipmentsWing').tooltip(setEquipmentsWing, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
		</if>
		<if syntax="count($userpanel['view_char']['inventory']['equipments']['pet']) > 1">
		setEquipmentsPet = "<div id='itemDetails'>\
        <h2 class='{$userpanel['view_char']['inventory']['equipments']['pet']['tooltip']['set_item']}'>{$userpanel['view_char']['inventory']['equipments']['pet']['name']}</h2>\
        <p class='info'>{$userpanel['view_char']['inventory']['equipments']['pet']['tooltip']['begin']}</p>\
        {$userpanel['view_char']['inventory']['equipments']['pet']['tooltip']['requirement']}\
        {$userpanel['view_char']['inventory']['equipments']['pet']['tooltip']['class_use']}\
        <br />\
        {$userpanel['view_char']['inventory']['equipments']['pet']['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$userpanel['view_char']['inventory']['equipments']['pet']['tooltip']['options']}\
        </p>\
        {$userpanel['view_char']['inventory']['equipments']['pet']['tooltip']['socket']}</div>";
        $('#equipmentsPet').tooltip(setEquipmentsPet, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
		</if>
        <if syntax="count($userpanel['view_char']['inventory']['equipments']['pendant']) > 1">
		setEquipmentsPendant = "<div id='itemDetails'>\
        <h2 class='{$userpanel['view_char']['inventory']['equipments']['pendant']['tooltip']['set_item']}'>{$userpanel['view_char']['inventory']['equipments']['pendant']['name']}</h2>\
        <p class='info'>{$userpanel['view_char']['inventory']['equipments']['pendant']['tooltip']['begin']}</p>\
        {$userpanel['view_char']['inventory']['equipments']['pendant']['tooltip']['requirement']}\
        {$userpanel['view_char']['inventory']['equipments']['pendant']['tooltip']['class_use']}\
        <br />\
        {$userpanel['view_char']['inventory']['equipments']['pendant']['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$userpanel['view_char']['inventory']['equipments']['pendant']['tooltip']['options']}\
        </p>\
        {$userpanel['view_char']['inventory']['equipments']['pendant']['tooltip']['socket']}</div>";
        $('#equipmentsPendant').tooltip(setEquipmentsPendant, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
		</if>
        <if syntax="count($userpanel['view_char']['inventory']['equipments']['ring']['left']) > 1">
		setEquipmentsRingLeft = "<div id='itemDetails'>\
        <h2 class='{$userpanel['view_char']['inventory']['equipments']['ring']['left']['tooltip']['set_item']}'>{$userpanel['view_char']['inventory']['equipments']['ring']['left']['name']}</h2>\
        <p class='info'>{$userpanel['view_char']['inventory']['equipments']['ring']['left']['tooltip']['begin']}</p>\
        {$userpanel['view_char']['inventory']['equipments']['ring']['left']['tooltip']['requirement']}\
        {$userpanel['view_char']['inventory']['equipments']['ring']['left']['tooltip']['class_use']}\
        <br />\
        {$userpanel['view_char']['inventory']['equipments']['ring']['left']['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$userpanel['view_char']['inventory']['equipments']['ring']['left']['tooltip']['options']}\
        </p>\
        {$userpanel['view_char']['inventory']['equipments']['ring']['left']['tooltip']['socket']}</div>";
        $('#equipmentsRingLeft').tooltip(setEquipmentsRingLeft, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
		</if>
        <if syntax="count($userpanel['view_char']['inventory']['equipments']['ring']['right']) > 1">
		setEquipmentsRingRight = "<div id='itemDetails'>\
        <h2 class='{$userpanel['view_char']['inventory']['equipments']['ring']['right']['tooltip']['set_item']}'>{$userpanel['view_char']['inventory']['equipments']['ring']['left']['name']}</h2>\
        <p class='info'>{$userpanel['view_char']['inventory']['equipments']['ring']['right']['tooltip']['begin']}</p>\
        {$userpanel['view_char']['inventory']['equipments']['ring']['right']['tooltip']['requirement']}\
        {$userpanel['view_char']['inventory']['equipments']['ring']['right']['tooltip']['class_use']}\
        <br />\
        {$userpanel['view_char']['inventory']['equipments']['ring']['right']['tooltip']['harmony']}
        <p class='itemBlue'>\
        {$userpanel['view_char']['inventory']['equipments']['ring']['right']['tooltip']['options']}\
        </p>\
        {$userpanel['view_char']['inventory']['equipments']['ring']['right']['tooltip']['socket']}</div>";
        $('#equipmentsRingRight').tooltip(setEquipmentsRingRight, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
		</if>
        
		<if syntax="count($userpanel['view_char']['inventory']['inventory']) > 0">
        <foreach loop="$userpanel['view_char']['inventory']['inventory'] as $key => $item">
        //---------------------------------------------------------------------------------------------------------------------------------
        setInventoryItem_{$key} = "<div id='itemDetails'>\
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
        $('#inventoryItem_{$key}').tooltip(setInventoryItem_{$key}, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
        </foreach>
        </if>
        
        <if syntax="count($userpanel['view_char']['inventory']['personal_store']) > 0 && MUSERVER_VERSION >= 2">
        <foreach loop="$userpanel['view_char']['inventory']['personal_store'] as $key => $item">
        //---------------------------------------------------------------------------------------------------------------------------------
        setPersonalStoreItem_{$key} = "<div id='itemDetails'>\
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
        $('#personalStoreItem_{$key}').tooltip(setPersonalStoreItem_{$key}, { hook: false, width: 200, mode: 'tl', tooltipClass: 'itemDetails'});
        </foreach>
        </if>
    });
    </script>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Title']}</span></div>
        <div id="tabs_inventory">
        	<ul>
            	<li><a href="#tabs_inventory-1">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Tabs']['Equipments']}</a></li>
                <li><a href="#tabs_inventory-2">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Tabs']['Inventory']}</a></li>
                <if syntax="MUSERVER_VERSION >= 2">
                <li><a href="#tabs_inventory-3">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Tabs']['PersonalStore']}</a></li>
                </if>
             </ul>
             <div id="tabs_inventory-1">
                 <div id="itemDetailsBox">
                    <table width="100%" border="0" class="tableBackColumn">
                        <tr>
                            <td><strong class="colr">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Equipments']['Hand']['Left']}</strong></td>
                            <td><strong id="equipmentsHandLeft"><a href="javascript: void();">{$userpanel['view_char']['inventory']['equipments']['hand']['left']['name']}</a></strong></td>
                        </tr>
                        <tr>
                            <td><strong class="colr">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Equipments']['Hand']['Right']}</strong></td>
                            <td><strong id="equipmentsHandRight"><a href="javascript: void();">{$userpanel['view_char']['inventory']['equipments']['hand']['right']['name']}</a></strong></td>
                        </tr>
                        <tr>
                            <td><strong class="colr">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Equipments']['Set']['Helm']}</strong></td>
                            <td><strong id="equipmentsSetHelm"><a href="javascript: void();">{$userpanel['view_char']['inventory']['equipments']['set']['helm']['name']}</a></strong></td>
                        </tr>
                        <tr>
                            <td><strong class="colr">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Equipments']['Set']['Armor']}</strong></td>
                            <td><strong id="equipmentsSetArmor"><a href="javascript: void();">{$userpanel['view_char']['inventory']['equipments']['set']['armor']['name']}</a></strong></td>
                        </tr>
                        <tr>
                            <td><strong class="colr">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Equipments']['Set']['Pants']}</strong></td>
                            <td><strong id="equipmentsSetPants"><a href="javascript: void();">{$userpanel['view_char']['inventory']['equipments']['set']['pants']['name']}</a></strong></td>
                        </tr>
                        <tr>
                            <td><strong class="colr">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Equipments']['Set']['Gloves']}</strong></td>
                            <td><strong id="equipmentsSetGloves"><a href="javascript: void();">{$userpanel['view_char']['inventory']['equipments']['set']['gloves']['name']}</a></strong></td>
                        </tr>
                        <tr>
                            <td><strong class="colr">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Equipments']['Set']['Boots']}</strong></td>
                            <td><strong id="equipmentsSetBoots"><a href="javascript: void();">{$userpanel['view_char']['inventory']['equipments']['set']['boots']['name']}</a></strong></td>
                        </tr>
                        <tr>
                            <td><strong class="colr">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Equipments']['Wing']}</strong></td>
                            <td><strong id="equipmentsWing"><a href="javascript: void();">{$userpanel['view_char']['inventory']['equipments']['wing']['name']}</a></strong></td>
                        </tr>
                        <tr>
                            <td><strong class="colr">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Equipments']['Pet']}</strong></td>
                            <td><strong id="equipmentsPet"><a href="javascript: void();">{$userpanel['view_char']['inventory']['equipments']['pet']['name']}</a></strong></td>
                        </tr>
                        <tr>
                            <td><strong class="colr">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Equipments']['Pendant']}</strong></td>
                            <td><strong id="equipmentsPendant"><a href="javascript: void();">{$userpanel['view_char']['inventory']['equipments']['pendant']['name']}</a></strong></td>
                        </tr>
                        <tr>
                            <td><strong class="colr">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Equipments']['Ring']['Left']}</strong></td>
                            <td><strong id="equipmentsRingLeft"><a href="javascript: void();">{$userpanel['view_char']['inventory']['equipments']['ring']['left']['name']}</a></strong></td>
                        </tr>
                        <tr>
                            <td><strong class="colr">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Equipments']['Ring']['Right']}</strong></td>
                            <td><strong id="equipmentsRingRight"><a href="javascript: void();">{$userpanel['view_char']['inventory']['equipments']['ring']['right']['name']}</a></strong></td>
                        </tr>
                    </table>
                </div>
			</div>
            <div id="tabs_inventory-2">
                <div id="itemDetailsBox">
                    <table>
                        <tr>
                            <td style="margin: 0px; padding: 0px;">
                                <div class="vaultBox">
                                    <div id="vaultName">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['Inventory']}</div>
                                    <ul class="items">
                                    	<if syntax="count($userpanel['view_char']['inventory']['inventory']) > 0">
										<foreach loop="$userpanel['view_char']['inventory']['inventory'] as $key => $item">
                                        <li id="inventoryItem_{$key}">{$item['name']}</li>
                                    	</foreach>
                                    	</if>
                                    </ul>
                                </div>
                            </td>                                                     
                            <td style="margin: 0px; padding: 0px; width: 100%;"></td>
                        </tr>
                    </table>
                </div>
            </div>
            <if syntax="MUSERVER_VERSION >= 2">
            <div id="tabs_inventory-3">
                <div id="itemDetailsBox">
                    <table>
                        <tr>
                            <td style="margin: 0px; padding: 0px;">
                                <div class="vaultBox">
                                    <div id="vaultName">{$this->lang->words['UserPanel']['ViewCharacter']['Inventory']['PersonalStore']}</div>
                                    <ul class="items">
                                    	<if syntax="count($userpanel['view_char']['inventory']['personal_store']) > 0">
										<foreach loop="$userpanel['view_char']['inventory']['personal_store'] as $key => $item">
                                        <li id="personalStoreItem_{$key}">{$item['name']}</li>
                                    	</foreach>
                                    	</if>
                                    </ul>
                                </div>
                            </td>                                                     
                            <td style="margin: 0px; padding: 0px; width: 100%;"></td>
                        </tr>
                    </table>
                </div>
            </div>
            </if>
        </div>
    </div>