<?php

class skin_upgrade_sections extends CTM_Command
{
	public function __construct()
	{
		$this->registry();
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
	 *	Options
	*/
	public function options()
	{
		global $error_message;
		
		$CTM_HTML = <<<HTML
		
				<h2>&raquo; {$this->lang->words['Options']['Title']}</h2>
HTML;

		if($error_message == true)
		{
			$CTM_HTML .= <<<HTML
			
				<div class="error">{$this->lang->words['Options']['ErrorMessage']}</div>
HTML;
		}
		
		$CTM_HTML .= <<<HTML
				
				<fieldset>
					<table width="100%" border="0">
						<tr>
							<td>{$this->lang->words['Options']['Options']['RepairDB']['Web']}</td>
							<td><input type="checkbox" name="repair_db_web" id="repair_db_web" value="1" /></td>
						</tr>
						<tr>
							<td>{$this->lang->words['Options']['Options']['RepairDB']['Server']}</td>
							<td><input type="checkbox" name="repair_db_server" id="repair_db_server" value="1" /></td>
						</tr>
						<tr>
							<td>{$this->lang->words['Options']['Options']['RestoreFactory']['Template']}</td>
							<td><input type="checkbox" name="restore_factory_template" id="restore_factory_template" value="1" /></td>
						</tr>
						<tr>
							<td>{$this->lang->words['Options']['Options']['RestoreFactory']['Tasks']}</td>
							<td><input type="checkbox" name="restore_factory_tasks" id="restore_factory_tasks" value="1" /></td>
						</tr>
						<tr>
							<td>{$this->lang->words['Options']['Options']['CreateAdminAccount']}</td>
							<td><input type="checkbox" name="create_admin_account" id="create_admin_account" value="1" /></td>
						</tr>
					</table>
				</fieldset>
HTML;
		
		return $CTM_HTML;
	}
	/**
	 *	DB Repair Options
	*/
	public function db_repair()
	{
		//global $error_message;
		
		$CTM_HTML = <<<HTML
		
				<h2>&raquo; {$this->lang->words['DBRepair']['Title']}</h2>
HTML;

		/*if($error_message == true)
		{
			$CTM_HTML .= <<<HTML
			
				<div class="error">{$this->lang->words['DBRepair']['ErrorMessage']}</div>
HTML;
		}*/
		
		$CTM_HTML .= <<<HTML
				
				<fieldset>
					<legend>{$this->lang->words['DBRepair']['ServerDB']['Title']}</legend>
				
					<table width="100%" border="0">
						<tr>
							<td>{$this->lang->words['DBRepair']['ServerDB']['ResetAllTables']}</td>
							<td><input type="checkbox" name="server_reset_all_tables" id="server_reset_all_tables" value="1" /></td>
						</tr>
						<tr>
							<td>{$this->lang->words['DBRepair']['ServerDB']['ResetVirtualVaultItems']}</td>
							<td><input type="checkbox" name="server_reset_virtual_vault_items" id="server_reset_virtual_vault_items" value="1" /></td>
						</tr>
						<tr>
							<td>{$this->lang->words['DBRepair']['ServerDB']['ResetMemberData']}</td>
							<td><input type="checkbox" name="server_reset_member_data" id="server_reset_member_data" value="1" /></td>
						</tr>
						<tr>
							<td>{$this->lang->words['DBRepair']['ServerDB']['ResetCharacterData']}</td>
							<td><input type="checkbox" name="reset_reset_character_data" id="reset_reset_character_data" value="1" /></td>
						</tr>
					</table>
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
		global $error_message, $repaired_alters, $repaired_tables, $repaired_procedures, $repaired_views, $repaired_others, $reseted_data, $restored_templates, $inserted_data, $go_next;
		
		$CTM_HTML = <<<HTML
		
				<h2>&raquo; {$this->lang->words['Installation']['Title']}</h2>
				
HTML;

		if($error_message)
		{
			$CTM_HTML .= <<<HTML
			
				{$error_message}

HTML;
		}

		if($_GET['do'] == "run")
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
            	$this->lang->setArguments("Installation,Run,SQLRepair,RepairedAlters", $repaired_alters);
				$this->lang->setArguments("Installation,Run,SQLRepair,RepairedTables", $repaired_tables);
                $this->lang->setArguments("Installation,Run,SQLRepair,RepairedProcedures", $repaired_procedures);
                $this->lang->setArguments("Installation,Run,SQLRepair,RepairedViews", $repaired_views);
				$this->lang->setArguments("Installation,Run,SQLRepair,RepairedOthers", $repaired_others);
                $this->lang->setArguments("Installation,Run,SQLRepair,ResetedData", $reseted_data);
			
				$CTM_HTML .= <<<HTML
			
				<div class="information">{$this->lang->words['Installation']['Run']['SQLRepair']['Text']}</div>
                <div class="success">{$this->lang->words['Installation']['Run']['SQLRepair']['RepairedAlters']}</div>
				<div class="success">{$this->lang->words['Installation']['Run']['SQLRepair']['RepairedTables']}</div>
                <div class="success">{$this->lang->words['Installation']['Run']['SQLRepair']['RepairedProcedures']}</div>
                <div class="success">{$this->lang->words['Installation']['Run']['SQLRepair']['RepairedViews']}</div>
				<div class="success">{$this->lang->words['Installation']['Run']['SQLRepair']['RepairedOthers']}</div>
                <div class="success">{$this->lang->words['Installation']['Run']['SQLRepair']['ResetedData']}</div>
HTML;
			}
		
			if($_GET['set'] == "template")
			{
				$CTM_HTML .= <<<HTML
			
				<div class="information">{$this->lang->words['Installation']['Run']['TemplateRestore']['Text']}</div>
HTML;

				if(count($restored_templates) > 0)
				{
					foreach($restored_templates as $template)
					{
						$lang = str_replace("%s", $template, $this->lang->words['Installation']['Run']['TemplateRestore']['RestoredSkin']);
						$CTM_HTML .= <<<HTML
				
				<div class="success">{$lang}</div>
HTML;
					}
				}
			}
		
			if($_GET['set'] == "data")
			{
				$this->lang->setArguments("Installation,Run,DataRepair,InsertedData", $inserted_data);
			
				$CTM_HTML .= <<<HTML
			
				<div class="information">{$this->lang->words['Installation']['Run']['DataRepair']['Text']}</div>
				<div class="success">{$this->lang->words['Installation']['Run']['DataRepair']['InsertedData']}</div>
HTML;
			}
            
            if($go_next)
            {
            	$CTM_HTML .= <<<HTML
            
            	<p style="float:right">
					<input class="button" type="button" onclick="redirect_to_next_set();" value="{$this->lang->words['Installation']['Run']['Button']}">
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

$_skin_section_class = new skin_upgrade_sections();