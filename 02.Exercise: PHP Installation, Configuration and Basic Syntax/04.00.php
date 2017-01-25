<?php
function nonRepeatingDigits($max)
{
    $numbers = array();

    for ($i = 102; $i <= min($max, 987); $i++) {
        $currentNumber = strval($i);
        if ($currentNumber[0] != $currentNumber[1] && $currentNumber[1] != $currentNumber[2] && $currentNumber[0] != $currentNumber[2]) {
            $numbers[] = $i;
        }
    }
    return ($numbers ? implode(", ", $numbers) : "no") . "<br /><br />";
}

echo nonRepeatingDigits(1234);
echo nonRepeatingDigits(145);
echo nonRepeatingDigits(15);
echo nonRepeatingDigits(247);