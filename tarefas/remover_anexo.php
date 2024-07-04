<?php 

include "banco.php";

$anexo = buscar_anexo($conexao, $_REQUEST['id']);

if	(!	is_array($anexo))	{
  http_response_code(404);
  echo "Anexo	não	encontrado.";
  die();
}

// var_dump($anexo);
// die();
remover_anexo($conexao, $anexo['id']);
unlink('anexos/' . $anexo['arquivo']);

header('Location:	tarefa.php?id='	.	$anexo['tarefa_id']);