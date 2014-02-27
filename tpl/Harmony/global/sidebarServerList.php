<if syntax="$this->settings['SERVERLIST']['SWITCH'] == true && count($global_serverlist['servers']) > 0">
            <script type="text/javascript">
            loadServers = new Array();
            <foreach loop="$global_serverlist['servers'] as $key => $value">
            loadServers['{$key}'] = {CURRENT_STYLE: ".green-gauge", COUNT: {$value['count']}};
            </foreach>
            $(document).ready(function(e)
            {
                if(e)
                {
                    for(GS_ID in loadServers)
                    {
                        var setStyle = ".green-gauge";
                        if(loadServers[GS_ID]['COUNT'] >= 80) setStyle = ".red-gauge";
                        
                        $("#ServerID_GS-"+GS_ID+" .green-gauge").attr("class", setStyle.replace(".", ""));
                        loadServers[GS_ID]['CURRENT_STYLE'] = setStyle;
                    }
                }
            });
            
            function updateServerCount(GS_ID, Count)
            {
                var setStyle = ".green-gauge";
                if(Count >= 80) setStyle = ".red-gauge";
                
                $("#GS-"+GS_ID+"_Count").html(Count+"%");
                $("#ServerID_GS-"+GS_ID+" "+loadServers[GS_ID]['CURRENT_STYLE']).css("width", Count+"%");
                $("#ServerID_GS-"+GS_ID+" "+loadServers[GS_ID]['CURRENT_STYLE']).attr("class", setStyle.replace(".", ""));
                
                loadServers[GS_ID] = {CURRENT_STYLE: setStyle, COUNT: Count};
            }
            </script>
            </if>
            <div id="ServerRefresh" style="display: none;"></div>
            <ul class="info">
                <if syntax="$this->settings['SERVERLIST']['SWITCH'] == true && count($global_serverlist['servers']) > 0">
                <foreach loop="$global_serverlist['servers'] as $key => $value">
                <li>
                    <span>{$value['name']} : </span>
                    <a href="javascript: void(0);" onclick="CTM.Load('?/usersonline/room-{$key}','content');">
                        <strong id="GS-{$key}_Count">{$value['count']}%</strong>
                    </a>
                    <div class="border-bar" id="ServerID_GS-{$key}">
                        <div class="green-gauge" style="width: {$value['count']}%"><!-- Bar --></div>
                    </div>
                </li>
                </foreach>
                <li class="line"><!-- Separator line --></li>
                </if>
                <li>
                    <span>{$this->lang->words['Sidebar']['ServerList']['TotalOnline']} </span>
                    <a href="javascript: void(0);" onclick="CTM.Load('?/usersonline','content');"><strong id="TotalOnline">{$global_serverlist['totalOnline']}</strong></a>
                    <a href="javascript: void(0);" onclick="CTM.AjaxLoad('?app=core&amp;ajax=refreshServers', 'ServerRefresh');">
                        <img src="{$this->vars['board_url']}{$this->vars['style_dirs']['images']}icons/refresh.png" width="10" height="10" border="0">
                    </a>
                </li>
            </ul>