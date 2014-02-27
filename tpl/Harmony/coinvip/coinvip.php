	<if syntax="$coinvip['auto_load_page']">
	<script type="text/javascript">
	$(document).ready(function(e)
	{
		if(e)
			CTM.AjaxLoad("?app=core&module=coinvip&load={$coinvip['auto_load_page']}", ".showOption");
    });
    </script>
	</if>
    
	<div class="box-content">
		<div class="header"><span>{$this->lang->words['CoinVIP']['Title']}</span></div>
		<ul class="info">
			<li><a href="javascript: void(0);" onclick="CTM.AjaxLoad('?app=core&amp;module=coinvip&amp;load=advantages','.showOption');">&raquo; {$this->lang->words['CoinVIP']['Menu']['VIP_Advantages']}</a></li>
			<li><a href="javascript: void(0);" onclick="CTM.AjaxLoad('?app=core&amp;module=coinvip&amp;load=howtobuy','.showOption');">&raquo; {$this->lang->words['CoinVIP']['Menu']['HowToBuy']}</a></li>
			<li><a href="javascript: void(0);" onclick="CTM.Load('?app=core&amp;module=userpanel&amp;option=buyVIP','.content');">&raquo; {$this->lang->words['CoinVIP']['Menu']['BuyVIP']}</a></li>
			<li><a href="javascript: void(0);" onclick="CTM.AjaxLoad('?app=core&amp;module=coinvip&amp;load=bankdata','.showOption');">&raquo; {$this->lang->words['CoinVIP']['Menu']['BankData']}</a></li>
		</ul>
	</div>
	<div id="showOption"></div>