<?php
$text = trim(fgets(STDIN));
$s = trim(fgets(STDIN));

$text = "Is comming.This is my cat! And this is my dog. We happily live in Paris – the most beautiful city in the world! Isn’t it great? Well it is :)";
$s = "is";

$delimiters = array(".", "!", "?");  // разделите за изречения
// Добавяне на допълнителен знак, след всеки край на изречението
for ($i = 0; $i < 3; $i++) {
    $new = $delimiters[$i] . "$";
    $text = str_replace($delimiters[$i], $new, $text);
}
// премахване на празни места и добавяне в масив, като за разделител се използва символа добавен по-горе
$arr = array_map('trim', explode('$', $text));
//Проверяваме дали последният символ от стринга съдържа .!?
// Проверяваме дали имаме съвпадения с регекса ни, ако има отпчетаваме.
for ($i = 0; $i < count($arr); $i++) {
    if (substr($arr[$i], -1, 1) == '!' || substr($arr[$i], -1, 1) == '.' || substr($arr[$i], -1, 1) == '?') {
        if (preg_match('/\b' .$s . '[\s|!?.,]/', $arr[$i])) {
            echo $arr[$i] ."<br>";
            //echo $arr[$i] ."\n";
        } else {
            continue;
        }
    }
}