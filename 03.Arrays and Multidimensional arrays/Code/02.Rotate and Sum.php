<?php
$input = trim(fgets(STDIN));
$numbers = explode(" ", $input);
$rotations = trim(fgets(STDIN));

$sum = [];

for ($i = 1; $i <= $rotations; $i++) {
    for ($j = 0; $j < count($numbers); $j++) {
        $sum[($i + $j) % count($numbers)] += $numbers[$j];
    }
}
ksort($sum);
foreach ($sum as $key => $val) {
    echo "$val ";
}


?>