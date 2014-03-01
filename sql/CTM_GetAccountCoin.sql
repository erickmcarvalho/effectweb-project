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

SELECT (Coin.[Cash] + ISNULL(Cache.RowValue_1, 0)) AS RowValue_1, (Coin.[Gold] + ISNULL(Cache.RowValue_2, 0)) AS RowValue_2, (Coin.[Points] + ISNULL(Cache.RowValue_3, 0)) AS RowValue_3 FROM [MuOnline].[dbo].[MEMB_INFO] Coin LEFT JOIN [MuOnline].[dbo].[EffectWebCoinCache] Cache ON (Cache.Account = Coin.[memb___id]) WHERE [Coin].[memb___id] = @Account;
END
GO
