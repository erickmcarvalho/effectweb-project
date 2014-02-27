<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP API: Application Skin
 * Last Update: 19/08/2012 - 15:08h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_ACPSkin_Global extends CTM_ACPCommand
{
	/**
	 *	Dashboard Header Template
	 *
	 *	@return	string	HTML String
	*/
	public function global_header($global_content, $global_sidebar)
	{
		$date_year = date("Y");
		$server_name = SERVER_NAME;
		$admincp_version = ACP_PUBLIC_VERSION;
		
		$CTM_HTML = <<<HTML
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{$this->acp_vars['title']}</title>
<meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/style.css">
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/admin.css">

<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/modal.css" />
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/sexyalertbox.css" />
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/sexy-tooltips.css" />

<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/demo_table_jui.css">
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/superfish.css">
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/uniform.default.css">
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/jquery.wysiwyg.css">
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/jquery.fancybox-1.3.4.css">
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/facebox.css">
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/smoothness/jquery-ui-1.8.8.custom.css">

<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/sexyalertbox.css">
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/sexy-tooltips.css">
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['root_url']}public/style_css/jquery.uploadify.css">

<!--[if lte IE 8]>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/html5.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/selectivizr.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/excanvas.min.js"></script>
<![endif]-->

<!-- scripts (jquery) -->
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.library.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.mousewheel.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery-ui-1.8.8.custom.min.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.uniform.min.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.cookie.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.sexyalertbox.v1.2.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.sexy-tooltips.v1.1.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.flot.min.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.fancybox.js"></script>

<!-- scripts (custom) -->
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/superfish.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/cufon-yui.js"></script>
<!--<script type="text/javascript" src="public/skin_js/Delicious_500.font.js"></script>-->
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/custom.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/facebox.js"></script>

<!-- scripts (AjaxUpload) -->
<script type="text/javascript" src="{$this->acp_vars['root_url']}public/javascripts/uploadify/swfobject.js"></script>
<script type="text/javascript" src="{$this->acp_vars['root_url']}public/javascripts/jquery/jquery.uploadify.v2.1.4.min.js"></script>

<!-- scripts (CTM) -->
<script type="text/javascript" src="{$this->acp_vars['root_url']}public/javascripts/ctm.framework.js"></script>
</head>
<body class="fluid">

<header id="top">
	<div id="ajaxLoading">{$this->lang->words['Header']['General']['AjaxLoading']}</div>
	<div class="container_12 clearfix">
		<div id="logo" class="grid_5">
			 <a id="site-title" href="?" title="Effect Web v2.x :: Admin Control Panel {$admincp_version}"><span><!-- Cetemaster Services --></span></a>
			 <!-- <a id="view-site" href="#">View Site</a> -->
		</div>

		<div class="grid_4" id="colorstyle">&nbsp;</div>

		<div id="userinfo" class="grid_3">
			{$this->lang->words['Header']['Member']['Welcome']} <a href="#">{$this->member['account']['data']['Name']}</a>
		</div>
	</div>
</header>

<nav id="topmenu">
	<div class="container_12 clearfix">
		<div class="grid_12">
			<ul id="mainmenu" class="sf-menu">
				<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=system">{$this->lang->words['Header']['Menu']['System']['Title']}</a></li>
                <li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members">{$this->lang->words['Header']['Menu']['Members']['Title']}</a></li>
                <li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=server">{$this->lang->words['Header']['Menu']['Server']['Title']}</a></li>
                <li><a href="{$this->acp_vars['acp_url']}?app=effectweb">{$this->lang->words['Header']['Menu']['Site']['Title']}</a></li>
                <li><a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=support">{$this->lang->words['Header']['Menu']['Support']['Title']}</a></li>
                <li><a href="{$this->acp_vars['acp_url']}?app=effectweb&amp;module=financial">{$this->lang->words['Header']['Menu']['Financial']['Title']}</a></li>
			</ul>
			<ul id="usermenu">
				<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=global&amp;section=login&amp;do=logout">{$this->lang->words['Header']['Member']['Logout']}</a></li>
			</ul>
		</div>
	</div>
</nav>

<section id="content">
	<section class="container_12 clearfix">
		<section id="main" class="grid_9 push_3">
			{$global_content}
		</section>

		<aside id="sidebar" class="grid_3 pull_9">
			{$global_sidebar}
		</aside>
	</section>
</section>

<footer id="bottom">
	<section class="container_12 clearfix">
		<div class="grid_6">
			Copyright &copy; {$date_year} <a href="../">{$server_name}</a> - {$this->lang->words['Header']['Footer']['Copyright']}<br />
            {$this->lang->words['Header']['Footer']['LoadTime']}
		</div>
		<div class="grid_6 alignright">
			 Effect Web 2 :: Admin Control Panel {$admincp_version} - Powered by <a href="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=sysinfo" rel="facebox">{$this->acp_vars['ctm_name']}</a><br />
             Copyright &copy; {$this->acp_vars['ctm_year']} <a href="http://{$this->acp_vars['ctm_addr']}" target="_blank">{$this->acp_vars['ctm_addr']}</a> - All Rights Reserved.
		</div>
	</section>
</footer>

</body>
</html>
HTML;

		return $CTM_HTML;
	}
    /**
	 *	Login Template
	 *
	 *	@return	string	HTML String
	*/
    public function auth_login($message = NULL)
    {
		$CTM_HTML = <<<HTML
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{$this->acp_vars['title']}</title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/style.css">
<!--[if lte IE 8]>
<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/jquery/jquery.library.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/cufon-yui.js"></script>
<script type="text/javascript" src="{$this->acp_vars['acp_url']}skin_cp/javascripts/Delicious_500.font.js"></script>
<script type="text/javascript">
$(function() {
	Cufon.replace('#site-title');
	$('.msg').click(function() {
		$(this).fadeTo('slow', 0);
		$(this).slideUp(341);
	});
});
</script>

</head>
<body>

<header id="top">
	<div class="container_12 clearfix">
		<div id="logo" class="grid_5">
			 <a id="site-title" href="#"><span><!-- Cetemaster Services --></span></a>
		</div>
	</div>
</header>

<div id="login" class="box">
	<h2>Login</h2>
	<section>
HTML;
	if(!empty($message))
		$CTM_HTML .= "			<div class=\"error msg\"> ".$message."</div>";

	$CTM_HTML .= <<<HTML
		<form name="AdminCPLogin" id="AdminCPLogin" method="post" action="?app=core&amp;module=global&amp;section=login&amp;do=process">
        	<input type="hidden" name="referer" id="referer" value="{$this->acp_vars['current_url']}" />
			<dl>
				<dt><label for="username">{$this->lang->words['Auth']['Login']['Form']['Login']}</label></dt>
				<dd><input type="text" name="username" id="username" /></dd>
			
				<dt><label for="password">{$this->lang->words['Auth']['Login']['Form']['Password']}</label></dt>
				<dd><input type="password" name="password" id="password" /></dd>
			</dl>
			<p>
				<button type="submit" class="button" id="loginbtn">{$this->lang->words['Auth']['Login']['Form']['Button']}</button>
			</p>
		</form>
	</section>
</div>

</body>
</html>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	Redirect Template
	 *
	 *	@return	string	HTML String
	*/
    public function global_redirect($title, $message, $referer = "?")
    {
    	if(!empty($message))
        	$message = "<br />".$message;
            
		$CTM_HTML .= <<<HTML
<!DOCTYPE HTML>
<html lang="en">
<head>
<title>{$this->lang->words['Redirector']['Title']}</title>
<meta charset="utf-8">
<meta http-equiv="refresh" content="2;URL={$referer}" />
<link rel="stylesheet" type="text/css" href="{$this->acp_vars['acp_url']}skin_cp/styles/style.css">
<!--[if lte IE 8]>
<script type="text/javascript" src="js/html5.js"></script>
<![endif]-->
<script type='text/javascript'>
//<![CDATA[
// Fix Mozilla bug: #209020
if(navigator.product == "Gecko")
{
	navstring = navigator.userAgent.toLowerCase();
	geckonum = navstring.replace(/.*gecko\/(\d+)/, "$1");
	setTimeout("moz_redirect()", 1500);
}
function moz_redirect()
{		
	var url_bit = "{$referer}";
	window.location = url_bit.replace(new RegExp("&amp;", "g"), "&");
}
//>
</script>
</head>
<body>

<div id="login" class="box">
	<h2>{$this->lang->words['Redirector']['SubTitle']}</h2>
	<section>
		<strong>{$title}</strong>
        {$message}
        <br />
        <br />
        <i>{$this->lang->words['Redirector']['Wait']}</i>
        <br />
        <a href="{$referer}">{$this->lang->words['Redirector']['Link']}</a>
	</section>
</div>

</body>
</html>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	Permission Error
	 *
	 *	@return	string	HTML String
	*/
    public function permission_error()
    {
    	$CTM_HTML = NULL;
        
        if(loadIsAjax())
        	$CTM_HTML .= <<<HTML
            <div style="width:600px">
HTML;

		$CTM_HTML .= <<<HTML
<article>
				<h1>{$this->lang->words['PermissionError']['Title']}</h1>
                	<div class="error msg">{$this->lang->words['PermissionError']['Message']}</div>
			</article>
HTML;

		if(loadIsAjax())
        	$CTM_HTML .= <<<HTML
            </div>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	Module Failed
	 *
	 *	@return	string	HTML String
	*/
    public function module_failed()
    {
    	$CTM_HTML = NULL;
        
        if(loadIsAjax())
        	$CTM_HTML .= <<<HTML
            <div style="width:600px">
HTML;

		$CTM_HTML .= <<<HTML
<article>
				<h1>{$this->lang->words['ModuleFailed']['Title']}</h1>
                	<div class="error msg">{$this->lang->words['ModuleFailed']['Message']}</div>
			</article>
HTML;

		if(loadIsAjax())
        	$CTM_HTML .= <<<HTML
            </div>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	Module Unavailable
	 *
	 *	@return	string	HTML String
	*/
    public function module_unavailable()
    {
    	$CTM_HTML = NULL;
        
        if(loadIsAjax())
        	$CTM_HTML .= <<<HTML
            <div style="width:600px">
HTML;

		$CTM_HTML .= <<<HTML
<article>
				<h1>{$this->lang->words['ModuleUnavailable']['Title']}</h1>
                	<div class="error msg">{$this->lang->words['ModuleUnavailable']['Message']}</div>
			</article>
HTML;

		if(loadIsAjax())
        	$CTM_HTML .= <<<HTML
            </div>
HTML;

		return $CTM_HTML;
    }
}

$callSkinCache = new CTM_ACPSkin_Global();
$callSkinCache->registry();