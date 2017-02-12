<?php

class Number
{
    private $number;

    public function __construct(int $number)
    {
        $this->number = $number;

    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    public function getLastDigit_name(): string
    {
        $last = intval(substr($this->number, -1));
        //var_dump($last);

        if ($last == 0) {
            $last = "zero";
        } elseif ($last == 1) {
            $last = "one";
        } else if ($last == 2) {
            $last = "two";
        } else if ($last == 3) {
            $last = "three";
        } else if ($last == 4) {
            $last = "four";
        } else if ($last == 5) {
            $last = "five";
        } else if ($last == 6) {
            $last = "six";
        } else if ($last == 7) {
            $last = "seven";
        } else if ($last == 8) {
            $last = "eight";
        } else if ($last == 9) {
            $last = "nine";
        }
        return $last;
    }
}

$input = trim(fgets(STDIN));

$number = new Number($input);

echo $number->getLastDigit_name();