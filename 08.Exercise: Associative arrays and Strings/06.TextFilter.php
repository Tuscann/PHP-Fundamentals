<?php

$text =  trim("This is my cat! And this is my dog. We happily live in Paris – the most beautiful city in the world! Isn’t it great? Well it is :)");
$word =  trim("is");

$text =  trim(fgets(STDIN));
$word =  trim(fgets(STDIN));

$res = preg_match_all("/([^.?!]*\\b" . $word . "\\b[^.?!]*[.?!])/", $text, $a);

var_dump($a);