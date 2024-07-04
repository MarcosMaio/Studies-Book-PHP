<?php
$bdServidor  =  '127.0.0.1';
$bdUsuario  =  'root';
$bdSenha  =  '';
$bdBanco  =  'estudos';
$conexao  =  mysqli_connect($bdServidor,  $bdUsuario,  $bdSenha,  $bdBanco);

if (mysqli_connect_errno($conexao)) {
  echo  "Problemas	para	conectar	no	banco.	Verifique	os	dados!";
  die();
}

function buscar_contatos($conexao)
{
  $sqlBusca = 'SELECT * FROM contatos';
  $resultado = mysqli_query($conexao, $sqlBusca);
  $contatos = [];

  while ($contato = mysqli_fetch_assoc($resultado)) {
    $contatos[] = $contato;
  }

  return $contatos;
}

function buscar_contato($id, $conexao)
{
  $sqlBusca = 'SELECT * FROM contatos WHERE id = ' . $id;
  $resultado = mysqli_query($conexao, $sqlBusca);
  return mysqli_fetch_assoc($resultado);
}

function gravar_contato($conexao, $contato)
{
  try {
    $sqlGravar = "
  INSERT INTO contatos (nome, celular, email, data_de_nascimento, favorito)
  VALUES (
    '{$contato['nome']}',
    '{$contato['celular']}',
    '{$contato['email']}',
    '{$contato['data_de_nascimento']}',
    '{$contato['favorito']}'
  )
  ";
    mysqli_query($conexao,  $sqlGravar);
  } catch (\Exception $e) {
    var_dump($e);
    $tem_erros = true;
    $erros_validacao['erro'] = 'Ocorreu um erro ao gravar o contato!';
  }
}

function  gravar_anexo($conexao,  $anexo)
{
  // var_dump($anexo);
  // die();
  $sqlGravar  =  "INSERT	INTO	anexos_contatos
    (contato_id, nome, arquivo)
      VALUES
        (
          {$anexo['contato_id']},
          '{$anexo['nome']}',
          '{$anexo['arquivo']}'
        )
    ";
  mysqli_query($conexao,  $sqlGravar);
}

function buscar_anexos($conexao, $contato_id)
{
  // $sqlBusca = 'SELECT * FROM anexos_contatos WHERE contato_id = ' . $contato_id;
  // $resultado = mysqli_query($conexao, $sqlBusca);
  // var_dump($resultado);
  // die();
  // return mysqli_fetch_assoc($resultado);
  

  $sql = "SELECT * FROM anexos_contatos
  WHERE contato_id = {$contato_id}";

  $resultado = mysqli_query($conexao, $sql);

  $anexos = [];

  while ($anexo = mysqli_fetch_assoc($resultado)) {
    $anexos[] = $anexo;
  }

  return $anexos;
}

function atualizaAnexo($conexao, $antigo_anexo, $novo_anexo)
{
  // var_dump($novo_anexo['arquivo'], $antigo_anexo);
  // die();
  $sqlUpadate = "UPDATE anexos_contatos SET arquivo = '{$novo_anexo['arquivo']}' WHERE contato_id = $antigo_anexo";
  mysqli_query($conexao, $sqlUpadate);
}