<?php
/**
 *	Installation SQL Tables
 *	Generated on 22/10/2013 - 00:45h ()
*/

$update_inserts['CronTask:SynchronizeAccountsCoin'] = array
(
	"query" => "INSERT INTO dbo.CTM_CronJob (TaskName, TaskDescription, TaskFile, Switch, OccurOptions) VALUES ('(EW.MU) Synchronize Accounts Coin', 'Send coin''s cache to real coin''s table', 'synchronizeAccountsCoin', 1, '0,0,0,0,30')"
);