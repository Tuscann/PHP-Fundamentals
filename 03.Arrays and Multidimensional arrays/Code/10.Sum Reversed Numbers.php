<?php
$numbers = explode(" ", trim(fgets(STDIN)));
$numbers = explode(" ", "123 234 12");
$total = 0;

foreach ($numbers as $each) {
    $reverseNumber = (int)strrev($each);

    $total += $reverseNumber;
}
print_r($total);

