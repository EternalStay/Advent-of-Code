<?php
$file = file_get_contents('input.txt');
$lines = explode("\n", $file);

$orders = str_split($lines[0]);

$nodes = [];
for ($lineCount = 2; $lineCount < count($lines); $lineCount++) {
    $line = $lines[$lineCount];
    if (preg_match('/([A-Z]+) = \(([A-Z]+), ([A-Z]+)\)/', $line, $match)) {
        $nodes[$match[1]] = [
            'L' => $match[2], 
            'R' => $match[3], 
        ];
    }
}

$step = 0;
$value = 'AAA';

while ($value !== 'ZZZ') {
    $order = $orders[$step % (count($orders) - 1)];
    $value = $nodes[$value][$order];
    $step++;
}

echo $step;
?>