<?php
/*****************************************************/
/* Cetemaster Board - Language Words System          */
/* Package: Effect Web v2.x - ACP                    */
/*****************************************************/
/* Language: Blazilian Portuguese                    */
/* File: Financial Module                            */
/*****************************************************/
/* Author: Erick-Master                              */
/* Last Update: 14/09/2012 - 12:25h                  */
/*****************************************************/

$CTM_LANG = array
(
	"EWFinancial" => array
	(
		"Sidebar" => array
		(
			"Invoices" => array
			(
				"Title" => "Faturas",
				"OpenInvoices" => "Abrir Faturas",
				"ManageInvoices" => "Gerenciar Faturas",
			),
		),
		"Home" => array
		(
			"Title" => "Site - Financeiro",
			"Links" => array
			(
				"Title" => "Navegação rápida:",
				"Invoices" => "Faturas",
			),
		),
		"Invoices" => array
		(
			"ManageInvoices" => array
			(
				"Title" => "Faturas",
				"Table" => array
				(
					"Document" => "Documento:",
					"Quantity" => "Quantidade de ".COIN_NAME_1.":",
					"Value" => "Valor (".MONEY_SYMBOL."):",
					"Date" => "Aberta em:",
					"OpenDate" => "Data",
					"Status" => "Status",
					"Command" => "Comando",
					"Infos" => array
					(
						"Display" => "Exibir {_MENU_} faturas por página",
						"NotResult" => "Nenhuma faturas encontrado.",
						"Show" => "Mostrando {_START_}-{_END_} de {_TOTAL_} registros",
						"Filter" => "(filtrado de {_MAX_} registros no total)",
					),
				),
				"Messages" => array
				(
					"None" => "Não há faturas cadastradas no momento.",
					"IsClosed" => "Esta fatura se encontra fechada.",
					"Deleted" => "Fatura deletada com sucesso!",
				),
			),
			"ViewInvoice" => array
			(
				"Title" => "Fatura:",
				"Table" => array
				(
					"InvoiceInfos" => "Informações da Fatura",
					"Document" => "Documento:",
					"StartDate" => "Data de abertura:",
					"Quantity" => "Quantidade de ".COIN_NAME_1.":",
					"Value" => "Valor a ser pago:",
					"Account" => "Conta:",
					"Status" => "Status:",
					"Payment" => "Pagamento",
				),
				"BankPayment" => array
				(
					"Title" => array
					(
						"Infos" => "Informações do Pagamento",
						"BuyData" => "Dados da Compra",
						"PaymentData" => "Dados do Pagamento",
					),
					"Method" => "Método de Compra:",
					"SendDate" => "Enviado em:",
					"Status" => "Status:",
					"Annex" => "Anéxo:",
					"Date" => "Data do pagamento:",
					"Hour" => "Hora do pagamento:",
					"Local" => "Local do pagamento:",
				),
				"PaymentMethod" => array
				(
					"Method" => "Método:",
					"Bank" => array
					(
						"Title" => "Informações do Pagamento:",
						"Value" => "Mostrar",
					),
				),
				"Manage" => array
				(
					"Title" => "Gerenciamento",
					"Options" => "Opções",
					"Approve" => "Aprovar Pagamento",
					"Reject" => "Rejeitar Fatura",
					"Reopen" => "Reabrir Fatura",
					"EditInvoice" => "Editar Fatura",
					"DeleteInvoice" => "Deletar Fatura",
				),
				"Messages" => array
				(
					"IsOpened" => "Esta fatura se encontra aberta.",
					"IsClosed" => "Esta fatura se encontra fechada.",
				),
				"ApproveInvoice" => array
				(
					"Messages" => array
					(
						"Confirm" => "Preencha a quantidade de ".COIN_NAME_1." a ser creditado:",
						"Success" => "Fatura aprovada com sucesso!<br />Creditado <strong>#QUANTITY# ".COIN_NAME_1."</strong> na conta <strong>#ACCOUNT#</strong>.",
					),
				),
				"RejectInvoice" => array
				(
					"Messages" => array
					(
						"Confirm" => "Tem certeza que deseja rejeitar esta fatura?",
						"Success" => "Fatura rejeitada com sucesso!",
					),
				),
				"ReopenInvoice" => array
				(
					"Messages" => array
					(
						"Confirm" => "Tem certeza que deseja abrir esta fatura?",
						"Success" => "Fatura aberta com sucesso!",
					),
				),
				"EditInvoice" => array
				(
					"Button" => "Editar Fatura",
					"Messages" => array
					(
						"FieldsVoid" => "Preencha todos os campos.",
						"InvalidQuantity" => "Preencha somente números inteiros na quantidade.",
						"InvalidStatus" => "Status inválido.",
					),
				),
				"DeleteInvoice" => array
				(
					"Messages" => array
					(
						"Confirm" => "Tem certeza que deseja deletar esta fatura?",
					),
				),
			),
			"Methods" => array
			(
				"Bank" => "Depósito/Transferência Bancária"
			),
			"Status" => array
			(
				"Pending" => "Pendente",
				"InProgress" => "Em Progresso",
				"Paid" => "Pago",
				"Rejected" => "Rejeitado",
				"Canceled" => "Cancelado",
			),
			"PaymentStatus" => array
			(
				"Opened" => "Aberto",
				"Confirmed" => "Confirmado",
				"Rejected" => "Rejeitado",
			),
		),
	),
);