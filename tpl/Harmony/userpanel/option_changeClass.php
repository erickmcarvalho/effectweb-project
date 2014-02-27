	<script type="text/javascript">
	$(function()
	{
		$("#ChangeClassNow").click(function()
		{
			Sexy.confirm("{$this->lang->words['UserPanel']['ChangeClass']['Confirm']}", {onComplete: function(e)
			{
				if(e)
					CTM.AjaxLoad('?app=core&module=userpanel&option=changeClass&write=true','Command','ChangeClass');
			}});
		});
	});
	</script>
	<div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['ChangeClass']['Title']}</span></div>
		<p>
			{$this->lang->words['UserPanel']['ChangeClass']['CurrentClass']} <b>{$userpanel['change_class']['current_class']}</b>.<br />
			<span class="red"> {$this->lang->words['UserPanel']['ChangeClass']['Warning']}</span>
		</p>
		<form name="ChangeClass" id="ChangeClass" class="frm">
			<label>{$this->lang->words['UserPanel']['ChangeClass']['SelectClass']['Label']}</label>
			<select name="NewClass" id="NewClass">
				<optgroup label="{$this->lang->words['UserPanel']['ChangeClass']['SelectClass'][1]}">
					<foreach loop="$userpanel['change_class']['select_class'][1] as $key => $class_name">
					<option value="1-{$key}">{$class_name}</option>
					</foreach>
				</optgroup>
				<optgroup label="{$this->lang->words['UserPanel']['ChangeClass']['SelectClass'][2]}">
					<foreach loop="$userpanel['change_class']['select_class'][2] as $key => $class_name">
					<option value="2-{$key}">{$class_name}</option>
					</foreach>
				</optgroup>
				<if syntax="MUSERVER_VERSION >= 4">
				<optgroup label="{$this->lang->words['UserPanel']['ChangeClass']['SelectClass'][3]}">
					<foreach loop="$userpanel['change_class']['select_class'][3] as $key => $class_name">
					<option value="3-{$key}">{$class_name}</option>
					</foreach>
				</optgroup>
				</if>
			</select>
		</form>
        <input type="button" class="btn" value="{$this->lang->words['UserPanel']['ChangeClass']['Button']}" id="ChangeClassNow" />
	</div>
	<div id="Command"></div>