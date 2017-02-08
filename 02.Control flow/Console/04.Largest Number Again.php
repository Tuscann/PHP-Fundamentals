<?php
$largest = PHP_INT_MIN;
while ($number = intval(fgets(STDIN))) {
    $largest = max($largest, $number);
}
echo "Max: $largest";
