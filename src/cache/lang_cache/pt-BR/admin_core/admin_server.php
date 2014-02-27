<?php
/*****************************************************/
/* Cetemaster Board - Language Words System          */
/* Package: Effect Web v2.x - ACP                    */
/*****************************************************/
/* Language: Blazilian Portuguese                    */
/* File: Server Module                               */
/*****************************************************/
/* Author: Erick-Master                              */
/* Last Update: 25/05/2013 - 00:09h                  */
/*****************************************************/

$CTM_LANG = array
(
	"Server" => array
	(
		"Sidebar" => array
		(
			"GameControl" => array
			(
				"Title" => "Controle do Jogo",
				"UsersOnline" => "Usuários Online",
				"SendGlobalMessage" => "Enviar Mensagem Global",
			),
		),
		"Home" => array
		(
			"Title" => "Servidor",
			"Links" => array
			(
				"Title" => "Navegação rápida:",
				"UsersOnline" => "Usuários Online",
				"SendGlobalMessage" => "Mensagem Global",
			),
		),
		"GameControl" => array
		(
			"UsersOnline" => array
			(
				"Title" => "Usuários Online",
				"Table" => array
				(
					"Account" => "Conta:",
					"Character" => "Personagem:",
					"Server" => "Servidor:",
					"IP" => "IP:",
					"ConnectTime" => "Conexão:",
					"Command" => "Comando:",
					"Disconnect" => "Desconectar",
					"Infos" => array
					(
						"Display" => "Exibir {_MENU_} jogadores por página",
						"NotResult" => "Nenhum jogador encontrado.",
						"Show" => "Mostrando {_START_}-{_END_} de {_TOTAL_} registros",
						"Filter" => "(filtrado de {_MAX_} registros no total)",
					),
				),
				"Messages" => array
				(
					"None" => "Não há jogadores online no momento.",
					"Disconnect" => "Tem certeza que deseja desconectar este jogador?",
					"UserError" => "Jogador inexsistente ou offline.",
					"DisconnectError" => "[#%d] Erro ao desconectar o jogador.",
					"DisconnectSuccess" => "Jogador desconectado com sucesso!",
				),
			),
			"SendGlobalMessage" => array
			(
				"Title" => "Enviar Mensagem Global",
				"FieldMessage" => "Mensagem:",
				"Button" => "Enviar",
				"Messages" => array
				(
					"MessageVoid" => "Preencha a mensagem a ser enviada.",
					"SendError" => "[#%d] Erro ao enviar a mensagem.",
					"Success" => "Mensagem enviada a tela de todos os jogadores com sucesso!",
				),
			),
		),
	),
);