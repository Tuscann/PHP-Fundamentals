<?php
$word = strtolower("penPineappleApplePen");
////$word  = strtolower(trim(fgets(STDIN)));
$alphabet = range('a', 'z');


for ($i = 0; $i < strlen($word); $i++) {
    for ($j = 0; $j < count($alphabet); $j++) {
        if ($word[$i] == $alphabet[$j]) {
            echo "{$word[$i]} -> {$j}"."<br>";
        }
    }
}


?>