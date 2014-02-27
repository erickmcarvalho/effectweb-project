<?php
global $ErrorMessage, $ExtraMessages, $AllOk, $ProductInfo, $LicenseInfo, $DomainAddress, $IPAddress;

if(CTM_DEVELOPER_MODE == TRUE)
{
	$SerialKey = explode("-", "D84AE-5D6F0-E26C5-E93BE-50479");
}
else
{
	$SerialKey = array(NULL, NULL, NULL, NULL, NULL);

	if($LicenseInfo['serialKey'])
		$SerialKey = $LicenseInfo['serialKey'];
}

if(loadIsAjax() == true)
{
	if($AllOk == true)
	{
		exit("<script>activationSucceed();</script>");
	}
	else
	{
		if($ExtraMessages)
		{
			$extra = "<div class='warning-box'> ";
			
			foreach($ExtraMessages as $msg)
			{
				$extra .= "&raquo; ".$msg."<br />\n";
			}
			
			$extra .= "</div>";
		}
		
		exit("<div class='error-box'> <strong>{$ErrorMessage}</strong></div>{$extra}");
	}
}

if(!empty($ErrorMessage))
	$licenseError = "<h2>{$ErrorMessage}</h2>";
	
if($LicenseInfo)
{
	$licenseData = <<<HTML
	<blockquote><h3><strong>Product License:</strong></h3><br />
	<table width="40%" border="0">
		<tr>
			<td>License Holder:</td>
			<td style="color: #06c"><strong>{$LicenseInfo['customerName']}</strong></td>
		</tr>
		<tr>
			<td>Licensed to:</td>
			<td style="color: #06c"><strong>{$LicenseInfo['customerCompany']}</strong></td>
		</tr>
		<tr>
			<td>E-Mail:</td>
			<td style="color: #06c"><strong>{$LicenseInfo['customerEmail']}</strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>License:</td>
			<td style="color: #06c"><strong>{$LicenseInfo['licenseCodename']}</strong></td>
		</tr>
		<tr>
			<td>Expiration:</td>
			<td style="color: #06c"><strong>{$LicenseInfo['expiration']}</strong></td>
		</tr>
	</table>
	</blockquote>
HTML;
}

