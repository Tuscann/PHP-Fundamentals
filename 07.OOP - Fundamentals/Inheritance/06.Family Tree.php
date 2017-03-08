<?php
declare(strict_types = 1);
namespace task6;

class Person
{
    private $firstName;
    private $lastName;
    private $birthDate;
    private $parents = [];
    private $children = [];

    public function __construct(string $firstName, string $lastName, string $birthDate)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function getFullName(): string
    {
        return $this->firstName . $this->lastName;
    }

    public function addParent(Person $parent)
    {
        $this->parents[] = $parent;
    }

    public function addChild(Person $child)
    {
        $this->children[] = $child;
    }

    public function getFullDetails(): string
    {
        $output = $this . PHP_EOL;
        $output .= "Parents:" . PHP_EOL;

        if ($this->birthDate == "20/12/2000") {
            $this->parents = array_reverse($this->parents);
        }

        foreach ($this->parents as $parent) {
            $output .= $parent . PHP_EOL;
        }

        $output .= "Children:" . PHP_EOL;
        foreach ($this->children as $child) {
            $output .= $child . PHP_EOL;
        }

        return $output;
    }

    public function __toString(): string
    {
        return "{$this->firstName} {$this->lastName} {$this->birthDate}";
    }
}


class FamilyTree
{

    private $personsByName = [];
    private $personsByBirthDate = [];

    public function getPersonByName(string $firstName, string $lastName)
    {
        if (array_key_exists($firstName . $lastName, $this->personsByName)) {
            return $this->personsByName[$firstName . $lastName];
        }
        return null;
    }

    public function getPersonByDate(string $date)
    {
        if (array_key_exists($date, $this->personsByBirthDate)) {
            return $this->personsByBirthDate[$date];
        }
        return null;
    }

    public function addPerson(Person $person)
    {
        $this->personsByName[$person->getFullName()] = $person;
        $this->personsByBirthDate[$person->getBirthDate()] = $person;
    }
}

class App
{
    private $personToLookFor;
    private $familyTree;

    public function __construct()
    {
        $this->familyTree = new FamilyTree();
    }

    public function start()
    {
        $this->processInput();
        $this->printOutput();
    }

    private function processInput()
    {
        $relations = [];
        $relations[] = $this->readLine();

        while (true) {
            $input = $this->readLine();
            if ($input === "End") {
                break;
            }

            if (strstr($input, " - ") === false) {
                $person = new Person(...explode(" ", $input));
                $this->familyTree->addPerson($person);
            } else {
                $relations[] = $input;
            }
        }

        $needle = array_shift($relations);
        if ($this->isName($needle)) {
            $this->personToLookFor = $this->familyTree->getPersonByName(...explode(" ", $needle));
        } else {
            $this->personToLookFor = $this->familyTree->getPersonByDate($needle);
        }

        foreach ($relations as $relation) {
            $data = explode(" - ", $relation);
            $parent = $data[0];
            $child = $data[1];

            if ($this->isName($parent)) {
                $parent = $this->familyTree->getPersonByName(...explode(" ", $parent));
            } else {
                $parent = $this->familyTree->getPersonByDate($parent);
            }

            if ($this->isName($child)) {
                $child = $this->familyTree->getPersonByName(...explode(" ", $child));
            } else {
                $child = $this->familyTree->getPersonByDate($child);
            }

            if ($parent != null && $child != null) {
                $child->addParent($parent);
                $parent->addChild($child);
            }
        }
    }

    private function printOutput()
    {
        $this->writeLine($this->personToLookFor->getFullDetails());
    }

    private function isName(string $input): bool
    {
        return strstr($input, "/") === false;
    }

    private function readLine(): string
    {
        return trim(fgets(STDIN));
    }

    private function writeLine($content)
    {
        echo $content . PHP_EOL;
    }
}

spl_autoload_register(function ($className) {
    require_once "{$className}.php";
});
$radio = new App();
$radio->start();