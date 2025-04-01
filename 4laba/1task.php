<?php
$str = "vbbbv epe eeevee vpv eve eveve";
$regexp = "/e.e/"; // Вариант 5 ('e' + один любой символ + 'e')
$matches = [];

$count = preg_match_all($regexp, $str, $matches);

echo "Найдено строк: $count \n";
var_dump($matches);

