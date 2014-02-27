    <div class="box-content">
        <div class="header"><span>{$this->lang->words['UserPanel']['ManageProfile']['Title']}</span></div>
	   	<p>
            <b>{$this->lang->words['UserPanel']['ManageProfile']['Message']}</b><br /><br />
			<form name="UpdateProfile" id="UpdateProfile">
				<table width="60%" border="0">
					<tr>
						<td>{$this->lang->words['UserPanel']['ManageProfile']['ShowProfile']}</td>
						<td>
                        	<php>
                            	$show_profile_yes = $GLOBALS['userpanel']['manage_profile']['profile_data']['show_profile'] == true ? " checked=\"checked\"" : NULL;
								$show_profile_no = $GLOBALS['userpanel']['manage_profile']['profile_data']['show_profile'] == false ? " checked=\"checked\"" : NULL;
                        	</php>
                            
                            <span class="yesno_yes">
                            	<input type="radio" name="ShowProfile" id="ShowProfile_YES" value="1"{$show_profile_yes} />
                                <label for="ShowProfile_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no">
                                <input type="radio" name="ShowProfile" id="ShowProfile_NO" value="0"{$show_profile_no} />
                                <label for="ShowProfile_NO">{$this->lang->words['Words']['No']}</label></span>
						</td>
					</tr>
                    <tr>
						<td>{$this->lang->words['UserPanel']['ManageProfile']['ShowSkills']}</td>
						<td>
                        	<php>
                            	$show_skills_yes = $GLOBALS['userpanel']['manage_profile']['profile_data']['show_skills'] == true ? " checked=\"checked\"" : NULL;
								$show_skills_no = $GLOBALS['userpanel']['manage_profile']['profile_data']['show_skills'] == false ? " checked=\"checked\"" : NULL;
                        	</php>
                            
                            <span class="yesno_yes">
                            	<input type="radio" name="ShowSkills" id="ShowSkills_YES" value="1"{$show_profile_yes} />
                                <label for="ShowSkills_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no">
                                <input type="radio" name="ShowSkills" id="ShowSkills_NO" value="0"{$show_profile_no} />
                                <label for="ShowSkills_NO">{$this->lang->words['Words']['No']}</label></span>
						</td>
					</tr>
                    <tr>
						<td>{$this->lang->words['UserPanel']['ManageProfile']['ShowResets']}</td>
						<td>
                        	<php>
                            	$show_skills_yes = $GLOBALS['userpanel']['manage_profile']['profile_data']['show_resets'] == true ? " checked=\"checked\"" : NULL;
								$show_skills_no = $GLOBALS['userpanel']['manage_profile']['profile_data']['show_resets'] == false ? " checked=\"checked\"" : NULL;
                        	</php>
                            
                            <span class="yesno_yes">
                            	<input type="radio" name="ShowResets" id="ShowResets_YES" value="1"{$show_profile_yes} />
                                <label for="ShowResets_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no">
                                <input type="radio" name="ShowResets" id="ShowResets_NO" value="0"{$show_profile_no} />
                                <label for="ShowResets_NO">{$this->lang->words['Words']['No']}</label></span>
						</td>
					</tr>
                    <tr>
						<td>{$this->lang->words['UserPanel']['ManageProfile']['ShowMap']}</td>
						<td>
                        	<php>
                            	$show_skills_yes = $GLOBALS['userpanel']['manage_profile']['profile_data']['show_map'] == true ? " checked=\"checked\"" : NULL;
								$show_skills_no = $GLOBALS['userpanel']['manage_profile']['profile_data']['show_map'] == false ? " checked=\"checked\"" : NULL;
                        	</php>
                            
                            <span class="yesno_yes">
                            	<input type="radio" name="ShowMap" id="ShowMap_YES" value="1"{$show_profile_yes} />
                                <label for="ShowMap_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no">
                                <input type="radio" name="ShowMap" id="ShowMap_NO" value="0"{$show_profile_no} />
                                <label for="ShowMap_NO">{$this->lang->words['Words']['No']}</label></span>
						</td>
					</tr>
                    <tr>
						<td>{$this->lang->words['UserPanel']['ManageProfile']['ShowStatus']}</td>
						<td>
                        	<php>
                            	$show_status_yes = $GLOBALS['userpanel']['manage_profile']['profile_data']['show_status'] == true ? " checked=\"checked\"" : NULL;
								$show_status_no = $GLOBALS['userpanel']['manage_profile']['profile_data']['show_status'] == false ? " checked=\"checked\"" : NULL;
                        	</php>
                            
                            <span class="yesno_yes">
                            	<input type="radio" name="ShowStatus" id="ShowStatus_YES" value="1"{$show_status_yes} />
                                <label for="ShowStatus_YES">{$this->lang->words['Words']['Yes']}</label></span><span class="yesno_no">
                                <input type="radio" name="ShowStatus" id="ShowStatus_NO" value="0"{$show_status_no} />
                                <label for="ShowStatus_NO">{$this->lang->words['Words']['No']}</label></span>
						</td>
					</tr>
				</table><br />
				<input type="button" class="btn" value="{$this->lang->words['UserPanel']['ManageProfile']['Button']}" onclick="CTM.AjaxLoad('?app=core&amp;module=userpanel&amp;option=manageProfile&amp;write=true', 'Command', 'UpdateProfile');" />
			</form>
		</p>
	</div>
	<div id="Command"></div>