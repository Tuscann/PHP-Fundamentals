<?php
declare(strict_types = 1);

namespace WildFarm;

abstract class Food
{
    protected $quantity;
    protected $foodType;

    public function __construct(float $quantity, string $foodType)
    {
        $this->quantity = $quantity;
        $this->foodType = $foodType;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function getFoodType(): string
    {
        return $this->foodType;
    }

}

abstract class Animal
{
    protected $name;
    protected $type;
    protected $weight;
    protected $foodEaten = 0;
    protected $sound;

    public function __construct(string $name, string $type, float $weight)
    {
        $this->name = $name;
        $this->type = $type;
        $this->weight = $weight;
    }

    public function makeSound()
    {
        return $this->sound;
    }

    public function eat(Food $food, $foodType)
    {
        $this->foodEaten += $food->getQuantity();
    }

    function __toString()
    {
        return basename(get_class($this));
    }
}


abstract class Mammal extends Animal
{
    protected $region;

    public function __construct(string $name, string $type, float $weight, string $livingRegion)
    {
        $this->region = $livingRegion;
        parent::__construct($name, $type, $weight);
    }

    function __toString()
    {
        return parent::__toString() . "[{$this->name}, {$this->weight}, {$this->region}, {$this->foodEaten}]";
    }

}

abstract class Feline extends Mammal
{

}


class Vegatable extends Food
{

}

class Meat extends Food
{

}


class Cat extends Feline
{
    const SOUND = "Meowwww";
    private $breed;

    public function __construct(string $name, string $type, float $weight, string $livingRegion, string $breed)
    {
        $this->breed = $breed;
        $this->sound = self::SOUND;
        parent::__construct($name, $type, $weight, $livingRegion);
    }

    function __toString()
    {
        return basename(get_class($this)) . "[{$this->name}, {$this->breed}, {$this->weight}, {$this->region}, {$this->foodEaten}]";
    }
}

class Tiger extends Feline
{
    const SOUND = "ROAAR!!!";

    public function __construct(string $name, string $type, float $weight, string $livingRegion)
    {
        $this->sound = self::SOUND;
        parent::__construct($name, $type, $weight, $livingRegion);
    }


    public function eat(Food $food, $footType)
    {
        if ($footType != "Meat") {
            throw new \Exception(basename(get_class($this)) . "s are not eating that type of food!");
        }
        parent::eat($food, $footType);
    }

}

class Zebra extends Mammal
{
    const SOUND = "Zs";

    public function __construct(string $name, string $type, float $weight, string $livingRegion)
    {
        $this->sound = self::SOUND;
        parent::__construct($name, $type, $weight, $livingRegion);
    }

    public function eat(Food $food, $footType)
    {
        if ($footType != "Vegetable") {
            throw new \Exception(basename(get_class($this)) . "s are not eating that type of food!");
        }
        parent::eat($food, $footType);
    }
}

class Mouse extends Mammal
{

    const SOUND = "SQUEEEAAAK!";

    public function __construct(string $name, string $type, float $weight, string $livingRegion)
    {
        $this->sound = self::SOUND;
        parent::__construct($name, $type, $weight, $livingRegion);
    }

    public function eat(Food $food, $footType)
    {
        if ($footType != "Vegetable") {
            throw new \Exception(basename(get_class($this)) . "s are not eating that type of food!");
        }
        parent::eat($food, $footType);
    }
}

while (true) {
    $input = trim(fgets(STDIN));

    if ($input == "End") {
        break;
    }
    $animal = null;

    $input = explode(" ", $input);
    $animalType = $input[0];
    $animalName = $input[1];
    $animalWeight = floatval($input[2]);
    $animalLivingRegion = $input[3];

    if (count($input) == 5 && $animalType == "Cat") {
        $catBread = $input[4];
        $animal = new Cat($animalName, $animalType, $animalWeight, $animalLivingRegion, $catBread);
    } else if (count($input) == 4 && $animalType == "Tiger") {

        $animal = new Tiger($animalName, $animalType, $animalWeight, $animalLivingRegion);
    } else if (count($input) == 4 && $animalType == "Zebra") {

        $animal = new Zebra($animalName, $animalType, $animalWeight, $animalLivingRegion);
    } else if (count($input) == 4 && $animalType == "Mouse") {

        $animal = new Mouse($animalName, $animalType, $animalWeight, $animalLivingRegion);
    }

    $food = null;
    $odd = explode(" ", trim(fgets(STDIN)));
    $foodType = $odd [0];
    $foodQuantity = floatval($odd [1]);

    if ($foodType == "Meat") {
        $food = new Meat($foodQuantity, $foodType);
    } else if ($foodType == "Vegetable") {
        $food = new Vegatable($foodQuantity, $foodType);
    }
    echo $animal->makeSound() . PHP_EOL;
    try {
        $animal->eat($food, $foodType);
    } catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
    echo $animal.PHP_EOL;
}