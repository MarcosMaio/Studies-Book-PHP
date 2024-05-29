<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php

  date_default_timezone_set('America/Sao_Paulo');

  $horas = date('H:i:s A');
  $dia = date('d');
  echo $dia . "<br>";
  echo $horas;

  if ($horas >= '06:00:00' && $horas <= '12:00:00') {
    echo "<h1>Bom dia!</h1>";
  }

  if ($horas >= '12:00:00' && $horas <= '18:00:00') {
    echo "<h1>Boa tarde!</h1>";
  }

  if ($horas >= '18:00:00' && $horas <= '23:59:59') {
    echo "<h1>Boa noite!</h1>";
  }

  function linha($dia)
  {
    $dia_atual = date('d');
    $sabado = [7, 14, 21, 28];
    $domingo = [1, 8, 15, 22, 29];
    if ($dia_atual < 10) {
      $dia_atual = explode('0', $dia_atual);
      // echo $dia_atual[1] . "<br>";
    }
    $linha = "<tr>";
    for ($i = 0; $i <= 6; $i++) {
      if (array_key_exists($i, $dia)) {

        if ($dia[$i] == $dia_atual[1]) {
          $linha .= "<td style='background-color: black; color: white;'>{$dia[$i]}</td>";
        } else if (in_array($dia[$i], $sabado)) {
          $linha .= "<td style='background-color: red; color: white;'>{$dia[$i]}</td>";
        } else if (in_array($dia[$i], $domingo)) {
          $linha .= "<td style='background-color: red; color: white;'>{$dia[$i]}</td>";
        } else {
          $linha .= "<td>{$dia[$i]}</td>";
        }
      } else {
        $linha .= "";
      }
    }

    $linha  .=  '<tr>';
    return $linha;
  }

  function Calendario()
  {
    $calendario = "";
    $dia = 1;
    $semana = [];

    while ($dia <= 30) {
      array_push($semana, $dia);
      if (count($semana) == 7) {
        $calendario .= linha($semana);
        if ($dia == date('d')) {
          echo $dia;
        }
        $semana = [];
      }
      $dia++;
    }

    $calendario .= linha($semana);

    return $calendario;
  }

  ?>
  <div style="display: flex; align-items: center; justify-content: center; margin-top: 350px;">
    <table border="1" id="coluna_dias">
      <tr>
        <th>Dom</th>
        <th>Seg</th>
        <th>Ter</th>
        <th>Qua</th>
        <th>Qui</th>
        <th>Sex</th>
        <th>Sáb</th>
      </tr>

      <?php echo Calendario(); ?>


    </table>
  </div>
</body>

</html>