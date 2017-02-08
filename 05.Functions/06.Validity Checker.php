<?php
$array = explode(", ",fgets(STDIN));
$array = array(3,0,0,4);

$x1 = intval($array[0]);
$x2 = intval($array[1]);
$y1 = intval($array[2]);
$y2 = intval($array[3]);

function check($x1, $y1, $x2, $y2)
{
    $cal = sqrt(pow(($x2 - $x1), 2) + pow(($y2 - $y1), 2));
    var_dump($cal);

    $intt = is_int($cal);

    if ($intt) {
        return $sum = "{{$x1}}, {{$y1}} to {{$x2}}, {{$y2}} is invalid\n";
    } else {
        return $sum = "{{$x1}}, {{$y1}} to {{$x2}}, {{$y2}} is valid\n";
    }

}

echo check($x1, $y1, 0, 0);
echo check($x2, $y2, 0, 0);
echo check($x1, $y1, $x2, $y2);

