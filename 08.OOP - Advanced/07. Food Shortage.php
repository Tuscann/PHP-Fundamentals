<?php
namespace FoodShortage;
interface Buyer
{
    public function buyFood(): int;

    public function getFood(): int;
}

abstract class Human implements Buyer
{

    protected $name;
    protected $age;
    protected $food = 0;

    protected function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
}

class Rabel extends Human
{
    private $group;

    public function __construct(string $name, int $age, string $group)
    {
        parent::__construct($name, $age);
        $this->group = $group;
    }

    public function buyFood(): int
    {
        return $this->food += 5;
    }

    public function getFood(): int
    {
        return $this->food;
    }
}

class Citizen extends Human
{
    private $id;
    private $birthDay;

    public function __construct(string $name, int $age, string $id, string $birthDay)
    {
        parent::__construct($name, $age);
        $this->id = $id;
        $this->birthDay = $birthDay;
    }

    public function buyFood(): int
    {
        return $this->food += 10;
    }

    public function getFood(): int
    {
        return $this->food;
    }
}
$arrayPeople = [];

$counter = trim(fgets(STDIN));
for ($i = 0; $i < $counter; $i++) {
    $input = trim(fgets(STDIN));
    $tokens = explode(" ", $input);
    $name = $tokens[0];
    $age = intval($tokens[1]);

    if (count($tokens) == 4) {
        $id = $tokens[2];
        $birthDay = $tokens[3];

        $arrayPeople[$name] = new Citizen($name, $age, $id, $birthDay);
    } else if (count($tokens) == 3) {
        $group = $tokens[2];

        $arrayPeople[$name] = new Rabel($name, $age, $group);
    }
}
$amountOfFood = [];

while (true) {
    $nameToBeCheked = trim(fgets(STDIN));
    if ($nameToBeCheked == "End") {
        break;
    }
    if (array_key_exists($nameToBeCheked, $arrayPeople)) {
        $person = $arrayPeople[$nameToBeCheked];
        $person->buyFood();

        $amountOfFood[$nameToBeCheked] = $person->getFood();
    }
}
echo array_sum($amountOfFood);