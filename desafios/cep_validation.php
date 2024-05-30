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
      <legend>CEP</legend>
      <label>
        CEP:
        <input type="text" maxlength="9" name="cep" placeholder="XXXXX-XXX" />
      </label>
      <label>
        <input type="submit" value="Enviar" />
      </label>
    </fieldset>

    <?php
    if (count($_REQUEST)  >  0) {
      $cep = $_REQUEST['cep'];

      if (validar_cep($cep)) {
        echo "CEP válido";
      } else {
        echo "CEP inválido";
      }
    }


    function validar_cep($cep)
    {
      $padrao = '/^\d{5}-\d{3}$/';
      return preg_match($padrao, $cep);
    }
    ?>
</body>

</html>