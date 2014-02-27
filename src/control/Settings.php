<?php
// *************************************************************** //
// * Effect Web 2 - MuOnline Suite Software                      * //
// * Version: 2.0 Beta 8                                         * //
// * Build: 2.0.0.7                                              * //
// * Release Date: 19/02/2014                                    * //
// *************************************************************** //
// * System Production: Erick-Master (CTM Director/Programmer)   * //
// * System Production: Litlle       (CTM Director/Programmer)   * //
// * Design Production: LucasHP      (CTM Director/Web Designer) * //
// *************************************************************** //
// * Cetemaster Services, Limited                                * //
// * Copyright (c) 2010-2013. All Rights Reserved,               * //
// * www.cetemaster.com.br / www.cetemaster.com                  * //
// *************************************************************** //
// * Sales: vendas@cetemaster.com.br                             * //
// * Support: suporte@cetemaster.com.br                          * //
// * Contact: contato@cetemaster.com.br                          * //
// *                                                             * //
// * Portal: http://www.cetemaster.com.br                        * //
// * Forums: http://forum.cetemaster.com.br                      * //
// * Store: http://store.cetemaster.com.br                       * //
// *************************************************************** //

/*****************************************************************************
	@ MSSQL Settings
	@ Configurações do Servidor Microsoft SQL Server
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
define("MSSQL_HOSTNAME", "127.0.0.1"); // -- Host do MSSQL (Padrão -> 127.0.0.1)
define("MSSQL_HOSTPORT", 1433); // -- Porta do MSSQL (Padrão -> 1433)
define("MSSQL_USERNAME", "sa"); // -- Úsuario do MSSQL (Padrão -> sa)
define("MSSQL_PASSWORD", "123456"); // -- Senha do MSSQL
define("MSSQL_PERSISTENT", FALSE); // -- Ativar conexão persistente do MSSQL (Padrão -> FALSE)

/*****************************************************************************
	@ Database Settings
	@ Configurações dos bancos de dados
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
define("CTMEW_CORE", "CTM_EffectWeb"); // -- DataBase do Web Site (Padrão -> CTM_EffectWeb)
define("MUACC_CORE", "MuOnline"); // -- DataBase das contas [Geralmente = Me_MuOnline] (Padrão -> MuOnline)
define("MUGEN_CORE", "MuOnline"); // -- DataBase geral do server (Padrão -> MuOnline)
define("COLUMN_RESET", "Resets"); // -- Colunna de Resets (Padrão -> Resets)
define("COLUMN_RDAILY", "ResetsDaily"); // -- Coluna dos Resets Diários (Padrão -> ResetsDaily)
define("COLUMN_RWEEKLY", "ResetsWeekly"); // -- Coluna dos Resets Semanais (Padrão -> ResetsWeekly)
define("COLUMN_RMONTHLY", "ResetsMonthly"); // -- Coluna dos Resets Mensais (Padrão -> ResetsMonthly)
define("COLUMN_MRESET", "MResets"); // -- Colunna de Master Resets (Padrão -> MResets)
define("COLUMN_MRDAILY", "MResetsDaily"); // -- Columna de Master Reset Diário (Padrão -> MResetsDaily)
define("COLUMN_MRWEEKLY", "MResetsWeekly"); // -- Column de Master Reset Semanal (Padrão -> MResetsWeekly)
define("COLUMN_MRMONTHLY", "MResetsMonthly"); // -- Column de Master Reset Mensal (Padrão -> MResetsMonthly)
define("COLUMN_COMMAND", "Leadership"); // -- Coluna de Comando (Padrão -> Leadership)
define("COLUMN_CHARIMAGE", "CharImage"); // -- Coluna de imagem pessoal dos chars (Padrão -> CharImage)
define("COLUMN_PKCOUNT", "CharPkCount"); // -- Coluna de PK Count, não deixe PkCount (Padrão -> CharPkCount)
define("COLUMN_HEROCOUNT", "CharHeroCount"); // -- Columna de Hero Count, não deixe PkCount (Padrão -> CharHeroCount)

/*****************************************************************************
	@ Mailer Settings
	@ Configurações do sistema de E-Mails
	@ TYPE 1 : Envio de E-Mails por servidor SMTP (Recomendado)
	@ TYPE 2 : Envio de E-Mails por PHP mail()
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
$CTM_SETTINGS['MAILER']['TYPE'] = 1; // -- Tipo de envio (Padrão -> 1)
$CTM_SETTINGS['MAILER']['FROM'] = "xxxxxxxxx"; // -- Remetente dos E-Mails
//----------------------------------------------------------------------
// SMTP Settings
// Somente para o TYPE = 1
//----------------------------------------------------------------------
$CTM_SETTINGS['MAILER']['SMTP']['HOST'] = "xxxxxxxxx"; // -- Host do Servidor SMTP (Padrão -> localhost)
$CTM_SETTINGS['MAILER']['SMTP']['PORT'] = 26; // -- Porta do Servidor SMTP (Padrão -> 25)
$CTM_SETTINGS['MAILER']['SMTP']['USER'] = "xxxxxxxxx"; // -- Usuario do Servidor SMTP (Padrão -> Vazio)
$CTM_SETTINGS['MAILER']['SMTP']['PASS'] = "xxxxxxxxx"; // -- Senha do Servidor SMTP (Padrão -> Vazio)
$CTM_SETTINGS['MAILER']['SMTP']['HELO'] = 1; // -- Server helo [0 = HELO | 1 = EHLO] (Padrão -> 1)
$CTM_SETTINGS['MAILER']['SMTP']['SECURE'] = 0; // -- Tipo de segurança [0 = Normal | 1 = SSL | 2 = TLS] (Padrão -> 0)

/*****************************************************************************
	@ MuServer Settings
	@ Configurações do Servidor
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
define("USE_MD5", 0); // -- Registro de senhas em MD5 [1 = Sim / 0 = Não] (Padrão -> 0)
define("VI_CURR_INFO", FALSE); // -- Registrar dados na Tabela VI_CURR_INFO (JoinServer com sistema de idade) (Padrão -> FALSE)
define("CTLCODE_GAMEMASTER", 32); // -- CtlCode do Game Master (Mesmo de Admin) (Padrão -> 32 = Season 2/Superior | 8 = Season 1/Inferior)
define("MAX_STRENGTH", 65000); // -- Maximo de Pontos [Força]
define("MAX_DEXTERITY", 65000); // -- Maximo de Pontos [Agilidade]
define("MAX_VITALITY", 65000); // -- Maximo de Pontos [Vitalidade]
define("MAX_ENERGY", 65000); // -- Maximo de Pontos [Energia]
define("MAX_COMMAND", 65000); // -- Maximo de Pontos [Comando]
define("MAX_LEVEL", 400); // -- Level Máximo (Padrão -> 400)
define("MAX_MLEVEL", 200); // -- Master Level Máximo [Season 3 EP2 / Superior] (Padrão -> 200)
define("GAMESERVER_HOST", "127.0.0.1"); // -- IP/Host do GameServer Geral (Padrão -> 127.0.0.1)
define("GAMESERVER_PORT", 55901); // -- Porta do GameServer Geral (Padrão -> 55901)
/******************* Server Version ********************
	@ 0 = 99B / Inferior
	@ 1 = 99Z
	@ 2 = 1.0 / Season 1
	@ 3 = Season 2
	@ 4 = Season 3 EP1
	@ 5 = Season 3 EP2
	@ 6 = Season 4
	@ 7 = Season 5
	@ 8 = Season 6 EP1
	@ 9 = Season 6 EP2
*******************************************************/
define("MUSERVER_VERSION", 8); // -- Server Version
/****************** Server Files **********************
	@ 0 = X-Team Season 6
	@ 1 = WH Team Season 4
	@ 2 = SCFMuTeam Season 6
	@ 3 = ENCGames Season 6
	@ 4 = Outros
*******************************************************/
define("SERVER_FILES", 2); // -- Server Files
/******************* Warehouse ************************
	@ Configurações do Baú
******************************************************/
$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['CORE']['USE'] = TRUE;// -- O Servidor contem sistema de Baú Extra? (/ware | /bau)

$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['CORE']['NUMBER'][0] = 2; // -- Número de Baús Extras [Free]
$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['CORE']['NUMBER'][1] = 3; // -- Número de Baús Extras [VIP 1]
$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['CORE']['NUMBER'][2] = 4; // -- Número de Baús Extras [VIP 2]
$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['CORE']['NUMBER'][3] = 5; // -- Número de Baús Extras [VIP 3]
$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['CORE']['NUMBER'][4] = 6; // -- Número de Baús Extras [VIP 4]
$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['CORE']['NUMBER'][5] = 7; // -- Número de Baús Extras [VIP 5]

$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['DATA']['TABLE'] = "ExtWarehouse"; // -- Table do Baú Extra (Padrão -> ExtWarehouse)
$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['DATA']['ITEM'] = "Items"; // -- Coluna de Itens do Baú Extra (Padrão -> Items)
$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['DATA']['LOGIN'] = "AccountID"; // -- Coluna de Login do Baú Extra (Padrão -> AccountID)
$CTM_SETTINGS['VAULT']['EXT_WAREHOUSE']['DATA']['NUMBER'] = "Number"; // -- Coluna de Número do Baú Extra (Padrão -> Number)
/***************** Register Bonus **********************
	@ Configurações do Bônus ao Cadastrar
*******************************************************/
$CTM_SETTINGS['BONUS']['CREATE_CHAR']['SET_RESETS'] = 10; // -- Quantidade de Resets  inseridas ao criar o Char
$CTM_SETTINGS['BONUS']['CREATE_CHAR']['SET_POINTS'] = 0; // -- Quantidade de pontos para distribuir ao criar o Char
/****************** Master Level **********************
	@ Configurações do Master Skill Tree
	@ Somente Season 3 EP2 / Superior
	@ Somente SERVER_FILES = Outros
******************************************************/
$CTM_SETTINGS['MASTERLEVEL']['DATA']['TABLE'] = "MasterLevel"; // -- Table do Master Level (Padrão -> T_MasterLevelSystem)
$CTM_SETTINGS['MASTERLEVEL']['DATA']['NAME'] = "Name"; // -- Coluna do Char Name (Padrão -> CHAR_NAME)
$CTM_SETTINGS['MASTERLEVEL']['DATA']['LEVEL'] = "MasterLevel"; // -- Coluna do Master Level (Padrão -> MASTER_LEVEL)
$CTM_SETTINGS['MASTERLEVEL']['DATA']['POINTS'] = "MasterPoints"; // -- Coluna do Master Points (Padrão -> ML_POINT)

