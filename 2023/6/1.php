<?php
$file = file_get_contents('input.txt');
$lines = explode("\n", $file);

$times = [];
if (preg_match_all('/([0-9]+)/', $lines[0], $match)) {
    $times = $match[0];
}

$distances = [];
if (preg_match_all('/([0-9]+)/', $lines[1], $match)) {
    $distances = $match[0];
}

$records = array_fill(0, count($times), 0);
for ($course = 0; $course < count($times); $course++) {
    $time = $times[$course];
    $distance = $distances[$course];

    for ($sec = 0; $sec < $time; $sec++) {
        $score = ($sec + ($time - 1 - $sec) * $sec);
        
        if ($score > $distance) {
            $records[$course]++;
        }
    }
}

$total = 1;
foreach ($records as $record) {
    $total *= $record;
}

echo $total;
?>