<?php
namespace MultipleImplementation;

interface PersonInterface
{
    public function setAge(int $age): int;

    public function setName(string $name): string;

    public function getName(): string;

    public function getAge(): int;
}

interface Identifiable
{

    public function setID(string $id): string;
}

interface Birthable
{

    public function setBirthDate(string $birthDate): string;
}


class Person implements PersonInterface, Identifiable, Birthable
{
    private $age;
    private $name;
    private $id;
    private $birthDate;

    public function __construct(int $age, string $name, string $id, string $birthDate)
    {
        $this->setAge($age);
        $this->setName($name);
        $this->setID($id);
        $this->setBirthDate($birthDate);
    }

//Setters

    public function setAge(int $age): int
    {
        return $this->age = $age;
    }

    public function setName(string $name): string
    {
        return $this->name = $name;
    }

    public function setID(string $id): string
    {
        return $this->id = $id;
    }



    public function setBirthDate(string $birthDate): string
    {
        return $this->birthDate = $birthDate;
    }

//Getters

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getID(): string
    {
        return $this->id;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }
}

$name = trim(fgets(STDIN));
$age = intval(trim(fgets(STDIN)));
$id = trim(fgets(STDIN));
$birthDate = trim(fgets(STDIN));

$vanko = new Person($age, $name, $id, $birthDate);

echo $vanko->getName() . PHP_EOL . $vanko->getAge() . PHP_EOL . $vanko->getID() . PHP_EOL . $vanko->getBirthDate();
