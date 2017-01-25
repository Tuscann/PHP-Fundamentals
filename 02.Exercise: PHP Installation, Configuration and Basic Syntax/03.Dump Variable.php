<?php
$string = "hello";
$number = 15;
$numberDouble = 1.234;
$array = array(1, 2, 3, 4);
$object = (object) [2.34];

$to_be_Checked = array($string,$number,$numberDouble,$array,$object);

foreach ($to_be_Checked as $value) {

    if (is_numeric($value)) {
        var_dump($value);
        echo"<br>";
    }
    else {
        echo gettype($value)."<br>";
    }
}




