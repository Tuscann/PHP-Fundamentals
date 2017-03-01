<?php


class Privates
{
    private $id;
    private $firstName;
    private $secoundName;
    private $salary;

    public function __construct($id, string $firstName, string $secoundName, float $salary)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->secoundName = $secoundName;
        $this->salary = $salary;
    }

    public function __toString()
    {

        return "Name: {$this->firstName} {$this->secoundName} Id:{$this->id} Salary: {$this->salary}";
    }
}
class Engineer{

    private $id;
    private $firstName;
    private $secoundName;
    private $salary;
    private $corps;

}




$privates = [];

while (true) {
    $input = explode(" ", trim(fgets(STDIN)));

    if (count($input) == 1 && $input == "End") {
        break;
    }
    if (count($input) == 5 && trim($input[0]) == "Private") {

        $id = trim($input[1]);
        $firstName = trim($input[2]);
        $secoundName = trim($input[3]);
        $salary = round(floatval($input[4]), 2);

        $newPrivate = new Privates($id, $firstName, $secoundName, $salary);

        $privates = [];
    }
    if (count($input) == 5 && trim($input[0]) == "Commando") {

        $id = trim($input[1]);
        $firstName = trim($input[2]);
        $secoundName = trim($input[3]);
        $salary = round(floatval($input[4]), 2);
        $corps = trim($input[5]);

        echo "Name: {$firstName} {$secoundName} Id:{$id} Salary: {$salary}" . PHP_EOL;
        echo "Corps: {$corps}" . PHP_EOL;
        echo "Missions:" . PHP_EOL;

    }
    if (trim($input[0]) == "LeutenantGeneral") {

        $id = trim($input[1]);
        $firstName = trim($input[2]);
        $secoundName = trim($input[3]);
        $salary = round(floatval($input[4]), 2);



        $privateID1 = trim($input[5]);
        $privateID2 = trim($input[6]);

        echo "Name: {$firstName} {$secoundName} Id:{$id} Salary: {$salary}" . PHP_EOL;
    }
}
echo "Privates:" . PHP_EOL;

foreach ($privates as $privatePerson) {
    echo $privatePerson . PHP_EOL;
}