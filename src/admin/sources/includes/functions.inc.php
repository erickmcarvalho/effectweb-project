<?php
// ************************************************************** //
// -> CTM Admin Control Panel                                   * //
// -> Powered by Erick-Master & Litlle                          * //
// ************************************************************** //
// -> CTM TEAM Softwares - Custom Tech Services                 * //
// -> Copyright (c) 2010-2011. All Rights Reserved,             * //
// -> www.ctmts.com.br / www.ctmts.com                          * //
// ************************************************************** //

function adminShowMessage($message, $type = 0)
{
	switch(EffectWebData::ACP_SHOW_MESSAGE_TYPE)
	{
		case 1 :
			$message = str_replace("'", "\'", $message);
			$message = str_replace(array("\n", "\r"), array("\\\n", "\\\r"), $message);
			$begin = "<script type=\"text/javascript\">\n$"."(document).ready(function()"."{\n";
			$end = "});\n</script>";
			switch($type)
			{
				case 1 : return $begin."Sexy.alert('{$Message}');\n".$end; break;
				case 2 : return $begin."Sexy.error('{$Message}');\n".$end; break;
				default : return $begin."Sexy.info('{$Message}');\n".$end; break;
			}
		break;
		default :
			switch($type)
			{
				case 1 : return "<div class=\"warning msg\">{$message}</div>"; break;
				case 2 : return "<div class=\"error msg\">{$message}</div>"; break;
				case 3 : return "<div class=\"success msg\">{$message}</div>"; break;
				default : return "<div class=\"information msg\">{$message}</div>"; break;
			}
		break;
	}
}