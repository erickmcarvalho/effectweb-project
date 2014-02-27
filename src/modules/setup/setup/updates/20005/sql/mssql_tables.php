<?php
/**
 *	Installation SQL Tables
 *	Generated on 14/09/2013 - 02:58h ()
*/

$update_tables[] = array
(
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