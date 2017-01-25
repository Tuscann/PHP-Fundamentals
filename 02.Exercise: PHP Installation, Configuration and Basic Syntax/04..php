<?php
$n = 1225;
$min = min($n, 999);
$arr = [];

if ($n < 100) {
    echo "no";
} else {
    for ($i = 100; $i <= $min; $i++) {

        $x = str_split("$i");
        $x = array_unique($x);
        $x = implode('', $x);
        if (strlen($x) == 3) {
            echo $x.', '; //не премахва последната запетая
        }
    }
}

