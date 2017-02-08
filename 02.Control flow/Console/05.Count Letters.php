<?php
$input="apple";
//$input = fgets(STDIN);
$myArray = array();
$uniquie = count_chars($input, 3);

for ($letter = 0; $letter <= strlen($uniquie); $letter++) {

    if (!array_key_exists($input[$letter], $myArray)) {
        $myArray[$input[$letter]] = 0;
    }
    $myArray[$input[$letter]]++;
}
while (list($key, $val) = each($myArray)) {
    echo "$key -> $val" . "\n";
}
