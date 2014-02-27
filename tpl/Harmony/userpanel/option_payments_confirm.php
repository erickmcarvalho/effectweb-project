	<script type="text/javascript">
	$(function()
	{
		$("#selectMethod").change(function()
		{
			if($("#selectMethod option:selected").val().length < 1)
			{
				CTM.Message("<strong>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Messages']['SelectMethod']}</strong>", 1, "showErrorMessage");
			}
			else
			{
				$.fancybox(
				{
					ajax :
					{
						type : "GET",
						data : "ajaxLoadSet=true"
					},
					href : "?app=core&module=userpanel&option=invoices&section=show&id={$userpanel['payments']['confirm_payment']['invoice_id']}&do=payment&method="+$("#selectMethod").val()
				});
				
				//$.facebox({ ajax: "?app=core&module=userpanel&option=invoices&section=show&id={$userpanel['payments']['confirm_payment']['invoice_id']}&do=payment&method="+$("#selectMethod").val()+"&ajaxLoadSet=true" });
				//CTM.AjaxLoad("?app=core&module=userpanel&option=invoices&section=show&id={$userpanel['payments']['confirm_payment']['invoice_id']}&do=payment&method="+$("#selectMethod").val(), "payment_div_content");
			}
		});
	});
	</script>
    <div id="payment_div_content" style="width: 700px">
        <div class="box-content">
            <div class="header"><span>{$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['Title']}</span></div>
            <div align="center" style="display:block; padding:5px 10px;">
                {$this->lang->words['UserPanel']['Payments']['ConfirmPayment']['SelectMethod']}<br /><br />
                <select name="selectMethod" id="selectMethod" class="selectField">
                    <option value="" disabled="disabled" selected="selected">{$this->lang->words['Words']['Select']}</option>
                    <foreach loop="$this->settings['PAYMENTMETHOD']['FORM'] as $k => $v">
                    <option value="{$k}">{$v[0]}</option>
                    </foreach>
                </select>
            </div>
        </div>
        <div id="showErrorMessage"></div>
	</div>