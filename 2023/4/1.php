<?php

$file = file_get_contents('input.txt');
$strings = explode("\n", $file);

$sum = 0;
foreach ($strings as $string) {
    $card = explode(': ', $string)[1];
    $grids = explode(' | ', trim($card));

    $winningNumbers = preg_split('/\s+/', $grids[0]);
    $myNumbers = preg_split('/\s+/', $grids[1]);

    $correctsNumbers = 0;
    foreach ($winningNumbers as $win) {
        if (in_array($win, $myNumbers)) {
            $correctsNumbers++;
        }
    }

    $sum += $correctsNumbers ? pow(2, $correctsNumbers - 1) : 0;
}

echo $sum;
?>