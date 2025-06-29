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

$array2Values = array_count_values($array2);

foreach ($array1 as $value) {
    $sum += key_exists($value, $array2Values) ? $value * $array2Values[$value] : 0;
}

echo $sum;
?>