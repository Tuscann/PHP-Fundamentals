<?php
//$input = "123 234 12";
$input = trim(fgets(STDIN));

$numbers = explode(" ", $input);

$total = 0;

foreach ($numbers as $each) {
    $reverseNumber = (int)strrev($each);

    $total += $reverseNumber;
}
print_r($total);
