<?php
$numbersString = $_GET['numbersString'];

$numbersRegex = "/([A-Z][A-Za-z]*)[^0-9A-Za-z+]*([+]?[0-9]+[0-9\- \.\/\)\(]*[0-9]+)/";
preg_match_all($numbersRegex, $numbersString, $numbersList);

if (!empty($numbersList[0])) {
    $result = "<ol>";
    for ($i=0; $i < sizeof($numbersList[1]); $i++) {
        $name = $numbersList[1][$i];
        $number = $numbersList[2][$i];
        $number = preg_replace("/[\- \.\/\)\(]/","",$number);
        $result .= "<li><b>$name:</b> $number</li>";
    }
    $result .= "</ol>";
    echo $result;
} else {
    echo "<p>No matches!</p>";
}
