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

SELECT (Coin.[Cash] + Cache.RowValue_1) AS RowValue_1, (Coin.[Gold] + Cache.RowValue_2) AS RowValue_2, (Coin.[Points] + Cache.RowValue_3) AS RowValue_3 FROM [MuOnline].[dbo].[MEMB_INFO] Coin LEFT JOIN [MuOnline].[dbo].[EffectWebCoinCache] Cache ON (Cache.Account = Coin.[memb___id]) WHERE [Coin].[memb___id] = @Account;
END
GO
