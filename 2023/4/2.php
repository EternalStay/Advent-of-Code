<?php

$file = file_get_contents('input.txt');
$strings = explode("\n", $file);

$copies = [];
for ($i = 1; $i <= count($strings); $i++) {
    $copies[$i] = 1;
}

foreach ($strings as $string) {
    $cardExplode = explode(': ', $string);

    $cardNumber = preg_replace('/[^0-9]/', '', $cardExplode[0]);
    $card = $cardExplode[1];

    $grids = explode(' | ', trim($card));

    $winningNumbers = preg_split('/\s+/', $grids[0]);
    $myNumbers = preg_split('/\s+/', $grids[1]);

    $correctsNumbers = 0;
    foreach ($winningNumbers as $win) {
        if (in_array($win, $myNumbers)) {
            $correctsNumbers++;
        }
    }

    if ($correctsNumbers) {
        for ($i = 1; $i <= $correctsNumbers; $i++) {
            if ($cardNumber + $i <= count($strings)) {
                $copies[$cardNumber + $i] += (key_exists($cardNumber, $copies) ? $copies[$cardNumber] : 1);
            }
        }
    }
}

echo array_sum($copies);
?>