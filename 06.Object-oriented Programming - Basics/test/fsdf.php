<?php

class Person{
    private $name;
    private $age;

    function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;

    }

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }
}

class Family{
    private $people = array();

    public function addMember(Person $person)
    {
        $this->people[] = $person;
    }

    public function getPeople()
    {
        return $this->people;
    }

}


$linesCount = intval(trim(fgets(STDIN)));
$family = new Family();

for($i = 0;$i < $linesCount; $i++){
    $personalInfo = explode(" ", trim(fgets(STDIN)));
    list($name, $age) = [$personalInfo[0], intval($personalInfo[1])];

    $person = new Person($name, $age);
    $family->addMember($person);

}

$familyMembers = $family->getPeople();
$ages = [];
foreach ($familyMembers as $familyMember){
    $ages[$familyMember->getName()] = $familyMember->getAge();
}

$oldestMemberAge = max($ages);
$oldestMemberName = array_search($oldestMemberAge, $ages);
echo $oldestMemberName . ' ' . $oldestMemberAge;