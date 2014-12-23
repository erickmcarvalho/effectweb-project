<?php
/**
 *	Installation SQL Tables
 *	Generated on 22/10/2013 - 00:45h ()
*/

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_AccountsBanneds] (
	[BanId] [int] IDENTITY (1, 1) NOT NULL ,
	[Responsible] [varchar] (50) NOT NULL ,
	[Account] [varchar] (50) NOT NULL ,
	[Expiration] [numeric](18, 0) NOT NULL ,
	[Reason] [varchar] (300) NULL 
) ON [PRIMARY]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_ChangeMail] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) NOT NULL ,
	[ConfirmCode] [varchar] (23) NOT NULL ,
	[Expiration] [int] NOT NULL 
) ON [PRIMARY]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_CharactersBanneds] (
	[BanId] [int] IDENTITY (1, 1) NOT NULL ,
	[Responsible] [varchar] (50) NOT NULL ,
	[Character] [varchar] (50) NOT NULL ,
	[Account] [varchar] (50) NOT NULL ,
	[Expiration] [numeric](18, 0) NOT NULL ,
	[Reason] [varchar] (300) NULL 
) ON [PRIMARY]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_CharProfile] (
	[Name] [varchar] (10) NOT NULL ,
	[ShowProfile] [int] NOT NULL ,
	[ShowSkills] [int] NOT NULL ,
	[ShowResets] [int] NOT NULL ,
	[ShowMap] [int] NOT NULL ,
	[ShowStatus] [int] NOT NULL 
) ON [PRIMARY]

ALTER TABLE [dbo].[CTM_CharProfile] ADD 
	CONSTRAINT [DF_CTM_CharProfile_ShowProfile] DEFAULT (1) FOR [ShowProfile],
	CONSTRAINT [DF_CTM_CharProfile_ShowSkills] DEFAULT (1) FOR [ShowSkills],
	CONSTRAINT [DF_CTM_CharProfile_ShowResets] DEFAULT (1) FOR [ShowResets],
	CONSTRAINT [DF_CTM_CharProfile_ShowMap] DEFAULT (1) FOR [ShowMap],
	CONSTRAINT [DF_CTM_CharProfile_ShowStatus] DEFAULT (1) FOR [ShowStatus]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_CronJob] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[TaskName] [varchar] (50) NOT NULL ,
	[TaskDescription] [text] NULL ,
	[TaskFile] [varchar] (50) NOT NULL ,
	[Switch] [int] NOT NULL ,
	[LastExecution] [numeric](18, 0) NULL ,
	[NextExecution] [numeric](18, 0) NULL ,
	[BeginDate] [int] NOT NULL ,
	[EndDate] [int] NOT NULL ,
	[OccurOptions] [varchar] (50) NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

ALTER TABLE [dbo].[CTM_CronJob] WITH NOCHECK ADD 
	CONSTRAINT [DF_CTM_CronJob_Switch] DEFAULT (0) FOR [Switch],
	CONSTRAINT [DF_CTM_CronJob_CurrentExecution] DEFAULT (0) FOR [LastExecution],
	CONSTRAINT [DF_CTM_CronJob_BeginDate] DEFAULT (0) FOR [BeginDate],
	CONSTRAINT [DF_CTM_CronJob_EndDate] DEFAULT (0) FOR [EndDate]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_Invoices] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) NOT NULL ,
	[Document] [varchar] (50) NULL ,
	[StartDate] [int] NOT NULL ,
	[EndDate] [int] NOT NULL ,
	[Value] [varchar] (15) NOT NULL ,
	[CoinQuantity] [int] NOT NULL ,
	[PaymentMethod] [varchar] (50) NOT NULL ,
	[PaymentData] [text] NULL ,
	[Status] [int] NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

ALTER TABLE [dbo].[CTM_Invoices] WITH NOCHECK ADD 
	CONSTRAINT [DF_CTM_Invoi_StartDate] DEFAULT (0) FOR [StartDate],
	CONSTRAINT [DF_CTM_Invoi_EndDate] DEFAULT (0) FOR [EndDate],
	CONSTRAINT [DF_CTM_Invoi_Value] DEFAULT (0.00) FOR [Value],
	CONSTRAINT [DF_CTM_Invoi_CoinQuantity] DEFAULT (0) FOR [CoinQuantity],
	CONSTRAINT [DF_CTM_Invoi_PaidMethod] DEFAULT ('none') FOR [PaymentMethod],
	CONSTRAINT [DF_CTM_Invoi_Status] DEFAULT (0) FOR [Status]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_MemberStore] (
	[Account] [varchar] (50) NOT NULL ,
	[FreePurchase] [varbinary] (3) NOT NULL 
) ON [PRIMARY]

