<?php

$file = file_get_contents('input.txt');
$strings = explode("\n", $file);

$sum = 0;
foreach ($strings as $string) {
	if (preg_match_all('/([0-9])/', $string, $match)) {
		$firstLetter = $match[0][0];
		$lastLetter = $match[0][count($match[0]) - 1];
    }
	
	$number = $firstLetter.$lastLetter;
	
	$sum += $number;
}

echo $sum;
?>