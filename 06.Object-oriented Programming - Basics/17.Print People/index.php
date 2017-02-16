<?php

class Human
{
    private $name;
    private $age;
    private $occupation;

    public function __construct(string $name, int $age, string $occupation)
    {
        $this->name = $name;
        $this->age = $age;
        $this->occupation = $occupation;
    }

    public function __toString()
    {
        return $this->name . ' - ' . 'age: ' . $this->age . ', occupation: ' . $this->occupation . PHP_EOL;
    }

    public function getAge(): int
    {
        return $this->age;
    }
}

$people = array();
while (true) {
    $command = explode(" ", trim(fgets(STDIN)));
    if ($command[0] == "END") {
        break;
    }
    $name = $command[0];
    $age = intval($command[1]);
    $occupation = $command[2];

    array_push($people, new Human($name, $age, $occupation));
}

function sortedAge($p1, $p2)
{
    return $p1->getAge() > $p2->getAge();
}
usort($people, "sortedAge");

foreach ($people as $person) {
    echo $person;
}
