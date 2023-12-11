<?php
$file = file_get_contents('input.txt');
$lines = explode("\n", str_replace('7', ']', $file));

$expandValue = 999999;

$grids = [];
$columnsEmpty = array_fill(0, strlen($lines[0]) - 1, $expandValue);
$rowsEmpty = array_fill(0, count($lines), $expandValue);

// Création de l'input
foreach ($lines as $key => $line) {
    $line = trim($line);
    $lineArray = str_split($line);

    $grids[] = $lineArray;

    if (($col = array_search('#', $lineArray)) !== false) {
        $rowsEmpty[$key] = false;
    }

    foreach (array_keys($lineArray, '#') as $col) {
        $columnsEmpty[$col] = false;

        $galaxies[] = [$key, $col];
    }
}

// Extension du vide
$columnSum = 0;
foreach ($columnsEmpty as &$column) {
    if ($column) {
        $columnSum += $expandValue + 1;
        $column = $columnSum;
    } else {
        $column = ++$columnSum;
    }
}
$rowSum = 0;
foreach ($rowsEmpty as &$row) {
    if ($row) {
        $rowSum += $expandValue + 1;
        $row = $rowSum;
    } else {
        $row = ++$rowSum;
    }
}

// Calcul des distances
$distancesGalaxies = [];
foreach ($galaxies as $g1Name => $g1) {
    foreach ($galaxies as $g2Name => $g2) {
        if ($g1[0] != $g2[0] || $g1[1] != $g2[1]) {
            $distancesGalaxies[] = 
                (max($rowsEmpty[$g1[0]], $rowsEmpty[$g2[0]]) - min($rowsEmpty[$g1[0]], $rowsEmpty[$g2[0]])) + (max($columnsEmpty[$g1[1]], $columnsEmpty[$g2[1]]) - min($columnsEmpty[$g1[1]], $columnsEmpty[$g2[1]]))
            ;
        }
    }
}

echo array_sum($distancesGalaxies) / 2;
?>