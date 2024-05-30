<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form method="POST">
    <fieldset>
      <legend>CPF</legend>
      <label>
        CPF:
        <input type="text" name="cpf" maxlength="14" placeholder="XXX.XXX.XXX-XX" />
      </label>
      <label>
        <input type="submit" value="Enviar" />
      </label>
    </fieldset>

    <?php
    if (count($_REQUEST)  >  0) {
      $cpf = $_REQUEST['cpf'];

      if (validar_cpf($cpf)) {
        echo "CPF válido";
      } else {
        echo "CPF inválido";
      }
    }


    function validar_cpf($cpf)
    {
      $padrao = '/^\d{3}\.\d{3}\.\d{3}-\d{2}$/';
      return preg_match($padrao, $cpf);
    }
    ?>
</body>

</html>