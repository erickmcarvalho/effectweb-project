	<script type="text/javascript">
	$(function()
	{
		$('#clearNow').click(function()
		{
			count = 0;
			if($("#ClearInventory_NO:checked").val()) count++;
			if($("#ClearSkill_NO:checked").val()) count++;
			if($("#ClearQuest_NO:checked").val()) count++;
			if($("#ClearMoney_NO:checked").val()) count++;
			
			if(count == 4) CTM.Message("{$this->lang->words['UserPanel']['ClearCharacter']['Messages']['Error']}", 1, "Command");
			else CTM.AjaxLoad('?app=core&module=userpanel&option=clearCharacter&write=true','Command','Clear_Character');
		});
	});
	</script>
	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['ClearCharacter']['Title']}</span></div>
	   	<p>
            <span class="red">{$this->lang->words['UserPanel']['ClearCharacter']['Warning']}</span><br /><br />
            <b>{$this->lang->words['UserPanel']['ClearCharacter']['Select']}</b><br /><br />
			<form name="Clear_Character" id="Clear_Character">
				<table width="60%" border="0">
				  <tr>
					 <td width="16%">{$this->lang->words['UserPanel']['ClearCharacter']['Inventory']}</td>
					 <td width="86%"><span class="yesno_yes"><input type="radio" name="ClearInventory" id="ClearInventory_YES" value="1" /><label for="ClearInventory_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no"><input type="radio" name="ClearInventory" id="ClearInventory_NO" value="0" checked="checked" /><label for="ClearInventory_NO">{$this->lang->words['Words']['No']}</label></span></td>
				  </tr>
				  <tr>
					  <td>{$this->lang->words['UserPanel']['ClearCharacter']['Skill']}</td>
					  <td><span class="yesno_yes"><input type="radio" name="ClearSkill" id="ClearSkill_YES" value="1" /><label for="ClearSkill_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no"><input type="radio"  name="ClearSkill" id="ClearSkill_NO" value="0" checked="checked" /><label for="ClearSkill_NO">{$this->lang->words['Words']['No']}</label></span></td>
				  </tr>
  				  <tr>
					  <td>{$this->lang->words['UserPanel']['ClearCharacter']['Quests']}</td>
					  <td><span class="yesno_yes"><input type="radio" name="ClearQuest" id="ClearSkill_YES" value="1" /><label for="ClearQuest_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no"><input type="radio" name="ClearQuest" id="ClearQuest_NO" value="0" checked="checked" /><label for="ClearQuest_NO">{$this->lang->words['Words']['No']}</label></span></td>
				  </tr>
				  <tr>
					  <td>{$this->lang->words['UserPanel']['ClearCharacter']['Money']}</td>
					  <td><span class="yesno_yes"><input type="radio" name="ClearMoney" id="ClearMoney_YES" value="1" /><label for="ClearMoney_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no"><input type="radio" name="ClearMoney" id="ClearMoney_NO" value="0" checked="checked" /><label for="ClearMoney_NO">{$this->lang->words['Words']['No']}</label></span></td>
				  </tr>
				</table><br />
				<input type="button" class="btn" id="clearNow" value="{$this->lang->words['UserPanel']['ClearCharacter']['Button']}" />
			</form>
		</p>
	</div>
	<div id="Command"></div>