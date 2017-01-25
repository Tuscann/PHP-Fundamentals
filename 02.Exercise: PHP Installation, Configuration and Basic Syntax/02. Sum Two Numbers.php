<?php

function sumNumbers($firstNumber, $secondNumber)
{
    $sum = number_format($firstNumber + $secondNumber, 2);

    return "\$firstNumber + \$secoundNumber = $firstNumber + $secondNumber = $sum"."<br>";
}

echo sumNumbers(2, 5);
echo sumNumbers(1.567808, 0.356);
echo sumNumbers(1234.5678, 333);



