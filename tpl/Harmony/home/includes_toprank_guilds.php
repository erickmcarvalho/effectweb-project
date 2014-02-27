                	<div id="Ranking_Guilds" class="currentRanking">
                    	<if syntax="count($home_module['rankings']['guilds']) > 0">
                        <if syntax="$this->settings['HOME']['TOP_RANK']['GUILDS'][2] == true">
                    	<ul class="topRanks">
                        	<foreach loop="$home_module['rankings']['guilds'] as $rank">
                        	<li>
                            	<a href="javascript: void(0);" class="guildLink" rel="{$rank['name']}">
                                    <span>{$rank['order']}&ordm; - {$rank['name']}</span>
                                    <img src="{$rank['image']}" alt="{$rank['name']}">
                                </a>
                                <span>( {$this->lang->words['Home']['TopRank']['Words']['Score']}: {$rank['result']} )</span>
                			</li>
                            </foreach>
                		</ul>
                        <else />
                        <ul class="ranks-classic">
                            <li>
                                <span>{$this->lang->words['Home']['TopRank']['Words']['Position']}</span>
                                <span>{$this->lang->words['Home']['TopRank']['Words']['Name']}</span>
                                <span>{$this->lang->words['Home']['TopRank']['Words']['Score']}</span>
                            </li>
                            <foreach loop="$home_module['rankings']['guilds'] as $rank">
                            <li>
                                <a href="javascript: void(0);" class="guildLink" rel="{$rank['name']}">
                                    <span>{$rank['order']}&ordm;</span>
                                    <span>{$rank['name']}</span>
                                    <span>{$rank['result']}</span>
                                </a>
                            </li>
                            </foreach>
                        </ul>
                        </if>
                        </if>
               		</div>