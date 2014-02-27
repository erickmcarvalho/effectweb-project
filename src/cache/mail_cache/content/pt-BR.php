<?php

$EMAIL_CONTENT = array
(
	"RegisterNewMember" => array
	(
		"Subject" => "Confirmação de Cadastro",
		"Content" => "Olá <strong><#NAME#></strong>!<br /><br />
Obrigado por cadastrar em nosso servidor,
<br />Segue abaixo alguns dados referentes a sua conta:<br /><br />
<strong>Login:</strong> <#LOGIN#><br />
<strong>E-Mail:</strong> <#EMAIL#><br />
<strong>Pergunta Secreta:</strong> <#SECURE_QUESTION#><br />
<strong>Resposta Secreta:</strong> <#SECURE_ANSWER#><br /><br />
Para completar seu cadastro, clique no link abaixo para confirmar sua conta:<br />
<strong>Link:</strong> <a target=\"_blank\" href=\"<#SYSTEM_LINK#>/<#VALIDATION_LINK#>\"><#SYSTEM_LINK#>/<#VALIDATION_LINK#></a><br /><br />
<h3><strong>Não funciona?</strong></h3>
Então clique no link abaixo de digite o seguinte codigo:<br />
Código: <strong><#VALIDATION_CODE#></strong><br />
<strong>Link:</strong> <a target=\"_black\" href=\"<#SYSTEM_LINK#>\"><#SYSTEM_LINK#></a>",
	),
	"RecoverMemberData" => array
	(
		"Subject" => "Confirmação de Cadastro",
		"Content" => "Olá <strong><#NAME#></strong>!<br /><br />
Você solicitou a recuperação de dados referentes a sua conta.
<br />Segue abaixo alguns dados referentes a sua conta:<br /><br />
<strong>Login:</strong> <#LOGIN#><br />
<strong>E-Mail:</strong> <#EMAIL#><br />
<strong>Pergunta Secreta:</strong> <#SECURE_QUESTION#><br />
<strong>Resposta Secreta:</strong> <#SECURE_ANSWER#><br /><br />
Para redefinir sua senha, clique no link abaixo:<br />
<strong>Link:</strong> <a target=\"_blank\" href=\"<#SYSTEM_LINK#>/<#VALIDATION_LINK#>\"><#SYSTEM_LINK#>/<#VALIDATION_LINK#></a><br /><br />
<h3><strong>Não funciona?</strong></h3>
Então clique no link abaixo de digite o seguinte codigo:<br />
Código: <strong><#VALIDATION_CODE#></strong><br />
<strong>Link:</strong> <a target=\"_black\" href=\"<#SYSTEM_LINK#>\"><#SYSTEM_LINK#></a>",
	),
	"ChangeMemberMail" => array
	(
		"Subject" => "Alteração de E-Mail",
		"Content" => "Olá <strong><#NAME#></strong>!<br /><br />
Você solicitou o código de confirmação para alterar o e-mail de sua conta.<br /><br />
Código: <strong><#CONFIRM_CODE#></strong><br />
<strong>Link para utilizar:</strong> <a target=\"_blank\" href=\"<#SYSTEM_LINK#>\"><#SYSTEM_LINK#></a>",
	),
);