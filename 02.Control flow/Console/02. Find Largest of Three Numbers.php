<?php

$first = intval(fgets(STDIN));
$second = intval(fgets(STDIN));
$third = intval(fgets(STDIN));

$largest = max($first, $second, $third);

echo "Max: ".$largest."\n";