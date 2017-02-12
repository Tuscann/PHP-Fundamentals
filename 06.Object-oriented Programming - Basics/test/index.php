<?php
require_once "Person.php";

use Hello\Person;

$name = trim(fgets(STDIN));
$person = new Person($name);
$fields = count(get_object_vars($person));
$methods = count(get_class_methods($person));
if ($fields != 1 || $methods != 2) {
    throw new Exception("Too many fields or methods");
}

echo $person->sayHello();