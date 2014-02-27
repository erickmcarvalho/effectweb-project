	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['RedistributePoints']['Title']}</span></div>
	   	<p>
        	<b class="red">{$this->lang->words['UserPanel']['RedistributePoints']['Warning']}</b><br />
            <h3 style="float:left; display:inherit; clear:none;">{$this->lang->words['UserPanel']['RedistributePoints']['Before']['Title']}</h3>
            <h3 style="float:right; display:inherit; clear:none;">{$this->lang->words['UserPanel']['RedistributePoints']['After']['Title']}</h3>
            <div class="description">
                <ul style="width:200px">
                    <li>
                        <strong>&raquo; {$this->lang->words['UserPanel']['RedistributePoints']['Before']['Points']}</strong> 
                        <span class="green">{$userpanel['redistribute_points']['before_points']['points']}</span>
                    </li>
                    <li>
                        <strong>&raquo; {$this->lang->words['UserPanel']['RedistributePoints']['Before']['Strength']}</strong> 
                        <span class="green">{$userpanel['redistribute_points']['before_points']['strength']}</span>
                    </li>
                    <li>
                        <strong>&raquo; {$this->lang->words['UserPanel']['RedistributePoints']['Before']['Dexterity']}</strong> 
                        <span class="green">{$userpanel['redistribute_points']['before_points']['dexterity']}</span>
                    </li>
                    <li>
                        <strong>&raquo; {$this->lang->words['UserPanel']['RedistributePoints']['Before']['Vitality']}</strong> 
                        <span class="green">{$userpanel['redistribute_points']['before_points']['vitality']}</span>
                    </li>
                    <li>
                        <strong>&raquo; {$this->lang->words['UserPanel']['RedistributePoints']['Before']['Energy']}</strong> 
                        <span class="green">{$userpanel['redistribute_points']['before_points']['energy']}</span>
                    </li>
                    <if syntax="$userpanel['redistribute_points']['class_is_lord'] == true">
                    <li>
                        <strong>&raquo; {$this->lang->words['UserPanel']['RedistributePoints']['Before']['Command']}</strong> 
                        <span class="green">{$userpanel['redistribute_points']['before_points']['command']}</span>
                    </li>
                    </if>
                </ul>
        	</div>
            <div class="description" style="float:right;">
                <ul style="width:200px">
                    <li>
                        <strong>&raquo; {$this->lang->words['UserPanel']['RedistributePoints']['After']['Points']}</strong> 
                        <span class="red">{$userpanel['redistribute_points']['after_points']['points']}</span>
                    </li>
                    <li>
                        <strong>&raquo; {$this->lang->words['UserPanel']['RedistributePoints']['After']['Strength']}</strong> 
                        <span class="red">{$userpanel['redistribute_points']['after_points']['strength']}</span>
                    </li>
                    <li>
                        <strong>&raquo; {$this->lang->words['UserPanel']['RedistributePoints']['After']['Dexterity']}</strong> 
                        <span class="red">{$userpanel['redistribute_points']['after_points']['dexterity']}</span>
                    </li>
                    <li>
                        <strong>&raquo; {$this->lang->words['UserPanel']['RedistributePoints']['After']['Vitality']}</strong> 
                        <span class="red">{$userpanel['redistribute_points']['after_points']['vitality']}</span>
                    </li>
                    <li>
                        <strong>&raquo; {$this->lang->words['UserPanel']['RedistributePoints']['After']['Energy']}</strong> 
                        <span class="red">{$userpanel['redistribute_points']['after_points']['energy']}</span>
                    </li>
                    <if syntax="$userpanel['redistribute_points']['class_is_lord'] == true">
                    <li>
                        <strong>&raquo; {$this->lang->words['UserPanel']['RedistributePoints']['Before']['Command']}</strong> 
                        <span class="red">{$userpanel['redistribute_points']['after_points']['command']}</span>
                    </li>
                    </if>
                </ul>
            </div>
            <div style="clear:both"></div>
            <input class="btn" type="button" value="{$this->lang->words['UserPanel']['RedistributePoints']['Button']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=redistributePoints&amp;write=true','Command');" />
		</p>
	</div>
	<div id="Command"></div>