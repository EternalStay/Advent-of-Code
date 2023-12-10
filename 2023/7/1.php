<?php
$file = file_get_contents('input.txt');
$lines = explode("\n", $file);

$priorities = ['2', '3', '4', '5', '6', '7', '8', '9', 'T', 'J', 'Q', 'K', 'A'];

$cards = [];

foreach ($lines as $line) {
    $card = explode(' ', $line);

    $parts = [];
    foreach (count_chars($card[0], 1) as $str => $value) {
        $parts[] = $value;
    }

    $cards[] = [
        'hand' => $card[0], 
        'value' => $card[1], 
        'parts' => $parts, 
        'typePriority' => typeOfHand($parts), 
        'handPriority' => priorityOfHand($card[0]), 
    ];
}

foreach ($cards as $key => $card) {
    $typesPriority[$key] = $card['typePriority'];
    $handPriority1[$key] = $card['handPriority'][0];
    $handPriority2[$key] = $card['handPriority'][1];
    $handPriority3[$key] = $card['handPriority'][2];
    $handPriority4[$key] = $card['handPriority'][3];
    $handPriority5[$key] = $card['handPriority'][4];
}

array_multisort($typesPriority, SORT_DESC, $handPriority1, SORT_ASC, $handPriority2, SORT_ASC, $handPriority3, SORT_ASC, $handPriority4, SORT_ASC, $handPriority5, SORT_ASC, $cards);

$sum = 0;
foreach ($cards as $rank => $card) {
    $sum += ($card['value'] * ($rank + 1));
}
echo $sum;

function typeOfHand($parts): int
{
    if (count($parts) === 1) return 1; // Five of a kind
    elseif (count($parts) === 2 && in_array($parts[0], [1, 4])) return 2; // Four of a kind
    elseif (count($parts) === 2) return 3; // Full house
    elseif (count($parts) === 3 && ($parts[0] === 3 || $parts[1] === 3 || $parts[2] === 3)) return 4; // Three of a kind
    elseif (count($parts) === 3) return 5; // Two pair
    elseif (count($parts) === 4) return 6; // One pair
    elseif (count($parts) === 5) return 7; // One pair
    else return 8;
}

function priorityOfHand($hand): array
{
    $result = [];
    foreach (str_split($hand) as $char) {
        $result[] = array_search($char, $GLOBALS['priorities']);
    }

    return $result;
}
?>