/*****************************************************************************
	@ Web General Settings
	@ Configurações do sistema do Web Site
*****************************************************************************/
define("SERVER_LOCATION", 1); // -- Localidade de sua Hospedagem [0 = USA] [1 = BR] (Padrão -> 0)
define("INFO_CHAR_SWITCH", TRUE); // -- Ativar/Desativar página de informações do Char (Padrão -> TRUE)
define("INFO_GUILD_SWITCH", TRUE); // -- Ativar/Desativar página de informações da Guild (Padrão -> TRUE)
define("LOADING_PAGE_AJAX", TRUE); // -- Carregamnento completo das páginas em ajax (Padrão -> FALSE)
define("SHOW_MESSAGE_TYPE", 0); // -- Tipo de exbição de aletas [0 = Normal] [1 = Sexy Alert Box] (Padrão -> 1)
define("COOKIE_PATH", "/"); // -- Patch para armazenamentos de cookies, atere apenas se precisar. (Padrão -> /)
define("COOKIE_DOMAIN", ""); // -- Domínio para armazenamentos de cookies, altere apenas de precisar. [Exemplo .ctmts.com.br] (Padrão -> Vazio)

/*****************************************************************************
	@ Web Public Settings
	@ Configurações do Sistema de Template e Linguagem
*****************************************************************************/
$CTM_SETTINGS['WEBPUBLIC']['SELECTOR']['TEMPLATES'] = TRUE; // -- Habilitar o Seletor de Templates no Footer (Padrão -> TRUE)
$CTM_SETTINGS['WEBPUBLIC']['SELECTOR']['LANGUAGES'] = TRUE; // -- Habilitar o Selecot de Idiomas no Footer (Padrão -> TRUE)
/*****************************************************************************/
$CTM_SETTINGS['WEBPUBLIC']['DEFAULT']['TEMPLATE'] = 0; // -- Id do template padrão
$CTM_SETTINGS['WEBPUBLIC']['DEFAULT']['LANGUAGE'] = 0; // -- Id do idioma padrão
/**************************** Web Public Set **********************************
	@ Configurações dos Templates e Idiomas
	@ Configurações em array sem limites, bastante atenção
	@ ------------------------------------------------------------------
	@ TPL_SET = Identificação do Template
	@ TPL_NAME = Nome do Template
	@ ------------------------------------------------------------------
	@ LANG_FILE = Nome da pasta do Idioma
	@ LANG_NAME = Idioma
	@ ------------------------------------------------------------------
	@ $CTM_SETTINGS['WEBPUBLIC']['TEMPLATES'][ID]= array(TPL_SET, TPL_NAME);
	@ ------------------------------------------------------------------
	@ $CTM_SETTINGS['WEBPUBLIC']['LANGUAGES'][ID]= array(LANG_FILE, LANG_NAME);
******************************************************************************/
$CTM_SETTINGS['WEBPUBLIC']['TEMPLATES'][0] = array("Harmony", "EW.Harmony");
$CTM_SETTINGS['WEBPUBLIC']['TEMPLATES'][1] = array("BlueGray", "BlueGray");
/*****************************************************************************/
$CTM_SETTINGS['WEBPUBLIC']['LANGUAGES'][0] = array("pt-BR", "Português [BR]");
$CTM_SETTINGS['WEBPUBLIC']['LANGUAGES'][1] = array("en-US", "English [US]");


/*****************************************************************************
	@ WebData Settings
	@ Configurações de dados do WebSite
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
$CTM_SETTINGS['WEBDATA']['UPLOADS']['DIRECTORY']['CHARIMAGE'] = "public/uploads/characters/"; // -- Diretório para o envio das Imagens (Imagem Pessoal)
$CTM_SETTINGS['WEBDATA']['UPLOADS']['DIRECTORY']['TICKET_ANNEX'] = "public/uploads/tickets/"; // -- Diretório para o envio dos anexos (Tickets)
$CTM_SETTINGS['WEBDATA']['UPLOADS']['DIRECTORY']['PAYMENT_ANNEX'] = "public/uploads/payments/"; // -- Diretório para envio dos anexos (Pagamentos)
$CTM_SETTINGS['WEBDATA']['UPLOADS']['FILESIZE']['CHARIMAGE'] = 10000000; // -- Tamanho máximo da imagem em bytes (Imagem Pessoal) (Padrão -> 100000)
$CTM_SETTINGS['WEBDATA']['UPLOADS']['FILESIZE']['TICKET_ANNEX'] = 1000000; // -- Tamanho máximo dos anexos em bytes (Tickets) (Padrão -> 1000000)
$CTM_SETTINGS['WEBDATA']['UPLOADS']['FILESIZE']['PAYMENT_ANNEX'] = 1000000; // -- Tamanho máximo dos anexos em bytes (Pagamentos) (Padrão -> 1000000)

/*****************************************************************************
	@ WebCache Settings
	@ Configurações do cache de dados do WebSite
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
$CTM_SETTINGS['WEBCACHE']['RANKINGS']['SWITCH'] = TRUE; // -- Habilitar cache dos Rankings (Padrão -> TRUE)
$CTM_SETTINGS['WEBCACHE']['RANKINGS']['LIMIT'] = 200; // -- Limite de dados dos Rankings (Padrão -> 200)
$CTM_SETTINGS['WEBCACHE']['RANKINGS']['MINUTES'] = 30; // -- Minutos para atualização dos Rankings (Padrão -> 30)

/*****************************************************************************
	@ WebReferer Settings
	@ Configurações de redirecionamentos e referências do WebSite
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
$CTM_SETTINGS['WEBREFERER']['REDIRECT']['LOGIN']['REDIRECT_TO_CP'] = TRUE; // -- Redirecionar diretamente ao painel do usuário ao logar

/*****************************************************************************
	@ CronJob Settings
	@ Configurações do CronJob
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
$CTM_SETTINGS['CRONJOB']['ENABLE'] = TRUE; // -- Habilitar o cronjob ao acessar o sistema (Padrão -> TRUE)
$CTM_SETTINGS['CRONJOB']['DEBUG'] = TRUE; // -- Habilitar o modo debug do cronjob para gerar logs (Padrão -> TRUE)

/*****************************************************************************
	@ Info Settings
	@ Informações do Site
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
define("TITLE_SITE", "Effect Web v2.0 Beta Edition"); // -- Título do Site
define("SERVER_NAME", "Mu Shock"); // -- Nome do Servidor
define("SERVER_VERSION", "1.04C+ Season 6 EP3"); // -- Versão do Servidor
define("SERVER_EXPERIENCE", "4.000x"); // -- Experiência do Servidor
define("SERVER_DROP", "90%"); // -- Drop do Servidor
define("SERVER_BUGBLESS", 1); // -- Bug Bless [0=Offline] [1=Online] ["Outra informação"]
define("SERVER_STATUS", 2); // -- Exibir Status do Server [0=Não] [1=Sim] [2=Manutenção]
define("INVOICE_PREFIX", "2013:"); // -- Prefixo para ID das faturas
define("MONEY_SYMBOL", "R$"); // -- Símbolo da moeda regional utilizada
define("COIN_PRICE", 1.0); // -- Preço de cada Coin 1 (em decimal, separando notas e centavos por ponto)

/*****************************************************************************
	@ Server Settings
	@ Configurações da Lita de Servidores
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
$CTM_SETTINGS['SERVERLIST']['SWITCH'] = TRUE; // -- Ativar/Destivar Lista de Servidores
/************************* ConnectServer Request ****************************
	@ Request de Informações via ConnectServer
	@ Habilitando esta opção, o site irá obter as Salas e a contagem através do ConnectServer
	@ OBS: Ainda sim é necessário configurar a GameServer List
************************* ConnectServer Request ****************************/
$CTM_SETTINGS['SERVERLIST']['CONNECTSERVER']['REQUEST'] = FALSE; // -- Obter as informações pelo ConnectServer (Padrão -> FALSE)
$CTM_SETTINGS['SERVERLIST']['CONNECTSERVER']['HOST'] = "127.0.0.1"; // -- IP do ConnectServer (Padrão -> 127.0.0.1)
$CTM_SETTINGS['SERVERLIST']['CONNECTSERVER']['PORT'] = 44405; // -- Porta do ConnectServer (Padrão -> 44405)
$CTM_SETTINGS['SERVERLIST']['CONNECTSERVER']['TIMEOUT'] = 10; // -- Tempo limite para conexão com o ConnectServer (Padrão -> 10)
/**************************** GameServer List ***********************************
	@ Configurações dos GameServers
	@ Configure mesmo estando com a listagem desativada
	@ Configurações em array sem limites, bastante atenção
	@ ------------------------------------------------------------------
	@ SERVER_ID = ID do GameServer (ServerInfo.dat)
	@ SERVER_NAME = Nome do GameServer (ServerInfo.dat)
	@ SERVER_LIMIT = Limite de players (CommonServer.cfg)
	@ SERVER_SHOW = Mostrar servidor na lista (TRUE / FALSE)
	@ ------------------------------------------------------------------
	@ $_SERVERLIST['ROOM_LIST'][SERVER_ID] = array(SERVER_NAME, "Nome da Sala", SERVER_LIMIT, SERVER_SHOW);
******************************************************************************/
$CTM_SETTINGS['SERVERLIST']['ROOM_LIST'][0] = array("GS", "Sala Geral", 2, TRUE);
$CTM_SETTINGS['SERVERLIST']['ROOM_LIST'][3] = array("CTM-VIP", "Sala VIP", 3, TRUE);
$CTM_SETTINGS['SERVERLIST']['ROOM_LIST'][4] = array("Teste", "Sala Teste", 1, TRUE);

