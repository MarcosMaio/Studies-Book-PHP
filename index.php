<?php 

// 3.4

date_default_timezone_set('America/Sao_Paulo');

echo "Today is " . date('l, d/m/y') . "<br> <br>";
echo "now are " . date('H:i:s A') . "<br> <br>";
echo "Mês atual é " . date('F') . "<br> <br>";

$dias_da_semana = [
  1 => 'Segunda-feira',
  2 => 'Terça-feira',
  3 => 'Quarta-feira',
  4 => 'Quinta-feira',
  5 => 'Sexta-feira',
  6 => 'Sábado',
  7 => 'Domingo'
];

$dia_atual = null;
$sabado = null;

foreach ($dias_da_semana as $key => $value) {
  if($key == date('N')){
    echo "O dia da semana correspondente ao número $key é $value <br>";
    $dia_atual = $key; //7
  }
  
  if($value == 'Sábado'){
      $sabado = $key;
  }

  if($sabado != null && $dia_atual != null && $key == count($dias_da_semana)){
    $diferenca = $sabado - $dia_atual;
    if($diferenca < 0){
      $diferenca = 7 + $diferenca;
    }
    echo "Faltam $diferenca dias para o sábado <br>";
  }
  
}

$dia_atual = date('N');
$sabado = 6;

$diferenca = ($sabado - $dia_atual + 7) % 7;

echo "Faltam $diferenca dias para o sábado";


?>