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
