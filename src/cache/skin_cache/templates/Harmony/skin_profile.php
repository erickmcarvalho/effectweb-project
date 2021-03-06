<?php
/***********************************************************/
/* Cetemaster Services, Limited                            */
/* Copyright (c) 2010-2013. All Rights Reserved,           */
/* www.cetemaster.com.br / www.cetemaster.com              */
/***********************************************************/
/* File generated by Cetemaster PHP Template Engine        */
/* Cache file:                                             */
/* Cache generated in 14/09/2013 - 17:40h                  */
/***********************************************************/
/* This is a cache file generated by Effect Web 2.10.15    */
/* DO NOT EDIT DIRECTLY                                    */
/* The changes are not saved to the database automatically */
/***********************************************************/

class skin_profile extends CTM_Command
{
	//============================================
	// Begin: profile_char
	//============================================
	public function profile_char() 
	{
		global $char_name, $char_profile, $char_masterlevel, $char_guild, $char_status, $profile_settings;  // PHP Globals

		$CTM_HTML = NULL;
		$CTM_HTML .= "	<div class=\"box-content\">
        <div class=\"header\"><span>{$char_name}</span></div>
        ".($char_profile == 'CHAR_NOT_FOUND' ? "<div class=\"error-box\">{$this->lang->words['Profile']['CharProfile']['Messages']['NotFound']}</div>" : "".($char_profile == 'PROFILE_DISABLED' ? "<div class=\"error-box\">{$this->lang->words['Profile']['CharProfile']['Messages']['ProfileDisabled']}</div>" : "<table width=\"100%\" border=\"0\">
        	<tr>
            	<td>
                	<br />
                    <div align=\"center\">
                        <img src=\"{$this->functions->GetCharImage($char_profile[COLUMN_CHARIMAGE])}\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" />
                    </div>
                    ".($profile_settings['ShowSkills'] == true ? "<div class=\"description\">
                        <ul style=\"width:240px\">
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Strength']}</strong> 
                                <span class=\"green\">{$char_profile['Strength']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Dexterity']}</strong> 
                                <span class=\"green\">{$char_profile['Dexterity']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Vitality']}</strong> 
                                <span class=\"green\">{$char_profile['Vitality']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Energy']}</strong> 
                                <span class=\"green\">{$char_profile['Energy']}</span>
                            </li>
                            ".($this->functions->ClassIsLord($char_profile['Name']) == true ? "<li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Command']}</strong> 
                                <span class=\"green\">{$char_profile[COLUMN_COMMAND]}</span>
                            </li>" : NULL)."
                        </ul>
                    </div>" : NULL)."
                </td>
                <td>
                	<div class=\"description\" style=\"float:right\">
                        <ul style=\"width:340px\">
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Level']}</strong> 
                                <span>{$char_profile['cLevel']}</span>
                            </li>
                            ".(MUSERVER_VERSION >= 5 ? "<li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['MasterLevel']}</strong> 
                                <span>{$char_masterlevel}</span>
                            </li>" : NULL)."
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Class']}</strong> 
                                <span>{$this->functions->ClassInfo($char_profile['Class'])}</span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Guild']}</strong> 
                                <span><a href=\"javascript: void(0);\" onclick=\"CTM.Load('?/guild/{$char_guild['name']}', 'content');\">{$char_guild['name']} <img src=\"{$char_guild['image']}\" width=\"15\" height=\"15\" /></a></span>
                            </li>
                            ".($profile_settings['ShowMap'] == true ? "<li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Map']}</strong> 
                                <span>{$this->functions->MapInfo($char_profile['MapNumber'])}</span>
                            </li>" : NULL)."
                            ".($profile_settings['ShowStatus'] == true ? "<li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Server']}</strong> 
                                <span>{$char_status['server']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['CharProfile']['Status']}</strong> 
                                <span>{$char_status['status']}</span>
                            </li>" : NULL)."
                        </ul>
                    </div>
            	</td>
        	</tr>
        </table>
        <div style=\"clear:both\"></div>
        ".($profile_settings['ShowResets'] == true ? "<div class=\"description\">
			<ul style=\"width:240px\">
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['ResetsGeneral']}</strong> 
                    <span class=\"red\">{$char_profile[COLUMN_RESET]}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['ResetsDaily']}</strong> 
                    <span class=\"red\">{$char_profile[COLUMN_RDAILY]}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['ResetsWeekly']}</strong> 
                    <span class=\"red\">{$char_profile[COLUMN_RWEEKLY]}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['ResetsMonthly']}</strong> 
                    <span class=\"red\">{$char_profile[COLUMN_RMONTHLY]}</span>
                </li>
			</ul>
    	</div>
        <div class=\"description\" style=\"float: right\">
			<ul style=\"width:340px\">
            	<li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['MResetsGeneral']}</strong> 
                    <span class=\"red\">{$char_profile[COLUMN_MRESET]}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['MResetsDaily']}</strong> 
                    <span class=\"red\">{$char_profile[COLUMN_MRDAILY]}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['MResetsWeekly']}</strong> 
                    <span class=\"red\">{$char_profile[COLUMN_MRWEEKLY]}</span>
                </li>
                <li>
                	<strong>&raquo; {$this->lang->words['Profile']['CharProfile']['MResetsMonthly']}</strong> 
                    <span class=\"red\">{$char_profile[COLUMN_MRMONTHLY]}</span>
                </li>
        	</ul>
        </div>" : NULL)."")."")."
    </div>
        	";
		return $CTM_HTML;
	}
	//============================================
	// End: profile_char
	//============================================
	//============================================
	// Begin: profile_guild
	//============================================
	public function profile_guild() 
	{
		global $guild_name, $guild_profile;  // PHP Globals

		$CTM_HTML = NULL;
		$CTM_HTML .= "	<div class=\"box-content\">
        <div class=\"header\"><span>{$guild_name}</span></div>
        ".($guild_profile == 'GUILD_NOT_FOUND' ? "<div class=\"error-box\">{$this->lang->words['Profile']['GuildProfile']['Messages']['NotFound']}</div>" : "<table width=\"100%\" border=\"0\">
        	<tr>
            	<td>
                	<br />
                    <div align=\"center\">
                        <img src=\"{$guild_profile['image']}\" width=\"120\" height=\"120\" style=\"border: 1px solid #B3B3B3;\" class=\"image\" />
                    </div>
                </td>
                <td>
                	<div class=\"description\">
                        <ul style=\"width:240px\">
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['GuildProfile']['GuildMaster']}</strong> 
                                <span><a href=\"javascript: void(0);\" onclick=\"CTM.Load('?/char/{$guild_profile['master']}', 'content');\">{$guild_profile['master']}</a></span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['GuildProfile']['Score']}</strong> 
                                <span class=\"red\">{$guild_profile['score']}</span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['GuildProfile']['Notice']['Title']}</strong> 
                                <span><a href=\"javascript: void(0);\" rel=\"tooltip\" title=\"{$guild_profile['notice']}\">{$this->lang->words['Profile']['GuildProfile']['Notice']['Link']}</a></span>
                            </li>
                            <li>
                                <strong>&raquo; {$this->lang->words['Profile']['GuildProfile']['MemberCount']}</strong> 
                                <span class=\"green\">{$guild_profile['member_count']}</span>
                            </li>
                        </ul>
                    </div>
            	</td>
        	</tr>
        </table>
        <div style=\"clear:both\"></div>")."
    </div>
    ".($guild_profile != 'GUILD_NOT_FOUND' ? "<div class=\"box-content\">
    	<div class=\"header\"><span>{$this->lang->words['Profile']['GuildProfile']['Members']['Title']}</span></div>
        <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"7\" class=\"tableBackColumn\">
        	<tr>
            	<td><em><strong>{$this->lang->words['Profile']['GuildProfile']['Members']['Name']}</strong></em></td>
                <td><em><strong>{$this->lang->words['Profile']['GuildProfile']['Members']['Class']}</strong></em></td>
                <td><em><strong>{$this->lang->words['Profile']['GuildProfile']['Members']['Level']}</strong></em></td>
                <td><em><strong>{$this->lang->words['Profile']['GuildProfile']['Members']['Status']}</strong></em></td>
        	</tr>
            ".$this->loop__profile_guild__0x00()."
    	</table>
    </div>" : NULL)."
        	";
		return $CTM_HTML;
	}
	//============================================
	// End: profile_guild
	//============================================

	//============================================
	// Begin: Foreach functions
	//============================================
	/* profile_guild : 0x00 */
	private function loop__profile_guild__0x00()
	{
		global $guild_profile; // PHP Globals
		$content = NULL;

		if(count($guild_profile['members']) > 0)
		{
			foreach($guild_profile['members'] as $name => $character)
			{
				$content .= "<tr>
                <td><a href=\"javascript: void(0);\" onclick=\"CTM.Load('?/char/{$name}', 'content');\"><strong>{$name}</strong></a></td>
                <td>{$character['class']}</td>
                <td>{$character['level']}</td>
                <td>{$character['status']}</td>
        	</tr>
            ";
			}
		}
		return rtrim($content);
	}
	//============================================
	// End: Foreach functions
	//============================================
}
$callSkinCache = new skin_profile();
$callSkinCache->registry();