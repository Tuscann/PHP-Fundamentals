<?php
echo("11.0 / 3 = " . (11.0 / 3) . "<br/>"); // 3.666666667
printf("%.2f", 11.0/3);
echo '<br/>';
echo (10%4).'<br/>';
echo("1.5 / 0.0 = " . (1.5 / 0.0) . "<br/>"); // Error!
echo("-1.5 / 0.0 = " . (-1.5 / 0.0) . "<br/>"); // Error!
echo("0.0 / 0.0 = " . (0.0 / 0.0) . "<br/>"); // Error!
echo("true / 2 = " . (true / 2) . "<br/>");
echo('"1" / 2 = ' . ("1" / 2) . "<br/>");
echo('"as" / 2 = ' . ("as" / 2) . "<br/>");
echo("5 / 0 = " . (5 / 0) . "<br/>"); //Error!
echo('0 == 0.0 --> ' . (0 == 0.0) . "<br/>");
echo('1 == "1" --> ' . (1 == "1") . "<br/>");
echo('1 === "1" --> ' . (1 === "1") . "<br/>");
echo('0 == "" --> ' . (0 == "") . "<br/>");
echo('0 === "" --> ' . (0 === "") . "<br/>");
echo('null == "" --> ' . (null == "") . "<br/>");
echo('"Php" | true = ' . ("Php" | true) . "<br/>");
echo('"Php" ^ true = ' . ("Php" ^ true) . "<br/>");


// Other operators
$first = "First";
$second = "Second";
echo($first . $second). "<br/>"; // FirstSecond

$output = "The number is : ";
$number = 5;
echo($output + $number). "<br/>";
// The number is : 5;

$a = 6;
$b = 4;
echo(($a > $b ? "a > b" : "b >= a"). "<br/>"); // a>b
echo(($a + $b) / 2). "<br/>"; // 5
echo(gettype($a)). "<br/>"; // number
echo(gettype([])). "<br/>"; // object