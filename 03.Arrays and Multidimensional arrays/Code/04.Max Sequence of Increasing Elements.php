<?php
$input = "0 0 1 1 2 4 5 6 1 2 28 37 26 25 24 14 19 18 17 16 15 12 3 3";
//$input = trim(fgets(STDIN));
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
        $startIndex =  $index;
    }
    $current += $count - 1;
}

function PrintLongestSequence($numbers, $index, $count)
{
    for ($i = $index; $i < $index + $count; $i++) {
        echo $numbers[$i] . " ";
    }
}

PrintLongestSequence($numbers, $startIndex, $maxCount);

?>


