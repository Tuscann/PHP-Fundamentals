<?php

$word = 'apple';
$lettersArr = str_split($word);
$resultArr = [];

foreach ($lettersArr as $key => $letter) {
    if (!array_key_exists($letter, $resultArr)) {
        $resultArr[$letter] = 0;
    }
    $resultArr[$letter]++;
}

foreach ($resultArr as $k => $v) {
    echo $k . ' -> ' . $v . "<br/>";
}
