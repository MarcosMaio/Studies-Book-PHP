<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <title>Visualizador de Contato</title>
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
      max-width: 600px;
      width: 100%;
      text-align: center;
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
      font-weight: bold;
    }

    img {
      max-width: 100%;
      height: auto;
      border-radius: 8px;
      margin-top: 10px;
    }

    fieldset {
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 15px;
      margin-top: 20px;
      text-align: left;
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
      padding: 5px;
      width: 100%;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 10px 20px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
      box-sizing: border-box;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .erro {
      color: red;
      font-size: 12px;
    }
  </style>
</head>

<body>
  <div id="bloco_principal">
    <h1>Nome: <?php echo htmlspecialchars($contato['nome']); ?></h1>
    <?php if (!empty($anexos)) : ?>
      <img src="anexos/<?php echo htmlspecialchars($anexos[0]['arquivo']); ?>" alt="Anexo">
    <?php endif; ?>
    <p>
      <a href="tarefas.php">Voltar para a lista de contatos</a>
    </p>
    <p>
      <strong>Celular:</strong>
      <?php echo htmlspecialchars($contato['celular']); ?>
    </p>
    <p>
      <strong>E-mail:</strong>
      <?php echo htmlspecialchars($contato['email']); ?>
    </p>
    <p>
      <strong>Data de Nascimento:</strong>
      <?php echo htmlspecialchars($contato['data_de_nascimento']); ?>
    </p>
    <h2>Foto de Perfil</h2>
    <form action="" method="post" enctype="multipart/form-data">
      <fieldset>
        <legend>Alterar Foto de Perfil</legend>
        <input type="hidden" name="contato_id" value="<?php echo htmlspecialchars($contato['id']); ?>" />
        <label>
          <?php if ($tem_erros && array_key_exists('anexo', $erros_validacao)) : ?>
            <span class="erro">
              <?php echo htmlspecialchars($erros_validacao['anexo']); ?>
            </span>
          <?php endif; ?>
          <input type="file" name="anexo" />
        </label>
        <input type="submit" value="Cadastrar" />
      </fieldset>
    </form>
  </div>
</body>

</html>