/*****************************************************************************
	@ JoinServer Settings
	@ Configurações do JoinServer Interpreter
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
$CTM_SETTINGS['JOINSERVER']['CONNECTION']['HOST'] = "127.0.0.1"; // -- IP/Host do JoinServer (Padrão -> 127.0.0.1)
$CTM_SETTINGS['JOINSERVER']['CONNECTION']['PORT'] = 55970; // -- Porta do JoinServer (Padrão -> 55970)
$CTM_SETTINGS['JOINSERVER']['CONNECTION']['TIMEOUT'] = 10; // -- Tempo limite para conexão com o JoinServer
 
/*****************************************************************************
	@ Register Settings
	@ Configurações do Registro no Servidor
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
$CTM_SETTINGS['REGISTER']['SWITCH'] = TRUE; // -- Ativar/Desativar Registro no Servidor
$CTM_SETTINGS['REGISTER']['CONFIRM_MAIL'] = FALSE; // -- Obrigar confirmação no E-Mail
$CTM_SETTINGS['REGISTER']['REGISTER_PID'] = TRUE; // -- Pedir Personal ID ao cadastrar
$CTM_SETTINGS['REGISTER']['DEFAULT_PID'] = 1111111; // -- Personal ID a Registrar (Caso não exigir no Cadastro)
$CTM_SETTINGS['REGISTER']['VIP']['SWITCH'] = TRUE; // -- Ganhar VIP ao se Cadastrar (Padrão -> TRUE)
$CTM_SETTINGS['REGISTER']['VIP']['TYPE'] = 2; // -- Tipo de VIP [De 1 a 5] (Padrão -> 1)
$CTM_SETTINGS['REGISTER']['VIP']['TIME'] = 5; // -- Tempo de VIP a Ganhar (Padrão -> 5)
$CTM_SETTINGS['REGISTER']['COIN']['SWITCH'] = TRUE; // -- Ganhar Moeda ao se Cadastrar (Padrão -> FALSE)
$CTM_SETTINGS['REGISTER']['COIN']['TYPE'] = 1; // -- Moeda a Ganhar [De 1 a 3] (Padrão -> 1)
$CTM_SETTINGS['REGISTER']['COIN']['NUMBER'] = 3; // -- Numero de Cash a Ganhar
/**************************** Vault Bonus ***********************************
	@ Configurações de bônus em item ao cadastrar
	@ O Bônus é creditado no baú geral
	@ ------------------------------------------------------------------
	@ Configurações dos itens no arquivo modules/Data/RegisterVault.txt
	@ ------------------------------------------------------------------
	@ SECTION = Section no RegisterVault.txt
	@ ------------------------------------------------------------------
	@ $_REGISTER['VAULT_BONUS']['OPTIONS'][SECTION] = "Descrição no cadastro";
******************************************************************************/
$CTM_SETTINGS['REGISTER']['VAULT_BONUS']['SWITCH'] = TRUE; // -- Habilitar/Desabilitar bônus de item no cadastro
$CTM_SETTINGS['REGISTER']['VAULT_BONUS']['OPTIONS'][0] = "Kit SM Bonus";
$CTM_SETTINGS['REGISTER']['VAULT_BONUS']['OPTIONS'][1] = "Kit BK Bonus";
									  

