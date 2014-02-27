<div class="box-content">
	<div class="header"><span>{$this->lang->words['Rankings']['LoadRank']['Titles']['MasterLevel']}</span></div>
    <if syntax="count($ranking_result) > 0">
    <script type="text/javascript">
	$(document).ready(function()
	{
		$(".CharLink").click(function()
		{
			var charName = encodeURIComponent($(this).attr("rel"));
			CTM.Load('?/char/'+charName,'content');
		});
		$(".GuildLink").click(function()
		{
			var guildName = encodeURIComponent($(this).attr("rel"));
			CTM.Load('?/guild/'+guildName,'content');
		});
	});
	</script>
    <ul class="rank">
    	<foreach loop="$ranking_result as $rank => $infos">
    	<li>
        	<img src="{$infos['image']}" width="50" height="50">
            <p><strong>{$rank}º - </strong><a href="javascript: void(0);" class="CharLink" rel="{$infos['name']}">{$infos['name']}</a></p>
            <p><strong>{$this->lang->words['Rankings']['LoadRank']['Results']['MLevel']} </strong><span class="blue">{$infos['result']}</span></p>
            <p><strong>{$this->lang->words['Rankings']['LoadRank']['Guild']} </strong><a href="javascript: void(0);" class="GuildLink" rel="{$infos['secondary']}">{$infos['secondary']}</a></p>
    	</li>   
        </foreach>     
	</ul>
    <else />
    <div class="error-box">{$this->lang->words['Rankings']['LoadRank']['Messages']['NotResult']}</div>
    </if>
</div>