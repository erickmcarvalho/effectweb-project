<?php
/**
 *	Installation SQL Tables
 *	Generated on 09/06/2013 - 05:52h ()
*/

$update_tables[] = array
(
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