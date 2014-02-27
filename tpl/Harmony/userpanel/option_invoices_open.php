	<script type="text/javascript">
	function runOpenInvoice(invoice_id)
	{
		Sexy.info("{$this->lang->words['UserPanel']['Invoices']['OpenInvoice']['Messages']['Success']}", { onComplete: function()
		{
			CTM.AjaxLoad("?app=core&module=userpanel&option=invoices&section=show&id="+invoice_id, ".loadSection");
		}});
	}
	
	function showConfirmMessage(value)
	{
		Sexy.confirm("{$this->lang->words['UserPanel']['Invoices']['OpenInvoice']['Messages']['Confirm']}".replace("{MONEY_VALUE}", value), { onComplete: function(e)
		{
			if(e == true)
			{
				CTM.AjaxLoad("?app=core&module=userpanel&option=invoices&section=open&write=true&confirm=true", "openCommand", "OpenInvoice");
			}	
		}});
	}
	
	$(function()
	{
		$("#Quantity").keyup(function()
		{
			var money_value = {const="COIN_PRICE"} * $("#Quantity").val();
			
			if(strstr(money_value, "."))
			{
				var money = money_value.split(".");
				
				if(money[1].lenght > 2)
					money[1] = money[1].substr(0, 2);
					
				while((money[1] % 5) != 0 && money[1] > 0)
				{
					if(money[1] < 5 && money[1] > 0)
						money[1] = 5;
					else
						money[1]++;
				}
				
				if(money[1].lenght == 1)
					money[1] = "0" + money[1];
					
				var final_money = money[0] + "." + money[1];
			}
			else
			{
				var final_money = money_value + ".00";
			}
			
			final_money = final_money.replace(".", ",");
			
			$("#MoneyValue").text(final_money);
		});
		
		$("#continue").click(function()
		{
			CTM.AjaxLoad("?app=core&module=userpanel&option=invoices&section=open&write=true", "openCommand", "OpenInvoice");
		});
	});
	</script>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['Invoices']['OpenInvoice']['Title']}</span></div>
		<form name="OpenInvoice" id="OpenInvoice" class="frm" style="float:left">
        	<label>{$this->lang->words['UserPanel']['Invoices']['OpenInvoice']['CoinQuantity']}</label>
			<input type="text" name="Quantity" id="Quantity" value="1" size="5" onkeypress="return CTM.NumbersOnly(event);" />
            <br />
            <input type="button" name="continue" id="continue" value="{$this->lang->words['UserPanel']['Invoices']['OpenInvoice']['Button']}" class="btn" />
		</form>
        <div class="description">
        	<ul style="width:300px">
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['Invoices']['OpenInvoice']['CoinPrice']}</strong> 
                    <span class="green">{const="MONEY_SYMBOL"} {$default_value}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['Invoices']['OpenInvoice']['MoneyValue']}</strong>
                    <span class="red">{const="MONEY_SYMBOL"} <span id="MoneyValue">{$default_value}</span></span>
                </li> 
			</ul>
        </div>
	</div>
    <div id="openCommand"></div>