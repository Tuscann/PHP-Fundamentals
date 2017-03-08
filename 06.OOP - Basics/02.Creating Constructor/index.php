<?php

class Person7
{
    private $name;
    private $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
    //getters
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    public function __toString()
    {
        return $this->name . " " . $this->age;
    }
}


$name = trim(fgets(STDIN));
$age = trim(fgets(STDIN));

$person = new Person7($name,$age);

echo $person;
