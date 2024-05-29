<?php
session_start();
require "banco.php";
require "ajudante.php";

$exibir_tabela  =  true;

// session_unset();
$tarefas = buscar_tarefas($conexao);

if (tem_post()) {
  // var_dump($_REQUEST);

  $concluida = 0;
  if (isset($_REQUEST['concluida'])) {
    $concluida = 1;
  }

  if (strlen($_REQUEST['nome']) == 0) {
    $tem_erros = true;
    $erros_validacao['nome'] = 'O nome da tarefa é obrigatório!';
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


  $tarefa = [
    'nome' => $_REQUEST['nome'],
    'descricao' => $_REQUEST['descricao'],
    'prazo' => $_REQUEST['prazo'],
    'prioridade' => $_REQUEST['prioridade'],
    'concluida' => $concluida
  ];

  if (!$tem_erros) {
    gravar_tarefa($conexao,  $tarefa);
    header('Location:	tarefas.php');
    die();
  }

  // $_SESSION['tarefas'][] = $novo_tarefa;
}

$tarefas = buscar_tarefas($conexao);


$tarefa  =  [
  'id'                  =>  0,
  'nome'              =>  $_REQUEST['nome']  ??  '',
  'descricao'    =>  $_REQUEST['descricao']  ??  '',
  'prazo'            =>  $_REQUEST['prazo']  ??  '',
  'prioridade'  =>  $_REQUEST['prioridade']  ?? '',
  'concluida'    =>  $_REQUEST['concluida']  ??  ''
];

require "template.php";

// if (array_key_exists('nome',  $_POST)  &&  $_POST['nome']  !=  '') {
//   $tarefa  =  [];
//   $tarefa['nome']  =  $_POST['nome'];
//   if (array_key_exists('descricao',  $_POST)) {
//     $tarefa['descricao']  =  $_POST['descricao'];
//   } else {
//     $tarefa['descricao']  =  '';
//   }
//   if (array_key_exists('prazo',  $_POST)) {
//     $tarefa['prazo']  =  $_POST['prazo'];
//   } else {
//     $tarefa['prazo']  =  '';
//   }
//   $tarefa['prioridade']  =  $_POST['prioridade'];
//   if (array_key_exists('concluida',  $_POST)) {
//     $tarefa['concluida']  =  $_POST['concluida'];
//   } else {
//     $tarefa['concluida']  =  '';
//   }
//   $_SESSION['lista_tarefas'][]  =  $tarefa;
// }
// // $lista_tarefas  =  [];
