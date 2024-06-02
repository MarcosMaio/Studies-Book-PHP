<?php

function traduz_prioridade($codigo)
{
  $prioridade = '';
  switch ($codigo) {
    case 1:
      $prioridade = 'Baixa';
      break;
    case 2:
      $prioridade = 'Média';
      break;
    case 3:
      $prioridade = 'Alta';
      break;
  }
  return $prioridade;
}

function traduz_data_para_exibir($data)
{
  if ($data == '' || $data == '0000-00-00') {
    return '';
  }

  $object_data = DateTime::createFromFormat('Y-m-d', $data);

  return $object_data->format('d/m/Y');

  // $dados = explode('-', $data);

  // $data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";

  // return $data_exibir;
}

function traduz_concluida($concluida)
{
  if ($concluida == 1) {
    return 'Sim';
  }
  return 'Não';
}

$tem_erros  =  false;
$erros_validacao  =  [];

function  request_date()
{
  if (count($_REQUEST)  >  0) {
    if(count($_REQUEST)  ==  1 && array_key_exists('id', $_REQUEST)) {
      return false;
    }
    return true;
  }
  return false;
}

function validar_data($data)
{
  $data = traduz_data_para_exibir($data);
  
  $padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
  $resultado = preg_match($padrao, $data);

  $data = explode('/', $data);
  // var_dump($data[2]);
  // die();

  if($data[2] < date('Y')) {
    return false;
  } else if($data[2] == date('Y')) {
    if($data[1] < date('m')) {
      return false;
    } else if($data[1] == date('m')) {
      if($data[0] < date('d')) {
        return false;
      }
    }
  }

  return ($resultado == 1) ? true : false;
}

function tratar_anexos($anexo, $tmp) 
{
  // var_dump($anexo);
  // die();
  $padrao	=	'/^.+(\.pdf|\.zip)$/';
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