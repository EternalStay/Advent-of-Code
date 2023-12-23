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

$maxTotal = 0;

$gridDirectionsEmpty = $gridDirections;
for ($i = 0; $i < count($grid); $i++) {
    for ($j = 0; $j < count($grid[$i]); $j++) {
        $gridDirections = $gridDirectionsEmpty;
        $profondeur = 0;

        if ($i == 0) {
            light($grid, $gridDirections, $i, $j, 'v', $profondeur);
            $maxTotal = getMaxTotal($gridDirections, $maxTotal);
        } elseif ($i == count($grid) - 1) {
            light($grid, $gridDirections, $i, $j, '^', $profondeur);
            $maxTotal = getMaxTotal($gridDirections, $maxTotal);
        }

        $gridDirections = $gridDirectionsEmpty;
        $profondeur = 0;

        if ($j == 0) {
            light($grid, $gridDirections, $i, $j, '>', $profondeur);
            $maxTotal = getMaxTotal($gridDirections, $maxTotal);
        } elseif ($j == count($grid[$i]) - 1) {
            light($grid, $gridDirections, $i, $j, '<', $profondeur);
            $maxTotal = getMaxTotal($gridDirections, $maxTotal);
        }

    }
}

echo $maxTotal;

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

function getMaxTotal($gridDirections, $maxTotal): int
{
    $total = 0;
    foreach ($gridDirections as $line) {
        foreach ($line as $cell) {
            if (count($cell)) $total++;
        }
    }

    if ($total > $maxTotal) {
        return $total;
    }
    return $maxTotal;
}