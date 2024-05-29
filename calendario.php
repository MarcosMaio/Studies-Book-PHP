<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <!-- <table border="1">
    <tr>
      <th>Segunda-feira</th>  
    </tr>
  </table> -->

  <!-- <h1>Estamos em <?php echo date('Y'); ?> e hoje é dia <?php echo date('d/m') ?></h1>
  <p>Está pagina foi gerada às <?php echo date('H'); ?> horas e <?php echo date('i'); ?> minutos</p> -->

  <?php
  function linha($dia)
  {
      $linha = "<tr>";
      for ($i=0; $i <= 6 ; $i++) { 
        if(array_key_exists($i, $dia)){
          $linha .= "<td>{$dia[$i]}</td>";
      }
      else{
        $linha .= "";
      }
    }

    $linha	.=	'<tr>';
		return $linha;
  }
  
  function Calendario() {
    $calendario = "";
    $dia = 1;
    $semana = [];

    while ($dia <= 30){
      array_push($semana, $dia);
      if(count($semana) == 7){
        $calendario .= linha($semana);
        $semana = [];
      }
      $dia++;
    }

    $calendario .= linha($semana);

    return $calendario;
  }

  ?>
  <h1>Calendário</h1>
  <div style="display: flex; align-items: center; justify-content: center; margin-top: 350px;">
    <table border="1">
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