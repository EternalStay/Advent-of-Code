<?php

$file = file_get_contents('input.txt');
$strings = explode("\n", $file);

$trads = [
	'nine' => 9, 
	'eight' => 8, 
	'seven' => 7, 
	'six' => 6, 
	'five' => 5, 
	'four' => 4, 
	'three' => 3, 
	'two' => 2, 
	'one' => 1, 
];

$tradsReverse = [];
foreach ($trads as $key => $trad) {
    $tradsReverse[strrev($key)] = $trad;
}

$sum = 0;
foreach ($strings as $string) {
	$stringReverse = strrev($string);

	if (trim($string) == '5csrtvjmjzs391sixtwonef') $debug = true;

	if (preg_match_all('/(one|two|three|four|five|six|seven|eight|nine|1|2|3|4|5|6|7|8|9)/', $string, $match)) {
		$firstLetter = $match[0][0];
		$firstLetter = key_exists($firstLetter, $trads) ? $trads[$firstLetter] : $firstLetter;
	}

	if (preg_match_all('/(eno|owt|eerht|ruof|evif|xis|neves|thgie|enin|1|2|3|4|5|6|7|8|9)/', $stringReverse, $match)) {
		$lastLetter = $match[0][0];
		$lastLetter = key_exists($lastLetter, $tradsReverse) ? $tradsReverse[$lastLetter] : $lastLetter;
	}
	
	$number = $firstLetter.$lastLetter;
	
	$sum += $number;
}

echo $sum;
?>