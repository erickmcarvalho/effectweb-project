<?php
/**
 * Cetemaster Services
 * Effect Web 2 - MuOnline Suite Software
 *
 * CTM Installer: SQL Objects
 * Last Update: 13/06/2013 - 01:59h
 * Author: $CTM['Erick-Master']
 *
 * Cetemaster Services, Limited
 * Copyright (c) 2010-2013. All Rights Reserved, 
 * www.cetemaster.com.br / www.cetemaster.com
*/

$install_objects['CTM_AccountsBanneds'] = "table";
$install_objects['CTM_ChangeMail'] = "table";
$install_objects['CTM_CharactersBanneds'] = "table";
$install_objects['CTM_CharProfile'] = "table";
$install_objects['CTM_CronJob'] = "table";
$install_objects['CTM_Invoices'] = "table";
$install_objects['CTM_MemberStore'] = "table";
$install_objects['CTM_NoticeComments'] = "table";
$install_objects['CTM_Notices'] = "table";
$install_objects['CTM_Payments'] = "table";
$install_objects['CTM_PollAnswers'] = "table";
$install_objects['CTM_Polls'] = "table";
$install_objects['CTM_PollVotes'] = "table";
$install_objects['CTM_RecordLogs'] = "table";
$install_objects['CTM_RecoverData'] = "table";
$install_objects['CTM_TeamGroups'] = "table";
$install_objects['CTM_TeamMembers'] = "table";
$install_objects['CTM_TeamPermission'] = "table";
$install_objects['CTM_TGPermission'] = "table";
$install_objects['CTM_TicketReplies'] = "table";
$install_objects['CTM_Tickets'] = "table";
$install_objects['CTM_TMPermission'] = "table";
$install_objects['CTM_ValidatingAccounts'] = "table";
$install_objects['CTM_ChangePassword'] = "procedure";
$install_objects['CTM_CheckAccount'] = "procedure";
$install_objects['CTM_CreateCharacter'] = "procedure";
$install_objects['CTM_EncodePassword'] = "procedure";
$install_objects['CTM_GetCastleSiege'] = "procedure";
$install_objects['CTM_GetAccountCoin'] = "procedure";
$install_objects['CTM_MinusAccountCoin'] = "procedure";
$install_objects['CTM_PlusAccountCoin'] = "procedure";

$repair_objects['Server']['EffectWebVirtualVault'] = "table";
$repair_objects['Server']['MEMB_INFO'][VIP_COLUMN] = "column:integer:0";
$repair_objects['Server']['MEMB_INFO'][VIP_BEGIN] = "column:integer:0";
$repair_objects['Server']['MEMB_INFO'][VIP_TIME] = "column:integer:0";
$repair_objects['Server']['MEMB_INFO'][COIN_COLUMN_1] = "column:integer:0";
$repair_objects['Server']['MEMB_INFO'][COIN_COLUMN_2] = "column:integer:0";
$repair_objects['Server']['MEMB_INFO'][COIN_COLUMN_3] = "column:integer:0";
$repair_objects['Server']['MEMB_INFO']['RegisterDate'] = "column";
$repair_objects['Server']['MEMB_INFO']['MemberBirth'] = "column";
$repair_objects['Server']['MEMB_INFO']['MemberSex'] = "column";
$repair_objects['Server']['MEMB_INFO']['MemberStatus'] = "column:integer:0";
$repair_objects['Server']['Character'][COLUMN_RESET] = "column:integer:0";
$repair_objects['Server']['Character'][COLUMN_RDAILY] = "column:integer:0";
$repair_objects['Server']['Character'][COLUMN_RWEEKLY] = "column:integer:0";
$repair_objects['Server']['Character'][COLUMN_RMONTHLY] = "column:integer:0";
$repair_objects['Server']['Character'][COLUMN_MRESET] = "colum:integer:0";
$repair_objects['Server']['Character'][COLUMN_MRDAILY] = "column:integer:0";
$repair_objects['Server']['Character'][COLUMN_MRWEEKLY] = "column:integer:0";
$repair_objects['Server']['Character'][COLUMN_MRMONTHLY] = "column:integer:0";
$repair_objects['Server']['Character'][COLUMN_PKCOUNT] = "column:integer:0";
$repair_objects['Server']['Character'][COLUMN_HEROCOUNT] = "column:integer:0";
$repair_objects['Server']['Character'][COLUMN_CHARIMAGE] = "column:integer:0";