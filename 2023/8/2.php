<?php
$file = file_get_contents('input.txt');
$lines = explode("\n", $file);

$orders = str_split($lines[0]);

$nodes = [];
$nodesA = [];
for ($lineCount = 2; $lineCount < count($lines); $lineCount++) {
    $line = $lines[$lineCount];
    if (preg_match('/(\w+) = \((\w+), (\w+)\)/', $line, $match)) {
        $nodes[$match[1]] = [
            'L' => $match[2], 
            'R' => $match[3], 
        ];
    }
    if (preg_match('/(\w+A) = \((\w+), (\w+)\)/', $line, $match)) {
        $nodesA[] = $match[1];
    }
}

$stepsZ = [];
foreach ($nodesA as $node) {
    $stepsZ[] = ['first' => null, 'second' => null];
}

$step = 0;
$values = $nodesA;
while (!finish($stepsZ)) {
    $order = $orders[$step % (count($orders) - 1)];

    foreach ($values as $key => &$value) {
        $value = $nodes[$value][$order];
        
        if (substr($value, -1) === 'Z') {
            if ($stepsZ[$key]['first'] == null) $stepsZ[$key]['first'] = $step;
            elseif ($stepsZ[$key]['second'] == null) $stepsZ[$key]['second'] = $step;
        }
    }

    $step++;
}

echo finish($stepsZ);

function finish($stepsZ): int
{
    foreach ($stepsZ as $node) {
        if (!$node['second']) return 0;
    }

    $ppcm = $stepsZ[0]['second'] - $stepsZ[0]['first'];
    for ($i = 1; $i < count($stepsZ); $i++) {
        $ppcm = gmp_lcm($ppcm, $stepsZ[$i]['second'] - $stepsZ[$i]['first']);
    }

    return gmp_intval($ppcm);
}
?>