<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP API: Application Skin
 * Last Update: 05/10/2012 - 12:34h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_ACPSkin_Members extends CTM_ACPCommand
{
	/**
	 *	Global Sidebar
	 *
	 *	@return	string	HTML String
	*/
	public function core_global_sidebar()
	{
		$CTM_HTML = NULL;
		
		if($this->checkPermission("modules", "core_members_accounts") == true)
		{
			$CTM_HTML .= <<<HTML
<div class="box info">
                <h2>{$this->lang->words['Members']['Sidebar']['Accounts']['Title']}</h2>
				<section>
					<ul>
						<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=accounts">{$this->lang->words['Members']['Sidebar']['Accounts']['ManageAccounts']}</a></li>
HTML;

			$CTM_HTML .= <<<HTML
				
                        <li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=validatingAccounts">{$this->lang->words['Members']['Sidebar']['Accounts']['ValidatingAccounts']}</a></li>
HTML;
			$CTM_HTML .= <<<HTML
				
						<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=bannedAccounts">{$this->lang->words['Members']['Sidebar']['Accounts']['BannedAccounts']}</a></li>
HTML;
			
			$CTM_HTML .= <<<HTML
			
					</ul>
				</section>
			</div>
HTML;
		}
		
		if($this->checkPermission("modules", "core_members_characters") == true)
		{
			$CTM_HTML .= <<<HTML
			<div class="box menu">
                <h2>{$this->lang->words['Members']['Sidebar']['Characters']['Title']}</h2>
				<section>
					<ul>
						<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=characters">{$this->lang->words['Members']['Sidebar']['Characters']['ManageCharacters']}</a></li>
                        <li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=characters&amp;index=createCharacter">{$this->lang->words['Members']['Sidebar']['Characters']['CreateCharacter']}</a></li>
						<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=characters&amp;index=bannedCharacters">{$this->lang->words['Members']['Sidebar']['Characters']['BannedCharacters']}</a></li>
					</ul>
				</section>
			</div>
HTML;
		}
		
		if($this->checkPermission("modules", "core_members_team") == true)
		{
			$CTM_HTML .= <<<HTML
			<div class="box">
                <h2>{$this->lang->words['Members']['Sidebar']['Team']['Title']}</h2>
				<section>
					<ul>
						<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=manageMembers">{$this->lang->words['Members']['Sidebar']['Team']['Members']['Title']}</a>
							<ul>
								<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=addMember">{$this->lang->words['Members']['Sidebar']['Team']['Members']['AddMember']}</a></li>
                        	</ul>
						</li>
						<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=manageGroups">{$this->lang->words['Members']['Sidebar']['Team']['Groups']['Title']}</a>
							<ul>
								<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=createGroup">{$this->lang->words['Members']['Sidebar']['Team']['Groups']['CreateGroup']}</a></li>
                        	</ul>
						</li>
						<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=managePermissions">{$this->lang->words['Members']['Sidebar']['Team']['Permissions']}</a></li>
					</ul>
				</section>
			</div>
HTML;
		}

		return $CTM_HTML;
	}
	/**
	 *	Members: Home
	 *
	 *	@return	string	HTML String
	*/
	public function members_home()
	{
		$CTM_HTML = <<<HTML
<article id="dashboard">
				<h1>{$this->lang->words['Members']['Home']['Title']}</h1>
				
				<h2>{$this->lang->words['Members']['Home']['Links']['Title']}</h2>
				<section class="icons">
					<ul>
						<li>
							<a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=accounts">
								<img src="{$this->acp_vars['acp_url']}skin_cp/images/eleganticons/Info.png" />
								<span>{$this->lang->words['Members']['Home']['Links']['Accounts']}</span>
							</a>
						</li>
						<li>
							<a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=characters">
								<img src="{$this->acp_vars['acp_url']}skin_cp/images/eleganticons/Person-group.png" />
								<span>{$this->lang->words['Members']['Home']['Links']['Characters']}</span>
							</a>
						</li>
						<li>
							<a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=manageMembers">
								<img src="{$this->acp_vars['acp_url']}skin_cp/images/eleganticons/Config.png" />
								<span>{$this->lang->words['Members']['Home']['Links']['TeamMembers']}</span>
							</a>
						</li>
						<li>
							<a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=manageGroups">
								<img src="{$this->acp_vars['acp_url']}skin_cp/images/eleganticons/Folder.png" />
								<span>{$this->lang->words['Members']['Home']['Links']['TeamGroups']}</span>
							</a>
						</li>
					</ul>
				</section>
HTML;

		return $CTM_HTML;
	}
	/**
	 *	Accounts: Search/Home
	 *
	 *	@return	string	HTML String
	*/
	public function accounts_search()
	{
		global $result_command, $accounts_located;
		
		$CTM_HTML = <<<HTML
		<script type="text/javascript">
			$(function()
			{
				$("a[rel*=manageAccountLink]").click(function()
				{
					account = $(this).attr("set");
					window.location = "{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username="+account;
				});
				$("#manageAccount").click(function()
				{
					if(!$("#username:checked").val())
					{
						Sexy.alert("{$this->lang->words['Members']['Accounts']['Search']['Messages']['SelectAccount']}");
					}
					else
					{
						account = $("#username:checked").val();
						action = $("#action").val();
						
						window.location = "{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username="+account+"&do="+action;
					}
				});
			});
			</script>
			<article>
				<h1>{$this->lang->words['Members']['Accounts']['Search']['Title']}</h1>
                {$result_command}
                
                <form name="searchAccounts" id="searchAccounts" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=searchAccounts&amp;write=true" method="post" class="uniform">
                	<fieldset>
                    	<legend>{$this->lang->words['Members']['Accounts']['Search']['Search']}</legend>
                        <dl class="inline">
                            <dt><label for="Reference">{$this->lang->words['Members']['Accounts']['Search']['ReferenceField']}</label></dt>
                            <dd><input type="text" id="Reference" name="Reference" class="medium" /></dd>
    
                            <dt><label for="SearchCase">{$this->lang->words['Members']['Accounts']['Search']['CaseField']['Field']}</label></dt>
                            <dd>
                                <select id="SearchCase" name="SearchCase" class="medium">
                                    <option value="login">{$this->lang->words['Members']['Accounts']['Search']['CaseField']['Login']}</option>
                                    <option value="mail">{$this->lang->words['Members']['Accounts']['Search']['CaseField']['Mail']}</option>
                                    <option value="ip">{$this->lang->words['Members']['Accounts']['Search']['CaseField']['IP']}</option>
                                </select>
                            </dd>
                            
                            <dt><label for="SearchType">{$this->lang->words['Members']['Accounts']['Search']['TypeField']['Field']}</label></dt>
                            <dd>
                                <select id="SearchType" name="SearchType" class="medium">
                                    <option value="exact">{$this->lang->words['Members']['Accounts']['Search']['TypeField']['Exact']}</option>
                                    <option value="startingWith">{$this->lang->words['Members']['Accounts']['Search']['TypeField']['StartingWith']}</option>
                                    <option value="endingWith">{$this->lang->words['Members']['Accounts']['Search']['TypeField']['EndingWith']}</option>
                                    <option value="containing">{$this->lang->words['Members']['Accounts']['Search']['TypeField']['Containig']}</option>
                                </select>
                            </dd>
                        </dl>
                        <p>
                            <button type="submit" class="button">{$this->lang->words['Members']['Accounts']['Search']['Button']}</button>
                        </p>
					</fieldset>
                </form>
HTML;
		if($_GET['write'] == true)
        {
        	if(count($accounts_located) > 0)
            {
        		$CTM_HTML .= <<<HTML
                <br />
				<article>
                	<form name="loadCommand" id="loadCommand">
						<table id="table1" class="gtable sortable">
							<thead>
								<tr>
									<th>#</th>
									<th>{$this->lang->words['Members']['Accounts']['Search']['ResultTable']['Login']}</th>
									<th>{$this->lang->words['Members']['Accounts']['Search']['ResultTable']['Name']}</th>
									<th>{$this->lang->words['Members']['Accounts']['Search']['ResultTable']['Mail']}</th>
                                	<th>{$this->lang->words['Members']['Accounts']['Search']['ResultTable']['IP']}</th>
								</tr>
							</thead>
							<tbody>
HTML;
				foreach($accounts_located as $login => $data)
            	{
                	$CTM_HTML .= <<<HTML
								<tr>
									<td><input type="radio" name="username" id="username" value="{$login}" /></td>
									<td><a href="javascript: void(0);" rel="manageAccountLink" set="{$login}">{$login}</a></td>
									<td>{$data['name']}</td>
									<td>{$data['mail']}</td>
                                	<td>{$data['ip']}</td>
								</tr>
HTML;
				}
                
                $CTM_HTML .= <<<HTML
							</tbody>
						</table>
						<div class="tablefooter clearfix">
							<div class="actions">
                        		<select name="action" id="action">
									<option value="ban">{$this->lang->words['Members']['Accounts']['Search']['Actions']['Ban']}</option>
									<option value="unban">{$this->lang->words['Members']['Accounts']['Search']['Actions']['Unban']}</option>
                                    <option value="manageVIP">{$this->lang->words['Members']['Accounts']['Search']['Actions']['ManageVIP']}</option>
                                    <option value="manageCoin">{$this->lang->words['Members']['Accounts']['Search']['Actions']['ManageCoin']}</option>
HTML;

                $CTM_HTML .= <<<HTML
                
                                    <option value="disconnect">{$this->lang->words['Members']['Accounts']['Search']['Actions']['Disconnect']}</option>
HTML;
                
                $CTM_HTML .= <<<HTML
                
								</select>
								<button type="button" name="manageAccount" id="manageAccount" class="button small">{$this->lang->words['Members']['Accounts']['Search']['Actions']['Button']}</button>
							</div>
						</div>
					</form>
				</article>
HTML;
			}
		}
            
		$CTM_HTML .= <<<HTML
			</article>
HTML;
		
		return $CTM_HTML;
	}
    /**
	 *	Accounts: Ban Account
	 *
	 *	@return	string	HTML String
	*/
    public function accounts_banAccount()
    {
    	global $result_command;
        
        $username = urldecode($_GET['username']);
        $_username = $_GET['username'];
        
        $CTM_HTML = <<<HTML
		<script type="text/javascript">
            $(function()
            {
                $("#banAccountNow").click(function()
                {
HTML;
		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            		CTM.AjaxLoad("{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=ban&write=true", "loadBanCommand", "banAccount");
HTML;
		}
		else
        {
        	$CTM_HTML .= <<<HTML
                 	$("#banAccount").submit();   
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                });
				$("#banExpiration").datepicker(
				{
        			changeMonth: true,
        			changeYear: true
    			});
            });
            </script>
HTML;
		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            <div style="width:600px">
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        	<article>
				<h1>{$this->lang->words['Members']['Accounts']['ManageAccount']['BanAccount']['Title']} :: {$username}</h1>
                <div id="loadBanCommand">
				{$result_command}
                </div>
                <form name="banAccount" id="banAccount" method="post" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$_username}&amp;do=ban&amp;write=true" class="uniform">
					<dl class="inline">
						<dt><label for="banReason">{$this->lang->words['Members']['Accounts']['ManageAccount']['BanAccount']['ReasonField']}</label></dt>
						<dd><input type="text" id="banReason" name="banReason" class="medium" /></dd>

						<dt><label for="banExpiration">{$this->lang->words['Members']['Accounts']['ManageAccount']['BanAccount']['ExpirationField']}</label></dt>
						<dd><input type="text" id="banExpiration" name="banExpiration" readonly="readonly" maxlength="10" class="small" /></dd>
					</dl>
					<p>
						<button type="button" class="button" id="banAccountNow">{$this->lang->words['Members']['Accounts']['ManageAccount']['BanAccount']['Button']}</button>
					</p>
				</form>
			</article>
HTML;

		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            </div>
HTML;
		}
        
        return $CTM_HTML;
    }
    /**
	 *	Accounts: Unban Account
	 *
	 *	@return	string	HTML String
	*/
    public function accounts_unbanAccount()
    {
    	global $result_command, $block_info;
        
        $username = urldecode($_GET['username']);
        $_username = $_GET['username'];
        
        if(!empty($_GET['go']))
        {
        	$go = "&amp;go=".$_GET['go'];
        }
        
        $CTM_HTML = <<<HTML
			<script type="text/javascript">
			$(function()
			{
				$("#unBanNow").click(function()
				{
					Sexy.confirm("{$this->lang->words['Members']['Accounts']['ManageAccount']['UnbanAccount']['Messages']['Confirm']}", { "onComplete" : function(commandResult)
					{
						if(commandResult)
						{
HTML;
		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
							$.fancybox(
							{
								ajax :
								{
									type : "POST",
									data : $("#unBanAccount").serializeArray()
								},
								href : "{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=unban&write=true&ajaxLoadSet=true"
							});
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
							$("#unBanAccount").submit();
HTML;
		}
        
        $CTM_HTML .= <<<HTML
						}
					}});
				});
			});
			</script>
HTML;
		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            <div style="width:600px">
HTML;
		}
        
        $CTM_HTML .= <<<HTML
			<article>
				<h1>{$this->lang->words['Members']['Accounts']['ManageAccount']['UnbanAccount']['Title']} :: {$username}</h1>
HTML;

		if(count($block_info) > 0)
        {
        	$CTM_HTML .= <<<HTML
                <form name="unBanAccount" id="unBanAccount" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$_username}&amp;do=unban&amp;write=true{$go}" method="post" class="uniform">
                    <table id="table1" class="gtable">
						<tbody>
							<tr>
								<td>{$this->lang->words['Members']['Accounts']['ManageAccount']['UnbanAccount']['Reason']}</td>
								<td>{$block_info['reason']}</td>
							</tr>
                            <tr>
								<td>{$this->lang->words['Members']['Accounts']['ManageAccount']['UnbanAccount']['Expiration']}</td>
								<td>{$block_info['expiration']}</td>
							</tr>
                            <tr>
								<td>{$this->lang->words['Members']['Accounts']['ManageAccount']['UnbanAccount']['Responsible']}</td>
								<td>{$block_info['responsible']}</td>
							</tr>
						</tbody>
					</table>
					<p>
						<button type="button" name="unBanNow" id="unBanNow" class="button">{$this->lang->words['Members']['Accounts']['ManageAccount']['UnbanAccount']['Button']}</button>
					</p>
				</form>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
                <div class="error msg">{$this->lang->words['Members']['Accounts']['ManageAccount']['UnbanAccount']['Messages']['NoBanned']}</div>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;

		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            </div>
