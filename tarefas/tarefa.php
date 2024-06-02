<?php
include "banco.php";
include "ajudante.php";
$tem_erros  =  false;
$erros_validacao  =  [];

if (request_date()) {
  $tarefa_id  = $_REQUEST['tarefa_id'];

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
      'tarefa_id' => $tarefa_id,
      'nome' => $arquivo_nome,
      'arquivo' =>  $arquivo_formatado
    ];

    if (!tratar_anexos($anexo, $tmp)) {
      $tem_erros = true;
      $erros_validacao['anexo'] = 'Envie anexos nos formatos zip, pdf.';
    }
  }

  if (!$tem_erros) {
    gravar_anexo($conexao, $anexo);
  }
}
$tarefa  =  buscar_tarefa($conexao,  $_GET['id']);
$anexos  =  buscar_anexos($conexao,  $_GET['id']);

include "template_tarefa.php";
