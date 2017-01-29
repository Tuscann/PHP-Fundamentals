<?php

$first = intval(fgets(STDIN));
$secound = intval(fgets(STDIN));
$third = intval(fgets(STDIN));

$largest = max($first, $secound, $third);

echo "Max: ".$largest;