<?php

namespace Google;

class Person
{
    private $personName;
    private $pokemon = [];
    private $parents = [];
    private $children = [];
    private $company = null;
    private $car = null;

    public function __construct(string $personName)
    {
        $this->personName = $personName;
    }

    function setPerson(Company $company)
    {
        $this->company = $company;
    }

    public function setCar(Car $car)
    {
        $this->car = $car;
    }

    public function setCompany(Company $company)
    {
        $this->company = $company;
    }

    public function setChildren(Relative $children)
    {
        $this->children[] = $children;
    }

    public function setParents(Relative $parents)
    {
        $this->parents[] = $parents;
    }


    public function setPokemon(Pokemon $pokemon)
    {
        $this->pokemon[] = $pokemon;
    }

    public function __toString()
    {
        return $this->personName
            . PHP_EOL . 'Company:' . ($this->company ? PHP_EOL . $this->company : '')
            . PHP_EOL . 'Car:' . ($this->car ? PHP_EOL . $this->car : '')
            . PHP_EOL . 'Pokemon:' . PHP_EOL . implode(PHP_EOL, $this->pokemon)
            . PHP_EOL . 'Parents:' . (count($this->parents) ? PHP_EOL . implode(PHP_EOL, $this->parents) : '')
            . PHP_EOL . 'Children:' .(count($this->children) ? PHP_EOL . implode(PHP_EOL, $this->children): '');
    }
}

class Company
{
    private $companyName;
    private $department;
    private $salary;

    public function __construct(string $companyName, string $department, float $salary)
    {
        $this->companyName = $companyName;
        $this->department = $department;
        $this->salary = $salary;
    }

    public function __toString()
    {
        return $this->companyName . ' ' . $this->department . ' ' . number_format($this->salary, 2);
    }
}

class Pokemon
{
    private $pokemonName;
    private $pokemonType;

    public function __construct(string $pokemonName, string $pokemonType)
    {
        $this->pokemonName = $pokemonName;
        $this->pokemonType = $pokemonType;
    }

    public function __toString()
    {
        return $this->pokemonName . ' ' . $this->pokemonType;
    }
}

class Relative
{
    private $parentName;
    private $parentBirthday;

    public function __construct(string $parentName, string $parentBirthday)
    {
        $this->parentName = $parentName;
        $this->parentBirthday = $parentBirthday;
    }

    public function __toString()
    {
        return $this->parentName . ' ' . $this->parentBirthday;
    }
}

class Car
{
    private $carModel;
    private $carSpeed;

    public function __construct(string $carModel, float $carSpeed)
    {
        $this->carModel = $carModel;
        $this->carSpeed = $carSpeed;
    }

    public function __toString()
    {
        return $this->carModel . ' ' . $this->carSpeed;
    }
}

$people = [];
while (true) {
    $input = trim(fgets(STDIN));
    if (trim($input) == "End") {
        break;
    }
    $input = explode(" ", $input);
    $name = $input[0];

    $person = new Person($name);

    if ($input[1] == "company") {
        $companyName = $input[2];
        $department = $input[3];
        $salary = floatval($input[4]);

        $company = new Company($companyName, $department, $salary);

        if (!array_key_exists($name, $people)) {
            $person->setCompany($company);
            $people[$name] = $person;
        } else {
            $people[$name]->setCompany($company);
        }

    } else if ($input[1] == "car") {
        $carModel = $input[2];
        $carSpeed = floatval($input[3]);

        $car = new Car($carModel, $carSpeed);

        if (!array_key_exists($name, $people)) {
            $person->setCar($car);
            $people[$name] = $person;
        } else {
            $people[$name]->setCar($car);
        }

    } else if ($input[1] == "pokemon") {
        $pokemonName = $input[2];
        $pokemonType = $input[3];

        $pokemon = new Pokemon($pokemonName, $pokemonType);

        if (!array_key_exists($name, $people)) {
            $person->setPokemon($pokemon);
            $people[$name] = $person;
        } else {
            $people[$name]->setPokemon($pokemon);
        }


    } else if ($input[1] == "parents") {

        $parentName = $input[2];
        $parentBirthday = $input[3];

        $parent = new Relative($parentName, $parentBirthday);

        if (!array_key_exists($name, $people)) {

            $person->setParents($parent);
            $people[$name] = $person;
        } else {
            $people[$name]->setParents($parent);
        }


    } else if ($input[1] == "children") {

        $childName = $input[2];
        $childBirthday = $input[3];

        $child = new Relative($childName, $childBirthday);

        if (!array_key_exists($name, $people)) {
            $person->setChildren($child);
            $people[$name] = $person;
        } else {
            $people[$name]->setChildren($child);
        }
    }
}

$name = trim(fgets(STDIN));
echo $people[$name];