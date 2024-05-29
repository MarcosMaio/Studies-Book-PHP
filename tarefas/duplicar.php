<?php 
session_start();
require 'banco.php';
require 'ajudante.php';


if(array_key_exists('id', $_REQUEST) && $_REQUEST['id'] != '') {
  
  var_dump($_REQUEST);
  $tarefa = [
    'id' => $_REQUEST['id'],
  ];

  duplicar_tarefa($conexao,	$tarefa);
  header('Location:	tarefas.php');
  die();
}
?>