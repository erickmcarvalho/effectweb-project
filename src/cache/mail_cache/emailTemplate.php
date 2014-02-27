<?php

$emailTemplate = <<<HTML
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CTM.EffectWeb - E-Mail Message</title>
<meta name="Description" content="CTM.EffectWeb - www.cetemaster.com" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Distribution" content="Global" />
<meta name="Author" content="(CTM) Cetemaster Services" />
<meta name="Robots" content="index,follow" />
</head>
<body>
<div align="center">
	<table border="0" cellpadding="0" cellspacing="0" width="500px" style="background: #fff; border: 7px solid #6c6c6c;">
		<tr>
			<td colspan="2" style="padding: 10px; font-family: Tahoma; font-size: 10px;" align="left">
				{$mailContent}
			</td>
		</tr>
		<tr>
			<td colspan="2"><div style="padding: 1px; background-color: #eaeaea;"></div></td>
		</tr>
		<tr>
			<td align="left" style="padding: 5px; font-family: Tahoma; font-size: 10px;">Copyright &copy; {$lang_words['MailContent']['Footer']}</td>
			<td align="right" style="padding: 5px; font-family: Tahoma; font-size: 10px;">Powered by CTM Effect Web</td>
		</tr>
	</table>
</div>
</body>
</html>
HTML;
?>