ALTER TABLE [dbo].[CTM_MemberStore] WITH NOCHECK ADD 
	CONSTRAINT [DF_CTM_MemberStore_FreePurchase] DEFAULT (0x000000) FOR [FreePurchase]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_NoticeComments] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[NoticeID] [int] NOT NULL ,
	[Account] [varchar] (50) NOT NULL ,
	[Author] [varchar] (50) NOT NULL ,
	[Date] [int] NOT NULL ,
	[Text] [text] NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_Notices] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Title] [varchar] (8000) NOT NULL ,
	[Date] [int] NOT NULL ,
	[Account] [varchar] (50) NOT NULL ,
	[Text] [text] NOT NULL ,
	[CommentSwitch] [int] NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

ALTER TABLE [dbo].[CTM_Notices] WITH NOCHECK ADD 
	CONSTRAINT [DF_CTM_WebNews_Comment] DEFAULT (1) FOR [CommentSwitch]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_Payments] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) NOT NULL ,
	[InvoiceId] [int] NOT NULL ,
	[Status] [int] NOT NULL ,
	[ConfirmDate] [numeric](18, 0) NOT NULL ,
	[Method] [int] NOT NULL ,
	[Date] [varchar] (50) NOT NULL ,
	[Hour] [varchar] (50) NOT NULL ,
	[Value] [varchar] (50) NOT NULL ,
	[Local] [varchar] (50) NOT NULL ,
	[ConfirmData] [text] NULL ,
	[Message] [text] NULL ,
	[Annex] [varchar] (50) NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

ALTER TABLE [dbo].[CTM_Payments] WITH NOCHECK ADD 
	CONSTRAINT [DF_CTM_Payments_Status] DEFAULT (0) FOR [Status]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_PollAnswers] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[PollId] [int] NOT NULL ,
	[Answer] [varchar] (400) NOT NULL ,
	[Votes] [int] NOT NULL 
) ON [PRIMARY]

ALTER TABLE [dbo].[CTM_PollAnswers] WITH NOCHECK ADD 
	CONSTRAINT [DF_CTM_PollAnswers_Votes] DEFAULT (0) FOR [Votes]
SQL
);


$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_Polls] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Question] [varchar] (400) NOT NULL ,
	[BeginDate] [int] NOT NULL ,
	[EndDate] [int] NOT NULL ,
	[Status] [int] NOT NULL 
) ON [PRIMARY]

ALTER TABLE [dbo].[CTM_Polls] WITH NOCHECK ADD 
	CONSTRAINT [DF_CTM_Polls_Status] DEFAULT (0) FOR [Status]
SQL
);


$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_PollVotes] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) NOT NULL ,
	[PollID] [int] NOT NULL ,
	[AnswerID] [int] NOT NULL 
) ON [PRIMARY]
SQL
);


$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_RecordLogs] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Date] [varchar] (50) NOT NULL ,
	[Hour] [varchar] (50) NOT NULL ,
	[Record] [int] NOT NULL 
) ON [PRIMARY]

ALTER TABLE [dbo].[CTM_RecordLogs] WITH NOCHECK ADD 
	CONSTRAINT [DF_CTM_RecordLogs_Record] DEFAULT (0) FOR [Record]
SQL
);


$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_RecoverData] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (10) NOT NULL ,
	[RedefineCode] [varchar] (23) NOT NULL ,
	[Expiration] [int] NOT NULL 
) ON [PRIMARY]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_TeamGroups] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Name] [varchar] (200) NOT NULL ,
	[FormatPrefix] [varchar] (600) NULL ,
	[FormatSuffix] [varchar] (600) NULL ,
	[GroupTitle] [varchar] (50) NOT NULL ,
	[ACP_Access] [int] NOT NULL 
) ON [PRIMARY]

ALTER TABLE [dbo].[CTM_TeamGroups] WITH NOCHECK ADD 
	CONSTRAINT [DF_CTM_TeamGroups_FormatPrefix] DEFAULT (null) FOR [FormatPrefix],
	CONSTRAINT [DF_CTM_TeamGroups_FormatSuffix] DEFAULT (null) FOR [FormatSuffix],
	CONSTRAINT [DF_CTM_TeamGroups_ACP_Access] DEFAULT (0) FOR [ACP_Access]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_TeamMembers] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) NOT NULL ,
	[Name] [varchar] (50) NOT NULL ,
	[Contact] [varchar] (300) NULL ,
	[CustomTitle] [varchar] (50) NULL ,
	[PrimaryGroup] [int] NOT NULL ,
	[SecondaryGroups] [text] NULL ,
	[ACP_Access] [int] NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

