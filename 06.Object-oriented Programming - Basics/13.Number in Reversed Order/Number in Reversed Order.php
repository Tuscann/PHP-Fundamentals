<?php

class DecimalNumber
{
    private $number;

    function __construct($number)
    {
        $this->number = $number;
    }


    public function ReversedDigits(): string
    {
        return strrev($this->number);
    }

}

$input = trim(fgets(STDIN));
$number= new DecimalNumber($input);

echo $number->ReversedDigits();