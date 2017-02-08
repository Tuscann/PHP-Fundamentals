<?php
$largest = 0;
while ($number = intval(fgets(STDIN))) {
    $largest = max($largest, $number);
}
echo "Max: $largest";