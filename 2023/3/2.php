<?php

$file = file_get_contents('input.txt');
$strings = explode("\n", $file);

$gears = [];

foreach ($strings as $line => $string) {
    $colInNumber = [];

    for ($column = 0; $column < strlen($string); $column++) {
        if (in_array($column, $colInNumber)) continue;

        $hasSymbol = false;
        if (is_numeric($string[$column])) {
            
            if (preg_match('/^([0-9]+).*/', substr($string, $column), $match)) {
                $number = $match[1];

                for ($i = 0; $i < strlen($number); $i++) {
                    $colInNumber[] = $column + $i;
                }

                for ($numberSelected = $column; $numberSelected < $column + strlen($number); $numberSelected++) {
                    for ($lineFor = $line - 1; $lineFor <= $line + 1; $lineFor++) {
                        if ($lineFor < 0 || $lineFor >= count($strings)) continue;

                        for ($columnFor = $numberSelected - 1; $columnFor <= $numberSelected + 1; $columnFor++) {
                            if ($columnFor < 0 || $columnFor >= strlen($string) - 1) continue;
    
                            $char = $strings[$lineFor][$columnFor];
                            if ($char === '*') {
                                $gears[$lineFor][$columnFor][] = $number;
                                break 3;
                            }
                        }
                    }
                }

            }
        }
    }
}

$sum = 0;

foreach ($gears as $gear1) {
    foreach ($gear1 as $gear) {
        if (count($gear) == 2) {
            $sum += ($gear[0] * $gear[1]);
        }
    }
}

echo $sum;

?>