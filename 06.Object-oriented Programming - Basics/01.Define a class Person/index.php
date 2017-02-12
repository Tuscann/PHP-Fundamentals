<form method="get">
    Name:<input type="text" name="name" required>
    Age: <input type="number" name="age" required>
    <input type="submit">
</form>

<?php
include_once "Person.php";

if (isset($_GET['name']) and isset($_GET['age'])) {

    $names = $_GET['name'];
    $age = intval($_GET['age']);

    $person = new Person8($names, $age);

    echo "Name: " . $person->getName() . "<br>";
    echo "Age: " . $person->getAge();

//    echo "<pre>";
//    var_dump($person);
//    echo "</pre>";

    echo(count(get_object_vars($person)));
}
?>


