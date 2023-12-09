<?php

$file = file_get_contents('input.txt');
$strings = explode("\n", $file);

$redMax = 12;
$greenMax = 13;
$blueMax = 14;

$sum = 0;
foreach ($strings as $string) {
    $game = explode(': ', $string);

    $number = str_replace('Game ', '', $game[0]);
    $sets = explode('; ', $game[1]);

    $possible = true;
    foreach ($sets as $set) {
        $cubes = explode(', ', $set);
        foreach ($cubes as $cube) {
            $info = explode(' ', $cube);

            $cubeNumber = $info[0];
            $cubeColor = trim($info[1]);

            if ($cubeNumber > ${$cubeColor.'Max'}) {
                $possible = false;
                break 2;
            }
        }
    }

    if ($possible) {
        $sum += $number;
    }
}

echo $sum;
?>