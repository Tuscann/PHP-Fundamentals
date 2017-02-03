<?php

//$numbers = [1 ,1, 1, 2, 3 ,1 ,3 ,3];
$numbers = "0 1 1 2 2 3 3";
//$numbers = trim(fgets(STDIN));

$numbers = explode(" ", $numbers);

$longest = 0;
$startIndex = -1;

for ($i = 0; $i < count($numbers); $i++) {
    $currentCount = 1;
    $index = $numbers[$i];

    for ($next = $i + 1; $next < count($numbers); $next++) {
        if ($numbers[$i] < $numbers[$next]) {
            $currentCount++;
            $index = $i;
        } else {
            break;
        }
    }

    if ($currentCount > $longest) {
        $longest = $currentCount;
        $startIndex = $i;
    }
}

function PrintLongestSequence($numbers, $index, $count)
{
    for ($i = $index; $i < $index + $count; $i++) {
        echo $numbers[$i] . " ";
    }
}

PrintLongestSequence($numbers, $startIndex, $longest);

?>


