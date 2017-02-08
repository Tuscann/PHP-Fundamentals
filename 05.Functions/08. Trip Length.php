<?php
//declare(strict_types = 1);
//$array = explode(', ', fgets(STDIN));
//$array = array(0, 0, 2, 0, 4, 0);
//$array = array(5, 1, 1, 1, 5, 4);
//$array = array(-1, -2, 3.5, 0, 0, 2);
//$array = array(10, 0.10, 20, 10, 28.888, 10);
//$array = array(1, 1, 1, 2, 2, 1);

list($x1, $y1, $x2, $y2, $x3, $y3) = array_map("floatval", explode(", ", trim(fgets(STDIN))));
//list($x1, $y1, $x2, $y2, $x3, $y3) = array(1, 1, 1, 2, 2, 1);

function calculateDistance(float $x1, float $y1, float $x2, float $y2, float $x3, float $y3)
{

    $AB = sqrt(($x1 - $x2) * ($x1 - $x2) + ($y1 - $y2) * ($y1 - $y2));
    $BC = sqrt(($x2 - $x3) * ($x2 - $x3) + ($y2 - $y3) * ($y2 - $y3));
    $AC = sqrt(($x1 - $x3) * ($x1 - $x3) + ($y1 - $y3) * ($y1 - $y3));

//    var_dump($AB,$BC,$AC);

    $print = "";
    if ($AB + $BC < $BC + $AC) {
        $print = '1->2->3: ' . ($AB + $BC);
    } else if ($AB + $AC < $BC + $AC) {
        $print = '2->1->3: ' . ($AB + $AC);

    } else if ($BC + $AC < $AB + $AC) {
        $print = '1->3->2: ' . ($BC + $AC);
    }
    return $print;
}

echo calculateDistance($x1, $y1, $x2, $y2, $x3, $y3);


