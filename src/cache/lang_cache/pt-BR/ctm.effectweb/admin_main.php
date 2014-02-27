<?php
/*****************************************************/
/* Cetemaster Board - Language Words System          */
/* Package: Effect Web v2.x - ACP                    */
/*****************************************************/
/* Language: Blazilian Portuguese                    */
/* File: Main Module                                 */
/*****************************************************/
/* Author: Erick-Master                              */
/* Last Update: 14/09/2012 - 12:25h                  */
/*****************************************************/

$CTM_LANG = array
(
	"EWMain" => array
	(
		"Sidebar" => array
		(
			"Notices" => array
			(
				"Title" => "Notícias",
				"AddNotice" => "Adicionar Notícia",
				"ManageNotices" => "Gerenciar Notícias",
			),
			"Polls" => array
			(
				"Title" => "Enquetes",
				"AddPoll" => "Adicionar Enquete",
				"ManagePolls" => "Gerenciar Enquetes",
			),
		),
		"Home" => array
		(
			"Title" => "Site - Main",
			"Links" => array
			(
				"Title" => "Navegação rápida:",
				"Notices" => "Notícias",
				"Polls" => "Enquetes",
			),
		),
		"Notices" => array
		(
			"AddNotice" => array
			(
				"Title" => "Adicionar Notícia",
				"FieldTitle" => "Título da notícia:",
				"FieldComments" => "Habilitar comentários:",
				"FieldText" => "Mensagem:",
				"Buttons" => array
				(
					"Process" => "Proceder",
					"Reset" => "Resetar Campos",
				),
				"Messages" => array
				(
					"TitleVoid" => "Preencha o título da notícia.",
					"TextVoid" => "Preencha a mensagem da notícia.",
					"Success" => "Notícia adicionada com sucesso!",
				),
			),
			"ManageNotices" => array
			(
				"Title" => "Gerenciar Notícias",
				"Table" => array
				(
					"NoticeId" => "ID:",
					"NoticeTitle" => "Título:",
					"NoticeDate" => "Data:",
					"NoticeAccount" => "Conta:",
					"NoticeComments" => "Comentários:",
					"TableDisplay" => "Exibir {_MENU_} notícias por página",
					"TableNotResult" => "Nenhuma notícia encontrada.",
					"TableShow" => "Exibindo {_START_}-{_END_} de {_TOTAL_} registros",
					"TableFilter" => "(filtrado de {_MAX_} registros no total)",
					"DeleteNotices" => "Deletar Selecionados",
					"AddNewNotice" => "Adicionar nova notícia",
				),
				"Messages" => array
				(
					"NoNotices" => "Não há notícias cadastradas no momento.",
					"ConfirmDelete" => "Tem certeza que deseja deletar estas notícias?",
					"SelectNotice" => "Selecione ao menos uma notícia.",
					"NoticesDeleted" => "Deletado <strong>%d notícias</strong> com sucesso!",
				),
			),
			"EditNotice" => array
			(
				"Title" => "Editar Notícia: #%d",
				"FieldTitle" => "Título da notícia:",
				"FieldComments" => "Habilitar comentários:",
				"FieldDate" => "Atualizar data:",
				"FieldText" => "Mensagem:",
				"Buttons" => array
				(
					"Process" => "Proceder",
					"Reset" => "Resetar Campos",
				),
				"Messages" => array
				(
					"NoExists" => "Esta notícia não existe ou não pertence a sua conta.",
					"TitleVoid" => "Preencha o título da notícia.",
					"TextVoid" => "Preencha a mensagem da notícia.",
					"Success" => "Notícia atualizada com sucesso!",
				),
			),
		),
		"Polls" => array
		(
			"AddPoll" => array
			(
				"Title" => "Adicionar Enquete",
				"Settings" => "Opções:",
				"Answers" => "Respostas:",
				"AddAnswers" => "+",
				"FieldQuestion" => "Pergunta:",
				"FieldDate" => "Vencimento:",
				"FieldAnswer" => "Resposta:",
				"Buttons" => array
				(
					"AddAnswer" => array
					(
						"Add" => "Adicionar",
						"Cancel" => "Cancelar",
					),
					"Submit" => "Proceder",
				),
				"Messages" => array
				(
					"AddAnswer" => "Digite o número de resposta a ser adicionado:",
					"FieldsVoid" => "Preencha todos os campos.",
					"AnswerError" => "Digite ao menos duas respostas.",
					"DateError" => "Data de vencimento inválida.",
					"Success" => "Enquete adicionada com sucesso!",
				),
			),
			"ManagePolls" => array
			(
				"Title" => "Gerenciar Enquetes",
				"Table" => array
				(
					"Question" => "Pergunta:",
					"BeginDate" => "Data de inicio:",
					"EndDate" => "Data de término:",
					"Status" => "Status:",
					"DeletePolls" => "Deletar Selecionados",
					"AddNewPoll" => "Adicionar nova enquete",
				),
				"Messages" => array
				(
					"NoPolls" => "Não há enquetes cadastradas no momento.",
					"ConfirmDelete" => "Tem certeza que deseja deletar estas enquetes?",
					"SelectPoll" => "Selecione ao menos uma enquete.",
					"PollsDeleted" => "Deletado <strong>%d enquetes</strong> com sucesso!",
				),
			),
			"EditPoll" => array
			(
				"Title" => "Editar Enquete: #%d",
				"Settings" => "Opções:",
				"Answers" => "Respostas:",
				"AddAnswers" => "+",
				"FieldQuestion" => "Pergunta:",
				"FieldDate" => "Vencimento:",
				"FieldStatus" => "Status:",
				"FieldAnswer" => "Resposta:",
				"Buttons" => array
				(
					"AddAnswer" => array
					(
						"Add" => "Adicionar",
						"Cancel" => "Cancelar",
					),
					"Submit" => "Proceder",
				),
				"Messages" => array
				(
					"NoExists" => "Esta enquete não existe.",
					"AddAnswer" => "Digite o número de resposta a ser adicionado:",
					"FieldsVoid" => "Preencha todos os campos.",
					"AnswerError" => "Digite ao menos duas respostas.",
					"DateError" => "Data de vencimento inválida.",
					"Success" => "Enquete alterada com sucesso!",
				),
			),
		),
	),
);