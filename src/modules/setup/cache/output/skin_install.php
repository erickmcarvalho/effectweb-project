<?php

class skin_install_sections extends CTM_Command
{
	public function __construct()
	{
		$this->registry();
	}
	/**
	 *	Block Install
	*/
	public function block_install()
	{
		global $installation_info;
		
		$CTM_HTML = <<<HTML
		
				<div class="error">{$this->lang->words['BlockInstall']['ErrorMessage']}</div>
				<div class="attention">
					{$this->lang->words['BlockInstall']['UnblockInstall']}
				</div>
				<div class="information">
					{$this->lang->words['BlockInstall']['Infos']['CurrentVersion']} <strong>{$installation_info['current_version']}</strong><br />
					{$this->lang->words['BlockInstall']['Infos']['OldVersion']} <strong>{$installation_info['old_version']}</strong><br />
					{$this->lang->words['BlockInstall']['Infos']['LastInstallation']} <strong>{$installation_info['last_installation']}</strong><br />
					{$this->lang->words['BlockInstall']['Infos']['LastUpdate']} <strong>{$installation_info['last_update']}</strong><br />
				</div>
HTML;

		return $CTM_HTML;
	}
	/**
	 *	Requirements
	*/
	public function requirements()
	{
		global $requirements, $error_message;
		
		$mssql = $requirements['mssql_extension'] == true ? "<span style=\"color: green;\">Passed</span>" : "<span style=\"color: red;\">Failed</span>";
		$curl = $requirements['curl_extension'] == true ? "<span style=\"color: green;\">Passed</span>" : "<span style=\"color: red;\">Failed</span>";
		$sockets = $requirements['sockets_extension'] == true ? "<span style=\"color: green;\">Passed</span>" : "<span style=\"color: orange;\">Failed (Recommended)</span>";
		$gd = $requirements['gd_extension'] == true ? "<span style=\"color: green;\">Passed</span>" : "<span style=\"color: red;\">Failed</span>";
		$ioncube = $requirements['ioncube_extension'] == true ? "<span style=\"color: green;\">Passed</span>" : "<span style=\"color: red;\">Failed</span>";
		$php_version = $requirements['php_version'] == true ? "<span style=\"color: green;\">Passed</span>" : "<span style=\"color: red;\">Failed</span>";
		$ioncube_version = $requirements['ioncube_version'] == true ? "<span style=\"color: green;\">Passed</span>" : "<span style=\"color: red;\">Failed</span>";
		$json = $requirements['json_lib'] == true ? "<span style=\"color: green;\">Passed</span>" : "<span style=\"color: red;\">Failed</span>";
		
		$CTM_HTML = NULL;

		if($error_message == true)
		{
			$CTM_HTML .= <<<HTML
			
				<div class="error">{$this->lang->words['Requirements']['ErrorMessage']}</div>
HTML;
		}
		
		$CTM_HTML .= <<<HTML
		
				<h2>&raquo; {$this->lang->words['Requirements']['Title']}</h2>
					<p>{$this->lang->words['Requirements']['Welcome']}</p>
					<p><a href="{$guide_link}" target="_blank">{$this->lang->words['Requirements']['Guide']}</a></p>
					
        		<h2>&raquo; {$this->lang->words['Requirements']['SystemRequirements']}</h2>
        		<div class="information">
        			PHP Version: 5.1.1<br />
        			ionCube Loader Version: 4.1.4<br />
        		</div>
				
        		<div class="attention">
        			Memory Limit: {$requirements['memory_limit_recommend']} {$this->lang->words['Requirements']['MemoryRecommend']}<br />
        			{$this->lang->words['Requirements']['MemoryCurrent']}: {$requirements['memory_limit_current']}.<br />
HTML;
		if((int)$requirements['memory_limit_current'] < (int)$requirements['memory_limit_recommend'])
		{
			$CTM_HTML .= <<<HTML
				
        			<strong>{$this->lang->words['Requirements']['MemoryText']}</strong>
HTML;
		}
		
		$CTM_HTML .= <<<HTML
		
				</div>
HTML;
		
		if(count($requirements['directorys_to_write']) > 0)
		{
			$CTM_HTML .= <<<HTML
			
        		<div class="error">
					<strong>{$this->lang->words['Requirements']['DirectorysBlocked']}</strong>
HTML;

			foreach($requirements['directorys_to_write'] as $dir)
			{
				$CTM_HTML .= <<<HTML
				
				
					<br />- {$dir}
HTML;

			}
			
			$CTM_HTML .= <<<HTML
			
        		</div>
HTML;
		}
		
		$CTM_HTML .= <<<HTML
				
        		<div class="success">
        			MSSQL Extension (mssql): {$mssql}<br />
        			cURL Extension (curl): {$curl}<br />
        			Sockets Extension (sockets): {$sockets}<br />
        			GD Extension (gd): {$gd}<br />
        			ionCube Loader Extension(ioncube_loader): {$ioncube}<br /><br />
						
        			PHP Version: {$php_version}<br />
        			ionCube Loader Version: {$ioncube_version}<br /><br />
						
        			JSON (json): {$json}
        		</div>
HTML;

		return $CTM_HTML;
	}
	/**
	 *	EULA - End User License Agreement
	*/
	public function eula()
	{
		global $eula_terms, $error_message;
		
		$CTM_HTML = NULL;

		if($error_message == true)
		{
			$CTM_HTML .= <<<HTML
			
				<div class="error">{$this->lang->words['EULA']['ErrorMessage']}</div>
HTML;
		}
		
		$CTM_HTML .= <<<HTML
		
				<h2>&raquo; {$this->lang->words['EULA']['Title']}</h2>
					<p>{$this->lang->words['EULA']['Header']}</p>
					
					<div class="eula">
						{$eula_terms}
					</div>
					<input type="checkbox" name="accept" id="accept" value="1"> {$this->lang->words['EULA']['Accept']}
HTML;

		return $CTM_HTML;
	}
	/**
	 *	Database Settings
	*/
	public function db_settings()
	{
		global $error_message, $existing_installation;
		
		$db_host = $_GET['do'] == "check" ? $_POST['db_host'] : Installer::DefaultDBHost;
		$db_port = $_GET['do'] == "check" ? $_POST['db_port'] : Installer::DefaultDBPort;
		$db_user = $_GET['do'] == "check" ? $_POST['db_user'] : Installer::DefaultDBUser;
		$db_pass = $_GET['do'] == "check" ? $_POST['db_pass'] : Installer::DefaultDBPass;
		$db_name = $_GET['do'] == "check" ? $_POST['db_name'] : Installer::DefaultDBName;
		
		$CTM_HTML = NULL;

		if($error_message)
		{
			$CTM_HTML .= <<<HTML
			
				{$error_message}
HTML;
		}
		
		$CTM_HTML .= <<<HTML
		
				<h2>&raquo; {$this->lang->words['DBSettings']['Title']}</h2>
				
HTML;

		if($existing_installation == true)
		{
			$new_installation = $this->lang->words['DBSettings']['Messages']['InstallationInfo'];
			$new_installation = sprintf($new_installation, $_POST['db_name']);
			$new_installation = str_replace("{#up_begin}", "<a href=\"?app=upgrade\">", $new_installation);
			$new_installation = str_replace("{#up_end}", "</a>", $new_installation);
			
			$CTM_HTML .= <<<HTML
			
				<div class="information">{$new_installation}</div>

				<fieldset>
					<legend>{$this->lang->words['DBSettings']['DBOverride']['Title']}</legend>
					<input type="checkbox" name="new_installation" value="1"> {$this->lang->words['DBSettings']['DBOverride']['NewInstallation']}
				</fieldset>
HTML;
		}
		
		$CTM_HTML .= <<<HTML
		
				<fieldset>
					<legend>{$this->lang->words['DBSettings']['Settings']['Title']}</legend>
					
					<label>{$this->lang->words['DBSettings']['Settings']['SQLHost']}</label>
					<input type="text" name="db_host" id="db_host" class="text-input small-input" value="{$db_host}">
					
					<label>{$this->lang->words['DBSettings']['Settings']['SQLPort']}</label>
					<input type="text" name="db_port" id="db_port" class="text-input small-input" value="{$db_port}" onkeypress="return numbersOnly(event);">
					
					<label>{$this->lang->words['DBSettings']['Settings']['SQLUser']}</label>
					<input type="text" name="db_user" id="db_user" class="text-input small-input" value="{$db_user}">
					
					<label>{$this->lang->words['DBSettings']['Settings']['SQLPass']}</label>
					<input type="password" name="db_pass" id="db_pass" class="text-input small-input" value="{$db_pass}">
					
					<label>{$this->lang->words['DBSettings']['Settings']['DBName']}</label>
					<input type="text" name="db_name" id="db_name" class="text-input small-input" value="{$db_name}">
				</fieldset>
HTML;
		
		return $CTM_HTML;
	}
	/**
	 *	Administrator Account
	*/
	public function admin_account()
	{
		global $error_message;
		
		$CTM_HTML = NULL;

		if($error_message)
		{
			$CTM_HTML .= <<<HTML
			
				{$error_message}
HTML;
		}
		
		$CTM_HTML .= <<<HTML
		
				<h2>&raquo; {$this->lang->words['AdminAccount']['Title']}</h2>
				
HTML;
		
		$CTM_HTML .= <<<HTML
		
				<fieldset>
					<legend>{$this->lang->words['AdminAccount']['AccountData']['Title']}</legend>
					
					<label>{$this->lang->words['AdminAccount']['AccountData']['Account']}</label>
					<input type="text" name="account" id="account" class="text-input small-input" value="{$_POST['account']}">
					
					<label>{$this->lang->words['AdminAccount']['AccountData']['Character']}</label>
					<input type="text" name="character" id="character" class="text-input small-input" value="{$_POST['character']}">
					
					<label>{$this->lang->words['AdminAccount']['AccountData']['Contact']}</label>
					<input type="text" name="contact" id="contact" class="text-input small-input" value="{$_POST['contact']}">
				</fieldset>
HTML;
		
		return $CTM_HTML;
	}
	/**
	 *	Installation
	*/
	public function installation()
	{
		global $error_message, $installed_alters, $installed_tables, $installed_procedures, $installed_views, $installed_others, $installed_templates, $changed_lines, $inserted_data, $go_next;
		
		$CTM_HTML = <<<HTML
		
				<h2>&raquo; {$this->lang->words['Installation']['Title']}</h2>
				
HTML;

		if($error_message)
		{
			$CTM_HTML .= <<<HTML
			
				{$error_message}

HTML;
		}

		if($_GET['do'] == "install")
		{
			if($go_next)
			{
				$CTM_HTML .= <<<HTML
			
				<script type='text/javascript'>
				function redirect_to_next_set()
				{
					document.getElementById("setup").action = "{$go_next}";
					document.getElementById("setup").submit();
				}
				
				setTimeout("redirect_to_next_set()", 2000);
				</script>
HTML;
			}

			if($_GET['set'] == "sql")
			{
            	$this->lang->setArguments("Installation,Install,SQLInstall,InstalledAlters", $installed_alters);
				$this->lang->setArguments("Installation,Install,SQLInstall,InstalledTables", $installed_tables);
                $this->lang->setArguments("Installation,Install,SQLInstall,InstalledProcedures", $installed_procedures);
                $this->lang->setArguments("Installation,Install,SQLInstall,InstalledViews", $installed_views);
				$this->lang->setArguments("Installation,Install,SQLInstall,InstalledOthers", $installed_others);
			
				$CTM_HTML .= <<<HTML
			
				<div class="information">{$this->lang->words['Installation']['Install']['SQLInstall']['Text']}</div>
                <div class="success">{$this->lang->words['Installation']['Install']['SQLInstall']['InstalledAlters']}</div>
				<div class="success">{$this->lang->words['Installation']['Install']['SQLInstall']['InstalledTables']}</div>
                <div class="success">{$this->lang->words['Installation']['Install']['SQLInstall']['InstalledProcedures']}</div>
                <div class="success">{$this->lang->words['Installation']['Install']['SQLInstall']['InstalledViews']}</div>
				<div class="success">{$this->lang->words['Installation']['Install']['SQLInstall']['InstalledOthers']}</div>
HTML;
			}
		
			if($_GET['set'] == "template")
			{
				$CTM_HTML .= <<<HTML
			
				<div class="information">{$this->lang->words['Installation']['Install']['TemplateInstall']['Text']}</div>
HTML;

				if(count($installed_templates) > 0)
				{
					foreach($installed_templates as $template)
					{
						$lang = str_replace("%s", $template, $this->lang->words['Installation']['Install']['TemplateInstall']['InstalledSkin']);
						$CTM_HTML .= <<<HTML
				
				<div class="success">{$lang}</div>
HTML;
					}
				}
			}
		
			if($_GET['set'] == "settings")
			{
				$this->lang->setArguments("Installation,Install,SettingsInstall,ChangedLines", $changed_lines);
			
				$CTM_HTML .= <<<HTML
			
				<div class="information">{$this->lang->words['Installation']['Install']['SettingsInstall']['Text']}</div>
				<div class="success">{$this->lang->words['Installation']['Install']['SettingsInstall']['ChangedLines']}</div>
HTML;
			}
		
			if($_GET['set'] == "data")
			{
				$this->lang->setArguments("Installation,Install,DataInstall,InsertedData", $inserted_data);
			
				$CTM_HTML .= <<<HTML
			
				<div class="information">{$this->lang->words['Installation']['Install']['DataInstall']['Text']}</div>
				<div class="success">{$this->lang->words['Installation']['Install']['DataInstall']['InsertedData']}</div>
HTML;
			}
            
            if($go_next)
            {
            	$CTM_HTML .= <<<HTML
            
            	<p style="float:right">
					<input class="button" type="button" onclick="redirect_to_next_set();" value="{$this->lang->words['Installation']['Install']['Button']}">
				</p>
HTML;
			}
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            
            	<p>
                	{$this->lang->words['Installation']['Ready']['Text']}
                </p>
                <p style="float:right">
					<input class="button" type="button" onclick="_submit();" value="{$this->lang->words['Installation']['Ready']['Button']}">
				</p>
HTML;
        }
        
        return $CTM_HTML;
    }
    /**
	 *	Finished
	*/
	public function finished()
	{
    	global $links;
        
        $CTM_HTML = <<<HTML
		
				<h2>&raquo; {$this->lang->words['Finished']['Title']}</h2>
                
                <p>
                	{$this->lang->words['Finished']['Text']}
                </p>
HTML;

		if(count($links) > 0)
        {
        	$CTM_HTML .= <<<HTML
            
            	<p>
HTML;
        	foreach($links as $link)
            {
            	$blank = $link['blank'] == true ? " target=\"_blank\"" : NULL;
                
            	$CTM_HTML .= <<<HTML
                
                
					<br /><a href="{$link['address']}"{$blank}>&raquo; {$link['value']}</a>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
            
            
            	</p>
HTML;
		}
        
        return $CTM_HTML;
    }
}

$_skin_section_class = new skin_install_sections();