<?php
/*****************************************************/
/* Cetemaster Board - Language Words System          */
/* Package: Effect Web v2.x - ACP                    */
/*****************************************************/
/* Language: Blazilian Portuguese                    */
/* File: System Module                               */
/*****************************************************/
/* Author: Erick-Master                              */
/* Last Update: 01/05/2012 - 19:15h                  */
/*****************************************************/

$CTM_LANG = array
(
	"System" => array
	(
		"Sidebar" => array
		(
			"CronJob" => array
			(
				"Title" => "CronJob",
				"AddTask" => "Adicionar Task",
				"ManageTasks" => "Gerenciar Tasks",
			),
			"Board" => array
			(
				"Title" => "Effect Web (Sistema)",
				"License" => array
				(
					"Title" => "Licença",
					"AuthenticateLicense" => "Autenticar Licença",
					"ChangeSerial" => "Alterar Serial de Licença",
				),
			),
			"LookAndFeel" => array
			(
				"Title" => "Look & Feel",
				"Templates" => array
				(
					"Title" => "Templates",
					"ManageTemplates" => "Gerenciar Templates",
					"ImportExport" => "Importar / Exportar",
				),
			),
			"Analysis" => array
			(
				"Title" => "Analise",
				"SystemLogs" => "Logs do Sistema",
			),
		),
		"Home" => array
		(
			"Title" => "Control Panel",
			"Tabs" => array
			(
				1 => "Informações do Sistema",
				2 => "Informações da Hospedagem",
				3 => "Informações do Servidor",
			),
			"SystemInfo" => array
			(
				"Product" => "Produto:",
				"Version" => "Versão:",
				"Build" => "Build:",
			),
			"SystemLicense" => array
			(
				"License" => "Licença:",
				"Expiration" => "Vencimento:",
				"Holder" => "Titular da licença:",
			),
			"HostServer" => array
			(
				"ServerOS" => "Sistema Operacional:",
				"ComputerName" => "Nome do Servidor:",
				"ServerSoftware" => "Software do Servidor:",
				"ServerAddr" => "IP do Servidor:",
				"ServerPort" => "Porta do Servidor:",
			),
			"ServerInfo" => array
			(
				"TotalAccounts" => "Total de Contas:",
				"TotalAccountsVIP" => array
				(
					1 => "Total de Contas ".VIP_NAME_1.":",
					2 => "Total de Contas ".VIP_NAME_2.":",
					3 => "Total de Contas ".VIP_NAME_3.":",
					4 => "Total de Contas ".VIP_NAME_4.":",
					5 => "Total de Contas ".VIP_NAME_5.":",
				),
				"TotalCharacters" => "Total de Chars:",
				"TotalGuilds" => "Total de Guilds:",
				"TotalOnline" => "Total Online:",
			),
		),
		"CronJob" => array
		(
			"AddTask" => array
			(
				"Title" => "Adicionar Task",
				"NoTasks" => "Não há arquivos PHP de tasks em <strong>modules/tasks</strong>.",
				"Fields" => array
				(
					"Settings" => "Settings",
					"TaskName" => "Task Name:",
					"TaskDescription" => "Descrição:",
					"TaskFile" => "Task PHP File (modules/tasks):",
					"Enable" => "Habilitado:",
					"Occur" => "Ocorrência",
					"Days" => "Dias (Every):",
					"Weeks" => "Semanas (Every):",
					"Months" => "Meses (Every):",
					"Hours" => "Horas (Every):",
					"Minutes" => "Minutos (Every):",
					"Begin" => "Inicio",
					"BeginDate" => "Data:",
					"BeginHour" => "Hora:",
					"End" => "Vencimento",
					"EndEnable" => "Habilitar Vencimento",
					"EndDate" => "Data:",
					"EndHour" => "Hora:",
				),
				"Button" => "Adicionar",
				"Messages" => array
				(
					"NameVoid" => "Preencha o nome da task.",
					"InvalidFile" => "Selecione um arquivo de task válido.",
					"SetOccur" => "Defina pelo menos um minuto para ocorrência.",
					"Success" => "Task <strong>#%d</strong> adicionada com sucesso!<br />Será executado em <strong>%s</strong>.",
				),
			),
			"ManageTasks" => array
			(
				"Title" => "Gerenciar Tasks",
				"NoTasks" => "Não há tasks cadastradas no momento.",
				"TaskTitle" => "Título",
				"Enabled" => "Habilitado:",
				"LastExecution" => "Última Execução",
				"NextExecution" => "Próxima Execução",
				"Details" => array
				(
					"Link" => "Detalhes",
					"Show" => "Exibir",
					"Id" => "ID:",
					"Days" => "Dias:",
					"Weeks" => "Semanas:",
					"Months" => "Meses:",
					"Hours" => "Horas:",
					"Minutes" => "Minutos:",
					"OccurOptions" => "Ocorrência:",
				),
				"Options" => "Opções",
				"RemoveTask" => array
				(
					"Confirm" => "Tem certeza que deseja remover esta task?",
					"Messages" => array
					(
						"NotExists" => "Esta task não existe.",
						"Success" => "Task removida com sucesso!",
					),
				),
			),
			"RunTask" => array
			(
				"Title" => "Executar Task",
				"TaskError" => "Esta task é inválida ou não existe.",
				"CronJobResult" => "CronJob Result:",
			),
			"EditTask" => array
			(
				"Title" => "Editar Task",
				"NoTasks" => "Esta task não existe.",
				"NoTasks" => "Não há arquivos PHP de tasks em <strong>modules/tasks</strong>.",
				"Fields" => array
				(
					"Settings" => "Settings",
					"TaskName" => "Task Name:",
					"TaskDescription" => "Descrição:",
					"TaskFile" => "Task PHP File (modules/tasks):",
					"Enable" => "Habilitado:",
					"Occur" => "Ocorrência",
					"Days" => "Dias (Every):",
					"Weeks" => "Semanas (Every):",
					"Months" => "Meses (Every):",
					"Hours" => "Horas (Every):",
					"Minutes" => "Minutos (Every):",
					"Begin" => "Inicio",
					"BeginDate" => "Data:",
					"BeginHour" => "Hora:",
					"End" => "Vencimento",
					"EndEnable" => "Habilitar Vencimento",
					"EndDate" => "Data:",
					"EndHour" => "Hora:",
				),
				"Button" => "Editar",
				"Messages" => array
				(
					"NameVoid" => "Preencha o nome da task.",
					"InvalidFile" => "Selecione um arquivo de task válido.",
					"SetOccur" => "Defina pelo menos um minuto para ocorrência.",
					"Success" => "Task <strong>#%d</strong> editada com sucesso!<br />Será executado em <strong>%s</strong>.",
				),
			),
		),
		"Board" => array
		(
			"License" => array
			(
				"AuthenticateLicense" => array
				(
					"Title" => "Autenticar Licença",
				),
				"ChangeSerial" => array
				(
					"Title" => "Alterar Serial de Licença",
				),
			),
		),
		"Templates" => array
		(
			"ManageTemplates" => array
			(
				"Templates" => array
				(
					"Title" => "Gerenciar Templates",
					"NoTemplates" => "Não há templates cadastrados no sistema.",
					"Table" => array
					(
						"Name" => "Template:",
						"Author" => "Autor:",
						"Options" => "Opções:",
					),
					"CreateTemplate" => "Criar Template",
				),
				"ShowFiles" => array
				(
					"Title" => "Arquivos: %s",
					"Tabs" => array
					(
						"Set" => array
						(
							"Option" => "Skin Files",
							"Files" => "Arquivos",
							"AddSet" => "Adicionar",
						),
						"CSS" => array
						(
							"Option" => "CSS Styles",
							"Files" => "Arquivos",
							"AddSet" => "Adicionar",
						),
					),
					"AddSet" => array
					(
						"Title" => "Adicionar Arquivo",
						"SetName" => "Nome:",
						"Category" => "Categoria:",
						"Button" => "Adicionar",
						"Messages" => array
						(
							"NameVoid" => "Preencha o nome do arquivo.",
							"NameInvalid" => "Não use caracteres especiais no arquivo.",
							"CategoryInvalid" => "Selecione uma categoria válida.",
							"SetExists" => "Este arquivo já existe.",
							"Success" => "Arquivo de template <strong>%s</strong> adicionado com sucesso!",
						),
					),
					"AddCSS" => array
					(
						"Title" => "Adicionar CSS",
						"CSSName" => "Nome:",
						"Button" => "Adicionar",
						"Messages" => array
						(
							"NameVoid" => "Preencha o nome do arquivo.",
							"NameInvalid" => "Não use caracteres especiais no arquivo.",
							"CSSExists" => "Este arquivo já existe.",
							"Success" => "Arquivo de CSS <strong>%s</strong> adicionado com sucesso!",
						),
					),
				),
				"SkinEditor" => array
				(
					"Button" => array
					(
						"Save" => "Salvar",
						"Delete" => "Deletar",
						"Close" => "Cancelar",
					),
					"Messages" => array
					(
						"Saved" => "Arquivo <strong>%s</strong> salvo com sucesso!",
						"Deleted" => "Arquivo <strong>%s</strong> deletado com sucesso!",
					),
				),
			),
			"CreateTemplate" => array
			(
				"Title" => "Criar Template",
				"Fields" => array
				(
					"Settings" => "Opções",
					"SkinName" => "Nome:",
					"SkinSet" => "Identificação:",
					"Author" => "Autor:",
					"AuthorName" => "Nome:",
					"AuthorSite" => "Site",
				),
				"Button" => "Criar Template",
				"Messages" => array
				(
					"SkinNameVoid" => "Preencha o nome do template.",
					"SkinSetVoid" => "Preencha a identificação do template.",
					"AuthorNameVoid" => "Preencha o nome do autor.",
					"SkinSetExists" => "Esta identificação já se encontra cadastrada.",
					"Error" => "[#%d] Erro ao criar o template.",
					"Success" => "Template criado com sucesso!<br />Skin Set: <strong>%s</strong>.",
				),
			),
			"RemoveTemplate" => array
			(
				"Messages" => array
				(
					"NoRemove" => "Este template não pode ser removido.",
					"Success" => "Template removido com sucesso!",
				),
			),
			"ImportExport" => array
			(
				"Title" => "Importar/Exportar Template",
				"Import" => array
				(
					"TabTitle" => "Importar",
					"Title" => "Importar Template",
					"Fields" => array
					(
						"Upload" => "Por upload:",
						"FilePath" => "Por caminho (pela raiz do site):",
					),
					"Button" => "Importar",
					"Messages" => array
					(
						"SelectFile" => "Selecione o caminho do arquivo.",
						"InvalidFile" => "Arquivo inválido.<br />Somente arquivos <strong>.xml</strong> ou <strong>.gz</strong> ou <strong>.zip</strong>.",
						"UploadError" => "Erro ao enviar o arquivo.",
						"FileNoExists" => "O caminho informado é inválido.",
						"UnZipError" => "Erro ao descompactar o arquivo.",
						"FileCorrupted" => "Arquivo de template corrompido.",
						"InvalidTemplate" => "Template inválido.",
						"LicenseError" => "Sua licença não permite a utilização deste template.",
						"Success" => "Template <strong>%s</strong> importado com sucesso!<br />Identificação: <strong>%s</strong>.",
					),
				),
				"Export" => array
				(
					"TabTitle" => "Exportar",
					"Title" => "Exportar Template",
					"Fields" => array
					(
						"Template" => "Template:",
					),
					"Button" => "Exportar",
					"Messages" => array
					(
						"TemplateInvalid" => "Selecione um template válido.",
					),
				),
			),
		),
		"Analysis" => array
		(
			"SystemLogs" => array
			(
				"Index" => array
				(
					"Title" => "Logs",
					"Table" => array
					(
						"LogName" => "Log Type:",
						"RowsCount" => "Arquivos:",
					),
					"Action" => array
					(
						"Action" => "Ação:",
						"DownloadFolders" => "Baixar Arquivos",
						"ClearFolders" => "Limpar Logs",
						"Button" => "Aplicar",
					),
				),
				"DoCommand" => array
				(
					"Messages" => array
					(
						"SelectAction" => "Selecione uma ação válida.",
						"SelectFolders" => "Selecione ao menos uma categoria.",
						"FoldersCleaned" => "Foram deletados <strong>$1 arquivos</strong> em <strong>$2 pastas</strong> com sucesso!",
					),
				),
				"CategoryLogs" => array
				(
					"Title" => "Logs: %s",
					"Table" => array
					(
						"LogName" => "Arquivo:",
						"ChangeData" => "Última atualização:",
						"FileSize" => "Tamanho:",
					),
					"Action" => array
					(
						"Action" => "Ação:",
						"DownloadFolders" => "Baixar Arquivos",
						"ClearFolders" => "Deletar Arquivos",
						"Button" => "Aplicar",
					),
					"Messages" => array
					(
						"NoFiles" => "Não há logs registrados nesta categoria.",
						"FileDeleted" => "Arquivo deletado com sucesso!",
						"SelectAction" => "Selecione uma ação válida.",
						"SelectFiles" => "Selecione ao menos um arquivo.",
						"FilesDeleted" => "Foram deletados <strong>%d arquivos</strong> com sucesso!",
					),
				),
				"ShowLogs" => array
				(
					"Title" => "Log File: %s",
					"LogContent" => "Logs:",
					"Commands" => "Comandos:",
					"Buttons" => array
					(
						"DownloadFile" => "Download do Arquivo",
						"DeleteFile" => "Deletar Arquivo",
					),
					"Messages" => array
					(
						"FileNotExists" => "Este arquivo não existe.",
					),
				),
			),
		),
	),
);