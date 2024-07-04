<?php
$tem_erros = false;
$erros_validacao = [];

function valida_celular($celular)
{
  $padrao = '/^\(\d{2}\)\s?\d{5}\-\d{4}$/';
  return preg_match($padrao, $celular);
}

function valida_data_nascimento($data)
{
  $padrao = '/^\d{2}\/\d{2}\/\d{4}$/';

  if (!preg_match($padrao, $data)) {
    return false;
  }

  $partes = explode('/', $data);

  if (!checkdate($partes[1], $partes[0], $partes[2])) {
    return false;
  }

  if ($partes[2] > date('Y')) {
    return false;
  }


  if ($partes[2] == date('Y')) {
    if ($partes[1] > date('m')) {
      return false;
    }
    if ($partes[1] == date('m') && $partes[0] > date('d') || $partes[0] == date('d')) {
      return false;
    }
  }

  // $data_formatada = DateTime::createFromFormat('d/m/Y', $data);
  // $data_atual = new DateTime();
  // if ($data_formatada > $data_atual) {
  //     return false;
  // }

  return true;
}

function  request_date()
{
  if (count($_REQUEST)  >  0) {
    if (count($_REQUEST)  ==  1 && array_key_exists('id', $_REQUEST)) {
      return false;
    }
    return true;
  }
  return false;
}

function tratar_anexos($anexo, $tmp) 
{
  $padrao = '/^.+\.(png|jpg|jpeg)$/i';
  $resultado = preg_match($padrao, $anexo['arquivo']);

  if($resultado == 0) {
    return false ;
  }
  
  move_uploaded_file(
    $tmp,
    "anexos/{$anexo['arquivo']}"
  );

  return true;
}

function verificaSePossueFoto($conexao, $id)
{
  $sqlBusca = "SELECT * FROM anexos_contatos WHERE contato_id = {$id}";
  $resultado = mysqli_query($conexao, $sqlBusca);
}