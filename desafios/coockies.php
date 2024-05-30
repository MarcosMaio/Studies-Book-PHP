<?php setcookie('lista_tarefas', json_encode([]));  ?>
<html>

<head>
  <title>Gerenciador de Tarefas</title>
</head>

<body>
  <h1>Gerenciador de Tarefas</h1>
  <form>
    <fieldset>
      <legend>Nova tarefa</legend>
      <label>
        Tarefa:
        <input type="text" name="nome" />
      </label>
      <input type="submit" value="Cadastrar" />
    </fieldset>
  </form>

  <table>
    <tr>
      <th>Tarefas</th>
    </tr>

    <?php

    if (array_key_exists('nome',  $_GET)) {
      
      $lista_tarefas = json_decode($_COOKIE['lista_tarefas'], true);

      $nova_tarefa = $_GET['nome'];
      $lista_tarefas[] = $nova_tarefa;
      
      setcookie('lista_tarefas', json_encode($lista_tarefas));
    } else {
      $lista_tarefas = json_encode($_COOKIE['lista_tarefas'], true);
    }
    
    ?>
    <?php foreach ($lista_tarefas as $tarefa) : ?>
      <tr>
        <td><?php echo $tarefa; ?></td>
      </tr>

    <?php endforeach;  ?>
  </table>
</body>

</html>