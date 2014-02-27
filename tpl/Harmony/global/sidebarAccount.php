<if syntax="SESSION_USER_LOGGED == true">
            <ul class="info">
                <li><span>{$this->lang->words['Sidebar']['UserNavigation']['LoggedIn']['Welcome']} </span>{$user_logged_data['info']['member_name']}</li>
                <li><span>{$this->lang->words['Sidebar']['UserNavigation']['LoggedIn']['UserLevel']} </span>{$user_logged_data['info']['member_level']}</li>
                <li><span>{const="COIN_NAME_1"}: </span>{$user_logged_data['info']['member_coin'][1]}</li>
                <if syntax="COIN_NUMBER >= 2">
                <li><span>{const="COIN_NAME_2"}: </span>{$user_logged_data['info']['member_coin'][2]}</li>
                </if>
                <if syntax="COIN_NUMBER == 3">
                <li><span>{const="COIN_NAME_3"}: </span>{$user_logged_data['info']['member_coin'][3]}</li>
                </if>
                <li class="line"><!-- Separator line --></li>
                <li><span><a href="javascript: void(0);" onclick="CTM.Load('?/userpanel','content');">{$this->lang->words['Sidebar']['UserNavigation']['LoggedIn']['UserCP']}</a></span></li>
                <if syntax="$this->functions->CheckTeamACP(USER_ACCOUNT) == true">
                <li><span><a href="{const='ADMINCP_DIRECTORY'}" target="_blank">{$this->lang->words['Sidebar']['UserNavigation']['LoggedIn']['AdminCP']}</a></span></li>
                </if>
                <li><span><a href="javascript: void(0);" onclick="CTM.Load('?app=core&amp;module=global&amp;section=login&amp;do=logout','content');">{$this->lang->words['Sidebar']['UserNavigation']['LoggedIn']['Logout']}</a></span></li>
            </ul>
		<else />
            <form name="AjaxAuthLogin" id="AjaxAuthLogin" class="loginForm">
                <input type="hidden" name="referer" value="{$this->vars['board_url']}{$this->vars['login_url']}" />
                <label>{$this->lang->words['Sidebar']['UserNavigation']['LoginForm']['Login']}</label>
                    <input type="text" name="username" id="username" size="35" maxlength="10" />
                <label>{$this->lang->words['Sidebar']['UserNavigation']['LoginForm']['Pass']}</label>
                    <input type="password" name="password" id="password" size="35" maxlength="10" />
                <input type="button" name="Log_Btn" id="Log_Btn" value="{$this->lang->words['Sidebar']['UserNavigation']['LoginForm']['Button']}" onclick="CTM.AjaxLoad('?app=core&amp;module=global&amp;section=login&amp;do=process&amp;min_login=true','loadPanelAuth', 'AjaxAuthLogin');" style="float:right">
                <p><a href="javascript: void(0);" onclick="CTM.Load('?/recovery', 'content');">{$this->lang->words['Sidebar']['UserNavigation']['LoginForm']['Recovery']}</a></p>
            </form><br />
			<div id="loadPanelAuth"></div>
		</if>