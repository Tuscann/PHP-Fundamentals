<?php
//$string = strtolower("softuni");
$string  = strtolower(trim(fgets(STDIN)));

for ($i = 0; $i < strlen($string); $i++) {
    echo $string[$i]." -> ";
    echo intval(ord($string[$i])) - 97 . "\n";
}
?>