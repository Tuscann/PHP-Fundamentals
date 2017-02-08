<?php
//$input = [1, 1, 1, 2, 3, 1, 3, 3];
$input  = "3 3 2 3 4 2 2 3 4 8 9 10 23 23 23 45 9 0 4 5 2 4 6 2 39 18 27 2 37 26 25 2 3 3";
//$input  = trim(fgets(STDIN));

$numbers = explode(" ", $input);

$maxCount = 1;
$startIndex = 0;

for ($current = 0; $current < count($numbers) - 1; $current++) {
    $count = 1;
    $index = 0;
    for ($next = $current + 1; $next < count($numbers); $next++) {
        if ($numbers[$current] == $numbers[$next]) {
            $count++;
            $index = $current;
        } else {
            break;
        }
    }

    if ($count > $maxCount) {
        $maxCount = $count;
        $startIndex = $index;
    }
    $current += $count - 1;
}


function PrintLongestSequence($numbers, $index, $count)
{
    $print = "";
    for ($i = $index; $i < $index + $count; $i++) {
        $print .= $numbers[$i] . " ";
    }
    return $print;
}

echo PrintLongestSequence($numbers, $startIndex, $maxCount);

?>


