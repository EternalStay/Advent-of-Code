<?php

$file = file_get_contents('input.txt');
$strings = explode("\n", $file);

$sum = 0;

foreach ($strings as $string) {
    if (preg_match_all('/([0-9]+)/', $string, $matches)) {
        $match = $matches[1];
        $isOk = false;
        
        if (isSafe($match)) {
            $isOk = true;
            $sum++;
        } else {
            for ($i = 0; $i < count($match); $i++) {
                $matchTmp = $match;
                unset($matchTmp[$i]);
                if (isSafe(array_values($matchTmp))) {
                    $isOk = true;
                    $sum++;
                    
                    break;
                }
            }
        }
    }
}

echo $sum;

function isSafe(array $match): bool
{
    $matchesSort = $match;
    $matchesASort = $match;

    sort($matchesSort);
    rsort($matchesASort);

    if ($match == $matchesSort || $match == $matchesASort) {
        $isOk = true;

        for ($i = 0; $i < count($matchesSort) - 1; $i++) {
            $diff = abs($matchesSort[$i] - $matchesSort[$i + 1]);
            if ($diff < 1 || $diff > 3) {
                $isOk = false;
                break;
            }
        }

        return $isOk;
    }

    return false;
}
?>