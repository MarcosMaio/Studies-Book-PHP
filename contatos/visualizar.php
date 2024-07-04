<?php
require "banco.php";
require "ajudante.php";

$contato = buscar_contato($_REQUEST['id'], $conexao);


if (request_date()) {

  $tarefa_id  = $_REQUEST['contato_id'];

  if (!array_key_exists('anexo', $_FILES) || $_FILES['anexo']['error'] != 0) {
    $tem_erros = true;
    $erros_validacao['anexo'] = 'Você deve selecionar um arquivo para anexar.';
  } else {
    $tmp = $_FILES['anexo']['tmp_name'];
    $arquivo = explode('.', $_FILES['anexo']['name']);
    $arquivo_nome = $arquivo[0];
    $extensao = $arquivo[1];

    $uuid = bin2hex(random_bytes(6));
    $arquivo_nome_formatado = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $arquivo_nome));

    $arquivo_formatado = $arquivo_nome_formatado . '_' . $uuid . '.' . $extensao;
    // var_dump($extensao, $arquivo_nome, $arquivo_nome_formatado, $uuid, $arquivo_formatado);
    // die();
    $anexo = [
      'contato_id' => $tarefa_id,
      'nome' => $arquivo_nome,
      'arquivo' =>  $arquivo_formatado
    ];

    if (!tratar_anexos($anexo, $tmp)) {
      $tem_erros = true;
      $erros_validacao['anexo'] = 'Envie anexos nos formatos png, jpg ou jpeg.';
    }
  }
  
  $anexos = buscar_anexos($conexao,  $_GET['id']);

  if ($anexos == '' || $anexos == null) {
    if (!$tem_erros) {
      gravar_anexo($conexao, $anexo);
    }
  } else {
    if (!$tem_erros) {
      atualizaAnexo($conexao, $_GET['id'], $anexo);
      unlink('anexos/' . $anexos[0]['arquivo']);
    }
  }
}

$anexos = buscar_anexos($conexao,  $_GET['id']);


require "template_visualizar.php";
