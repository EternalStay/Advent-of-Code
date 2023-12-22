<?php
$file = file_get_contents('input.txt');
$hashs = explode(',', $file);

$boxes = [];

foreach ($hashs as $hash) {
    if (str_contains($hash, '=')) {
        $tmp = explode('=', $hash);
        $hashValue = getHash($tmp[0]);
        $boxes[$hashValue][$tmp[0]] = $tmp[1];
    } else {
        $tmp = str_replace('-', '', $hash);
        $hashValue = getHash($tmp);
        if (key_exists($hashValue, $boxes) && key_exists($tmp, $boxes[$hashValue])) {
            unset($boxes[$hashValue][$tmp]);
        }
    }
}

$total = 0;
foreach ($boxes as $numberBox => $boxe) {
    $slots = array_keys($boxe);
    for ($numberSlot = 0; $numberSlot < count($slots); $numberSlot++) {
        $slot = $slots[$numberSlot];
        $focal = $boxe[$slot];

        $total += ($numberBox + 1) * ($numberSlot + 1) * $focal;
    }
}
echo $total;

function getHash($string): int
{
    $currentValue = 0;
    foreach (str_split($string) as $char) {
        $ascii = ord($char);
        $currentValue += $ascii;
        $currentValue *= 17;
        $currentValue %= 256;
    }

    return $currentValue;
}
?>