HTML;
		}
        
        return $CTM_HTML;
    }
    /**
	 *	Accounts: Manage VIP
	 *
	 *	@return	string	HTML String
	*/
    public function accounts_manageVIP()
    {
    	global $result_command, $vip_info;
        
        $username = urldecode($_GET['username']);
        $_username = $_GET['username'];
        
        $vip_name_1 = VIP_NAME_1;
        
        $CTM_HTML = <<<HTML
			<script type="text/javascript">
            $(function()
            {
                $("#executeCommand").click(function()
                {
HTML;
		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
                    CTM.AjaxLoad("{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=manageVIP&command=write", "loadExecCommand", "manageVIP");
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            		$("#manageVIP").submit();
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                });
				$("#removeCommand").click(function()
                {
					Sexy.confirm("<strong>{$this->lang->words['Members']['Accounts']['ManageAccount']['ManageVIP']['Messages']['RemoveVIP']}</strong>", {onComplete: function(e)
					{
						if(e)
HTML;

		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
                    CTM.AjaxLoad("{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=manageVIP&command=remove", "loadExecCommand", "manageVIP");
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            		window.location = "{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=manageVIP&command=remove";
HTML;
		}

		$CTM_HTML .= <<<HTML
					}});
                });

            });
            </script>
HTML;
		
        if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            <div style="width:600px">
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        	<article>
				<h1>{$this->lang->words['Members']['Accounts']['ManageAccount']['ManageVIP']['Title']} :: {$username}</h1>
                <div id="loadExecCommand">
				{$result_command}
                </div>
                <form name="manageVIP" id="manageVIP" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$_username}&amp;do=manageVIP&amp;command=write" method="post" class="uniform">
					<dl class="inline">
                    	<dt><label for="VIPType">{$this->lang->words['Members']['Accounts']['ManageAccount']['ManageVIP']['Type']}</label></dt>
                        <dd>
                        	<select name="VIPType" id="VIPType">
                            	<option value="1">{$vip_name_1}</option>
HTML;
		if(VIP_NUMBER >= 2)
        {
        	$vip_name_2 = VIP_NAME_2;
            $CTM_HTML .= <<<HTML
                                <option value="2">{$vip_name_2}</option>
HTML;
		}
        
		if(VIP_NUMBER >= 3)
        {
        	$vip_name_2 = VIP_NAME_2;
            $CTM_HTML .= <<<HTML
                                <option value="3">{$vip_name_2}</option>
HTML;
		}
        
		if(VIP_NUMBER >= 4)
        {
        	$vip_name_4 = VIP_NAME_4;
            $CTM_HTML .= <<<HTML
                                <option value="4">{$vip_name_4}</option>
HTML;
		}
        
        if(VIP_NUMBER == 5)
        {
        	$vip_name_5 = VIP_NAME_2;
            $CTM_HTML .= <<<HTML
                                <option value="5">{$vip_name_5}</option>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                        	</select>
                        </dd>
						<dt><label for="VIPDays">{$this->lang->words['Members']['Accounts']['ManageAccount']['ManageVIP']['Days']}</label></dt>
						<dd><input type="text" id="VIPDays" name="VIPDays" class="small" onkeypress="return CTM.NumbersOnly(event);" /></dd>
					</dl>
					<p>
						<button type="button" class="button" id="executeCommand">{$this->lang->words['Members']['Accounts']['ManageAccount']['ManageVIP']['Buttons']['Write']}</button>
                        <button type="button" class="button red" id="removeCommand">{$this->lang->words['Members']['Accounts']['ManageAccount']['ManageVIP']['Buttons']['Remove']}</button>
					</p>
				</form>
			</article>
HTML;

		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            </div>
HTML;
		}

		return $CTM_HTML;
	}
    /**
	 *	Accounts: Manage Coin
	 *
	 *	@return	string	HTML String
	*/
    public function accounts_manageCoin()
    {
    	global $result_command, $coin_info;
        
        $username = urldecode($_GET['username']);
        $_username = $_GET['username'];
        
        $coin_name_1 = COIN_NAME_1;
        
        $CTM_HTML = <<<HTML
			<script type="text/javascript">
            $(function()
            {
                $("#insertCommand").click(function()
                {
HTML;

		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
                    CTM.AjaxLoad("{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=manageCoin&command=insert", "loadExecCommand", "manageCoin");
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            		$("#manageCoin").attr("action", "{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=manageCoin&command=insert");
                    $("#manageCoin").submit();
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                });
				$("#removeCommand").click(function()
                {
HTML;

		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
					CTM.AjaxLoad("{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=manageCoin&command=remove", "loadExecCommand", "manageCoin");
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            		$("#manageCoin").attr("action", "{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=manageCoin&command=remove");
                    $("#manageCoin").submit();
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                });

            });
            </script>
HTML;
		
        if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            <div style="width:600px">
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        	<article>
				<h1>{$this->lang->words['Members']['Accounts']['ManageAccount']['ManageCoin']['Title']} :: {$username}</h1>
                <div id="loadExecCommand">
				{$result_command}
                </div>
                <form name="manageCoin" id="manageCoin" method="post" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$_username}&amp;do=manageCoin&amp;command=insert" class="uniform">
					<dl class="inline">
                    	<dt><label for="Coin">{$this->lang->words['Members']['Accounts']['ManageAccount']['ManageCoin']['Coin']}</label></dt>
                        <dd>
                        	<select name="Coin" id="Coin">
                            	<option value="1">{$coin_name_1}</option>
