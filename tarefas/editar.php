<?php 
session_start();
require 'banco.php';
require 'ajudante.php';

$exibir_tabela  =  false;
$tem_erros =  false;
$erros_validacao = [];

if(array_key_exists('nome', $_REQUEST) && $_REQUEST['nome'] != '') {
  $tarefa = [
    'id' => $_REQUEST['id'],
    'nome' => $_REQUEST['nome'],
    'descricao' => $_REQUEST['descricao'],
    'prazo' => $_REQUEST['prazo'],
    'prioridade' => $_REQUEST['prioridade'],
    'concluida' => 0,
  ];

  editar_tarefa($conexao,	$tarefa);
  header('Location:	tarefas.php');
  die();
}

$tarefa	=	buscar_tarefa($conexao,	$_REQUEST['id']);

require "template.php";

?>