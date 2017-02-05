<?php
$text = "<p>Come and visit <a href=\"http://softuni.bg\">the Software University</a> to master the art of programming. You can always check our <a href=\"www.softuni.bg/forum\">forum</a> if you have any questions.</p>";
$text = trim(fgets(STDIN));

$text = str_replace("<a href=\"", "[URL=", $text);
$text = str_replace("\">", "]", $text);
$text = str_replace("</a>", "[/URL]", $text);
echo $text;