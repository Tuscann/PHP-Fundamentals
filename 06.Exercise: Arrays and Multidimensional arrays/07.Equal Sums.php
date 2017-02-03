<?php
//$numbers = "10 5 5 99 3 4 2 5 1 1 4";
$numbers  = trim(fgets(STDIN));

$numbers = explode(" ", $numbers);

//echo "<pre>";
//var_dump($numbers);
//echo "</pre>";

findElement($numbers);

function findElement($numbers)
{
    $isFound = false;
    for ($i = 0; $i < count($numbers); $i++) {
        $leftSum = findLeftSum($numbers, $i);
        $rightSum = findRightSum($numbers, $i);
        if ($leftSum == $rightSum) {
            $isFound = true;
            echo $i;
            return;
        }
    }
    if (!$isFound) {
        echo "no";
    }

}

function findRightSum($numbers, $current)
{
    $sum = 0;
    if ($current != count($numbers) - 1) {

        for ($i = count($numbers) - 1; $i > $current; $i--) {
            $sum += $numbers[$i];
        }
    }
    return $sum;

}

function findLeftSum($numbers, $current)
{
    $sum = 0;
    if ($current != 0) {

        for ($i = 0; $i < $current; $i++) {
            $sum += $numbers[$i];
        }
    }
    return $sum;

}