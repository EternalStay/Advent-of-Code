<?php
$file = file_get_contents('input.txt');
$lines = explode("\n", $file);

$converts = [];
$locations = [];

foreach ($lines as $line) {
    if (str_starts_with($line, 'seeds: ')) {
        $seeds = explode(' ', str_replace('seeds: ', '', $line));
        continue;
    }

    if (preg_match('/(.*)\-to\-(.*) map/', $line, $match)) {
        $converts[$match[1]] = $match[2];
        $convert = $match[2];
        $convertTab[$convert] = [];
    }

    if (preg_match_all('/[0-9]+/', $line, $match)) {
        $convertTab[$convert][] = $match[0];
    }
}

foreach ($seeds as $seed) {
    $value = trim($seed);

    foreach ($converts as $convert) {
        $foundConvert = false;

        foreach ($convertTab[$convert] as $tab) {
            if ($value > $tab[1] && $value < $tab[1] + $tab[2]) {
                $foundConvert = true;
                $value = $value - ($tab[1] - $tab[0]);

                break;
            }
        }
    }

    $locations[] = $value;
}

echo min($locations);
?>