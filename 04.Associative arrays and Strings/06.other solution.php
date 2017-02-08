<?php
$textInput = "This is my cat!Is this ! And this is my dog. We happily live in Paris – the most beautiful city in the world! Isn’t it great? Well it is :)    ";
$word = "is";

$textArr = [];
$sentence = "";
for ($i = 0; $i < strlen($textInput); $i++) {

    $ch = $textInput[$i];
    $sentence .= $ch;
    if ($ch == "." || $ch == "?" || $ch == "!") {
        $textArr[] = $sentence;
        $sentence = "";
    }
}
//var_dump($textArr);
foreach ($textArr as $snt) {

    $sntArr = str_word_count($snt, 1);
    $sntArr_len = count($sntArr);

    for ($ii = 0; $ii < $sntArr_len; $ii++) {

        if ($sntArr[$ii] == $word) {

            echo $snt . "\n";
            break;
        }
    }
}

?>