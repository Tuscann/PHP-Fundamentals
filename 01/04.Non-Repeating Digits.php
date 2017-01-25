<?php
$n = 25;
$min = min($n, 999);

if ($n < 100) {
    echo "no";
} else {
    for ($i = 100; $i <= $min; $i++) {
        if ($i != $min) {
            echo $i . ", ";
        } else if ($i = $min) {
            echo $i;
        }
    }
}
