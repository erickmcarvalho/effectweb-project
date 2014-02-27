<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP API: Application Skin
 * Last Update: 12/09/2012 - 19:35h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_ACPSkin_System extends CTM_ACPCommand
{
	/**
	 *	Global Sidebar
	 *
	 *	@return	string	HTML String
	*/
	public function core_global_sidebar()
	{
		$CTM_HTML = NULL;
		
		if(in_array(USER_ACCOUNT, $this->settings['ADMINCONTROLPANEL']['SYSTEM_MANAGER']))
		{
			$CTM_HTML .= <<<HTML
<div class="box">
                <h2>{$this->lang->words['System']['Sidebar']['Board']['Title']}</h2>
				<section>
					<ul>
						<li><a href="#">{$this->lang->words['System']['Sidebar']['Board']['License']['Title']}</a>
							<ul>
								<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=board&amp;index=license&amp;do=authenticate">{$this->lang->words['System']['Sidebar']['Board']['License']['AuthenticateLicense']}</a></li>
								<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=board&amp;index=license&amp;do=changeSerial">{$this->lang->words['System']['Sidebar']['Board']['License']['ChangeSerial']}</a></li>
							</ul>
						</li>
					</ul>
				</section>
			</div>
HTML;
		}
		
		if($this->checkPermission("modules", "core_system_cronjob") == true)
		{
			$CTM_HTML .= <<<HTML
<div class="box">
                <h2>{$this->lang->words['System']['Sidebar']['CronJob']['Title']}</h2>
				<section>
					<ul>
						<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=cronjob&amp;index=addTask">{$this->lang->words['System']['Sidebar']['CronJob']['AddTask']}</a></li>
                        <li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=cronjob&amp;index=manageTasks">{$this->lang->words['System']['Sidebar']['CronJob']['ManageTasks']}</a></li>
					</ul>
				</section>
			</div>
HTML;
		}
		
		if($this->checkPermission("modules", "core_system_lookandfeel") == true)
		{
			$CTM_HTML .= <<<HTML
<div class="box menu">
                <h2>{$this->lang->words['System']['Sidebar']['LookAndFeel']['Title']}</h2>
				<section>
					<ul>
						<li><a href="#">{$this->lang->words['System']['Sidebar']['LookAndFeel']['Templates']['Title']}</a>
							<ul>
								<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=templates&amp;index=manage">{$this->lang->words['System']['Sidebar']['LookAndFeel']['Templates']['ManageTemplates']}</a></li>
								<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=templates&amp;index=importExport">{$this->lang->words['System']['Sidebar']['LookAndFeel']['Templates']['ImportExport']}</a></li>
							</ul>
						</li>
					</ul>
				</section>
			</div>
HTML;
		}
		
		if($this->checkPermission("modules", "core_system_analysis") == true)
		{
			$CTM_HTML .= <<<HTML
<div class="box info">
                <h2>{$this->lang->words['System']['Sidebar']['Analysis']['Title']}</h2>
				<section>
					<ul>
						<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=analysis&amp;index=logs">{$this->lang->words['System']['Sidebar']['Analysis']['SystemLogs']}</a></li>
					</ul>
				</section>
			</div>
HTML;
		}

		return $CTM_HTML;
	}
	/**
	 *	System: Home
	 *
	 *	@return	string	HTML String
	*/
	public function system_home()
	{
		global $system_home;
		
		$_SERVER_ADDR = gethostbyname($_SERVER['SERVER_NAME']);
		
		$CTM_HTML = <<<HTML
<article>
				<h1>{$this->lang->words['System']['Home']['Title']}</h1>
				<ul class="tabs">
                	<li><a href="#tab-system">{$this->lang->words['System']['Home']['Tabs'][1]}</a></li>
					<li><a href="#tab-hosting">{$this->lang->words['System']['Home']['Tabs'][2]}</a></li>
					<li><a href="#tab-server">{$this->lang->words['System']['Home']['Tabs'][3]}</a></li>
				</ul>
				<div class="tabcontent">
                	<div id="tab-system">
                    	<table id="table1" class="gtable">
                        	<thead>
                            	<th>Cetemaster Effect Web</th>
                                <th></th>
                            </thead>
							<tbody>
								<tr>
									<td>{$this->lang->words['System']['Home']['SystemInfo']['Product']}</td>
									<td>{$system_home['system_name']}</td>
								</tr>
                                <tr>
									<td>{$this->lang->words['System']['Home']['SystemInfo']['Version']}</td>
									<td>{$system_home['system_version']}</td>
								</tr>
                                <tr>
									<td>{$this->lang->words['System']['Home']['SystemInfo']['Build']}</td>
									<td>{$system_home['system_build']}</td>
								</tr>
                                <tr></tr>
							</tbody>
                            <thead>
                            	<th>Admin Control Panel</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
									<td>{$this->lang->words['System']['Home']['SystemInfo']['Version']}</td>
									<td>{$system_home['admincp_version']}</td>
								</tr>
                                <tr>
									<td>{$this->lang->words['System']['Home']['SystemInfo']['Build']}</td>
									<td>{$system_home['admincp_build']}</td>
								</tr>
                                <tr></tr>
							</tbody>
                            <thead>
                            	<th>License Info</th>
                                <th></th>
                            </thead>
                            <tbody>
								<tr>
									<td>{$this->lang->words['System']['Home']['SystemLicense']['License']}</td>
									<td><strong>{$system_home['system_license']['license']}</strong></td>
								</tr>
								<tr>
									<td>{$this->lang->words['System']['Home']['SystemLicense']['Expiration']}</td>
									<td><strong style="color: red;">{$system_home['system_license']['expiration']}</strong></td>
								</tr>
                                <tr>
									<td>{$this->lang->words['System']['Home']['SystemLicense']['Holder']}</td>
									<td>{$system_home['system_license']['holder']}</td>
								</tr>
                                <tr>
									<td>Licensed to:</td>
									<td>{$system_home['system_license']['company']}</td>
								</tr>
                                <tr>
									<td>Serial:</td>
									<td>{$system_home['system_license']['serial']}</td>
								</tr>
                                <tr></tr>
							</tbody>
                            <thead>
                            	<th>Copyright &copy; 2013</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
									<td>Powered by</td>
									<td><strong>Cetemaster Services</strong></td>
								</tr>
                                <tr>
									<td>Site:</td>
									<td><a target="_blank" href="http://www.cetemaster.com.br/">www.cetemaster.com.br</a></td>
								</tr>
                                <tr>
									<td>Sales:</td>
									<td><a href="mailto:vendas@cetemaster.com.br">vendas@cetemaster.com.br</a></td>
								</tr>
								<tr>
									<td>Support:</td>
									<td><a href="mailto:suporte@cetemaster.com.br">suporte@cetemaster.com.br</a></td>
								</tr>
								<tr>
									<td>Contact:</td>
									<td><a href="mailto:contato@cetemaster.com.br">contato@cetemaster.com.br</a></td>
								</tr>
                                <tr></tr>
							</tbody>
						</table>
					</div>
                    <div id="tab-hosting">
						<table id="table2" class="gtable">
							<tbody>
								<tr>
									<td>{$this->lang->words['System']['Home']['HostServer']['ServerOS']}</td>
									<td>{$_ENV['OS']}</td>
								</tr>
                                <tr>
									<td>{$this->lang->words['System']['Home']['HostServer']['ComputerName']}</td>
									<td>{$_ENV['COMPUTERNAME']}</td>
								</tr>
                                <tr>
									<td>{$this->lang->words['System']['Home']['HostServer']['ServerSoftware']}</td>
									<td>{$_SERVER['SERVER_SOFTWARE']}</td>
								</tr>
                                <tr>
									<td>{$this->lang->words['System']['Home']['HostServer']['ServerAddr']}</td>
									<td>{$_SERVER_ADDR}</td>
								</tr>
                                <tr>
									<td>{$this->lang->words['System']['Home']['HostServer']['ServerPort']}</td>
									<td>{$_SERVER['SERVER_PORT']}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div id="tab-server">
						<table id="table3" class="gtable">
							<tbody>
								<tr>
									<td>{$this->lang->words['System']['Home']['ServerInfo']['TotalAccounts']}</td>
									<td>{$system_home['total_accounts']}</td>
								</tr>
                                <tr>
									<td>{$this->lang->words['System']['Home']['ServerInfo']['TotalAccountsVIP'][1]}</td>
									<td>{$system_home['total_accounts_vip_1']}</td>
								</tr>
HTML;
		if(VIP_NUMBER >= 2)
		{
			$CTM_HTML .= <<<HTML
                                <tr>
									<td>{$this->lang->words['System']['Home']['ServerInfo']['TotalAccountsVIP'][2]}</td>
									<td>{$system_home['total_accounts_vip_2']}</td>
								</tr>
HTML;
			if(VIP_NUMBER >= 3)
			{
				$CTML_HTML .= <<<HTML
                                <tr>
									<td>{$this->lang->words['System']['Home']['ServerInfo']['TotalAccountsVIP'][3]}</td>
									<td>{$system_home['total_accounts_vip_3']}</td>
								</tr>
HTML;
				if(VIP_NUMBER >= 4)
				{
					$CTM_HTML .= <<<HTML
                                <tr>
									<td>{$this->lang->words['System']['Home']['ServerInfo']['TotalAccountsVIP'][4]}</td>
									<td>{$system_home['total_accounts_vip_4']}</td>
								</tr>
HTML;
					if(VIP_NUMBER == 5)
					{
						$CTM_HTML .= <<<HTML
                                <tr>
									<td>{$this->lang->words['System']['Home']['ServerInfo']['TotalAccountsVIP'][5]}</td>
									<td>{$system_home['total_accounts_vip_5']}</td>
								</tr>
HTML;
					}
				}
			}
		}
		
		$CTM_HTML .= <<<HTML
                                <tr>
									<td>{$this->lang->words['System']['Home']['ServerInfo']['TotalCharacters']}</td>
									<td>{$system_home['total_characters']}</td>
								</tr>
                                <tr>
									<td>{$this->lang->words['System']['Home']['ServerInfo']['TotalGuilds']}</td>
									<td>{$system_home['total_guilds']}</td>
								</tr>
                                <tr>
									<td>{$this->lang->words['System']['Home']['ServerInfo']['TotalOnline']}</td>
									<td>{$system_home['total_online']}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</article>
HTML;

		return $CTM_HTML;
	}
	/**
	 *	CronJob: Add Task
	 *
	 *	@return	string	HTML String
	*/
	public function cronjob_addTask()
	{
		global $cronTasks, $task_error, $result_command;
		
		$date_now = date("m/d/Y");
		$hour_now = date("H:i");
		
		$CTM_HTML = <<<HTML
<script type="text/javascript">
			$(document).ready(function()
			{
				$("#EndEnable").click(function()
				{
					if(!$("#EndEnable").is(":checked"))
					{
						$("#endOptions").slideUp(341, function()
						{
							$("#EndDate").val(0);
							$("#EndHour").val(0);
						});
					}
					else
					{
						$("#EndDate").val('');
						$("#EndHour").val('');
						$("#endOptions").slideDown(341);
					}
				});
			});
			</script>
			<article>
				<h1>{$this->lang->words['System']['CronJob']['AddTask']['Title']}</h1>
HTML;
			if($task_error == true)
            {
            	$CTM_HTML .= <<<HTML
                <div class="information msg">{$this->lang->words['System']['CronJob']['AddTask']['NoTasks']}</div>
HTML;
			}
            else
            {
            	$CTM_HTML .= <<<HTML
                {$result_command}
                <form name="addCronTab" id="addCronTab" action="?app=core&amp;module=system&amp;section=cronjob&amp;index=addTask&amp;write=true" method="post" class="uniform">
                	<fieldset>
                    	<legend>{$this->lang->words['System']['CronJob']['AddTask']['Fields']['Settings']}</legend>
                        <dl class="inline">
                        	<dt><label for="TaskName">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['TaskName']}</label></dt>
                            <dd><input type="text" id="TaskName" name="TaskName" class="medium" /></dd>
                            
                            <dt><label for="TaskDescription">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['TaskDescription']}</label></dt>
                            <dd><input type="text" id="TaskDescription" name="TaskDescription" class="medium" /></dd>
                            
                            <dt><label for="TaskFile">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['TaskFile']}</label></dt>
                            <dd>
                            	<select name="TaskFile" id="TaskFile">
