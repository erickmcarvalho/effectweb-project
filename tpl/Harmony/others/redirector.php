<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="refresh" content="2; url={$redirector['referer']}" />
<link href="{$this->vars['board_url']}{$this->vars['style_dirs']['skin_styles']}redirector.css" rel="stylesheet" type="text/css" />
<title>{$this->lang->words['Redirector']['Title']}</title>
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
	var url_bit = "{$redirector['referer']}";
	window.location = url_bit.replace(new RegExp("&amp;", "g"), "&");
}
//>
</script>
</head>
<body id="redirector">
<div id="all">
	<div class='box-content'>
		<div class="header"><span>{$this->lang->words['Redirector']['SubTitle']}</span></div>
		<p>
			<strong>{$redirector['title']}</strong>
            {$redirector['message']}
			<br /><br />
			{$this->lang->words['Redirector']['Wait']}
			<br />
			<span class='desc'>(<a href="{$redirector['referer']}">{$this->lang->words['Redirector']['Link']}</a>)</span>	
		</p>
	</div>
</div>
</body>
</html>