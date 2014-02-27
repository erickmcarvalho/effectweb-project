<?php

class skin_core extends CTM_Command
{
	public function __construct()
	{
		$this->registry();
	}
	/**
	 *	Global header
	*/
	public function global_header()
	{
		global $html_title, $sidebar, $section, $__session, $hide_button, $hide_sidebar, $do;
		
		$app = CTM_SETUP_MODE;
		$_do = $do ? $do : "check";
		
		for($i = 0; $i < $this->vars['max_sections']; $i++)
		{
			if($this->section == $i + 1)
				$steps[$i + 1] = "installing";
			elseif($this->section < $i + 1)
				$steps[$i + 1] = "";
			elseif($this->section > $i + 1)
				$steps[$i + 1] = "i-seccess";
		}
		
		if(!$this->section)
			$steps[1] = "installing";
			
		$title = $section."/".$this->vars['max_sections'];
		$title_install = CTM_SETUP_MODE == "upgrade" ? "Upgrade" : "Install";
		
		$CTM_HTML = <<<HTML
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title>Effect Web 2 {$title_install}: {$html_title}</title>
<link href="../../modules/setup/public/styles/ctm-install.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
var use_submit_function = true;
HTML;

		if($javascript)
		{
			$CTM_HTML .= <<<HTML

{$javascript}
HTML;
		}
		
		$CTM_HTML .= <<<HTML

function numbersOnly(_event)
{
	if(window.event)
		key = _event.keyCode;
	else if(_event.which)
		key = _event.which;
		
	if((key >= 48 && key <= 57) || (key == 8))
		return true;
	else
		return false;
}

function _submit()
{
	if(use_submit_function == true)
		document.forms['setup'].submit();
}		
</script>
</head>
<body>
<div id="all">
<div id="top">
	<h1><!-- CTM Product Install --></h1>
</div>
<div id="content">
	<div id="aside">
    	<div class="box-aside">
        	<div class="header-aside">&raquo; {$sidebar['current_step']}</div>
        </div>
HTML;
		$sidebar = "sidebar_".CTM_SETUP_MODE;
        
        if(CTM_SETUP_MODE != "default" && $hide_sidebar == false)
        {
     		$CTM_HTML .= $this->{$sidebar}($steps);
        }
        
        $CTM_HTML .= <<<HTML
        
    </div>
	<div id="section">
    	<div class="header-section">{$this->lang->words['GlobalTitle']} {$title}</div>
			<form name="setup" id="setup" action="?app={$app}&amp;section={$section}&amp;do={$_do}" method="post">
				<input type="hidden" name="session" id="session" value="{$__session}" />
				
        		{#SETUP_CONTENT#}
HTML;

		if($hide_button == false)
        {
        	$CTM_HTML .= <<<HTML
            
				<p style="float:right">
					<input class="button" type="button" onclick="_submit();" value="{$this->lang->words['NextStep']}">
				</p>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        
    		</form>
	</div>
</div>
<div id="footer">
	<p>Copyright &copy; 2013 - Powered by <a href="http://www.cetemaster.com.br" target="_blank">Cetemaster Services</a> - All Rights Reserved.</p>
</div>
</div>
</body>
</html>
HTML;

		return $CTM_HTML;
	}
    /**
	 *	Default Page
	*/
	public function default_page()
	{
		$CTM_HTML = <<<HTML
		
				<p>
                	{$this->lang->words['Default']['Welcome']}
                </p>
                <div style="width: 300px">
                    <p style="float: left">
                        <input class="button" type="button" onclick="window.location = '?app=install'" value="{$this->lang->words['Default']['Buttons']['Install']}">
                    </p>
                    <p style="float:right">
                        <input class="button" type="button" onclick="window.location = '?app=repair'" value="{$this->lang->words['Default']['Buttons']['Repair']}">
                    </p>
                    <p style="float: right">
                        <input class="button" type="button" onclick="window.location = '?app=upgrade'" value="{$this->lang->words['Default']['Buttons']['Upgrade']}">
                    </p>
				</div>
HTML;

		return $CTM_HTML;
	}
    /**
	 *	Show Error
	*/
	public function show_error()
	{
    	global $show_error;
        
		$CTM_HTML = <<<HTML
		
				<div class="error">{$show_error}</div>
HTML;

		return $CTM_HTML;
	}
    /**
     *	Private: Sidebar - Install
    */
    private function sidebar_install($steps)
    {
    	$CTM_HTML .= <<<HTML
            
    	<div class="box-aside">
        	<ul class="install">
            	<li class="{$steps[1]}">{$this->lang->words['Sidebar']['Sections']['Install']['Requirements']}</li>
                <li class="{$steps[2]}">{$this->lang->words['Sidebar']['Sections']['Install']['LicenseTerms']}</li>
                <li class="{$steps[3]}">{$this->lang->words['Sidebar']['Sections']['Install']['DBSettings']}</li>
				<li class="{$steps[4]}">{$this->lang->words['Sidebar']['Sections']['Install']['AdminAccount']}</li>
				<li class="{$steps[5]}">{$this->lang->words['Sidebar']['Sections']['Install']['Installation']}</li>
				<li class="{$steps[6]}">{$this->lang->words['Sidebar']['Sections']['Install']['Finished']}</li>
            </ul>
        </div>
HTML;
		
        return $CTM_HTML;
    }
    /**
     *	Private: Sidebar - Upgrade
    */
    private function sidebar_upgrade($steps)
    {
    	$CTM_HTML .= <<<HTML
            
    	<div class="box-aside">
        	<ul class="install">
            	<li class="{$steps[1]}">{$this->lang->words['Sidebar']['Sections']['Upgrade']['Login']}</li>
                <li class="{$steps[2]}">{$this->lang->words['Sidebar']['Sections']['Upgrade']['Requirements']}</li>
                <li class="{$steps[3]}">{$this->lang->words['Sidebar']['Sections']['Upgrade']['Versions']}</li>
                <li class="{$steps[4]}">{$this->lang->words['Sidebar']['Sections']['Upgrade']['Settings']}</li>
                <li class="{$steps[5]}">{$this->lang->words['Sidebar']['Sections']['Upgrade']['Details']}</li>
                <li class="{$steps[6]}">{$this->lang->words['Sidebar']['Sections']['Upgrade']['Installation']}</li>
                <li class="{$steps[7]}">{$this->lang->words['Sidebar']['Sections']['Upgrade']['Finished']}</li>
            </ul>
        </div>
HTML;
		
        return $CTM_HTML;
    }
    /**
     *	Private: Sidebar - Repair
    */
    private function sidebar_repair($steps)
    {
    	$CTM_HTML .= <<<HTML
            
    	<div class="box-aside">
        	<ul class="install">
            	<li class="{$steps[1]}">{$this->lang->words['Sidebar']['Sections']['Repair']['Login']}</li>
                <li class="{$steps[2]}">{$this->lang->words['Sidebar']['Sections']['Repair']['Options']}</li>
                <li class="{$steps[3]}">{$this->lang->words['Sidebar']['Sections']['Repair']['DBRepair']}</li>
                <li class="{$steps[4]}">{$this->lang->words['Sidebar']['Sections']['Repair']['AdminAccount']}</li>
                <li class="{$steps[5]}">{$this->lang->words['Sidebar']['Sections']['Repair']['Installation']}</li>
                <li class="{$steps[6]}">{$this->lang->words['Sidebar']['Sections']['Repair']['Finished']}</li>
            </ul>
        </div>
HTML;
		
        return $CTM_HTML;
    }
}

$_skin_core_class = new skin_core();