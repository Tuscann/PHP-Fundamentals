<?php

class Person1
{
    private $name;
    private $age;

    function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

$ArrayPersons = array();
$counter = intval(trim(fgets(STDIN)));
for ($i = 0; $i < $counter; $i++) {
    $input = explode(" ", fgets(STDIN));

    $name = $input[0];
    $age = intval($input[1]);

    if ($age > 30) {
        $person = $person = new Person1($name, $age);
        array_push($ArrayPersons, $person);
    }
}

usort($ArrayPersons, function (Person1 $personA, Person1 $personB) {
    return $personA->getName() <=> $personB->getName();
});

foreach ($ArrayPersons as $person) {
    echo $person->getName().' - '.$person->getAge(). PHP_EOL;
}