/*****************************************************************************
	@ Link Settings
	@ Configurações dos links do Site
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
define("FORUM_LINK", "http://forum.ctmts.com.br"); // -- Link do Fórum
define("SHOP_LINK", "http://www.ctmts.com.br"); // -- Link do Shop

						  
/*****************************************************************************
	@ User Control Panel Settings
	@ Configurações do Painel de Controle
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_DATA'][0] = FALSE; // -- Permissões: Alterar Dados [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_DATA'][1] = TRUE; // -- Permissões: Alterar Dados [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_DATA'][2] = TRUE; // -- Permissões: Alterar Dados [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_DATA'][3] = TRUE; // -- Permissões: Alterar Dados [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_DATA'][4] = TRUE; // -- Permissões: Alterar Dados [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_DATA'][5] = TRUE; // -- Permissões: Alterar Dados [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_DATA'][6] = TRUE; // -- Permissões: Alterar Dados [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_MAIL'][0] = TRUE; // -- Permissões: Alterar E-Mail [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_MAIL'][1] = TRUE; // -- Permissões: Alterar E-Mail [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_MAIL'][2] = TRUE; // -- Permissões: Alterar E-Mail [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_MAIL'][3] = TRUE; // -- Permissões: Alterar E-Mail [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_MAIL'][4] = TRUE; // -- Permissões: Alterar E-Mail [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_MAIL'][5] = TRUE; // -- Permissões: Alterar E-Mail [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_MAIL'][6] = TRUE; // -- Permissões: Alterar E-Mail [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_PID'][0] = TRUE; // -- Permissões: Alterar Personal ID [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_PID'][1] = TRUE; // -- Permissões: Alterar Personal ID [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_PID'][2] = TRUE; // -- Permissões: Alterar Personal ID [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_PID'][3] = TRUE; // -- Permissões: Alterar Personal ID [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_PID'][4] = TRUE; // -- Permissões: Alterar Personal ID [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_PID'][5] = TRUE; // -- Permissões: Alterar Personal ID [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['CHANGE_PID'][6] = TRUE; // -- Permissões: Alterar Personal ID [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['VIRTUAL_VAULT'][0] = TRUE; // -- Permissões: Virtual Vault (Baú Virtual) [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['VIRTUAL_VAULT'][1] = TRUE; // -- Permissões: Virtual Vault (Baú Virtual) [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['VIRTUAL_VAULT'][2] = TRUE; // -- Permissões: Virtual Vault (Baú Virtual) [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['VIRTUAL_VAULT'][3] = TRUE; // -- Permissões: Virtual Vault (Baú Virtual) [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['VIRTUAL_VAULT'][4] = TRUE; // -- Permissões: Virtual Vault (Baú Virtual) [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['VIRTUAL_VAULT'][5] = TRUE; // -- Permissões: Virtual Vault (Baú Virtual) [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['VIRTUAL_VAULT'][6] = TRUE; // -- Permissões: Virtual Vault (Baú Virtual) [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['DISCONNECT_GAME'][0] = TRUE; // -- Permissões: Desconectar Conta [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['DISCONNECT_GAME'][1] = TRUE; // -- Permissões: Desconectar Conta [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['DISCONNECT_GAME'][2] = FALSE; // -- Permissões: Desconectar Conta [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['DISCONNECT_GAME'][3] = TRUE; // -- Permissões: Desconectar Conta [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['DISCONNECT_GAME'][4] = TRUE; // -- Permissões: Desconectar Conta [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['DISCONNECT_GAME'][5] = TRUE; // -- Permissões: Desconectar Conta [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['ACCOUNT']['DISCONNECT_GAME'][6] = TRUE; // -- Permissões: Desconectar Conta [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['RESET_SYSTEM'][0] = TRUE; // -- Permissões: Reset System [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['RESET_SYSTEM'][1] = TRUE; // -- Permissões: Reset System [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['RESET_SYSTEM'][2] = TRUE; // -- Permissões: Reset System [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['RESET_SYSTEM'][3] = TRUE; // -- Permissões: Reset System [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['RESET_SYSTEM'][4] = TRUE; // -- Permissões: Reset System [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['RESET_SYSTEM'][5] = TRUE; // -- Permissões: Reset System [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['RESET_SYSTEM'][6] = TRUE; // -- Permissões: Reset System [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MASTER_RESET'][0] = TRUE; // -- Permissões: Master Reset [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MASTER_RESET'][1] = TRUE; // -- Permissões: Master Reset [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MASTER_RESET'][2] = TRUE; // -- Permissões: Master Reset [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MASTER_RESET'][3] = TRUE; // -- Permissões: Master Reset [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MASTER_RESET'][4] = TRUE; // -- Permissões: Master Reset [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MASTER_RESET'][5] = TRUE; // -- Permissões: Master Reset [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MASTER_RESET'][6] = TRUE; // -- Permissões: Master Reset [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['TRANSFER_RESETS'][0] = TRUE; // -- Permissões: Transferir Resets [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['TRANSFER_RESETS'][1] = TRUE; // -- Permissões: Transferir Resets [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['TRANSFER_RESETS'][2] = TRUE; // -- Permissões: Transferir Resets [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['TRANSFER_RESETS'][3] = TRUE; // -- Permissões: Transferir Resets [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['TRANSFER_RESETS'][4] = TRUE; // -- Permissões: Transferir Resets [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['TRANSFER_RESETS'][5] = TRUE; // -- Permissões: Transferir Resets [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['TRANSFER_RESETS'][6] = TRUE; // -- Permissões: Transferir Resets [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['EXCHANGE_RCOIN'][0] = TRUE; // -- Permissões: Trocar Resets por Moeda [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['EXCHANGE_RCOIN'][1] = TRUE; // -- Permissões: Trocar Resets por Moeda [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['EXCHANGE_RCOIN'][2] = TRUE; // -- Permissões: Trocar Resets por Moeda [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['EXCHANGE_RCOIN'][3] = TRUE; // -- Permissões: Trocar Resets por Moeda [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['EXCHANGE_RCOIN'][4] = TRUE; // -- Permissões: Trocar Resets por Moeda [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['EXCHANGE_RCOIN'][5] = TRUE; // -- Permissões: Trocar Resets por Moeda [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['EXCHANGE_RCOIN'][6] = TRUE; // -- Permissões: Trocar Resets por Moeda [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_PK'][0] = TRUE; // -- Permissões: Limpar PK [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_PK'][1] = TRUE; // -- Permissões: Limpar PK [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_PK'][2] = TRUE; // -- Permissões: Limpar PK [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_PK'][3] = TRUE; // -- Permissões: Limpar PK [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_PK'][4] = TRUE; // -- Permissões: Limpar PK [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_PK'][5] = TRUE; // -- Permissões: Limpar PK [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_PK'][6] = TRUE; // -- Permissões: Limpar PK [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_CLASS'][0] = TRUE; // -- Permissões: Alterar Classe [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_CLASS'][1] = TRUE; // -- Permissões: Alterar Classe [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_CLASS'][2] = TRUE; // -- Permissões: Alterar Classe [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_CLASS'][3] = TRUE; // -- Permissões: Alterar Classe [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_CLASS'][4] = TRUE; // -- Permissões: Alterar Classe [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_CLASS'][5] = TRUE; // -- Permissões: Alterar Classe [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_CLASS'][6] = TRUE; // -- Permissões: Alterar Classe [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_NAME'][0] = TRUE; // -- Permissões: Alterar Nick [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_NAME'][1] = TRUE; // -- Permissões: Alterar Nick [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_NAME'][2] = TRUE; // -- Permissões: Alterar Nick [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_NAME'][3] = TRUE; // -- Permissões: Alterar Nick [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_NAME'][4] = TRUE; // -- Permissões: Alterar Nick [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_NAME'][5] = TRUE; // -- Permissões: Alterar Nick [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_NAME'][6] = TRUE; // -- Permissões: Alterar Nick [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MOVE_CHARACTER'][0] = TRUE; // -- Permissões: Mover Personagem [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MOVE_CHARACTER'][1] = TRUE; // -- Permissões: Mover Personagem [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MOVE_CHARACTER'][2] = TRUE; // -- Permissões: Mover Personagem [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MOVE_CHARACTER'][3] = TRUE; // -- Permissões: Mover Personagem [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MOVE_CHARACTER'][4] = TRUE; // -- Permissões: Mover Personagem [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MOVE_CHARACTER'][5] = TRUE; // -- Permissões: Mover Personagem [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MOVE_CHARACTER'][6] = TRUE; // -- Permissões: Mover Personagem [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MANAGE_PROFILE'][0] = TRUE; // -- Permissões: Gerenciar Perfil [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MANAGE_PROFILE'][1] = TRUE; // -- Permissões: Gerenciar Perfil [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MANAGE_PROFILE'][2] = TRUE; // -- Permissões: Gerenciar Perfil [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MANAGE_PROFILE'][3] = TRUE; // -- Permissões: Gerenciar Perfil [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MANAGE_PROFILE'][4] = TRUE; // -- Permissões: Gerenciar Perfil [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MANAGE_PROFILE'][5] = TRUE; // -- Permissões: Gerenciar Perfil [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['MANAGE_PROFILE'][6] = TRUE; // -- Permissões: Gerenciar Perfil [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_AVATAR'][0] = TRUE; // -- Permissões: Alterar Avatar [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_AVATAR'][1] = TRUE; // -- Permissões: Alterar Avatar [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_AVATAR'][2] = TRUE; // -- Permissões: Alterar Avatar [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_AVATAR'][3] = TRUE; // -- Permissões: Alterar Avatar [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_AVATAR'][4] = TRUE; // -- Permissões: Alterar Avatar [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_AVATAR'][5] = TRUE; // -- Permissões: Alterar Avatar [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CHANGE_AVATAR'][6] = TRUE; // -- Permissões: Alterar Avatar [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REPAIR_POINTS'][0] = TRUE; // -- Permissões: Reparar Pontos [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REPAIR_POINTS'][1] = TRUE; // -- Permissões: Reparar Pontos [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REPAIR_POINTS'][2] = TRUE; // -- Permissões: Reparar Pontos [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REPAIR_POINTS'][3] = TRUE; // -- Permissões: Reparar Pontos [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REPAIR_POINTS'][4] = TRUE; // -- Permissões: Reparar Pontos [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REPAIR_POINTS'][5] = TRUE; // -- Permissões: Reparar Pontos [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REPAIR_POINTS'][6] = TRUE; // -- Permissões: Reparar Pontos [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REDISTRIBUTE_POINTS'][0] = TRUE; // -- Permissões: Redistribuir Pontos [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REDISTRIBUTE_POINTS'][1] = TRUE; // -- Permissões: Redistribuir Pontos [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REDISTRIBUTE_POINTS'][2] = TRUE; // -- Permissões: Redistribuir Pontos [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REDISTRIBUTE_POINTS'][3] = TRUE; // -- Permissões: Redistribuir Pontos [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REDISTRIBUTE_POINTS'][4] = TRUE; // -- Permissões: Redistribuir Pontos [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REDISTRIBUTE_POINTS'][5] = TRUE; // -- Permissões: Redistribuir Pontos [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['REDISTRIBUTE_POINTS'][6] = TRUE; // -- Permissões: Redistribuir Pontos [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['DISTRIBUTE_POINTS'][0] = TRUE; // -- Permissões: Distribuir Pontos [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['DISTRIBUTE_POINTS'][1] = TRUE; // -- Permissões: Distribuir Pontos [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['DISTRIBUTE_POINTS'][2] = TRUE; // -- Permissões: Distribuir Pontos [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['DISTRIBUTE_POINTS'][3] = TRUE; // -- Permissões: Distribuir Pontos [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['DISTRIBUTE_POINTS'][4] = TRUE; // -- Permissões: Distribuir Pontos [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['DISTRIBUTE_POINTS'][5] = TRUE; // -- Permissões: Distribuir Pontos [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['DISTRIBUTE_POINTS'][6] = TRUE; // -- Permissões: Distribuir Pontos [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_CHARACTER'][0] = TRUE; // -- Permissões: Limpar Personagem [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_CHARACTER'][1] = TRUE; // -- Permissões: Limpar Personagem [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_CHARACTER'][2] = TRUE; // -- Permissões: Limpar Personagem [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_CHARACTER'][3] = TRUE; // -- Permissões: Limpar Personagem [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_CHARACTER'][4] = TRUE; // -- Permissões: Limpar Personagem [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_CHARACTER'][5] = TRUE; // -- Permissões: Limpar Personagem [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['CHARACTER']['CLEAR_CHARACTER'][6] = TRUE; // -- Permissões: Limpar Personagem [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['SUPPORT']['TICKETS'][0] = TRUE; // -- Permissões: Tickets de Suporte [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['SUPPORT']['TICKETS'][1] = TRUE; // -- Permissões: Tickets de Suporte [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['SUPPORT']['TICKETS'][2] = TRUE; // -- Permissões: Tickets de Suporte [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['SUPPORT']['TICKETS'][3] = TRUE; // -- Permissões: Tickets de Suporte [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['SUPPORT']['TICKETS'][4] = TRUE; // -- Permissões: Tickets de Suporte [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['SUPPORT']['TICKETS'][5] = TRUE; // -- Permissões: Tickets de Suporte [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['SUPPORT']['TICKETS'][6] = TRUE; // -- Permissões: Tickets de Suporte [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['INVOICES'][0] = TRUE; // -- Permissões: Faturas [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['INVOICES'][1] = TRUE; // -- Permissões: Faturas [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['INVOICES'][2] = TRUE; // -- Permissões: Faturas [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['INVOICES'][3] = TRUE; // -- Permissões: Faturas [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['INVOICES'][4] = TRUE; // -- Permissões: Faturas [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['INVOICES'][5] = TRUE; // -- Permissões: Faturas [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['INVOICES'][6] = TRUE; // -- Permissões: Faturas [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['CONVERT_COIN'][0] = TRUE; // -- Permissões: Converter Moeda [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['CONVERT_COIN'][1] = TRUE; // -- Permissões: Converter Moeda [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['CONVERT_COIN'][2] = TRUE; // -- Permissões: Converter Moeda [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['CONVERT_COIN'][3] = TRUE; // -- Permissões: Converter Moeda [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['CONVERT_COIN'][4] = TRUE; // -- Permissões: Converter Moeda [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['CONVERT_COIN'][5] = TRUE; // -- Permissões: Converter Moeda [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['CONVERT_COIN'][6] = TRUE; // -- Permissões: Converter Moeda [VIP 5]

$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['BUY_VIP'][0] = TRUE; // -- Permissões: Comprar VIP [Switch]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['BUY_VIP'][1] = TRUE; // -- Permissões: Comprar VIP [Free]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['BUY_VIP'][2] = TRUE; // -- Permissões: Comprar VIP [VIP 1]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['BUY_VIP'][3] = TRUE; // -- Permissões: Comprar VIP [VIP 2]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['BUY_VIP'][4] = TRUE; // -- Permissões: Comprar VIP [VIP 3]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['BUY_VIP'][5] = TRUE; // -- Permissões: Comprar VIP [VIP 4]
$CTM_SETTINGS['USERPANEL']['PERMISSION']['FINANCIAL']['BUY_VIP'][6] = TRUE; // -- Permissões: Comprar VIP [VIP 5]

/******************************** Configurações do Virtual Vault *********************************/
$CTM_SETTINGS['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['INSERT_ITEM'] = TRUE; // -- Permitir que insira itens no Virtual Vault (Padrão -> TRUE)

$CTM_SETTINGS['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['ITEMS_LIMIT'][0] = 0; // -- Limite de itens armazenados (Deixe 0 para ilimitado) [Free]
$CTM_SETTINGS['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['ITEMS_LIMIT'][1] = 0; // -- Limite de itens armazenados (Deixe 0 para ilimitado) [VIP 1]
$CTM_SETTINGS['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['ITEMS_LIMIT'][2] = 0; // -- Limite de itens armazenados (Deixe 0 para ilimitado) [VIP 2]
$CTM_SETTINGS['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['ITEMS_LIMIT'][3] = 0; // -- Limite de itens armazenados (Deixe 0 para ilimitado) [VIP 3]
$CTM_SETTINGS['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['ITEMS_LIMIT'][4] = 0; // -- Limite de itens armazenados (Deixe 0 para ilimitado) [VIP 4]
$CTM_SETTINGS['USERPANEL']['ACCOUNT']['VIRTUAL_VAULT']['ITEMS_LIMIT'][5] = 0; // -- Limite de itens armazenados (Deixe 0 para ilimitado) [VIP 5]

/******************************** Configurações do Reset System **********************************
	@ MODE: 1 - Acumulativo, acumula os pontos atuais sem adicionar pontos [Configurações 0xC0]
	@ MODE: 2 - Acumulativo, acumula os pontos atuais adicionado pontos [Configurações 0xC1]
	@ MODE: 3 - Dinâmico, normal, reseta todos os stats adicionando pontos * resets [Configurações 0xC2]
	@ MODE: 4 - Dinâmico, tabelado, reseta todos os stats, opções de acordo tabela de resets
	@ NOTE: As configurações 0xFF são lidas em todos os modos.
	@ NOTE: As configurações do MODE 4 são no arquivo modules/data/ResetTable.txt
*************************************************************************************************/
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MODE'] = 4; // -- Reset Mode

$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_RESET'][0] = 350; // -- Level Mínimo para resetar [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_RESET'][1] = 290; // -- Level Mínimo para resetar [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_RESET'][2] = 220; // -- Level Mínimo para resetar [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_RESET'][3] = 220; // -- Level Mínimo para resetar [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_RESET'][4] = 220; // -- Level Mínimo para resetar [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_RESET'][5] = 220; // -- Level Mínimo para resetar [VIP 5]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MONEY_REQUIRE'][0] = 120000; // -- Zen Requerido para resetar [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MONEY_REQUIRE'][1] = 50000; // -- Zen Requerido para resetar [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MONEY_REQUIRE'][2] = 50000; // -- Zen Requerido para resetar [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MONEY_REQUIRE'][3] = 50000; // -- Zen Requerido para resetar [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MONEY_REQUIRE'][4] = 50000; // -- Zen Requerido para resetar [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['MONEY_REQUIRE'][5] = 50000; // -- Zen Requerido para resetar [VIP 5]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_AFTER'][0] = 1; // -- Level após resetar [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_AFTER'][1] = 5; // -- Level após resetar [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_AFTER'][2] = 10; // -- Level após resetar [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_AFTER'][3] = 15; // -- Level após resetar [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_AFTER'][4] = 20; // -- Level após resetar [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['LEVEL_AFTER'][5] = 25; // -- Level após resetar [VIP 5]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_INVENT'][0] = FALSE; // -- Limpar Invetário [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_INVENT'][1] = FALSE; // -- Limpar Invetário [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_INVENT'][2] = FALSE; // -- Limpar Invetário [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_INVENT'][3] = FALSE; // -- Limpar Invetário [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_INVENT'][4] = TRUE; // -- Limpar Invetário [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_INVENT'][5] = FALSE; // -- Limpar Invetário [VIP 5]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_SKILL'][0] = FALSE; // -- Limpar Skills [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_SKILL'][1] = FALSE; // -- Limpar Skills [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_SKILL'][2] = FALSE; // -- Limpar Skills [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_SKILL'][3] = FALSE; // -- Limpar Skills [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_SKILL'][4] = FALSE; // -- Limpar Skills [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_SKILL'][5] = FALSE; // -- Limpar Skills [VIP 5]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_QUEST'][0] = FALSE; // -- Limpar Quests [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_QUEST'][1] = FALSE; // -- Limpar Quests [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_QUEST'][2] = FALSE; // -- Limpar Quests [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_QUEST'][3] = FALSE; // -- Limpar Quests [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_QUEST'][4] = FALSE; // -- Limpar Quests [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xFF]['CLEAR_QUEST'][5] = FALSE; // -- Limpar Quests [VIP 5]

//---------------------------------------
// Configurações de Resets : 0xC1
//---------------------------------------
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC1]['SET_POINTS'][0] = 300; // -- Pontos a receber [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC1]['SET_POINTS'][1] = 400; // -- Pontos a receber [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC1]['SET_POINTS'][2] = 500; // -- Pontos a receber [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC1]['SET_POINTS'][3] = 600; // -- Pontos a receber [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC1]['SET_POINTS'][4] = 700; // -- Pontos a receber [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC1]['SET_POINTS'][5] = 800; // -- Pontos a receber [VIP 5]
//---------------------------------------
// Configurações de Resets : 0xC2
//---------------------------------------
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC2]['SET_POINTS'][0] = 300; // -- Pontos a receber [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC2]['SET_POINTS'][1] = 400; // -- Pontos a receber [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC2]['SET_POINTS'][2] = 500; // -- Pontos a receber [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC2]['SET_POINTS'][3] = 600; // -- Pontos a receber [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC2]['SET_POINTS'][4] = 700; // -- Pontos a receber [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['RESET_SYSTEM'][0xC2]['SET_POINTS'][5] = 800; // -- Pontos a receber [VIP 5]

/******************************** Configurações do Master Reset **********************************
	@ MODE: 1 - Requere e remove determinado número de resets [Configurações 0xC0]
	@ MODE: 2 - Requere determinado número de resets porem não remove [Configurações 0xC1]
	@ MODE: 3 - Não requere nem remove determinado número de Resets
	@ NOTE: As configurações 0xFF são lidas em todos os modos.
*************************************************************************************************/
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MODE'] = 1; // -- Master Reset Mode

$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['LEVEL_RESET'][0] = 400; // -- Level mínimo para resetar [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['LEVEL_RESET'][1] = 350; // -- Level mínimo para resetar [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['LEVEL_RESET'][2] = 280; // -- Level mínimo para resetar [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['LEVEL_RESET'][3] = 280; // -- Level mínimo para resetar [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['LEVEL_RESET'][4] = 280; // -- Level mínimo para resetar [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['LEVEL_RESET'][5] = 280; // -- Level mínimo para resetar [VIP 5]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MONEY_REQUIRE'][0] = 120000; // -- Zen requerido para resetar [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MONEY_REQUIRE'][1] = 120000; // -- Zen requerido para resetar [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MONEY_REQUIRE'][2] = 120000; // -- Zen requerido para resetar [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MONEY_REQUIRE'][3] = 120000; // -- Zen requerido para resetar [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MONEY_REQUIRE'][4] = 120000; // -- Zen requerido para resetar [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['MONEY_REQUIRE'][5] = 120000; // -- Zen requerido para resetar [VIP 5]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_REQUIRE'][0] = 32767; // -- Stats requeridos para resetar [Força]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_REQUIRE'][1] = 32767; // -- Stats requeridos para resetar [Agilidade]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_REQUIRE'][2] = 32767; // -- Stats requeridos para resetar [Vitalidade]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_REQUIRE'][3] = 32767; // -- Stats requeridos para resetar [Energia]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_REQUIRE'][4] = 32767; // -- Stats requeridos para resetar [Comando - Somente DL/LE]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['RESET_POINTS'][0] = TRUE; // -- Resetar pontos (Sim/Não) [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['RESET_POINTS'][1] = TRUE; // -- Resetar pontos (Sim/Não) [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['RESET_POINTS'][2] = TRUE; // -- Resetar pontos (Sim/Não) [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['RESET_POINTS'][3] = TRUE; // -- Resetar pontos (Sim/Não) [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['RESET_POINTS'][4] = TRUE; // -- Resetar pontos (Sim/Não) [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['RESET_POINTS'][5] = TRUE; // -- Resetar pontos (Sim/Não) [VIP 5]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_AFTER'][0] = -1; // -- Stats após o Master Reset (Deixe -1: padrão por classe) [Força]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_AFTER'][1] = -1; // -- Stats após o Master Reset (Deixe -1: padrão por classe) [Agilidade]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_AFTER'][2] = -1; // -- Stats após o Master Reset (Deixe -1: padrão por classe) [Vitalidade]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_AFTER'][3] = -1; // -- Stats após o Master Reset (Deixe -1: padrão por classe) [Energia]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['STATS_AFTER'][4] = -1; // -- Stats após o Master Reset (Deixe -1: padrão por classe) [Comando - Somente DL/LE]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_INVENT'][0] = FALSE; // -- Limpar Invetário [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_INVENT'][1] = FALSE; // -- Limpar Invetário [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_INVENT'][2] = FALSE; // -- Limpar Invetário [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_INVENT'][3] = FALSE; // -- Limpar Invetário [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_INVENT'][4] = FALSE; // -- Limpar Invetário [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_INVENT'][5] = FALSE; // -- Limpar Invetário [VIP 5]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_SKILL'][0] = FALSE; // -- Limpar Skills [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_SKILL'][1] = FALSE; // -- Limpar Skills [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_SKILL'][2] = FALSE; // -- Limpar Skills [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_SKILL'][3] = FALSE; // -- Limpar Skills [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_SKILL'][4] = FALSE; // -- Limpar Skills [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_SKILL'][5] = FALSE; // -- Limpar Skills [VIP 5]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_QUEST'][0] = FALSE; // -- Limpar Quests [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_QUEST'][1] = FALSE; // -- Limpar Quests [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_QUEST'][2] = FALSE; // -- Limpar Quests [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_QUEST'][3] = FALSE; // -- Limpar Quests [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_QUEST'][4] = FALSE; // -- Limpar Quests [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['CLEAR_QUEST'][5] = FALSE; // -- Limpar Quests [VIP 5]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['COIN_NUMBER'] = 1; // -- Moeda a receber (1 a 3)

$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['COIN_AWARD'][0] = 1; // -- Quantidade de moeda a receber [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['COIN_AWARD'][1] = 1; // -- Quantidade de moeda a receber [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['COIN_AWARD'][2] = 1; // -- Quantidade de moeda a receber [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['COIN_AWARD'][3] = 1; // -- Quantidade de moeda a receber [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['COIN_AWARD'][4] = 1; // -- Quantidade de moeda a receber [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xFF]['COIN_AWARD'][5] = 1; // -- Quantidade de moeda a receber [VIP 5]
//---------------------------------------
// Configurações de Master Resets : 0xC0
//---------------------------------------
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REQUIRE'][0] = 10; // -- Resets requeridos para resetar [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REQUIRE'][1] = 10; // -- Resets requeridos para resetar [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REQUIRE'][2] = 10; // -- Resets requeridos para resetar [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REQUIRE'][3] = 10; // -- Resets requeridos para resetar [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REQUIRE'][4] = 10; // -- Resets requeridos para resetar [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REQUIRE'][5] = 10; // -- Resets requeridos para resetar [VIP 5]

$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REMOVE'][0] = 10; // -- Resets a remover após o master Reset [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REMOVE'][1] = 10; // -- Resets a remover após o master Reset [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REMOVE'][2] = 10; // -- Resets a remover após o master Reset [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REMOVE'][3] = 10; // -- Resets a remover após o master Reset [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REMOVE'][4] = 10; // -- Resets a remover após o master Reset [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC0]['RESETS_REMOVE'][5] = 10; // -- Resets a remover após o master Reset [VIP 5]
//---------------------------------------
// Configurações de Master Resets : 0xC1
//---------------------------------------
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC1]['RESETS_REQUIRE'][0] = 10; // -- Resets requeridos para resetar [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC1]['RESETS_REQUIRE'][1] = 10; // -- Resets requeridos para resetar [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC1]['RESETS_REQUIRE'][2] = 10; // -- Resets requeridos para resetar [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC1]['RESETS_REQUIRE'][3] = 10; // -- Resets requeridos para resetar [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC1]['RESETS_REQUIRE'][4] = 10; // -- Resets requeridos para resetar [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['MASTER_RESET'][0xC1]['RESETS_REQUIRE'][5] = 10; // -- Resets requeridos para resetar [VIP 5]

