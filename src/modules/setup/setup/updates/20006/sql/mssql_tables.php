<?php
/**
 *	Installation SQL Tables
 *	Generated on 22/10/2013 - 00:45h ()
*/

$update_tables[] = array
(
	"db" => "server",
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => <<<SQL
CREATE TABLE [{:mu_general:database:}].[dbo].[EffectWebCoinCache] (
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
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