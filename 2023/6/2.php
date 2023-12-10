<?php
$file = file_get_contents('input.txt');
$lines = explode("\n", $file);

$time = preg_replace('/[^0-9]/', '', $lines[0]);
$distance = preg_replace('/[^0-9]/', '', $lines[1]);

$minInterval = -1;
$maxInterval = -1;

for ($sec = 0; $sec < $time; $sec++) {
    $score = ($sec + ($time - 1 - $sec) * $sec);
    
    if ($score > $distance) {
        $minInterval = $sec;
        break;
    }
}

for ($sec = $time; $sec > 0; $sec--) {
    $score = ($sec + ($time - 1 - $sec) * $sec);
    
    if ($score > $distance) {
        $maxInterval = $sec;
        break;
    }
}

$record = ($maxInterval - $minInterval + 1);
echo $record;
?>