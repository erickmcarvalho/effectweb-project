<?php
/*****************************************************/
/* Cetemaster Board - Language Words System          */
/* Package: Effect Web v2.x                          */
/*****************************************************/
/* Language: Blazilian Portuguese                    */
/* File: Register Module                             */
/*****************************************************/
/* Author: Erick-Master                              */
/* Last Update: 19/05/2012 - 01:02h                  */
/*****************************************************/

$CTM_LANG = array
(
	"Register" => array
	(
		"LoggedError" => "Você se encontra logado em uma conta, o cadastro não poderá ser efetuado.",
		"Register" => array
		(
			"Title" => "Cadastro",
			"AccountData" => array
			(
				"Title" => "Dados da Conta",
				"Login" => "Login:",
				"Password" => "Senha:",
				"CPassword" => "Confirmar Senha:",
				"Mail" => "E-Mail:",
				"CMail" => "Confirmar E-Mail:",
				"PID" => "Personal ID:",
			),
			"AccountDetails" => array
			(
				"Title" => "Detalhes da Conta",
				"Name" => "Nome:",
				"Phone" => "Telefone:",
				"Sex" => array
				(
					"Field" => "Sexo:",
					"Male" => "Masculino",
					"Female" => "Feminino",
				),
				"Birth" => array
				(
					"Field" => "Nascimento:",
					"Day" => "Dia",
					"Month" => "Mês",
					"Year" => "Ano",
				),
				"SecureQuestion" => array
				(
					"Question" => "Pergunta Secreta:",
					"Answer" => "Resposta Secreta:",
					"Select" => "Selecione uma Pergunta",
					"Questions" => array
					(
						0 => "Nome da sua primeira escola?",
						1 => "Nome do médico do seu parto?",
						2 => "Nascimento da avó?",
						3 => "Casamento de seus pais? ex: ##/##/##",
						4 => "Nome da/do Mulher/Homem que você ama?",
					),
				),
			),
			"RegisterBonus" => array
			(
				"Title" => "Bônus de Cadastro",
				"VaultBonus" => "Bônus no Baú",
				"VIPBonus" => "$1 dias de $2",
				"CoinBonus" => "$1 $2",
			),
			"Terms" => "Concordo com os Termos",
			"Button" => "Completar Cadastro",
			"Messages" => array
			(
				"CheckTerms" => "É preciso concordar com os termos.",
				"NULL_Login" => "Login",
				"NULL_Password" => "Senha",
				"NULL_CPassword" => "Confirmação de Senha",
				"NULL_Mail" => "E-Mail",
				"NULL_CMail" => "Confirmação de E-Mail",
				"NULL_PID" => "Personal ID",
				"NULL_Name" => "Nome",
				"NULL_Phone" => "Telefone",
				"NULL_Sex" => "Selecione seu sexo",
				"NULL_BirthDay" => "Selecione o dia de seu nascimento",
				"NULL_BirthMonth" => "Selecione o mês de seu nascimento",
				"NULL_BirthYear" => "Insira o ano de seu nascimento",
				"NULL_SecureQuestion" => "Selecione uma pergunta secreta",
				"NULL_SecureAnswer" => "Sua resposta secreta",
				"NULL_Message" => "Os seguintes campos devem ser preenchidos:",
				"Error_LoginLength" => "O login edve conter digitos entre 3 e 10",
				"Error_PassLength" => "A senha deve conter digitos entre 3 e 10",
				"Error_PIDLength" => "O Personal ID deve conter 7 digitos",
				"Error_LoginWords" => "Não use símbolos no login",
				"Error_PassWords" => "Não use símbolos na senha",
				"Error_PIDWords" => "Personal ID deve conter somente números",
				"Error_MailWords" => "E-Mail inválido",
				"Error_ConfirmPass" => "Senhas não conferem",
				"Error_ConfirmMail" => "E-Mails não conferem",
				"Error_LoginExists" => "Este login se encontra em uso",
				"Error_MailExists" => "Este E-Mail se encontra em uso",
				"Error_Message" => "Os seguintes erros foram encontrados:",
				"Error_SendMail" => "[#%d] Não foi possível completar seu cadastro.<br />Entre em contato com a administração.",
				"Success" => array
				(
					1 => "Cadastro realizado com sucesso!",
					2 => "Nome:",
					3 => "Login:",
					4 => "E-Mail:",
					5 => "Você foi premiado com:",
					6 => "$1 dias de $2",
					7 => "$1 $2",
					8 => "Seja bem vindo ao ".SERVER_NAME.".<br />Baixe o client em nossa área de downloads e divirta-se.",
					"NotCompleted" => "Foi enviado 1 e-mail para %s contendo informações para confirmar o seu cadastro.<br />Entre em seu e-mail e siga as instruções para confrmar o seu cadastro e começar a jogar.<br /><font color='red'>Não esqueça de verificar sua caixa de spam.</font>",
				),
			),
			"AjaxCheck" => array
			(
				"Void" => "Campo em branco",
				"MinLogin" => "Mínimo 4 digitos",
				"MaxLogin" => "Máximo 10 digitos",
				"LoginExists" => "Login em uso",
				"LoginValid" => "Login válido",
				"MailInvalid" => "E-Mail inválido",
				"MailExists" => "E-Mail em uso",
				"MailValid" => "E-Mail válido",
				"PassConfirm" => "Senhas não conferem",
				"PassConfirmed" => "Senha confirmada",
				"MailConfirm" => "E-Mails não conferem",
				"MailConfirmed" => "E-Mail confirmado",
				"PIDLength" => "Deve conter 7 digitos",
				"PIDWords" => "Somente números",
				"PIDValid" => "Personal ID válido",
			),
		),
		"Confirm" => array
		(
			"Title" => "Confirmar Cadastro",
			"Code" => "Codigo de Validação:",
			"Button" => "Confirmar Cadastro",
			"Messages" => array
			(
				"Link" => array
				(
					"Invalid" => "Este link de validação é invalido.",
					"Confirmed" => "Este link está confirmado.",
					"Success" => "Obrigado por confirmar o seu cadastro!<br />Agora você pode logar em nosso jogo e se divertir.",
				),
				"Code" => array
				(
					"Format" => "O formato do código de validação é inválido.",
					"Invalid" => "Este código de validação é invalido.",
					"Confirmed" => "Este código está confirmado.",
					"Success" => "Obrigado por confirmar o seu cadastro!<br />Agora você pode logar em nosso jogo e se divertir.",
				),
			),
		),
	),
);