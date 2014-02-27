	<div class="box-content">
    	<div class="header"><span>{$this->lang->words['UserPanel']['ManageChar']['Title']}</span></div>
        <if syntax="count($userpanel['manage_char']['characters']) > 0">
        <script type="text/javascript">
		$(document).ready(function()
		{
			$(".CharLink").click(function()
			{
				var charName = encodeURIComponent($(this).attr("rel"));
				CTM.AjaxLoad('?app=core&module=userpanel&option=manageChar&write=true&character='+charName, 'loadCommand');
			});
		});
		</script>
        <style type="text/css">
		li.CharLink:hover
		{
			background:#E8F8FF;
			cursor: pointer;
		}
		</style>
        <p>{$this->lang->words['UserPanel']['ManageChar']['Mesage']}</p>
        <ul class="rank">
          	<foreach loop="$userpanel['manage_char']['characters'] as $character">
            <li class="CharLink" rel="{$character['name']}">
                <img src="{$character['image']}" width="50" height="50">
                <p><strong></strong>{$character['name']}</p>
                <p><strong>{$this->lang->words['UserPanel']['ManageChar']['Level']} </strong><span class="blue">{$character['level']}</span></p>
                <p><strong>{$this->lang->words['UserPanel']['ManageChar']['Guild']} </strong><span class="blue">{$character['guild']}</span></p>
            </li>   
            </foreach>
		</ul>
        <else />
        <div class="info-box"> {$this->lang->words['UserPanel']['ManageChar']['Messages']['NoChars']}</div>
        </if>
    </div>
    <div id="loadCommand"></div>