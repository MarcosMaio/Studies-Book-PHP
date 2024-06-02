<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <title>Gerenciador de Tarefas</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: #333;
    }

    #bloco_principal {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      padding: 20px;
      max-width: 800px;
      width: 100%;
    }

    h1 {
      color: #4caf50;
      font-size: 28px;
      margin-bottom: 20px;
    }

    p {
      margin: 10px 0;
      color: #555;
    }

    a {
      color: #007bff;
      text-decoration: none;
      transition: color 0.3s ease;
    }

    a:hover {
      color: #0056b3;
      text-decoration: underline;
    }

    strong {
      display: block;
      margin-top: 10px;
      color: #333;
    }

    fieldset {
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 15px;
      margin-top: 20px;
    }

    legend {
      font-weight: bold;
      padding: 0 5px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      color: #333;
    }

    input[type="file"] {
      display: block;
      margin-top: 10px;
    }

    input[type="submit"] {
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .erro {
      color: red;
      font-size: 12px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f9f9f9;
      color: #333;
    }

    tr:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>

<body>
  <div id="bloco_principal">
    <h1>Tarefa: <?php echo $tarefa['nome']; ?></h1>
    <p>
      <a href="tarefas.php">Voltar para a lista de tarefas</a>
    </p>
    <p>
      <strong>Concluída:</strong>
      <?php echo traduz_concluida($tarefa['concluida']); ?>
    </p>
    <p>
      <strong>Descrição:</strong>
      <?php echo nl2br($tarefa['descricao']); ?>
    </p>
    <p>
      <strong>Prazo:</strong>
      <?php echo traduz_data_para_exibir($tarefa['prazo']); ?>
    </p>
    <p>
      <strong>Prioridade:</strong>
      <?php echo traduz_prioridade($tarefa['prioridade']); ?>
    </p>
    <h2>Anexos</h2>
    <form action="" method="post" enctype="multipart/form-data">
      <fieldset>
        <legend>Novo anexo</legend>
        <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['id']; ?>" />
        <label>
          <?php if ($tem_erros && array_key_exists('anexo', $erros_validacao)) : ?>
            <span class="erro">
              <?php echo $erros_validacao['anexo']; ?>
            </span>
          <?php endif; ?>
          <input type="file" name="anexo" />
        </label>
        <input type="submit" value="Cadastrar" />
      </fieldset>
    </form>
    <h2>Anexos</h2>
    <?php if (count($anexos) > 0) : ?>
      <table>
        <tr>
          <th>Arquivo</th>
          <th>Opções</th>
        </tr>
        <?php foreach ($anexos as $anexo) : ?>
          <tr>
            <td><?php echo $anexo['nome']; ?></td>
            <td>
              <div style="display: flex; align-items: center; gap: 20px;">
                <a style="color: #45a049;" href="anexos/<?php echo $anexo['arquivo']; ?>">Download</a>
                <a style="color: red;" href="remover_anexo.php?id=<?php echo  $anexo['id'];  ?>">Remover</a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php else : ?>
      <p>Não há anexos para esta tarefa.</p>
    <?php endif; ?>
  </div>
</body>

</html>