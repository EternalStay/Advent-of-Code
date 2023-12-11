<?php
$file = file_get_contents('input.txt');
$lines = explode("\n", str_replace('7', ']', $file));

$grids = [];
$columnsEmpty = array_fill(0, strlen($lines[0]) - 1, true);
$rowsEmpty = array_fill(0, count($lines), true);

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
    }
}

// Création de l'extension du vide
$expandGrid = [];
foreach ($grids as $keyRow => $row) {
    $line = [];
    foreach ($row as $keyCol => $col) {
        $line[] = $grids[$keyRow][$keyCol];
        if ($columnsEmpty[$keyCol]) {
            $line[] = $grids[$keyRow][$keyCol];
        }

        if ($grids[$keyRow][$keyCol] == '#') {
            $galaxies[] = [$keyRow, $keyCol];
        }
    }

    $expandGrid[] = $line;
    if ($rowsEmpty[$keyRow]) {
        $expandGrid[] = $line;
    }
}

// Recherche des galaxies
$galaxies = [];
foreach ($expandGrid as $keyRow => $row) {
    foreach ($row as $keyCol => $col) {
        if ($expandGrid[$keyRow][$keyCol] == '#') {
            $galaxies[] = [$keyRow, $keyCol];
        }
    }
}

// Calcul des distances
$distancesGalaxies = [];
foreach ($galaxies as $g1) {
    foreach ($galaxies as $g2) {
        if ($g1[0] != $g2[0] || $g1[1] != $g2[1]) {
            $distancesGalaxies[] = 
                (max($g1[0], $g2[0]) - min($g1[0], $g2[0])) + (max($g1[1], $g2[1]) - min($g1[1], $g2[1]))
            ;
        }
    }
}

echo array_sum($distancesGalaxies) / 2;
?>