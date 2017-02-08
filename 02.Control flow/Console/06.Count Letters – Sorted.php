<?php
$input = fgets(STDIN);
//$input = 'appearance';
$myArray = array();
$uniquie = count_chars($input, 3);

for ($letter = 0; $letter < strlen($input); $letter++) {

    if (!array_key_exists($input[$letter], $myArray)) {
        $myArray[$input[$letter]] = 0;
    }

    $myArray[$input[$letter]]++;
}
arsort($resultArr);

while (list($key, $val) = each($myArray)) {
    //echo "$key -> $val" . "<br/>";
    echo "$key -> $val" . "<\n";
}