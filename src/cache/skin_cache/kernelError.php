<?php

if(!is_null($message))
$message = "<div class=\"box\">
		Problem: {$message}
		</div>";

print <<<EOF

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
.box
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
	font: bold 11px Tahoma, Geneva, sans-serif;
}
a
{
	display: block;
	margin: 10px; 
	font: 14px Tahoma, Geneva, sans-serif; 
	color: #09f;
} 
a:hover
{
	color: #06c;
}
</style>
<title>CTM Fatal Error</title>
</head>
<body>
	<h1>Effect Web Fatal Error</h1>
    <h2>At the moment the system is in serious problems.</h2>
	{$message}
    <div class="box">This is an internal error in our server.<br />
Can occur, often as the same appears not to overload the server and returns the page after the update.<br />
Wait until an administrator resolves the same server or try reloading the page.<br />
<br />
Thank you for your attention.</div>
    <div class="box"><a href="javascript: void(0);" onclick="window.location=window.location; return false;">&laquo; Reload Page</a></div>
</body>
</html>
EOF;
?>