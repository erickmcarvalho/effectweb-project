<?php
/**
 *	Installation SQL Alters
 *	Generated on 28/04/2013 - 17:00h ()
*/

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_accounts:database:}.dbo.MEMB_INFO ADD ".VIP_COLUMN." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_accounts:database:}.dbo.MEMB_INFO ADD ".VIP_BEGIN." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_accounts:database:}.dbo.MEMB_INFO ADD ".VIP_TIME." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_accounts:database:}.dbo.MEMB_INFO ADD ".COIN_COLUMN_1." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_accounts:database:}.dbo.MEMB_INFO ADD ".COIN_COLUMN_2." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_accounts:database:}.dbo.MEMB_INFO ADD ".COIN_COLUMN_3." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_accounts:database:}.dbo.MEMB_INFO ADD RegisterDate int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_accounts:database:}.dbo.MEMB_INFO ADD MemberBirth varchar(50) NULL",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_accounts:database:}.dbo.MEMB_INFO ADD MemberSex varchar(50) NULL",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_accounts:database:}.dbo.MEMB_INFO ADD MemberStatus int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_general:database:}.dbo.Character ADD ".COLUMN_RESET." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_general:database:}.dbo.Character ADD ".COLUMN_RDAILY." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_general:database:}.dbo.Character ADD ".COLUMN_RWEEKLY." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_general:database:}.dbo.Character ADD ".COLUMN_RMONTHLY." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_general:database:}.dbo.Character ADD ".COLUMN_MRESET." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_general:database:}.dbo.Character ADD ".COLUMN_MRDAILY." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_general:database:}.dbo.Character ADD ".COLUMN_MRWEEKLY." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_general:database:}.dbo.Character ADD ".COLUMN_MRMONTHLY." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_general:database:}.dbo.Character ADD ".COLUMN_PKCOUNT." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_general:database:}.dbo.Character ADD ".COLUMN_HEROCOUNT." int NOT NULL DEFAULT 0",
);

$install_alters[] = array
(
	"arguments" => array
	(
		"mu_general:database" => "var",
	),
	"query" => "ALTER TABLE {:mu_general:database:}.dbo.Character ADD ".COLUMN_CHARIMAGE." varchar(50) NULL",
);
