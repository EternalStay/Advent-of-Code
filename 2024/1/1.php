<?php

$file = file_get_contents('input.txt');
$strings = explode("\n", $file);

$sum = 0;

$array1 = [];
$array2 = [];
foreach ($strings as $string) {
    if (preg_match('/([0-9]+)\s+([0-9]+)/', $string, $match)) {
        $array1[] = $match[1];
        $array2[] = $match[2];
    }
}
sort($array1);
sort($array2);

for ($i = 0; $i < count($array1); $i++) {
    $sum += abs($array2[$i] - $array1[$i]);
}

echo $sum;
?>