HTML;
                if(count($cronTasks) > 0)
                {
                    foreach($cronTasks as $task)
                    {
                        $CTM_HTML .= <<<HTML
                                        <option value="{$task}">{$task} (.task.php)</option>
HTML;
                    }
                }
                
                $CTM_HTML .= <<<HTML
                        		</select>
                        	</dd>
                            
                            <dt><label for="Switch">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['Enable']}</label></dt>
                            <dd>
                            	<span class="yesno_yes"><input type="radio" name="Switch" id="Switch_YES" value="1" checked="checked" />
									<label for="Switch_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no">
									<input type="radio" name="Switch" id="Switch_NO" value="0" />
									<label for="Switch_NO">{$this->lang->words['Words']['No']}</label>
								</span>
                            </dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                    	<legend>{$this->lang->words['System']['CronJob']['AddTask']['Fields']['Occur']}</legend>
                        <dl class="inline">
                        	<dt><label for="EveryDays">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['Days']}</label></dt>
							<dd><input type="text" id="EveryDays" name="EveryDays" class="min" size="4" value="0" /></dd>
                            
                            <dt><label for="EveryWeeks">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['Weeks']}</label></dt>
							<dd><input type="text" id="EveryWeeks" name="EveryWeeks" class="min" size="4" value="0" /></dd>
                            
                            <dt><label for="EveryMonths">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['Months']}</label></dt>
							<dd><input type="text" id="EveryMonths" name="EveryMonths" class="min" size="4" value="0" /></dd>
                            
                            <dt><label for="EveryHours">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['Hours']}</label></dt>
							<dd><input type="text" id="EveryHours" name="EveryHours" class="min" size="4" value="0" /></dd>
                            
                            <dt><label for="EveryMinutes">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['Minutes']}</label></dt>
							<dd><input type="text" id="EveryMinutes" name="EveryMinutes" class="min" size="4" value="1" /></dd>
						</dl>
					</fieldset>
                    <fieldset>
                    	<legend>{$this->lang->words['System']['CronJob']['AddTask']['Fields']['Begin']}</legend>
                        <dl class="inline">
                        	<dt><label for="BeginDate">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['BeginDate']}</label></dt>
                            <dd><input type="text" id="BeginDate" name="BeginDate" maxlength="10" class="small" value="{$date_now}" set="dateSet" /></dd>
                            
                            <dt><label for="BeginHour">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['BeginHour']}</label></dt>
                            <dd><input type="text" id="BeginHour" name="BeginHour" maxlength="5" class="min" size="10" value="{$hour_now}" /></dd>
                        </dl>    
                    </fieldset>
                    <fieldset>
                    	<legend>{$this->lang->words['System']['CronJob']['AddTask']['Fields']['End']}</legend>
                        <dl class="inline">
                        	<dt><label for="EndEnable">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['Enable']}</label></dt>
                            <dd><input type="checkbox" id="EndEnable" name="EndEnable" /></dd>
                            
                            <div id="endOptions" style="display:none">
                                <dt><label for="EndDate">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['EndDate']}</label></dt>
                                <dd><input type="text" id="EndDate" name="EndDate" maxlength="10" class="small" set="dateSet" /></dd>
                                
                                <dt><label for="EndHour">{$this->lang->words['System']['CronJob']['AddTask']['Fields']['EndHour']}</label></dt>
                                <dd><input type="text" id="EndHour" name="EndHour" maxlength="5" class="min" size="10"  /></dd>
                        	</div>
                        </dl>    
                    </fieldset>
					<p>
						<button type="submit" class="button">{$this->lang->words['System']['CronJob']['AddTask']['Button']}</button>
					</p>
				</form>
