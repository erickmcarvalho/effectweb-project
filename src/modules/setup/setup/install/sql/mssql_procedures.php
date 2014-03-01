<?php
/**
 *	Installation SQL Tables
 *	Generated on 22/10/2013 - 00:45h ()
*/

$install_procedures[] = array
(
	"db" => "system",
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => <<<SQL
-- =============================================
-- Effect Web DB Procedure: CTM_ChangePassword
-- Author: Erick-Master
-- Create date: 17/02/2012
-- Description: Change the password in user account
-- Parameters: [User account] [User password] [Use MD5 (1 = Yes / 0 = No)]
-- Result: void
-- =============================================
CREATE PROCEDURE [dbo].[CTM_ChangePassword]
@Account varchar(10),
@Password varchar(10),
@USE_MD5 int
AS
BEGIN

IF(@USE_MD5 = 1)
	EXEC dbo.CTM_EncodePassword @Account, @Password;
ELSE
	UPDATE {:mu_accounts:database:}.dbo.MEMB_INFO SET memb__pwd = @Password WHERE memb___id = @Account;

END
SQL
);

$install_procedures[] = array
(
	"db" => "system",
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => <<<SQL
-- =============================================
-- Effect Web DB Procedure: CTM_CheckAccount
-- Author: Erick-Master
-- Revision date: 05/09/2011
-- Description: Check the account data for authentication
-- Parameters: [User account] [User password] [Use MD5 (1 = Yes / 0 = No)]
-- Result: [0x00 = Fields void] [0x01 = Invalid data] [0x02 = All ok]
-- =============================================

CREATE PROCEDURE [dbo].[CTM_CheckAccount]
@Account varchar(10),
@Password varchar(10),
@USE_MD5 int
AS
BEGIN
DECLARE @Result tinyint;

IF ( @Account = '' OR @Password = '' )
BEGIN
	SET @Result = 0x00
END
ELSE
BEGIN
	IF ( @USE_MD5 = 1 )
	BEGIN
		DECLARE @hashPass binary(16);
		EXEC master..XP_MD5_EncodeKeyVal @Password, @Account, @hashPass OUT;

		IF ( NOT EXISTS ( SELECT * FROM {:mu_accounts:database:}.dbo.MEMB_INFO WHERE memb___id = @Account AND memb__pwd = @hashPass ) )
		BEGIN
			SET @Result = 0x01
		END
	END
	ELSE
	BEGIN
		IF ( NOT EXISTS ( SELECT * FROM {:mu_accounts:database:}.dbo.MEMB_INFO WHERE memb___id = @Account AND memb__pwd = @Password ) )
		BEGIN
			SET @Result = 0x01
		END
	END
END

SELECT
	CASE @Result
    	WHEN 0x00 THEN 0x01
        WHEN 0x01 THEN 0x02
        ELSE 0x03
    END AS Result
END
SQL
);

$install_procedures[] = array
(
	"db" => "system",
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => <<<SQL
-- =============================================
-- Effect Web DB Procedure: CTM_EncodePassword
-- Author: Erick-Master
-- Revision date: 17/02/2012
-- Description: Encode the password in MD5 MODE
-- Parameters: [User account] [User password]
-- Result: void
-- =============================================

CREATE PROCEDURE [dbo].[CTM_EncodePassword]
@Account VARCHAR(10),
@Password VARCHAR(10)
AS
BEGIN

DECLARE @Hash BINARY(16);
EXEC master..XP_MD5_EncodeKeyVal @Password, @Account, @Hash OUT;
UPDATE {:mu_accounts:database:}.dbo.MEMB_INFO SET memb__pwd = @Hash WHERE memb___id = @Account;

END
SQL
);

$install_procedures[] = array
(
	"db" => "system",
	"arguments" => array
	(
		"mu_accounts:database" => "var",
	),
	"query" => <<<SQL
-- =============================================
-- Effect Web DB Procedure: CTM_GetCastleSiege
-- Author: Erick-Master
-- Revision date: 16/03/2012
-- Description: Get the castle siege information in MuOnline database
-- Parameters: [ServerGroup = MuCastle_DATA.MAP_SVR_GROUP]
-- Result: [SiegeEndDate] [GuildOwner] [GuildMark] [ServerGroup]
-- =============================================
CREATE PROCEDURE [dbo].[CTM_GetCastleSiege]
	-- Add the parameters for the stored procedure here
	@ServerGroup int = NULL
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	DECLARE @SiegeEndDate varchar(5);
	DECLARE @GuildOwner varchar(8);
	DECLARE @GuildMark varbinary(32);
	
	IF ( @ServerGroup != NULL)
		SELECT @SiegeEndDate = CONVERT(varchar(5), SIEGE_END_DATE, 3), @GuildOwner = OWNER_GUILD FROM {:mu_accounts:database:}.dbo.MuCastle_DATA WHERE @ServerGroup = MAP_SVR_GROUP;
	ELSE
		SELECT TOP 1 @ServerGroup = MAP_SVR_GROUP, @SiegeEndDate = CONVERT(varchar(5), SIEGE_END_DATE, 3), @GuildOwner = OWNER_GUILD FROM {:mu_accounts:database:}.dbo.MuCastle_DATA ORDER BY MAP_SVR_GROUP DESC;
	
	IF ( @GuildOwner != '')
		SELECT @GuildMark = G_Mark FROM {:mu_accounts:database:}.dbo.Guild WHERE G_Name = @GuildOwner;
	ELSE
		SET @GuildMark = NULL;

	SELECT @SiegeEndDate AS SiegeEndDate, @GuildOwner AS GuildOwner, @GuildMark AS GuildMark, @ServerGroup AS ServerGroup;
END
SQL
);