HTML;

		if(COIN_NUMBER >= 2)
        {
        	$coin_name_2 = COIN_NAME_2;
        	$CTM_HTML .= <<<HTML
                                <option value="2">{$coin_name_2}</option>
HTML;
		}
        
        if(COIN_NUMBER == 3)
        {
        	$coin_name_3 = COIN_NAME_3;
        	$CTM_HTML .= <<<HTML
                                <option value="3">{$coin_name_3}</option>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                        	</select>
                        </dd>
						<dt><label for="Quantity">{$this->lang->words['Members']['Accounts']['ManageAccount']['ManageCoin']['Quantity']}</label></dt>
						<dd><input type="text" id="Quantity" name="Quantity" class="small" onkeypress="return CTM.NumbersOnly(event);" /></dd>
					</dl>
					<p>
						<button type="button" class="button" id="insertCommand">{$this->lang->words['Members']['Accounts']['ManageAccount']['ManageCoin']['Button']['Insert']}</button>
                        <button type="button" class="button red" id="removeCommand">{$this->lang->words['Members']['Accounts']['ManageAccount']['ManageCoin']['Button']['Remove']}</button>
					</p>
				</form>
			</article>
HTML;

		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            </div>
HTML;
		}

		return $CTM_HTML;
    }
    /**
	 *	Accounts: Edit/Manage Account
	 *
	 *	@return	string	HTML String
	*/
    public function accounts_editAccount()
    {
    	global $result_command, $account_info;
        
        $username = urldecode($_GET['username']);
        $_username = $_GET['username'];
        
        $status = array
        (
        	0 => $account_info['data']['status'] == 0 ? " selected=\"selected\"" : NULL,
            1 => $account_info['data']['status'] == 1 ? " selected=\"selected\"" : NULL,
        );
        
        $account_level = array
        (
        	0 => $account_info['data']['account_level'] == 0 ? " selected=\"selected\"" : NULL,
            1 => $account_info['data']['account_level'] == 1 ? " selected=\"selected\"" : NULL,
        );
        
        $vip_name = array(1 => VIP_NAME_1);
        $coin_name = array(1 => sprintf($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Balances']['CoinField'], COIN_NAME_1));
        
        $check_birth_day = array();
        $check_birth_month = array();
        
        for($i = 1; $i <= 31; $i++)
        {
        	$check_birth_day[$i - 1] = $account_info['data']['birth'][0] == (strlen($i) == 1 ? "0" : NULL).$i ? "selected=\"selected\"" : NULL;
        }
        
        for($i = 1; $i <= 12; $i++)
        {
        	$check_birth_month[$i - 1] = $account_info['data']['birth'][1] == (strlen($i) == 1 ? "0" : NULL).$i ? "selected=\"selected\"" : NULL;
        }
        
        if($account_info['stat']['status'] == true)
        {
        	$_status = "<span style='color: green;'>Online<span> ";
            $_status .= "<a href=\"{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$_username}&amp;do=editAccount";
            $_status .= "&amp;command=disconnect\">[".$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['AccountInfos']['Disconnect']."]</a>";
        }
        else
        {
        	$_status = "<span style='color: red;'>Offline<span>";
        }
        
        $CTM_HTML = <<<HTML
            <script type="text/javascript">
            $(function()
            {
                $("#loadBanWindow").click(function()
                {
                    /*$.fancybox(
                    {
                        ajax :
                        {
                            type : "GET",
                            data : "ajaxLoadSet=true"
                        },
                        href : "{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=ban"
                    });*/
                    
                    CTM.AjaxShowBox("{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=ban");
                });
                $("#loadUnbanWindow").click(function()
                {
                    /*$.fancybox(
                    {
                        ajax :
                        {
                            type : "GET",
                            data : "ajaxLoadSet=true"
                        },
                        href : "{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=unban"
                    });*/
                    
                    CTM.AjaxShowBox("{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=unban");
                });
                $("#loadManageVIPWindow").click(function()
                {
                    /*$.fancybox(
                    {
                        ajax :
                        {
                            type : "GET",
                            data : "ajaxLoadSet=true"
                        },
                        href : "{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=manageVIP"
                    });*/
                    
                    CTM.AjaxShowBox("{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=manageVIP");
                });
                $("#loadManageCoinWindow").click(function()
                {
                    /*$.fancybox(
                    {
                        ajax :
                        {
                            type : "GET",
                            data : "ajaxLoadSet=true"
                        },
                        href : "{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=manageCoin"
                    });*/
                    
                    CTM.AjaxShowBox("{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=manageCoin");
                });
                $("#loadDeleteCommand").click(function()
                {
                	Sexy.confirm("<storng>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['DeleteAccount']['ConfirmMessage']}", {onComplete: function(e)
                    {
                    	if(e == true)
                        	window.location = "{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username={$_username}&do=editAccount&write=delete";
                    }});
                });
                
                $(".loadWriteCommand").fancybox(
				{
					"scrolling" : "no",
					"titleShow" : false
				});
                
                //$(".loadWriteCommand").facebox();
            });
            
            function change_text_content(location_id, new_text)
            {
            	$("#"+location_id).fadeOut("fast", function()
                {
                	$(this).css("display", "none");
                	$(this).text(new_text);
                });
                
                $("#"+location_id).fadeIn("slow");
            }
            function editAccount_writeSuccess(type, new_value)
            {
            	switch(type)
                {
                	case "name" :
                    	$("#loadWriteCommandChangeName").html('');
                    	change_text_content("accountInfo_name", new_value);
                    break;
                    case "email" :
                    	$("#loadWriteCommandChangeMail").html('');
                    	change_text_content("accountInfo_mail", new_value);
                	break;
                    case "password" :
                    	$("#loadWriteCommandChangePassword").html('');
                        $("#NewPassword").val('');
                        $("#ConfirmNewPassword").val('');
                	break;
                    case "pid" :
                    	$("#loadWriteCommandChangePID").html('');
                        change_text_content("accountInfo_pid", new_value);
                	break;
                }
                
                $.fancybox.close();
            }
            </script>
            <div style="display:none;">
            	<div id="writeCommand_changeName" style="width:400px">
                    <div id="loadWriteCommandChangeName"></div>
                    <form name="formWriteCommand_changeName" id="formWriteCommand_changeName" class="uniform">
                        <label><strong>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangeName']['Label']}</strong></label>
                        <input type="text" name="NewName" id="NewName" value="{$account_info['data']['name']}" maxlength="10" class="small" />
                        
                        <button type="button" class="button" onclick="CTM.AjaxLoad('{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$_username}&amp;do=editAccount&amp;write=name', 'loadWriteCommandChangeName', 'formWriteCommand_changeName');">{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangeName']['Button']}</button>
                    </form>
           		</div>
                
                <div id="writeCommand_changeMail" style="width:400px">
                    <div id="loadWriteCommandChangeMail"></div>
                    <form name="formWriteCommand_changeMail" id="formWriteCommand_changeMail" class="uniform">
                        <label><strong>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangeMail']['Label']}</strong></label>
                        <input type="text" name="NewMail" id="NewMail" value="{$account_info['data']['mail']}" class="small" />
                        
                        <button type="button" class="button" onclick="CTM.AjaxLoad('{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$_username}&amp;do=editAccount&amp;write=email', 'loadWriteCommandChangeMail', 'formWriteCommand_changeMail');">{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangeMail']['Button']}</button>
                    </form>
           		</div>
                
                <div id="writeCommand_changePassword" style="width:400px">
                    <div id="loadWriteCommandChangePassword"></div>
                    <form name="formWriteCommand_changePassword" id="formWriteCommand_changePassword" class="uniform">
                    	<table border="0" class="gtable">
                        	<tr>
                            	<td><strong>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangePassword']['NewPassword']}</strong></td>
                                <td><input type="password" name="NewPassword" id="NewPassword" maxlength="10" class="small" /></td>
                        	</tr>
                            <tr>    
                            	<td><strong>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangePassword']['ConfirmNewPassword']}</strong></td>
                                <td><input type="password" name="ConfirmNewPassword" id="ConfirmNewPassword" maxlength="10" class="small" /></td>
                        	</tr>
                        </table>
                        <button type="button" class="button" onclick="CTM.AjaxLoad('{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$_username}&amp;do=editAccount&amp;write=password', 'loadWriteCommandChangePassword', 'formWriteCommand_changePassword');">{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangePassword']['Button']}</button>
                    </form>
           		</div>
                
                <div id="writeCommand_changePID" style="width:400px">
                    <div id="loadWriteCommandChangePID"></div>
                    <form name="formWriteCommand_changePID" id="formWriteCommand_changePID" class="uniform">
                        <label><strong>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangePID']['Label']}</strong></label>
                        <input type="text" name="NewPID" id="NewPID" value="{$account_info['data']['pid']}" maxlength="7" class="small" onkeypress="return CTM.NumbersOnly(event);" />
                        
                        <button type="button" class="button" onclick="CTM.AjaxLoad('{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$_username}&amp;do=editAccount&amp;write=pid', 'loadWriteCommandChangePID', 'formWriteCommand_changePID');">{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['ChangePID']['Button']}</button>
                    </form>
           		</div>
            </div>
            <article id="dashboard">
				<h1>
                	{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Title']} :: {$username}
                    <div style="float: right">
                    	<button id="loadBanWindow" class="button gray">{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Actions']['Ban']}</button>
                        <button id="loadUnbanWindow" class="button yellow">{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Actions']['Unban']}</button>
                        <button id="loadManageVIPWindow" class="button purple">{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Actions']['ManageVIP']}</button>
                        <button id="loadManageCoinWindow" class="button orange">{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Actions']['ManageCoin']}</button>
HTML;
        $CTM_HTML .= <<<HTML
            
                        <button id="loadDeleteCommand" class="button red">{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Actions']['Delete']}</button>
HTML;
        
        $CTM_HTML .= <<<HTML
        
					</div>
                </h1>
                <div id="loadAccountCommand">
				{$result_command}
                </div>
                <form name="EditAccount" id="EditAccount" method="post" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$_username}&amp;do=edit&amp;write=save" class="uniform">
                    <ul class="tabs">
                        <li><a href="#tab-basicInfos">{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Tabs']['BasicInfos']}</a></li>
                        <li><a href="#tab-otherInfos">{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['Tabs']['OtherInfos']}</a></li>
                    </ul>
                    <div class="tabcontent">
                        <div id="tab-basicInfos">
                            <div style="float: left">
                                <table border="0" class="gtable" style="width: 595px;">
                                    <thead>
                                        <tr>
                                            <th>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Details']['Title']}</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Details']['Name']}</strong></td>
                                            <td><span id="accountInfo_name">{$account_info['data']['name']}</span></td>
                                            <td><a href="#writeCommand_changeName" class="loadWriteCommand"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/edit.png" border="0" /></a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Details']['Mail']}</strong></td>
                                            <td><span id="accountInfo_mail">{$account_info['data']['mail']}</span></td>
                                            <td><a href="#writeCommand_changeMail" class="loadWriteCommand" rel="mail"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/edit.png" border="0" /></a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Details']['Password']}</strong></td>
                                            <td>**********</td>
                                            <td><a href="#writeCommand_changePassword" class="loadWriteCommand" rel="password"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/edit.png" border="0" /></a></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Details']['PID']}</strong></td>
                                            <td><span id="accountInfo_pid">{$account_info['data']['pid']}</span></td>
                                            <td><a href="#writeCommand_changePID" class="loadWriteCommand" rel="pid"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/edit.png" border="0" /></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table border="0" class="gtable">
                                    <thead>
                                        <tr>
                                            <th>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Status']['Title']}</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Status']['Status']['Label']}</strong></td>
                                            <td>
                                                <select name="MemberStatus" id="MemberStatus">
                                                    <option value="0"{$status[0]}>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Status']['Status']['Options'][0]}</option>
                                                    <option value="1"{$status[1]}>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Status']['Status']['Options'][1]}</option>
                                                </select>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Status']['AccountLevel']}</strong></td>
                                            <td>
                                                <select name="AccountLevel" id="AccountLevel">
                                                    <option value="0"{$account_level[0]}>{$this->lang->words['Words']['Free']}</option>
                                                    <option value="1"{$account_level[1]}>{$vip_name[1]}</option>
HTML;
		if(VIP_NUMBER >= 2)
        {
        	$account_level[2] = $account_info['data']['account_level'] == 2 ? " selected=\"selected\"" : NULL;
        	$vip_name[2] = VIP_NAME_2;
            
        	$CTM_HTML .= <<<HTML
                                                	<option value="2"{$account_level[2]}>{$vip_name[2]}</option>
HTML;
		}
        
		if(VIP_NUMBER >= 3)
        {
        	$account_level[3] = $account_info['data']['account_level'] == 3 ? " selected=\"selected\"" : NULL;
        	$vip_name[3] = VIP_NAME_3;
            
        	$CTM_HTML .= <<<HTML
                                                	<option value="3"{$account_level[3]}>{$vip_name[3]}</option>
HTML;
		}
        
		if(VIP_NUMBER >= 4)
        {
        	$account_level[4] = $account_info['data']['account_level'] == 4 ? " selected=\"selected\"" : NULL;
        	$vip_name[4] = VIP_NAME_4;
            
        	$CTM_HTML .= <<<HTML
                                                	<option value="4"{$account_level[4]}>{$vip_name[4]}</option>
HTML;
		}
        
        if(VIP_NUMBER == 5)
        {
        	$account_level[5] = $account_info['data']['account_level'] == 5 ? " selected=\"selected\"" : NULL;
        	$vip_name[5] = VIP_NAME_5;
            
        	$CTM_HTML .= <<<HTML
                                                	<option value="5"{$account_level[5]}>{$vip_name[5]}</option>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                                                </select>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table border="0" class="gtable">
                                    <thead>
                                        <tr>
                                            <th>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Balances']['Title']}</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>{$coin_name[1]}</strong></td>
                                            <td><input type="text" name="CoinBalance_1" id="CoinBalance_1" value="{$account_info['data']['coin_1']}"  size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        </tr>
HTML;
		if(COIN_NUMBER >= 2)
        {
        	$coin_name[2] = sprintf($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Balances']['CoinField'], COIN_NAME_2);
        	$CTM_HTML .= <<<HTML
                                        <tr>
                                            <td><strong>{$coin_name[2]}</strong></td>
                                            <td><input type="text" name="CoinBalance_2" id="CoinBalance_2" value="{$account_info['data']['coin_2']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        </tr>
HTML;
		}
        
        if(COIN_NUMBER == 3)
        {
        	$coin_name[3] = sprintf($this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['BasicInfos']['Balances']['CoinField'], COIN_NAME_3);
        	$CTM_HTML .= <<<HTML
                                        <tr>
                                            <td><strong>{$coin_name[3]}</strong></td>
                                            <td><input type="text" name="CoinBalance_3" id="CoinBalance_3" value="{$account_info['data']['coin_3']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        </tr>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                                    </tbody>
                                </table>
                            </div>
                            <div class="statistics" style="width: 300px; float: right">
                                <table>
                                    <tr>
                                        <td>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['AccountInfos']['Sex']}</td>
                                        <td><strong>{$account_info['info']['sex']}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['AccountInfos']['RegisterDate']}</td>
                                        <td><strong>{$account_info['info']['register_date']}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['AccountInfos']['LastConnection']}</td>
                                        <td><strong>{$account_info['stat']['date']}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['AccountInfos']['ConnectionServer']}</td>
                                        <td><strong>{$account_info['stat']['server']}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['AccountInfos']['ConnectionIP']}</td>
                                        <td><strong>{$account_info['stat']['ip']}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['AccountInfos']['Status']}</td>
                                        <td><strong id="userStatus">{$_status}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div id="tab-otherInfos">
                        	<table border="0" class="gtable">
                            	<thead>
                                	<tr>
                                        <th>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['OtherInfos']['SecureQuestion']['Title']}</th>
                                        <th></th>
                        			</tr>
                                </thead>
                                <tbody>
                                	<tr>
                                        <td>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['OtherInfos']['SecureQuestion']['Question']}</td>
                                        <td><input type="text" name="SecureQuestion" id="SecureQuestion" value="{$account_info['data']['secure_question']}" class="medium" /></td>
                                	</tr>
                                    <tr>
                                        <td>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['OtherInfos']['SecureQuestion']['Answer']}</td>
                                        <td><input type="text" name="SecureAnswer" id="SecureAnswer" value="{$account_info['data']['secure_answer']}" class="medium" /></td>
                                	</tr>
                                </tbody>
                        	</table>
                            <table border="0" class="gtable">
                            	<thead>
                                	<tr>
                                        <th>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['OtherInfos']['Informations']['Title']}</th>
                                        <th></th>
                        			</tr>
                                </thead>
                                <tbody>
                                	<tr>
                                        <td>{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['OtherInfos']['Informations']['Birthday']}</td>
                                        <td>
                                        	<select name="BirthDay" id="BirthDay">
                                            	<option value="01"{$check_birth_day[0]}>01</option>
                                                <option value="02"{$check_birth_day[1]}>02</option>
                                                <option value="03"{$check_birth_day[2]}>03</option>
                                                <option value="04"{$check_birth_day[3]}>04</option>
                                                <option value="05"{$check_birth_day[4]}>05</option>
                                                <option value="06"{$check_birth_day[5]}>06</option>
                                                <option value="07"{$check_birth_day[6]}>07</option>
                                                <option value="08"{$check_birth_day[7]}>08</option>
                                                <option value="09"{$check_birth_day[8]}>09</option>
                                                <option value="10"{$check_birth_day[9]}>10</option>
                                                <option value="11"{$check_birth_day[10]}>11</option>
                                                <option value="12"{$check_birth_day[11]}>12</option>
                                                <option value="13"{$check_birth_day[12]}>13</option>
                                                <option value="14"{$check_birth_day[13]}>14</option>
                                                <option value="15"{$check_birth_day[14]}>15</option>
                                                <option value="16"{$check_birth_day[15]}>16</option>
                                                <option value="17"{$check_birth_day[16]}>17</option>
                                                <option value="18"{$check_birth_day[17]}>18</option>
                                                <option value="19"{$check_birth_day[18]}>19</option>
                                                <option value="20"{$check_birth_day[19]}>20</option>
                                                <option value="21"{$check_birth_day[20]}>21</option>
                                                <option value="22"{$check_birth_day[21]}>22</option>
                                                <option value="23"{$check_birth_day[22]}>23</option>
                                                <option value="24"{$check_birth_day[23]}>24</option>
                                                <option value="25"{$check_birth_day[24]}>25</option>
                                                <option value="26"{$check_birth_day[25]}>26</option>
                                                <option value="27"{$check_birth_day[26]}>27</option>
                                                <option value="28"{$check_birth_day[27]}>28</option>
                                                <option value="29"{$check_birth_day[28]}>29</option>
                                                <option value="30"{$check_birth_day[29]}>30</option>
                                                <option value="31"{$check_birth_day[30]}>31</option>
                                            </select>
                                            <select name="BirthMonth" id="BirthMonth">
                                            	<option value="01"{$check_birth_month[0]}>{$this->lang->words['Words']['Months']['January']}</option>
                                                <option value="02"{$check_birth_month[1]}>{$this->lang->words['Words']['Months']['February']}</option>
                                                <option value="03"{$check_birth_month[2]}>{$this->lang->words['Words']['Months']['March']}</option>
                                                <option value="04"{$check_birth_month[3]}>{$this->lang->words['Words']['Months']['April']}</option>
                                                <option value="05"{$check_birth_month[4]}>{$this->lang->words['Words']['Months']['May']}</option>
                                                <option value="06"{$check_birth_month[5]}>{$this->lang->words['Words']['Months']['June']}</option>
                                                <option value="07"{$check_birth_month[6]}>{$this->lang->words['Words']['Months']['July']}</option>
                                                <option value="08"{$check_birth_month[7]}>{$this->lang->words['Words']['Months']['August']}</option>
                                                <option value="09"{$check_birth_month[8]}>{$this->lang->words['Words']['Months']['September']}</option>
                                                <option value="10"{$check_birth_month[9]}>{$this->lang->words['Words']['Months']['October']}</option>
                                                <option value="11"{$check_birth_month[10]}>{$this->lang->words['Words']['Months']['November']}</option>
                                                <option value="12"{$check_birth_month[11]}>{$this->lang->words['Words']['Months']['December']}</option>
                                        	</select>
                                            <input type="text" name="BirthYear" id="BirthYear" value="{$account_info['data']['birth'][2]}" size="4" />
                                        </td>
                                	</tr>
                                </tbody>
                        	</table>
                        </div>
                    </div>
                    <button id="loadSaveMember" class="button black">{$this->lang->words['Members']['Accounts']['ManageAccount']['EditAccount']['SaveButton']}</button>
            	</form>
            </article>
HTML;
        return $CTM_HTML;
    }
    /**
	 *	Accounts: Validating Accounts
	 *
	 *	@return	string	HTML String
	*/
    public function accounts_validatingAccounts()
    {
    	global $result_command, $validating_accounts;
        
        $CTM_HTML = NULL;
        
        if(count($validating_accounts) > 0)
        {
        	$CTM_HTML .= <<<HTML
		<script type="text/javascript">
			$(function()
			{
				$("#submitCommand").click(function()
				{
					count = 0; selected = 0;
HTML;
			foreach($validating_accounts as $username => $value)
            {
            	$CTM_HTML .= <<<HTML
                
					if($("#account__{$username}:checked").val() != 1) count++;
					else selected++;
HTML;
			}
            
            $count_accounts = count($validating_accounts);
            $CTM_HTML .= <<<HTML
					
					if({$count_accounts} == count)
					{
						Sexy.alert("{$this->lang->words['Members']['Accounts']['ValidatingAccounts']['Messages']['SelectAccount']}");
					}
					else
					{
                    	if($("#Action").val() == "delete")
                        {
                            message = "{$this->lang->words['Members']['Accounts']['ValidatingAccounts']['Messages']['ConfirmDelete']}";
                            message = message.replace("%d", selected);
                            
                            Sexy.confirm(message, {onComplete: function(returnValue)
                            {
                                if(returnValue)
                                {
                                    $("#executeCommand").submit();
                                }
                            }});
						}
                        else
                        {
                        	$("#executeCommand").submit();
                    	}
                    }
				});
			});
			</script>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
			<article>
				<h1>{$this->lang->words['Members']['Accounts']['ValidatingAccounts']['Title']}</h1>
                {$result_command}
HTML;

		if(count($validating_accounts) > 0)
        {
        	$CTM_HTML .= <<<HTML
                <form name="executeCommand" id="executeCommand" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=validatingAccounts&amp;write=true" method="post">
					<table id="table1" class="gtable sortable">
						<thead>
							<tr>
								<th><input type="checkbox" class="checkall" /></th>
								<th>{$this->lang->words['Members']['Accounts']['ValidatingAccounts']['Table']['Account']}</th>
								<th>{$this->lang->words['Members']['Accounts']['ValidatingAccounts']['Table']['Name']}</th>
								<th>{$this->lang->words['Members']['Accounts']['ValidatingAccounts']['Table']['Mail']}</th>
                                <th>{$this->lang->words['Members']['Accounts']['ValidatingAccounts']['Table']['Code']}</th>
							</tr>
						</thead>
						<tbody>
HTML;
			foreach($validating_accounts as $username => $value)
            {
            	$CTM_HTML .= <<<HTML
							<tr>
								<td><input type="checkbox" name="account__{$username}" id="account__{$username}" value="1" /></td>
								<td><a href="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$username}&amp;do=editAccount">{$username}</a></td>
								<td>{$value['name']}</td>
								<td>{$value['mail']}</td>
                                <td>{$value['code']}</td>
							</tr>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
						</tbody>
					</table>
					<div class="tablefooter clearfix">
						<div class="actions">
							<select name="Action" id="Action">
								<option value="approve">{$this->lang->words['Members']['Accounts']['ValidatingAccounts']['Actions']['Approve']}</option>
                                <option value="resend_email">{$this->lang->words['Members']['Accounts']['ValidatingAccounts']['Actions']['ResendEmail']}</option>
                                <option value="delete">{$this->lang->words['Members']['Accounts']['ValidatingAccounts']['Actions']['Delete']}</option>
							</select>
							<button type="button" name="submitCommand" id="submitCommand" class="button small">{$this->lang->words['Members']['Accounts']['ValidatingAccounts']['Actions']['Button']}</button>
						</div>
					</div>
				</form>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            	<div class="information msg">{$this->lang->words['Members']['Accounts']['ValidatingAccounts']['Messages']['NoAccounts']}</div>
HTML;
        }
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;
		return $CTM_HTML;
    }
    /**
	 *	Accounts: Banned Accounts
	 *
	 *	@return	string	HTML String
	*/
    public function accounts_bannedAccounts()
    {
    	global $result_command, $banned_accounts;
        
        $CTM_HTML = NULL;
        
        if(count($banned_accounts) > 0)
        {
        	$CTM_HTML .= <<<HTML
		<script type="text/javascript">
			$(function()
			{
				$("#unBanNow").click(function()
				{
					count = 0; selected = 0;
HTML;
			foreach($banned_accounts as $username => $value)
            {
            	$CTM_HTML .= <<<HTML
                
					if($("#account__{$username}:checked").val() != 1) count++;
					else selected++;
HTML;
			}
            
            $count_accounts = count($banned_accounts);
            $CTM_HTML .= <<<HTML
					
					if({$count_accounts} == count)
					{
						Sexy.alert("{$this->lang->words['Members']['Accounts']['BannedAccounts']['Messages']['SelectAccount']}");
					}
					else
					{
						message = "{$this->lang->words['Members']['Accounts']['BannedAccounts']['Messages']['Confirm']}";
						message = message.replace("%d", selected);
						
						Sexy.confirm(message, {onComplete: function(returnValue)
						{
							if(returnValue)
                            {
                            	$("#unbanAccounts").submit();
                            }
						}});
					}
				});
			});
			</script>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
			<article>
				<h1>{$this->lang->words['Members']['Accounts']['BannedAccounts']['Title']}</h1>
                {$result_command}
HTML;

		if(count($banned_accounts) > 0)
        {
        	$CTM_HTML .= <<<HTML
                <form name="unbanAccounts" id="unbanAccounts" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=bannedAccounts&amp;do=unban" method="post">
					<table id="table1" class="gtable sortable">
						<thead>
							<tr>
								<th><input type="checkbox" class="checkall" /></th>
								<th>{$this->lang->words['Members']['Accounts']['BannedAccounts']['Table']['Account']}</th>
								<th>{$this->lang->words['Members']['Accounts']['BannedAccounts']['Table']['Expiration']}</th>
								<th>{$this->lang->words['Members']['Accounts']['BannedAccounts']['Table']['Responsible']}</th>
                                <th>{$this->lang->words['Members']['Accounts']['BannedAccounts']['Table']['Reason']}</th>
							</tr>
						</thead>
						<tbody>
HTML;
			foreach($banned_accounts as $username => $value)
            {
            	$CTM_HTML .= <<<HTML
							<tr>
								<td><input type="checkbox" name="account__{$username}" id="account__{$username}" value="1" /></td>
								<td><a href="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$username}&amp;do=unbanAccount&amp;go=banneds">{$username}</a></td>
								<td>{$value['expiration']}</td>
								<td>{$value['responsible']}</td>
                                <td>{$value['reason']}</td>
							</tr>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
						</tbody>
					</table>
					<div class="tablefooter clearfix">
						<div class="actions">
							<button type="button" id="unBanNow" class="button small">{$this->lang->words['Members']['Accounts']['BannedAccounts']['Button']}</button>
						</div>
					</div>
				</form>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            	<div class="information msg">{$this->lang->words['Members']['Accounts']['BannedAccounts']['Messages']['NoAccounts']}</div>
HTML;
        }
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;
		return $CTM_HTML;
    }
    /**
	 *	Characters: Search/Home
	 *
	 *	@return	string	HTML String
	*/
	public function characters_search()
	{
		global $result_command, $characters_located;
		
		$CTM_HTML = <<<HTML
		<script type="text/javascript">
			$(function()
			{
            	$("a[rel*=manageAccountLink]").click(function()
				{
					account = $(this).attr("set");
					window.location = "{$this->vars['acp_url']}?app=core&module=members&section=accounts&index=manageAccount&username="+account;
				});
				$("a[rel*=manageCharacterLink]").click(function()
				{
					character = $(this).attr("set");
					window.location = "{$this->vars['acp_url']}?app=core&module=members&section=characters&index=manageCharacter&charname="+character;
				});
				$("#manageCharacter").click(function()
				{
					if(!$("#charname:checked").val())
					{
						Sexy.alert("{$this->lang->words['Members']['Characters']['Search']['Messages']['SelectCharacter']}");
					}
					else
					{
						character = $("#charname:checked").val();
						action = $("#action").val();
						
						window.location = "{$this->vars['acp_url']}?app=core&module=members&section=characters&index=manageCharacter&charname="+character+"&do="+action;
					}
				});
			});
			</script>
			<article>
				<h1>{$this->lang->words['Members']['Characters']['Search']['Title']}</h1>
                {$result_command}
                
                <form name="searchCharacters" id="searchCharacters" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=characters&amp;index=searchCharacters&amp;write=true" method="post" class="uniform">
                	<fieldset>
                    	<legend>{$this->lang->words['Members']['Characters']['Search']['Search']}</legend>
                        <dl class="inline">
                            <dt><label for="Reference">{$this->lang->words['Members']['Characters']['Search']['ReferenceField']}</label></dt>
                            <dd><input type="text" id="Reference" name="Reference" class="medium" /></dd>
    
                            <dt><label for="SearchCase">{$this->lang->words['Members']['Characters']['Search']['CaseField']['Field']}</label></dt>
                            <dd>
                                <select id="SearchCase" name="SearchCase" class="medium">
                                	<option value="name">{$this->lang->words['Members']['Characters']['Search']['CaseField']['Name']}</option>
                                    <option value="login">{$this->lang->words['Members']['Characters']['Search']['CaseField']['Login']}</option>
                                    <option value="guild">{$this->lang->words['Members']['Characters']['Search']['CaseField']['Guild']}</option>
                                </select>
                            </dd>
                            
                            <dt><label for="SearchType">{$this->lang->words['Members']['Characters']['Search']['TypeField']['Field']}</label></dt>
                            <dd>
                                <select id="SearchType" name="SearchType" class="medium">
                                    <option value="exact">{$this->lang->words['Members']['Characters']['Search']['TypeField']['Exact']}</option>
                                    <option value="startingWith">{$this->lang->words['Members']['Characters']['Search']['TypeField']['StartingWith']}</option>
                                    <option value="endingWith">{$this->lang->words['Members']['Characters']['Search']['TypeField']['EndingWith']}</option>
                                    <option value="containing">{$this->lang->words['Members']['Characters']['Search']['TypeField']['Containig']}</option>
                                </select>
                            </dd>
                        </dl>
                        <p>
                            <button type="submit" class="button">{$this->lang->words['Members']['Characters']['Search']['Button']}</button>
                        </p>
					</fieldset>
                </form>
HTML;
		if($_GET['write'] == true)
        {
        	if(count($characters_located) > 0)
            {
        		$CTM_HTML .= <<<HTML
                <br />
				<article>
                	<form name="loadCommand" id="loadCommand">
						<table id="table1" class="gtable sortable">
							<thead>
								<tr>
									<th>#</th>
									<th>{$this->lang->words['Members']['Characters']['Search']['ResultTable']['Login']}</th>
									<th>{$this->lang->words['Members']['Characters']['Search']['ResultTable']['Name']}</th>
									<th>{$this->lang->words['Members']['Characters']['Search']['ResultTable']['Class']}</th>
                                	<th>{$this->lang->words['Members']['Characters']['Search']['ResultTable']['Level']}</th>
								</tr>
							</thead>
							<tbody>
HTML;
				foreach($characters_located as $charname => $data)
            	{
                	$CTM_HTML .= <<<HTML
								<tr>
									<td><input type="radio" name="charname" id="charname" value="{$charname}" /></td>
									<td><a href="javascript: void(0);" rel="manageAccountLink" set="{$data['login']}">{$data['login']}</a></td>
									<td><a href="javascript: void(0);" rel="manageCharacterLink" set="{$charname}">{$charname}</a></td>
									<td>{$data['class']}</td>
                                	<td>{$data['level']}</td>
								</tr>
HTML;
				}
                
                $CTM_HTML .= <<<HTML
							</tbody>
						</table>
						<div class="tablefooter clearfix">
							<div class="actions">
                        		<select name="action" id="action">
									<option value="ban">{$this->lang->words['Members']['Characters']['Search']['Actions']['Ban']}</option>
									<option value="unban">{$this->lang->words['Members']['Characters']['Search']['Actions']['Unban']}</option>
								</select>
								<button type="button" name="manageCharacter" id="manageCharacter" class="button small">{$this->lang->words['Members']['Characters']['Search']['Actions']['Button']}</button>
							</div>
						</div>
					</form>
				</article>
HTML;
			}
		}
            
		$CTM_HTML .= <<<HTML
			</article>
HTML;
		
		return $CTM_HTML;
	}
    /**
	 *	Characters: Ban Character
	 *
	 *	@return	string	HTML String
	*/
    public function characters_banCharacter()
    {
    	global $result_command;
        
        $charname = urldecode($_GET['charname']);
        $_charname = $_GET['charname'];
        
        $CTM_HTML = <<<HTML
		<script type="text/javascript">
            $(function()
            {
                $("#banCharacterNow").click(function()
                {
HTML;
		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            		CTM.AjaxLoad("{$this->vars['acp_url']}?app=core&module=members&section=characters&index=manageCharacter&charname={$_charname}&do=ban&write=true", "loadBanCommand", "banCharacter");
HTML;
		}
		else
        {
        	$CTM_HTML .= <<<HTML
                 	$("#banCharacter").submit();   
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                });
				$("#banExpiration").datepicker(
				{
        			changeMonth: true,
        			changeYear: true
    			});
            });
            </script>
HTML;
		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            <div style="width:600px">
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        	<article>
				<h1>{$this->lang->words['Members']['Characters']['ManageCharacter']['BanCharacter']['Title']} :: {$charname}</h1>
                <div id="loadBanCommand">
				{$result_command}
                </div>
                <form name="banCharacter" id="banCharacter" method="post" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=characters&amp;index=manageCharacter&amp;charname={$_charname}&amp;do=ban&amp;write=true" class="uniform">
					<dl class="inline">
						<dt><label for="banReason">{$this->lang->words['Members']['Characters']['ManageCharacter']['BanCharacter']['ReasonField']}</label></dt>
						<dd><input type="text" id="banReason" name="banReason" class="medium" /></dd>

						<dt><label for="banExpiration">{$this->lang->words['Members']['Characters']['ManageCharacter']['BanCharacter']['ExpirationField']}</label></dt>
						<dd><input type="text" id="banExpiration" name="banExpiration" readonly="readonly" maxlength="10" class="small" /></dd>
					</dl>
					<p>
						<button type="button" class="button" id="banCharacterNow">{$this->lang->words['Members']['Characters']['ManageCharacter']['BanCharacter']['Button']}</button>
					</p>
				</form>
			</article>
HTML;

		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            </div>
HTML;
		}
        
        return $CTM_HTML;
    }
    /**
	 *	Characters: Unban Character
	 *
	 *	@return	string	HTML String
	*/
    public function characters_unbanCharacter()
    {
    	global $result_command, $block_info;
        
        $charname = urldecode($_GET['charname']);
        $_charname = $_GET['charname'];
        
        if(!empty($_GET['go']))
        {
        	$go = "&amp;go=".$_GET['go'];
        }
        
        $CTM_HTML = <<<HTML
			<script type="text/javascript">
			$(function()
			{
				$("#unBanNow").click(function()
				{
					Sexy.confirm("{$this->lang->words['Members']['Characters']['ManageCharacter']['UnbanCharacter']['Messages']['Confirm']}", { "onComplete" : function(commandResult)
					{
						if(commandResult)
						{
HTML;
		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
							$.fancybox(
							{
								ajax :
								{
									type : "POST",
									data : $("#unBanCharacter").serializeArray()
								},
								href : "{$this->vars['acp_url']}?app=core&module=members&section=characters&index=manageCharacter&charname={$_charname}&do=unban&write=true&ajaxLoadSet=true"
							});
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
							$("#unBanCharacter").submit();
HTML;
		}
        
        $CTM_HTML .= <<<HTML
						}
					}});
				});
			});
			</script>
HTML;
		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            <div style="width:600px">
HTML;
		}
        
        $CTM_HTML .= <<<HTML
			<article>
				<h1>{$this->lang->words['Members']['Characters']['ManageCharacter']['UnbanCharacter']['Title']} :: {$charname}</h1>
HTML;

		if(count($block_info) > 0)
        {
        	$CTM_HTML .= <<<HTML
                <form name="unBanCharacter" id="unBanCharacter" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=characters&amp;index=manageCharacter&amp;charname={$_charname}&amp;do=unban&amp;write=true{$go}" method="post" class="uniform">
                    <table id="table1" class="gtable">
						<tbody>
							<tr>
								<td>{$this->lang->words['Members']['Characters']['ManageCharacter']['UnbanCharacter']['Reason']}</td>
								<td>{$block_info['reason']}</td>
							</tr>
                            <tr>
								<td>{$this->lang->words['Members']['Characters']['ManageCharacter']['UnbanCharacter']['Expiration']}</td>
								<td>{$block_info['expiration']}</td>
							</tr>
                            <tr>
								<td>{$this->lang->words['Members']['Characters']['ManageCharacter']['UnbanCharacter']['Responsible']}</td>
								<td>{$block_info['responsible']}</td>
							</tr>
						</tbody>
					</table>
					<p>
						<button type="button" name="unBanNow" id="unBanNow" class="button">{$this->lang->words['Members']['Characters']['ManageCharacter']['UnbanCharacter']['Button']}</button>
					</p>
				</form>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
                <div class="error msg">{$this->lang->words['Members']['Characters']['ManageCharacter']['UnbanCharacter']['Messages']['NoBanned']}</div>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;

		if(loadIsAjax() == true)
        {
        	$CTM_HTML .= <<<HTML
            </div>
HTML;
		}
        
        return $CTM_HTML;
    }
    /**
	 *	Characters: Edit/Manage Character
	 *
	 *	@return	string	HTML String
	*/
    public function characters_editCharacter()
    {
    	global $result_command, $class_info, $character_info;
        
        $charname = urldecode($_GET['charname']);
        $_charname = $_GET['charname'];
        
        $ctlcode = array
        (
        	0 => $character_info['data']['ctlcode'] == 0 ? " selected=\"selected\"" : NULL,
            1 => $character_info['data']['ctlcode'] == 1 ? " selected=\"selected\"" : NULL,
            2 => $character_info['data']['ctlcode'] == CTLCODE_GAMEMASTER ? " selected=\"selected\"" : NULL,
        );
        
        $ctlcode_gm  = CTLCODE_GAMEMASTER;
        
        $max_strength = MAX_STRENGTH;
        $max_dexterity = MAX_DEXTERITY;
        $max_vitality = MAX_VITALITY;
        $max_energy = MAX_ENERGY;
        $max_command = MAX_COMMAND;
        
        for($i = 0; $i < 8; $i++)
        {
        	$pklevel[$i] = $character_info['data']['pk_level'] == $i ? " selected=\"selected\"" : NULL;
        }
        
        $CTM_HTML = <<<HTML
            <script type="text/javascript">
            $(function()
            {
                $("#loadBanWindow").click(function()
                {
                    /*$.fancybox(
                    {
                        ajax :
                        {
                            type : "GET",
                            data : "ajaxLoadSet=true"
                        },
                        href : "{$this->vars['acp_url']}?app=core&module=members&section=characters&index=manageCharacter&charname={$_charname}&do=ban"
                    });*/
                    
                    CTM.AjaxShowBox("{$this->vars['acp_url']}?app=core&module=members&section=characters&index=manageCharacter&charname={$_charname}&do=ban");
                });
                $("#loadUnbanWindow").click(function()
                {
                    /*$.fancybox(
                    {
                        ajax :
                        {
                            type : "GET",
                            data : "ajaxLoadSet=true"
                        },
                        href : "{$this->vars['acp_url']}?app=core&module=members&section=characters&index=manageCharacter&charname={$_charname}&do=unban"
                    });*/
                    
                    CTM.AjaxShowBox("{$this->vars['acp_url']}?app=core&module=members&section=characters&index=manageCharacter&charname={$_charname}&do=unban");
                });
                $("#loadDeleteCommand").click(function()
                {
                	Sexy.confirm("<storng>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['DeleteCharacter']['ConfirmMessage']}", {onComplete: function(e)
                    {
                    	if(e == true)
                        	window.location = "{$this->vars['acp_url']}?app=core&module=members&section=characters&index=manageCharacter&charname={$_charname}&do=editCharacter&write=delete";
                    }});
                });
                
                $(".loadWriteCommand").fancybox(
				{
					"scrolling" : "no",
					"titleShow" : false
				});
                
                //$(".loadWriteCommand").facebox();
            });
            
            function change_text_content(location_id, new_text)
            {
            	$("#"+location_id).fadeOut("fast", function()
                {
                	$(this).css("display", "none");
                	$(this).text(new_text);
                });
                
                $("#"+location_id).fadeIn("slow");
            }
            function editCharacter_writeSuccess(type, new_value)
            {
            	switch(type)
                {
                	case "name" :
                    	$("#loadWriteCommandChangeName").html('');
                    	change_text_content("characterInfo_name", new_value);
                    break;
                    case "account" :
                    	$("#loadWriteCommandChangeAccount").html('');
                    	change_text_content("characterInfo_account", new_value);
                	break;
                }
                
                $.fancybox.close();
            }
            function setMoney()
            {
                if($("#C_Money").val() >= 2000000000) return $("#C_Money").val(2000000000);
                return false;
            }
            function setStats()
            {
                if($("#C_Strength").val() >= {$max_strength}) $("#C_Strength").val({$max_strength});
                if($("#C_Dexterity").val() >= {$max_dexterity}) $("#C_Dexterity").val({$max_dexterity});
                if($("#C_Vitality").val() >= {$max_vitality}) $("#C_Vitality").val({$max_vitality});
                if($("#C_Energy").val() >= {$max_energy}) $("#C_Energy").val({$max_energy});
                if($("#C_Command").val() >= {$max_command}) $("#C_Command").val({$max_command});
                
                return false;
            }
            </script>
            <div style="display:none;">
            	<div id="writeCommand_changeName" style="width:400px">
                    <div id="loadWriteCommandChangeName"></div>
                    <form name="formWriteCommand_changeName" id="formWriteCommand_changeName" class="uniform">
                        <label><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeName']['Label']}</strong></label>
                        <input type="text" name="NewName" id="NewName" value="{$character_info['data']['name']}" maxlength="10" class="small" />
                        
                        <button type="button" class="button" onclick="CTM.AjaxLoad('{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=characters&amp;index=manageCharacter&amp;charname={$_charname}&amp;do=editCharacter&amp;write=name', 'loadWriteCommandChangeName', 'formWriteCommand_changeName');">{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeName']['Button']}</button>
                    </form>
           		</div>
                
                <div id="writeCommand_changeAccount" style="width:400px">
                    <div id="loadWriteCommandChangeAccount"></div>
                    <form name="formWriteCommand_changeAccount" id="formWriteCommand_changeAccount" class="uniform">
                        <label><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeAccount']['Label']}</strong></label>
                        <input type="text" name="NewAccount" id="NewAccount" value="{$character_info['data']['account']}" maxlength="10" class="small" />
                        
                        <button type="button" class="button" onclick="CTM.AjaxLoad('{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=characters&amp;index=manageCharacter&amp;charname={$_charname}&amp;do=editCharacter&amp;write=account', 'loadWriteCommandChangeAccount', 'formWriteCommand_changeAccount');">{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ChangeAccount']['Button']}</button>
                    </form>
           		</div>
            </div>
            <article id="dashboard">
				<h1>
                	{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Title']} :: {$charname}
                    <div style="float: right">
                    	<button id="loadBanWindow" class="button gray">{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Actions']['Ban']}</button>
                        <button id="loadUnbanWindow" class="button yellow">{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Actions']['Unban']}</button>
                        <button id="loadDeleteCommand" class="button red">{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Actions']['Delete']}</button>
					</div>
                </h1>
                <div id="loadAccountCommand">
				{$result_command}
                </div>
                <form name="EditCharacter" id="EditCharacter" method="post" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=characters&amp;index=manageCharacter&amp;charname={$_charname}&amp;do=edit&amp;write=save" class="uniform">
                    <ul class="tabs">
                        <li><a href="#tab-basicInfos">{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Tabs']['BasicInfos']}</a></li>
                        <li><a href="#tab-resetInfos">{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Tabs']['ResetInfos']}</a></li>
                        <li><a href="#tab-otherInfos">{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['Tabs']['OtherInfos']}</a></li>
                    </ul>
                    <div class="tabcontent">
                        <div id="tab-basicInfos">
                            <div style="float: left">
                                <table border="0" class="gtable" style="width: 595px;">
                                    <thead>
                                        <tr>
                                            <th>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Details']['Title']}</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Details']['Name']}</strong></td>
                                            <td><span id="characterInfo_name">{$character_info['data']['name']}</span></td>
                                            <td><a href="#writeCommand_changeName" class="loadWriteCommand"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/edit.png" border="0" /></a></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Details']['Account']}</strong></td>
                                            <td><span id="characterInfo_account">{$character_info['data']['account']}</span></td>
                                            <td><a href="#writeCommand_changeAccount" class="loadWriteCommand"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/edit.png" border="0" /></a></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table border="0" class="gtable" style="width: 595px;">
                                    <thead>
                                        <tr>
                                            <th>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Status']['Title']}</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Status']['Class']}</strong></td>
                                            <td>
                                                <select name="C_Class" id="C_Class">
                                                	<optgroup label="{$this->lang->words['Global']['ClassSelect'][0]}">
HTML;
			foreach($class_info[0] as $key => $class_name)
            {
            	$check = $this->settings['CLASSCODE'][$key][0] == $character_info['data']['class'] ? " selected=\"selected\"" : NULL;
            	$CTM_HTML .= <<<HTML
                
														<option value="1-{$key}"{$check}>{$class_name}</option>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
                                                	</optgroup>
                                                	<optgroup label="{$this->lang->words['Global']['ClassSelect'][1]}">
HTML;
			foreach($class_info[1] as $key => $class_name)
            {
            	$check = $this->settings['CLASSCODE'][$key][0] == $character_info['data']['class'] ? " selected=\"selected\"" : NULL;
            	$CTM_HTML .= <<<HTML
                
														<option value="2-{$key}"{$check}>{$class_name}</option>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
                                                	</optgroup>
HTML;

			if(MUSERVER_VERSION >= 4)
            {
            	$CTM_HTML .= <<<HTML
                                                	<optgroup label="{$this->lang->words['Global']['ClassSelect'][2]}">
HTML;
                foreach($class_info[2] as $key => $class_name)
                {
                    $check = $this->settings['CLASSCODE'][$key][0] == $character_info['data']['class'] ? " selected=\"selected\"" : NULL;
                    $CTM_HTML .= <<<HTML
                
														<option value="3-{$key}"{$check}>{$class_name}</option>
HTML;
				}
            
            	$CTM_HTML .= <<<HTML
                                                	</optgroup>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
                                                </select>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Status']['CtlCode']['Label']}</strong></td>
                                            <td>
                                                <select name="C_CtlCode" id="C_CtlCode">
                                                    <option value="0"{$ctlcode[0]}>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Status']['CtlCode']['Options'][0]}</option>
                                                    <option value="1"{$ctlcode[1]}>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Status']['CtlCode']['Options'][1]}</option>
                                                    <option value="{$ctlcode_gm}"{$ctlcode[2]}>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Status']['CtlCode']['Options'][2]}</option>
                                                </select>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table border="0" class="gtable" style="width: 595px;">
                                    <thead>
                                        <tr>
                                            <th>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['General']['Title']}</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['General']['Level']}</strong></td>
                                            <td><input type="text" name="C_Level" id="C_Level" value="{$character_info['data']['level']}"  size="16" maxlength="3" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['General']['LevelUpPoint']}</strong></td>
                                            <td><input type="text" name="C_LevelUpPoint" id="C_LevelUpPoint" value="{$character_info['data']['points']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['General']['Experience']}</strong></td>
                                            <td><input type="text" name="C_Experience" id="C_Experience" value="{$character_info['data']['experience']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['General']['Money']}</strong></td>
                                            <td><input type="text" name="C_Money" id="C_Money" value="{$character_info['data']['money']}" size="16" onkeyup="setMoney();" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table border="0" class="gtable" style="width: 595px;">
                                    <thead>
                                        <tr>
                                            <th>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Stats']['Title']}</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Stats']['Strength']}</strong></td>
                                            <td><input type="text" name="C_Strength" id="C_Strength" value="{$character_info['data']['strength']}" size="16" maxlength="5" onkeyup="setStats();" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Stats']['Dexterity']}</strong></td>
                                            <td><input type="text" name="C_Dexterity" id="C_Dexterity" value="{$character_info['data']['dexterity']}" size="16" maxlength="5" onkeyup="setStats();" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Stats']['Vitality']}</strong></td>
                                            <td><input type="text" name="C_Vitality" id="C_Vitality" value="{$character_info['data']['vitality']}" size="16" maxlength="5" onkeyup="setStats();" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Stats']['Energy']}</strong></td>
                                            <td><input type="text" name="C_Energy" id="C_Energy" value="{$character_info['data']['energy']}" size="16" maxlength="5" onkeyup="setStats();" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
HTML;
			if(MUSERVER_VERSION >= 1)
            {
            	$CTM_HTML .= <<<HTML
                                        <tr>
                                            <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['BasicInfos']['Stats']['Command']}</strong></td>
                                            <td><input type="text" name="C_Command" id="C_Command" value="{$character_info['data']['command']}" size="16" maxlength="5" onkeyup="setStats();" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
                                    </tbody>
                                </table>
                            </div>
                            <div class="statistics" style="width: 300px; float: right">
                            	<div align="center">
                                	<img src="{$character_info['info']['photo']}" width="120" height="120" style="border: 1px solid #B3B3B3;" class="image" />
                                </div>
                                <table>
                                    <tr>
                                        <td>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['CharacterInfos']['LastConnection']}</td>
                                        <td><strong>{$character_info['stat']['date']}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['CharacterInfos']['ConnectionServer']}</td>
                                        <td><strong>{$character_info['stat']['server']}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['CharacterInfos']['ConnectionIP']}</td>
                                        <td><strong>{$character_info['stat']['ip']}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div id="tab-resetInfos">
                        	<table border="0" class="gtable">
                            	<thead>
                                	<tr>
                                        <th>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ResetInfos']['Resets']['Title']}</th>
                                        <th></th>
                                        <th></th>
                        			</tr>
                                </thead>
                                <tbody>
                                	<tr>
                                        <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ResetInfos']['Resets']['General']}</strong></td>
                                        <td><input type="text" name="C_Resets" id="C_Resets" value="{$character_info['data']['resets_general']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        <td></td>
                                	</tr>
                                    <tr>
                                        <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ResetInfos']['Resets']['Daily']}</strong></td>
                                        <td><input type="text" name="C_RDaily" id="C_RDaily" value="{$character_info['data']['resets_daily']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        <td></td>
                                	</tr>
                                    <tr>
                                        <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ResetInfos']['Resets']['Weekly']}</strong></td>
                                        <td><input type="text" name="C_RWeekly" id="C_RWeekly" value="{$character_info['data']['resets_weekly']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                	</tr>
                                    <tr>
                                        <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ResetInfos']['Resets']['Monthly']}</strong></td>
                                        <td><input type="text" name="C_RMonthly" id="C_RMonthly" value="{$character_info['data']['resets_monthly']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        <td></td>
                                	</tr>
                                </tbody>
                        	</table>
                            <table border="0" class="gtable">
                            	<thead>
                                	<tr>
                                        <th>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ResetInfos']['MResets']['Title']}</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                        			</tr>
                                </thead>
                                <tbody>
                                	<tr>
                                        <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ResetInfos']['MResets']['General']}</strong></td>
                                        <td><input type="text" name="C_MResets" id="C_MResets" value="{$character_info['data']['mresets_general']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                	</tr>
                                    <tr>
                                        <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ResetInfos']['MResets']['Daily']}</strong></td>
                                        <td><input type="text" name="C_MRDaily" id="C_MRDaily" value="{$character_info['data']['mresets_daily']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                	</tr>
                                    <tr>
                                        <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ResetInfos']['MResets']['Weekly']}</strong></td>
                                        <td><input type="text" name="C_MRWeekly" id="C_MRWeekly" value="{$character_info['data']['mresets_weekly']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                	</tr>
                                    <tr>
                                        <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['ResetInfos']['MResets']['Monthly']}</strong></td>
                                        <td><input type="text" name="C_MRMonthly" id="C_MRMonthly" value="{$character_info['data']['mresets_monthly']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                	</tr>
                                </tbody>
                        	</table>
                        </div>
                        <div id="tab-otherInfos">
                        	<table border="0" class="gtable">
                            	<thead>
                                	<tr>
                                        <th>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['OtherInfos']['Map']['Title']}</th>
                                        <th></th>
                                        <th></th>
                        			</tr>
                                </thead>
                                <tbody>
                                	<tr>
                        				<td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['OtherInfos']['Map']['Map']}</strong></td>
                                        <td>
                                        	<select name="C_MapNumber" id="C_MapNumber">
