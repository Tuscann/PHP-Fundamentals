<?php
$varInt = 5;
$varFloat = floatval($varInt);
echo "Int to Float: $varInt <br/>";

$float = 5.672;
$varIntToFloat = intval($float);
echo "Float To Int: $varIntToFloat <br/>";

$boolIsEqual = false;
if ($varIntToFloat >= 5) {
    if ($varInt == 5) {
        $boolIsEqual = true;
    } else if ($varInt != 5) {
        $boolIsEqual = false;
    }
}
print "Is $varInt == 5 ?: " . $boolIsEqual . "<br/>";

$string = 'Software University,' .
    ' welcome to the PHP World' . '<br/>';
echo $string;

$nullTest; //now is null
$nullTest = 4;
unset($nullTest); //Again is null


//Check the type of the variables
echo gettype($varInt) . '<br/>';
echo gettype($boolIsEqual) . '<br/>';
echo gettype($boolIsEqual) . '<br/>';
echo gettype($nullTest) . '<br/>';

$array = array(2, "Soft", "Uni", true, false, 101 => 4, 2.5, "Php");
var_dump($varInt);
echo '<br/>';
var_dump($boolIsEqual);
echo '<br/>';
var_dump($float);
echo '<br/>';
print_r($array);
echo '<br/>';

//object
 $objectExample = new ArrayObject();
 $objectExample2 = new DOMStringList();
 $objectExample3 = new DateTime();
$time = new DateTime("12.12.2000 23:25");
echo $time->format('d/m/Y') . "<br/>";