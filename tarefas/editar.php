<?php
session_start();
require 'banco.php';
require 'ajudante.php';

$tem_erros =  false;
$erros_validacao = [];

if (request_date()) {
  $tarefa = [
    'id' => $_REQUEST['id'],
    'nome' => $_REQUEST['nome'],
    'descricao' => $_REQUEST['descricao'],
    'prazo' => $_REQUEST['prazo'],
    'prioridade' => $_REQUEST['prioridade'],
    'concluida' => 0,
  ];

  if (strlen($tarefa['nome'])  ==  0) {
    $tem_erros  =  true;
    $erros_validacao['nome']  =  'O	nome	da	tarefa	é	obrigatório!';
  }

  if (
    array_key_exists('prazo',  $_REQUEST)
    &&  strlen($_REQUEST['prazo'])  >  0
  ) {
    if (validar_data($_REQUEST['prazo'])) {
      $tarefa['prazo']  =
        traduz_data_para_exibir($_REQUEST['prazo']);
    } else {
      $tem_erros  =  true;
      $erros_validacao['prazo']  =
        'O	prazo	não	é	uma	data	válida!';
    }
  }

  if (!$tem_erros) {
    editar_tarefa($conexao,  $tarefa);
    header('Location:	tarefas.php');
    die();
  }
}

$tarefa  =  buscar_tarefa($conexao,  $_REQUEST['id']);

$tarefa['nome']	=	(array_key_exists('nome',	$_REQUEST))	?
				$_REQUEST['nome']	:	$tarefa['nome'];
$tarefa['descricao']	=	(array_key_exists('descricao',	$_REQUEST))	?
				$_REQUEST['descricao']	:	$tarefa['descricao'];
$tarefa['prazo']	=	(array_key_exists('prazo',	$_REQUEST))	?
				$_REQUEST['prazo']	:	$tarefa['prazo'];
$tarefa['prioridade']	=	(array_key_exists('prioridade',	$_REQUEST))	
?
				$_REQUEST['prioridade']	:	$tarefa['prioridade'];
$tarefa['concluida']	=	(array_key_exists('concluida',	$_REQUEST))	?
				$_REQUEST['concluida']	:	$tarefa['concluida'];

require "template.php";