HTML;
			foreach($this->settings['MAPDATA'] as $map_number => $map_data)
            {
            	$check = $character_info['data']['map_number'] == $map_number ? " selected=\"selected\"" : NULL;
                
                $CTM_HTML .= <<<HTML
                
												<option value="{$map_number}"{$check}>{$map_data[2]}</option>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
											</select>
                        				</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['OtherInfos']['Map']['PosX']}</strong></td>
                                        <td><input type="text" name="C_MapPosX" id="C_MapPosX" value="{$character_info['data']['map_pos_x']}" size="16" max="3" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        <td></td>
                                	</tr>
                                    <tr>
                                        <td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['OtherInfos']['Map']['PosY']}</strong></td>
                                        <td><input type="text" name="C_MapPosY" id="C_MapPosY" value="{$character_info['data']['map_pos_y']}" size="16" max="3" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        <td></td>
                                	</tr>
                        		</tbody>
                        	</table>
                            <table border="0" class="gtable">
                            	<thead>
                                	<tr>
                                        <th>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['OtherInfos']['Pk']['Title']}</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                        			</tr>
                                </thead>
                                <tbody>
                                	<tr>
                                    	<td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['OtherInfos']['Pk']['Level']}</strong></td>
                        				<td>
                                        	<select name="C_PkLevel" id="C_PkLevel">
												<option value="0"{$pklevel[0]}>{$this->lang->words['Global']['PkLevel'][0]}</option>
                                                <option value="1"{$pklevel[1]}>{$this->lang->words['Global']['PkLevel'][1]}</option>
                                                <option value="2"{$pklevel[2]}>{$this->lang->words['Global']['PkLevel'][2]}</option>
                                                <option value="3"{$pklevel[3]}>{$this->lang->words['Global']['PkLevel'][3]}</option>
                                                <option value="4"{$pklevel[4]}>{$this->lang->words['Global']['PkLevel'][4]}</option>
                                                <option value="5"{$pklevel[5]}>{$this->lang->words['Global']['PkLevel'][5]}</option>
                                                <option value="6"{$pklevel[6]}>{$this->lang->words['Global']['PkLevel'][6]}</option>
                                                <option value="7"{$pklevel[7]}>{$this->lang->words['Global']['PkLevel'][7]}</option>
											</select>
                                        </td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['OtherInfos']['Pk']['Time']}</strong></td>
                                        <td><input type="text" name="C_PkTime" id="C_PkTime" value="{$character_info['data']['pk_time']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['OtherInfos']['Pk']['PkCount']}</strong></td>
                                        <td><input type="text" name="C_PkCount" id="C_PkCount" value="{$character_info['data']['pk_count']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                    </tr>
                                    <tr>
                                    	<td><strong>{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['OtherInfos']['Pk']['HeroCount']}</strong></td>
                                        <td><input type="text" name="C_HeroCount" id="C_HeroCount" value="{$character_info['data']['hero_count']}" size="16" onkeypress="return CTM.NumbersOnly(event);" /></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                        		</tbody>
                        	</table>
                        </div>
                    </div>
                    <button id="loadSaveMember" class="button black">{$this->lang->words['Members']['Characters']['ManageCharacter']['EditCharacter']['SaveButton']}</button>
            	</form>
            </article>