/************ Configurações do Transferir Resets ************/
$CTM_SETTINGS['USERPANEL']['CHARACTER']['TRANSFER_RESETS']['REQUIRE_RESETS'] = 49; // -- Quantidade minima de Resets que o char deve conter
$CTM_SETTINGS['USERPANEL']['CHARACTER']['TRANSFER_RESETS']['MIN_SEND'] = 50; // -- Número mínimo de Resets que o char pode transferir
$CTM_SETTINGS['USERPANEL']['CHARACTER']['TRANSFER_RESETS']['MAX_SEND'] = 0; // -- Número máximo de Resets que o char pode transferir (Deixe 0 para ilimitado)
$CTM_SETTINGS['USERPANEL']['CHARACTER']['TRANSFER_RESETS']['RESET_CHAR'] = TRUE; // -- Resetar stats e pontos do char ao transferir Resets (Padrão -> FALSE)

/************ Configurações do Trocar Resets por Moeda ************/
$CTM_SETTINGS['USERPANEL']['CHARACTER']['EXCHANGE_RCOIN']['COIN'] = 2; // -- Moeda a receber (1 a 3)
$CTM_SETTINGS['USERPANEL']['CHARACTER']['EXCHANGE_RCOIN']['PRICE'] = 10; // -- Preço de cada Moeda em Resets (Resets * Valor)
$CTM_SETTINGS['USERPANEL']['CHARACTER']['EXCHANGE_RCOIN']['REQUIRE_RESETS'] = 50; // -- Quantidade mínima de Resets que o char deve conter
$CTM_SETTINGS['USERPANEL']['CHARACTER']['EXCHANGE_RCOIN']['MIN_REQUISITION'] = 1; // -- Número mínimo de Coin que o char pode requisitar
$CTM_SETTINGS['USERPANEL']['CHARACTER']['EXCHANGE_RCOIN']['MAX_REQUISITION'] = 2; // -- Número máximo de Coin que o char pode requisitar (Deixe 0 para ilimitado)
$CTM_SETTINGS['USERPANEL']['CHARACTER']['EXCHANGE_RCOIN']['RESET_CHAR'] = TRUE; // -- Resetar stats e pontos do char ao requisitar as moedas (Padrão -> FALSE)

