<?php

function showBingo($bingo){
  for ($i = 0; $i < sizeof($bingo) ; $i++){

    if ($i % 5 == 0) echo PHP_EOL;

    echo $bingo[$i] . ' ';
  }
}