HTML;
        return $CTM_HTML;
    }
    /**
	 *	Team: Manage Members
	 *
	 *	@return	string	HTML String
	*/
    public function team_manageMembers()
    {
    	global $result_command, $team_members;
        
        $CTM_HTML = <<<HTML
			<script type="text/javascript">
			$(function()
			{
				$("a[rel*=manageMemberLink]").click(function()
				{
					account = encodeURIComponent($(this).attr("set"));
					window.location = "{$this->vars['acp_url']}?app=core&module=members&section=team&index=editMember&username="+account;
				});
				$("a[rel*=manageGroupLink]").click(function()
				{
					group = $(this).attr("set");
					window.location = "{$this->vars['acp_url']}?app=core&module=members&section=team&index=editGroup&id="+group;
				});
				$("a[rel*=Remove]").click(function()
				{
					account = encodeURIComponent($(this).attr("mid"));
					Sexy.confirm("{$this->lang->words['Members']['Team']['Members']['ManageMembers']['Messages']['Delete']['Confirm']}", { onComplete : function(result)
					{
						if(result)
						{
							window.location = "{$this->vars['acp_url']}?app=core&module=members&section=team&index=manageMembers&delete="+account;
						}
					}});
				});
			});
			</script>
			<article>
				<h1>{$this->lang->words['Members']['Team']['Members']['ManageMembers']['Title']}</h1>
				{$result_command}
                
HTML;
		
        if(count($team_members) > 0)
        {
        	$CTM_HTML .= <<<HTML
				<table id="table1" class="gtable sortable">
					<thead>
						<tr>
							<th>{$this->lang->words['Members']['Team']['Members']['ManageMembers']['Table']['Id']}</th>
							<th>{$this->lang->words['Members']['Team']['Members']['ManageMembers']['Table']['Name']}</th>
							<th>{$this->lang->words['Members']['Team']['Members']['ManageMembers']['Table']['Account']}</th>
                            <th>{$this->lang->words['Members']['Team']['Members']['ManageMembers']['Table']['PrimaryGroup']}</th>
                            <th>{$this->lang->words['Members']['Team']['Members']['ManageMembers']['Table']['ACP_Access']}</th>
                            <th></th>
						</tr>
					</thead>
					<tbody>
HTML;

			foreach($team_members as $id => $member)
            {
            	$acp_access = $member['acp_access'] == true ? "tick" : "cross";
            	$CTM_HTML .= <<<HTML
						<tr>
							<td>#{$id}</td>
							<td>{$member['name']}</td>
							<td><a href="javascript: void(0);" rel="manageMemberLink" set="{$member['account']}">{$member['account']}</a></td>
							<td><a href="javascript: void(0);" rel="manageGroupLink" set="{$member['group_id']}">{$member['format_prefix']}{$member['primary_group']}{$member['format_suffix']}</a></td>
							<td><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/{$acp_access}.png" border="0" /></td>
                            <td>
								<a href="javascript: void(0);" rel="manageMemberLink" set="{$member['account']}" title="Edit"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/edit.png" alt="Edit" /></a>
								<a href="javascript: void(0);" rel="Remove" mid="{$member['account']}" title="Remove"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/cross.png" alt="Delete" /></a>
							</td>
						</tr>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
					</tbody>
				</table>
				<div class="tablefooter clearfix"></div>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
				<div class="information msg">{$this->lang->words['Members']['Team']['Members']['ManageMembers']['Messages']['NoMembers']}</div>
HTML;
        }
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	Team: Edit Member
	 *
	 *	@return	string	HTML String
	*/
    public function team_editMember()
    {
    	global $result_command, $member, $set_group_top, $groups;
        
        $acp_access_yes = ($_GET['write'] == true ? $_POST['ACP_Access'] == 1 : $member['acp_access'] == 1) ? " checked=\"checked\"" : NULL;
        $acp_access_no = ($_GET['write'] == true ? $_POST['ACP_Access'] == 0 : $member['acp_access'] == 0) ? " checked=\"checked\"" : NULL;
        
        $field_account = $_GET['write'] == true ? $_POST['Account'] : $member['account'];
        $field_name = $_GET['write'] == true ? $_POST['Name'] : $member['name'];
        $field_contact = $_GET['write'] == true ? $_POST['Contact'] : $member['contact'];
        $field_ctitle = $_GET['write'] == true ? $_POST['CustomTitle'] : $member['custom_title'];
        
        $username = urldecode($_GET['username']);
        
        $CTM_HTML = <<<HTML
			<script type="text/javascript">
			$(function()
			{
				currentPrimary = {$set_group_top};
				
				$("#s_group__"+currentPrimary).attr("disabled", true);
				$("#PrimaryGroup").change(function()
				{
					$("#s_group__"+currentPrimary).attr("disabled", false);
					$("#s_group__"+$(this).val()).attr("disabled", true);
					currentPrimary = $(this).val();
				});
			});
			</script>
            <article>
				<h1>{$this->lang->words['Members']['Team']['Members']['EditMember']['Title']}</h1>
                {$result_command}
                
                <form name="editTeamMember" id="editTeamMember" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=editMember&amp;username={$username}&amp;write=true" method="post" class="uniform">
                	<fieldset>
						<legend>{$this->lang->words['Members']['Team']['Members']['EditMember']['Fields']['L_Infos']}</legend>
                        <dl>
                        	<dt><label for="Account">{$this->lang->words['Members']['Team']['Members']['EditMember']['Fields']['Account']}</label></dt>
							<dd><input type="text" id="Account" name="Account" value="{$field_account}" class="small" /></dd>
                            
                            <dt><label for="Name">{$this->lang->words['Members']['Team']['Members']['EditMember']['Fields']['Name']}</label></dt>
							<dd><input type="text" id="Name" name="Name" value="{$field_name}" class="small" /></dd>
                            
                            <dt><label for="Contact">{$this->lang->words['Members']['Team']['Members']['EditMember']['Fields']['Contact']}</label></dt>
							<dd><input type="text" id="Contact" name="Contact" value="{$field_contact}" size="50" /></dd>
                            
                            <dt><label for="CustomTitle">{$this->lang->words['Members']['Team']['Members']['EditMember']['Fields']['CustomTitle']}</label></dt>
							<dd><input type="text" id="CustomTitle" name="CustomTitle" value="{$field_ctitle}" size="50" /></dd>
                            
                            <dt><label for="PrimaryGroup">{$this->lang->words['Members']['Team']['Members']['EditMember']['Fields']['PrimaryGroup']}</label></dt>
							<dd>
								<select id="PrimaryGroup" name="PrimaryGroup">
HTML;
		foreach($groups as $key => $name)
        {
        	$check = $key == ($_GET['write'] == true ? $_POST['PrimaryGroup'] : $member['primary_group']) ? " selected=\"selected\"" : NULL;
        	$CTM_HTML .= <<<HTML
            
									<option value="{$key}"{$check}>{$name}</option>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
								</select>
							</dd>
                            
                            <dt><label for="ACP_Access">{$this->lang->words['Members']['Team']['Members']['EditMember']['Fields']['ACP_Access']}</label></dt>
							<dd>
                            	<span class="yesno_yes"><input type="radio" name="ACP_Access" id="ACP_Access_YES" value="1"{$acp_access_yes} />
									<label for="ACP_Access_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no">
									<input type="radio" name="ACP_Access" id="ACP_Access_NO" value="0"{$acp_access_no} />
									<label for="ACP_Access_NO">{$this->lang->words['Words']['No']}</label>
								</span>
                            </dd>
                        </dl>
					</fieldset>
                    <fieldset>
						<legend>{$this->lang->words['Members']['Team']['Members']['EditMember']['Fields']['SecondaryGroups']}</legend>
                        <dl class="inline">
HTML;
		foreach($groups as $key => $name)
        {
        	$check = ($_GET['write'] == true ? $_POST['s_group__'.$key] : in_array($key, $member['secondary_groups'])) == 1 ? " checked=\"checked\"" : NULL;
        	$CTM_HTML .= <<<HTML
            
                        	<dt><label for="s_group__{$key}">{$name}</label></dt>
                            <dd><input type="checkbox" id="s_group__{$key}" name="s_group__{$key}"{$check} value="1" /></dd>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        				</dl>
					</fieldset>
                    <p>
						<button type="submit" class="button">{$this->lang->words['Members']['Team']['Members']['EditMember']['Button']}</button>
					</p>
				</form>
			</article>
HTML;
        
        return $CTM_HTML;
    }
    /**
	 *	Team: Add Member
	 *
	 *	@return	string	HTML String
	*/
    public function team_addMember()
    {
    	global $result_command, $_success, $set_group_top, $groups;
        
        $acp_access_yes = ($_GET['write'] == true ? ($_POST['ACP_Access'] == 1) : true) ? " checked=\"checked\"" : NULL;
        $acp_access_no = ($_GET['write'] == true ? ($_POST['ACP_Access'] == 0) : false) ? " checked=\"checked\"" : NULL;
        
        $CTM_HTML = <<<HTML
			<script type="text/javascript">
			$(function()
			{
				currentPrimary = {$set_group_top};
				
				$("#s_group__"+currentPrimary).attr("disabled", true);
				$("#PrimaryGroup").change(function()
				{
					$("#s_group__"+currentPrimary).attr("disabled", false);
					$("#s_group__"+$(this).val()).attr("disabled", true);
					currentPrimary = $(this).val();
				});
			});
			</script>
            <article>
				<h1>{$this->lang->words['Members']['Team']['Members']['AddMember']['Title']}</h1>
                {$result_command}
HTML;

		if($_success == true)
        {
        	$CTM_HTML .= <<<HTML
            
                <div class="information msg">{$this->lang->words['Members']['Team']['Members']['AddMember']['SetPermission']}</div>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                
                <form name="addTeamMember" id="addTeamMember" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=addMember&amp;write=true" method="post" class="uniform">
                	<fieldset>
						<legend>{$this->lang->words['Members']['Team']['Members']['AddMember']['Fields']['L_Infos']}</legend>
                        <dl>
                        	<dt><label for="Account">{$this->lang->words['Members']['Team']['Members']['AddMember']['Fields']['Account']}</label></dt>
							<dd><input type="text" id="Account" name="Account" value="{$_POST['Account']}" class="small" /></dd>
                            
                            <dt><label for="Name">{$this->lang->words['Members']['Team']['Members']['AddMember']['Fields']['Name']}</label></dt>
							<dd><input type="text" id="Name" name="Name" value="{$_POST['Name']}" class="small" /></dd>
                            
                            <dt><label for="Contact">{$this->lang->words['Members']['Team']['Members']['AddMember']['Fields']['Contact']}</label></dt>
							<dd><input type="text" id="Contact" name="Contact" value="{$_POST['Contact']}" size="50" /></dd>
                            
                            <dt><label for="CustomTitle">{$this->lang->words['Members']['Team']['Members']['AddMember']['Fields']['CustomTitle']}</label></dt>
							<dd><input type="text" id="CustomTitle" name="CustomTitle" value="{$_POST['CustomTitle']}" size="50" /></dd>
                            
                            <dt><label for="PrimaryGroup">{$this->lang->words['Members']['Team']['Members']['AddMember']['Fields']['PrimaryGroup']}</label></dt>
							<dd>
								<select id="PrimaryGroup" name="PrimaryGroup">
HTML;
		foreach($groups as $key => $name)
        {
        	$check = $key == $_POST['PrimaryGroup'] ? " selected=\"selected\"" : NULL;
        	$CTM_HTML .= <<<HTML
            
									<option value="{$key}"{$check}>{$name}</option>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
								</select>
							</dd>
                            
                            <dt><label for="ACP_Access">{$this->lang->words['Members']['Team']['Members']['AddMember']['Fields']['ACP_Access']}</label></dt>
							<dd>
                            	<span class="yesno_yes"><input type="radio" name="ACP_Access" id="ACP_Access_YES" value="1"{$acp_access_yes} />
									<label for="ACP_Access_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no">
									<input type="radio" name="ACP_Access" id="ACP_Access_NO" value="0"{$acp_access_no} />
									<label for="ACP_Access_NO">{$this->lang->words['Words']['No']}</label>
								</span>
                            </dd>
                        </dl>
					</fieldset>
                    <fieldset>
						<legend>{$this->lang->words['Members']['Team']['Members']['AddMember']['Fields']['SecondaryGroups']}</legend>
                        <dl class="inline">
HTML;
		foreach($groups as $key => $name)
        {
        	$check = $_POST['s_group__'.$key] == 1 ? " checked=\"checked\"" : NULL;
        	$CTM_HTML .= <<<HTML
            
                        	<dt><label for="s_group__{$key}">{$name}</label></dt>
                            <dd><input type="checkbox" id="s_group__{$key}" name="s_group__{$key}"{$check} value="1" /></dd>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        				</dl>
					</fieldset>
                    <p>
						<button type="submit" class="button">{$this->lang->words['Members']['Team']['Members']['AddMember']['Button']}</button>
					</p>
				</form>
			</article>
HTML;
        
        return $CTM_HTML;
    }
    /**
	 *	Team: Manage Groups
	 *
	 *	@return	string	HTML String
	*/
    public function team_manageGroups()
    {
    	global $result_command, $team_groups;
        
        $CTM_HTML = <<<HTML
			<script type="text/javascript">
			$(function()
			{
				$("a[rel*=manageGroupLink]").click(function()
				{
					group = $(this).attr("set");
					window.location = "{$this->vars['acp_url']}?app=core&module=members&section=team&index=editGroup&id="+group;
				});
				$("a[rel*=Delete]").click(function()
				{
					group = $(this).attr("gid");
					window.location = "{$this->vars['acp_url']}?app=core&module=members&section=team&index=manageGroups&do=delete&id="+group;
				});
			});
			</script>
			<article>
				<h1>{$this->lang->words['Members']['Team']['Groups']['ManageGroups']['Title']}</h1>
				{$result_command}
                
HTML;
		if(count($team_groups) > 0)
        {
        	$CTM_HTML .= <<<HTML
				<table id="table1" class="gtable sortable">
					<thead>
						<tr>
							<th>{$this->lang->words['Members']['Team']['Groups']['ManageGroups']['Table']['Id']}</th>
							<th>{$this->lang->words['Members']['Team']['Groups']['ManageGroups']['Table']['Name']}</th>
							<th>{$this->lang->words['Members']['Team']['Groups']['ManageGroups']['Table']['ACP_Access']}</th>
                            <th>{$this->lang->words['Members']['Team']['Groups']['ManageGroups']['Table']['MemberCount']}</th>
                            <th></th>
						</tr>
					</thead>
					<tbody>
HTML;
			foreach($team_groups as $id => $group)
            {
            	$acp_access = $group['acp_access'] == true ? "tick" : "cross";
            	$CTM_HTML .= <<<HTML
						<tr>
							<td>#{$id}</td>
							<td><a href="javascript: void(0);" rel="manageGroupLink" set="{$id}">{$group['format_prefix']}{$group['name']}{$group['format_suffix']}</a></td>
							<td><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/{$acp_access}.png" border="0" /></td>
							<td>{$group['count_members']}</td>
							<td>
								<a href="javascript: void(0);" rel="manageGroupLink" set="{$id}" title="Edit"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/edit.png" alt="Edit" /></a>
								<a href="javascript: void(0);" title="Delete" rel="Delete" gid="{$id}"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/cross.png" alt="Delete" /></a>
							</td>
						</tr>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
					</tbody>
				</table>
				<div class="tablefooter clearfix"></div>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            	<div class="information msg">{$this->lang->words['Members']['Team']['Groups']['ManageGroups']['Messages']['NoGroups']}</div>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
			</article>
HTML;

        return $CTM_HTML;
    }
    /**
	 *	Team: Delete Groups
	 *
	 *	@return	string	HTML String
	*/
    public function team_deleteGroup()
    {
    	global $result_command, $groups;
        
        $_id = intval($_GET['id']);
        
        $CTM_HTML = <<<HTML
			<article>
				<h1>{$this->lang->words['Members']['Team']['Groups']['ManageGroups']['Delete']['Title']}</h1>
                {$result_command}
                
                <form name="deleteGroup" id="deleteGroup" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=manageGroups&amp;id={$_id}&amp;do=delete&amp;write=true" method="post" class="uniform">
                	<dl class="inline">
                    	<dt><label for="NewGroup">{$this->lang->words['Members']['Team']['Groups']['ManageGroups']['Delete']['FieldNewGroup']}</label></dt>
						<dd>
                        	<select name="NewGroup" id="NewGroup">
HTML;

		if(count($groups) > 0)
        {
        	foreach($groups as $id => $name)
            {
            	if($id == intval($_GET['id']))
                {
                	continue;
                }
                
                $CTM_HTML .= <<<HTML
                
                				<option value="{$id}">{$name}</option>
HTML;
			}
		}
        
        $CTM_HTML .= <<<HTML
                            </select>
                        </dd>
                    </dl>
                    <button type="submit" class="button small">{$this->lang->words['Members']['Team']['Groups']['ManageGroups']['Delete']['Button']}</button>
                </form>
			</article>
HTML;
        return $CTM_HTML;
    }
     /**
	 *	Team: Edit Group
	 *
	 *	@return	string	HTML String
	*/
    public function team_editGroup()
    {
    	global $result_command, $group;
        
        $acp_access_yes = ($_GET['write'] == true ? $_POST['ACP_Access'] : $group['acp_access']) == 1 ? " checked=\"checked\"" : NULL;
        $acp_access_no = ($_GET['write'] == true ? $_POST['ACP_Access'] : $group['acp_access']) == 0 ? " checked=\"checked\"" : NULL;
        
        $field_name = $_GET['write'] == true ? $_POST['Name'] : $group['name'];
        $field_title = $_GET['write'] == true ? $_POST['GroupTitle'] : $group['group_title'];
        $field_fprefix = $_GET['write'] == true ? $_POST['FormatPrefix'] : $group['format_prefix'];
        $field_fsuffix = $_GET['write'] == true ? $_POST['FormatSuffix'] : $group['format_suffix'];
        
        $CTM_HTML = <<<HTML
			<article>
				<h1>{$this->lang->words['Members']['Team']['Groups']['EditGroup']['Title']}</h1>
                {$result_command}
        
                <form name="createTeamGroup" id="createTeamGroup" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=editGroup&amp;id={$_GET['id']}&amp;write=true" method="post" class="uniform">
                	<dl>
                    	<dt><label for="Name">{$this->lang->words['Members']['Team']['Groups']['EditGroup']['FieldName']}</label></dt>
						<dd><input type="text" id="Name" name="Name" class="big" value="{$field_name}" /></dd>

						<dt><label for="GroupTitle">{$this->lang->words['Members']['Team']['Groups']['EditGroup']['FieldTitle']}</label></dt>
						<dd><input type="text" id="GroupTitle" name="GroupTitle" class="big" value="{$field_title}" /></dd>
                        
						<dt><label for="FormatPrefix">{$this->lang->words['Members']['Team']['Groups']['EditGroup']['FieldFormatPrefix']}</label></dt>
						<dd><input type="text" id="FormatPrefix" name="FormatPrefix" class="big" value="{$field_fprefix}" /></dd>
                        
						<dt><label for="FormatSuffix">{$this->lang->words['Members']['Team']['Groups']['CreateGroup']['FieldFormatSuffix']}</label></dt>
						<dd><input type="text" id="FormatSuffix" name="FormatSuffix" class="big" value="{$field_fsuffix}" /></dd>
                        
                        <dt><label for="ACP_Access">{$this->lang->words['Members']['Team']['Groups']['EditGroup']['ACP_Access']}</label></dt>
							<dd>
                            	<span class="yesno_yes"><input type="radio" name="ACP_Access" id="ACP_Access_YES" value="1"{$acp_access_yes} />
									<label for="ACP_Access_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no">
									<input type="radio" name="ACP_Access" id="ACP_Access_NO" value="0"{$acp_access_no} />
									<label for="ACP_Access_NO">{$this->lang->words['Words']['No']}</label>
								</span>
                            </dd>
                    </dl>
                    <p>
						<button type="submit" class="button">{$this->lang->words['Members']['Team']['Groups']['EditGroup']['Button']}</button>
					</p>
    		</article>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	Team: Create Group
	 *
	 *	@return	string	HTML String
	*/
    public function team_createGroup()
    {
    	global $result_command, $_success;
        
        $acp_access_yes = ($_GET['write'] == true ? ($_POST['ACP_Access'] == 1 ? true : false) : true) ? " checked=\"checked\"" : NULL;
        $acp_access_no = ($_GET['write'] == true ? ($_POST['ACP_Access'] == 0 ? true : false) : false) ? " checked=\"checked\"" : NULL;
        
        $_title = str_replace(array("<", ">"), array("&lt;", "&gt;"), $_POST['GroupTitle']);
        $_prefix = str_replace(array("<", ">"), array("&lt;", "&gt;"), $_POST['FormatPrefix']);
        $_suffix = str_replace(array("<", ">"), array("&lt;", "&gt;"), $_POST['FormatSuffix']);
        
        $CTM_HTML = <<<HTML
			<article>
				<h1>{$this->lang->words['Members']['Team']['Groups']['CreateGroup']['Title']}</h1>
                {$result_command}
HTML;

		if($_success == true)
        {
        	$CTM_HTML .= <<<HTML
            
                <div class="information msg">{$this->lang->words['Members']['Team']['Groups']['CreateGroup']['SetPermission']}</div>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
        
                <form name="createTeamGroup" id="createTeamGroup" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=createGroup&amp;write=true" method="post" class="uniform">
                	<dl>
                    	<dt><label for="Name">{$this->lang->words['Members']['Team']['Groups']['CreateGroup']['FieldName']}</label></dt>
						<dd><input type="text" id="Name" name="Name" class="big" value="{$_POST['Name']}" /></dd>

						<dt><label for="GroupTitle">{$this->lang->words['Members']['Team']['Groups']['CreateGroup']['FieldTitle']}</label></dt>
						<dd><input type="text" id="GroupTitle" name="GroupTitle" class="big" value="{$_title}" /></dd>
                        
						<dt><label for="FormatPrefix">{$this->lang->words['Members']['Team']['Groups']['CreateGroup']['FieldFormatPrefix']}</label></dt>
						<dd><input type="text" id="FormatPrefix" name="FormatPrefix" class="big" value="{$_prefix}" /></dd>
                        
						<dt><label for="FormatSuffix">{$this->lang->words['Members']['Team']['Groups']['CreateGroup']['FieldFormatSuffix']}</label></dt>
						<dd><input type="text" id="FormatSuffix" name="FormatSuffix" class="big" value="{$_suffix}" /></dd>
                        
                        <dt><label for="ACP_Access">{$this->lang->words['Members']['Team']['Groups']['CreateGroup']['ACP_Access']}</label></dt>
						<dd>
							<span class="yesno_yes"><input type="radio" name="ACP_Access" id="ACP_Access_YES" value="1"{$acp_access_yes} />
								<label for="ACP_Access_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no">
								<input type="radio" name="ACP_Access" id="ACP_Access_NO" value="0"{$acp_access_no} />
								<label for="ACP_Access_NO">{$this->lang->words['Words']['No']}</label>
							</span>
						</dd>
                    </dl>
                    <p>
						<button type="submit" class="button">{$this->lang->words['Members']['Team']['Groups']['CreateGroup']['Button']}</button>
					</p>
    		</article>
HTML;

		return $CTM_HTML;
    }
    /**
	 *	Team: Manage Permissions
	 *
	 *	@return	string	HTML String
	*/
    public function team_managePermissions()
    {
    	global $result_command, $team_members, $team_groups, $all_members, $all_groups;
        
        $CTM_HTML = <<<HTML
			<script type="text/javascript">
			$(function()
			{
				$("a[rel*=managePermissionLink]").click(function()
				{
					permission = $(this).attr("set");
                    value = permission.substr(2);
                    
                    if(permission.substr(0, 2) == "m_")
                    {
                    	type_do = "member";
                        var_name = "username";
                    }
                    else if(permission.substr(0, 2) == "g_")
                    {
                    	type_do = "group";
                        var_name = "id";
                    }    
					
                    window.location = "{$this->vars['acp_url']}?app=core&module=members&section=team&index=setPermissions&do="+type_do+"&"+var_name+"="+value;
				});
				$("a[rel*=Delete]").click(function()
				{
					permission = $(this).attr("set");
                    value = permission.substr(2);
                    
                    if(permission.substr(0, 2) == "m_")
                    {
                    	type_do = "member";
                        var_name = "username";
                        
                        message = "{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['Confirm']['Member']}";
                    }
                    else if(permission.substr(0, 2) == "g_")
                    {
                    	type_do = "group";
                        var_name = "id";
                        
                        message = "{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['Confirm']['Group']}";
                    }
                    
                    Sexy.confirm(message, { onComplete : function(result)
					{
						if(result)
						{
							 window.location = "{$this->vars['acp_url']}?app=core&module=members&section=team&index=managePermissions&delete="+type_do+"&"+var_name+"="+value;
						}
					}});
				});
			});
			</script>
			<article>
				<h1>{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Title']}</h1>
				{$result_command}
                
                <h2>{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Members']['Title']}</h2>
                
HTML;
		if(count($team_members) > 0)
        {
        	$CTM_HTML .= <<<HTML
            
				<table id="table1" class="gtable sortable">
					<thead>
						<tr>
							<th>{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Members']['Name']}</th>
							<th>{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Members']['PrimaryGroup']}</th>
                            <th></th>
						</tr>
					</thead>
					<tbody>
HTML;
			foreach($team_members as $account => $member)
            {
            	$CTM_HTML .= <<<HTML
						<tr>
							<td><a href="javascript: void(0);" rel="managePermissionLink" set="m_{$account}">{$member['name']}</a></td>
							<td>{$member['primary_group']}</td>
							<td>
								<a href="javascript: void(0);" rel="managePermissionLink" set="m_{$account}" title="Edit"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/edit.png" alt="Edit" /></a>
								<a href="javascript: void(0);" title="Delete" rel="Delete" set="m_{$account}"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/cross.png" alt="Delete" /></a>
							</td>
						</tr>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
					</tbody>
				</table>
				<div class="tablefooter clearfix"></div>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            	<div class="information msg">{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Members']['NoMembers']}</div>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
                <h2>{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Groups']['Title']}</h2>
HTML;
        
        if(count($team_groups) > 0)
        {
        	$CTM_HTML .= <<<HTML
            
				<table id="table2" class="gtable sortable">
					<thead>
						<tr>
							<th>{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Groups']['Name']}</th>
							<th>{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Groups']['MemberCount']}</th>
                            <th></th>
						</tr>
					</thead>
					<tbody>
HTML;
			foreach($team_groups as $id => $group)
            {
            	$CTM_HTML .= <<<HTML
						<tr>
							<td><a href="javascript: void(0);" rel="managePermissionLink" set="g_{$id}">{$group['name']}</a></td>
							<td>{$group['member_count']}</td>
							<td>
								<a href="javascript: void(0);" rel="managePermissionLink" set="g_{$id}" title="Edit"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/edit.png" alt="Edit" /></a>
								<a href="javascript: void(0);" title="Delete" rel="Delete" set="g_{$id}"><img src="{$this->acp_vars['acp_url']}skin_cp/images/icons/cross.png" alt="Delete" /></a>
							</td>
						</tr>
HTML;
			}
            
            $CTM_HTML .= <<<HTML
					</tbody>
				</table>
				<div class="tablefooter clearfix"></div>
HTML;
		}
        else
        {
        	$CTM_HTML .= <<<HTML
            	<div class="information msg">{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Groups']['NoGroups']}</div>
HTML;
		}
        
        $CTM_HTML .= <<<HTML
			</article>
            <article>
				<h1>{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Select']['Title']}</h1>
                
                <ul class="tabs">
					<li><a href="#tab-member">{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Select']['Member']['Tab']}</a></li>
					<li><a href="#tab-group">{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Select']['Group']['Tab']}</a></li>
				</ul>
				<div class="tabcontent">
					<div id="tab-member">
                    	<form name="SelectMember" id="SelectMember" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=managePermissions&amp;select=member" method="post" class="uniform">
                        	<dl class="inline">
                            	<dt><label for="Account">{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Select']['Member']['Label']}</label></dt>
								<dd>
                        			<select name="Account" id="Account">
HTML;

		if(count($all_members) > 0)
        {
        	foreach($all_members as $account => $name)
            {
                $CTM_HTML .= <<<HTML
                
                						<option value="{$account}">{$name}</option>
HTML;
			}
		}
        
        $CTM_HTML .= <<<HTML
                            		</select>
                        		</dd>
                            </dl>
                            <p>
                            	<input type="submit" value="{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Select']['Member']['Button']}" class="button" />
                            </p>
                        </form>
					</div>
                    <div id="tab-group">
                    	<form name="SelectGroup" id="SelectGroup" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=managePermissions&amp;select=group" method="post" class="uniform">
                        	<dl class="inline">
                            	<dt><label for="Group">{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Select']['Group']['Label']}</label></dt>
								<dd>
                        			<select name="Group" id="Group">
HTML;

		if(count($all_groups) > 0)
        {
        	foreach($all_groups as $id => $name)
            {
                $CTM_HTML .= <<<HTML
                
                						<option value="{$id}">{$name}</option>
HTML;
			}
		}
        
        $CTM_HTML .= <<<HTML
                            		</select>
                        		</dd>
                            </dl>
                            <p>
                            	<input type="submit" value="{$this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Select']['Group']['Button']}" class="button" />
                            </p>
                        </form>
					</div>
				</div>
			</article>
HTML;

        return $CTM_HTML;
    }
    /**
	 *	Team: Set Permissions
	 *
	 *	@return	string	HTML String
	*/
    public function team_setPermissions()
    {
    	global $permissions;
        
        if($_GET['do'] == "member")
        {
        	$type_do = "member";
            $var_name = "username";
            $var_value = $_GET['username'];
        }
        elseif($_GET['do'] == "group")
        {
        	$type_do = "group";
            $var_name = "id";
            $var_value = $_GET['id'];
        }
        
        $permission_fields = $this->include__teamPermissions($permissions);
        
        $CTM_HTML = <<<HTML
			<article>
				<h1>{$this->lang->words['Members']['Team']['Permissions']['SetPermissions']['Title']}</h1>
                
                <form name="SetPermissions" id="SetPermissions" action="{$this->vars['acp_url']}?app=core&amp;module=members&amp;section=team&amp;index=setPermissions&amp;do={$type_do}&amp;{$var_name}={$var_value}&amp;write=true" method="post" class="uniform">
					{$permission_fields}
                    <p align="center">
                    	<input type="submit" value="{$this->lang->words['Members']['Team']['Permissions']['SetPermissions']['Button']}" class="button" />
                    </p>
				</form>
			</article>
HTML;
    	return $CTM_HTML;
    }
    /**
	 *	Include - Team: Permissions
	 *
	 *	@return	string	HTML String
	*/
    private function include__teamPermissions($values = array())
    {
        $checked = array();
        
        if(count($values['applications']) > 0)
        	foreach($values['applications'] as $key => $value)
            	if($value == 1)
            		$checked['app_'.$key] = " checked=\"checked\"";
                    
        if(count($values['modules']) > 0)
        	foreach($values['modules'] as $key => $value)
            	if($value == 1)
            		$checked['mod_'.$key] = " checked=\"checked\"";
                    
        if(count($values['items']) > 0)
        	foreach($values['items'] as $key => $value)
            	if($value == 1)
            		$checked['ite_'.$key] = " checked=\"checked\"";
        
        $CTM_HTML = <<<HTML
        				<ul class="tabs">
                            <li><a href="#tab-acp">{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Tabs']['ACP']}</a></li>
                            <li><a href="#tab-system">{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Tabs']['System']}</a></li>
                            <li><a href="#tab-server">{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Tabs']['Server']}</a></li>
                            <li><a href="#tab-members">{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Tabs']['Members']}</a></li>
                            <li><a href="#tab-site">{$this->lang->words['EWACP']['Permissions']['TabTitle']}</a></li>
                        </ul>
                        <div class="tabcontent">
                            <div id="tab-acp">
                            	<table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['Members']['Team']['Permissions']['Permissions']['ACP']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['ACP']['Access']}</strong></td>
                                            <td><input type="checkbox" id="app_core" name="app_core" value="1"{$checked['app_core']} /></td>
                                		</tr>
                                	</tbody>
								</table>
							</div>
                            
                            <div id="tab-system">
                            	<table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['Members']['Team']['Permissions']['Permissions']['System']['CronJob']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['System']['CronJob']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_system_cronjob" name="mod_core_system_cronjob" value="1"{$checked['mod_core_system_cronjob']} /></td>
                                		</tr>
                                	</tbody>
								</table>
                                
                                <table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['Members']['Team']['Permissions']['Permissions']['System']['Templates']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['System']['Templates']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_system_templates" name="mod_core_system_templates" value="1"{$checked['mod_core_system_templates']} /></td>
                                		</tr>
                                	</tbody>
								</table>
                                
                                <table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['Members']['Team']['Permissions']['Permissions']['System']['Analysis']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['System']['Analysis']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_system_analysis" name="mod_core_system_analysis" value="1"{$checked['mod_core_system_analysis']} /></td>
                                		</tr>
                                	</tbody>
								</table>
							</div>
                            
                            <div id="tab-server">
                            	<table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Server']['GameControl']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Server']['GameControl']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_server_gamecontrol" name="mod_core_server_gamecontrol" value="1"{$checked['mod_core_server_gamecontrol']} /></td>
                                		</tr>
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Server']['GameControl']['UsersOnline']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_server_gamecontrol_usersOnline" name="mod_core_server_gamecontrol_usersOnline" value="1"{$checked['core_server_gamecontrol_usersOnline']} /></td>
                                		</tr>
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Server']['GameControl']['SendGlobalMessage']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_server_gamecontrol_sendGlobalMessage" name="mod_core_server_gamecontrol_sendGlobalMessage" value="1"{$checked['mod_core_server_gamecontrol_sendGlobalMessage']} /></td>
                                		</tr>
                                	</tbody>
								</table>
							</div>
                            
                            <div id="tab-members">
                            	<table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Accounts']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Accounts']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_members_accounts" name="mod_core_members_accounts" value="1"{$checked['mod_core_members_accounts']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Accounts']['ManageAccount']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_members_accounts_manageAccount" name="mod_core_members_accounts_manageAccount" value="1"{$checked['mod_core_members_accounts_manageAccount']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Accounts']['ManageAccount']['BanAccount']}</strong></td>
                                            <td><input type="checkbox" id="ite_core_members_accounts_manageAccount_ban" name="ite_core_members_accounts_manageAccount_ban" value="1"{$checked['ite_core_members_accounts_manageAccount_ban']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Accounts']['ManageAccount']['UnbanAccount']}</strong></td>
                                            <td><input type="checkbox" id="ite_core_members_accounts_manageAccount_unban" name="ite_core_members_accounts_manageAccount_unban" value="1"{$checked['ite_core_members_accounts_manageAccount_unban']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Accounts']['ManageAccount']['ManageVIP']}</strong></td>
                                            <td><input type="checkbox" id="ite_core_members_accounts_manageAccount_manageVIP" name="ite_core_members_accounts_manageAccount_manageVIP" value="1"{$checked['ite_core_members_accounts_manageAccount_manageVIP']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Accounts']['ManageAccount']['ManageCoin']}</strong></td>
                                            <td><input type="checkbox" id="ite_core_members_accounts_manageAccount_manageCoin" name="ite_core_members_accounts_manageAccount_manageCoin" value="1"{$checked['ite_core_members_accounts_manageAccount_manageCoin']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Accounts']['ManageAccount']['EditAccount']}</strong></td>
                                            <td><input type="checkbox" id="ite_core_members_accounts_manageAccount_edit" name="ite_core_members_accounts_manageAccount_edit" value="1"{$checked['ite_core_members_accounts_manageAccount_edit']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Accounts']['ValidatingAccounts']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_members_accounts_validatingAccounts" name="mod_core_members_accounts_validatingAccounts" value="1"{$checked['mod_core_members_accounts_validatingAccounts']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Accounts']['BannedAccounts']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_members_accounts_bannedAccounts" name="mod_core_members_accounts_bannedAccounts" value="1"{$checked['mod_core_members_accounts_bannedAccounts']} /></td>
                                		</tr>
                                	</tbody>
								</table>
                                
                                <table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Characters']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Characters']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_members_characters" name="mod_core_members_characters" value="1"{$checked['mod_core_members_characters']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Characters']['ManageCharacter']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_members_characters_manageCharacter" name="mod_core_members_characters_manageCharacter" value="1"{$checked['mod_core_members_characters_manageCharacter']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Characters']['ManageCharacter']['BanCharacter']}</strong></td>
                                            <td><input type="checkbox" id="ite_core_members_characters_manageCharacter_ban" name="ite_core_members_characters_manageCharacter_ban" value="1"{$checked['ite_core_members_characters_manageCharacter_ban']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Characters']['ManageCharacter']['UnbanCharacter']}</strong></td>
                                            <td><input type="checkbox" id="ite_core_members_characters_manageCharacter_unban" name="ite_core_members_characters_manageCharacter_unban" value="1"{$checked['ite_core_members_characters_manageCharacter_unban']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Characters']['ManageCharacter']['EditCharacter']}</strong></td>
                                            <td><input type="checkbox" id="ite_core_members_characters_manageCharacter_edit" name="ite_core_members_characters_manageCharacter_edit" value="1"{$checked['ite_core_members_characters_manageCharacter_edit']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Characters']['CreateCharacter']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_members_characters_createCharacter" name="mod_core_members_characters_createCharacter" value="1"{$checked['mod_core_members_characters_createCharacter']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Characters']['BannedCharacters']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_members_characters_bannedCharacter" name="mod_core_members_characters_bannedCharacter" value="1"{$checked['mod_core_members_characters_bannedCharacter']} /></td>
                                		</tr>
                                	</tbody>
								</table>
                                
                                <table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Team']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Team']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_members_team" name="mod_core_members_team" value="1"{$checked['mod_core_members_team']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Team']['Members']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_members_team_members_manage" name="mod_core_members_team" value="1"{$checked['mod_core_members_team']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Team']['Groups']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_members_team_groups_manage" name="mod_core_members_team_groups_manage" value="1"{$checked['mod_core_members_team_groups_manage']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['Members']['Team']['Permissions']['Permissions']['Members']['Team']['Permissions']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_core_members_team_permissions_manage" name="mod_core_members_team_permissions_manage" value="1"{$checked['mod_core_members_team_permissions_manage']} /></td>
                                		</tr>
									</tbody>
                            	</table>
                            </div>
                            <div id="tab-site">
                            	<table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['EWACP']['Permissions']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['EWACP']['Permissions']['Access']}</strong></td>
                                            <td><input type="checkbox" id="app_effectweb" name="app_effectweb" value="1"{$checked['app_effectweb']} /></td>
                                		</tr>
                                	</tbody>
								</table>
                                
                                <table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['EWACP']['Permissions']['Main']['Notices']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['EWACP']['Permissions']['Main']['Notices']['Access']}</strong></td>
                                            <td><input type="checkbox" id="effectweb_main_notices" name="mod_effectweb_main_notices" value="1"{$checked['mod_effectweb_main_notices']} /></td>
                                		</tr>
                                        
                                        <tr>
                                        	<td><strong>{$this->lang->words['EWACP']['Permissions']['Main']['Notices']['ManageAllNotices']}</strong></td>
                                            <td><input type="checkbox" id="ite_effectweb_main_notices_manage_all" name="ite_effectweb_main_notices_manage_all" value="1"{$checked['ite_effectweb_main_notices_manage_all']} /></td>
                                		</tr>
                                	</tbody>
								</table>
                                
                                <table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['EWACP']['Permissions']['Main']['Polls']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['EWACP']['Permissions']['Main']['Polls']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_effectweb_main_polls" name="mod_effectweb_main_polls" value="1"{$checked['mod_effectweb_main_polls']} /></td>
                                		</tr>
                                	</tbody>
								</table>
                                
                                <table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['EWACP']['Permissions']['Support']['Tickets']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['EWACP']['Permissions']['Support']['Tickets']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_effectweb_support_tickets" name="mod_effectweb_support_tickets" value="1"{$checked['mod_effectweb_support_tickets']} /></td>
                                		</tr>
                                        <tr>
                                        	<td><strong>{$this->lang->words['EWACP']['Permissions']['Support']['Tickets']['EditTickets']}</strong></td>
                                            <td><input type="checkbox" id="ite_effectweb_support_edit_tickets" name="ite_effectweb_support_edit_tickets" value="1"{$checked['ite_effectweb_support_edit_tickets']} /></td>
                                		</tr>
                                        <tr>
                                        	<td><strong>{$this->lang->words['EWACP']['Permissions']['Support']['Tickets']['DeleteTickets']}</strong></td>
                                            <td><input type="checkbox" id="ite_effectweb_support_delete_tickets" name="ite_effectweb_support_delete_tickets" value="1"{$checked['ite_effectweb_support_delete_tickets']} /></td>
                                		</tr>
                                	</tbody>
								</table>
                                
                                <table class="gtable">
                                	<thead>
                                    	<tr>
                                    		<th width="55%">{$this->lang->words['EWACP']['Permissions']['Financial']['Invoices']['Title']}</th>
                                        	<th width="45%"></th>
                                    	</tr>
                                    </thead>
                                	<tbody>
                                    	<tr>
                                        	<td><strong>{$this->lang->words['EWACP']['Permissions']['Financial']['Invoices']['Access']}</strong></td>
                                            <td><input type="checkbox" id="mod_effectweb_financial_invoices" name="mod_effectweb_financial_invoices" value="1"{$checked['mod_effectweb_financial_invoices']} /></td>
                                		</tr>
                                        <tr>
                                        	<td><strong>{$this->lang->words['EWACP']['Permissions']['Financial']['Invoices']['EditInvoices']}</strong></td>
                                            <td><input type="checkbox" id="ite_effectweb_financial_edit_invoices" name="ite_effectweb_financial_edit_invoices" value="1"{$checked['ite_effectweb_financial_edit_invoices']} /></td>
                                		</tr>
                                        <tr>
                                        	<td><strong>{$this->lang->words['EWACP']['Permissions']['Financial']['Invoices']['DeleteInvoices']}</strong></td>
                                            <td><input type="checkbox" id="ite_effectweb_financial_delete_invoices" name="ite_effectweb_financial_delete_invoices" value="1"{$checked['ite_effectweb_financial_delete_invoices']} /></td>
                                		</tr>
                                	</tbody>
								</table>
                        	</div>
                        </div>
HTML;
        return $CTM_HTML;
    }
}

$callSkinCache = new CTM_ACPSkin_Members();
//$callSkinCache->registry();