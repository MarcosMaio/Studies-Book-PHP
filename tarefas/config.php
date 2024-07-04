<?php 

//	Conexão	ao	banco	de	dados	(MySQL)
define("BD_SERVIDOR",	"127.0.0.1");
define("BD_USUARIO",	"root");
define("BD_SENHA",	"");
define("BD_BANCO",	"estudos");

//	E-mail	para	notificação
define("EMAIL_NOTIFICACAO",	"marcospaulomaio2607@gmail.com");


$bdServidor  =  '127.0.0.1';
$bdUsuario  =  'root';
$bdSenha  =  '';
$bdBanco  =  'estudos';
$conexao	=
mysqli_connect(BD_SERVIDOR,	BD_USUARIO,	BD_SENHA,	BD_BANCO);