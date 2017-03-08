<?php
declare(strict_types = 1);

namespace az;

interface IEngineer
{
    public function getRepairs();
}

interface Ipriva
{
    public function getSelary();
}

interface Isoldier
{
    public function getId();

    public function getFirstName();

    public function getLastName();
}

interface Ispy
{
    public function getCodeNumber();
}

class Soldier implements Isoldier
{
    private $firstName;
    private $lastName;
    private $id;

    public function __construct(string $firstName, string $lastName, $id)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->id = $id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getId()
    {
        return $this->id;
    }

    public function __toString()
    {
        return 'Name: ' . $this->getFirstName() . ' ' . $this->getLastName() . ' Id: ' . $this->getId();
    }
}

class Spy extends Soldier implements Ispy
{
    private $codeNumber;

    public function __construct($firstName, $lastName, $id, $codeNumber)
    {
        parent::__construct($firstName, $lastName, $id);
        $this->codeNumber = $codeNumber;
    }

    public function getCodeNumber()
    {
        return $this->codeNumber;
    }

    public function __toString()
    {
        return parent::__toString() . PHP_EOL . 'Code Number: ' . $this->getCodeNumber() . PHP_EOL;
    }
}

class Privates extends Soldier
{
    private $salary;

    public function __construct(string $firstName, string $lastName, $id, float $salary)
    {
        parent::__construct($firstName, $lastName, $id);
        $this->salary = $salary;
    }

    public function getSalary()
    {
        return $this->salary;
    }

    public function __toString()
    {
        return parent::__toString() . ' Salary: ' . number_format($this->getSalary(), 2, '.', '') . PHP_EOL;
    }
}

class SpecialisedSoldier extends Privates
{
    private $corps;

    public function __construct(string $firstName, string $lastName, $id, float $salary, string $corps)
    {
        parent::__construct($firstName, $lastName, $id, $salary);
        $this->corps = $corps;
    }

    public function getCorps()
    {
        return $this->corps;
    }

    public function __toString()
    {
        return parent::__toString() . 'Corps: ' . $this->getCorps() . PHP_EOL;
    }
}

class LeutenantGeneral extends Privates
{
    private $privateSoldier = [];

    public function __construct($firstName, $lastName, $id, $salary, $priv)
    {
        parent::__construct($firstName, $lastName, $id, $salary);
        $this->setPrivateSoldier($priv);
    }

    private function setPrivateSoldier($priv)
    {
        foreach ($priv as $soldier) {
            $this->privateSoldier[] = $soldier;
        }
    }

    private function getPrivateSolider()
    {
        $arr = array_reverse($this->privateSoldier);
        $partString = null;
        foreach ($arr as $soldier) {
            $partString .= ' ' . $soldier;
        }
        return $partString;
    }

    public function __toString()
    {
        return parent::__toString() . 'Privates:' . PHP_EOL . $this->getPrivateSolider();
    }
}

class Engineer extends SpecialisedSoldier implements IEngineer
{
    private $partsArr = [];

    public function __construct($firstName, $lastName, $id, float $salary, string $corps, array $parts)
    {
        parent::__construct($firstName, $lastName, $id, $salary, $corps);
        $this->setParts($parts);
    }

    private function setParts(array $parts)
    {
        $count = count($parts);
//        if ($count == 0) {
//            throw new \Exception('Невалиден брой части');
//        }

        for ($i = 0; $i < $count; $i += 2) {
            $this->partsArr[$parts[$i]] = $parts[$i + 1];
        }
    }

    public function getRepairs()
    {
        $partString = null;
        foreach ($this->partsArr as $key => $value) {
            $partString .= '  Part Name: ' . $key . ' Hours Worked: ' . $value . PHP_EOL;
        }
        return $partString;
    }

    public function __toString()
    {
        return parent::__toString() . 'Repairs:' . PHP_EOL . $this->getRepairs();
    }
}

class Commando extends SpecialisedSoldier
{
    private $missionArr = [];

    public function __construct(string $firstName, string $lastName, $id, float $salary, string $corps, array $mission)
    {
        parent::__construct($firstName, $lastName, $id, $salary, $corps);
        $this->setMission($mission);
    }

    private function setMission($mission)
    {
        $count = count($mission);
        if ($count == 0) {
            return '';
        }

        for ($i = 0; $i < $count; $i += 2) {
            if ($mission[$i + 1] == 'inProgress' || $mission[$i + 1] == 'finished') {
                $this->missionArr[$mission[$i]] = $mission[$i + 1];
            } else {
                throw new \Exception("Invalid mission state supplied");
            }
        }
    }

    public function getMission()
    {
        $partString = null;
        foreach ($this->missionArr as $key => $value) {
            $partString .= '  Code Name: ' . $key . ' State: ' . $value . PHP_EOL;
        }
        return $partString;
    }

    public function __toString()
    {
        return parent::__toString() . 'Missions:' . PHP_EOL . $this->getMission();
    }
}

$output = [];
$privates = [];
while (true) {
    $input = array_map('trim', explode(' ', fgets(STDIN)));

    try {
        if ($input[0] == 'End') {
            break;
        }
        $id = $input[1];
        $firstName = $input[2];
        $lastName = $input[3];
        $salary = floatval($input[4]);

        if ($input[0] == 'Private') {

            $output[] = new Privates($firstName, $lastName, $id, $salary);
            $privates[] = new Privates($firstName, $lastName, $id, $salary);
        } else if ($input[0] == 'Spy') {
            $codeNumber = $input[4];

            $output[] = new Spy ($firstName, $lastName, $id, $codeNumber);
        } else if (($input[0] == 'Engineer' || $input[0] == 'Commando') && ($input[5] == 'Marines' || $input[5] == 'Airforces')) {
            $parts = [];
            $corps = $input[5];

            for ($i = 6; $i < count($input); $i++) {
                $parts[] = $input[$i];
            }

            if ($input[0] == 'Engineer') {

                $output[] = new Engineer($firstName, $lastName, $id, $salary, $corps, $parts);
            } else if ($input[0] == 'Commando') {

                $output[] = new Commando($firstName, $lastName, $id, $salary, $corps, $parts);
            }
        } else if ($input[0] == 'LeutenantGeneral') {

            $output[] = new LeutenantGeneral ($firstName, $lastName, $id, $salary, $privates);
        }
    } catch (\Exception $e) {
        echo ($e->getMessage()) . PHP_EOL;
    }

}
foreach ($output as $soldier) {
    echo $soldier;
}