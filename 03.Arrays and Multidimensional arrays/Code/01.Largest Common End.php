<?php

//$numberOne = intval(fgets(STDIN));
//$numberTwo = intval(fgets(STDIN));

$numberOne = "hi php java csharp sql html css js";
$numberTwo = "hi php java js softuni nakov java learn";


$lenght = min(strlen($numberOne), strlen($numberTwo));
$maxCount = 0;
$endIndex = 0;

for ($i = 0; $i < $lenght; $i++) {
    $count = 0;
    $element = $i;

    while ($numberOne[$i] == $numberTwo[$i]) {
        $count++;
        $element++;
        if ($element = $lenght) {
            break;
        }
    }
    if ($count > $maxCount) {
        $maxCount = $count;
        $endIndex = $element - 1;
    }
    if ($count > 0) {
        $i += $count - 1;
    }
}
reverse($numberOne);
reverse($numberTwo);

for ($i = 0; $i < $lenght; $i++) {
    $count = 0;
    $element = $i;

    while ($numberOne[$i] == $numberTwo[$i]) {
        $count++;
        $element++;
        if ($element = $lenght) {
            break;
        }
    }
    if ($count > $maxCount) {
        $maxCount = $count;
        $endIndex = $element - 1;
    }
    if ($count > 0) {
        $i += $count - 1;
    }
}

function reverse($string)
{

    for ($i = 0; $i < strlen($string) / 2; $i++) {
        $tmp = $string[$i];
        $string[$i] = $string[strlen($string) - $i - 1];
        $string[strlen($string) - $i - 1] = $tmp;
    }
}

echo $maxCount;