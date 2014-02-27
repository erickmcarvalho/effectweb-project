	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['MasterReset']['Title']}</span></div>
	  	<h3>{$this->lang->words['UserPanel']['MasterReset']['Requirements']}</h3>
        <p>
        	<if syntax="$this->settings['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MODE'] < 3">
            {$this->lang->words['UserPanel']['MasterReset']['Require']['Resets']}<strong>{$userpanel['master_reset']['require']['resets']}</strong><br />
            </if>
  			{$this->lang->words['UserPanel']['MasterReset']['Require']['Level']}<strong>{$userpanel['master_reset']['require']['level']}</strong><br />
            {$this->lang->words['UserPanel']['MasterReset']['Require']['Strength']} <strong>{$userpanel['master_reset']['require']['strength']}</strong><br />
            {$this->lang->words['UserPanel']['MasterReset']['Require']['Dexterity']} <strong>{$userpanel['master_reset']['require']['dexterity']}</strong><br />
            {$this->lang->words['UserPanel']['MasterReset']['Require']['Vitality']} <strong>{$userpanel['master_reset']['require']['vitality']}</strong><br />
            {$this->lang->words['UserPanel']['MasterReset']['Require']['Energy']} <strong>{$userpanel['master_reset']['require']['energy']}</strong><br />
            <if syntax="$userpanel['master_reset']['class_lord'] == true">
            {$this->lang->words['UserPanel']['MasterReset']['Require']['Command']} <strong>{$userpanel['master_reset']['require']['command']}</strong><br />
            </if>
            {$this->lang->words['UserPanel']['MasterReset']['Require']['Money']} <strong>{$userpanel['master_reset']['require']['money']}</strong><br />
  		</p>
        <div style="clear:both"></div>
        <h3 style="float:left; display:inherit; clear:none; width:300px"">{$this->lang->words['UserPanel']['MasterReset']['Before']['Title']}</h3>
		<h3 style="float:right; display:inherit; clear:none; width:400px">{$this->lang->words['UserPanel']['MasterReset']['After']['Title']}</h3>
        <div style="clear:both"></div>
        <div class="description">
        	<ul style="width:240px">
            	<li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['Before']['MResets']}</strong> 
                    <span class="green">{$userpanel['master_reset']['before']['mresets']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['Before']['Resets']}</strong> 
                    <span class="green">{$userpanel['master_reset']['before']['resets']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['Before']['Level']}</strong> 
                    <span class="green">{$userpanel['master_reset']['before']['level']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['Before']['Points']}</strong> 
                    <span class="green">{$userpanel['master_reset']['before']['points']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['Before']['Strength']}</strong> 
                    <span class="green">{$userpanel['master_reset']['before']['strength']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['Before']['Dexterity']}</strong> 
                    <span class="green">{$userpanel['master_reset']['before']['dexterity']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['Before']['Vitality']}</strong> 
                    <span class="green">{$userpanel['master_reset']['before']['vitality']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['Before']['Command']}</strong> 
                    <span class="green">{$userpanel['master_reset']['before']['energy']}</span>
                </li>
                <if syntax="$userpanel['master_reset']['class_is_lord'] == true">
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['Before']['Energy']}</strong> 
                    <span class="green">{$userpanel['master_reset']['before']['command']}</span>
                </li>
                </if>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['Before']['Class']}</strong> 
                    <span class="green">{$userpanel['master_reset']['before']['class']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['Before']['Money']}</strong> 
                    <span class="green">{$userpanel['master_reset']['before']['money']}</span>
                </li>
			</ul>
        </div>
        <div class="description" style="float:right">
        	<ul style="width:340px">
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['MResets']}</strong> 
                    <span class="red">{$userpanel['master_reset']['after']['mresets']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['Resets']}</strong> 
                    <span class="red">{$userpanel['master_reset']['after']['resets']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['Level']}</strong> 
                    <span class="red">{$userpanel['master_reset']['after']['level']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['Points']}</strong> 
                    <span class="red">{$userpanel['master_reset']['after']['points']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['Strength']}</strong> 
                    <span class="red">{$userpanel['master_reset']['after']['strength']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['Dexterity']}</strong> 
                    <span class="red">{$userpanel['master_reset']['after']['dexterity']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['Vitality']}</strong> 
                    <span class="red">{$userpanel['master_reset']['after']['vitality']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['Command']}</strong> 
                    <span class="red">{$userpanel['master_reset']['after']['energy']}</span>
                </li>
                <if syntax="$userpanel['master_reset']['class_is_lord'] == true">
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['Energy']}</strong> 
                    <span class="red">{$userpanel['master_reset']['after']['command']}</span>
                </li>
                </if>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['Class']}</strong> 
                    <span class="red">{$userpanel['master_reset']['after']['class']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['Money']}</strong> 
                    <span class="red">{$userpanel['master_reset']['after']['money']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['ClearInventory']}</strong> 
                    <span>{$userpanel['master_reset']['after']['clear_invent']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['ClearSkill']}</strong> 
                    <span>{$userpanel['master_reset']['after']['clear_skill']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['MasterReset']['After']['ClearQuest']}</strong> 
                    <span>{$userpanel['master_reset']['after']['clear_quest']}</span>
                </li>
			</ul>
        </div>
  		<div style="clear:both"></div>
		<input type="button" value="{$this->lang->words['UserPanel']['MasterReset']['Button']}" class="btn" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=masterReset&amp;write=true','Command');" />
	</div>
    <div id="Command"></div>