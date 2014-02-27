<?php
/*****************************************************/
/* Cetemaster Board - Language Words System          */
/* Package: Effect Web v2.x                          */
/*****************************************************/
/* Language: Blazilian Portuguese                    */
/* File: Recovery Module                             */
/*****************************************************/
/* Author: Erick-Master                              */
/* Last Update: 23/05/2012 - 16:59h                  */
/*****************************************************/

$CTM_LANG = array
(
	"Recovery" => array
	(
		"Recover" => array
		(
			"Title" => "Recuperar Dados",
			"Login" => "Digite o login de sua conta:",
			"Mail" => "Ou digite seu endereço de E-Mail:",
			"Button" => "Prosseguir",
			"Messages" => array
			(
				"Void" => "Digite seu login ou seu e-mail.",
				"Invalid" => "Login ou e-mail inválido.",
				"Success" => "<strong>E-Mail enviado com sucesso!</strong><br />Entre em sua conta de e-mail para obter seus dados e/ou redefinir sua senha.",
				"Error_SendMail" => "[#%d] Não foi possível completar seu pedido.<br />Entre em contato com a administração.",
			),
		),
		"Process" => array
		(
			"Title" => "Redefinir Senha",
			"NewPassword" => "Nova senha:",
			"CNewPassword" => "Confirmar nova senha:",
			"Code" => "Código de redefinição:",
			"Button" => "Redefinir Senha",
			"FieldCheck" => array
			(
				"Void" => "Campo em branco",
				"PassConfirm" => "Senhas não conferem",
				"PassConfirmed" => "Senha confirmada",
			),
			"Messages" => array
			(
				"Link" => array
				(
					"Invalid" => "Este link de redefinição é invalido.",
					"Expired" => "Este link de redefinição está expirado.",
				),
				"Code" => array
				(
					"Format" => "O formato do código de redefinição é inválido.",
					"Invalid" => "Este código de redefinição é invalido.",
					"Expired" => "Este código de redefinição está expirado.",
				),
				"Write" => array
				(
					"Void" => "Por favor, preencha todos os campos.",
					"PassError" => "As senhas digitadas não conferem.",
					"Success" => "Sua senha foi redefinida com sucesso!",
				),
			),
		),
	),
);