<?php
$file = file_get_contents('input.txt');
$lines = explode("\n", $file);

$sum = 0;
foreach ($lines as $line) {
    $values = [];
    $values[0] = array_reverse(explode(' ', $line));

    while (!allZero($values[count($values) - 1])) {
        $count = count($values);
        $values[$count] = [];

        for ($i = 0; $i < count($values[$count - 1]) - 1; $i++) {
            $values[$count][] = $values[$count - 1][$i + 1] - $values[$count - 1][$i];
        }
    }

    $values = array_reverse($values);
    $values[0][] = 0;
    for ($i = 1; $i < count($values); $i++) {
        $values[$i][] = $values[$i][count($values[$i]) - 1] + $values[$i - 1][count($values[$i - 1]) - 1];
    }

    $sum += $values[count($values) - 1][count($values[count($values) - 1]) - 1];
}

echo $sum;

function allZero($array): bool
{
    $array = array_unique($array);
    return count($array) === 1 && $array[0] === 0;
}
?>