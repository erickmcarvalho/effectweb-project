<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: Members Control - Team
 * Last Update: 06/10/2012 - 17:43h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

class Core_Admin_Members_Team extends Core_Admin_Members
{
	/**
	 *	Init module
	 *
	 *	@return	void
	*/
	public function initSection()
	{
		switch($_GET['index'])
		{
			case "manageMembers" :
				if($this->CheckPermissionModule("team_members_manage") == true)
				{
					$this->loadManageTeamMembers();
					$this->output->setContent("team_manageMembers");
				}
			break;
			case "editMember" :
				if($this->CheckPermissionModule("team_members_manage") == true)
				{
					$this->loadEditTeamMember();
				}
			break;
			case "addMember" :
				if($this->CheckPermissionModule("team_members_manage") == true)
				{
					$this->loadAddTeamMember();
					$this->output->setContent("team_addMember");
				}
			break;
			case "manageGroups" :
				if($this->CheckPermissionModule("team_groups_manage") == true)
				{
					$this->loadManageTeamGroups();
				}
			break;
			case "editGroup" :
				if($this->CheckPermissionModule("team_groups_manage") == true)
				{
					$this->loadEditTeamGroup();
				}
			break;
			case "createGroup" :
				if($this->CheckPermissionModule("team_groups_manage") == true)
				{
					$this->loadCreateTeamGroup();
					$this->output->setContent("team_createGroup");
				}
			break;
			case "managePermissions" :
				if($this->CheckPermissionModule("team_permissions_manage") == true)
				{
					$this->loadManageTeamPermissions();
					$this->output->setContent("team_managePermissions");
				}
			break;
			case "setPermissions" :
				if($this->CheckPermissionModule("team_permissions_manage") == true)
				{
					$this->loadSetTeamPermissions();
				}
			break;
			default :
				exit("<script>window.location = '".$this->vars['acp_url']."?app=core&module=members';</script>");
			break;
		}
	}
	/**
	 *	Private: Check Member
	 *	Check if the member exists
	 *
	 *	@param	string	Login
	 *	@return	void
	*/
	private function loadCheckMember($account)
	{
		$this->DB->Arguments($account);
		$this->DB->Query("SELECT 1 FROM dbo.CTM_TeamMembers WHERE Account = '%s'", $check_member_query);

		return $this->DB->CountRows($check_member_query) > 0;
	}
	/**
	 *	Private: Check Group
	 *	Check if the group exists
	 *
	 *	@param	string	Id
	 *	@return	void
	*/
	private function loadCheckGroup($id)
	{
		$this->DB->Arguments($id);
		$this->DB->Query("SELECT 1 FROM dbo.CTM_TeamGroups WHERE Id = %d", $check_group_query);

		return $this->DB->CountRows($check_group_query) > 0;
	}
	/**
	 *	Private: Check Permission
	 *	Check if the permission exists
	 *
	 *	@param	string	Id
	 *	@return	void
	*/
	private function loadCheckPermission($row_type, $row_value)
	{
		$this->DB->Arguments($row_type, $row_value);
		$this->DB->Query("SELECT 1 FROM dbo.CTM_TeamPermission WHERE RowType = '%s' AND RowValue = '%s'", $check_permission_query);

		return $this->DB->CountRows($check_permission_query) > 0;
	}
	/**
	 *	Private: Manage Team Members
	 *	Manage the team members
	 *
	 *	@return	void
	*/
	private function loadManageTeamMembers()
	{
		if(!empty($_GET['delete']))
		{
			if($this->loadCheckMember($_GET['delete']))
			{
				if(urldecode($_GET['delete']) == USER_ACCOUNT)
				{
					$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['ManageMembers']['Messages']['Delete']['NoDelSelf'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
				}
				elseif(in_array(urldecode($_GET['delete']), $this->settings['ADMINCONTROLPANEL']['SADMIN_ACCOUNTS']))
				{
					$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['ManageMembers']['Messages']['Delete']['NoDelMember'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
				}
				else
				{
					$this->DB->Arguments(urldecode($_GET['delete']));
					$this->DB->Delete("CTM_TeamMembers", "Account = '%s'");

					$this->DB->Arguments(urldecode($_GET['delete']));
					$this->DB->Delete("CTM_TeamPermission", "RowType = 'member' AND RowValue = '%s'");

					$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['ManageMembers']['Messages']['Delete']['Success'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
				}
			}
			else
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['ManageMembers']['Messages']['Delete']['MemberNotExists'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
			}
		}

		$this->DB->Query("SELECT dbo.CTM_TeamMembers.Id AS MemberId, dbo.CTM_TeamMembers.Account AS MemberAccount, dbo.CTM_TeamMembers.Name AS MemberName, dbo.CTM_TeamMembers.ACP_Access AS ACP_Access, dbo.CTM_TeamGroups.Id AS GroupId, dbo.CTM_TeamGroups.Name AS PrimaryGroup, dbo.CTM_TeamGroups.FormatPrefix AS FormatPrefix, dbo.CTM_TeamGroups.FormatSuffix AS FormatSuffix FROM dbo.CTM_TeamMembers INNER JOIN dbo.CTM_TeamGroups ON (dbo.CTM_TeamGroups.Id = dbo.CTM_TeamMembers.PrimaryGroup) ORDER BY dbo.CTM_TeamMembers.Id ASC", $find_members_q);
		$GLOBALS['team_members'] = array();

		if($this->DB->CountRows($find_members_q) > 0)
		{
			while($find_members = $this->DB->FetchObject($find_members_q))
			{
				$GLOBALS['team_members'][$find_members->MemberId] = array
				(
					"account" => $find_members->MemberAccount,
					"name" => $find_members->MemberName,
					"group_id" => $find_members->GroupId,
					"primary_group" => $find_members->PrimaryGroup,
					"format_prefix" => htmlDecode($find_members->FormatPrefix, true),
					"format_suffix" => htmlDecode($find_members->FormatSuffix, true),
					"acp_access" => $find_members->ACP_Access == 1
				);
			}
		}
	}
	/**
	 *	Private: Edit Team Member
	 *	Edit the team member
	 *
	 *	@return	void
	*/
	private function loadEditTeamMember()
	{
		if(!$this->loadCheckMember(urldecode($_GET['username'])))
		{
			$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['ManageMembers']['Messages']['MemberNoExists'];
			$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);

			$_GET['write'] = FALSE;

			$this->loadManageTeamMembers();
			$this->output->setContent("team_manageMembers");

			return NULL;
		}

		if($_GET['write'] == true)
		{
			if(empty($_POST['Account']) || empty($_POST['Name']) || empty($_POST['PrimaryGroup']))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['EditMember']['Messages']['FieldsVoid'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
			}
			else
			{
				$this->DB->Arguments($_POST['Name'], $_POST['Account']);
				$this->DB->Query("SELECT 1 FROM ".MUGEN_CORE.".dbo.Character WHERE Name = '%s' AND AccountID = '%s'", $check_char_account);

				if($this->DB->CountRows($check_char_account) < 1)
				{
					$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['EditMember']['Messages']['AccountNameError'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
				}
				else
				{
					$this->DB->Arguments($_POST['PrimaryGroup']);
					$this->DB->Query("SELECT 1 FROM dbo.CTM_TeamGroups WHERE Id = %d", $check_group);

					if($this->DB->CountRows($check_group) < 1)
					{
						$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['EditMember']['Messages']['InvalidGroup'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
					}
					else
					{
						$break = 0;
						$groups = NULL;

						foreach($_POST as $key => $value)
						{
							if(substr($key, 0, 9) == "s_group__" && $value == 1)
							{
								$this->DB->Arguments(substr($key, 9));
								$this->DB->Query("SELECT 1 FROM dbo.CTM_TeamGroups WHERE Id = %d", $check_group);

								if($this->DB->CountRows($check_group) < 1)
								{
									$break = 1;
									break;
								}
								elseif(substr($key, 9) == $_POST['PrimaryGroup'])
								{
									$break = 2;
									break;
								}
								else
								{
									$groups .= substr($key, 9).",";
								}
							}
						}

						if($break == 1)
						{
							$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['EditMember']['Messages']['InvalidGroup'];
							$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
						}
						elseif($break == 2)
						{
							$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['EditMember']['Messages']['GroupError'];
							$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
						}
						else
						{
							$update_columns = array
							(
								"Account" => $_POST['Account'],
								"Name" => $_POST['Name'],
								"Contact" => $_POST['Contact'],
								"CustomTitle" => $_POST['CustomTitle'],
								"PrimaryGroup" => $_POST['PrimaryGroup'],
								"SecondaryGroups" => rtrim($groups, ","),
								"ACP_Access" => $_POST['ACP_Access'] == 1 ? 1 : 0
							);

							if(empty($_POST['Contact']))
								$this->DB->ForceDataType("Contact", "null");

							if(empty($_POST['CustomTitle']))
								$this->DB->ForceDataType("CustomTitle", "null");

							if(empty($groups))
								$this->DB->ForceDataType("SecondaryGroups", "null");
							else
								$this->DB->ForceDataType("SecondaryGroups", "string");

							$this->DB->Arguments(urldecode($_GET['username']));
							$this->DB->Update("CTM_TeamMembers", $update_columns, "Account = '%s'");

							$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['EditMember']['Messages']['Success'];
							$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);

							$_GET['username'] = urlencode($_POST['Account']);
						}
					}
				}
			}
		}

		$GLOBALS['groups'] = array(); $i = 0;
		$this->DB->Query("SELECT Id, Name FROM dbo.CTM_TeamGroups ORDER BY Id ASC", $find_groups_q);

		while($group = $this->DB->FetchObject($find_groups_q))
		{
			if($i == 0)
				$GLOBALS['set_group_top'] = $group->Id;

			$GLOBALS['groups'][$group->Id] = htmlEncode(utf8_decode($group->Name));
			$i++;
		}

		$this->DB->Arguments(urldecode($_GET['username']));
		$this->DB->Query("SELECT * FROM dbo.CTM_TeamMembers WHERE Account = '%s'", $find_member_q);
		$find_member = $this->DB->FetchObject($find_member_q);

		$GLOBALS['member'] = array
		(
			"account" => $find_member->Account,
			"name" => utf8_decode($find_member->Name),
			"contact" => $find_member->Contact,
			"custom_title" => $find_member->CustomTitle,
			"primary_group" => $find_member->PrimaryGroup,
			"secondary_groups" => explode(",", $find_member->SecondaryGroups),
			"acp_access" => $find_member->ACP_Access == 1 ? 1 : 0
		);

		$this->lang->setArguments("Members,Team,Members,EditMember,Title", urldecode($_GET['username']));
		$this->output->setContent("team_editMember");
	}
	/**
	 *	Private: Add Team Member
	 *	Add the new team member
	 *
	 *	@return	void
	*/
	private function loadAddTeamMember()
	{
		if($_GET['write'] == true)
		{
			if(empty($_POST['Account']) || empty($_POST['Name']) || empty($_POST['PrimaryGroup']))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['AddMember']['Messages']['FieldsVoid'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
			}
			else
			{
				if($this->loadCheckMember($_POST['Account']) == true)
				{
					$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['AddMember']['Messages']['MemberExists'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
				}
				else
				{
					$this->DB->Arguments($_POST['Name'], $_POST['Account']);
					$this->DB->Query("SELECT 1 FROM ".MUGEN_CORE.".dbo.Character WHERE Name = '%s' AND AccountID = '%s'", $check_char_account);

					if($this->DB->CountRows($check_char_account) < 1)
					{
						$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['AddMember']['Messages']['AccountNameError'];
						$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
					}
					else
					{
						$this->DB->Arguments($_POST['PrimaryGroup']);
						$this->DB->Query("SELECT 1 FROM dbo.CTM_TeamGroups WHERE Id = %d", $check_group);

						if($this->DB->CountRows($check_group) < 1)
						{
							$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['AddMember']['Messages']['InvalidGroup'];
							$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
						}
						else
						{
							$break = 0;
							$groups = NULL;

							foreach($_POST as $key => $value)
							{
								if(substr($key, 0, 9) == "s_group__" && $value == 1)
								{
									$this->DB->Arguments(substr($key, 9));
									$this->DB->Query("SELECT 1 FROM dbo.CTM_TeamGroups WHERE Id = %d", $check_group);

									if($this->DB->CountRows($check_group) < 1)
									{
										$break = 1;
										break;
									}
									elseif(substr($key, 9) == $_POST['PrimaryGroup'])
									{
										$break = 2;
										break;
									}
									else
									{
										$groups .= substr($key, 9).",";
									}
								}
							}

							if($break == 1)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['AddMember']['Messages']['InvalidGroup'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							elseif($break == 2)
							{
								$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['AddMember']['Messages']['GroupError'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
							}
							else
							{
								$insert_columns = array
								(
									"Account" => $_POST['Account'],
									"Name" => $_POST['Name'],
									"Contact" => $_POST['Contact'],
									"CustomTitle" => $_POST['CustomTitle'],
									"PrimaryGroup" => $_POST['PrimaryGroup'],
									"SecondaryGroups" => rtrim($groups, ","),
									"ACP_Access" => $_POST['ACP_Access'] == 1 ? 1 : 0
								);

								if(empty($_POST['Contact']))
									$this->DB->ForceDataType("Contact", "null");

								if(empty($_POST['CustomTitle']))
									$this->DB->ForceDataType("CustomTitle", "null");

								if(empty($groups))
									$this->DB->ForceDataType("SecondaryGroups", "null");
								else
									$this->DB->ForceDataType("SecondaryGroups", "string");

								$this->DB->Insert("CTM_TeamMembers", $insert_columns);

								$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Members']['AddMember']['Messages']['Success'];
								$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
								$GLOBALS['_success'] = TRUE;
							}
						}
					}
				}
			}
		}

		$GLOBALS['groups'] = array(); $i = 0;
		$this->DB->Query("SELECT Id, Name FROM dbo.CTM_TeamGroups ORDER BY Id ASC", $find_groups_q);

		while($group = $this->DB->FetchObject($find_groups_q))
		{
			if($i == 0)
				$GLOBALS['set_group_top'] = $group->Id;

			$GLOBALS['groups'][$group->Id] = htmlEncode(utf8_decode($group->Name));
			$i++;
		}

		if($GLOBALS['_success'] == true)
			$this->lang->setArguments("Members,Team,Members,AddMember,SetPermission", $this->vars['acp_url']."?app=core&amp;module=members&amp;section=team&amp;index=setPermissions&amp;do=member&amp;username=".urlencode($_POST['Account']));
	}
	/**
	 *	Private: Manage Team Groups
	 *	Manage the team groups
	 *
	 *	@return	void
	*/
	private function loadManageTeamGroups()
	{
		$load_page = TRUE;

		if($_GET['do'] == "delete" && $this->loadCheckGroup($_GET['id']))
		{
			if($_GET['write'] == true)
			{
				if(empty($_POST['NewGroup']))
				{
					$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Groups']['ManageGroups']['Delete']['Messages']['SelectGroup'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);

					$load_page = FALSE;
				}
				elseif(!$this->loadCheckGroup($_POST['NewGroup']))
				{
					$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Groups']['ManageGroups']['Delete']['Messages']['GroupNoExists'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);

					$load_page = FALSE;
				}
				elseif(in_array($_GET['id'], $this->settings['ADMINCONTROLPANEL']['SADMIN_GROUPS']))
				{
					$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Groups']['ManageGroups']['Delete']['Messages']['NoDelGroup'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);

					$load_page = FALSE;
				}
				else
				{
					$query = "DELETE FROM dbo.CTM_TeamGroups WHERE Id = ".intval($_GET['id']).";\n";
					$query .= "DELETE FROM dbo.CTM_TeamPermission WHERE RowType = 'group' AND RowValue = ".intval($_GET['id'].";\n");

					$this->DB->Arguments($_GET['id']);
					$this->DB->Query("SELECT Account, PrimaryGroup, SecondaryGroups FROM dbo.CTM_TeamMembers", $member_q);

					while($member = $this->DB->FetchObject($member_q))
					{
						$temp = NULL;
						$update = FALSE;

						if($member->PrimaryGroup == intval($_GET['id']))
						{
							$temp .= "PrimaryGroup = ".intval($_POST['NewGroup']);
							$update = TRUE;
						}

						if(strlen($member->SecondaryGroups) > 0)
						{
							$tmp = NULL;
							$exp = explode(",", $member->SecondaryGroups);

							foreach($exp as $v)
							{
								if($v == intval($_GET['id']))
								{
									continue;
								}

								$tmp .= $v.",";
							}

							$tmp = rtrim($tmp, ",");

							$temp .= ($update == true ? ", " : NULL)."SecondaryGroups = '".$tmp."'";
							$update = TRUE;
						}

						if($update == true)
						{
							$query .= "UPDATE dbo.CTM_TeamMembers SET {$temp} WHERE Account = '".$member->Account."';\n";
						}
					}

					$this->DB->Query($query);

					$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Groups']['ManageGroups']['Delete']['Messages']['Success'];
					$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
				}
			}
			else
			{
				$load_page = FALSE;
			}

			if($load_page == false)
			{
				$this->DB->Query("SELECT Id, Name FROM dbo.CTM_TeamGroups ORDER BY Id ASC", $groups_q);
				$GLOBALS['groups'] = array();

				while($group = $this->DB->FetchArray($groups_q))
				{
					$GLOBALS['groups'][$group['Id']] = utf8_decode($group['Name']);
				}

				$this->lang->setArguments("Members,Team,Groups,ManageGroups,Delete,Title", intval($_GET['id']));
				return $this->output->setContent("team_deleteGroup");
			}
		}

		if($load_page == true)
		{
			$this->DB->Query("SELECT dbo.CTM_TeamGroups.Id AS Id, dbo.CTM_TeamGroups.Name AS Name, dbo.CTM_TeamGroups.FormatPrefix AS FormatPrefix, dbo.CTM_TeamGroups.FormatSuffix AS FormatSuffix, dbo.CTM_TeamGroups.ACP_Access AS ACP_Access FROM dbo.CTM_TeamGroups ORDER BY dbo.CTM_TeamGroups.Id ASC", $find_groups_q);
			$GLOBALS['team_groups'] = array();

			if($this->DB->CountRows($find_groups_q) > 0)
			{
				while($find_groups = $this->DB->FetchObject($find_groups_q))
				{
					$member_count_q = $this->DB->Query("SELECT 1 FROM dbo.CTM_TeamMembers WHERE dbo.CTM_TeamMembers.PrimaryGroup = ".$find_groups->Id);
					$member_count = $this->DB->CountRows($member_count_q);

					$GLOBALS['team_groups'][$find_groups->Id] = array
					(
						"name" => $find_groups->Name,
						"format_prefix" => htmlDecode($find_groups->FormatPrefix, true),
						"format_suffix" => htmlDecode($find_groups->FormatSuffix, true),
						"count_members" => intval($member_count),
						"acp_access" => $find_groups->ACP_Access == 1
					);
				}
			}

			$this->output->setContent("team_manageGroups");
		}
	}
	/**
	 *	Private: Edit Team Group
	 *	Edit the team group
	 *
	 *	@return	void
	*/
	private function loadEditTeamGroup()
	{
		if(!$this->loadCheckGroup($_GET['id']))
		{
			$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Groups']['ManageGroups']['Messages']['GroupNoExists'];
			$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);

			$_GET['write'] = FALSE;
			return $this->loadManageTeamGroups();
		}

		if($_GET['write'] == true)
		{
			if(empty($_POST['Name']) || empty($_POST['GroupTitle']))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Groups']['EditGroup']['Messages']['FieldsVoid'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
			}
			else
			{
				$update_columns = array
				(
					"Name" => utf8_encode($_POST['Name']),
					"FormatPrefix" => htmlEncode($_POST['FormatPrefix']),
					"FormatSuffix" => htmlEncode($_POST['FormatSuffix']),
					"GroupTitle" => utf8_encode($_POST['GroupTitle']),
					"ACP_Access" => $_POST['ACP_Access'] == 1 ? 1 : 0
				);

				if(empty($_POST['FormatPrefix']))
					$this->DB->ForceDataType("FormatPrefix", "null");

				if(empty($_POST['FormatSuffix']))
					$this->DB->ForceDataType("FormatSuffix", "null");

				$this->DB->Arguments($_GET['id']);
				$this->DB->Update("CTM_TeamGroups", $update_columns, "Id = %d");

				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Groups']['EditGroup']['Messages']['Success'];
				$GLOBALS['result_command'] = adminShowMessage(sprintf($GLOBALS['result_command'], $_GET['id']), 3);
			}
		}

		$this->DB->Arguments($_GET['id']);
		$this->DB->Query("SELECT * FROM dbo.CTM_TeamGroups WHERE Id = %d", $find_group_q);
		$find_group = $this->DB->FetchObject($find_group_q);

		$GLOBALS['group'] = array
		(
			"name" => utf8_decode($find_group->Name),
			"format_prefix" => str_replace(array("<", ">"), array("&lt;", "&gt;"), $find_group->FormatPrefix),
			"format_suffix" => str_replace(array("<", ">"), array("&lt;", "&gt;"), $find_group->FormatSuffix),
			"group_title" => $find_group->GroupTitle,
			"acp_access" => $find_group->ACP_Access == 1 ? 1 : 0
		);

		$this->lang->setArguments("Members,Team,Groups,EditGroup,Title", $_GET['id']);
		$this->output->setContent("team_editGroup");
	}
	/**
	 *	Private: Create Team Group
	 *	Create the new team group
	 *
	 *	@return	void
	*/
	private function loadCreateTeamGroup()
	{
		if($_GET['write'] == true)
		{
			if(empty($_POST['Name']) || empty($_POST['GroupTitle']))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Groups']['CreateGroup']['Messages']['FieldsVoid'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
			}
			else
			{
				$insert_columns = array
				(
					"Name" => utf8_encode($_POST['Name']),
					"FormatPrefix" => htmlEncode($_POST['FormatPrefix']),
					"FormatSuffix" => htmlEncode($_POST['FormatSuffix']),
					"GroupTitle" => utf8_encode($_POST['GroupTitle']),
					"ACP_Access" => $_POST['ACP_Access'] == 1 ? 1 : 0
				);

				if(empty($_POST['FormatPrefix']))
					$this->DB->ForceDataType("FormatPrefix", "null");

				if(empty($_POST['FormatSuffix']))
					$this->DB->ForceDataType("FormatSuffix", "null");

				$this->DB->Insert("CTM_TeamGroups", $insert_columns);
				$group_id = $this->DB->GetLastedId();

				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Groups']['CreateGroup']['Messages']['Success'];
				$GLOBALS['result_command'] = adminShowMessage(sprintf($GLOBALS['result_command'], $group_id), 3);
				$GLOBALS['_success'] = TRUE;
			}

			if($GLOBALS['_success'] == true)
				$this->lang->setArguments("Members,Team,Groups,CreateGroup,SetPermission", $this->vars['acp_url']."?app=core&amp;module=members&amp;section=team&amp;index=setPermissions&amp;do=group&amp;id=".$group_id);
		}
	}
	/**
	 *	Private: Manage Team Permissions
	 *	Manage the team permissions
	 *
	 *	@return	void
	*/
	private function loadManageTeamPermissions()
	{
		if($_GET['delete'] == "member" && !empty($_GET['username']))
		{
			if(!$this->loadCheckMember(urldecode($_GET['username'])))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['MemberNoExists'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
			}
			else
			{
				$this->DB->Arguments(urldecode($_GET['username']));
				$this->DB->Delete("CTM_TeamPermission", "RowType = 'member' AND RowValue = '%s'");

				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['MemberDeleted'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
			}
		}
		elseif($_GET['delete'] == "group" && !empty($_GET['id']))
		{
			if(!$this->loadCheckGroup($_GET['id']))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['GroupNoExists'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
			}
			else
			{
				$this->DB->Arguments($_GET['id']);
				$this->DB->Delete("CTM_TeamPermission", "RowType = 'group' AND RowValue = %d");

				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['GroupDeleted'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);
			}
		}
		elseif($_GET['select'] == "member")
		{
			if(empty($_POST['Account']))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['AccountVoid'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
			}
			elseif(!$this->loadCheckMember($_POST['Account']))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['MemberNoExists'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
			}
			else
			{
				exit("<script>window.location = '".$this->vars['acp_url']."?app=core&module=members&section=team&index=setPermissions&do=member&username=".urlencode($_POST['Account'])."';</script>");
			}		
		}
		elseif($_GET['select'] == "group")
		{
			if(empty($_POST['Group']))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['SelectGroup'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 1);
			}
			elseif(!$this->loadCheckGroup($_POST['Group']))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['GroupNoExists'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
			}
			else
			{
				exit("<script>window.location = '".$this->vars['acp_url']."?app=core&module=members&section=team&index=setPermissions&do=group&id=".intval($_POST['Group'])."';</script>");
			}		
		}

		$this->DB->Query("SELECT dbo.CTM_TeamPermission.RowValue AS Account, dbo.CTM_TeamMembers.Name AS MemberName, dbo.CTM_TeamGroups.Name AS PrimaryGroup FROM dbo.CTM_TeamPermission INNER JOIN dbo.CTM_TeamMembers ON (dbo.CTM_TeamMembers.Account = dbo.CTM_TeamPermission.RowValue) INNER JOIN dbo.CTM_TeamGroups ON (dbo.CTM_TeamGroups.Id = dbo.CTM_TeamMembers.PrimaryGroup) WHERE RowType = 'member'", $find_members_q);
		$this->DB->Query("SELECT dbo.CTM_TeamPermission.RowValue AS [Group], dbo.CTM_TeamGroups.Name AS GroupName FROM dbo.CTM_TeamPermission INNER JOIN dbo.CTM_TeamGroups ON (dbo.CTM_TeamGroups.Id = dbo.CTM_TeamPermission.RowValue) WHERE RowType = 'group'", $find_groups_q);

		$GLOBALS['team_members'] = array();
		$GLOBALS['team_groups'] = array();

		if($this->DB->CountRows($find_members_q) > 0)
		{
			while($find_members = $this->DB->FetchObject($find_members_q))
			{
				$GLOBALS['team_members'][$find_members->Account] = array
				(
					"name" => utf8_decode($find_members->MemberName),
					"primary_group" => utf8_decode($find_members->PrimaryGroup)
				);
			}
		}

		if($this->DB->CountRows($find_groups_q) > 0)
		{
			while($find_groups = $this->DB->FetchObject($find_groups_q))
			{
				$member_count_q = $this->DB->Query("SELECT 1 FROM dbo.CTM_TeamMembers WHERE dbo.CTM_TeamMembers.PrimaryGroup = ".$find_groups->Group);
				$member_count = $this->DB->CountRows($member_count_q);

				$GLOBALS['team_groups'][$find_groups->Group] = array
				(
					"name" => utf8_decode($find_groups->GroupName),
					"member_count" => intval($member_count)
				);
			}
		}

		$this->DB->Query("SELECT Account, Name FROM dbo.CTM_TeamMembers ORDER BY Id ASC", $get_members);
		$this->DB->Query("SELECT Id, Name FROM dbo.CTM_TeamGroups ORDER BY Id ASC", $get_groups);

		$GLOBALS['all_members'] = array();
		$GLOBALS['all_groups'] = array();

		while($members = $this->DB->FetchRow($get_members))
			$GLOBALS['all_members'][$members[0]] = utf8_decode($members[1]);

		while($groups = $this->DB->FetchRow($get_groups))
			$GLOBALS['all_groups'][$groups[0]] = utf8_decode($groups[1]);
	}
	/**
	 *	Private: Set Team Permissions
	 *	Set the team permissions
	 *
	 *	@return	void
	*/
	private function loadSetTeamPermissions()
	{
		global $appsCache;

		if($_GET['do'] != "member" && $_GET['do'] != "group")
			exit("<script>window.location = '".$this->vars['acp_url']."?app=core&module=members';</script>");

		if($_GET['do'] == "member")
		{
			if(empty($_GET['username']) || !$this->loadCheckMember(urldecode($_GET['username'])))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['MemberNoExists'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);

				$this->loadManageTeamPermissions();
				$this->output->setContent("team_managePermissions");

				return NULL;
			}
			
			$row_type = "member";
			$row_value = urldecode($_GET['username']);
		}
		elseif($_GET['do'] == "group")
		{
			if(empty($_GET['id']) || !$this->loadCheckGroup(intval($_GET['id'])))
			{
				$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['GroupNoExists'];
				$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 2);
				
				$this->loadManageTeamPermissions();
				$this->output->setContent("team_managePermissions");

				return NULL;
			}

			$row_type = "group";
			$row_value = intval($_GET['id']);
		}

		require_once(CTM_ADMINCP_PATH."sources/includes/permissions.inc.php");

		foreach($appsCache as $key => $value)
		{
			if($key == "core")
				continue;

			if(!in_array($key, $acp_permissions['applications']))
				$acp_permissions['applications'][] = $key;

			if(file_exists(CTM_ROOT_PATH."modules/applications/apps_ctm/".strtolower($value['name'])."/admin/variables/acp_permissions.php"))
			{
				require_once(CTM_ROOT_PATH."modules/applications/apps_ctm/".strtolower($value['name'])."/admin/variables/acp_permissions.php");

				$acp_permissions['modules'] = array_merge($acp_permissions['modules'], $_acp_permissions['modules']);
				$acp_permissions['items'] = array_merge($acp_permissions['items'], $_acp_permissions['items']);
			}

			$this->lang->loadLanguageFile("admincp", $value['name']);
		}

		if($_GET['write'] == true)
		{
			$applications = array();
			$modules = array();
			$items = array();

			foreach($acp_permissions['applications'] as $name)
				if($_POST['app_'.$name] == 1)
					$applications[] = $name;

			foreach($acp_permissions['modules'] as $name)
				if($_POST['mod_'.$name] == 1)
					$modules[] = $name;

			foreach($acp_permissions['items'] as $name)
				if($_POST['ite_'.$name] == 1)
					$items[] = $name;

			$cache = array
			(
				"applications" => $applications,
				"modules" => $modules,
				"items" => $items
			);

			if($this->loadCheckPermission($row_type, $row_value))
			{
				$update_columns = array
				(
					"PermissionCache" => serialize($cache)
				);

				$this->DB->Arguments($row_type, $row_value);
				$this->DB->Update("CTM_TeamPermission", $update_columns, "RowType = '%s' AND RowValue = '%s'");
			}
			else
			{
				$insert_columns = array
				(
					"RowType" => $row_type,
					"RowValue" => $row_value,
					"PermissionCache" => serialize($cache)
				);

				$this->DB->Insert("CTM_TeamPermission", $insert_columns);
			}

			$GLOBALS['result_command'] = $this->lang->words['Members']['Team']['Permissions']['ManagePermissions']['Messages']['Saved'];
			$GLOBALS['result_command'] = adminShowMessage($GLOBALS['result_command'], 3);

			$this->loadManageTeamPermissions();
			$this->output->setContent("team_managePermissions");
		}
		else
		{
			$this->DB->Arguments($row_type, $row_value);
			$this->DB->Query("SELECT PermissionCache FROM dbo.CTM_TeamPermission WHERE RowType = '%s' AND RowValue = '%s'", $find_permissions_q);

			$cache = array
			(
				"applications" => array(),
				"modules" => array(),
				"items" => array()
			);

			if($this->DB->CountRows($find_permissions_q) > 0)
			{
				$find_permissions = $this->DB->FetchRow($find_permissions_q);

				if(strlen($find_permissions[0]) > 0)
				{
					if(($unserialize = unserialize($find_permissions[0])))
					{
						if(count($unserialize['applications']) > 0)
						{
							foreach($unserialize['applications'] as $application)
							{
								$cache['applications'][$application] = 1;
							}
						}

						if(count($unserialize['modules']) > 0)
						{
							foreach($unserialize['modules'] as $module)
							{
								$cache['modules'][$module] = 1;
							}
						}

						if(count($unserialize['items']) > 0)
						{
							foreach($unserialize['items'] as $item)
							{
								$cache['items'][$item] = 1;
							}
						}
					}
				}
			}

			$GLOBALS['permissions'] = $cache;
			$this->output->setContent("team_setPermissions");
		}
	}
}