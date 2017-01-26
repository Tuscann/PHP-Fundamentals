<?php

function test($n)
{
    $min = min($n, 999);
    $arr = [];

    if ($n < 100) {
        echo "no" . "<br><br>";
    } else {
        for ($i = 100; $i <= $min; $i++) {

            $firstDigit = $i % 10;
            $secondDigit = (int)(($i / 10) % 10);
            $thirdDigit = (int)($i / 100);

            if ($firstDigit != $secondDigit && $firstDigit != $thirdDigit && $secondDigit != $thirdDigit) {
                array_push($arr, $i);
            }
        }
    }
    if (count($arr) > 0) {
        echo implode(', ', $arr) . "<br>" . "<br>";
    }
}

test(1234);
test(145);
test(15);
test(247);
