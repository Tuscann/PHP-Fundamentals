<?php
//<?php var_export($_GET);
$_GET=array (
    'numbersString' => 'Angel$(*^#029661234!@#Pesho ,.\' +3592/9653241;\':{},.Ivan 0888 123 456 John-=_555.123.4567	Stoian!@#$#@	Gosho )=_*	Steven #$(*&+1-(800)-555-2468',
);

$numbersString = $_GET['numbersString'];

$pattern = "/(\b[A-Z][A-Za-z]*)[^0-9A-Za-z\+]*?(\+?[0-9]+[0-9\- \.\/\)\(]*[0-9]+)/";
preg_match_all($pattern, $numbersString, $matches);

if (empty($matches[0])) {
    echo "<p>No matches!</p>";
} else {
    echo "<ol>";
    for ($i = 0; $i < count($matches[1]); $i++) {
        $name = $matches[1][$i];
        $number = $matches[2][$i];
        $number = preg_replace("/[^+0-9]*/", "", $number);
        echo "<li><b>{$name}:</b> {$number}</li>";
    }
    echo "</ol>";
}


