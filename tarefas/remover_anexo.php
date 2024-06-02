<?php 

include "banco.php";

$anexo = buscar_anexo($conexao, $_REQUEST['id']);
// var_dump($anexo);
// die();
remover_anexo($conexao, $anexo['id']);
unlink('anexos/' . $anexo['arquivo']);

header('Location:	tarefa.php?id='	.	$anexo['tarefa_id']);