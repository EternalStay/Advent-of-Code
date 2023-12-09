<?php

$file = file_get_contents('input.txt');
$strings = explode("\n", $file);

$sum = 0;
foreach ($strings as $string) {
    $game = explode(': ', $string);

    $number = str_replace('Game ', '', $game[0]);
    $sets = explode('; ', $game[1]);

    $redMin = 0;
    $greenMin = 0;
    $blueMin = 0;

    foreach ($sets as $set) {
        $cubes = explode(', ', $set);
        foreach ($cubes as $cube) {
            $info = explode(' ', $cube);

            $cubeNumber = $info[0];
            $cubeColor = trim($info[1]);

            if ($cubeNumber > ${$cubeColor.'Min'}) {
                ${$cubeColor.'Min'} = $cubeNumber;
            }
        }
    }

    $sum += ($redMin * $greenMin * $blueMin);
}

echo $sum;
?>