/************ Configurações do Limpar PK/Hero ************/
$CTM_SETTINGS['USERPANEL']['CHARACTER']['CLEAR_PK']['REQUIRE_MONEY'][0] = 400000; // -- Zen requerido para limpar PK [Free]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['CLEAR_PK']['REQUIRE_MONEY'][1] = 400000; // -- Zen requerido para limpar PK [VIP 1]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['CLEAR_PK']['REQUIRE_MONEY'][2] = 400000; // -- Zen requerido para limpar PK [VIP 2]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['CLEAR_PK']['REQUIRE_MONEY'][3] = 400000; // -- Zen requerido para limpar PK [VIP 3]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['CLEAR_PK']['REQUIRE_MONEY'][4] = 400000; // -- Zen requerido para limpar PK [VIP 4]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['CLEAR_PK']['REQUIRE_MONEY'][5] = 400000; // -- Zen requerido para limpar PK [VIP 5]

/************ Configurações do Alterar Classe ************/
$CTM_SETTINGS['USERPANEL']['CHARACTER']['CHANGE_CLASS']['REQUIRE_QUESTS'][0] = TRUE; // -- Requerir Quests para mudar de classe [Segunda Classe]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['CHANGE_CLASS']['REQUIRE_QUESTS'][1] = TRUE; // -- Requerir Quests para mudar de classe [Terceira Classe]
$CTM_SETTINGS['USERPANEL']['CHARACTER']['CHANGE_CLASS']['REQUIRE_LEVEL'] = FALSE; // -- Requerir o level requerido nas quests
$CTM_SETTINGS['USERPANEL']['CHARACTER']['CHANGE_CLASS']['THREE_REQ_QUEST'] = TRUE; // -- Requerir as duas primeias Quests da terceira classe para alterar para a terceira classe
$CTM_SETTINGS['USERPANEL']['CHARACTER']['CHANGE_CLASS']['SET_QUESTS'] = TRUE; // -- Definir as quests após mudar de classe

/************ Configurações do Alterar Nick ************/
$CTM_SETTINGS['USERPANEL']['CHARACTER']['CHANGE_NAME']['BAD_SYNTAX'] = array("ADM", "SUB", "DV", "GM", "WebZen", "Web-Zen"); // -- Palávras Bloqueadas (Exemplo: "ADM", "GM")

/************ Configurações do Resetar Pontos ************/
$CTM_SETTINGS['USERPANEL']['CHARACTER']['REDISTRIBUTE_POINTS']['MIN_REQUIRE'] = 9; // -- Mínimo de pontos requeridos em todos os Stats

/************ Configurações do Ticket de Suporte ************/
$CTM_SETTINGS['USERPANEL']['SUPPORT']['TICKETS']['DEPARTAMENTS'] = array("Suporte Geral", "Suporte Financeiro"); // -- Departamentos de Suporte
$CTM_SETTINGS['USERPANEL']['SUPPORT']['TICKETS']['LIMIT_OPENED'] = 1; // -- Quantidade máxima de Tickets em Aberto (Deixe 0 para ilimitado)

/************ Configurações do sistema de Faturas ************/
$CTM_SETTINGS['USERPANEL']['FINANCIAL']['INVOICES']['LIMIT_OPENED'] = 0; // -- Limite para faturas abertas (Deixe 0 para ilimitado)

/**************************** Configurações do Converter Moedas *********************************
	@ Exemplo: Quantidade => Preço,
*************************************************************************************************/
/****************** Moeda 2 => Moeda 1 *******************/
$CTM_SETTINGS['USERPANEL']['FINANCIAL']['CONVERT_COIN']['OPTIONS']['2_TO_1'] = array(3 => 10, 4 => 20);
/****************** Moeda 3 => Moeda 1 *******************/
$CTM_SETTINGS['USERPANEL']['FINANCIAL']['CONVERT_COIN']['OPTIONS']['3_TO_1'] = array(3 => 10, 4 => 20);
/****************** Moeda 3 => Moeda 2 *******************/
$CTM_SETTINGS['USERPANEL']['FINANCIAL']['CONVERT_COIN']['OPTIONS']['3_TO_2'] = array(3 => 10, 4 => 20);

/******************************** Configurações do Comprar VIP **********************************
	@ Exemplo: Dias de VIP => Preço em Coin 1),
*************************************************************************************************/
/****************** VIP 1 *******************/
$CTM_SETTINGS['USERPANEL']['FINANCIAL']['BUY_VIP']['PLANS'][1] = array(30 => 5, 90 => 15, 365 => 60);
/****************** VIP 2 *******************/
$CTM_SETTINGS['USERPANEL']['FINANCIAL']['BUY_VIP']['PLANS'][2] = array(30 => 10, 90 => 30, 365 => 120);		 
/****************** VIP 3 *******************/
$CTM_SETTINGS['USERPANEL']['FINANCIAL']['BUY_VIP']['PLANS'][3] = array(30 => 5, 90 => 15, 365 => 60);
/****************** VIP 4 *******************/
$CTM_SETTINGS['USERPANEL']['FINANCIAL']['BUY_VIP']['PLANS'][4] = array(30 => 5, 90 => 15, 365 => 60);
/****************** VIP 5 *******************/
$CTM_SETTINGS['USERPANEL']['FINANCIAL']['BUY_VIP']['PLANS'][5] = array(30 => 5, 90 => 15, 365 => 60);


