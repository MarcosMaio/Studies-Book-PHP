<?php
session_start();
require 'banco.php';
require 'ajudante.php';

remove_tarefa_concluidas($conexao);
header('Location:	tarefas.php');
die();
