<?php

$string = file_get_contents('input.txt');

$sum = 0;

if (preg_match_all('/mul\(([0-9]{1,3}),([0-9]{1,3})\)/', $string, $matches)) {
    for ($i = 0; $i < count($matches[0]); $i++) {
        $sum += $matches[1][$i] * $matches[2][$i];
    }
}

echo $sum;
?>