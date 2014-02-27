<?php
/*****************************************************/
/* Cetemaster Board - Language Words System          */
/* Package: Effect Web v2.x - ACP                    */
/*****************************************************/
/* Language: Blazilian Portuguese                    */
/* File: Members Module                              */
/*****************************************************/
/* Author: Erick-Master                              */
/* Last Update: 01/10/2012 - 14:32h                  */
/*****************************************************/

$CTM_LANG = array
(
	"Members" => array
	(
		"Sidebar" => array
		(
			"Accounts" => array
			(
				"Title" => "Contas",
				"ManageAccounts" => "Gerenciar Contas",
				"ValidatingAccounts" => "Contas em Validação",
				"BannedAccounts" => "Contas Banidas"
			),
			"Characters" => array
			(
				"Title" => "Personagens",
				"ManageCharacters" => "Gerenciar Personagens",
				"CreateCharacter" => "Criar Personagem",
				"BannedCharacters" => "Contas banidas"
			),
			"Team" => array
			(
				"Title" => "Equipe",
				"Members" => array
				(
					"Title" => "Membros",
					"AddMember" => "Adicionar Membro",
				),
				"Groups" => array
				(
					"Title" => "Grupos",
					"CreateGroup" => "Criar Grupo",
				),
				"Permissions" => "Gerenciar Permissões",
			),
		),
		"Home" => array
		(
			"Title" => "Membros",
			"Links" => array
			(
				"Title" => "Navegação rápida:",
				"Accounts" => "Contas",
				"Characters" => "Personagens",
				"TeamMembers" => "E: Membros",
				"TeamGroups" => "E: Grupos",
			),
		),
		"Accounts" => array
		(
			"Search" => array
			(
				"Title" => "Gerenciar Contas",
				"Search" => "Buscar Contas",
				"ReferenceField" => "Referência:",
				"CaseField" => array
				(
					"Field" => "Buscar por:",
					"Login" => "Login",
					"Mail" => "E-Mail",
					"IP" => "Último IP",
				),
				"TypeField" => array
				(
					"Field" => "Tipo de busca:",
					"Exact" => "Valor exato",
					"StartingWith" => "Começando com",
					"EndingWith" => "Terminando com",
					"Containig" => "Contendo",
				),
				"Button" => "Localizar",
				"ResultTable" => array
				(
					"Login" => "Login:",
					"Name" => "Nome:",
					"Mail" => "E-Mail:",
					"IP" => "Último IP:",
				),
				"Actions" => array
				(
					"Ban" => "Banir",
					"Unban" => "Desbanir",
					"ManageVIP" => "Gerenciar VIP",
					"ManageCoin" => "Gerenciar Moeda",
					"Disconnect" => "Desconectar",
					"Button" => "Continuar",
				),
				"Messages" => array
				(
					"SelectAccount" => "Selecione uma conta para continuar.",
					"FieldsVoid" => "Preencha todos os campos.",
					"NoResults" => "Sua busca não retornou nenhum resultado.",
					"Success" => "Sua busca retornou <strong>%d</strong> resultados.",
				),
			),
			"ManageAccount" => array
			(
				"BanAccount" => array
				(
					"Title" => "Banir Conta",
					"ReasonField" => "Motivo:",
					"ExpirationField" => "Vencimento:",
					"Button" => "Proceder",
					"Messages" => array
					(
						"FieldsVoid" => "Preencha todos os campos.",
						"DateInvalid" => "Data de vencimento inválida.",
						"AccountBanned" => "Esta conta se encontra banida.",
						"Success" => "Conta banida com sucesso!<br />Vencimento: <strong>%s</strong>."
					),
				),
				"UnbanAccount" => array
				(
					"Title" => "Desbanir Conta",
					"Reason" => "Motivo:",
					"Expiration" => "Vencimento:",
					"Responsible" => "Responsável:",
					"Button" => "Desbanir Conta",
					"Messages" => array
					(
						"Confirm" => "Tem certeza que deseja desbanir esta conta?",
						"NoBanned" => "Esta conta não se encontra banida.",
						"Success" => "Conta desbanida com sucesso!",
					),
				),
				"ManageVIP" => array
				(
					"Title" => "Gerenciar VIP",
					"Type" => "Tipo de VIP:",
					"Days" => "Dias de VIP:",
					"Buttons" => array
					(
						"Write" => "Executar",
						"Remove" => "Remover",
					),
					"Messages" => array
					(
						"RemoveVIP" => "Tem certeza que deseja remover o VIP desta conta?",
						"Success" => array
						(
							"Added" => "Adicionado '%s' na conta '%s' com sucesso!",
							"Transformed" => "Transformando para '%s' na conta '%s' com sucesso!",
							"Expiration" => "Expira em <strong>%s</strong> (Adicionado <strong>%d dias</strong>).",
							"Removed" => "VIP removido com sucesso!",
						),
					),
				),
				"ManageCoin" => array
				(
					"Title" => "Gerenciar Moeda",
					"Coin" => "Moeda:",
					"Quantity" => "Quantidade:",
					"Button" => array
					(
						"Insert" => "Adicionar",
						"Remove" => "Remover"
					),
					"Messages" => array
					(
						"InvalidCoin" => "Selecione uma moeda´válida.",
						"NoCoin" => "Saldo de <strong>%s</strong> insuficiente para remover.",
						"Success" => array
						(
							"Insert" => "Adicionado <strong>%d %s</strong> com sucesso!",
							"Remove" => "Removido <strong>%d %s</strong> com sucesso!",
						),
					),
				),
				"DisconnectAccount" => array
				(
					"Messages" => array
					(
						"UserOffline" => "Esta conta se encontra desconectada.",
						"Error" => "[#%d] Erro ao desconectar a conta.",
						"Success" => "Conta desconectada com sucesso!",
					),
				),
				"EditAccount" => array
				(
					"Title" => "Editando",
					"Actions" => array
					(
						"Ban" => "Banir Conta",
						"Unban" => "Desbanir Conta",
						"ManageVIP" => "Gerenciar VIP",
						"ManageCoin" => "Gerenciar Moedas",
						"Delete" => "Deletar Conta",
					),
					"Tabs" => array
					(
						"BasicInfos" => "Informações Básicas",
						"OtherInfos" => "Outras Informações",
					),
					"AccountInfos" => array
					(
						"Sex" => "Sexo:",
						"RegisterDate" => "Cadastro em:",
						"LastConnection" => "Última conexão:",
						"ConnectionServer" => "Servidor:",
						"ConnectionIP" => "IP:",
						"Status" => "Status:",
						"Disconnect" => "Desconectar",
					),
					"BasicInfos" => array
					(
						"Details" => array
						(
							"Title" => "Detalhes",
							"Name" => "Nome:",
							"Mail" => "E-Mail:",
							"Password" => "Senha:",
							"PID" => "Personal ID:",
						),
						"Status" => array
						(
							"Title" => "Status",
							"Status" => array
							(
								"Label" => "Status:",
								"Options" => array
								(
									0 => "Normal",
									1 => "Validando",
								),
							),
							"AccountLevel" => "Tipo:",
						),
						"Balances" => array
						(
							"Title" => "Saldos",
							"CoinField" => "%s:",
						),
					),
					"OtherInfos" => array
					(
						"SecureQuestion" => array
						(
							"Title" => "Pergunta Secreta",
							"Question" => "Questão:",
							"Answer" => "Resposta:",
						),
						"Informations" => array
						(
							"Title" => "Informações",
							"Birthday" => "Data de nascimento:",
						),
					),
					"SaveButton" => "Salvar",
					"ChangeName" => array
					(
						"Label" => "Novo nome:",
						"Button" => "Alterar",
						"Messages" => array
						(
							"NameVoid" => "Preencha o novo nome.",
							"MaxLength" => "Tamanho de 10 digitos execido.",
						),
					),
					"ChangeMail" => array
					(
						"Label" => "Novo e-mail:",
						"Button" => "Alterar",
						"Messages" => array
						(
							"MailVoid" => "Preencha o novo e-mail.",
							"InvalidMail" => "E-Mail inválido.",
						),
					),
					"ChangePassword" => array
					(
						"NewPassword" => "Nova senha:",
						"ConfirmNewPassword" => "Confirme a nova senha:",
						"Button" => "Alterar",
						"Messages" => array
						(
							"PasswordVoid" => "Preencha a nova senha.",
							"ConfirmPasswordVoid" => "Preencha a confirmação de senha.",
							"CaractersInvalid" => "Não utilize caracteres especiais na senha.",
							"PasswordError" => "Senhas não conferem.",
						),
					),
					"ChangePID" => array
					(
						"Label" => "Novo Personal ID:",
						"Button" => "Alterar",
						"Messages" => array
						(
							"PIDVoid" => "Preencha o novo Personal ID.",
							"ErrorLength" => "O Personal ID deve conter 7 dígitos.",
							"ErrorCaracters" => "O Persona ID deve ser numérico.",
						),
					),
					"Save" => array
					(
						"Messages" => array
						(
							"FieldsVoid" => "Preencha todos os campos.",
							"ErrorAccountLevel" => "Selecione um tipo de conta válido.",
							"ErrorStatus" => "Selecione um status válido.",
							"Success" => "Altterações salvas com sucesso!", 
						),
					),
					"DeleteAccount" => array
					(
						"NoDelUser" => "Esta conta não pode ser deletada.",
						"NoDelSelf" => "Você não pode deletar sua própria conta.",
						"ConfirmMessage" => "Confirmando este processo, todos os dados referentes a esta conta serão deletados.<br />Deseja continuar?",
						"Success" => "Todos os dados da conta deletados com sucesso!",
					),
				),
			),
			"ValidatingAccounts" => array
			(
				"Title" => "Contas em Validação",
				"Table" => array
				(
					"Account" => "Conta:",
					"Name" => "Nome:",
					"Mail" => "E-Mail:",
					"Code" => "Código de confirmação:",
				),
				"Actions" => array
				(
					"Approve" => "Aprovar contas",
					"ResendEmail" => "Reenviar e-mails de confirmação",
					"Delete" => "Deletar contas",
					"Button" => "Continuar",
				),
				"Messages" => array
				(
					"NoAccounts" => "Não há contas em confirmação no momento.",
					"ConfirmDelete" => "Tem certeza que deseja deletar <strong>%d conta(s)</strong>?",
					"SelectAccount" => "Selecione ao menos uma conta válida.",
					"Success" => array
					(
						"Approve" => "Aprovado <strong>%d conta(s)</strong> com sucesso!",
						"ResendEmail" => "Sucesso!<br />E-Mails enviados: <strong>%d</strong>.<br />Falhas ao enviar: <strong>%d</strong>.",
						"Delete" => "Deletado <strong>%d conta(s)</strong> com sucesso!",
					),
				),
			),
			"BannedAccounts" => array
			(
				"Title" => "Contas Banidas",
				"Table" => array
				(
					"Account" => "Conta:",
					"Expiration" => "Vencimento:",
					"Responsible" => "Responsável:",
					"Reason" => "Motivo:",
				),
				"Button" => "Desbanir Selecionados",
				"Messages" => array
				(
					"NoAccounts" => "Não há contas banidas no momento.",
					"Confirm" => "Tem certeza que deseja desbanir <strong>%d conta(s)</strong>?",
					"SelectAccount" => "Selecione ao menos uma conta válida.",
					"Success" => "Desbanido <strong>%d conta(s)</strong> com sucesso!",
				),
			),
		),
		"Characters" => array
		(
			"Search" => array
			(
				"Title" => "Gerenciar Personagens",
				"Search" => "Buscar Personagens",
				"ReferenceField" => "Referência:",
				"CaseField" => array
				(
					"Field" => "Buscar por:",
					"Name" => "Nome",
					"Login" => "Login",
					"Guild" => "Guild",
				),
				"TypeField" => array
				(
					"Field" => "Tipo de busca:",
					"Exact" => "Valor exato",
					"StartingWith" => "Começando com",
					"EndingWith" => "Terminando com",
					"Containig" => "Contendo",
				),
				"Button" => "Localizar",
				"ResultTable" => array
				(
					"Login" => "Login:",
					"Name" => "Nome:",
					"Class" => "Classe:",
					"Level" => "Level:",
				),
				"Actions" => array
				(
					"Ban" => "Banir",
					"Unban" => "Desbanir",
					"Button" => "Continuar",
				),
				"Messages" => array
				(
					"SelectCharacter" => "Selecione um personagem para continuar.",
					"FieldsVoid" => "Preencha todos os campos.",
					"NoResults" => "Sua busca não retornou nenhum resultado.",
					"Success" => "Sua busca retornou <strong>%d</strong> resultados.",
				),
			),
			"ManageCharacter" => array
			(
				"BanCharacter" => array
				(
					"Title" => "Banir Personagem",
					"ReasonField" => "Motivo:",
					"ExpirationField" => "Vencimento:",
					"Button" => "Proceder",
					"Messages" => array
					(
						"FieldsVoid" => "Preencha todos os campos.",
						"DateInvalid" => "Data de vencimento inválida.",
						"CharacterBanned" => "Este personagem se encontra banido.",
						"Success" => "Personagem banido com sucesso!<br />Vencimento: <strong>%s</strong>."
					),
				),
				"UnbanCharacter" => array
				(
					"Title" => "Desbanir Personagem",
					"Reason" => "Motivo:",
					"Expiration" => "Vencimento:",
					"Responsible" => "Responsável:",
					"Button" => "Desbanir Personagem",
					"Messages" => array
					(
						"Confirm" => "Tem certeza que deseja desbanir este personagem?",
						"NoBanned" => "Este personagem não se encontra banido.",
						"Success" => "Personagem desbanido com sucesso!",
					),
				),
				"EditCharacter" => array
				(
					"Title" => "Editando",
					"Actions" => array
					(
						"Ban" => "Banir Personagem",
						"Unban" => "Desbanir Personagem",
						"Delete" => "Deletar Personagem",
					),
					"Tabs" => array
					(
						"BasicInfos" => "Informações Básicas",
						"ResetInfos" => "Informações de Reset",
						"OtherInfos" => "Outras Informações",
					),
					"CharacterInfos" => array
					(
						"LastConnection" => "Última conexão:",
						"ConnectionServer" => "Servidor:",
						"ConnectionIP" => "IP:",
					),
					"BasicInfos" => array
					(
						"Details" => array
						(
							"Title" => "Detalhes",
							"Name" => "Nome:",
							"Account" => "Conta:",
						),
						"Status" => array
						(
							"Title" => "Status",
							"Class" => "Classe:",
							"CtlCode" => array
							(
								"Label" => "CtlCode:",
								"Options" => array
								(
									0 => "Normal",
									1 => "Banido",
									2 => "Game Master",
								),
							),
						),
						"General" => array
						(
							"Title" => "Geral",
							"Level" => "Level:",
							"LevelUpPoint" => "Pontos:",
							"Experience" => "Experiência:",
							"Money" => "Zen:",
						),
						"Stats" => array
						(
							"Title" => "Stats:",
							"Strength" => "Força:",
							"Dexterity" => "Agilidade:",
							"Vitality" => "Vitalidade:",
							"Energy" => "Energia:",
							"Command" => "Comando:",
						),
					),
					"ResetInfos" => array
					(
						"Resets" => array
						(
							"Title" => "Resets",
							"General" => "Gerais:",
							"Daily" => "Diário:",
							"Weekly" => "Semanal:",
							"Monthly" => "Mensal:",
						),
						"MResets" => array
						(
							"Title" => "Master Resets",
							"General" => "Gerais:",
							"Daily" => "Diário:",
							"Weekly" => "Semanal:",
							"Monthly" => "Mensal:",
						),
					),
					"OtherInfos" => array
					(
						"Map" => array
						(
							"Title" => "Mapa",
							"Map" => "Mapa:",
							"PosX" => "Posição X:",
							"PosY" => "Posição Y:",
						),
						"Pk" => array
						(
							"Title" => "PK",
							"Level" => "Pk Level:",
							"Time" => "Pk Time:",
							"PkCount" => "Pk Kills:",
							"HeroCount" => "Hero Kills:",
						),
					),
					"SaveButton" => "Salvar",
					"ChangeName" => array
					(
						"Label" => "Novo nome:",
						"Button" => "Alterar",
						"Messages" => array
						(
							"NameVoid" => "Preencha o novo nome.",
							"MaxLength" => "Tamanho de 10 digitos execido.",
							"CaractersInvalid" => "Não digite símbolos especiais.",
							"NameInUse" => "Nome em uso.",
							"Error" => "[#%d] Erro ao executar o processo."
						),
					),
					"ChangeAccount" => array
					(
						"Label" => "Nova conta:",
						"Button" => "Alterar",
						"Messages" => array
						(
							"AccountVoid" => "Preencha a nova conta.",
							"MaxLength" => "Tamanho de 10 digitos execido.",
							"AccountNoExists" => "Esta conta não existe.",
							"NoSlot" => "Não há slosts livres.",
						),
					),
					"Save" => array
					(
						"Messages" => array
						(
							"FieldsVoid" => "Preencha todos os campos.",
							"InvalidLevel" => "Digite um level válido.",
							"MaxStrength" => "Limite de 'força' excedido.",
							"MaxDexterity" => "Limite de 'agilidade' excedido.",
							"MaxVitality" => "Limite de 'vitalidade' excedido.",
							"MaxEnergy" => "Limite de 'energia' excedido.",
							"MaxCommand" => "Limite de 'comando' excedido.",
							"InvalidPkLevel" => "Selecione um Pk Level válido.",
							"InvalidClass" => "Selecione uma classe válida.",
							"InvalidCtlCode" => "Selecione um CtlCode válido.",
							"Success" => "Altterações salvas com sucesso!", 
						),
					),
					"DeleteCharacter" => array
					(
						"ConfirmMessage" => "Confirmando este processo, todos os dados referentes a este personagem serão deletados.<br />Deseja continuar?",
						"Success" => "Todos os dados do personagem deletados com sucesso!",
					),
				),
			),
		),
		"Team" => array
		(
			"Members" => array
			(
				"ManageMembers" => array
				(
					"Title" => "Equipe: Gerenciar Membros",
					"Table" => array
					(
						"Id" => "ID:",
						"Name" => "Personagem:",
						"Account" => "Conta:",
						"PrimaryGroup" => "Grupo Primário:",
						"ACP_Access" => "Acesso ao ACP:",
					),
					"Messages" => array
					(
						"NoMembers" => "Não há membros cadastrados no momento.",
						"MemberNoExists" => "Este membro não existe.",
						"Delete" => array
						(
							"Confirm" => "Tem certeza que deseja deletar este membro?",
							"MemberNotExists" => "Este membro não existe.",
							"NoDelMember" => "Este membro não pode ser removido.",
							"NoDelSelf" => "Você não pode remover sua própria conta.",
							"Success" => "Membro removido com sucesso!",
						),
					),
				),
				"EditMember" => array
				(
					"Title" => "Equipe: Editar Membro %s",
					"Fields" => array
					(
						"L_Infos" => "Informações",
						"Account" => "Conta:",
						"Name" => "Personagem:",
						"Contact" => "Contato:",
						"CustomTitle" => "Custom Title:",
						"PrimaryGroup" => "Grupo Primário:",
						"ACP_Access" => "Acesso ao ACP:",
						"SecondaryGroups" => "Grupos Secundários",
					),
					"Button" => "Salvar",
					"Messages" => array
					(
						"FieldsVoid" => "Preencha todos os campos.",
						"MemberExists" => "Esta conta já se encontra cadastrada.",
						"AccountNameError" => "Conta ou personagem inexistentes ou inválidos.",
						"InvalidGroup" => "Grupo inválido.",
						"GroupError" => "O grupo primário não pode ser selecionado como secundário",
						"Success" => "Membro editado com sucesso!",
					),
				),
				"AddMember" => array
				(
					"Title" => "Equipe: Adicionar Membro",
					"SetPermission" => "<strong>Deseja configurar permissões para este membro?</strong><br /><a href='%s'>Configure as permissões para este membro.</a>",
					"Fields" => array
					(
						"L_Infos" => "Informações",
						"Account" => "Conta:",
						"Name" => "Personagem:",
						"Contact" => "Contato:",
						"CustomTitle" => "Custom Title:",
						"PrimaryGroup" => "Grupo Primário:",
						"ACP_Access" => "Acesso ao ACP:",
						"SecondaryGroups" => "Grupos Secundários",
					),
					"Button" => "Adicionar",
					"Messages" => array
					(
						"FieldsVoid" => "Preencha todos os campos.",
						"MemberExists" => "Esta conta já se encontra cadastrada.",
						"AccountNameError" => "Conta ou personagem inexistentes ou inválidos.",
						"InvalidGroup" => "Grupo inválido.",
						"GroupError" => "O grupo primário não pode ser selecionado como secundário",
						"Success" => "Membro adicionado com sucesso!",
					),
				),
			),
			"Groups" => array
			(
				"ManageGroups" => array
				(
					"Title" => "Equipe: Gerenciar Grupos",
					"Table" => array
					(
						"Id" => "ID:",
						"Name" => "Grupo:",
						"ACP_Access" => "Acesso ao ACP:",
						"MemberCount" => "Membros:",
					),
					"Messages" => array
					(
						"NoGroups" => "Não há grupos cadastrados no momento.",
						"GroupNoExists" => "Este grupo não existe.",
						"NoDelGroup" => "Este grupo não pode ser removido.",
					),
					"Delete" => array
					(
						"Title" => "Deletar Grupo: #%d",
						"FieldNewGroup" => "Mover membros para:",
						"Button" => "Proceder",
						"Messages" => array
						(
							"SelectGroup" => "Selecione o grupo.",
							"NewGroupNoExists" => "O grupo selecionado não existe.",
							"Success" => "Grupo deletado e membros movidos com sucesso!",
						),
					),
				),
				"EditGroup" => array
				(
					"Title" => "Equipe: Editar Grupo #%d",
					"FieldName" => "Nome:",
					"FieldTitle" => "Título:",
					"FieldFormatPrefix" => "Prefixo de Formato:",
					"FieldFormatSuffix" => "Sufixo de Formato:",
					"ACP_Access" => "Acesso ao ACP:",
					"Button" => "Salvar",
					"Messages" => array
					(
						"FieldsVoid" => "Preencha todos os campos.",
						"Success" => "Grupo #%d editado com sucesso!",
					),
				),
				"CreateGroup" => array
				(
					"Title" => "Equipe: Criar Grupo",
					"SetPermission" => "<strong>Deseja configurar permissões para este grupo?</strong><br /><a href='%s'>Configure as permissões para este grupo.</a>",
					"FieldName" => "Nome:",
					"FieldTitle" => "Título:",
					"FieldFormatPrefix" => "Prefixo de Formato:",
					"FieldFormatSuffix" => "Sufixo de Formato:",
					"ACP_Access" => "Acesso ao ACP:",
					"Button" => "Criar",
					"Messages" => array
					(
						"FieldsVoid" => "Preencha todos os campos.",
						"Success" => "Grupo #%d criado com sucesso!",
					),
				),
			),
			"Permissions" => array
			(
				"ManagePermissions" => array
				(
					"Title" => "Gerenciar Permissões",
					"Members" => array
					(
						"Title" => "Membros",
						"Name" => "Membro:",
						"PrimaryGroup" => "Grupo Primário:",
						"Create" => "Selecionar membro...",
						"NoMembers" => "Não há membros com permissões cadastradas no momento.",
					),
					"Groups" => array
					(
						"Title" => "Grupos",
						"Name" => "Grupo:",
						"MemberCount" => "Membros:",
						"Create" => "Selecionar grupo...",
						"NoGroups" => "Não há grupos com permissões cadastradas no momento.",
					),
					"Select" => array
					(
						"Title" => "Selecionar...",
						"Member" => array
						(
							"Tab" => "Membro",
							"Label" => "Conta:",
							"Button" => "Selecionar",
						),
						"Group" => array
						(
							"Tab" => "Grupo",
							"Label" => "Grupo:",
							"Button" => "Selecionar",
						),
					),
					"Messages" => array
					(
						"Confirm" => array
						(
							"Member" => "Tem certeza que deseja deletar as permissões deste membro?",
							"Group" => "Tem certeza que deseja deletar as permissões deste grupo?"
						),
						"MemberNoExists" => "Este membro não possui registro de permissão ou não existe.",
						"GroupNoExists" => "Este grupo não possui registro de permissão ou não existe.",
						"MemberDeleted" => "Permissões de membro deletado com sucesso!",
						"GroupDeleted" => "Permissões de grupo deletada com sucesso!",
						"Saved" => "Permissões salvas com sucesso!",
					),
				),
				"SetPermissions" => array
				(
					"Title" => "Equipe: Permissões",
					"Button" => "Salvar",
				),
				"Permissions" => array
				(
					"Tabs" => array
					(
						"ACP" => "AdminCP",
						"System" => "Sistema",
						"Server" => "Servidor",
						"Members" => "Membros",
					),
					"ACP" => array
					(
						"Title" => "Control Panel",
						"Access" => "Conceder acesso ao aplicativo?",
					),
					"System" => array
					(
						"CronJob" => array
						(
							"Title" => "CronJob",
							"Access" => "Conceder acesso ao CronJob?",
						),
						"Templates" => array
						(
							"Title" => "Templates",
							"Access" => "Conceder acesso aos templates?",
						),
						"Analysis" => array
						(
							"Title" => "Analise",
							"Access" => "Conceder acesso ao analisador?",
						),
					),
					"Server" => array
					(
						"GameControl" => array
						(
							"Title" => "Controle do Jogo",
							"Access" => "Conceder acesso ao controle do jogo?",
							"UsersOnline" => "Pode gerenciar e desconectar os usuários online?",
							"SendGlobalMessage" => "Pode enviar mensagem global a tela dos jogadores online?",
						),
					),
					"Members" => array
					(
						"Accounts" => array
						(
							"Title" => "Gerenciar Contas",
							"Access" => "Conceder acesso as contas?",
							"ManageAccount" => array
							(
								"Access" => "Pode gerenciar contas?",
								"BanAccount" => "Pode banir contas?",
								"UnbanAccount" => "Pode desbanir contas?",
								"ManageVIP" => "Pode gerenciar VIP?",
								"ManageCoin" => "Pode gerenciar moedas?",
								"EditAccount" => "Pode editar contas?",
							),
							"ValidatingAccounts" => "Pode gerenciar contas em validação?",
							"BannedAccounts" => "Pode gerenciar contas banidas?",
						),
						"Characters" => array
						(
							"Title" => "Gerenciar Personagens",
							"Access" => "Conceder acesso aos personagens?",
							"ManageCharacter" => array
							(
								"Access" => "Pode gerenciar personagens?",
								"BanCharacter" => "Pode banir personagens?",
								"UnbanCharacter" => "Pode desbanir personagens?",
								"EditCharacter" => "Pode editar personagens?",
							),
							"CreateCharacter" => "Pode criar personagens?",
							"BannedCharacters" => "Pode gerenciar personagens banidos?",
						),
						"Team" => array
						(
							"Title" => "Equipe",
							"Access" => "Conceder acesso a equipe?",
							"Members" => array
							(
								"Access" => "Pode gerenciar membros da equipe?",
							),
							"Groups" => array
							(
								"Access" => "Pode gerenciar grupos da equipe?",
							),
							"Permissions" => array
							(
								"Access" => "Pode gerenciar permissões da equipe?",
							),
						),
					),
				),
			),
		),
	),
);