	<if syntax="$home_module['rankingData'] != 'NONE_RANK'">
	<script type="text/javascript">
	$(function()
	{
		$("td[rel*=SelectRanking]").click(function()
		{
			rank = $(this).attr("id");
	
			$(".currentRanking").hide().ready(function()
			{
				$("#Ranking_"+rank).show("slow"); 
				$("td[rel*=SelectRanking]").attr("class", "");
				$("#"+rank).attr("class", "current");
			});
		});
		$(".currentRanking").hide().ready(function()
		{
			$("#Ranking_{$home_module['rankingData']}").show("slow"); 
			$("#{$home_module['rankingData']}").attr("class", "current");
		});
		$(".rankLink").click(function()
		{
			var charName = encodeURIComponent($(this).attr("rel"));
			CTM.Load("?/char/"+charName, "content");
		});
		$(".guildLink").click(function()
		{
			var guildName = encodeURIComponent($(this).attr("rel"));
			CTM.Load("?/guild/"+guildName, "content");
		});
	});
	</script>
    </if>
    <if syntax="$this->settings['HOME']['NOTICES']['SHOW'] == true">
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['Home']['Notices']['Title']}</span></div>
        <if syntax="count($home_module['webNotices']) > 0">
		<ul class="news">
        	<foreach loop="$home_module['webNotices'] as $n">
        	<li>&raquo; <a href="javascript: void(0);" onclick="CTM.Load('?/notices/view/{$n['id']}','content');">{$n['title']}</a> - [ {$n['post_date']} ]</li>
            </foreach>
        </ul>
        <div class="right"><a href="javascript: void(0);" onclick="CTM.Load('?/notices','content');">[ {$this->lang->words['Home']['Notices']['All']} ]</a></div>
        <else />
		<div class="info-box">{$this->lang->words['Home']['Notices']['Void']}</div>
		</if>
    </div>
    </if>
    
    <if syntax="$this->settings['HOME']['FORUM']['SHOW'] == true">
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['Home']['ForumNotices']['Title']}</span></div>
        <if syntax="$home_module['forumNotices']">
        <if syntax="count($home_module['forumNotices']) > 0">
        <php>$this->tmp_vars['target'] = $this->settings['HOME']['FORUM']['NEW_WINDOW'] == true ? " target=\"_blank\"" : NULL;</php>
		<ul class="news">
        	<foreach loop="$home_module['forumNotices'] as $forumNotices">
        	<li>&raquo; <a href="{$forumNotices['topicLink']}"{$this->tmp_vars['target']}>{$forumNotices['title']}</a> - [ {$forumNotices['postDate']} ]</li>
            </foreach>
        </ul>
        <else />
		<div class="info-box">{$this->lang->words['Home']['ForumNotices']['Void']}</div>
        </if>
        <else />
        <div class="error-box">{$this->lang->words['Home']['ForumNotices']['Error']}</div>
        </if>
    </div>
    </if>
    
    <if syntax="$this->settings['HOME']['SIEGE']['SHOW'] == true">
    <div class="box-content">
    	<div id="castle-siege">
        	<p id="guild-cs">
            	{$this->lang->words['Home']['CastleSiege']['Owner']} 
                <a href="javascript: void(0);" class="guildLink" rel="{$home_module['CastleSiege']['GuildName']}">{$home_module['CastleSiege']['guildName']}</a>
            </p>
        	<p id="date-cs">
                {$this->lang->words['Home']['CastleSiege']['NextInvasion']} 
                <span class="blue-ocean">{$home_module['CastleSiege']['invasionDate']} - {$home_module['CastleSiege']['invasionHour']}</span>
            </p>
            <img src="{$home_module['CastleSiege']['guildMark']}" class="guild-mark" alt="{$home_module['CastleSiege']['guildName']} - Logo">
        </div>
    </div>
    </if>
    
    <if syntax="$home_module['rankingData'] != 'NONE_RANK'">
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['Home']['TopRank']['Title']}</span></div>
        <table width="100%" border="0" cellpadding="10" cellspacing="3" class="optionSelect">
        	<tr>
            	<if syntax="$this->settings['HOME']['TOP_RANK']['RESETS'][0] == true">
                <td height="33" align="center" rel="SelectRanking" id="ResetsGeneral"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['Resets']}</strong></td>
                </if>
                <if syntax="$this->settings['HOME']['TOP_RANK']['R_DAILY'][0] == true">
                <td height="33" align="center" rel="SelectRanking" id="ResetsDaily"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['RDaily']}</strong></td>
                </if>
                <if syntax="$this->settings['HOME']['TOP_RANK']['R_WEEKLY'][0] == true">
                <td height="33" align="center" rel="SelectRanking" id="ResetsWeekly"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['RWeekly']}</strong></td>
                </if>
                <if syntax="$this->settings['HOME']['TOP_RANK']['R_MONTHLY'][0] == true">
                <td height="33" align="center" rel="SelectRanking" id="ResetsMonthly"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['RMonthly']}</strong></td>
                </if>
			</tr>
        </table>
        <table width="100%" border="0" cellpadding="7" cellspacing="0">
        	<tr>
            	<td width="20%" valign="top">
                	<table width="100%" border="0" cellpadding="10" cellspacing="3" class="optionSelect">
                    	<if syntax="$this->settings['HOME']['TOP_RANK']['LEVEL'][0] == true">
                        <tr>
                        	<td height="33" align="center" rel="SelectRanking" id="RankLevel"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['Level']}</strong></td>
        				</tr>
                        </if>
                        <if syntax="$this->settings['HOME']['TOP_RANK']['MASTER_LEVEL'][0] == true">
                        <tr>
                        	<td height="33" align="center" rel="SelectRanking" id="RankMLevel"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['MLevel']}</strong></td>
        				</tr>
                        </if>
                        <if syntax="$this->settings['HOME']['TOP_RANK']['PK_KILLS'][0] == true">
                        <tr>
                        	<td height="33" align="center" rel="SelectRanking" id="PkKills"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['PkKills']}</strong></td>
                        </tr>
                        </if>
                        <if syntax="$this->settings['HOME']['TOP_RANK']['HERO_KILLS'][0] == true">
                        <tr>
                        	<td height="33" align="center" rel="SelectRanking" id="HeroKills"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['HeroKills']}</strong></td>
                        </tr>
                        </if>
                        <if syntax="$this->settings['HOME']['TOP_RANK']['GUILDS'][0] == true">
                        <tr>
                        	<td height="33" align="center" rel="SelectRanking" id="Guilds"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['Guilds']}</strong></td>
                        </tr>
                        </if>
        			</table>
        		</td>
                <td width="80%" valign="top">
                	<if syntax="$this->settings['HOME']['TOP_RANK']['RESETS'][0] == true">{template="includes_toprank_resets"}</if>
					<if syntax="$this->settings['HOME']['TOP_RANK']['R_DAILY'][0] == true">{template="includes_toprank_rdaily"}</if>
                    <if syntax="$this->settings['HOME']['TOP_RANK']['R_WEEKLY'][0] == true">{template="includes_toprank_rweekly"}</if>
                    <if syntax="$this->settings['HOME']['TOP_RANK']['R_MONTHLY'][0] == true">{template="includes_toprank_rmonthly"}</if>
                    <if syntax="$this->settings['HOME']['TOP_RANK']['MRESETS'][0] == true">{template="includes_toprank_mresets"}</if>
                    <if syntax="$this->settings['HOME']['TOP_RANK']['MR_DAILY'][0] == true">{template="includes_toprank_mrdaily"}</if>
                    <if syntax="$this->settings['HOME']['TOP_RANK']['MR_WEEKLY'][0] == true">{template="includes_toprank_mrweekly"}</if>
                    <if syntax="$this->settings['HOME']['TOP_RANK']['MR_MONTHLY'][0] == true">{template="includes_toprank_mrmonthly"}</if>
                    <if syntax="$this->settings['HOME']['TOP_RANK']['LEVEL'][0] == true">{template="includes_toprank_level"}</if>
                    <if syntax="$this->settings['HOME']['TOP_RANK']['MASTER_LEVEL'][0] == true">{template="includes_toprank_mlevel"}</if>
                    <if syntax="$this->settings['HOME']['TOP_RANK']['PK_KILLS'][0] == true">{template="includes_toprank_pkkills"}</if>
                    <if syntax="$this->settings['HOME']['TOP_RANK']['HERO_KILLS'][0] == true">{template="includes_toprank_herokills"}</if>
                    <if syntax="$this->settings['HOME']['TOP_RANK']['GUILDS'][0] == true">{template="includes_toprank_guilds"}</if>
                </td>
        	</tr>
        </table>
        <table width="100%" border="0" cellpadding="10" cellspacing="3" class="optionSelect">
        	<tr>
            	<if syntax="$this->settings['HOME']['TOP_RANK']['MRESETS'][0] == true">
                <td height="33" align="center" rel="SelectRanking" id="MResetsGeneral"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['MResets']}</strong></td>
                </if>
                <if syntax="$this->settings['HOME']['TOP_RANK']['MR_DAILY'][0] == true">
                <td height="33" align="center" rel="SelectRanking" id="MResetsDaily"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['MRDaily']}</strong></td>
                </if>
                <if syntax="$this->settings['HOME']['TOP_RANK']['MR_WEEKLY'][0] == true">
                <td height="33" align="center" rel="SelectRanking" id="MResetsWeekly"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['MRWeekly']}</strong></td>
                </if>
                <if syntax="$this->settings['HOME']['TOP_RANK']['MR_MONTHLY'][0] == true">
                <td height="33" align="center" rel="SelectRanking" id="MResetsMonthly"><strong>{$this->lang->words['Home']['TopRank']['Ranks']['MRMonthly']}</strong></td>
                </if>
			</tr>
        </table>
        <if syntax="$this->settings['WEBCACHE']['RANKINGS']['SWITCH'] == true">
        <div class="right"><strong><i>{$this->lang->words['Home']['TopRank']['Cache']}</i></strong></div>
        </if>
    </div>
    </if>