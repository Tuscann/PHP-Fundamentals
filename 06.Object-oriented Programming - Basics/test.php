<?php

class Person
{
    private $name;
    private $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }
}

$counter = trim(fgets(STDIN));
for ($i = 0; $i < $counter; $i++) {
    $inputs = trim(fgets(STDIN));
    $input = explode(" ", $inputs);

    $persons[] = new Person($input[0], intval($input[1]));
}
function sortAlphabetically(Person $a, Person $b)
{
    return $a->getName() <=> $b->getName();
}

usort($persons, "sortAlphabetically");


for ($i = 0; $i < count($persons); $i++) {

    if ($person[$i]->getAge > 30) {
        if ($i != count($persons) - 1) {
            echo $person->getName() . " - " . $person->getAge() . "\n";
        } else {
            echo $person->getName() . " - " . $person->getAge();
        }

    }
}
