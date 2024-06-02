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

function buscar_tarefas($conexao)
{
  $sqlBusca = 'SELECT * FROM tarefas';
  $resultado = mysqli_query($conexao, $sqlBusca);
  $tarefas = [];

  while ($tarefa = mysqli_fetch_assoc($resultado)) {
    $tarefas[] = $tarefa;
  }

  return $tarefas;
}

function  buscar_tarefa($conexao,  $id)
{
  $sqlBusca  =  'SELECT	*	FROM	tarefas	WHERE	id	=	'  .  $id;
  $resultado  =  mysqli_query($conexao,  $sqlBusca);
  return  mysqli_fetch_assoc($resultado);
}

function duplicar_tarefa($conexao, $tarefa)
{
  $tarefa_duplicada = buscar_tarefa($conexao, $tarefa['id']);
  gravar_tarefa($conexao, $tarefa_duplicada);
}

function remove_tarefa_concluidas($conexao)
{
  $sqlRemove = "DELETE FROM tarefas WHERE concluida = 1";
  mysqli_query($conexao, $sqlRemove);
}

function gravar_tarefa($conexao, $tarefa)
{
  var_dump($tarefa, $conexao);
  $sqlGravar = "
  INSERT INTO tarefas (nome, descricao, prazo, prioridade, concluida)
  VALUES (
    '{$tarefa['nome']}',
    '{$tarefa['descricao']}',
    '{$tarefa['prazo']}',
    '{$tarefa['prioridade']}',
    '{$tarefa['concluida']}'
  )
  ";
  mysqli_query($conexao,  $sqlGravar);
}

function editar_tarefa($conexao, $tarefa)
{
  if ($tarefa['prazo'] == '') {
    $prazo  =  'NULL';
  } else {
    $prazo  =  "'{$tarefa['prazo']}'";
  }

  $sqlEditar = "
  UPDATE tarefas SET 
  nome = '{$tarefa['nome']}',
  descricao = '{$tarefa['descricao']}',
  prazo = {$prazo},
  prioridade = {$tarefa['prioridade']},
  concluida = {$tarefa['concluida']}
  WHERE id = {$tarefa['id']}
  ";

  mysqli_query($conexao,  $sqlEditar);
}

function remove_tarefa($conexao, $id)
{
  $sqlRemove = "DELETE FROM tarefas WHERE id = {$id}";
  mysqli_query($conexao, $sqlRemove);
  header('Location:	tarefas.php');
  die();
}

function  gravar_anexo($conexao,  $anexo)
{
  $sqlGravar  =  "INSERT	INTO	anexos_tarefas
    (tarefa_id,	nome,	arquivo)
      VALUES
        (
          {$anexo['tarefa_id']},
          '{$anexo['nome']}',
          '{$anexo['arquivo']}'
        )
    ";
  mysqli_query($conexao,  $sqlGravar);
}


function buscar_anexos($conexao, $tarefa_id)
{
  $sql = "SELECT * FROM anexos_tarefas
  WHERE tarefa_id = {$tarefa_id}";

  $resultado = mysqli_query($conexao, $sql);

  $anexos = [];

  while ($anexo = mysqli_fetch_assoc($resultado)) {
    $anexos[] = $anexo;
  }

  return $anexos;
}

function buscar_anexo($conexao, $id)
{
  $sqlBusca = 'SELECT * FROM anexos_tarefas WHERE id = ' . $id;
  $resultado = mysqli_query($conexao, $sqlBusca);

  return mysqli_fetch_assoc($resultado);
}

function remover_anexo($conexao, $id)
{
  $sqlRemover  =  "DELETE	FROM	anexos_tarefas	WHERE	id	=	{$id}";
  mysqli_query($conexao,  $sqlRemover);
}
