<?php
namespace BirthdayCelebrations;
//class Robot
//{
//    private $name;
//    private $id;
//
//    public function __construct(string $name, $id)
//    {
//        $this->id = $id;
//        $this->name = $name;
//    }
//
//    public function getId(): string
//    {
//        return $this->id;
//    }
//}

class Persons
{
    private $name;
    private $age;
    private $id;
    private $birthDay;

    public function __construct(string $name, $age, $id, $birthDay)
    {
        $this->id = $id;
        $this->age = $age;
        $this->name = $name;
        $this->birthDay = $birthDay;
    }

    public function getBirthDay(): string
    {
        return $this->birthDay;
    }
}


class Pet
{
    private $name;
    private $birthDay;


    public function __construct(string $name, $birthDay)
    {
        $this->name = $name;
        $this->birthDay = $birthDay;
    }

    public function getBirthDay(): string
    {
        return $this->birthDay;
    }

}

$entries = [];

while (true) {
    $input = trim(fgets(STDIN));
    if ($input == "End") {
        break;
    }
    $tokens = explode(" ", $input);

    if (count($tokens) == 5) {
        $name = $tokens[1];
        $age = intval($tokens[2]);
        $id = $tokens[3];
        $birthDay = $tokens[4];

        $entries[] = new Persons($name, $age, $id, $birthDay);
    } else if (count($tokens) == 3 && $tokens[0] == "Pet") {
        $name = $tokens[1];
        $petBirthday = $tokens[2];

        $entries[] = new Pet($name, $petBirthday);
    } else {
//        $model = $tokens[1];
//        $id = $tokens[2];
//
//        $entries[] = new Robot($model, $id);
    }
}
$numberrr = trim(fgets(STDIN));

$anchor = false;
foreach ($entries as $oneperson) {

    if ($numberrr == substr($oneperson->getBirthDay(), -strlen($numberrr))) {
        echo $oneperson->getBirthDay() . PHP_EOL;
        $anchor = true;
    }
}

if ($anchor == false) {
    echo "<no output>";
}

