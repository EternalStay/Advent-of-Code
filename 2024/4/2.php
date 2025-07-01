<?php

$file = file_get_contents('input.txt');

$array = [];
$lines = explode("\n", $file);
foreach ($lines as $line) {
    $array[] = str_split(rtrim($line));
}

$count = 0;

for ($i = 1; $i < count($array) - 1; $i++) {
    for ($j = 1; $j < count($array[0]) - 1; $j++) {
        if ($array[$i][$j] === 'A') {
            if (
                (
                    ($array[$i - 1][$j - 1] == 'M' AND $array[$i + 1][$j + 1] == 'S')
                    OR ($array[$i - 1][$j - 1] == 'S' AND $array[$i + 1][$j + 1] == 'M')
                )
                AND
                (
                    ($array[$i + 1][$j - 1] == 'S' AND $array[$i - 1][$j + 1] == 'M')
                    OR ($array[$i + 1][$j - 1] == 'M' AND $array[$i - 1][$j + 1] == 'S')
                )
            ) {
                $count++;
            }
        }
    }
}

echo $count;
?>