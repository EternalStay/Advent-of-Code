<?php
$file = file_get_contents('input.txt');
$hashs = explode(',', $file);

$total = 0;
foreach ($hashs as $hash) {
    $currentValue = 0;
    foreach (str_split($hash) as $char) {
        $ascii = ord($char);
        $currentValue += $ascii;
        $currentValue *= 17;
        $currentValue %= 256;
    }
    $total += $currentValue;
}
echo $total;
?>