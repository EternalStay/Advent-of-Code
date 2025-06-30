<?php

$string = file_get_contents('input.txt');

$strings = [];
$dont = explode('don\'t()', $string);
for ($i = 0; $i < count($dont); $i++) {
    if ($i == 0) $strings[] = $dont[$i];
    else {
        $do = explode('do()', $dont[$i]);
        for ($j = 1; $j < count($do); $j++) {
            $strings[] = $do[$j];
        }
    }
}

$sum = 0;

foreach ($strings as $string) {
    if (preg_match_all('/mul\(([0-9]{1,3}),([0-9]{1,3})\)/', $string, $matches)) {
        for ($i = 0; $i < count($matches[0]); $i++) {
            $sum += $matches[1][$i] * $matches[2][$i];
        }
    }
}

echo $sum;
?>