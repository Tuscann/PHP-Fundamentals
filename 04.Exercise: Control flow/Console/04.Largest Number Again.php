<?php
$largest = -231231241234123412341234;
while ($number = intval(fgets(STDIN))) {
    $largest = max($largest, $number);
}
echo "Max: $largest";