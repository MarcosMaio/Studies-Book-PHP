<?php session_start();
require "banco.php";
$contatos = buscar_contatos($conexao);

?>
<html>

<head>
  <title>Gerenciador de Contatos</title>
</head>

<body>
  <h1>Gerenciador de Contatos</h1>
  <form>
    <fieldset>
      <legend>Lista de Contatos</legend>
      <label>
        Cadastro de Contatos:
        <input type="text" name="nome" />
        <input type="text" name="telefone" />
        <input type="text" name="email" />
        <input type="date" name="data_de_nascimento" />
        <input type="checkbox" name="favorito" value="sim" />
      </label>
      <input type="submit" value="Cadastrar" />
    </fieldset>
  </form>

  <table>
    <tr>
      <th>Contatos</th>
    </tr>

    <?php

    if (isset($_GET['nome']) && $_GET['nome'] != '' && isset($_GET['telefone']) && $_GET['telefone'] != '' && isset($_GET['email']) && $_GET['email'] != '' && isset($_GET['data_de_nascimento']) && $_GET['data_de_nascimento'] != '' && isset($_GET['favorito']) && $_GET['favorito'] != '') {

      $contato = [
        'nome' => $_GET['nome'],
        'telefone' => $_GET['telefone'],
        'email' => $_GET['email'],
        'data_de_nascimento' => $_GET['data_de_nascimento'],
        'favorito' => $_GET['favorito']
      ];

      // $contatos = buscar_contatos($conexao);

      gravar_tarefa($conexao,	$contato);

      $contatos = buscar_contatos($conexao);

      // $_SESSION['contatos'][] = $novo_contato;
    }

    // session_destroy();

    ?>

    <?php if (!empty($contatos)) : ?>
      <?php foreach ($contatos as $contato) : ?>
        <tr>
          <td><?php echo htmlspecialchars($contato['nome']); ?></td>
          <td><?php echo htmlspecialchars($contato['telefone']); ?></td>
          <td><?php echo htmlspecialchars($contato['email']); ?></td>
          <td><?php echo  htmlspecialchars($contato['data_de_nascimento']);  ?></td>
          <td><?php echo htmlspecialchars($contato['favorito']); ?></td>
        </tr>
      <?php endforeach;  ?>
    <?php else : ?>
      <tr>
        <td colspan="5">Nenhum contato encontrado.</td>
      </tr>
    <?php endif; ?>
  </table>
</body>

</html>