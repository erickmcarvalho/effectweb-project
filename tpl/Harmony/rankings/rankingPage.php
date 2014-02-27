	<script type="text/javascript">
    $(function()
    {
        $("#btn-search").click(function()
        {
            if($("#Ranking option:selected").val().length < 1)
                CTM.Message("{$this->lang->words['Rankings']['Generator']['Messages']['SelectRank']}", 1, "rankingResult");
            else if($("#Limit option:selected").val().length < 1)
                CTM.Message("{$this->lang->words['Rankings']['Generator']['Messages']['SelectLimit']}", 1, "rankingResult");
            else
                CTM.AjaxLoad("?app=core&module=rankings&gerate=true", "rankingResult", "frm-rank");
        });
    });
    </script>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['Rankings']['Title']}</span></div>
        <form name="frm-rank" id="frm-rank">
        	<label>{$this->lang->words['Rankings']['Generator']['Rank']} </label>
            <select name="Ranking" id="Ranking">
            	<option value="" disabled="disabled" selected="selected"> -- {$this->lang->words['Words']['Select']}</option>
                <if syntax="$ranking_generator['one_ResetCount_enabled'] == true">
                <optgroup label=" -- {$this->lang->words['Rankings']['Generator']['Select']['Resets']['Category']}">
                	<if syntax="$this->settings['RANKING']['RESETS_GENERAL'][0] == true">
            		<option value="resetsGeneral"> - {$this->lang->words['Rankings']['Generator']['Select']['Resets']['General']}</option>
                    </if>
                    <if syntax="$this->settings['RANKING']['RESETS_DAILY'][0] == true">
                    <option value="resetsDaily"> - {$this->lang->words['Rankings']['Generator']['Select']['Resets']['Daily']}</option>
                    </if>
                    <if syntax="$this->settings['RANKING']['RESETS_WEEKLY'][0] == true">
                    <option value="resetsWeekly"> - {$this->lang->words['Rankings']['Generator']['Select']['Resets']['Weekly']}</option>
                    </if>
                    <if syntax="$this->settings['RANKING']['RESETS_MONTHLY'][0] == true">
                    <option value="resetsMonthly"> - {$this->lang->words['Rankings']['Generator']['Select']['Resets']['Monthly']}</option>
                    </if>
                </optgroup>
                </if>
                <if syntax="$ranking_generator['one_MResetCount_enabled'] == true">
                <optgroup label=" -- {$this->lang->words['Rankings']['Generator']['Select']['MResets']['Category']}">
                	<if syntax="$this->settings['RANKING']['MASTER_RESETS'][0] == true">
            		<option value="masterResets"> - {$this->lang->words['Rankings']['Generator']['Select']['MResets']['General']}</option>
                    </if>
                    <if syntax="$this->settings['RANKING']['MRESETS_DAILY'][0] == true">
                    <option value="mresetsDaily"> - {$this->lang->words['Rankings']['Generator']['Select']['MResets']['Daily']}</option>
                    </if>
                    <if syntax="$this->settings['RANKING']['MRESETS_WEEKLY'][0] == true">
                    <option value="mresetsWeekly"> - {$this->lang->words['Rankings']['Generator']['Select']['MResets']['Weekly']}</option>
                    </if>
                    <if syntax="$this->settings['RANKING']['MRESETS_MONTHLY'][0] == true">
                    <option value="mresetsMonthly"> - {$this->lang->words['Rankings']['Generator']['Select']['MResets']['Monthly']}</option>
                    </if>
                </optgroup>
                </if>
                <if syntax="$ranking_generator['one_KillCount_enabled'] == true">
                <optgroup label=" -- {$this->lang->words['Rankings']['Generator']['Select']['Kills']['Category']}">
                	<if syntax="$this->settings['RANKING']['PK_KILLS'][0] == true">
                    <option value="pkKills"> - {$this->lang->words['Rankings']['Generator']['Select']['Kills']['PkKills']}</option>
                    </if>
                    <if syntax="$this->settings['RANKING']['HERO_KILLS'][0] == true">
                    <option value="heroKills"> - {$this->lang->words['Rankings']['Generator']['Select']['Kills']['HeroKills']}</option>
                    </if>
                </optgroup>
                </if>
                <if syntax="$ranking_generator['one_Others_enabled'] == true">
                <optgroup label=" -- {$this->lang->words['Rankings']['Generator']['Select']['Others']['Category']}">
                	<if syntax="$this->settings['RANKING']['LEVEL'][0] == true">
                	<option value="level"> - {$this->lang->words['Rankings']['Generator']['Select']['Others']['Level']}</option>
                    </if>
                    <if syntax="$this->settings['RANKING']['MASTER_LEVEL'][0] == true">
                	<option value="masterLevel"> - {$this->lang->words['Rankings']['Generator']['Select']['Others']['MLevel']}</option>
                    </if>
                    <if syntax="$this->settings['RANKING']['GUILDS'][0] == true">
                	<option value="guilds"> - {$this->lang->words['Rankings']['Generator']['Select']['Others']['Guilds']}</option>
                    </if>
                </optgroup>
                </if>
			</select>
            <label>&nbsp;&nbsp;{$this->lang->words['Rankings']['Generator']['Limit']} </label>
            <select name="Limit" id="Limit">
            	<foreach loop="$this->settings['RANKING']['GENERATOR']['LIMIT'] as $limit">
                <option value="{$limit}">{$limit} {$this->lang->words['Rankings']['Generator']['Results']}</option>
            	</foreach>
            </select>
            <input type="button" name="btn-search" id="btn-search" value="{$this->lang->words['Rankings']['Generator']['Button']}">
		</form>
        <if syntax="$this->settings['WEBCACHE']['RANKINGS']['SWITCH'] == true">
        <div class="right"><strong><i>{$this->lang->words['Rankings']['Generator']['Cache']}</i></strong></div>
        </if>
	</div>
    <div id="rankingResult">
    <if syntax="$ranking_generator['auto_load_ranking']">
    <script type="text/javascript">
	$(document).ready(function(e)
	{
		if(e)
			CTM.AjaxLoad("?app=core&module=rankings&load={$ranking_generator['auto_load_ranking']}", '*rankingResult');
	});
    </script>
	</if>
    </div>