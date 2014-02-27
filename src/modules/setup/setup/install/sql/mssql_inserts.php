<?php
/**
 *	Installation SQL Tables
 *	Generated on 22/10/2013 - 00:45h ()
*/

$install_inserts['CronTask:RecordTodayReset'] = array
(
	"query" => "INSERT INTO dbo.CTM_CronJob (TaskName, TaskDescription, TaskFile, Switch, OccurOptions) VALUES ('(EW) Record Today Reset', 'Update the record daily for zero', 'recordTodayReset', 1, '0,0,0,24,0')"
);

$install_inserts['CronTask:SynchronizeRanking'] = array
(
	"query" => "INSERT INTO dbo.CTM_CronJob (TaskName, TaskDescription, TaskFile, Switch, OccurOptions) VALUES ('(EW.MU) Synchronize Ranking Cache', 'Update the web ranking database cache', 'synchronizeRanking', 1, '0,0,0,0,30')"
);

$install_inserts['CronTask:SynchronizeVIP'] = array
(
	"query" => "INSERT INTO dbo.CTM_CronJob (TaskName, TaskDescription, TaskFile, Switch, OccurOptions) VALUES ('(MU) Synchronize VIP Accounts', 'Update to \"Free\" the accounts with VIP expired', 'synchronizeVIP', 1, '0,0,0,24,0')"
);

$install_inserts['CronTask:SynchronizeAccountsCoin'] = array
(
	"query" => "INSERT INTO dbo.CTM_CronJob (TaskName, TaskDescription, TaskFile, Switch, OccurOptions) VALUES ('(EW.MU) Synchronize Accounts Coin', 'Send coin''s cache to real coin''s table', 'synchronizeAccountsCoin', 1, '0,0,0,0,30')"
);

$install_inserts['AdminAccount:Group'] = array
(
	"arguments" => array
	(
		"team_groups:name" => "var",
		"team_groups:group_title" => "var",
	),
	"query" => "INSERT INTO dbo.CTM_TeamGroups (Name, FormatPrefix, FormatSuffix, GroupTitle, ACP_Access) VALUES ('{:team_groups:name:}', '<span style=\"color: red\">', '</span>', '{:team_groups:group_title:}', 1)"
);

$install_inserts['AdminAccount:Account'] = array
(
	"arguments" => array
	(
		"admin_account:account" => "session",
		"admin_account:name" => "session",
		"admin_account:contact" => "session",
	),
	"query" => "INSERT INTO dbo.CTM_TeamMembers (Account, Name, Contact, PrimaryGroup, ACP_Access) VALUES ('{:admin_account:account:}', '{:admin_account:name:}', '{:admin_account:contact:}', 1, 1)"
);