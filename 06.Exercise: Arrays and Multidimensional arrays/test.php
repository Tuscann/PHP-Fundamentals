<?php
//$input = "0 1 1 2 2 3 3";
$input = trim(fgets(STDIN));
$seq = explode(" ", $input);
$len = [];
$maxLenght = 0;
$lastIndex = -1;
$prev = array();

for ($x = 0; $x < count($seq); $x++) {
    $len[$x] = 1;
    $prev[$x] = -1;

    for ($i = 0; $i < $x; $i++)
        if (($seq[$i] < $seq[$x]) && ($len[$i] + 1 > $len[$x])) {
            $len[$x] = $len[$i] + 1;
            $prev[$x] = $i;
        }
    if ($len[$x] > $maxLenght) {
        $maxLenght = $len[$x];
        $lastIndex = $x;
    }
}

function restoreLIS($seq, $prev, $lastIndex)
{
    $longestSeq = [];
    while ($lastIndex != -1) {
        array_push($longestSeq, $seq[$lastIndex]);
        $lastIndex = $prev[$lastIndex];
    }
    $longestSeq1 = array_reverse($longestSeq);

    return $longestSeq1;
}

$a = restoreLIS($seq, $prev, $lastIndex);

foreach ($a as $key => $val) {
    echo $val." ";
}






