	<div class="box-content">
    	<div class="header"><span>{$this->lang->words['Infos']['Title']}</span></div>
        <ul class="info">
        	<li><span>{$this->lang->words['Sidebar']['Infos']['Name']} </span>{const="SERVER_NAME"}</li>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['Version']} </span>{const="SERVER_VERSION"}</li>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['Experience']} </span>{const="SERVER_EXPERIENCE"}</li>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['Drop']} </span>{const="SERVER_DROP"}</li>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['BugBless']} </span>{$this->vars['sidebar']['infos']['bug_bless']}</li>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['ResetType']} </span>{$this->vars['sidebar']['infos']['reset_type']}</li>
            <li class="line"><!-- Separator line --></li>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['Count']['Accounts']} </span>{$this->vars['sidebar']['infos']['count']['totalAccounts']}</li>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['Count']['Characters']} </span>{$this->vars['sidebar']['infos']['count']['totalCharacters']}</li>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['Count']['Guilds']} </span>{$this->vars['sidebar']['infos']['count']['totalGuilds']}</li>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['Count']['AccountsVIP'][1]} </span>{$this->vars['sidebar']['infos']['count']['totalVIPAccounts'][1]}</li>
            <if syntax="VIP_NUMBER >= 2">
            <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['AccountsVIP'][2]} </span>{$this->vars['sidebar']['infos']['count']['totalVIPAccounts'][2]}</li>
            </if>
            <if syntax="VIP_NUMBER >= 3">
            <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['AccountsVIP'][3]} </span>{$this->vars['sidebar']['infos']['count']['totalVIPAccounts'][3]}</li>
            </if>
            <if syntax="VIP_NUMBER >= 4">
            <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['AccountsVIP'][4]} </span>{$this->vars['sidebar']['infos']['count']['totalVIPAccounts'][4]}</li>
            </if>
            <if syntax="VIP_NUMBER == 5">
            <li><span>{$this->lang->words['Sidebar']['Infos']['Count']['AccountsVIP'][5]} </span>{$this->vars['sidebar']['infos']['count']['totalVIPAccounts'][5]}</li>
            </if>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['Count']['Banned']['Accounts']} </span>{$this->vars['sidebar']['infos']['count']['totalBanned']['accounts']}</li>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['Count']['Banned']['Characters']} </span>{$this->vars['sidebar']['infos']['count']['totalBanned']['characters']}</li>
            <li><span>{$this->lang->words['Infos']['Count']['CharsPk']} </span>{$informations['count']['chars_pk']}</li>
            <li><span>{$this->lang->words['Infos']['Count']['CharsHero']} </span>{$informations['count']['chars_hero']}</li>
            <li class="line"><!-- Separator line --></li>
            <if syntax="SERVER_STATUS > 0">
            <li><span>{$this->lang->words['Infos']['Status']} </span>{$informations['status']}</li>
            </if>
            <li><span>{$this->lang->words['Infos']['Count']['Onlines']} </span>{$global_serverlist['totalOnline']}</li>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['RecordOnline']['Info']['General']} </span><strong>{$this->vars['sidebar']['infos']['recordOnline']['general']}</strong></li>
        	<li><span>{$this->lang->words['Sidebar']['Infos']['RecordOnline']['Info']['Today']} </span><strong>{$this->vars['sidebar']['infos']['recordOnline']['today']}</strong></li>
        </ul>
	</div>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['Infos']['ResetTable']['Title']}</span></div>
        {template="include_resetTable"}
	</div>
    <div class="box-content">
    	<div class="header"><span>{$this->lang->words['Infos']['MResetTable']['Title']}</span></div>
        {template="include_masterResetTable"}
    </div>