$install_procedures[] = array
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

SELECT (Coin.[{:coin:column_1:}] + ISNULL(Cache.RowValue_1, 0)) AS RowValue_1, (Coin.[{:coin:column_2:}] + ISNULL(Cache.RowValue_2, 0)) AS RowValue_2, (Coin.[{:coin:column_3:}] + ISNULL(Cache.RowValue_3, 0)) AS RowValue_3 FROM [{:coin:database:}].[dbo].[{:coin:table:}] Coin LEFT JOIN [{:mu_general:database:}].[dbo].[EffectWebCoinCache] Cache ON (Cache.Account = Coin.[{:coin:login:}]) WHERE [Coin].[{:coin:login:}] = @Account;
END
SQL
);

$install_procedures[] = array
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
	IF((SELECT ConnectStat FROM [{:mu_accounts:database:}].dbo.MEMB_STAT WHERE memb___id = @Account) > 0)
	BEGIN
		IF(NOT EXISTS(SELECT 1 FROM [{:mu_general:database:}].dbo.EffectWebCoinCache WHERE Account = @Account))
			INSERT INTO [{:mu_general:database:}].dbo.EffectWebCoinCache (Account) VALUES (@Account);

		IF(@RowValue = 1)
			UPDATE [{:mu_general:database:}].dbo.EffectWebCoinCache SET RowValue_1 = RowValue_1 + @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
		ELSE IF(@RowValue = 2)
			UPDATE [{:mu_general:database:}].dbo.EffectWebCoinCache SET RowValue_2 = RowValue_2 + @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
		ELSE IF(@RowValue = 3)
			UPDATE [{:mu_general:database:}].dbo.EffectWebCoinCache SET RowValue_3 = RowValue_3 + @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
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
	IF(@RowValue = 1)
		UPDATE [{:coin:database:}].[dbo].[{:coin:table:}] SET [{:coin:column_1:}] = [{:coin:column_1:}] + @RowValue WHERE [{:coin:login:}] = @Account;
	ELSE IF(@RowValue = 2)
		UPDATE [{:coin:database:}].[dbo].[{:coin:table:}]  SET [{:coin:column_2:}] = [{:coin:column_2:}] + @RowValue WHERE [{:coin:login:}] = @Account;
	ELSE IF(@RowValue = 3)
		UPDATE [{:coin:database:}].[dbo].[{:coin:table:}]  SET [{:coin:column_3:}] = [{:coin:column_3:}] + @RowValue WHERE [{:coin:login:}] = @Account;
END
END
SQL
);

$install_procedures[] = array
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
	IF((SELECT ConnectStat FROM [{:mu_accounts:database:}].dbo.MEMB_STAT WHERE memb___id = @Account) > 0)
	BEGIN
		IF(NOT EXISTS(SELECT 1 FROM [{:mu_general:database:}].dbo.EffectWebCoinCache WHERE Account = @Account))
			INSERT INTO [{:mu_general:database:}].dbo.EffectWebCoinCache (Account) VALUES (@Account);

		IF(@RowValue = 1)
			UPDATE [{:mu_general:database:}].dbo.EffectWebCoinCache SET RowValue_1 = RowValue_1 - @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
		ELSE IF(@RowValue = 2)
			UPDATE [{:mu_general:database:}].dbo.EffectWebCoinCache SET RowValue_2 = RowValue_2 - @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
		ELSE IF(@RowValue = 3)
			UPDATE [{:mu_general:database:}].dbo.EffectWebCoinCache SET RowValue_3 = RowValue_3 - @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
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
	IF(@RowValue = 1)
		UPDATE [{:coin:database:}].[dbo].[{:coin:table:}] SET [{:coin:column_1:}] = [{:coin:column_1:}] - @RowValue WHERE [{:coin:login:}] = @Account;
	ELSE IF(@RowValue = 2)
		UPDATE [{:coin:database:}].[dbo].[{:coin:table:}]  SET [{:coin:column_2:}] = [{:coin:column_2:}] - @RowValue WHERE [{:coin:login:}] = @Account;
	ELSE IF(@RowValue = 3)
		UPDATE [{:coin:database:}].[dbo].[{:coin:table:}]  SET [{:coin:column_3:}] = [{:coin:column_3:}] - @RowValue WHERE [{:coin:login:}] = @Account;
END
END
SQL
);