/*****************************************************************************
	@ Admin Control Panel (ACP) Settings
	@ Configurações do CTM Admin Control Panel (Painel Administrativo)
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
$CTM_SETTINGS['ADMINCONTROLPANEL']['SADMIN_ACCOUNTS'] = array("erick"); // -- Contas "Super Admin", não podem deletadas e possuem total controle
$CTM_SETTINGS['ADMINCONTROLPANEL']['SADMIN_GROUPS'] = array(1); // -- Grupos "Super Admin", não podem deletadas e possuem total controle
$CTM_SETTINGS['ADMINCONTROLPANEL']['SYSTEM_MANAGER'] = array("erick"); // -- Contas com permissão de gerenciar o sistema (avançado)
						  
/*****************************************************************************
	@ Home Settings
	@ Configurações da Pagina Home
	@ TRUE = Sim
	@ FALSE = Não
*****************************************************************************/
$CTM_SETTINGS['HOME']['NOTICES']['SHOW'] = TRUE; // -- Mostrar Notícias (Padrão -> TRUE)
$CTM_SETTINGS['HOME']['NOTICES']['LIMIT'] = 7; // -- Total de Notícias (Padrão -> 7)
$CTM_SETTINGS['HOME']['SIEGE']['SHOW'] = TRUE; // -- Mostrar Informações do Castle Siege
$CTM_SETTINGS['HOME']['SIEGE']['DATE'] = "*"; // -- Dia do Castle Sisge (Deixe * para ele obter via SQL) (Padrão -> *)
$CTM_SETTINGS['HOME']['SIEGE']['HOUR'] = "00:00h"; // -- Hora do Castle Siege
$CTM_SETTINGS['HOME']['TOP_RANK']['FORMAT'] = TRUE; // -- Formatar Resultados [Exemplo: 1.000] (Padrão -> TRUE)
$CTM_SETTINGS['HOME']['TOP_RANK']['RESETS'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top Resets
$CTM_SETTINGS['HOME']['TOP_RANK']['MRESETS'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top Master Resets
$CTM_SETTINGS['HOME']['TOP_RANK']['R_DAILY'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top Resets Diário
$CTM_SETTINGS['HOME']['TOP_RANK']['R_WEEKLY'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top Resets Semanal
$CTM_SETTINGS['HOME']['TOP_RANK']['R_MONTHLY'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top Resets Mensal
$CTM_SETTINGS['HOME']['TOP_RANK']['MR_DAILY'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top Master Resets Diário
$CTM_SETTINGS['HOME']['TOP_RANK']['MR_WEEKLY'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top Master Resets Semanal
$CTM_SETTINGS['HOME']['TOP_RANK']['MR_MONTHLY'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top Master Resets Mensal
$CTM_SETTINGS['HOME']['TOP_RANK']['LEVEL'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top Master Level (Season 3 / Superior)
$CTM_SETTINGS['HOME']['TOP_RANK']['MASTER_LEVEL'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top Level
$CTM_SETTINGS['HOME']['TOP_RANK']['PK_KILLS'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top PK Kills
$CTM_SETTINGS['HOME']['TOP_RANK']['HERO_KILLS'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top Hero Kills
$CTM_SETTINGS['HOME']['TOP_RANK']['GUILDS'] = array(TRUE /* Switch */, 5 /* Limite (1 ~ 5) */, TRUE /* Exibir em Foto/Logo */); // -- Top Guilds
$CTM_SETTINGS['HOME']['SCREENSHOTS']['SHOW'] = TRUE; // -- Mostrar ScreenShots Recentes (Padrão -> TRUE)

/******** Configurações das Notícias via Fórum *********
	@ Modulo 1 : Invision Power Board (IPB)
	@ Modulo 2 : vBulletin
	@ Modulo 3 : phpBB
	@ Modulo 4 : Simple Machines Forum (SMF)
*******************************************************/
$CTM_SETTINGS['HOME']['FORUM']['SHOW'] = FALSE; // -- Mostrar Notícias (Padrão -> TRUE)
$CTM_SETTINGS['HOME']['FORUM']['MODULE'] = 1; // -- Modulo do Fórum
$CTM_SETTINGS['HOME']['FORUM']['LINK'] = "http://ew.ctmts.com.br:8090/board/smf"; // -- Link do Fórum
$CTM_SETTINGS['HOME']['FORUM']['MySQL']['HOST'] = "localhost"; // -- Host/IP do MySQL (Padrão -> localhost)
$CTM_SETTINGS['HOME']['FORUM']['MySQL']['PORT'] = 3306; // -- Porta do MySQL (Padrão -> 3306)
$CTM_SETTINGS['HOME']['FORUM']['MySQL']['USER'] = "root"; // -- Usuário do MySQL
$CTM_SETTINGS['HOME']['FORUM']['MySQL']['PASS'] = "xxxxxxxxx"; // -- Senha do MySQL
$CTM_SETTINGS['HOME']['FORUM']['MySQL']['DATA'] = "invision"; // -- DataBase do Fórum (Padrão -> forum)
$CTM_SETTINGS['HOME']['FORUM']['PREFIX'] = "ctm_"; // -- Prefixo das Tables (Padrão -> ibf_)
$CTM_SETTINGS['HOME']['FORUM']['FORUM_ID'] = array(1,2); // -- IDs dos Fóruns das Notícias
$CTM_SETTINGS['HOME']['FORUM']['UTF8_DECODE'] = FALSE; // -- Ativar Debug dos Titulos (Caso esteja Bugado)
$CTM_SETTINGS['HOME']['FORUM']['LIMIT'] = 7; // -- Tota de Notícias (Padrão -> 7)
$CTM_SETTINGS['HOME']['FORUM']['NEW_WINDOW'] = TRUE; // -- Abrir em nova Janela (Padrão -> true)


/*****************************************************************************
	@ Download Settings
	@ Configurações da Pagina de Downloads
	@ As opções não são limitadas
	@ Configurações em array, muito cuidado ao configurar
	@ ---------------------------------------------------
	@ Exemplos para as categorias (CATEGORYS)
	@ $_DOWNLOADS['CATEGORYS'][ID] = "Name";
	@ ---------------------------------------------------
	@ Exemplos para os arquivos (ARCHIVES)
	@ SET 0: $CTM_SETTINGS['DOWNLOADS']['ARCHIVES'][CATEGORIA][ID]['NAME'] = "Nome";
	@ SET 1: $CTM_SETTINGS['DOWNLOADS']['ARCHIVES'][CATEGORIA][ID]['DESC'] = "Descrição";
	@ SET 2: $CTM_SETTINGS['DOWNLOADS']['ARCHIVES'][CATEGORIA][ID]['SIZE'] = "Tamanho";
	@ SET 3: $CTM_SETTINGS['DOWNLOADS']['ARCHIVES'][CATEGORIA][ID]['LINK'] = array("Link 1", "Link 2", [...]);
*****************************************************************************/
$CTM_SETTINGS['DOWNLOADS']['CATEGORYS'][0] = "Arquivos Gerais";
$CTM_SETTINGS['DOWNLOADS']['CATEGORYS'][1] = "Ferramentas";

$CTM_SETTINGS['DOWNLOADS']['ARCHIVES'][0][0]['NAME'] = "Client Full";
$CTM_SETTINGS['DOWNLOADS']['ARCHIVES'][0][0]['DESC'] = "Client completo";
$CTM_SETTINGS['DOWNLOADS']['ARCHIVES'][0][0]['SIZE'] = "200Mb";
$CTM_SETTINGS['DOWNLOADS']['ARCHIVES'][0][0]['LINK'] = array("http://www.mediafire.com", "http://www.4shared.com");

$CTM_SETTINGS['DOWNLOADS']['ARCHIVES'][1][0]['NAME'] = "Mu Windows";
$CTM_SETTINGS['DOWNLOADS']['ARCHIVES'][1][0]['DESC'] = "Minimizer";
$CTM_SETTINGS['DOWNLOADS']['ARCHIVES'][1][0]['SIZE'] = "1Mb";
$CTM_SETTINGS['DOWNLOADS']['ARCHIVES'][1][0]['LINK'] = array("http://www.rapidshare.com", "http://www.filesonic.com");

/*****************************************************************************
	@ Ranking Settings
	@ Configurações dos Rankings
	@ TRUE = Sim
	@ FALSE = Não
******************************************************************************/
$CTM_SETTINGS['RANKING']['RESETS_GENERAL'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de Reset
$CTM_SETTINGS['RANKING']['RESETS_DAILY'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de Reset Diario
$CTM_SETTINGS['RANKING']['RESETS_WEEKLY'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de Reset Semanal
$CTM_SETTINGS['RANKING']['RESETS_MONTHLY'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de Reset Mensal
$CTM_SETTINGS['RANKING']['MASTER_RESETS'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de Master Reset
$CTM_SETTINGS['RANKING']['MRESETS_DAILY'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de Master Reset Diário
$CTM_SETTINGS['RANKING']['MRESETS_WEEKLY'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de Master Reset Semanal
$CTM_SETTINGS['RANKING']['MRESETS_MONTHLY'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de Master Reset Mensal
$CTM_SETTINGS['RANKING']['LEVEL'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de Level
$CTM_SETTINGS['RANKING']['MASTER_LEVEL'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de Master Level (Somente Season 3 EP2 / Superior)
$CTM_SETTINGS['RANKING']['PK_KILLS'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de PK Kills
$CTM_SETTINGS['RANKING']['HERO_KILLS'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de Hero Kills
$CTM_SETTINGS['RANKING']['GUILDS'] = array(TRUE /* Ativar/Desativar */,50 /* Limite Padrão */); // -- Ranking de Guilds
$CTM_SETTINGS['RANKING']['FORMAT'] = TRUE; // -- Formar os números dos rankings (Padrão -> TRUE)
##################################################################
	# Tops Ranking
	# Lista de Top do Gerador de Rankings
	# Exemplo: Numero Maximo,
##################################################################
$CTM_SETTINGS['RANKING']['GENERATOR']['LIMIT'] = array(10, 50, 100, 200);

/*****************************************************************************
	@ Contact Settings
	@ Configurações da Página Contato
	@ As opções não são limitadas
	@ Configurações em array, muito cuidado ao configurar
	@ ---------------------------------------------------
	@ TRUE = Sim
	@ FALSE = Não
	@ ---------------------------------------------------
	@ Exemplos para os E-Mails (MAIL)
	@ $CTM_SETTINGS['CONTACT']['MAIL'][DEIXE EM BRANCO] = array("E-Mail", "Assunto/Responsável");
	@ ---------------------------------------------------
	@ Exemplos para os Telefones (PHONE)
	@ $CTM_SETTINGS['CONTACT']['PHONE'][DEIXE EM BRANCO] = array("Número", "Assunto/Responsável", "Falar com:");
******************************************************************************/
$CTM_SETTINGS['CONTACT']['ENABLE_PHONE'] = TRUE; // -- Habilitar/Desabilitar Suporte por Telefone (Padrão -> TRUE)

$CTM_SETTINGS['CONTACT']['MAIL'][] = array("erick-master@ctmts.com.br", "Erick-Master");
$CTM_SETTINGS['CONTACT']['MAIL'][] = array("vendas@ctmts.com.br", "Suporte a Vendas");

$CTM_SETTINGS['CONTACT']['PHONE'][] = array("(00) 0000-0000", "Erick-Master", "Erick");

/*****************************************************************************
	@ Payment Methods
	@ Métodos de pagamentos
	@ As opções não são limitadas
	@ Configurações em array, muito cuidado ao configurar
	@ ---------------------------------------------------
	@ Exemplos para o formulário de confirmação (FORM):
	@ Nome : $CTM_SETTINGS['PAYMENTMETHOD']['FORM'][ID][0] = "Nome";
	@ Form : $CTM_SETTINGS['PAYMENTMETHOD']['FORM'][ID][1] = array("Input ID" => "Input Label", ...);
	@ ---------------------------------------------------
	@ Exemplos para a lista de bancos (BANK):
	@ Exemplo: $CTM_SETTINGS['PAYMENTMETHOD']['BANK'][ID][DEIXE EM BRANCO] = array("Rótulo" => "Valor");
******************************************************************************/
$CTM_SETTINGS['PAYMENTMETHOD']['FORM'][0][0] = "Caixa Econômica Federal (Agencia)";
$CTM_SETTINGS['PAYMENTMETHOD']['FORM'][0][1] = array("Terminal" => "Terminal");

$CTM_SETTINGS['PAYMENTMETHOD']['FORM'][1][0] = "Caixa Econômica Federal (Loterica)";
$CTM_SETTINGS['PAYMENTMETHOD']['FORM'][1][1] = array("Control" => "Controle", "Terminal" => "Terminal");

$CTM_SETTINGS['PAYMENTMETHOD']['BANK'][0][] = array("Banco:" => "Caixa Econômica Federal");
$CTM_SETTINGS['PAYMENTMETHOD']['BANK'][0][] = array("Agência" => "0000");
$CTM_SETTINGS['PAYMENTMETHOD']['BANK'][0][] = array("Conta:" => "0000000-0");
$CTM_SETTINGS['PAYMENTMETHOD']['BANK'][0][] = array("Operação:" => "000");
$CTM_SETTINGS['PAYMENTMETHOD']['BANK'][0][] = array("Tipo de Conta:" => "Poupança");
$CTM_SETTINGS['PAYMENTMETHOD']['BANK'][0][] = array("Favorecido:" => "CTM TEAM Softwares");

$CTM_SETTINGS['PAYMENTMETHOD']['BANK'][1][] = array("Banco:" => "Banco do Brasil");
$CTM_SETTINGS['PAYMENTMETHOD']['BANK'][1][] = array("Agência" => "0000");
$CTM_SETTINGS['PAYMENTMETHOD']['BANK'][1][] = array("Conta:" => "0000000-0");
$CTM_SETTINGS['PAYMENTMETHOD']['BANK'][1][] = array("Tipo de Conta:" => "Poupança");
$CTM_SETTINGS['PAYMENTMETHOD']['BANK'][1][] = array("Favorecido:" => "CTM TEAM Softwares");

/*****************************************************************************
	@ WebStore Settings
	@ Configurações dos WebStore
	@ TRUE = Sim
	@ FALSE = Não
******************************************************************************/
$CTM_SETTINGS['WEBSTORE']['STORE_ENABLE'][1] = TRUE; // -- Habilitar shop de moeda 1 (Padrão -> TRUE)
$CTM_SETTINGS['WEBSTORE']['STORE_ENABLE'][2] = TRUE; // -- Habilitar shop de moeda 2 (Padrão -> TRUE)
$CTM_SETTINGS['WEBSTORE']['STORE_ENABLE'][3] = TRUE; // -- Habilitar shop de moeda 3 (Padrão -> TRUE)

/*****************************************************************************
	@ Coin Settings
	@ Configurações de Moedas
******************************************************************************/
define("COIN_NUMBER", 3); // -- Número de Moedas [De 1 a 3]
define("COIN_NAME_1", "Cash"); // -- Nome da Moeda 1
define("COIN_NAME_2", "Gold"); // -- Nome da Moeda 2
define("COIN_NAME_3", "Point"); // -- Nome da Moeda 3
define("COIN_CORE", "MuOnline"); // -- DataBase de Golds (Padrão -> MuOnline)
define("COIN_TABLE", "MEMB_INFO"); // -- Tabela de Golds (Padrão -> MEMB_INFO)
define("COIN_COLUMN_1", "Cash"); // -- Coluna de Golds (Padrão -> Cash)
define("COIN_COLUMN_2", "Gold"); // -- Coluna de Golds (Padrão -> Gold)
define("COIN_COLUMN_3", "Points"); // -- Coluna de Golds (Padrão -> Point)
define("COIN_LOGIN", "memb___id"); // -- Coluna de Logins para Golds (Padrão -> memb___id)
define("COIN_USE_CACHE", TRUE); // -- Utilizar o sistema de cache, recomendado para servidores com CashShop (Padrão -> FALSE)

/*****************************************************************************
	@ VIP Settings
	@ Configurações de Conta VIP
******************************************************************************/
define("VIP_NUMBER", 5); // -- Número de tipos de VIP [De 1 a 5] (Padrão -> 2)
define("VIP_NAME_1", "VIP-Normal"); // -- Nome do VIP 1
define("VIP_NAME_2", "VIP-Master"); // -- Nome do VIP 2
define("VIP_NAME_3", "VIP-Shock"); // -- Nome do VIP 3
define("VIP_NAME_4", "VIP-Super"); // -- Nome do VIP 4
define("VIP_NAME_5", "VIP-Mega"); // -- Nome do VIP 5
define("VIP_CORE", "MuOnline"); // -- DataBase das contas VIP (Padrão -> MuOnline)
define("VIP_TABLE", "MEMB_INFO"); // -- Tabela das contas VIP (Padrão -> MEMB_INFO)
define("VIP_COLUMN", "Vip"); // -- Coluna de VIP (Padrão -> vip)
define("VIP_BEGIN", "VIP_Begin"); // -- Columna de Inicio do VIP (Padrão -> VIP_Begin)
define("VIP_TIME", "VIP_Time"); // -- Coluna de Tempo VIP em numeros Inteiros (Padrão -> VIP_Time)
define("VIP_LOGIN", "memb___id"); // -- Coluna de Logins VIP (Padrão -> memb___id)

 
/*****************************************************************************
	@ Class Settings
	@ Configurações da Classes
******************************************************************************/
$CTM_SETTINGS['CLASSCODE'] = array
(
	"DW" => array(0, "Dark Wizard"), // -- Dark Wizard
	"SM" => array(1, "Soul Master"), // -- Soul Master
	"GM" => array(2, "Grand Master"), // -- Grand Master
	"DK" => array(16, "Dark Knight"), // -- Dark Knight
	"BK" => array(17, "Blade Knight"), // -- Blade Knight
	"BM" => array(18, "Blade Master"), // -- Blade Master
	"FE" => array(32, "Fary Elf"), // -- Fary Elf
	"ME" => array(33, "Muse Elf"), // -- Muse Elf
	"HE" => array(34, "High Elf"), // -- High Elf
	"MG" => array(48, "Magic Gladiator"), // -- Magic Gladiator
	"DM" => array(50, "Duel Master"), // -- Duel Master
	"DL" => array(64, "Dark Lord"), // -- Dark Lord
	"LE" => array(66, "Lord Emperor"), // -- Lord Emperor
	"SU" => array(80, "Summoner"), // -- Summoner
	"BS" => array(81, "Blood Summoner"), // -- Blood Summoner
	"DIM" => array(82, "Dimension Master"), // -- Dimension Master
	"RF" => array(96, "Rage Fighter"), // -- Rage Fighter (Season 6)
	"FM" => array(98, "Fist Master"), // -- Fist Master (Season 6)
);


/*****************************************************************************
	@ Initial Points
	@ Configurações dos Pontos iniciais das classes
	@ Informações: "CLASS" => array(Força, Agilidade, Vitalidade, Energia, Comando)
******************************************************************************/
$CTM_SETTINGS['INITIALPOINTS'] = array
(
	"DW/SM/GM"  => array(18, 18, 15, 30, 0), // -- Dark Wizard / Soul Master / Grand Master
	"DK/BK/BM"  => array(28, 20, 25, 10, 0), // -- Dark Knight / Blade Knight / Blade Master
	"FE/ME/HE"  => array(22, 25, 20, 15, 0), // -- Fairy Elf / Muse Elf / High Elf
	"MG/DM"     => array(26, 26, 26, 26, 0), // -- Magic Gladiator / Duel Master
	"DL/LE"     => array(26, 20, 20, 15, 25), // -- Dark Lord / Lord Emperor
	"SU/BS/DIM" => array(21, 21, 18, 23, 0), // -- Summoner / Bloody Summoner / Dimension Master
	"RF/FM"     => array(25, 27, 32, 20, 0), // -- Rage Fighter / Fist Master
);
						
						
/*****************************************************************************
	@ Initial Map
	@ Configurações do mapa inicial das classes
	@ Informações: "CLASS" => array(Número do Mapa, Coordenada X, Coordenada Y)
******************************************************************************/
$CTM_SETTINGS['INITIALMAP'] = array
(
	"DW/SM/GM"  => array(0, 125, 125), // -- Dark Wizard / Soul Master / Grand Master
	"DK/BK/BM"  => array(0, 125, 125), // -- Dark Knight/ Blade Knight / Blade Master
	"FE/ME/HE"  => array(3, 174, 111), // -- Fairy Elf / Muse Elf / High Elf
	"MG/DM"     => array(0, 125, 125), // -- Magic Gladiator / Duel Master
	"DL/LE"     => array(0, 125, 125), // -- Dark Lord / Lord Emperor
	"SU/BS/DIM" => array(51, 53, 226), // -- Summoner / Bloody Summoner / Dimension Master
	"RF/FM"     => array(0, 125, 125), // -- Rage Fighter / Fist Master
);
					 
					
/*****************************************************************************
	@ Map Settings
	@ Configurações dos Mapas
	@ Exemplo: Número do Mapa => array(Coordenada X, Coordenada Y, "Nome do Mapa"),
******************************************************************************/
$CTM_SETTINGS['MAPDATA'] = array
(
	0 => array(125, 125, "Lorencia"),
	1 => array(231, 126, "Dungeon"),
	2 => array(120, 38, "Devias"),
	3 => array(174, 108, "Noria"),
	4 => array(207, 78, "Lost Tower"), 
	6 => array(62, 114, "Stadium"),
	7 => array(16, 14, "Atlans"),
	8 => array(202, 68, "Tarkan"),
	10 => array(125, 125, "Icarus"),
	24 => array(125, 125, "Kalima 1"),
	25 => array(125, 125, "Kalima 2"),
	26 => array(125, 125, "Kalima 3"),
	27 => array(125, 125, "Kalima 4"),
	28 => array(125, 125, "Kalima 5"),
	29 => array(125, 125, "Kalima 6"),
	36 => array(125, 125, "Kalima 7"),
	30 => array(93, 214, "Valey of Loren"),
	31 => array(93, 214, "Land of Trial"),
	33 => array(84, 13, "Aida"),
	34 => array(228, 41, "Crywolf"),
	37 => array(71, 218, "KantruLand"),
	38 => array(71, 105, "KantruRuin"),
	39 => array(69, 185, "Kantru Island"),
	41 => array(28, 76, "Barracks"),
	42 => array(97, 185, "Refuge"),
	51 => array(51, 216, "Elbeland"),
	56 => array(140, 106, "Swamp of Calmness"),
	57 => array(221, 210, "Raklion"),
	64 => array(51, 216, "Vulcanus"),
	79 => array(51, 216, "Loren Market"),
	80 => array(126, 124, "Kalrutan 1"),
	81 => array(163, 16, "Kalrutan 2"),
);