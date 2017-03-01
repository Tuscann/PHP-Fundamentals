<?php
namespace BorderControl;
class Robot
{
    private $name;
    private $id;

    public function __construct(string $name, $id)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }
}

class Persons
{
    private $name;
    private $age;
    private $id;

    public function __construct(string $name, $age, $id)
    {
        $this->id = $id;
        $this->age = $age;
        $this->name = $name;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
$entries = [];

while (true) {
    $input = trim(fgets(STDIN));
    if ($input == "End") {
        break;
    }
    $tokens = explode(" ", $input);

    if (count($tokens) == 3) {
        $name = $tokens[0];
        $age = intval($tokens[1]);
        $id = $tokens[2];

        $entries[] = new Persons($name, $age, $id);
    }
    if (count($tokens) == 2) {
        $model = $tokens[0];
        $id = $tokens[1];

        $entries[] = new Robot($model, $id);
    }
}
$numberrr = trim(fgets(STDIN));

foreach ($entries as $oneperson) {

    if ($numberrr == substr($oneperson->getId(), -strlen($numberrr))) {
        echo $oneperson->getId() . PHP_EOL;
    }
}