HTML;
			}
            
			$CTM_HTML .= <<<HTML
			</article>
HTML;

		return $CTM_HTML;
	}
    /**
	 *	CronJob: Manage Tasks
	 *
	 *	@return	string	HTML String
	*/
    public function cronjob_manageTasks()
    {
    	global $result_command, $manage_tasks;
        
    	$CTM_HTML = <<<HTML
        	<script type="text/javascript">
            $(function()
            {
            	$(".removeTask").click(function()
                {
                	var taskId = $(this).attr("rel");
                    
                    Sexy.confirm("<strong>{$this->lang->words['System']['CronJob']['ManageTasks']['RemoveTask']['Confirm']}</strong>", {"onComplete" : function(e)
                    {
                    	if(e == true)
                        	window.location = "{$this->acp_vars['acp_url']}?app=core&module=system&section=cronjob&index=manageTasks&remove="+taskId;
                    }});
                });
            });
            </script>
			<article>
				<h1>{$this->lang->words['System']['CronJob']['ManageTasks']['Title']}</h1>
HTML;

		if(!empty($result_command))
        {
        	$CTM_HTML .= <<<HTML
				{$result_command}
HTML;
        }
        
		if(count($manage_tasks) > 0)
        {
        	$CTM_HTML .= <<<HTML
				<table id="table" class="gtable detailtable">
					<thead>
						<tr>
							<th>{$this->lang->words['System']['CronJob']['ManageTasks']['TaskTitle']}</th>
                            <th>{$this->lang->words['System']['CronJob']['ManageTasks']['Enabled']}</th>
							<th>{$this->lang->words['System']['CronJob']['ManageTasks']['LastExecution']}</th>
                            <th>{$this->lang->words['System']['CronJob']['ManageTasks']['NextExecution']}</th>
                            <th>{$this->lang->words['System']['CronJob']['ManageTasks']['Details']['Link']}</th>
                            <th>{$this->lang->words['System']['CronJob']['ManageTasks']['Options']}</th>
						</tr>
					</thead>
					<tbody>
HTML;
			foreach($manage_tasks as $id => $task)
            {
            	$title = "<strong>".$task['name']."</strong>".(strlen($task['description']) > 0 ? "<br /><i>".$task['description']."</i>" : NULL);
                $switch = $task['switch'] == 1 ? "tick" : "cross";
                
				$CTM_HTML .= <<<HTML
						<tr>
							<td>{$title}</td>
                            <td><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/{$switch}.png" border="0" /></td>
							<td>{$task['last_execution']}</td>
                            <td>{$task['next_execution']}</td>
							<td>
								<a href="#" class="detail-link">{$this->lang->words['System']['CronJob']['ManageTasks']['Details']['Show']}</a>
							</td>
                            <td>
								<a href="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=cronjob&amp;index=runTask&amp;id={$id}"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/task_run.gif" border="0" title="Run Task: #{$id}" /></a>
								<a href="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=cronjob&amp;index=editTask&amp;id={$id}"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/edit.png" border="0" title="Edit Task: #{$id}" /></a>
								<a href="javascript: void(0);" class="removeTask" rel="{$id}"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/cross.png" border="0" title="Remove Task: #{$id}" /></a>
							</td>
						</tr>
                        <tr class="detail">
							<td colspan="7">
								<table>
									<thead>
										<tr>
											<th>{$this->lang->words['System']['CronJob']['ManageTasks']['Details']['Id']}</th>
                                            <th>{$this->lang->words['System']['CronJob']['ManageTasks']['Details']['Minutes']}</th>
                                            <th>{$this->lang->words['System']['CronJob']['ManageTasks']['Details']['Hours']}</th>
                                            <th>{$this->lang->words['System']['CronJob']['ManageTasks']['Details']['Days']}</th>
                                            <th>{$this->lang->words['System']['CronJob']['ManageTasks']['Details']['Weeks']}</th>
                                            <th>{$this->lang->words['System']['CronJob']['ManageTasks']['Details']['Months']}</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>#{$id}</td>
											<td>{$task['occur_options'][4]}</td>
											<td>{$task['occur_options'][3]}</td>
											<td>{$task['occur_options'][2]}</td>
                                            <td>{$task['occur_options'][1]}</td>
                                            <td>{$task['occur_options'][0]}</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
					</tbody>
				</table>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
				<div class="information msg">{$this->lang->words['System']['CronJob']['ManageTasks']['NoTasks']}</div>
HTML;
        }
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;
    
		return $CTM_HTML;
    }
    /**
	 *	CronJob: Run Task
	 *
	 *	@return	string	HTML String
	*/
    public function cronjob_runTask()
    {
    	global $task_error, $cronjob_result;
        $cronjob_result = str_replace("\r\n", "<br />", $cronjob_result);
        
        $CTM_HTML = <<<HTML
			<article>
				<h1>{$this->lang->words['System']['CronJob']['RunTask']['Title']}</h1>
HTML;
		if($task_error == true)
		{
			$CTM_HTML .= <<<HTML
                <div class="information msg">{$this->lang->words['System']['CronJob']['RunTask']['TaskError']}</div>
HTML;
		}
		else
		{
			$CTM_HTML .= <<<HTML
                <form name="runTask" id="runTask" class="uniform">
                    <fieldset>
                            <legend>{$this->lang->words['System']['CronJob']['RunTask']['CronJobResult']}</legend>
                            <p>{$cronjob_result}</p>
					</fieldset>
				</form>
HTML;
		}
            
        $CTM_HTML .= <<<HTML
			</article>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	CronJob: Edit Task
	 *
	 *	@return	string	HTML String
	*/
    public function cronjob_editTask()
	{
		global $cronTasks, $cron_task, $task_error, $result_command;
		
		$CTM_HTML = <<<HTML
<script type="text/javascript">
			$(document).ready(function()
			{
				$("#EndEnable").click(function()
				{
					if(!$("#EndEnable").is(":checked"))
					{
						$("#endOptions").slideUp(341, function()
						{
							$("#EndDate").val(0);
							$("#EndHour").val(0);
						});
					}
					else
					{
						$("#EndDate").val('');
						$("#EndHour").val('');
						$("#endOptions").slideDown(341);
					}
				});
			});
			</script>
			<article>
				<h1>{$this->lang->words['System']['CronJob']['EditTask']['Title']}</h1>
HTML;
			if($task_error == 1)
            {
            	$CTM_HTML .= <<<HTML
                <div class="information msg">{$this->lang->words['System']['CronJob']['EditTask']['TaskInvalid']}</div>
HTML;
			}
			elseif($task_error == 2)
            {
            	$CTM_HTML .= <<<HTML
                <div class="information msg">{$this->lang->words['System']['CronJob']['EditTask']['NoTasks']}</div>
HTML;
			}
            else
            {
            	$display_endDate = $cron_task['end_enabled'] == false ? " style=\"display:none\"" : NULL;
                $end_enabled = $cron_task['end_enabled'] == true ? " checked=\"checked\"" : NULL;
                
                $switch_yes = $cron_task['switch'] == 1 ? " checked=\"checked\"" : NULL;
                $switch_no = $cron_task['switch'] == 0 ? " checked=\"checked\"" : NULL;
                
            	$CTM_HTML .= <<<HTML
                {$result_command}
                <form name="editCronTab" id="editCronTab" action="?app=core&amp;module=system&amp;section=cronjob&amp;index=editTask&amp;id={$cron_task['id']}&amp;write=true" method="post" class="uniform">
                	<fieldset>
                    	<legend>{$this->lang->words['System']['CronJob']['EditTask']['Fields']['Settings']}</legend>
                        <dl class="inline">
                        	<dt><label for="TaskName">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['TaskName']}</label></dt>
                            <dd><input type="text" id="TaskName" name="TaskName" class="medium" value="{$cron_task['name']}" /></dd>
                            
                            <dt><label for="TaskDescription">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['TaskDescription']}</label></dt>
                            <dd><input type="text" id="TaskDescription" name="TaskDescription" class="medium" value="{$cron_task['description']}" /></dd>
                            
                            <dt><label for="TaskFile">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['TaskFile']}</label></dt>
                            <dd>
                            	<select name="TaskFile" id="TaskFile">
HTML;
                if(count($cronTasks) > 0)
                {
                    foreach($cronTasks as $task)
                    {
                    	$selected = $task == $cron_task['file'] ? " selected=\"selected\"" : NULL;
                        $CTM_HTML .= <<<HTML
                                        <option value="{$task}"{$selected}>{$task} (.task.php)</option>
HTML;
                    }
                }
                
                $CTM_HTML .= <<<HTML
                        		</select>
                        	</dd>
                            
                            <dt><label for="Switch">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['Enable']}</label></dt>
                            <dd>
                            	<span class="yesno_yes"><input type="radio" name="Switch" id="Switch_YES" value="1"{$switch_yes} />
									<label for="Switch_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no">
									<input type="radio" name="Switch" id="Switch_NO" value="0"{$switch_no} />
									<label for="Switch_NO">{$this->lang->words['Words']['No']}</label>
								</span>
                            </dd>
                        </dl>
                    </fieldset>
                    <fieldset>
                    	<legend>{$this->lang->words['System']['CronJob']['EditTask']['Fields']['Occur']}</legend>
                        <dl class="inline">
                        	<dt><label for="EveryDays">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['Days']}</label></dt>
							<dd><input type="text" id="EveryDays" name="EveryDays" class="min" size="4" value="{$cron_task['occur_options'][0]}" /></dd>
                            
                            <dt><label for="EveryWeeks">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['Weeks']}</label></dt>
							<dd><input type="text" id="EveryWeeks" name="EveryWeeks" class="min" size="4" value="{$cron_task['occur_options'][1]}" /></dd>
                            
                            <dt><label for="EveryMonths">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['Months']}</label></dt>
							<dd><input type="text" id="EveryMonths" name="EveryMonths" class="min" size="4" value="{$cron_task['occur_options'][2]}" /></dd>
                            
                            <dt><label for="EveryHours">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['Hours']}</label></dt>
							<dd><input type="text" id="EveryHours" name="EveryHours" class="min" size="4" value="{$cron_task['occur_options'][3]}" /></dd>
                            
                            <dt><label for="EveryMinutes">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['Minutes']}</label></dt>
							<dd><input type="text" id="EveryMinutes" name="EveryMinutes" class="min" size="4" value="{$cron_task['occur_options'][4]}" /></dd>
						</dl>
					</fieldset>
                    <fieldset>
                    	<legend>{$this->lang->words['System']['CronJob']['EditTask']['Fields']['Begin']}</legend>
                        <dl class="inline">
                        	<dt><label for="BeginDate">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['BeginDate']}</label></dt>
                            <dd><input type="text" id="BeginDate" name="BeginDate" maxlength="10" class="small" set="dateSet" value="{$cron_task['begin_date']}" /></dd>
                            
                            <dt><label for="BeginHour">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['BeginHour']}</label></dt>
                            <dd><input type="text" id="BeginHour" name="BeginHour" maxlength="5" class="min" size="10" value="{$cron_task['begin_hour']}" /></dd>
                        </dl>    
                    </fieldset>
                    <fieldset>
                    	<legend>{$this->lang->words['System']['CronJob']['EditTask']['Fields']['End']}</legend>
                        <dl class="inline">
                        	<dt><label for="EndEnable">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['Enable']}</label></dt>
                            <dd><input type="checkbox" id="EndEnable" name="EndEnable"{$end_enabled} /></dd>
                            
                            <div id="endOptions"{$display_endDate}>
                                <dt><label for="EndDate">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['EndDate']}</label></dt>
                                <dd><input type="text" id="EndDate" name="EndDate" maxlength="10" class="small" set="dateSet" value="{$cron_task['end_date']}"  /></dd>
                                
                                <dt><label for="EndHour">{$this->lang->words['System']['CronJob']['EditTask']['Fields']['EndHour']}</label></dt>
                                <dd><input type="text" id="EndHour" name="EndHour" maxlength="5" class="min" size="10" value="{$cron_task['end_hour']}"  /></dd>
                        	</div>
                        </dl>    
                    </fieldset>
					<p>
						<button type="submit" class="button">{$this->lang->words['System']['CronJob']['EditTask']['Button']}</button>
					</p>
				</form>
