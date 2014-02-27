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
	IF((SELECT ConnectStat FROM MuOnline.dbo.MEMB_STAT WHERE memb___id = @Account) > 0)
	BEGIN
		IF(NOT EXISTS(SELECT 1 FROM MuOnline.dbo.EffectWebCoinCache WHERE Account = @Account))
			INSERT INTO MuOnline.dbo.EffectWebCoinCache (Account) VALUES (@Account);

		IF(@RowValue = 1)
			UPDATE MuOnline.dbo.EffectWebCoinCache SET RowValue_1 = RowValue_1 + @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
		ELSE IF(@RowValue = 2)
			UPDATE MuOnline.dbo.EffectWebCoinCache SET RowValue_2 = RowValue_2 + @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
		ELSE IF(@RowValue = 3)
			UPDATE MuOnline.dbo.EffectWebCoinCache SET RowValue_3 = RowValue_3 + @RowValue, UpdateDate = GETDATE() WHERE Account = @Account;
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
		UPDATE MuOnline.dbo.MEMB_INFO SET [Cash] = [Cash] + @RowValue WHERE memb___id = @Account;
	ELSE IF(@RowValue = 2)
		UPDATE MuOnline.dbo.MEMB_INFO SET [Gold] = [Gold] + @RowValue WHERE memb___id = @Account;
	ELSE IF(@RowValue = 3)
		UPDATE MuOnline.dbo.MEMB_INFO SET [Points] = [Points] + @RowValue WHERE memb___id = @Account;
END
END