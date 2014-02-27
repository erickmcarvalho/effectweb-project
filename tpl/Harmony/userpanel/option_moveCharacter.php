	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['MoveCharacter']['Title']}</span></div>
	  	<p>
	  		<b>{$this->lang->words['UserPanel']['MoveCharacter']['SelectMap']}</b>
		</p>
        <form name="Move_Char" id="Move_Char" class="frm">
			<select name="MapNumber" id="MapNumber">
      			<foreach loop="$this->settings['MAPDATA'] as $map_number => $map_info">
				<option value="{$map_number}">{$map_info[2]}</option>
     			</foreach>
			</select>
		</form>
		<input type="button"  class="btn" value="{$this->lang->words['UserPanel']['MoveCharacter']['Button']}" onclick="CTM.AjaxLoad('?appcore&amp;module=userpanel&amp;option=moveCharacter&amp;write=true','Command','Move_Char');" />
	</div>
	<div id="Command"></div>