HTML;
			}
            
			$CTM_HTML .= <<<HTML
			</article>
HTML;

		return $CTM_HTML;
	}
    /**
	 *	[Board] License: Authenticate License
	 *
	 *	@return	string	HTML String
	*/
    public function authenticate_license()
    {
    	global $checker_result, $extra_messages;
        
        $CTM_HTML = <<<HTML
			<article>
				<h1>{$this->lang->words['System']['Board']['License']['AuthenticateLicense']['Title']}</h1>
                {$checker_result}
                {$extra_messages}
			</article>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	[Board] License: Change Serial
	 *
	 *	@return	string	HTML String
	*/
    public function change_license_serial()
    {
    	global $domain_address, $ip_address, $serial_key, $result_command, $extra_messages;
        
        $CTM_HTML = <<<HTML
			<script type="text/javascript">
            $(function()
            {
                var DefaultHost = "{$domain_address}";
                var DefaultIP = "{$ip_address}";
                
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
                        setResult("Fill in the Domain Host.", "warning");
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
                            CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=core&module=system&section=board&index=license&do=changeSerial&write=true", "CommandResult", "ActivateProduct");
                        }});
                    }
                    else
                    {
                        CTM.AjaxLoad("{$this->acp_vars['acp_url']}?app=core&module=system&section=board&index=license&do=changeSerial&write=true", "CommandResult", "ActivateProduct");
                    }
                });
            });
            function setDomain()
            {
                string = $("#DomainAddress").val().replace(/(http:\/\/|https:\/\/|www\.|(:.*|\/.*)|[^0-9a-z\-\.])/i, "");
                $("#DomainAddress").val(string.toLowerCase());
            }
            function setIPAddress()
            {
                string = $("#IPAddress").val().replace(/[^0-9\.]/i, "");
                $("#IPAddress").val(string);
            }
            function setSerial(field)
            {
                string = $("#SerialKey-"+field).val().replace(/[^0-9A-Z]/i, "");
                $("#SerialKey-"+field).val(string.toUpperCase());
            }
            function setResult(message, msg)
            {
                $("#CommandResult").html("<div class=\""+msg+" msg\"> "+message+"</div>");
            }
                
            function activationSucceed()
            {
                setResult("<script>CTM.RedirectCount"+"('{$this->acp_vars['acp_url']}', 5, 'time');"+"<"+"/script>\
                <strong>Product Actived!</strong><br />\
                The Effect Web is actived with success.<br /><br />\
                You will redirected in <strong id=\"time\">6</strong> seconds.", "success");
            }
            </script>
			<article>
				<h1>{$this->lang->words['System']['Board']['License']['ChangeSerial']['Title']}</h1>
                {$result_command}
                {$extra_messages}
                <form name="ActivateProduct" id="ActivateProduct" class="uniform">
					<dl>
						<dt><label for="DomainHost">Host Address</label></dt>
						<dd><input type="text" id="DomainAddress" name="DomainAddress" value="{$domain_address}" onkeyup="setDomain();" /></dd>
                        
                        <dt><label for="IPAddress">IP Address</label></dt>
						<dd><input type="text" id="IPAddress" name="IPAddress" value="{$ip_address}" onkeyup="setIPAddress();" /></dd>
                        
                        <dt><label>Serial:</label></dt>
						<dd>
                        	<input type="text" size="5" maxlength="5" name="SerialKey-1" id="SerialKey-1" onkeyup="setSerial(1);" value="{$serial_key[0]}" /> - 
                            <input type="text" size="5" maxlength="5" name="SerialKey-2" id="SerialKey-2" onkeyup="setSerial(2);" value="{$serial_key[1]}" /> - 
                            <input type="text" size="5" maxlength="5" name="SerialKey-3" id="SerialKey-3" onkeyup="setSerial(3);" value="{$serial_key[2]}" /> - 
                            <input type="text" size="5" maxlength="5" name="SerialKey-4" id="SerialKey-4" onkeyup="setSerial(4);" value="{$serial_key[3]}" /> - 
                            <input type="text" size="5" maxlength="5" name="SerialKey-5" id="SerialKey-5" onkeyup="setSerial(5);" value="{$serial_key[4]}" />
                        </dd>
					</dl>
					<p>
						<input type="button" class="button" id="ActivateSerial" value="Activate License" />
					</p>
				</form>
			</article>
            <div id="CommandResult"></div>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	Templates: Manage Templates
	 *
	 *	@return	string	HTML String
	*/
    public function templates_manageTemplates()
    {
    	global $core_templates, $result_message;
        
        $CTM_HTML = <<<HTML
        <article>
				<h1>{$this->lang->words['System']['Templates']['ManageTemplates']['Templates']['Title']}</h1>
                {$result_message}
HTML;
            
		if(count($core_templates) > 0)
        {
        	$CTM_HTML .= <<<HTML
                <table id="table1" class="gtable sortable">
                    <thead>
                        <tr>
                            <th>{$this->lang->words['System']['Templates']['ManageTemplates']['Templates']['Table']['Name']}</th>
                            <th>{$this->lang->words['System']['Templates']['ManageTemplates']['Templates']['Table']['Author']}</th>
                            <th>{$this->lang->words['System']['Templates']['ManageTemplates']['Templates']['Table']['Options']}</th>
                        </tr>
                    </thead>
                    <tbody>
HTML;
			foreach($core_templates as $key => $tpl)
            {
            	$CTM_HTML .= <<<HTML
                        <tr>
                            <td><a href="?app=core&amp;module=system&amp;section=templates&amp;index=manage&amp;do=show_files&amp;template={$key}" title="Show Files">{$tpl['name']}</a></td>
                            <td><a href="{$tpl['author']['site']}" target="_blank">{$tpl['author']['name']}</a></td>
                            <td>
                            	<a href="?app=core&amp;module=system&amp;section=templates&amp;index=manage&amp;do=show_files&amp;template={$key}" title="Edit"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/bookmarks.png" alt="Show Files" /></a>
                                <a href="?app=core&amp;module=system&amp;section=templates&amp;index=manage&amp;do=remove_skin&amp;template={$key}" title="Delete"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/cross.png" alt="Delete" /></a>
                            </td>
                        </tr>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
                                </tbody>
                </table>
HTML;
        }
        else
        {
        	$CTM_HTML .= <<<HTML
            	<div class="information msg">{$this->lang->words['System']['Templates']['ManageTemplates']['Templates']['NoTemplates']}</div>
HTML;
        }
        
        $CTM_HTML .= <<<HTML
        		<br />
				<p>
					<button type="button" class="button" onclick="window.location = '?app=core&module=system&section=templates&index=manage&do=create_template'">{$this->lang->words['System']['Templates']['ManageTemplates']['Templates']['CreateTemplate']}</button>
				</p>
			</article>
HTML;
        
        return $CTM_HTML;
    }
    /**
	 *	Templates: Skin Files
	 *
	 *	@return	string	HTML String
	*/
    public function templates_skinFiles()
    {
    	global $skin_files;
        
        $CTM_HTML = <<<HTML
        <script type="text/javascript">
        var set_files_loaded = new Array();
        
        function loadSkinFiles(_key)
        {
        	if(!set_files_loaded[_key])
            {
        		CTM.AjaxLoad("?app=core&module=system&section=templates&index=manage&do=show_files&template={$skin_files['skin_tpl']}&list_files="+_key, "show_skin_files_"+_key);
                set_files_loaded[_key] = 1;
			}
            else
            {
            	if($("#show_skin_files_"+_key).is(":visible"))
                {
                	$("#show_skin_files_"+_key).slideUp(341);
                }
                else
                {
                	$("#show_skin_files_"+_key).slideDown(341);
                }
            }
        }
        
        function showSkinFile(file, category, type)
        {
        	$.fancybox(
            {
                ajax :
                {
                    type : "GET",
                    data : "template={$skin_files['skin_tpl']}&type="+type+"&category="+category+"&file="+file
                },
                href : "?app=core&module=system&section=templates&index=manage&do=load_file&ajaxLoadSet=true"
            });
        }
        
        function fileEditorDelete(type, category, file)
        {
        	$.fancybox.close();
            
            if(type == "css")
            {
            	$("#skin_css_files li[class=tpl_css_"+file.replace("-", "_").replace(".", "_").replace(" ", "_")+"]").hide("slow", function()
                {
                	$(this).html("");
                });
            }
            else
            {
            	CTM.AjaxLoad("?app=core&module=system&section=templates&index=manage&do=show_files&template={$skin_files['skin_tpl']}&list_files="+category, "show_skin_files_"+category);
                set_files_loaded[category] = 1;
            }
            
            $("#resultMessage").html("<div class=\"success msg\">"+"{$this->lang->words['System']['Templates']['ManageTemplates']['SkinEditor']['Messages']['Saved']}".replace("%s", file)+"<div>");
            $("#resultMessage").fadeIn("slow");
        }
        
        function addSkinFile(type, category, file_name)
        {
        	if(type == "css")
            	var message = "{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddCSS']['Messages']['Success']}";
            else
            	var message = "{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddSet']['Messages']['Success']}";
              
            if(type == "set")
            {
            	CTM.AjaxLoad("?app=core&module=system&section=templates&index=manage&do=show_files&template={$skin_files['skin_tpl']}&list_files="+category, "show_skin_files_"+category);
                set_files_loaded[category] = 1;
            }
            else if(type == "css")
            {
            	$("#skin_css_files").prepend("<li class=\"tpl_css_"+file_name.replace("-", "_").replace(".", "_").replace(" ", "_")+"\"><a href=\"javascript: void(0);\" onclick=\"showSkinFile('"+encodeURIComponent(file_name+".css")+"', 'null', 'css');\"><strong>"+file_name+".css</strong></a></li>");
                
                file_name += ".css";
            }
              
            $("#resultMessage").html("<div class=\"success msg\">"+message.replace("%s", file_name)+"<div>");
            $("#resultMessage").fadeIn("slow");
        }
        
        $(function()
        {
        	$("#addSetFile").click(function()
            {
            	CTM.AjaxLoad("?app=core&module=system&section=templates&index=manage&do=show_files&template={$skin_files['skin_tpl']}&add_file=set&write=true", "resultMessage", "addSkinSetForm");
            });
            
            $("#addCSSFile").click(function()
            {
            	CTM.AjaxLoad("?app=core&module=system&section=templates&index=manage&do=show_files&template={$skin_files['skin_tpl']}&add_file=css&write=true", "resultMessage", "addSkinCSSForm");
            });
        });
        </script>
        <article>
				<h1>{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['Title']}</h1>
                <div id="resultMessage"></div>
HTML;
        
		$CTM_HTML .= <<<HTML
            	<ul class="tabs">
                	<li><a href="#tabs-set">{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['Tabs']['Set']['Option']}</a></li>
                    <li><a href="#tabs-css">{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['Tabs']['CSS']['Option']}</a></li>
				</ul>
                <div class="tabcontent">
                	<div id="tabs-set">
                    	<ul class="tabs">
                        	<li><a href="#tabs-setfiles">{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['Tabs']['Set']['Files']}</a></li>
                            <li><a href="#tabs-addset">{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['Tabs']['Set']['AddSet']}</a></li>
						</ul>
                        <div class="tabcontent">
                        	<div id="tabs-setfiles" class="content">	
HTML;
		if(count($skin_files['skin_set']) > 0)
        {
        	$CTM_HTML .= <<<HTML
            
            					<ul>
HTML;
        	foreach($skin_files['skin_set'] as $key => $value)
            {
            	$CTM_HTML .= <<<HTML

									<li>
                                    	<a href="javascript: void(0);" onclick="loadSkinFiles('{$key}');"><strong>{$value}</strong></a>
                                        <ul id="show_skin_files_{$key}"></ul>
									</li>
HTML;
            }
            
            $CTM_HTML .= <<<HTML
            
								</ul>
							</div>
							<div id="tabs-addset">
                                <form name="addSkinSetForm" id="addSkinSetForm" method="post" class="uniform">
                                    <fieldset>
                                        <legend>{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddSet']['Title']}</legend>
                                        <dl class="inline">
                                            <dt><label for="SetName">{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddSet']['SetName']}</label></dt>
                                            <dd><input type="text" id="SetName" name="SetName" class="medium" /></dd>
                                            
                                            <dt><label for="Category">{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddSet']['Category']}</label></dt>
                                            <dd>
                            					<select name="Category" id="Category">
HTML;
		foreach($skin_files['skin_set'] as $key => $value)
		{
        	$CTM_HTML .= <<<HTML
            									
                                                	<option value="{$key}">{$value}</option>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                            					</select>
                                        	</dd>
                                            
                                            <p>
                                            	<button type="button" id="addSetFile" class="button">{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddSet']['Button']}</button>
                                        	</p>
                                        </dl>
                            		</fieldset>
                            	</form>
HTML;
        }
        else
        {
        	$CTM_HTML .= <<<HTML
								<div class="information msg">{$this->lang->words['System']['Templates']['ManageTemplates']['SkinFiles']['Tabs']['Set']['NoFiles']}</div>
HTML;
        }
        
        $CTM_HTML .= <<<HTML
        
                        	</div>
						</div>
					</div>
                    <div id="tabs-css">
                    	<ul class="tabs">
                        	<li><a href="#tabs-cssfiles">{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['Tabs']['CSS']['Files']}</a></li>
                            <li><a href="#tabs-addcss">{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['Tabs']['CSS']['AddSet']}</a></li>
						</ul>
                        <div class="tabcontent">
                        	<div id="tabs-cssfiles" class="content">	
HTML;
		if(count($skin_files['skin_css']) > 0)
        {
        	$CTM_HTML .= <<<HTML
            
            					<ul id="skin_css_files">
HTML;
        	foreach($skin_files['skin_css'] as $css)
            {
            	$key = eregi_replace("[^A-Za-z0-9_]", "_", $css);
                $url = urlencode($css);
            	$CTM_HTML .= <<<HTML
                
									<li class="tpl_css_{$key}"><a href="javascript: void(0);" onclick="showSkinFile('{$url}', 'null', 'css');"><strong>{$css}</strong></a></li>
HTML;
            }
            
            $CTM_HTML .= <<<HTML
            
								</ul>
HTML;
        }
        else
        {
        	$CTM_HTML .= <<<HTML
								<div class="information msg">{$this->lang->words['System']['Templates']['ManageTemplates']['SkinFiles']['Tabs']['CSS']['NoFiles']}</div>
HTML;
        }
        
		$CTM_HTML .= <<<HTML
        
                        	</div>
                            <div id="tabs-addcss">
								<form name="addSkinCSSForm" id="addSkinCSSForm" method="post" class="uniform">
                                    <fieldset>
                                        <legend>{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddCSS']['Title']}</legend>
                                        <dl class="inline">
                                            <dt><label for="CSSName">{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddCSS']['CSSName']}</label></dt>
                                            <dd><input type="text" id="CSSName" name="CSSName" class="medium" /> (.css)</dd>
                                            <p>
                                            	<button type="button" id="addCSSFile" class="button">{$this->lang->words['System']['Templates']['ManageTemplates']['ShowFiles']['AddCSS']['Button']}</button>
                                        	</p>
                                        </dl>
                            		</fieldset>
                            	</form>
                            </div>
						</div>
					</div>
				</div>
			</article>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	Templates: Skin File Editor
	 *
	 *	@return	string	HTML String
	*/
    public function templates_skinEditor()
    {
    	global $skin_editor;
        
    	$CTM_HTML = <<<HTML
        	<script type="text/javascript">
            $(function()
            {
            	$("#saveFile").click(function()
                {
                	CTM.AjaxLoad("?app=core&module=system&section=templates&index=manage&do=load_file&template={$skin_editor['template']}&type={$skin_editor['type']}&category={$skin_editor['category']}&file={$skin_editor['file']}&write=save", "resultCommand", "skinEditor");
                });
                $("#deleteFile").click(function()
                {
                	CTM.AjaxLoad("?app=core&module=system&section=templates&index=manage&do=load_file&template={$skin_editor['template']}&type={$skin_editor['type']}&category={$skin_editor['category']}&file={$skin_editor['file']}&write=delete", "resultCommand");
                });
                $("#closeEditor").click(function()
                {
                	$.fancybox.close();
                });
            });
            </script>
			<form name="skinEditor" id="skinEditor" method="post" class="uniform">
				<textarea name="FileEditor" id="FileEditor" rows="37" cols="220">{$skin_editor['content']}</textarea>
                <p>
					<button type="button" id="saveFile" class="button">{$this->lang->words['System']['Templates']['ManageTemplates']['SkinEditor']['Button']['Save']}</button>
                    <button type="button" id="deleteFile" class="button red">{$this->lang->words['System']['Templates']['ManageTemplates']['SkinEditor']['Button']['Delete']}</button>
                    <button type="button" id="closeEditor" class="button white">{$this->lang->words['System']['Templates']['ManageTemplates']['SkinEditor']['Button']['Close']}</button>
				</p>
			</form>
            <div id="resultCommand"></div>
HTML;

		return $CTM_HTML;
    }
    /**
     *	Templates: Create Template
     *
     *	@return	string	HTML String
    */
    public function templates_createTemplate()
    {
    	global $result_command;
        
        $site = $_POST['AuthorSite'] ? $_POST['AuthorSite'] : "http://";
        
        $CTM_HTML = <<<HTML
			<article>
				<h1>{$this->lang->words['System']['Templates']['CreateTemplate']['Title']}</h1>
				{$result_command}
                <form name="createTemplate" id="createTemplate" action="?app=core&amp;module=system&amp;section=templates&amp;index=manage&amp;do=create_template&amp;write=true" method="post" class="uniform">
                	<fieldset>
                    	<legend>{$this->lang->words['System']['Templates']['CreateTemplate']['Fields']['Settings']}</legend>
                        <dl class="inline">
                        	<dt><label for="SkinName">{$this->lang->words['System']['Templates']['CreateTemplate']['Fields']['SkinName']}</label></dt>
                            <dd><input type="text" id="SkinName" name="SkinName" class="medium" value="{$_POST['SkinName']}" /></dd>
                            
                            <dt><label for="SkinSet">{$this->lang->words['System']['Templates']['CreateTemplate']['Fields']['SkinSet']}</label></dt>
                            <dd><input type="text" id="SkinSet" name="SkinSet" class="medium" value="{$_POST['SkinSet']}" /></dd>
						</dl>
					</fieldset>
                    <fieldset>
                    	<legend>{$this->lang->words['System']['Templates']['CreateTemplate']['Fields']['Author']}</legend>
                        <dl class="inline">
                        	<dt><label for="AuthorName">{$this->lang->words['System']['Templates']['CreateTemplate']['Fields']['AuthorName']}</label></dt>
                            <dd><input type="text" id="AuthorName" name="AuthorName" class="medium" value="{$_POST['AuthorName']}" /></dd>
                            
                            <dt><label for="AuthorSite">{$this->lang->words['System']['Templates']['CreateTemplate']['Fields']['AuthorSite']}</label></dt>
                            <dd><input type="text" id="AuthorSite" name="AuthorSite" class="medium" value="{$site}" /></dd>
						</dl>
					</fieldset>
					<p>
						<button type="submit" class="button">{$this->lang->words['System']['Templates']['CreateTemplate']['Button']}</button>
					</p>
				</form>
			</article>
HTML;

		return $CTM_HTML;
    }
    /**
     *	Templates: Import/Export
     *
     *	@return	string	HTML String
    */
    public function templates_importExport()
    {
    	global $templates, $result_command, $template_default_xml_file;
        
        $default_path = $_POST['FilePath'] ? $_POST['FilePath'] : $template_default_xml_file;
        
        $CTM_HTML = <<<HTML
			<article>
				<h1>{$this->lang->words['System']['Templates']['ImportExport']['Title']}</h1>
				{$result_command}
                <ul class="tabs">
                	<li><a href="#tabs-import">{$this->lang->words['System']['Templates']['ImportExport']['Import']['TabTitle']}</a></li>
                    <li><a href="#tabs-export">{$this->lang->words['System']['Templates']['ImportExport']['Export']['TabTitle']}</a></li>
				</ul>
                <div class="tabcontent">
                	<div id="tabs-import">
                    	<form name="exportTemplate" id="exportTemplate" action="?app=core&amp;module=system&amp;section=templates&amp;index=importExport&amp;process=import" method="post"  enctype="multipart/form-data" class="uniform">
                            <fieldset>
                                <legend>{$this->lang->words['System']['Templates']['ImportExport']['Import']['Title']}</legend>
                                <dl class="inline">
                                    <dt><label for="FileUpload">{$this->lang->words['System']['Templates']['ImportExport']['Import']['Fields']['Upload']}</label></dt>
                                    <dd><input type="file" name="FileUpload" id="FileUpload" /></dd>
                                    
                                    <dt><label for="FilePath">{$this->lang->words['System']['Templates']['ImportExport']['Import']['Fields']['FilePath']}</label></dt>
                            		<dd><input type="text" id="FilePath" name="FilePath" class="medium" value="{$default_path}" /></dd>
                                </dl>
                            </fieldset>
                            <p>
                                <button type="submit" class="button">{$this->lang->words['System']['Templates']['ImportExport']['Import']['Button']}</button>
                            </p>
                        </form>
                    </div>
                	<div id="tabs-export">
                    	<form name="exportTemplate" id="exportTemplate" action="?app=core&amp;module=system&amp;section=templates&amp;index=importExport&amp;process=export" method="post" class="uniform">
                            <fieldset>
                                <legend>{$this->lang->words['System']['Templates']['ImportExport']['Export']['Title']}</legend>
                                <dl class="inline">
                                    <dt><label for="Template">{$this->lang->words['System']['Templates']['ImportExport']['Export']['Fields']['Template']}</label></dt>
                                    <dd>
                                        <select name="Template" id="Template">
HTML;
                if(count($templates) > 0)
                {
                    foreach($templates as $key => $name)
                    {
                        $CTM_HTML .= <<<HTML
                                        		<option value="{$key}">{$name}</option>
HTML;
                    }
                }
                
                $CTM_HTML .= <<<HTML
                                        </select>
                                    </dd>
                                </dl>
                            </fieldset>
                            <p>
                                <button type="submit" class="button">{$this->lang->words['System']['Templates']['ImportExport']['Export']['Button']}</button>
                            </p>
                        </form>
					</div>
				</div>
            </article>           
HTML;

        return $CTM_HTML;
    }
    /**
     *	Analysis: System Logs
     *
     *	@return	string	HTML String
    */
    public function analysis_logs()
    {
    	global $logs_folders, $result_command;
        
		$CTM_HTML = <<<HTML
			<article>
				<h1>{$this->lang->words['System']['Analysis']['SystemLogs']['Index']['Title']}</h1>
				{$result_command}
                
                <form name="FolderDoCommand" id="FolderDoCommand" method="post" action="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=analysis&amp;index=logs&amp;do_folder=true">
					<table id="table1" class="gtable sortable">
						<thead>
							<tr>
								<th><input type="checkbox" class="checkall" /></th>
								<th>{$this->lang->words['System']['Analysis']['SystemLogs']['Index']['Table']['LogName']}</th>
								<th>{$this->lang->words['System']['Analysis']['SystemLogs']['Index']['Table']['RowsCount']}</th>
							</tr>
						</thead>
						<tbody>
HTML;
		foreach($logs_folders as $key => $value)
        {
        	$CTM_HTML .= <<<HTML
							<tr>
								<td><input type="checkbox" name="folder__{$key}" id="folder__{$key}" value="1" /></td>
								<td><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=analysis&amp;index=logs&amp;load_folder={$key}">{$value['name']}</td>
								<td>{$value['count_files']}</td>
							</tr>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
						</tbody>
					</table>
                    <div class="tablefooter clearfix">
						<div class="actions">
							<select name="DoCommand" id="DoCommand">
								<option value="" disabled="disabled" selected="selected">{$this->lang->words['System']['Analysis']['SystemLogs']['Index']['Action']['Action']}</option>
								<option value="downloadFolders">{$this->lang->words['System']['Analysis']['SystemLogs']['Index']['Action']['DownloadFolders']}</option>
								<option value="clearFolders">{$this->lang->words['System']['Analysis']['SystemLogs']['Index']['Action']['ClearFolders']}</option>
							</select>
							<button class="button small">{$this->lang->words['System']['Analysis']['SystemLogs']['Index']['Action']['Button']}</button>
						</div>
					</div>
				</form>
			</article>
HTML;

		return $CTM_HTML;
    }
    /**
     *	Analysis: Log Files
     *
     *	@return	string	HTML String
    */
    public function analysis_logsFiles()
    {
    	global $logs_files, $result_command;
        
        if(empty($result_command) && !empty($_GET['message']))
        {
        	switch($_GET['message'])
            {
            	case "file_deleted" :
                	$result_command = "<div class=\"success msg\">{$this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Messages']['FileDeleted']}</div>";
                break;
            }
        }
        
		$CTM_HTML = <<<HTML
        	<script type="text/javascript">
        	$(function()
            {
            	$(".open_file").click(function()
                {
                	url = $(this).attr("rel").replace("link:", "");
                    
                    window.location = url;
                    //CTM.AjaxShowBox(url);
                });
            });
            </script>
			<article>
				<h1>{$this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Title']}</h1>
				{$result_command}

HTML;
		if(count($logs_files) > 0)
		{
			$CTM_HTML .= <<<HTML
                <form name="LogDoCommand" id="LogDoCommand" method="post" action="{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=analysis&amp;index=logs&amp;load_folder={$_GET['load_folder']}&amp;do=true">
					<table id="table1" class="gtable sortable">
						<thead>
							<tr>
								<th><input type="checkbox" class="checkall" /></th>
								<th>{$this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Table']['LogName']}</th>
								<th>{$this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Table']['ChangeData']}</th>
                                <th>{$this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Table']['FileSize']}</th>
							</tr>
						</thead>
						<tbody>
HTML;
            foreach($logs_files as $key => $value)
            {
                $CTM_HTML .= <<<HTML
							<tr>
								<td><input type="checkbox" name="file__{$key}" id="file__{$key}" value="1" /></td>
								<td><a href="javascript: void(0);" class="open_file" rel="link:{$this->acp_vars['acp_url']}?app=core&amp;module=system&amp;section=analysis&amp;index=logs&amp;folder={$_GET['load_folder']}&amp;load_file={$key}">{$key}</td>
								<td>{$value['change_data']}</td>
                                <td>{$value['file_size']}</td>
							</tr>
HTML;
			}
        
        	$CTM_HTML .= <<<HTML
						</tbody>
					</table>
                    <div class="tablefooter clearfix">
						<div class="actions">
							<select name="DoCommand" id="DoCommand">
								<option value="" disabled="disabled" selected="selected">{$this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Action']['Action']}</option>
								<option value="downloadFiles">{$this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Action']['DownloadFolders']}</option>
								<option value="deleteFiles">{$this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Action']['ClearFolders']}</option>
							</select>
							<button class="button small">{$this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Action']['Button']}</button>
						</div>
					</div>
				</form>
HTML;
		}
		else
		{
			$CTM_HTML .= <<<HTML
				<div class="information msg">{$this->lang->words['System']['Analysis']['SystemLogs']['CategoryLogs']['Messages']['NoFiles']}</div>
HTML;
		}
            
		$CTM_HTML .= <<<HTML
			</article>
HTML;

		return $CTM_HTML;
    }
	/**
     *	Analysis: Show Log File
     *
     *	@return	string	HTML String
    */
    public function analysis_logsShowFile()
    {
    	global $file_exists, $log_file_content;
        $log_file_content = str_replace("\r\n", "<br />", $log_file_content);
        
        $CTM_HTML = <<<HTML
			<article>
				<h1>{$this->lang->words['System']['Analysis']['SystemLogs']['ShowLogs']['Title']}</h1>
HTML;
		if($file_exists == true)
		{
			$CTM_HTML .= <<<HTML
                <form name="showLogFile" id="showLogFile" class="uniform">
                    <fieldset>
                            <legend>{$this->lang->words['System']['Analysis']['SystemLogs']['ShowLogs']['LogContent']}</legend>
                            <p>{$log_file_content}</p>
					</fieldset>
                    <fieldset>
                    	<legend>{$this->lang->words['System']['Analysis']['SystemLogs']['ShowLogs']['Commands']}</legend>
                        <p>
                            <button type="button" class="button black" onclick="window.location='{$this->acp_vars['acp_url']}?app=core&module=system&section=analysis&index=logs&folder={$_GET['folder']}&load_file={$_GET['load_file']}&do=download'">{$this->lang->words['System']['Analysis']['SystemLogs']['ShowLogs']['Buttons']['DownloadFile']}</button>
                            <button type="button" class="button red" onclick="window.location='{$this->acp_vars['acp_url']}?app=core&module=system&section=analysis&index=logs&folder={$_GET['folder']}&load_file={$_GET['load_file']}&do=delete'">{$this->lang->words['System']['Analysis']['SystemLogs']['ShowLogs']['Buttons']['DeleteFile']}</button>
                        </p>
					</fieldset>
                </form>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
                <div class="information msg">{$this->lang->words['System']['Analysis']['SystemLogs']['ShowLogs']['Messages']['FileNotExists']}</div>
HTML;
        }
            
        $CTM_HTML .= <<<HTML
			</article>
HTML;

		return $CTM_HTML;
    }
}

$callSkinCache = new CTM_ACPSkin_System();
$callSkinCache->registry();