	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['ResetSystem']['Title']} ({$userpanel['reset_system']['mode']})</span></div>
	  	<h3>{$this->lang->words['UserPanel']['ResetSystem']['Requirements']}</h3>
        <p>
  			{$this->lang->words['UserPanel']['ResetSystem']['Require']['Level']}<strong>{$userpanel['reset_system']['require']['level']}</strong><br />
  			{$this->lang->words['UserPanel']['ResetSystem']['Require']['Money']} <strong>{$userpanel['reset_system']['require']['money']}</strong><br />
  		</p>
        <div style="clear:both"></div>
        <h3 style="float:left; display:inherit; clear:none; width:300px"">{$this->lang->words['UserPanel']['ResetSystem']['Before']['Title']}</h3>
		<h3 style="float:right; display:inherit; clear:none; width:400px">{$this->lang->words['UserPanel']['ResetSystem']['After']['Title']}</h3>
        <div style="clear:both"></div>
        <div class="description">
        	<ul style="width:240px">
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['Before']['Resets']}</strong> 
                    <span class="green">{$userpanel['reset_system']['before']['resets']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['Before']['Level']}</strong> 
                    <span class="green">{$userpanel['reset_system']['before']['level']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['Before']['Points']}</strong> 
                    <span class="green">{$userpanel['reset_system']['before']['points']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['Before']['Class']}</strong> 
                    <span class="green">{$userpanel['reset_system']['before']['class']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['Before']['Money']}</strong> 
                    <span class="green">{$userpanel['reset_system']['before']['money']}</span>
                </li>
                <if syntax="$this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] > 2">
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['Before']['Strength']}</strong> 
                    <span class="green">{$userpanel['reset_system']['before']['strength']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['Before']['Dexterity']}</strong> 
                    <span class="green">{$userpanel['reset_system']['before']['dexterity']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['Before']['Vitality']}</strong> 
                    <span class="green">{$userpanel['reset_system']['before']['vitality']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['Before']['Command']}</strong> 
                    <span class="green">{$userpanel['reset_system']['before']['energy']}</span>
                </li>
                <if syntax="$userpanel['reset_system']['class_is_lord'] == true">
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['Before']['Energy']}</strong> 
                    <span class="green">{$userpanel['reset_system']['before']['command']}</span>
                </li>
                </if>
                </if>
			</ul>
        </div>
        <div class="description" style="float:right">
        	<ul style="width:340px">
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['Resets']}</strong> 
                    <span class="red">{$userpanel['reset_system']['after']['resets']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['Level']}</strong> 
                    <span class="red">{$userpanel['reset_system']['after']['level']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['Points']}</strong> 
                    <span class="red">{$userpanel['reset_system']['after']['points']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['Class']}</strong> 
                    <span class="red">{$userpanel['reset_system']['after']['class']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['Money']}</strong> 
                    <span class="red">{$userpanel['reset_system']['after']['money']}</span>
                </li>
                <if syntax="$this->settings['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] > 2">
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['Strength']}</strong> 
                    <span class="red">{$userpanel['reset_system']['after']['strength']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['Dexterity']}</strong> 
                    <span class="red">{$userpanel['reset_system']['after']['dexterity']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['Vitality']}</strong> 
                    <span class="red">{$userpanel['reset_system']['after']['vitality']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['Command']}</strong> 
                    <span class="red">{$userpanel['reset_system']['after']['energy']}</span>
                </li>
                <if syntax="$userpanel['reset_system']['class_is_lord'] == true">
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['Energy']}</strong> 
                    <span class="red">{$userpanel['reset_system']['after']['command']}</span>
                </li>
                </if>
                </if>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['ClearInventory']}</strong> 
                    <span>{$userpanel['reset_system']['after']['clear_invent']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['ClearSkill']}</strong> 
                    <span>{$userpanel['reset_system']['after']['clear_skill']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['ResetSystem']['After']['ClearQuest']}</strong> 
                    <span>{$userpanel['reset_system']['after']['clear_quest']}</span>
                </li>
			</ul>
        </div>
  		<div style="clear:both"></div>
		<input type="button" value="{$this->lang->words['UserPanel']['ResetSystem']['Button']}" class="btn" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=resetSystem&amp;write=true','Command');" />
	</div>
    <div id="Command"></div>