<!--<form action="" method="get">-->
<!--   <textarea name="data">-->
<!--      mine bobovDol gold 10, mine medenRudnik silver 22, mine chernoMore shrimps 24, gold 50-->
<!--  </textarea>-->
<!--    <input type="submit" name="submit">-->
<!---->
<!--</form>-->
<!---->
<?php
//if (isset($_GET["submit"])) {
//
//    $inputString = $_GET["data"];

$inputString = fgets(STDIN);

//echo $inputString;
//$inputString="mine bobovDol gold 10, mine medenRudnik silver 22, mine chernoMore shrimps 24, gold 50";

$string = trim($inputString);
$delimeters = explode(",", $string);


$goldCounter = 0;
$silverCounter = 0;
$diamondsCounter = 0;

foreach ($delimeters as $validStrings) {
    $validString = explode(" ", trim($validStrings));
    if (count($validString) == 4 && $validString[0] == "mine") {
        $mineName = $validString[1];
        $typeOfOre = strtolower($validString[2]);
        $quantity = intval($validString[3]);

        if ($typeOfOre == "gold") {
            $goldCounter += $quantity;
        }
        else if ($typeOfOre == "silver") {
            $silverCounter += $quantity;
        }
        else if ($typeOfOre == "diamonds") {
            $diamondsCounter += $quantity;
        }
    }
}
echo "<p>*Gold: {$goldCounter}</p>\n<p>*Silver: {$silverCounter}</p>\n<p>*Diamonds: {$diamondsCounter }</p>
";
//
//
//
//}


?>