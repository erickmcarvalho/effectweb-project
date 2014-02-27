<?php
/**
 * Cetemaster Services 
 * Effect Web 2 - Admin Control Panel
 *
 * AdminCP Core: ACP permissions
 * Last Update: 07/10/2012 - 19:34h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

$acp_permissions = array
(
	"applications" => array
	(
		"core",
		"effectweb",
	),
	"modules" => array
	(
		"core_system_cronjob",
		"core_system_templates",
		"core_system_analysis",
		"core_server_gamecontrol",
		"core_server_gamecontrol_usersOnline",
		"core_server_gamecontrol_sendGlobalMessage",
		"core_members_accounts",
		"core_members_accounts_manageAccount",
		"core_members_accounts_validatingAccounts",
		"core_members_accounts_bannedAccounts",
		"core_members_characters",
		"core_members_characters_manageCharacter",
		"core_members_characters_createCharacter",
		"core_members_characters_bannedCharacter",
		"core_members_team",
		"core_members_team_members_manage",
		"core_members_team_groups_manage",
		"core_members_team_permissions_manage",
	),
	"items" => array
	(
		"core_members_accounts_manageAccount_ban",
		"core_members_accounts_manageAccount_unban",
		"core_members_accounts_manageAccount_manageVIP",
		"core_members_accounts_manageAccount_manageCoin",
		"core_members_accounts_manageAccount_edit",
		"core_members_characters_manageCharacter_ban",
		"core_members_characters_manageCharacter_unban",
		"core_members_characters_manageCharacter_edit",
	),
);