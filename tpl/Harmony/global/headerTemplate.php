<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="Description" content="EffectWeb 2 - Powered by Cetemaster Services">
<meta name="Keywords" content="MuOnline, Private Servers, Mu, CTM, Cetemaster, MuServer, MuGlobal, MuChina, MuKorea, Mu Servers, Top Servers, Mu Online, Itens, Shop, MuShop, MuOnline Shop">
<meta name="Author" content="(CTM) Erick-Master, Litlle, LucasHP">
<meta name="Robots" content="index,follow">
<link href="{$this->vars['board_url']}{$this->vars['style_dirs']['skin_styles']}harmony.css" rel="stylesheet" type="text/css">
<link href="{$this->vars['board_url']}{$this->vars['style_dirs']['skin_styles']}ddsmoothmenu.css" rel="stylesheet" type="text/css">
<link href="{$this->vars['board_url']}{$this->vars['style_dirs']['skin_styles']}store.css" rel="stylesheet" type="text/css">
<link href="{$this->vars['board_url']}{$this->vars['style_dirs']['skin_styles']}jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css">
<link href="{$this->vars['board_url']}{$this->vars['style_dirs']['styles']}sexyalertbox.css" rel="stylesheet" type="text/css">
<link href="{$this->vars['board_url']}{$this->vars['style_dirs']['styles']}sexy-tooltips.css" rel="stylesheet" type="text/css">
<link href="{$this->vars['board_url']}{$this->vars['style_dirs']['styles']}jquery.lightbox.css" rel="stylesheet" type="text/css">
<link href="{$this->vars['board_url']}{$this->vars['style_dirs']['styles']}jquery.uploadify.css" rel="stylesheet" type="text/css">
<link href="{$this->vars['board_url']}{$this->vars['style_dirs']['styles']}jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css">
<link href="{$this->vars['board_url']}{$this->vars['style_dirs']['styles']}facebox.css" rel="stylesheet" type="text/css">
<link href="{$this->vars['board_url']}{$this->vars['style_dirs']['styles']}MuItemData.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}jquery/jquery.library.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}jquery/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}jquery/jquery.mousewheel.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}jquery/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}jquery/jquery.sexyalertbox.v1.2.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}jquery/jquery.sexy-tooltips.v1.1.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}jquery/jquery.uploadify.v2.1.4.min.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}jquery/jquery.lightbox.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}jquery/jquery.fancybox.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}sources/functions.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}sources/facebox.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}ctm.framework.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}ctm.effectweb.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['skin_res']}javascripts/ddsmoothmenu.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['skin_res']}javascripts/menu.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['style_dirs']['js']}uploadify/swfobject.js"></script>
<script type="text/javascript" src="{$this->vars['board_url']}{$this->vars['language_js']}"></script>
{template="headerJavascript"}
<title>{$this->vars['title_site']}</title>
</head>
<body>
<div id="all">
    <div id="banner"></div>
    <div id="navigation">
        <div id="ajaxLoading">{$this->lang->words['Core']['AjaxLoading']}</div>
        {template="headerMenu"}
    </div>
    <div id="aside">
        <div class="box-aside">
            <div class="header"><span>{$this->lang->words['Sidebar']['UserNavigation']['Title']}</span></div>
            {template="sidebarAccount"}
        </div>
        <div class="box-aside">
            <div class="header"><span>{$this->lang->words['Sidebar']['Infos']['Title']}</span></div>
            <ul class="info">
                <li><span>{$this->lang->words['Sidebar']['Infos']['Name']} </span>{const="SERVER_NAME"}</li>
                <li><span>{$this->lang->words['Sidebar']['Infos']['Version']} </span>{const="SERVER_VERSION"}</li>
                <li><span>{$this->lang->words['Sidebar']['Infos']['Experience']} </span>{const="SERVER_EXPERIENCE"}</li>
                <li><span>{$this->lang->words['Sidebar']['Infos']['Drop']} </span>{const="SERVER_DROP"}</li>
                <li><span>{$this->lang->words['Sidebar']['Infos']['BugBless']} </span>{$this->vars['sidebar']['infos']['bug_bless']}</li>
                <li><span>{$this->lang->words['Sidebar']['Infos']['ResetType']} </span>{$this->vars['sidebar']['infos']['reset_type']}</li>
                <li class="line"><!-- Separator line --></li>
                <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['Accounts']} </span>{$this->vars['sidebar']['infos']['count']['totalAccounts']}</li>
                <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['Characters']} </span>{$this->vars['sidebar']['infos']['count']['totalCharacters']}</li>
                <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['Guilds']} </span>{$this->vars['sidebar']['infos']['count']['totalGuilds']}</li>
                <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['AccountsVIP'][1]} </span>{$this->vars['sidebar']['infos']['count']['totalVIPAccounts'][1]}</li>
                <if syntax="VIP_NUMBER >= 2">
                <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['AccountsVIP'][2]} </span>{$this->vars['sidebar']['infos']['count']['totalVIPAccounts'][2]}</li>
                </if>
                <if syntax="VIP_NUMBER >= 3">
                <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['AccountsVIP'][3]} </span>{$this->vars['sidebar']['infos']['count']['totalVIPAccounts'][3]}</li>
                </if>
                <if syntax="VIP_NUMBER >= 4">
                <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['AccountsVIP'][4]} </span>{$this->vars['sidebar']['infos']['count']['totalVIPAccounts'][4]}</li>
                </if>
                <if syntax="VIP_NUMBER == 5">
                <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['AccountsVIP'][5]} </span>{$this->vars['sidebar']['infos']['count']['totalVIPAccounts'][5]}</li>
                </if>
                <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['Banned']['Accounts']} </span>{$this->vars['sidebar']['infos']['count']['totalBanned']['accounts']}</li>
                <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['Banned']['Characters']} </span>{$this->vars['sidebar']['infos']['count']['totalBanned']['characters']}</li>
                <li>
                    <span>{$this->lang->words['Sidebar']['Infos']['RecordOnline']['Info']['General']} </span>
                    <a href="javascript: void(0);" id="recordGeneral">
                        <strong>{$this->vars['sidebar']['infos']['recordOnline']['general']}</strong>
                    </a>
                </li>
                <li>
                    <span>{$this->lang->words['Sidebar']['Infos']['RecordOnline']['Info']['Today']} </span>
                    <a href="javascript: void(0);" id="recordToday">
                        <strong>{$this->vars['sidebar']['infos']['recordOnline']['today']}</strong>
                    </a>
                </li> 
                <li>
                	<span>
                        <a href="javascript: void(0);" onclick="CTM.Load('?/informations', 'content');">
                            [{$this->lang->words['Sidebar']['Infos']['MoreInfos']}]
                        </a>
                    </span>
                </li>
            </ul>
        </div>
        <div class="box-aside">
            <div class="header"><span>{$this->lang->words['Sidebar']['ServerList']['Title']}</span></div>
            {template="sidebarServerList"}
        </div>
        <div class="box-aside">
            <div class="header"><span>{$this->lang->words['Sidebar']['Poll']['Title']}</span></div>
            <div id="WebAjaxPoll"><script>CTM.AjaxLoad('?app=core&ajax=poll','.WebAjaxPoll');</script></div>
        </div>
        <div class="box-aside">
            <div class="header"><span>{$this->lang->words['Sidebar']['GameMasters']['Title']}</span></div>
            <div id="TeamList">
                <ul class="info">
                    <li><a href="javascript: void(0);" onclick="CTM.AjaxLoad('?app=core&ajax=gamemasters','.TeamList');">[{$this->lang->words['Sidebar']['GameMasters']['Load']}]</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="content">
    {#TEMPLATE_CONTENT#}
    </div>
    <div id="footer">
        <div class="left">
            <p>{$this->vars['web_footer']}</p>
            <p>Powered by <a href="?app=core&amp;module=global&amp;section=sysinfo" rel="facebox">Cetemaster Services</a></p>
            <p>Copyright &copy; {$this->lang->words['Footer']['Copyright']}</p>
            <if syntax="$this->settings['WEBPUBLIC']['SELECTOR']['TEMPLATES'] == true">
			<form name="SelectWebTemplate" id="SelectWebTemplate" action="{$this->vars['path_url']}" method="post">
				<label>{$this->lang->words['Footer']['Template']}</label>
				<select name="tpl" id="tpl" onchange="SelectWebTemplate.submit();">
					<foreach loop="$this->settings['WEBPUBLIC']['TEMPLATES'] as $key => $value">
					<php>$selected = $this->output->templateId == $key ? " selected=\"selected\"" : NULL;</php>
					<option value="{$key}"{$selected}>{$value[1]}</option>
					</foreach>
				</select>
			</form>
            </if>
        </div>
        <div class="right">
            <p>{$this->lang->words['Footer']['MozillaFirefox']}</p>
            <p>{$this->lang->words['Footer']['LoadTime']}</p>
            <p>&nbsp;</p>
            <if syntax="$this->settings['WEBPUBLIC']['SELECTOR']['LANGUAGES'] == true">
            <form name="SelectWebLanguage" id="SelectWebLanguage" action="{$this->vars['path_url']}" method="post">
                <label>{$this->lang->words['Footer']['Language']}</label>
                <select name="lang" id="lang" onchange="SelectWebLanguage.submit();">
                    <foreach loop="$this->settings['WEBPUBLIC']['LANGUAGES'] as $key => $value">
                    <php>$selected = $this->lang->languageId == $key ? " selected=\"selected\"" : NULL;</php>
						<option value="{$key}"{$selected}>{$value[1]}</option>
                    </foreach>
                </select>
            </form>
            </if>
        </div>
        <span id="select-footer"></span>
    </div>
</div>
</body>
</html>