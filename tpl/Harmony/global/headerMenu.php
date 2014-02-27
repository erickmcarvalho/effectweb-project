<div id="smoothmenu1" class="ddsmoothmenu">
        <ul>
            <li><a href="javascript: void(0);" onclick="CTM.Load('?/home','content'); CTM.EW.AutoLoad();">{$this->lang->words['Menu']['Home']}</a></li>
            <li><a href="javascript: void(0);" onclick="CTM.Load('?/userpanel','content');">{$this->lang->words['Menu']['Panel']['Title']}</a>
                <ul>
                    <li><a href="javascript: void(0);" onclick="CTM.Load('?/userpanel/manageChar','content');">{$this->lang->words['Menu']['Panel']['Char']}</a></li>
                </ul>
            </li>
            <li><a href="javascript: void(0);" onclick="CTM.Load('?/informations','content');">{$this->lang->words['Menu']['Infos']['Title']}</a>
                <ul>
                    <li><a href="javascript: void(0);" onclick="CTM.Load('?/informations/team','content');">{$this->lang->words['Menu']['Infos']['Team']}</a></li>
                    <li><a href="javascript: void(0);" onclick="CTM.Load('?/informations/terms','content');">{$this->lang->words['Menu']['Infos']['Rules/Terms']}</a></li>
                </ul> 
            </li>
            <li><a href="javascript: void(0);" onclick="CTM.Load('?/register','content');">{$this->lang->words['Menu']['Register']}</a></li>
            <li><a href="javascript: void(0);" onclick="CTM.Load('?/downloads','content');">{$this->lang->words['Menu']['Downloads']}</a></li>
            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings','content');">{$this->lang->words['Menu']['Rankings']['Title']}</a>
                <ul>
                    <li><a href="javascript: void(0);">{$this->lang->words['Menu']['Rankings']['Resets']}</a>
                        <ul>
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/resetsGeneral','content');">{$this->lang->words['Menu']['Rankings']['RGeneral']}</a></li>
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/resetsDaily','content');">{$this->lang->words['Menu']['Rankings']['RDaily']}</a></li>
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/resetsWeekly','content');">{$this->lang->words['Menu']['Rankings']['RWeek']}</a></li>
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/resetsMonthly','content');">{$this->lang->words['Menu']['Rankings']['RMonth']}</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript: void(0);">{$this->lang->words['Menu']['Rankings']['MReset']}</a>
                        <ul>
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/masterResets','content');">{$this->lang->words['Menu']['Rankings']['MRGeneral']}</a></li>
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/mresetsDaily','content');">{$this->lang->words['Menu']['Rankings']['MRDaily']}</a></li>
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/mresetsWeekly','content');">{$this->lang->words['Menu']['Rankings']['MRWeek']}</a></li>
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/mresetsMonthly','content');">{$this->lang->words['Menu']['Rankings']['MRMonth']}</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript: void(0);">{$this->lang->words['Menu']['Rankings']['Kills']}</a>
                        <ul>
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/pkKills','content');">{$this->lang->words['Menu']['Rankings']['PkKills']}</a></li>
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/heroKills','content');">{$this->lang->words['Menu']['Rankings']['HeroKills']}</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript: void(0);">{$this->lang->words['Menu']['Rankings']['Others']}</a>
                        <ul>
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/level','content');">{$this->lang->words['Menu']['Rankings']['Level']}</a></li>
                            <if syntax="MUSERVER_VERSION >= 5">
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/masterLevel','content');">{$this->lang->words['Menu']['Rankings']['MLevel']}</a></li>
                            </if>
                            <li><a href="javascript: void(0);" onclick="CTM.Load('?/rankings/guilds','content');">{$this->lang->words['Menu']['Rankings']['Guilds']}</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="javascript: void(0);" onclick="CTM.Load('?/contact','content');">{$this->lang->words['Menu']['Contact']}</a></li>
            <li><a href="javascript: void(0);" onclick="CTM.Load('?/coinvip','content');">{$this->lang->words['Menu']['VIP-Coin']['Title']}</a>
                <ul>
                    <li><a href="javascript: void(0);" onclick="CTM.Load('?/coinvip/advantages','content');">{$this->lang->words['Menu']['VIP-Coin']['Advantages']}</a></li>
                    <li><a href="javascript: void(0);" onclick="CTM.Load('?/coinvip/howtobuy','content');">{$this->lang->words['Menu']['VIP-Coin']['HowToBuy']}</a></li>
                    <li><a href="javascript: void(0);" onclick="CTM.Load('?/coinvip/bankdata','content');">{$this->lang->words['Menu']['VIP-Coin']['BankData']}</a></li>
                </ul>
            </li>
            <li><a href="{const='SHOP_LINK'}" target="_blank">{$this->lang->words['Menu']['Store']}</a></li>
            <if syntax="is_null(FORUM_LINK) == false">
            <li><a href="{const='FORUM_LINK'}" target="black">{$this->lang->words['Menu']['Forum']}</a></li>
            </if>
        </ul>
        </div>