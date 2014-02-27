<?php

class skin_upgrade_sections extends CTM_Command
{
	public function __construct()
	{
		$this->registry();
	}
	/**
	 *	Block Install
	*/
	public function block_update()
	{
		global $installation_info;
		
		$CTM_HTML = <<<HTML
		
				<div class="error">{$this->lang->words['BlockUpdate']['ErrorMessage']}</div>
				<div class="information">
					{$this->lang->words['BlockUpdate']['Infos']['CurrentVersion']} <strong>{$installation_info['current_version']}</strong><br />
					{$this->lang->words['BlockUpdate']['Infos']['OldVersion']} <strong>{$installation_info['old_version']}</strong><br />
					{$this->lang->words['BlockUpdate']['Infos']['LastInstallation']} <strong>{$installation_info['last_installation']}</strong><br />
					{$this->lang->words['BlockUpdate']['Infos']['LastUpdate']} <strong>{$installation_info['last_update']}</strong><br />
				</div>
HTML;

		return $CTM_HTML;
	}
	/**
	 *	Login
	*/
	public function login()
	{
		global $error_message;
		
		$username = $_GET['do'] == "check" ? $_POST['username'] : NULL;
		$CTM_HTML = <<<HTML
		
				<h2>&raquo; {$this->lang->words['Login']['Title']}</h2>
				<div class="information">{$this->lang->words['Login']['Backup']}</div>
				
HTML;

		if($error_message)
		{
			$CTM_HTML .= <<<HTML
			
				{$error_message}
HTML;
		}
		
		$CTM_HTML .= <<<HTML
		
			<fieldset>
				<label>{$this->lang->words['Login']['Username']}</label>
				<input type="text" name="username" id="username" class="text-input small-input" value="{$username}">
					
				<label>{$this->lang->words['Login']['Password']}</label>
				<input type="password" name="password" id="password" class="text-input small-input">
			</fieldset>
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
		
		$CTM_HTML = <<<HTML
		
				<h2>&raquo; {$this->lang->words['Requirements']['Title']}</h2>
				
HTML;

		if($error_message == true)
		{
			$CTM_HTML .= <<<HTML
			
				<div class="error">{$this->lang->words['Requirements']['ErrorMessage']}</div>
HTML;
		}
		
		$CTM_HTML .= <<<HTML
		
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
	 *	Versions
	*/
	public function versions()
	{
		global $versions_to_update;
		
		$CTM_HTML = <<<HTML
		
				<h2>&raquo; {$this->lang->words['Versions']['Title']}</h2>
				
HTML;
		
		foreach($versions_to_update as $version => $info)
		{
			$sql_site = $info['sql_site'] == true ? "success" : "error";
			$sql_server = $info['sql_server'] == true ? "success" : "error";
			$settings = $info['settings'] == true ? "success" : "error";
			$templates = $info['templates'] == true ? "success" : "error";
			
			$CTM_HTML .= <<<HTML
		
		
			<fieldset>
				<legend>{$info['version']}: {$version}</legend>
				
				<table width="100%" border="0">
					<tr>
						<td>{$this->lang->words['Versions']['Changes']['SQL']['Site']}</td>
						<td><img src="../../modules/setup/public/images/icons/{$sql_server}.png" border="0" /></td>
					</tr>
					<tr>
						<td>{$this->lang->words['Versions']['Changes']['SQL']['Server']}</td>
						<td><img src="../../modules/setup/public/images/icons/{$sql_server}.png" border="0" /></td>
					</tr>
					<tr>
						<td>{$this->lang->words['Versions']['Changes']['Settings']}</td>
						<td><img src="../../modules/setup/public/images/icons/{$settings}.png" border="0" /></td>
					</tr>
					<tr>
						<td>{$this->lang->words['Versions']['Changes']['Templates']}</td>
						<td><img src="../../modules/setup/public/images/icons/{$templates}.png" border="0" /></td>
					</tr>
				</table>
			</fieldset>
HTML;
		}
		
		return $CTM_HTML;
	}
	/**
	 *	Settings
	*/
	public function settings()
	{
		global $settings_lines, $current_version, $lines_error;
		
		$title =  $current_version['string'].": ".$current_version['key'];
		
		$CTM_HTML = <<<HTML
		
				<h2>&raquo; {$this->lang->words['Settings']['Title']}{$title}</h2>
HTML;

		if(count($lines_error) > 0)
		{
			$CTM_HTML .= <<<HTML
			
        		<div class="error">
					<strong>{$this->lang->words['Settings']['WriteError']['Title']}</strong>
HTML;
			foreach($lines_error as $id => $line)
			{
				$string = str_replace("%d", $id, $this->lang->words['Settings']['WriteError'][$line]);
				$CTM_HTML .= <<<HTML
				
				
					<br />- {$string}
HTML;

			}
			
			$CTM_HTML .= <<<HTML
			
        		</div>
HTML;
		}
		
		if(count($settings_lines) > 0)
		{
			foreach($settings_lines as $line => $info)
			{
				$CTM_HTML .= <<<HTML
				
				
					<fieldset>
						<legend>{$this->lang->words['Settings']['Line']} {$line}</legend>
HTML;
	
				if($info['search'])
				{
					$CTM_HTML .= <<<HTML
					
						{$this->lang->words['Settings']['SearchBy']}<br />
						<pre>{$info['search']}</pre>
HTML;
				}
				
				switch($info['command'])
				{
					case "insert" :
						$CTM_HTML .= <<<HTML
						
						<br />{$this->lang->words['Settings']['Insert'][$info['insert']]}<br />
						<pre>{$info['syntax']}</pre>
HTML;
					break;
					case "remove" :
						$CTM_HTML .= <<<HTML
						
						{$this->lang->words['Settings']['Remove']}<br />
						<pre>{$info['syntax']}</pre>
HTML;
					break;
					case "change" :
						$CTM_HTML .= <<<HTML
						
						{$this->lang->words['Settings']['Change']}<br />
						<pre>{$info['syntax']}</pre>
HTML;
					break;
				}
						
				
				$CTM_HTML .= <<<HTML
				
				
					</fieldset>
HTML;
			}
			
			$CTM_HTML .= <<<HTML
			
					<p>
						{$this->lang->words['Settings']['Footer']}
					</p>
HTML;
		}
		else
		{
			$CTM_HTML .= <<<HTML
			
        		<div class="information">{$this->lang->words['Settings']['NoChanges']}</div>
HTML;
		}
		
		return $CTM_HTML;
	}
	/**
	 *	Details
	*/
	public function details()
	{
		global $versions_to_update;
		
		$CTM_HTML = <<<HTML
		
				<h2>&raquo; {$this->lang->words['Details']['Title']}</h2>
				
HTML;
		
		if(count($versions_to_update) > 0)
		{
			foreach($versions_to_update as $version => $details)
			{
				$CTM_HTML .= <<<HTML
			
			
				<fieldset>
					<legend>{$details['version']}: {$version}</legend>
					
					<blockquote>
						{$details['details']}
					</blockquote>
				</fieldset>
HTML;
			}
		}
		else
		{
			$CTM_HTML .= <<<HTML
			
        		<div class="information">{$this->lang->words['Details']['NoDetails']}</div>
HTML;
		}
		
		return $CTM_HTML;
	}
	/**
	 *	Installation
	*/
	public function installation()
	{
		global $error_message, $droped_objects, $installed_alters, $installed_tables, $installed_procedures, $installed_views, $installed_others, $updated_templates, $inserted_data, $go_next, $current_version;
		
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
			$CTM_HTML .= <<<HTML
			
				<fieldset>
					<legend>{$current_version['string']}: {$current_version['key']}</legend>
HTML;

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
            	$this->lang->setArguments("Installation,Install,SQLInstall,DropedObjects", $droped_objects);
                $this->lang->setArguments("Installation,Install,SQLInstall,InstalledAlters", $installed_alters);
				$this->lang->setArguments("Installation,Install,SQLInstall,InstalledTables", $installed_tables);
                $this->lang->setArguments("Installation,Install,SQLInstall,InstalledProcedures", $installed_procedures);
                $this->lang->setArguments("Installation,Install,SQLInstall,InstalledViews", $installed_views);
				$this->lang->setArguments("Installation,Install,SQLInstall,InstalledOthers", $installed_others);
			
				$CTM_HTML .= <<<HTML
			
					<div class="information">{$this->lang->words['Installation']['Install']['SQLInstall']['Text']}</div>
                	<div class="success">{$this->lang->words['Installation']['Install']['SQLInstall']['DropedObjects']}</div>
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

				if(count($updated_templates) > 0)
				{
					foreach($updated_templates as $template)
					{
						$lang = str_replace("%s", $template, $this->lang->words['Installation']['Install']['TemplateInstall']['UpdatedSkin']);
						$CTM_HTML .= <<<HTML
				
					<div class="success">{$lang}</div>
HTML;
					}
				}
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
            
            $CTM_HTML .= <<<HTML
				</fieldset>
HTML;
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

$_skin_section_class = new skin_upgrade_sections();