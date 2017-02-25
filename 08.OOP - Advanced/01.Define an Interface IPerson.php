<?php
namespace personInterface;

interface PersonInterface
{
    public function setAge(int $age): int;

    public function setName(string $name): string;

    public function getName(): string;

    public function getAge(): int;
}

class Person implements PersonInterface
{
    private $age;
    private $name;

    public function __construct(int $age, string $name)
    {
        $this->setAge($age);
        $this->setName($name);
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

//Getters

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

}

$name = trim(fgets(STDIN));
$age = trim(fgets(STDIN));

$vanko = new Person($age, $name);

echo $vanko->getName().PHP_EOL.$vanko->getAge();
