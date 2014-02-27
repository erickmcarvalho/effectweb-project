	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['DistributePoints']['Title']}</span></div>
        <form name="DistributePoints" id="DistributePoints" class="frm" style="float:left">
        	<label>{$this->lang->words['UserPanel']['DistributePoints']['Distribute']['Strength']} </label>
        	<input type="text" name="Strength" id="Strength" onKeyPress="return CTM.NumbersOnly(event);" maxlength="5" size="30" value="0" />
            <label>{$this->lang->words['UserPanel']['DistributePoints']['Distribute']['Dexterity']} </label>
			<input type="text" name="Dexterity" id="Dexterity" onKeyPress="return CTM.NumbersOnly(event);" maxlength="5" size="30" value="0" />
            <label>{$this->lang->words['UserPanel']['DistributePoints']['Distribute']['Vitality']} </label>
			<input type="text" name="Vitality" id="Vitality" onKeyPress="return CTM.NumbersOnly(event);" maxlength="5" size="30" value="0" />
            <label>{$this->lang->words['UserPanel']['DistributePoints']['Distribute']['Energy']} </label>
			<input type="text" name="Energy" id="Energy" onKeyPress="return CTM.NumbersOnly(event);" maxlength="5" size="30" value="0" />
            <if syntax="$userpanel['distribute_points']['class_is_lord'] == true">
            <label>{$this->lang->words['UserPanel']['DistributePoints']['Distribute']['Command']} </label>
			<input type="text" name="setCommand" id="setCommand" onKeyPress="return CTM.NumbersOnly(event);" maxlength="5" size="30" value="0" />
            </if>
            <br />
            <input type="button" class="btn" value="{$this->lang->words['UserPanel']['DistributePoints']['Button']}" onClick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=distributePoints&amp;write=true','Command','DistributePoints');">
        </form>
        <div class="description">
        	<ul style="width:200px">
                <li><span class="blue-ocean"><strong>{$this->lang->words['UserPanel']['DistributePoints']['Status']['Title']}</strong></span></li>
                <li><strong>&raquo; {$this->lang->words['UserPanel']['DistributePoints']['Status']['Points']}</strong> {$userpanel['distribute_points']['before_points']['points']}</li> 
                <li><strong>&raquo; {$this->lang->words['UserPanel']['DistributePoints']['Status']['Strength']}</strong> {$userpanel['distribute_points']['before_points']['strength']}</li> 
                <li><strong>&raquo; {$this->lang->words['UserPanel']['DistributePoints']['Status']['Dexterity']}</strong> {$userpanel['distribute_points']['before_points']['dexterity']}</li> 
                <li><strong>&raquo; {$this->lang->words['UserPanel']['DistributePoints']['Status']['Vitality']}</strong> {$userpanel['distribute_points']['before_points']['vitality']}</li> 
                <li><strong>&raquo; {$this->lang->words['UserPanel']['DistributePoints']['Status']['Energy']}</strong> {$userpanel['distribute_points']['before_points']['energy']}</li>
                <if syntax="$userpanel['distribute_points']['class_is_lord'] == true">
                <li><strong>&raquo; {$this->lang->words['UserPanel']['DistributePoints']['Status']['Command']}</strong> {$userpanel['distribute_points']['before_points']['command']}</li> 
                </if>
			</ul>
        </div>
	</div>
	<div id="Command"></div>