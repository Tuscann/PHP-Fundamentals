<?php

class Siamese
{
    private $breeds;
    private $name;
    private $earSize;

    public function __construct(string $breeds, string $name, float $earSize)
    {
        $this->breeds = $breeds;
        $this->name = $name;
        $this->earSize = $earSize;

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->breeds . " " . $this->name . " " . $this->earSize;
    }
}

class Cymric
{
    private $breeds;
    private $name;
    private $furLength;

    public function __construct(string $breeds, string $name, float $furLength)
    {
        $this->breeds = $breeds;
        $this->name = $name;
        $this->furLength = $furLength;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function __toString()
    {
        return $this->breeds . " " . $this->name . " " . $this->furLength;
    }

}

class StreetExtraordinaire
{
    private $breeds;
    private $name;
    private $decibelsOfMeows;

    public function __construct(string $breeds, string $name, float $decibelsOfMeows)
    {
        $this->breeds = $breeds;
        $this->name = $name;
        $this->decibelsOfMeows = $decibelsOfMeows;
    }

    public function getName(): string
    {
        return $this->name;
    }


    public function __toString()
    {
        return $this->breeds . " " . $this->name . " " . $this->decibelsOfMeows;
    }

}

$siamese = [];
$cymric = [];
$StreetExtraordinaire = [];

while (true) {

    $input = trim(fgets(STDIN));
    if ($input == "End") {
        break;
    }
    $input = explode(" ", $input);
    $breeds = trim($input[0]);
    $catName = trim($input[1]);
    $number = floatval($input[2]);

    if ($breeds == "Siamese") {
        $siamese[] = new Siamese($breeds, $catName, $number);
    } else if ($breeds == "Cymric") {
        $cymric[] = new Cymric($breeds, $catName, $number);
    } else if ($breeds == "StreetExtraordinaire") {
        $StreetExtraordinaire[] = new StreetExtraordinaire($breeds, $catName, $number);
    }
}
$name = trim(fgets(STDIN));


foreach ($siamese as $Cat) {
    if ($name == $Cat->getName()) {
        echo $Cat;
    }
}
foreach ($cymric as $Cat) {
    if ($name == $Cat->getName()) {
        echo $Cat;
    }
}
foreach ($StreetExtraordinaire as $Cat) {
    if ($name == $Cat->getName()) {
        echo $Cat;
    }
}

