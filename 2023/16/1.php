<?php
$file = file_get_contents('input.txt');
$lines = explode("\n", $file);

$grid = [];
$gridDirections = [];

foreach ($lines as $line) {
    $line = trim($line);

    $grid[] = str_split($line);
    $gridDirections[] = array_fill(0, strlen($line), []);
}

$profondeur = 0;
light($grid, $gridDirections, 0, 0, '>', $profondeur);

$total = 0;
foreach ($gridDirections as $line) {
    foreach ($line as $cell) {
        if (count($cell)) $total++;
    }
}
echo $total;

function light(&$grid, &$gridDirections, $x, $y, $sens, $loop) {
    if (!in_array($sens, $gridDirections[$x][$y])) {
        $gridDirections[$x][$y][] = $sens;

        if ($grid[$x][$y] == '.') {
            if ($sens == '>' && $y + 1 < count($grid[$x])) {
                light($grid, $gridDirections, $x, $y + 1, $sens, $loop + 1);
            }
            if ($sens == '<' && $y - 1 >= 0) {
                light($grid, $gridDirections, $x, $y - 1, $sens, $loop + 1);
            }
            if ($sens == '^' && $x - 1 >= 0) {
                light($grid, $gridDirections, $x - 1, $y, $sens, $loop + 1);
            }
            if ($sens == 'v' && $x + 1 < count($grid)) {
                light($grid, $gridDirections, $x + 1, $y, $sens, $loop + 1);
            }
        }
        elseif ($grid[$x][$y] == '|') {
            if (($sens == '>' OR $sens == '<' OR $sens == '^') && $x - 1 >= 0) {
                light($grid, $gridDirections, $x - 1, $y, '^', $loop + 1);
            }
            if (($sens == '>' OR $sens == '<' OR $sens == 'v') && $x + 1 < count($grid)) {
                light($grid, $gridDirections, $x + 1, $y, 'v', $loop + 1);
            }
        }
        elseif ($grid[$x][$y] == '-') {
            if (($sens == '^' OR $sens == 'v' OR $sens == '<') && $y - 1 >= 0) {
                light($grid, $gridDirections, $x, $y - 1, '<', $loop + 1);
            }
            if (($sens == '^' OR $sens == 'v' OR $sens == '>') && $y + 1 < count($grid[$x])) {
                light($grid, $gridDirections, $x, $y + 1, '>', $loop + 1);
            }
        }
        elseif ($grid[$x][$y] == '/') {
            if ($sens == '>' && $x - 1 >= 0) {
                light($grid, $gridDirections, $x - 1, $y, '^', $loop + 1);
            }
            if ($sens == '<' && $x + 1 < count($grid)) {
                light($grid, $gridDirections, $x + 1, $y, 'v', $loop + 1);
            }
            if ($sens == 'v' && $y - 1 >= 0) {
                light($grid, $gridDirections, $x, $y - 1, '<', $loop + 1);
            }
            if ($sens == '^' && $y + 1 < count($grid[$x])) {
                light($grid, $gridDirections, $x, $y + 1, '>', $loop + 1);
            }
        }
        elseif ($grid[$x][$y] == '\\') {
            if ($sens == '<' && $x - 1 >= 0) {
                light($grid, $gridDirections, $x - 1, $y, '^', $loop + 1);
            }
            if ($sens == '>' && $x + 1 < count($grid)) {
                light($grid, $gridDirections, $x + 1, $y, 'v', $loop + 1);
            }
            if ($sens == '^' && $y - 1 >= 0) {
                light($grid, $gridDirections, $x, $y - 1, '<', $loop + 1);
            }
            if ($sens == 'v' && $y + 1 < count($grid[$x])) {
                light($grid, $gridDirections, $x, $y + 1, '>', $loop + 1);
            }
        }
    }
}