$CTM_HTML = <<<EOF
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="skin_cp/styles/sexyalertbox.css">
<style type="text/css">
body
{
	background: #eee; 
	margin: 0; 
	padding: 0;
}
h1
{
	display: block; 
	clear: both; 
	margin: 0 0 5px 0; 
	padding: 10px; 
	background: #222; 
	color: #fff; 
	font: bold 20px Tahoma, Geneva, sans-serif;
}
h2
{
	display: block; 
	clear: both; 
	color: #882424; 
	margin: 5px; 
	border: 1px solid #e8868f; 
	border-radius: 5px; 
	-moz-border-radius: 5px; 
	-webkit-border-radius: 5px; 
	background: #fec3cd; padding:10px; 
	font: bold 14px Tahoma, Geneva, sans-serif;
}
h3
{
	display: block; 
	clear: both; 
	margin: 0; 
	font: bold 14px Tahoma, Geneva, sans-serif;
}
blockquote
{
	display: block; 
	clear: both; 
	color: #666; 
	margin: 5px; 
	border: 1px solid #ddd; 
	border-radius: 5px; 
	-moz-border-radius: 5px; 
	-webkit-border-radius: 5px; 
	background: #eee; 
	padding: 10px; 
	font: 11px Tahoma, Geneva, sans-serif;
}
a
{
	text-decoration: none;
	color: #09f;
} 
a:hover
{
	color: #06c;
}
a.reload
{
	display: block;
	margin: 10px; 
	font: 14px Tahoma, Geneva, sans-serif; 
}
.activate
{
	text-align:left;
	margin:0 auto;
}
.activate input.field
{
	font:11px Verdana;
	
	border:1px solid #ddd;
	background:#fff url(skin_cp/images/form_input.gif) repeat-x;
	padding:0px 3px;
}
.activate input.button
{
	padding: 2.5px 5px;
	font:   bold 11px Tahoma, Calibri, Verdana, Geneva, sans-serif;
	border:1px solid #a8a8a8;
	/*border-bottom: 1px solid #e0e0e0;*/
	color:#424242;
	background:#e9e9e9 url(skin_cp/images/submit.png) repeat-x top left;
	-moz-border-radius:0px;
	-webkit-border-radius:0px;
}
.activate input.button:hover
{
	cursor: pointer;
	background: #efefef;
	color: #424242;
}
.warning-box 
{
	display:block; 
	border:1px solid #efdc75; 
	background: url(skin_cp/images/icons/exclamation.png) no-repeat scroll 8px 55% #fff7cb; 
	padding:10px 10px 10px 35px; 
	margin:0; 
	color:#DB7701; 
	font-size:13px; 
	position:relative;
}
.warning-box a 
{
	color:#DB7701; 
	border-bottom:#DB7701 1px solid;
	text-decoration: none;
}
.warning-box a:hover 
{
	color:#DB7701; 
	border-bottom:none !important;
}
.success-box 
{
	display:block; 
	border:1px solid #b3dc7c; 
	background: url(skin_cp/images/icons/tick.png) no-repeat scroll 8px 55% #e8ffca; 
	padding:10px 10px 10px 35px; margin:0; 
	color:#527A19; 
	font-size:13px; 
	position:relative;
}
.success-box a 
{
	color:#527A19; 
	border-bottom:#527A19 1px solid;
	text-decoration: none;
}
.success-box a:hover 
{
	color:#527A19; 
	border-bottom:none !important;
}
.error-box 
{
	display:block; 
	border:1px solid #ebb1b1;
	background: url(skin_cp/images/icons/cross.png) no-repeat scroll 8px 55% #ffd6d6; 
	padding:10px 10px 10px 35px; 
	margin:0; 
	color:#9d2121; 
	font-size:13px; 
	position:relative;
}
.error-box a 
{
	color:#9d2121; 
	border-bottom:#9d2121 1px solid;
	text-decoration: none;
}
.error-box a:hover 
{
	color:#9d2121; 
	border-bottom:none !important;
}
.warning-box, .success-box, .error-box 
{
	margin-bottom:20px; 
	margin-top:5px; 
	-moz-border-radius:5px; 
	-webkit-border-radius:5px; 
	border-radius:5px; 
	overflow:hidden;
}
#ajaxLoading
{
	background-color:#6f8f52;
	color:#fff;
	text-align:center;
	padding:6px;
	width:15%;
	top:0px;
	left:40%;
	border-radius:0 0 5px 5px;
	-moz-border-radius:0 0 5px 5px;
	-webkit-border-bottom-left-radius:5px;
	-webkit-border-bottom-right-radius:5px;
	z-index:10000;
	position:fixed;
	display:none;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}
</style>
<title>Cetemaster Product License</title>
<script type="text/javascript" src="skin_cp/javascripts/jquery/jquery.library.js"></script>
<script type="text/javascript" src="skin_cp/javascripts/jquery/jquery.sexyalertbox.v1.2.js"></script>
<script type="text/javascript" src="skin_cp/javascripts/jquery/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="../public/javascripts/ctm.framework.js"></script>
<script type="text/javascript">
$(function()
{
	var DefaultHost = "{$DomainAddress}";
	var DefaultIP = "{$IPAddress}";
	
	CTM.VARS['AJAX_LOADING_IMG'] = "skin_cp/images/loadActivate.gif";
	
	function checkSerialKeyNULL()
	{
		if($("#SerialKey-1").val().length != 5) return true;
		if($("#SerialKey-2").val().length != 5) return true;
		if($("#SerialKey-3").val().length != 5) return true;
		if($("#SerialKey-4").val().length != 5) return true;
		if($("#SerialKey-5").val().length != 5) return true;
		
		return false;
	}
	
	$("#ActivateSerial").click(function()
	{
		if($("#DomainAddress").val().length < 1)
		{
			setResult("Fill in the Domain Address.", "warning");
		}
		else if($("#IPAddress").val().length < 1)
		{
			setResult("Fill in the IP Address.", "warning");
		}
		else if(checkSerialKeyNULL())
		{
			setResult("Fill in the correct Serial Key.", "warning");
		}
		else if($("#DomainAddress").val() != DefaultHost || $("#IPAddress").val() != DefaultIP)
		{
			ajaxLoad = false;
			
			Sexy.confirm("The Domain/IP Address inserted in field is different from default.<br />Is that correct?", {onComplete : function(result)
			{
				if(result == true)
					CTM.AjaxLoad("?activate=true", "CommandResult", "ActivateProduct");
			}});
		}
		else
		{
			CTM.AjaxLoad("?activate=true", "CommandResult", "ActivateProduct");
		}
	});
});
function setDomain()
{
	string = $("#DomainHost").val().toLowerCase().replace(/(http:\/\/|https:\/\/|www\.|(:.*|\/.*)|[^0-9a-z\-\.])/i, "");
	$("#DomainHost").val(string);
}
function setIPAddress()
{
	string = $("#IPAddress").val().replace(/[^0-9\.]/i, "");
	$("#IPAddress").val(string);
}
function setSerial(field)
{
	string = $("#SerialKey-"+field).replace(/[^0-9A-Z]/i, "").toUpperCase();
	$("#SerialKey-"+field).val(string);
}
function setResult(message, box)
{
	//$("#CommandResult").fadeOut("fast", function()
	//{
		$("#CommandResult").html("<div class=\""+box+"-box\"> "+message+"</div>");
	//});
	//$("#CommandResult").fadeIn("slow");
}
	