ALTER TABLE [dbo].[CTM_TeamMembers] WITH NOCHECK ADD 
	CONSTRAINT [DF_CTM_WebStaff_CustomTitle] DEFAULT (null) FOR [CustomTitle],
	CONSTRAINT [DF_CTM_WebStaff_type] DEFAULT (0) FOR [PrimaryGroup],
	CONSTRAINT [DF_CTM_TeamMembers_ACP_Access] DEFAULT (0) FOR [ACP_Access]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_TeamPermission] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[RowType] [varchar] (50) NOT NULL ,
	[RowValue] [varchar] (50) NOT NULL ,
	[PermissionCache] [text] NULL ,
	[IsAdmin] [int] NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]

ALTER TABLE [dbo].[CTM_TeamPermission] WITH NOCHECK ADD 
	CONSTRAINT [DF_CTM_TeamPermission_IsAdmin] DEFAULT (0) FOR [IsAdmin]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_TicketReplies] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[TicketID] [int] NOT NULL ,
	[Author] [varchar] (50) NOT NULL ,
	[Account] [varchar] (50) NOT NULL ,
	[Date] [numeric](18, 0) NOT NULL ,
	[Message] [text] NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_Tickets] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) NOT NULL ,
	[Character] [varchar] (50) NOT NULL ,
	[Protocol] [varchar] (10) NOT NULL ,
	[Status] [int] NOT NULL ,
	[Subject] [varchar] (2000) NOT NULL ,
	[Departament] [int] NOT NULL ,
	[Date] [int] NOT NULL ,
	[Text] [text] NOT NULL ,
	[Annex] [varchar] (50) NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
SQL
);

$install_tables[] = array
(
	"db" => "system",
	"query" => <<<SQL
CREATE TABLE [dbo].[CTM_ValidatingAccounts] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) NOT NULL ,
	[Name] [varchar] (50) NOT NULL ,
	[Mail] [varchar] (50) NOT NULL ,
	[ConfirmCode] [varchar] (23) NOT NULL ,
	[ConfirmDate] [int] NULL ,
	[Confirmed] [int] NOT NULL 
) ON [PRIMARY]

ALTER TABLE [dbo].[CTM_ValidatingAccounts] WITH NOCHECK ADD 
	CONSTRAINT [DF_CTM_RegisterData_ConfirmDate] DEFAULT (0) FOR [ConfirmDate],
	CONSTRAINT [DF_CTM_RegisterData_Status] DEFAULT (0) FOR [Confirmed]
SQL
);

$install_tables[] = array
(
	"db" => "server",
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => <<<SQL
CREATE TABLE [{:mu_general:database:}].[dbo].[EffectWebVirtualVault] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50)  NOT NULL ,
	[ItemSerial] [varbinary] (4) NOT NULL ,
	[ItemHex] [varbinary] (16) NOT NULL ,
	[SendDate] [int] DEFAULT 0 NOT NULL 
) ON [PRIMARY]
SQL
);

$install_tables[] = array
(
	"db" => "server",
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => <<<SQL
CREATE TABLE [{:mu_general:database:}].[dbo].[EffectWebCoinCache] (
	[Account] [varchar] (50) NOT NULL ,
	[RowValue_1] [int] NOT NULL ,
	[RowValue_2] [int] NOT NULL ,
	[RowValue_3] [int] NOT NULL ,
	[UpdateDate] [datetime] NOT NULL 
) ON [PRIMARY]

ALTER TABLE [{:mu_general:database:}].[dbo].[EffectWebCoinCache] ADD 
	CONSTRAINT [DF_EffectWebCoinCache_RowType] DEFAULT (0) FOR [RowValue_1],
	CONSTRAINT [DF_EffectWebCoinCache_RowValue] DEFAULT (0) FOR [RowValue_2],
	CONSTRAINT [DF_EffectWebCoinCache_RowValue_3] DEFAULT (0) FOR [RowValue_3],
	CONSTRAINT [DF_EffectWebCoinCache_DateUpdate] DEFAULT (getdate()) FOR [UpdateDate]
SQL
);
