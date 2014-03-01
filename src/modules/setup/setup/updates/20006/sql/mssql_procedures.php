<?php
/**
 *	Installation SQL Tables
 *	Generated on 22/10/2013 - 00:45h ()
*/

$update_procedures[] = array
(
		"db" => "system",
		"arguments" => array
		(
			"mu_general:database" => "var",
			"coin:database" => "var",
			"coin:table" => "var",
			"coin:column_1" => "var",
			"coin:column_2" => "var",
			"coin:column_3" => "var",
			"coin:login" => "var",
		),
		"query" => <<<SQL
-- =============================================
-- Effect Web DB Procedure: CTM_GetAccountCoin
-- Author: Erick-Master
-- Revision date: 28/09/2013
-- Description: Get the real coin by Account
-- Parameters: [User account]
-- Result: SELECT RowValue_1, RowValue_2, RowValue_3
-- =============================================

CREATE PROCEDURE [dbo].[CTM_GetAccountCoin]
@Account varchar(10)
AS
BEGIN

SELECT (Coin.[{:coin:column_1:}] + ISNULL(Cache.RowValue_1, 0)) AS RowValue_1, (Coin.[{:coin:column_2:}] + ISNULL(Cache.RowValue_2, 0)) AS RowValue_2, (Coin.[{:coin:column_3:}] + ISNULL(Cache.RowValue_3, 0) AS RowValue_3 FROM [{:coin:database:}].[dbo].[{:coin:table:}] Coin LEFT JOIN [{:mu_general:database:}].[dbo].[EffectWebCoinCache] Cache ON (Cache.Account = Coin.[{:coin:login:}]) WHERE [Coin].[{:coin:login:}] = @Account;
END
SQL
);

$update_procedures[] = array
(
		"db" => "system",
		"arguments" => array
		(
			"mu_accounts:database" => "var",
			"mu_general:database" => "var",
			"coin:database" => "var",
			"coin:table" => "var",
			"coin:column_1" => "var",
			"coin:column_2" => "var",
			"coin:column_3" => "var",
			"coin:login" => "var",
		),
		"query" => <<<SQL
-- =============================================
-- Effect Web DB Procedure: CTM_PlusAccountCoin
-- Author: Erick-Master
-- Revision date: 28/09/2013
-- Description: Update the real coin in Account [plus]
-- Parameters: [User account] [Row Type] [RowValue] [Use Cache]
-- Result: Void
-- =============================================

CREATE PROCEDURE [dbo].[CTM_PlusAccountCoin]
@Account varchar(10),
@RowType int,
@RowValue int,
@EnableCache int
AS
BEGIN
DECLARE @UpdateData int;
SET @UpdateData = 0;

IF(@EnableCache = 1)
BEGIN
	IF((SELECT ConnectStat FROM [MuOnline].dbo.MEMB_STAT WHERE memb___id = @Account) > 0)
	BEGIN
		IF(NOT EXISTS(SELECT 1 FROM [MuOnline].dbo.EffectWebCoinCache WHERE Account = @Account))
			INSERT INTO [MuOnline].dbo.EffectWebCoinCache (Account) VALUES (@Account);

		IF(@RowType = 1)
			UPDATE [MuOnline].dbo.EffectWebCoinCache SET RowValue_1 = RowValue_1 + @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
		ELSE IF(@RowType = 2)
			UPDATE [MuOnline].dbo.EffectWebCoinCache SET RowValue_2 = RowValue_2 + @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
		ELSE IF(@RowType = 3)
			UPDATE [MuOnline].dbo.EffectWebCoinCache SET RowValue_3 = RowValue_3 + @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
	END
	ELSE
	BEGIN
		SET @UpdateData = 1;
	END
END
ELSE
BEGIN
SET @UpdateData = 1;
END

IF(@UpdateData = 1)
BEGIN
	IF(@RowType = 1)
		UPDATE [MuOnline].[dbo].[MEMB_INFO] SET [Cash] = [Cash] + @RowValue WHERE [memb___id] = @Account;
	ELSE IF(@RowType = 2)
		UPDATE [MuOnline].[dbo].[MEMB_INFO]  SET [Gold] = [Gold] + @RowValue WHERE [memb___id] = @Account;
	ELSE IF(@RowType = 3)
		UPDATE [MuOnline].[dbo].[MEMB_INFO]  SET [Point] = [Point] + @RowValue WHERE [memb___id] = @Account;
END
END
SQL
);

$update_procedures[] = array
(
		"db" => "system",
		"arguments" => array
		(
			"mu_accounts:database" => "var",
			"mu_general:database" => "var",
			"coin:database" => "var",
			"coin:table" => "var",
			"coin:column_1" => "var",
			"coin:column_2" => "var",
			"coin:column_3" => "var",
			"coin:login" => "var",
		),
		"query" => <<<SQL
-- =============================================
-- Effect Web DB Procedure: CTM_MinusAccountCoin
-- Author: Erick-Master
-- Revision date: 28/09/2013
-- Description: Update the real coin in Account [minus]
-- Parameters: [User account] [Row Type] [RowValue] [Use Cache]
-- Result: Void
-- =============================================

CREATE PROCEDURE [dbo].[CTM_MinusAccountCoin]
@Account varchar(10),
@RowType int,
@RowValue int,
@EnableCache int
AS
BEGIN
DECLARE @UpdateData int;
SET @UpdateData = 0;

IF(@EnableCache = 1)
BEGIN
	IF((SELECT ConnectStat FROM [MuOnline].dbo.MEMB_STAT WHERE memb___id = @Account) > 0)
	BEGIN
		IF(NOT EXISTS(SELECT 1 FROM [MuOnline].dbo.EffectWebCoinCache WHERE Account = @Account))
			INSERT INTO [MuOnline].dbo.EffectWebCoinCache (Account) VALUES (@Account);

		IF(@RowType = 1)
			UPDATE [MuOnline].dbo.EffectWebCoinCache SET RowValue_1 = RowValue_1 - @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
		ELSE IF(@RowType = 2)
			UPDATE [MuOnline].dbo.EffectWebCoinCache SET RowValue_2 = RowValue_2 - @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
		ELSE IF(@RowType = 3)
			UPDATE [MuOnline].dbo.EffectWebCoinCache SET RowValue_3 = RowValue_3 - @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
	END
	ELSE
	BEGIN
		SET @UpdateData = 1;
	END
END
ELSE
BEGIN
SET @UpdateData = 1;
END

IF(@UpdateData = 1)
BEGIN
	IF(@RowType = 1)
		UPDATE [MuOnline].[dbo].[MEMB_INFO] SET [Cash] = [Cash] - @RowValue WHERE [memb___id] = @Account;
	ELSE IF(@RowType = 2)
		UPDATE [MuOnline].[dbo].[MEMB_INFO]  SET [Gold] = [Gold] - @RowValue WHERE [memb___id] = @Account;
	ELSE IF(@RowType = 3)
		UPDATE [MuOnline].[dbo].[MEMB_INFO]  SET [Point] = [Point] - @RowValue WHERE [memb___id] = @Account;
END
END
SQL
);