function activationSucceed()
{
	setResult("<script>CTM.RedirectCount"+"('?', 5, 'time');"+"<"+"/script>\
	<strong>Product Actived!</strong><br />\
	The Effect Web is actived with success.<br /><br /> \
	You will redirected in <strong id=\"time\">6</strong> seconds.<br /><br />\
	<a target=\"_blank\" href=\"../\">Click here</a> to open the site, or wait to be redirected to the AdminCP.", "success");
}
</script>
</head>
<body>
<div id="ajaxLoading" style="display:none">Connecting to Cetemaster's Servers...</div>
	<h1>CTM Product Activation</h1>
    {$licenseError}
    <blockquote>Obtain a new license for this domain or/and IP.<br />
	Access <a target="_blank" href="http://www.cetemaster.com.br">www.cetemaster.com.br</a> or contact us in <a href="mailto:contato@cetemaster.com.br">contato@cetemaster.com.br</a>
	<br />
	For buy a new license of product, <a target="_blank" href="http://www.cetemaster.com.br/products/effectweb/">click here</a>.
	</blockquote>
    {$licenseData}
	<form name="ActivateProduct" id="ActivateProduct" class="activate">
	<blockquote><h3><strong>Activate Product:</strong></h3><br />
	<table width="40%" border="0">
		<tr>
			<td>Product:</td>
			<td style="color: #06c"><strong>Effect Web 2</strong></td>
		</tr>
		<tr>
			<td>Version:</td>
			<td style="color: #06c"><strong>{$ProductInfo['version']}</strong></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Host Address:</td>
			<td><input type="text" class="field" size="20" name="DomainAddress" id="DomainAddress" value="{$DomainAddress}" onkeyup="setDomain();" /></td>
		</tr>
		<tr>
			<td>IP Address:</td>
			<td><input type="text" class="field" size="20" name="IPAddress" id="IPAddress" value="{$IPAddress}" onkeyup="setIPAddress();"  /></td>
		</tr>
		<tr>
			<td>Serial:</td>
			<td>
				<input type="text" class="field" size="5" maxlength="5" name="SerialKey-1" id="SerialKey-1" onkeyup="setSerial(1);" value="{$SerialKey[0]}" /> - 
				<input type="text" class="field" size="5" maxlength="5" name="SerialKey-2" id="SerialKey-2" onkeyup="setSerial(2);" value="{$SerialKey[1]}" /> - 
				<input type="text" class="field" size="5" maxlength="5" name="SerialKey-3" id="SerialKey-3" onkeyup="setSerial(3);" value="{$SerialKey[2]}" /> -
				<input type="text" class="field" size="5" maxlength="5" name="SerialKey-4" id="SerialKey-4" onkeyup="setSerial(4);" value="{$SerialKey[3]}" /> -
				<input type="text" class="field" size="5" maxlength="5" name="SerialKey-5" id="SerialKey-5" onkeyup="setSerial(5);" value="{$SerialKey[4]}" />
			</td>
		</tr>
		<tr>
			<td><br /><input type="button" class="button" id="ActivateSerial" value="Activate License" /></td>
		</tr>
	</table><br />
    <strong>Copyright &copy; 2013 <a target="_blank" href="http://www.cetemaster.com.br">Cetemaster Services</a> - All Rights Reserved.</strong>
	</form>
	</blockquote>
    <div id="CommandResult"></div>
    <div id="SuccessMessage"></div>
</body>
</html>
EOF;
?>