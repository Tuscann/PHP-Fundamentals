<?php
class Personn
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function Greeting(): string
    {
        return $this->name . " says \"Hello\"";
    }
}

$input = trim(fgets(STDIN));
$person = new Personn($input);

$fields = count(get_object_vars($person));
$methods = count(get_class_methods($person));

if ($fields != 1 || $methods != 2) {
    throw new Exception("Too many fields or methods");
}
echo $person->Greeting();