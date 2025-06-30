<?php

$file = file_get_contents('input.txt');
$strings = explode("\n", $file);

$sum = 0;

foreach ($strings as $string) {
    if (preg_match_all('/([0-9]+)/', $string, $matches)) {
        $match = $matches[1];
        $matchesSort = $matches[1];
        $matchesASort = $matches[1];

        sort($matchesSort);
        rsort($matchesASort);

        if ($match == $matchesSort || $match == $matchesASort) {
            $isOk = true;

            for ($i = 0; $i < count($matchesSort) - 1; $i++) {
                $diff = abs($matchesSort[$i] - $matchesSort[$i + 1]);
                if ($diff < 1 || $diff > 3) {
                    $isOk = false;
                    break;
                }
            }

            if ($isOk) {
                $sum++;
            }
        }
    }
}

echo $sum;
?>