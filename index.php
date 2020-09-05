<?php
require('functions.php');
require('colors.php');

  $colors = new Colors();

  $page = file_get_contents('https://pokemaobr.dev/bingo/?user=' . $argv[1]);

$html = new DomDocument;
$html->loadHTML($page);

$dom = $html->documentElement;

$table = $dom->getElementsByTagName("td");

echo PHP_EOL . '=========================' . PHP_EOL . PHP_EOL;

echo $colors->getColoredString('Caso queria reiniciar a cartela, use r'. PHP_EOL, 'red');

$bingo = [];
$win = 0;

foreach( $table as $itens ) {
    array_push($bingo, $itens->textContent);
};

$bingo[12] = 'XX';

$originalBingo = $bingo;

showBingo($bingo);

echo PHP_EOL;

while(true){

  echo $colors->getColoredString(PHP_EOL . 'Número Sorteado: ', "cyan");

  $number = trim(fgets(STDIN));

  if ( in_array($number, $bingo, true) ){
    $pos = array_search($number, $bingo);
    $bingo[$pos] = 'OO';
    $win++;
  }

  else if(strtolower($number) == 'r'){
    $bingo = $originalBingo;
  }
  else{
    echo $colors->getColoredString(PHP_EOL . 'Número não encontrado' . PHP_EOL, 'yellow');
  }

  showBingo($bingo);

  if ($win == 24){
    echo $colors->getColoredString(PHP_EOL . PHP_EOL . 'BINGO!' . PHP_EOL, 'green');

    showBingo($bingo);
    echo PHP_EOL;
    break;
  }
}
