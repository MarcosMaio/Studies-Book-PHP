<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciador de Tarefas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
      color: #333;

    }

    form {
      background-color: #fff;
      padding: 20px;
      margin: 20px auto;
      max-width: 400px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    fieldset {
      border: none;
      margin-bottom: 15px;
    }

    legend {
      font-weight: bold;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 8px;
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    input[type="radio"],
    input[type="checkbox"] {
      margin-right: 5px;
    }

    a {
      text-decoration: none;
      color: #333;
    }

    .yellow {
      background-color: #ff0;
      padding: 5px 10px;
      border-radius: 4px;
    }

    .red {
      background-color: #f00;
      padding: 5px 10px;
      border-radius: 4px;
      color: #fff;
    }

    .purple {
      background-color: #800080;
      padding: 5px 10px;
      border-radius: 4px;
      color: #fff;
    }

    .orange {
      background-color: #ff8c00;
      padding: 5px 10px;
      border-radius: 4px;
      color: #fff;
    }

    .orange:hover {
      background-color: orangered;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      margin-top: 20px;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ccc;
    }

    th {
      background-color: #f2f2f2;
    }

    /* Estilos para o botão de envio */
    input[type="submit"] {
      background-color: #4caf50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    .a_btn {
      background-color: #f44336;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    .a_btn:hover {
      background-color: darkred;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <?php

  require 'formulario.php';

  
    if (isset($exibir_tabela)) {
      require 'tabela.php';
    }
  ?>

</body>

</html>