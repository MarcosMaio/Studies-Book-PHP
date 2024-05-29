<?php
session_start();
require 'banco.php';
require 'ajudante.php';

remove_tarefa($conexao, $_REQUEST['id']);
