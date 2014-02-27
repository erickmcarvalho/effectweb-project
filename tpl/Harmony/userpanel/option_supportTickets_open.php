	<script type="text/javascript">
	$(function()
	{
		$("#selectDepartament").change(function()
		{
			if($("#selectDepartament option:selected").val().length < 1)
				CTM.Message("<strong>{$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Messages']['SelectDepartament']}</strong>", 1, "showErrorMessage");
			else
				CTM.AjaxLoad("?app=core&module=userpanel&option=supportTickets&section=open&departament="+$("#selectDepartament").val(), "loadSection");
		});
	});
	</script>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['Title']}</span></div>
        <div align="center" style="display:block; padding:5px 10px;">
        	{$this->lang->words['UserPanel']['SupportTickets']['OpenTicket']['SelectDepartament']}<br /><br />
			<select name="selectDepartament" id="selectDepartament" class="selectField">
				<option value="" disabled="disabled" selected="selected">{$this->lang->words['Words']['Select']}</option>
				<foreach loop="$this->settings['USERPANEL']['SUPPORT']['TICKETS']['DEPARTAMENTS'] as $k => $v">
				<option value="{$k}">{$v}</option>
				</foreach>
			</select>
		</div>
	</div>
    <div id="showErrorMessage"></div>