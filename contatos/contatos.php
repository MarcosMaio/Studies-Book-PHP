<?php
session_start();
$tem_erros = false;
$erros_validacao = [];

require "banco.php";
require "ajudante.php";

$contatos = buscar_contatos($conexao);

if (count($_REQUEST) > 0) {
    if (strlen($_REQUEST['nome']) == 0) {
        $tem_erros = true;
        $erros_validacao['nome'] = 'O nome do contato é obrigatório!';
    }

    if(strlen($_REQUEST['celular']) == 0) {
        $tem_erros = true;
        $erros_validacao['celular'] = 'O celular do contato é obrigatório!';
    } else {
      if(!valida_celular($_REQUEST['celular'])) {
        $tem_erros = true;
        $erros_validacao['celular'] = 'O celular do contato não é válido!';
      }
    }

    if(strlen($_REQUEST['email']) == 0) {
        $tem_erros = true;
        $erros_validacao['email'] = 'O email do contato é obrigatório!';
    } else {
      if(!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
        $tem_erros = true;
        $erros_validacao['email'] = 'O email do contato não é válido!';
      }
    }

    if(strlen($_REQUEST['data_de_nascimento']) == 0) {
        $tem_erros = true;
        $erros_validacao['data_de_nascimento'] = 'A data de nascimento do contato é obrigatória!';
    } else {
      if(!valida_data_nascimento($_REQUEST['data_de_nascimento'])) {
        $tem_erros = true;
        $erros_validacao['data_de_nascimento'] = 'A data de nascimento do contato não é válida!';
      }
    }

    if (!$tem_erros) {
        $contato = [
            'nome' => $_REQUEST['nome'],
            'celular' => $_REQUEST['celular'],
            'email' => $_REQUEST['email'],
            'data_de_nascimento' => $_REQUEST['data_de_nascimento'],
            'favorito' => $_REQUEST['favorito'] ?? ''
        ];

        gravar_contato($conexao, $contato);
        header('Location: contatos.php');
        die();
    }

    var_dump($_REQUEST);

    $contatos = buscar_contatos($conexao);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Contatos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
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
        input[type="date"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45A049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .empty-message {
            text-align: center;
            color: #999;
            padding: 20px;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h1>Gerenciador de Contatos</h1>

    <form method="POST">
        <fieldset>
            <legend>Cadastro de Contatos</legend>

            <?php if ($tem_erros && array_key_exists('erro', $erros_validacao)) : ?>
                <div class="error-message"><?php echo $erros_validacao['erro']; ?></div>
            <?php endif; ?>
            
            <?php if ($tem_erros && array_key_exists('nome', $erros_validacao)) : ?>
                <div class="error-message"><?php echo $erros_validacao['nome']; ?></div>
            <?php endif; ?>
            
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" placeholder="Nome" value="<?php echo isset($_REQUEST['nome']) ? htmlspecialchars($_REQUEST['nome']) : ''; ?>" />
            
            <?php if ($tem_erros && array_key_exists('celular', $erros_validacao)) : ?>
                <div class="error-message"><?php echo $erros_validacao['celular']; ?></div>
            <?php endif; ?>

            <label for="celular">Celular:</label>
            <input type="text" id="celular" name="celular" placeholder="(00)00000-0000" value="<?php echo isset($_REQUEST['celular']) ? htmlspecialchars($_REQUEST['celular']) : ''; ?>" />

            <?php if ($tem_erros && array_key_exists('email', $erros_validacao)) : ?>
                <div class="error-message"><?php echo $erros_validacao['email']; ?></div>
            <?php endif; ?>
            
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Email" value="<?php echo isset($_REQUEST['email']) ? htmlspecialchars($_REQUEST['email']) : ''; ?>" />

            <?php if ($tem_erros && array_key_exists('data_de_nascimento', $erros_validacao)) : ?>
                <div class="error-message"><?php echo $erros_validacao['data_de_nascimento']; ?></div>
            <?php endif; ?>
            
            <label for="data_de_nascimento">Data de Nascimento:</label>
            <input type="text" id="data_de_nascimento" placeholder="dd/mm/yyyy" name="data_de_nascimento" value="<?php echo isset($_REQUEST['data_de_nascimento']) ? htmlspecialchars($_REQUEST['data_de_nascimento']) : ''; ?>" />
            
            <label>
                <input type="checkbox" name="favorito" value="sim" <?php echo isset($_REQUEST['favorito']) ? 'checked' : ''; ?> />
                Favorito
            </label>
            
            <input type="submit" value="Cadastrar" />
        </fieldset>
    </form>

    <table>
        <tr>
            <th>Nome</th>
            <th>Celular</th>
            <th>Email</th>
            <th>Data de Nascimento</th>
            <th>Favorito</th>
        </tr>

        <?php if (!empty($contatos)) : ?>
            <?php foreach ($contatos as $contato) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($contato['nome']); ?></td>
                    <td><?php echo htmlspecialchars($contato['celular']); ?></td>
                    <td><?php echo htmlspecialchars($contato['email']); ?></td>
                    <td><?php echo htmlspecialchars($contato['data_de_nascimento']); ?></td>
                    <td><?php echo htmlspecialchars($contato['favorito']) ? 'Sim' : 'Não'; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5" class="empty-message">Nenhum contato encontrado.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>
