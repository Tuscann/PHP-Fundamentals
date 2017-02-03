<?php

//$numbers = [1 ,1, 1, 2, 3 ,1 ,3 ,3];
//$numbers = "3 2 3 4 2 2 4;
//$numbers = trim(fgets(STDIN));

$numbers = explode(" ", $numbers);

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
    for ($i = $index; $i < $index + $count; $i++) {
        echo $numbers[$i] . " ";
    }
}

PrintLongestSequence($numbers, $startIndex, $maxCount);

?>


