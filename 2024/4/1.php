<?php

$file = file_get_contents('input.txt');

$array = [];
$lines = explode("\n", $file);
foreach ($lines as $line) {
    $array[] = str_split(rtrim($line));
}

$count = 0;
$word = str_split('XMAS');

$directions = [
    [-1, 0],  // Haut
    [0, 1],   // Droite
    [1, 0],   // Bas
    [0, -1],  // Gauche
    [-1, 1],  // Diagonale Haut/Droite
    [1, 1],   // Diagonale Bas/Droite
    [1, -1],  // Diagonale Bas/Gauche
    [-1, -1], // Diagonale Haut/Gauche
];

for ($i = 0; $i < count($array); $i++) {
    for ($j = 0; $j < count($array[0]); $j++) {
        foreach ($directions as [$dx, $dy]) {
            $isOK = true;
            for ($k = 0; $k < count($word); $k++) {
                $iNew = $i + $k * $dx;
                $jNew = $j + $k * $dy;

                if ($iNew < 0 OR $iNew >= count($array) OR $jNew < 0 OR $jNew >= count($array[0])) {
                    $isOK = false;
                    break;
                }

                if ($array[$iNew][$jNew] !== $word[$k]) {
                    $isOK = false;
                    break;
                }
            }

            if ($isOK) {
                $count++;
            }
        }
    }
}

echo $count;
?>