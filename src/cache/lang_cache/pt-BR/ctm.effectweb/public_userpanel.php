<?php
/*****************************************************/
/* Cetemaster Board - Language Words System          */
/* Package: Effect Web v2.x                          */
/*****************************************************/
/* Language: Blazilian Portuguese                    */
/* File: User Control Panel Module                   */
/*****************************************************/
/* Author: Erick-Master                              */
/* Last Update: 27/07/2012 - 15:23h                  */
/*****************************************************/

$CTM_LANG = array
(
	"UserPanel" => array
	(
		"Global" => array
		(
			"Title" => "Painel de Controle",
			"Tabs" => array
			(
				1 => "Conta",
				2 => "Personagem",
				3 => "Suporte e Financeiro",
			),
			"Menu" => array
			(
				"Home" => "Minha Conta",
				"ChangeData" => "Alterar Dados",
				"ChangeMail" => "Alterar E-Mail",
				"ChangePID" => "Alterar Personal ID",
				"ManageChar" => "Gerenciar Personagem",
				"VirtualVault" => "Virtual Vault",
				"DisconnectGame" => "Desconectar do Jogo",
				"CharSelected" => "Gerenciando:",
				"ResetSystem" => "Resetar",
				"MasterReset" => "Master Reset",
				"TransferResets" => "Transferir Resets",
				"ClearPk" => "Limpar Pk/Hero",
				"ChangeClass" => "Alterar Classe",
				"ChangeName" => "Alterar Nick",
				"MoveCharacter" => "Mover Personagem",
				"ManageProfile" => "Gerenciar Perfil",
				"ChangeAvatar" => "Alterar Avatar",
				"RepairPoints" => "Reparar Pontos",
				"RedistributePoints" => "Redistribuir Pontos",
				"DistributePoints" => "Distribuir Pontos",
				"ClearCharacter" => "Limpar Personagem",
				"SupportTickets" => "Tickets de Suporte",
				"Invoices" => "Faturas",
				"ConvertCoin" => "Converter Moedas",
				"BuyVIP" => "Comprar VIP",
			),
			"Messages" => array
			(
				"OptionDisabled" => "Esta opção se encontra desabilitada.",
				"Privilegy" => "Sua conta não possui privilégio para acessar esta página.",
				"Blocked" => "Sua conta se encontra bloqueada para acessar esta página.",
				"Connected" => "Sua conta se encontra conectada, por favor deslogue-se do jogo.",
			),
		),
		"Home" => array
		(
			"Title" => "Minha Conta",
			"Member" => array
			(
				"Id" => "Id",
				"Login" => "Login:",
				"CoinBalance" => array
				(
					1 => "Saldo de ".COIN_NAME_1.":",
					2 => "Saldo de ".COIN_NAME_2.":",
					3 => "Saldo de ".COIN_NAME_3.":",
				),
				"Plan" => "Plano de conta:",
				"Expiration" => "Vencimento:",
				"Birth" => "Nascimento:",
			),
			"LastConnection" => array
			(
				"Title" => "Última Conexão",
				"Date" => "Data:",
				"Hour" => "Hora:",
				"Server" => "Servidor:",
				"IP" => "IP:",
				"Status" => "Status:",
				"Disconnect" => "Desconectar",
			),
			"Characters" => array
			(
				"Title" => "Personagens",
				"Name" => "Personagem:",
				"Class" => "Classe:",
				"Level" => "Level:",
				"Guild" => "Guild:",
				"Manage" => "Gerenciar:",
				"ManageLink" => "Gerenciar",
			),
			"BlockMessage" => array
			(
				"Title" => "Atenção: Sua conta se encontra banida.",
				"Reason" => "Motivo:",
				"Responsible" => "Responsável:",
				"Expiration" => "Vencimento:",
			),
			"CharBlocked" => "Personagem <strong>%s</strong> banido até <strong>%s</strong>.",
		),
		"ChangeData" => array
		(
			"Title" => "Alterar Dados",
			"Data" => array
			(
				"Title" => "Dados",
				"Name" => "Nome:",
				"Mail" => "E-Mail:",
				"Phone" => "Telefone:",
				"Button" => "Prosseguir",
				"Messages" => array
				(
					"NULL_Name" => "Nome",
					"NULL_Phone" => "Telefone",
					"NULL_Message" => "Os seguintes campos devem ser preenchidos:",
					"Success" => "Dados alterados com sucesso!",
				),
			),
			"Password" => array
			(
				"Title" => "Senha",
				"CurrentPassword" => "Senha atual:",
				"NewPassword" => "Nova senha",
				"CNewPassword" => "Confirmar nova senha:",
				"SecureQuestion" => "Pergunta: <strong>%s</strong>",
				"Button" => "Prosseguir",
				"Messages" => array
				(
					"NULL_Password" => "Senha atual",
					"NULL_NewPassword" => "Nova senha",
					"NULL_CNewPassword" => "Confirmação da nova senha",
					"NULL_SecureAnswer" => "Resposta secreta",
					"NULL_Message" => "Os seguintes campos devem ser preenchidos:",
					"Error_Words" => "Não use símbulos na nova senha",
					"Error_Confirm" => "Senhas não conferem",
					"Error_Answer" => "Resposta secreta inválida",
					"Error_Password" => "Senha atual inválida",
					"Error_Message" => "Os seguintes erros foram encontrados:",
					"Success" => "Senha alterada com sucesso!",
				),
			),
		),
		"ChangeMail" => array
		(
			"Title" => "Alterar E-Mail",
			"NewMail" => "Novo E-Mail:",
			"ConfirmCode" => "Código de confirmação:",
			"Button_Process" => "Alterar E-Mail",
			"Button_SendCode" => "Solicitar código de confirmação",
			"Messages" => array
			(
				"SendCode" => array
				(
					"Error_SendMail" => "[#%d] Não foi possível completar seu pedido.<br />Entre em contato com a administração.",
					"Success" => "<strong>E-Mail enviado com sucesso!</strong><br />Entre em sua conta de e-mail para obter o código de confirmação.",
				),
				"Process" => array
				(
					"Void" => "Todos os campos devem ser preenchidos.",
					"MailInvalid" => "Formanto de e-mail inválido.",
					"CodeInvalid" => "Código de confirmação inválido.",
					"CodeExpired" => "Este código de confirmação está expirado.",
					"Success" => "Seu e-mail foi alterado com sucesso!",
				),
			),
		),
		"ChangePID" => array
		(
			"Title" => "Alterar Personal ID",
			"Message" => "O Personal ID (PID) é necessário em algumas operações in-game, como deletar personagem, sair de guild, etc.",
			"NewPID" => "Novo Personal ID:",
			"Password" => "Senha da conta:",
			"SecureQuestion" => "Pergunta: <strong>%s</strong>",
			"Button" => "Proceder",
			"Messages" => array
			(
				"Void" => "Todos os campos devem ser preenchidos",
 				"Error_Words" => "O Personal ID deve ser somente númerico.",
				"Error_Length" => "O Personal ID deve conter somente 7 digitos.",
				"Error_Password" => "Senha atual da conta inválida.",
				"Error_Answer" => "Resposta secreta inválida.",
				"Success" => "Seu Personal ID foi alterado com sucesso!",
			),
		),
		"VirtualVault" => array
		(
			"Title" => "Virtual Vault (Baú Virtual)",
			"GameVault" => "Baú Game",
			"VirtualVault" => "Baú Virtual",
			"OnlyRetire" => "O Virtal Vault (Baú Virtual) é usado para você retirar itens recebidos em prêmios e sistemas do ".SERVER_NAME.".<br />Não é possível adicionar itens ao Virtual Vault, apenas retirá-los.",
			"Messages" => array
			(
				"VaultFull" => "Seu baú não possui espaço suficiente.",
				"VirtualFull" => "Você não pode ter mais de <strong>%d</strong> item(s) no Baú Virtual.",
			),
		),
		"ManageChar" => array
		(
			"Title" => "Gerenciar Personagem",
			"Message" => "Selecione um personagem para gerenciar:",
			"Level" => "Level:",
			"Guild" => "Guild:",
			"Messages" => array
			(
				"NoChars" => "Você não possui personagens no momento.",
				"Select" => "Selecione um personagem.",
				"Invalid" => "Personagem inválido ou não pertence a sua conta.",
			),
		),
		"DisconnectGame" => array
		(
			"Title" => "Desconectar do Jogo",
			"Message" => "Deseja desconectar sua conta do jogo agora?",
			"Button" => "Desconectar",
			"Messages" => array
			(
				"Offline" => "Sua conta se encontra offline no jogo.",
				"Error" => "[#%d] Não foi possível desconectar sua conta.<br />Entre em contato com a administração.",
				"Success" => "Conta desconectada com sucesso!",
			),
		),
		"ViewCharacter" => array
		(
			"Title" => "Ver Personagem",
			"Infos" => array
			(
				"Class" => "Classe:",
				"Level" => "Level:",
				"Experience" => "Experiência:",
				"Points" => "Pontos restantes:",
				"Resets" => "Resets:",
				"MasterResets" => "Master Resets:",
				"Strength" => "Força:",
				"Dexterity" => "Agilidade:",
				"Vitality" => "Vitalidade:",
				"Energy" => "Energia:",
				"Command" => "Comando:",
				"MapName" => "Mapa:",
				"MapPosX" => "Posição X:",
				"MapPosY" => "Posição Y:",
			),
			"Buttons" => array
			(
				"Inventory" => "Inventário",
			),
			"Inventory" => array
			(
				"Title" => "Inventário",
				"Tabs" => array
				(
					"Equipments" => "Equipamentos",
					"Inventory" => "Inventário",
					"PersonalStore" => "Personal Store",
				),
				"NoItem" => "Sem Item",
				"Equipments" => array
				(
					"Hand" => array
					(
						"Left" => "Mão Esquerda:",
						"Right" => "Mão Direita:",
					),
					"Set" => array
					(
						"Helm" => "Set Helm:",
						"Armor" => "Set Armor:",
						"Pants" => "Set Pants:",
						"Gloves" => "Set Gloves:",
						"Boots" => "Set Boots:",
					),
					"Wing" => "Asa:",
					"Pet" => "Pet/Guardian:",
					"Pendant" => "Pendant:",
					"Ring" => array
					(
						"Left" => "Ring Esquerdo:",
						"Right" => "Ring Direito:",
					),
				),
				"Inventory" => "Inventário",
				"PersonalStore" => "Personal Store",
			),
		),
		"ResetSystem" => array
		(
			"Title" => "Resetar Personagem",
			"Requirements" => "Requerimentos para resetar:",
			"Require" => array
			(
				"Level" => "Level:",
				"Money" => "Zen:",
			),
			"Before" => array
			(
				"Title" => "Status antes do reset:",
				"Resets" => "Resets:",
				"Level" => "Level:",
				"Points" => "Pontos a distribuir:",
				"Strength" => "Força:",
				"Dexterity" => "Agilidade:",
				"Vitality" => "Vitalidade:",
				"Energy" => "Energia:",
				"Command" => "Comando:",
				"Class" => "Classe:",
				"Money" => "Zen:",
			),
			"After" => array
			(
				"Title" => "Status após o reset:",
				"Resets" => "Resets:",
				"Level" => "Level:",
				"Points" => "Pontos a distribuir:",
				"Strength" => "Força:",
				"Dexterity" => "Agilidade:",
				"Vitality" => "Vitalidade:",
				"Energy" => "Energia:",
				"Command" => "Comando:",
				"Class" => "Classe:",
				"Money" => "Zen:",
				"ClearInventory" => "Inventário limpo:",
				"ClearSkill" => "Skills limpas:",
				"ClearQuest" => "Quests limpas:",
			),
			"Button" => "Resetar personagem",
			"Messages" => array
			(
				"Error_Level" => "Level insuficiente",
				"Error_Money" => "Zen insuficiente",
				"Error_Message" => "Os seguintes erros foram encontrados:",
				"Success" => "Personagem resetado com sucesso!<br />Agora você possui <strong>%d resets</strong>.",
			),
		),
		"MasterReset" => array
		(
			"Title" => "Master Reset",
			"Requirements" => "Requerimentos para resetar:",
			"Require" => array
			(
				"Resets" => "Resets:",
				"Level" => "Level:",
				"Strength" => "Força:",
				"Dexterity" => "Agilidade:",
				"Vitality" => "Vitalidade:",
				"Energy" => "Energia:",
				"Command" => "Comando:",
				"Money" => "Zen:",
			),
			"Before" => array
			(
				"Title" => "Status antes do master reset:",
				"MResets" => "Master Resets:",
				"Resets" => "Resets:",
				"Level" => "Level:",
				"Points" => "Pontos a distribuir:",
				"Strength" => "Força:",
				"Dexterity" => "Agilidade:",
				"Vitality" => "Vitalidade:",
				"Energy" => "Energia:",
				"Command" => "Comando:",
				"Class" => "Classe:",
				"Money" => "Zen:",
			),
			"After" => array
			(
				"Title" => "Status após o master reset:",
				"MResets" => "Master Resets:",
				"Resets" => "Resets:",
				"Level" => "Level:",
				"Points" => "Pontos a distribuir:",
				"Strength" => "Força:",
				"Dexterity" => "Agilidade:",
				"Vitality" => "Vitalidade:",
				"Energy" => "Energia:",
				"Command" => "Comando:",
				"Class" => "Classe:",
				"Money" => "Zen:",
				"ClearInventory" => "Inventário limpo:",
				"ClearSkill" => "Skills limpas:",
				"ClearQuest" => "Quests limpas:",
			),
			"Button" => "Resetar personagem",
			"Messages" => array
			(
				"Error_Resets" => "Resets insuficientes",
				"Error_Level" => "Level insuficiente",
				"Error_Strength" => "É necessário ter %d pontos em força",
				"Error_Dexterity" => "É necessário ter %d pontos em agilidade",
				"Error_Vitality" => "É necessário ter %d pontos em vitalidade",
				"Error_Energy" => "É necessário ter %d pontos em energia",
				"Error_Command" => "É necessário ter %d pontos em comando",
				"Error_Money" => "Zen insuficiente",
				"Error_Message" => "Os seguintes erros foram encontrados:",
				"Success" => "Master Reset efetuado com sucesso!<br />Agora você possui <strong>%d master resets</strong>.<br />Você foi premiado com <strong>%d %s</strong>.",
			),
		),
		"TransferResets" => array
		(
			"Title" => "Transferir Resets",
			"ResetsAvailable" => "Resets disponíveis:",
			"Require" => "Resets mínimo requerido:",
			"MinSend" => "Mínimo de resets a ser transferido:",
			"MaxSend" => "Máximo de resets a ser transferido:",
			"Character" => "Personagem de destino:",
			"Number" => "Número de resets a ser transferido:",
			"Resets" => "Resets",
			"ResetChar" => "Atenção: O personagem será resetado após a transferência.",
			"Button" => "Proceder",
			"Messages" => array
			(
				"NULL_Destination" => "Selecione o personagem de destino.",
				"NULL_Number" => "Digite o número de resets a ser transferido.",
				"Error_WordsNumber" => "Digite somente números.",
				"Error_Character" => "Você não pode transferir para o mesmo personagem.",
				"Error_ResetsRequire" => "Para transferir você precisa ter no mínimo %d resets.",
				"Error_MinSend" => "Você pode transferir no mínimo %d resets.",
				"Error_MaxSend" => "Você não pode transferir mais do que %d resets.",
				"Error_Resets" => "Você não tem resets suficientes.",
				"Success" => "Transferido %d resets para o personagem %s com sucesso!",
			),
		),
		"ClearPk" => array
		(
			"Title" => "Limpar Pk/Hero",
			"RequireMoney" => "Para limpar, é necessário a quantia de <strong>%d zen</strong>.",
			"Message" => "Deseja limpar seu Pk/Hero?",
			"Button" => "Proceder",
			"Messages" => array
			(
				"NoMoney" => "Zen insuficiente",
				"NoPk" => "Seu personagem não está Pk/Hero.",
				"Message" => "Os seguintes erros forma encontrados:",
				"Success" => "Pk/Hero limpo com sucesso!",
			),
		),
		"ChangeClass" => array
		(
			"Title" => "Alterar Classe",
			"CurrentClass" => "Sua classe atual é:",
			"Warning" => "Atenção: Após alterar a classe, você poderá perder os itens equipados.",
			"SelectClass" => array
			(
				"Label" => "Selecione:",
				1 => "Primeira Classe",
				2 => "Segunda Classe",
				3 => "Terceira Classe",
			),
			"Button" => "Proceder",
			"Confirm" => "Antes de continuar, certifique-se que seu char não possui NENHUM item equipado. Deseja continuar?",
			"Messages" => array
			(
				"SelectClass" => "Selecione a classe que deseja alterar.",
				"RequireQuests" => "Você precisa completar as seguintes Quests:",
				"RequireLevel" => "Você precisa estar no level %d!",
				"CurrentClass" => "Sua classe atual é <strong>%s</strong>!<br />Você não pode alterar sua classe para a classe atual.",
				"Success" => "Sua classe foi alterarada para <strong>%s</strong> com sucesso!",
			),
		),
		"ChangeName" => array
		(
			"Title" => "Alterar Nick",
			"CurrentName" => "Seu nick atual é",
			"NewName" => "Novo nick:",
			"Button" => "Alterar Nick",
			"Messages" => array
			(
				"FieldVoid" => "Digite seu novo nick.",
				"ErrorLength" => "Seu nick deve conter no mínimo 4 digitos.",
				"ErrorWords" => "Não use caracteres especiais.",
				"ErrorGuild" => "É necessário estar fora da guild para continuar.",
				"ErrorSyntax" => "Este nick contem informações inválidas.",
				"ErrorName" => "Este nick se encontra em uso.",
				"Success" => "Nick alterado para <strong>%s</strong> com sucesso!",
				"GeneralError" => "[#%d] Não foi possível completar seu pedido.<br />Entre em contato com a administração.", 
			),
		),
		"MoveCharacter" => array
		(
			"Title" => "Mover Personagem",
			"SelectMap" => "Selecione o mapa na qual queria se mover, independente do seu Level:",
			"Button" => "Mover Personagem",
			"Messages" => array
			(
				"Invalid" => "Selecione um mapa válido.",
				"Success" => "Personagem movido para <strong>%s</strong> com sucesso!",
			),
		),
		"ManageProfile" => array
		(
			"Title" => "Gerenciar Perfil",
			"Message" => "Configure aqui o perfil de seu personagem.",
			"ShowProfile" => "Exbir perfil:",
			"ShowSkills" => "Exbir habilidades:",
			"ShowResets" => "Exbir resets:",
			"ShowMap" => "Exbir mapa:",
			"ShowStatus" => "Exibir se está online:",
			"Button" => "Atualizar",
			"Messages" => array
			(
				"Success" => "Perfil atualizado com sucesso!",
			),
		),
		"ChangeAvatar" => array
		(
			"Title" => "Alterar Avatar",
			"NoImage" => "Sem imagem",
			"SendImage" => "Enviar imagem",
			"SelectImage" => "Selecione",
			"Button" => "Alterar Avatar",
			"Messages" => array
			(
				"SetCommand" => "Selecione uma opção.",
				"NoImage" => "Selecione uma imagem.",
				"ErrorFormat" => "Formato inválido.<br />Os formatos aceitos são: %s",
				"ErrorSize" => "Tamanho da imagem exedido.<br />Máximo: %s Bytes",
				"ImageError" => "Erro ao enviar imagem.",
				"Success" => "Avatar atualizado com sucesso!",
			),
		),
		"RepairPoints" => array
		(
			"Title" => "Reparar Pontos",
			"Message" => "Esta opção irá reparar seus pontos em caso de erros.",
			"Button" => "Proceder",
			"Messages" => array
			(
				"All_Ok" => "Não foram encontrados erros em seus pontos.",
				"Success" => "Todos os pontos reparados com sucesso!",
			),
		),
		"RedistributePoints" => array
		(
			"Title" => "Redistribuir Pontos",
			"Warning" => "Atenção: Esta opção irá somar todos os pontos de cada categoria de seu char e soma-los aos pontos de destribuição, com isso resetando todos os seus pontos.",
			"Before" => array
			(
				"Title" => "Status do personagem antes do comando:",
				"Points" => "Pontos para distribuir:",
				"Strength" => "Força:",
				"Dexterity" => "Agilidade:",
				"Vitality" => "Vitalidade:",
				"Energy" => "Energia:",
				"Command" => "Comando:",
			),
			"After" => array
			(
				"Title" => "Status do personagem após o comando:",
				"Points" => "Pontos para distribuir:",
				"Strength" => "Força:",
				"Dexterity" => "Agilidade:",
				"Vitality" => "Vitalidade:",
				"Energy" => "Energia:",
				"Command" => "Comando:",
			),
			"Button" => "Proceder",
			"Messages" => array
			(
				"MinRequire" => "Precisa ter no minimo %d em todos os stats.",
				"Success" => "Pontos redistribuidos com sucesso!<br />Você agora possui <strong>%s pontos</strong> para distribuir.",
			),
		),
		"DistributePoints" => array
		(
			"Title" => "Distribuir Pontos",
			"Status" => array
			(
				"Title" => "Seu status atual é:",
				"Points" => "Poontos a distribuir:",
				"Strength" => "Força:",
				"Dexterity" => "Agilidade:",
				"Vitality" => "Vitalidade:",
				"Energy" => "Energia:",
				"Command" => "Comando:",
			),
			"Distribute" => array
			(
				"Strength" => "Força:",
				"Dexterity" => "Agilidade:",
				"Vitality" => "Vitalidade:",
				"Energy" => "Energia:",
				"Command" => "Comando:",
			),
			"Button" => "Distribuir",
			"Messages" => array
			(
				"NoPoints" => "Pontos insuficientes",
				"LimitStrength" => "Limite de pontos em <strong>força</strong> excedido",
				"LimitDexterity" => "Limite de pontos em <strong>agilidade</strong> excedido",
				"LimitVitality" => "Limite de pontos em <strong>vitalidade</strong> excedido",
				"LimitEnergy" => "Limite de pontos em <strong>energia</strong> excedido",
				"LimitCommand" => "Limite de pontos em <strong>comando</strong> excedido",
				"Error_Message" => "Os seguintes erros foram encontrados:",
				"Success" => "<strong>Pontos distribuidos com sucesso!</strong><br /><br /> Força: <strong>%s</strong><br />Agilidade: <strong>%s</strong><br />Vitalidade: <strong>%s</strong><br />Energia: <strong>%s</strong><br />#CLASS_LORD# Comando: <strong>%s</strong><br />#/CLASS_LORD#Pontos restantes: <strong>%s</strong>",
			),
		),
		"ClearCharacter" => array
		(
			"Title" => "Limpar Personagem",
			"Warning" => "Atenção: Este comando não poderar ser disfeito, os itens selecionados abaixo serão removidos definitivamente!",
			"Select" => "Selecione o que deve ser removido:",
			"Inventory" => "Inventário",
			"Skill" => "Skills",
			"Quests" => "Quests",
			"Money" => "Zen",
			"Button" => "Proceder",
			"Messages" => array
			(
				"Error" => "Selecione pelo menos uma opção.",
				"Success" => array
				(
					0 => "Personagem limpo com sucesso!",
					1 => "Inventário limpo",
					2 => "Skills limpas",
					3 => "Quests resetadas",
					4 => "Zen zerado",
				),
			),
		),
		"SupportTickets" => array
		(
			"Title" => "Tickets de Suporte",
			"ErrorMessage" => "[#%d] Erro ao processar seu pedido.<br />Entre em contato com a administração.",
			"Menu" => array
			(
				"List" => "Meus Tickets",
				"Open" => "Abrir novo Ticket",
			),
			"Status" => array
			(
				"Opened" => "Aberto",
				"Responded" => "Respondido",
				"Progress" => "Em Andamento",
				"Closed" => "Fechado",
			),
			"ListTickets" => array
			(
				"Title" => "Meus Tickets",
				"Tabs" => array
				(
					"Opened" => "Abertos",
					"Progress" => "Em Andamento",
					"Closed" => "Fechados",
				),
				"Table" => array
				(
					"ID" => "ID:",
					"Subject" => "Assunto:",
					"Departament" => "Departamento:",
					"Character" => "Personagem:",
					"Date" => "Aberto em:",
					"Status" => "Status:",
				),
				"Messages" => array
				(
					"NoOpened" => "Você não possui tickets abertos no momento.",
					"NoProgress" => "Você não possui tickets em andamento no momento.",
					"NoClosed" => "Você não possui tickets fechados no momento.",
				),
			),
			"ShowTicket" => array
			(
				"Title" => "Ticket: %s",
				"Departament" => "Departamento:",
				"Subject" => "Assunto:",
				"Character" => "Enviado por:",
				"Date" => "Aberto em:",
				"Status" => "Status:",
				"Annex" => "Anexo:",
				"Buttons" => array
				(
					"Close" => "Fechar Ticket",
					"Reply" => "Responder Ticket",
				),
				"Replies" => array
				(
					"Character" => "Enviado por:",
					"Date" => "Enviado em:",
				),
				"ReplyTicket" => "Responder Ticket",
				"Messages" => array
				(
					"CloseWarning" => "Atenção: Tem certeza que deseja fechar este ticket?",
					"ReplyVoid" => "Digite sua mensagem.",
					"IsClosed" => "Este ticket se encontra fechado.",
					"Closed" => "Ticket fechado com sucesso!",
				),
			),
			"OpenTicket" => array
			(
				"Title" => "Abrir novo ticket",
				"SelectDepartament" => "Selecione o departamento de acordo o seu problema:",
				"Subject" => "Assunto:",
				"Character" => "Personagem:",
				"Message" => "Mensagem:",
				"Annex" => "Anexo:",
				"Buttons" => array
				(
					"Annex" => "Selecione",
					"Continue" => "Abrir ticket",
				),
				"Messages" => array
				(
					"SelectDepartament" => "Selecione um departamento válido.",
					"SubjectVoid" => "Assunto",
					"SelectCharacter" => "Personagem",
					"MessageVoid" => "Mensagem",
					"VoidMessage" => "Preencha os seguintes campos:",
					"LimitReached" => "Você chegou ao limite de Tickets em abertos.<br />Aguarde o fechamento dos Tickets atuais.",
					"ErrorFormat" => "Formato inválido.<br />Os formatos aceitos são: %s",
					"ErrorSize" => "Tamanho do anéxo exedido.<br />Máximo: %s Bytes",
					"AnnexError" => "Erro ao enviar o anéxo.",
					"Success" => "<strong>Ticket aberto com Sucesso!</strong><br />O número do protocolo é <strong>%d</strong>.<br />Você será atendido pela nossa equipe em 24 horas.<br />A equipe ".SERVER_NAME." agradece o contato.",
				),
			),
		),
		"Invoices" => array
		(
			"Title" => "Faturas",
			"ErrorMessage" => "[#%d] Erro ao processar seu pedido.<br />Entre em contato com a administração.",
			"Menu" => array
			(
				"List" => "Minhas Faturas",
				"Open" => "Abrir Fatura",
			),
			"Status" => array
			(
				"Pending" => "Pendente",
				"InProgress" => "Em Progresso",
				"Paid" => "Pago",
				"Rejected" => "Rejeitado",
				"Canceled" => "Cancelada",
			),
			"Methods" => array
			(
				"Bank" => "Depósito/Transferência Bancária",
			),
			"ListInvoices" => array
			(
				"Title" => "Faturas",
				"Tabs" => array
				(
					"Opened" => "Abertas",
					"Finalized" => "Finalizadas",
					"Canceled" => "Canceladas",
				),
				"Table" => array
				(
					"ID" => "ID:",
					"Quantity" => "Quantidade de ".COIN_NAME_1.":",
					"Value" => "Valor (".MONEY_SYMBOL."):",
					"Date" => "Aberta em:",
					"Status" => "Status:",
				),
				"Messages" => array
				(
					"NoOpened" => "Você não possui faturas abertas no momento.",
					"NoFinalized" => "Você não possui faturas finalizadas no momento.",
					"NoCanceled" => "Você não possui faturas canceladas no momento.",
				),
			),
			"ShowInvoice" => array
			(
				"Title" => "Fatura: #%s",
				"InvoiceInfos" => array
				(
					"Title" => "Informações da Fatura",
					"Document" => "Documento:",
					"StartDate" => "Data de abertura:",
					"Quantity" => "Quantidade de ".COIN_NAME_1.":",
					"Value" => "Valor a ser pago:",
					"Status" => "Status:",
				),
				"PaymentMethod" => array
				(
					"Title" => "Pagamento",
					"Method" => "Método:",
					"Bank" => array
					(
						"Title" => "Informações do Pagamento:",
						"Value" => "Mostrar",
					),
				),
				"Pay" => array
				(
					"Title" => "Pagar Fatura",
					"Bank" => "Depósito/Transferência Bancária",
				),
				"BankWindow" => array
				(
					"Title" => "Dados para depósito",
					"Info" => array
					(
						1 => "Na hora do depósito:",
						2 => "Para depositar você deve anotar os dados da conta bancaria, que se encontra abaixo. Feito isso, vá até ao banco <strong>com os dados da conta</strong> e faça seu depósito.",
						3 => "EXTREMAMENTE IMPORTANTE:",
						4 => "Caso você perca seu comprovante, você não poderá fazer a confirmação, portando iremos aceitar seu depósito como doações. Sem direito a devolução do mesmo.",
					),
					"Confirm" => "Confirmar Pagamento",
				),
				"Messages" => array
				(
					"InvoiceInProgress" => "Esta fatura se encontra em analise.",
				),
			),
			"OpenInvoice" => array
			(
				"Title" => "Abrir Fatura",
				"CoinQuantity" => "Quantidade de ".COIN_NAME_1." que você deseja:",
				"CoinPrice" => "Valor de cada ".COIN_NAME_1.": ",
				"MoneyValue" => "O valor da fatura será de:",
				"Button" => "Abrir Fatura",
				"Messages" => array
				(
					"QuantityVoid" => "Preencha a quantidade de ".COIN_NAME_1.".",
					"QuantitySyntax" => "Use somente números na quantidade de ".COIN_NAME_1.".",
					"Confirm" => "O valor da fatura será de <strong>{MONEY_VALUE}</strong>, deseja continuar?",
					"Success" => "<strong>Fatura aberta com sucesso!</strong><br />Clique em 'Ok' para continuar..."
				),
			),
		),
		"Payments" => array
		(
			"Title" => "Pagamentos",
			"ErrorMessage" => "[#%d] Erro ao processar seu pedido.<br />Entre em contato com a administração.",
			"Status" => array
			(
				"Opened" => "Aberto",
				"Confirmed" => "Confirmado",
				"Rejected" => "Rejeitado",
			),
			"ShowPayment" => array
			(
				"Title" => "Confirmação de Pagamento",
				"PaymentInfos" => array
				(
					"Title" => "Informações do Pagamento",
					"Method" => "Método de Compra:",
					"SendDate" => "Enviado em:",
					"Status" => "Status:",
					"Annex" => "Anexo:",
				),
				"BuyData" => array
				(
					"Title" => "Dados da Compra",
					"Quantity" => "Quantidade de ".COIN_NAME_1.":",
					"Date" => "Data do pagamento:",
					"Hour" => "Hora do pagamento:",
					"Value" => "Valor pago:",
					"Local" => "Local do pagamento:",
				),
				"PaymentData" => "Dados do Pagamento",
				"Message" => "Mensagem adicional:",
			),
			"ConfirmPayment" => array
			(
				"Title" => "Confirmar Pagamento",
				"SelectMethod" => "Selecione o método de acordo feito em  seu pagamento:",
				"MethodSelected" => "Método selecionado:",
				"BuyData" => array
				(
					"Title" => "Dados da Compra",
					"Quantity" => "Quantidade de ".COIN_NAME_1.":",
					"Date" => "Data do pagamento:",
					"Hour" => "Hora do pagamento:",
					"Value" => "Valor pago:",
					"Local" => "Local do pagamento:",
					"LocalField" => array
					(
						"Attendant" => "Atendente",
						"ElectronicBox" => "Caixa Eletrônico",
						"BankTransfer" => "Transferência Bancária",
					),
				),
				"PaymentData" => "Dados do Pagamento",
				"Annex" => array
				(
					"Title" => "Anexo (Recomendado):",
					"Button" => "Selecione",
				),
				"Button" => "Confirmar Pagamento",
				"Messages" => array
				(
					"Warning" => "Atenção: O mau uso deste serviço poderá resultar bloqueio em sua conta.<br />Deseja continuar?",
					"LimitReached" => "Limite de pagamentos abertos atingido.<br />Por favor, aguarde o fechado dos outros <strong>%d</strong> pagamentos antes de continuar.",
					"SelectMethod" => "Selecione um método de pagamento válido.",
					"QuantityVoid" => "Quantidade de".COIN_NAME_1,
					"DateVoid" => "Data do pagamento",
					"HourVoid" => "Hora do pagamento",
					"ValueVoid" => "Valor pago",
					"LocalVoid" => "Local do pagamento",
					"ErrorFormat" => "Formato inválido.<br />Os formatos aceitos são: %s",
					"ErrorSize" => "Tamanho do anéxo exedido.<br />Máximo: %s Bytes",
					"AnnexError" => "Erro ao enviar o anéxo.",
					"VoidMessage" => "Preencha os seguintes campos:",
					"Success" => "<strong>Pagamento confirmado com sucesso!</strong><br /><br />Você será atendimento pelo departamento financeiro em 48 Horas.<br />A equipe ".SERVER_NAME." agradece.",
				),
			),
		),
		"ConvertCoin" => array
		(
			"Title" => "Converter Moedas",
			"Select" => "Selecione uma opção:",
			"Balance_Coin" => array
			(
				1 => "Saldo de ".COIN_NAME_1.":",
				2 => "Saldo de ".COIN_NAME_2.":",
				3 => "Saldo de ".COIN_NAME_3.":",
			),
			"Options" => array
			(
				1 => "Dê ".COIN_NAME_2." para ".COIN_NAME_1,
				2 => "Dê ".COIN_NAME_3." para ".COIN_NAME_1,
				3 => "Dê ".COIN_NAME_3." para ".COIN_NAME_2,
			),
			"Button" => "Prosseguir",
			"Messages" => array
			(
				"Select" => "Selecione uma opção válida.",
				"Error_Balance" => "Seu saldo de <strong>%s</strong> é insuficiente",
				"Success" => "Coneversão feita com sucesso!",
			),
		),
		"BuyVIP" => array
		(
			"Title" => "Comprar VIP",
			"Select" => "Selecione o VIP que deseja comprar:",
			"Balance" => "Seu saldo de ".COIN_NAME_1." é:",
			"CurrentPlan" => "Seu plano atual é:",
			"Expiration" => "Válido até:",
			"SelectPlan" => "Selecione um Plano:",
			"Days" => "Dias",
			"Button" => "Comprar VIP",
			"Messages" => array
			(
				"SelectVIP" => "Selecione um tipo de VIP.",
				"Error_Type" => "Selecione um tipo de VIP válido.",
				"Error_Plan" => "Selecione um plano válido.",
				"Error_Balance" => "Seu saldo de ".COIN_NAME_1." é suficiente.",
				"ChangePlan" => "Sua conta atualmente é <strong>%s</strong>, se continuar, os dias restantes serão zerados. Deseja alterar seu plano?",
				"Success" => "Sucesso! Sua conta agora é <strong>%s</strong>.<br />Seu VIP vence em <strong>%s</strong>.",
			),
		),
	),
);