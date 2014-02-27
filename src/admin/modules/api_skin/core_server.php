<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP API: Application Skin
 * Last Update: 24/05/2013 - 23:37h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class CTM_ACPSkin_Server extends CTM_ACPCommand
{
	/**
	 *	Global Sidebar
	 *
	 *	@return	string	HTML String
	*/
	public function core_global_sidebar()
	{
		$CTM_HTML = NULL;
		
		if($this->checkPermission("modules", "core_server_gamecontrol") == true)
		{
			$CTM_HTML .= <<<HTML
<div class="box">
                <h2>{$this->lang->words['Server']['Sidebar']['GameControl']['Title']}</h2>
				<section>
					<ul>
						<li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=server&amp;section=gamecontrol&amp;index=usersOnline">{$this->lang->words['Server']['Sidebar']['GameControl']['UsersOnline']}</a></li>
                        <li><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=server&amp;section=gamecontrol&amp;index=sendGlobalMessage">{$this->lang->words['Server']['Sidebar']['GameControl']['SendGlobalMessage']}</a></li>
					</ul>
				</section>
			</div>
HTML;
		}

		return $CTM_HTML;
	}
	/**
	 *	Server: Home
	 *
	 *	@return	string	HTML String
	*/
	public function server_home()
	{
		$CTM_HTML = <<<HTML
<article id="dashboard">
				<h1>{$this->lang->words['Server']['Home']['Title']}</h1>
				
				<h2>{$this->lang->words['Server']['Home']['Links']['Title']}</h2>
				<section class="icons">
					<ul>
						<li>
							<a href="{$this->acp_vars['acp_url']}?app=core&amp;module=server&amp;section=gamecontrol&amp;index=usersOnline">
								<img src="{$this->acp_vars['acp_url']}skin_cp/images/eleganticons/Person-group.png" />
								<span>{$this->lang->words['Server']['Home']['Links']['UsersOnline']}</span>
							</a>
						</li>
						<li>
							<a href="{$this->acp_vars['acp_url']}?app=core&amp;module=server&amp;section=gamecontrol&amp;index=sendGlobalMessage">
								<img src="{$this->acp_vars['acp_url']}skin_cp/images/eleganticons/Info.png" />
								<span>{$this->lang->words['Server']['Home']['Links']['SendGlobalMessage']}</span>
							</a>
						</li>
					</ul>
				</section>
HTML;

		return $CTM_HTML;
	}
	/**
	 *	Game Control: Users Online
	 *
	 *	@return	string	HTML String
	*/
	public function gamecontrol_usersOnline()
	{
		global $users_online, $result_message;
		
		$CTM_HTML = <<<HTML
			<script type="text/javascript">
			$(function()
			{
				$("a[rel*=Disconnect]").click(function()
				{
					Account = $(this).attr("id").replace("user:", "");
					
					Sexy.confirm("{$this->lang->words['Server']['GameControl']['UsersOnline']['Messages']['Disconnect']}", { onComplete : function(result)
					{
						if(result)
						{
							window.location = "{$this->acp_vars['acp_url']}?app=core&module=server&section=gamecontrol&index=usersOnline&disconnect="+Account;
						}
					}});
				});
				$('#datatable').dataTable(
				{
					"aaSorting": [[ 4, "asc" ],],
					'bJQueryUI': true,
					'sPaginationType': 'full_numbers',
					"aLengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
					"oLanguage": 
					{
						"sLengthMenu": "{$this->lang->words['Server']['GameControl']['UsersOnline']['Table']['Infos']['Display']}".replace("{_MENU_}", "_MENU_"),
						"sZeroRecords": "{$this->lang->words['Server']['GameControl']['UsersOnline']['Table']['Infos']['NotResult']}",
						"sInfo": "{$this->lang->words['Server']['GameControl']['UsersOnline']['Table']['Infos']['Show']}".replace("{_START_}","_START_").replace("{_END_}","_END_").replace("{_TOTAL_}","_TOTAL_"),
						"sInfoEmpty": "{$this->lang->words['Server']['GameControl']['UsersOnline']['Table']['Infos']['Show']}".replace("{_START_}",0).replace("{_END_}",0).replace("{_TOTAL_}",0),
						"sInfoFiltered": "{$this->lang->words['Server']['GameControl']['UsersOnline']['Table']['Infos']['Filter']}".replace("{_MAX_}", "_MAX_")
					}
				});
			});
			</script>
			<article>
				<h1>{$this->lang->words['Server']['GameControl']['UsersOnline']['Title']}</h1>
                {$result_message}
               
HTML;

				if(count($users_online) > 0)
                {
                	$CTM_HTML .= <<<HTML
                    
                	<table cellpadding="0" cellspacing="0" border="0" class="display" id="datatable">
						<thead>
							<tr>
								<th>{$this->lang->words['Server']['GameControl']['UsersOnline']['Table']['Account']}</th>
								<th>{$this->lang->words['Server']['GameControl']['UsersOnline']['Table']['Character']}</th>
								<th>{$this->lang->words['Server']['GameControl']['UsersOnline']['Table']['Server']}</th>
                                <th>{$this->lang->words['Server']['GameControl']['UsersOnline']['Table']['IP']}</th>
                                <th>{$this->lang->words['Server']['GameControl']['UsersOnline']['Table']['ConnectTime']}</th>
                                <th>{$this->lang->words['Server']['GameControl']['UsersOnline']['Table']['Command']}</th>
							</tr>
						</thead>
						<tbody>
HTML;

					$i = 0;
                    
					foreach($users_online as $account => $info)
                    {
                        $grade_type = ($i % 2) == 0 ? "odd" : "even";
                        $i++;
                        
                    	$CTM_HTML .= <<<HTML
                        
							<tr class="{$grade_type}">
								<td><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=accounts&amp;index=manageAccount&amp;username={$account}">{$account}</a></td>
								<td><a href="{$this->acp_vars['acp_url']}?app=core&amp;module=members&amp;section=characters&amp;index=manageCharacter&amp;charname={$info['character']}">{$info['character']}</a></td>
                                <td>{$info['server']} {{$info['gameserver']}}</td>
                                <td>{$info['ip']}</td>
                                <td>{$info['connecttime']}</td>
                                <td><a href="javascript: void(0);" rel="Disconnect" id="user:{$account}" style="color: red">[ {$this->lang->words['Server']['GameControl']['UsersOnline']['Table']['Disconnect']} ]</td>
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
                    
				<div class="information msg">{$this->lang->words['Server']['GameControl']['UsersOnline']['Messages']['None']}</div>
HTML;
                }
                
                $CTM_HTML .= <<<HTML
                
			</article>
HTML;

		return $CTM_HTML;
	}
    /**
	 *	Game Control: Send Global Message
	 *
	 *	@return	string	HTML String
	*/
	public function gamecontrol_sendGlobalMessage()
	{
    	global $result_message;
        
        $message = str_replace("\"", "&quot;", $_POST['message']);
        
        $CTM_HTML = <<<HTML
			<article>
				<h1>{$this->lang->words['Server']['GameControl']['SendGlobalMessage']['Title']}</h1>
                {$result_message}
                
                <form name="sendGlobalMessage" id="sendGlobalMessage" action="{$this->vars['acp_url']}?app=core&amp;module=server&amp;section=gamecontrol&amp;index=sendGlobalMessage&amp;write=true" method="post" class="uniform">
                	<dl>
						<dt><label for="message">{$this->lang->words['Server']['GameControl']['SendGlobalMessage']['FieldMessage']}</label></dt>
						<dd><input type="text" id="message" name="message" size="50" value="{$message}" maxlength="34" /></dd>
                    </dl>
                    <p>
						<button type="submit" class="button">{$this->lang->words['Server']['GameControl']['SendGlobalMessage']['Button']}</button>
					</p>
    		</article>
HTML;
        
        return $CTM_HTML;
    }
}

$callSkinCache = new CTM_ACPSkin_Server();
$callSkinCache->registry();