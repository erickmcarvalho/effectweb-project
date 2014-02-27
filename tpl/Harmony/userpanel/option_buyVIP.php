<if syntax="!$userpanel['buy_vip']">
	<script type="text/javascript">
	function loadVIP_Plans(type)
	{
		CTM.AjaxLoad("?app=core&module=userpanel&option=buyVIP&vip="+type, "loadCommand");
	}
	</script>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['BuyVIP']['Title']}</span></div>
		<h4>{$this->lang->words['UserPanel']['BuyVIP']['Select']}</h4>
		<div align="center">
            <input type="button" name="selectType" id="selectType" value="{const='VIP_NAME_1'}" onclick="loadVIP_Plans(1);" class="btn" />
            <if syntax="VIP_NUMBER >= 2">
            <input type="button" name="selectType" id="selectType" value="{const='VIP_NAME_2'}" onclick="loadVIP_Plans(2);" class="btn" />
            </if>
            <if syntax="VIP_NUMBER >= 3">
            <input type="button" name="selectType" id="selectType" value="{const='VIP_NAME_3'}" onclick="loadVIP_Plans(3);" class="btn" />
            </if>
            <if syntax="VIP_NUMBER >= 4">
            <input type="button" name="selectType" id="selectType" value="{const='VIP_NAME_4'}" onclick="loadVIP_Plans(4);" class="btn" />
            </if>
            <if syntax="VIP_NUMBER == 5">
            <input type="button" name="selectType" id="selectType" value="{const='VIP_NAME_5'}" onclick="loadVIP_Plans(5);" class="btn" />
            </if>
		</div>
    </div>
	<div id="loadCommand"></div>
    <else />
	<script type="text/javascript">
	$(function()
	{
		$("#buyNow").click(function()
		{
			if($("#Plan option:selected").val() < 1)
				CTM.Message("{$this->lang->words['UserPanel']['BuyVIP']['Messages']['Error_Plan']}", 1, "Command");
			else
				CTM.AjaxLoad("?app=core&module=userpanel&option=buyVIP&vip={$userpanel['buy_vip']['current_type_selected_id']}&write=true", "Command", "buyVIPNow");
		});
	});
	function confirmChangePlan(message)
	{
		Sexy.confirm(message, {onComplete : function(change)
		{
			if(change)
				CTM.AjaxLoad("?app=core&module=userpanel&option=buyVIP&vip={$userpanel['buy_vip']['current_type_selected_id']}&write=true&changePlan=true", "Command", "buyVIPNow");
		}
		});
	}
	function completeBuyVIP(AccountType, Expiration, CoinBalance)
	{
		$("#CoinBalance").fadeOut("fast", function()
		{
			$(this).html(CoinBalance);
			$(this).css("display", "none");
		});
		$("#CurrentType").fadeOut("fast", function()
		{
			$(this).html(AccountType);
			$(this).css("display", "none");
		});
		$("#VIPExpiration").fadeOut("fast", function()
		{
			$(this).html(Expiration);
			$(this).css("display", "none");
		});
		
		$("#CoinBalance").fadeIn("slow");
		$("#CurrentType").fadeIn("slow");
		$("#VIPExpiration").fadeIn("slow");
	}
	</script>
    <div class="box-content">
    	<div class="header"><span>{$userpanel['buy_vip']['current_type_selected']}</span></div>
        <form name="buyVIPNow" id="buyVIPNow" class="frm" style="float:left">
            <label>{$this->lang->words['UserPanel']['BuyVIP']['SelectPlan']}</label>
            <select name="Plan" id="Plan">
				<foreach loop="$userpanel['buy_vip']['plans'] as $plan => $price">
				<option value="{$plan}">{$plan} {$this->lang->words['UserPanel']['BuyVIP']['Days']} = {$price} {const='COIN_NAME_1'}</option>
				</foreach>
			</select>
            <br />
            <input type="button" id="buyNow" value="{$this->lang->words['UserPanel']['BuyVIP']['Button']}" class="btn" />
		</form>
        <div class="description">
        	<ul style="width:200px">
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['BuyVIP']['Balance']}</strong> 
                    <span id="CoinBalance" class="red">{$userpanel['buy_vip']['current_coin_balance']}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['BuyVIP']['CurrentPlan']}</strong>
                    <span id="CurrentType" class="green">{$userpanel['buy_vip']['current_account_level']}</span>
                </li> 
                <li>
                	<strong>&raquo; {$this->lang->words['UserPanel']['BuyVIP']['Expiration']}</strong>
                    <span id="VIPExpiration" class="blue">{$userpanel['buy_vip']['current_account_expiration']}</span>
                </li> 
			</ul>
        </div>
	</div>
    <div id="Command"></div>
    </if>
