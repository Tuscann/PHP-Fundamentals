<?php

interface SoundProducible
{
    public function produceSound();

}

abstract class Animal implements SoundProducible
{
    private $name;
    private $age;
    private $gender;
    private $sound = "Not implemented!";

    public function __construct(string $name, int $age, string $gender)
    {
        $this->name = $name;
        $this->age = $age;
        $this->gender = $gender;

    }

    public function __toString()
    {
        return $this->name . " " . $this->age . " " . $this->gender;
    }

    public function produceSound()
    {
        return $this->sound;
    }

}

class Dog extends Animal
{

    private $sound = "BauBau";

    public function produceSound()
    {
        return $this->sound;
    }


}

class Cat extends Animal
{

    private $sound = "MiauMiau";

    public function produceSound()
    {
        return $this->sound;
    }


}

class Frog extends Animal
{

    private $sound = "Frogggg";

    public function produceSound()
    {
        return $this->sound;
    }


}

class Kittens extends Animal
{

    private $sound = "Miau";

    public function produceSound()
    {
        return $this->sound;
    }


}

class Tomcat extends Animal
{

    private $sound = "Give me one million b***h";

    public function produceSound()
    {
        return $this->sound;
    }
}

try {
    while (true) {
        $animal = trim(fgets(STDIN));

        if ($animal == "Beast!") {
            break;
        }
        if(!class_exists($animal)){
            throw new Exception("Invalid input!");
        }

        $delimiters = explode(" ", trim(fgets(STDIN)));
        $name = $delimiters[0];
        $age = intval($delimiters[1]);
        $gender = $delimiters[2];

        if (count($delimiters) != 3) {
            throw new Exception("Invalid input!");
        } else if ($age <= 0) {
            throw new Exception("Invalid input!");
        } else if ($animal == "Kittens" && $gender = "Male") {
            throw new Exception("Invalid input!");
        } else if ($animal == "Tomcats" && $gender = "Female") {
            throw new Exception("Invalid input!");
        } else if ($animal == "Animal") {
            throw new Exception("Not implemented!");
        }

        $typeOfAnimal = new $animal($name, $age, $gender);

        echo $animal . " " . $typeOfAnimal . PHP_EOL;
        echo $typeOfAnimal->produceSound() . PHP_EOL;

    }
} catch (Exception $e) {
    echo $e->getMessage();
}
