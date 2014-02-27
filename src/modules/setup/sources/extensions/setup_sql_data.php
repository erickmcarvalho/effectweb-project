<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: SQL Data
 * Last Update: 10/07/2013 - 15:58h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

$sql_data['CronTask:RecordTodayReset']['Select'] = "SELECT Id FROM dbo.CTM_CronJob WHERE TaskFile = 'recordTodayReset' OR TaskName = '(EW) Record Today Reset'";
$sql_data['CronTask:RecordTodayReset']['Delete'] = "DELETE FROM dbo.CTM_CronJob WHERE TaskFile = 'recordTodayReset' OR TaskName = '(EW) Record Today Reset'";

$sql_data['CronTask:SynchronizeRanking']['Select'] = "SELECT Id FROM dbo.CTM_CronJob WHERE TaskFile = 'synchronizeRanking' OR TaskName = '(EW.MU) Synchronize Ranking Cache'";
$sql_data['CronTask:SynchronizeRanking']['Delete'] = "DELETE FROM dbo.CTM_CronJob WHERE TaskFile = 'synchronizeRanking' OR TaskName = '(EW.MU) Synchronize Ranking Cache'";

$sql_data['CronTask:SynchronizeVIP']['Select'] = "SELECT Id FROM dbo.CTM_CronJob WHERE TaskFile = 'synchronizeVIP' OR TaskName = '(MU) Synchronize VIP Accounts'";
$sql_data['CronTask:SynchronizeVIP']['Delete'] = "DELETE FROM dbo.CTM_CronJob WHERE TaskFile = 'synchronizeVIP' OR TaskName = '(MU) Synchronize VIP Accounts'";

$sql_data['CronTask:SynchronizeAccountsCoin']['Select'] = "SELECT Id FROM dbo.CTM_CronJob WHERE TaskFile = 'synchronizeAccountsCoin' OR TaskName = '(EW.MU) Synchronize Accounts Coin'";
$sql_data['CronTask:SynchronizeAccountsCoin']['Delete'] = "DELETE FROM dbo.CTM_CronJob WHERE TaskFile = 'synchronizeAccountsCoin' OR TaskName = '(EW.MU) Synchronize Accounts Coin'";