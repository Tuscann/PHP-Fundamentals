<?php
$firstArray = explode(" ", trim(fgets(STDIN)));
$secondArray = explode(" ", trim(fgets(STDIN)));

$firstCount = count($firstArray);
$secondCount = count($secondArray);
$count = min($firstCount, $secondCount);

$leftCount = 0;
for ($i = 0; $i < $count; $i++) {
    if ($firstArray[$i] == $secondArray[$i]) {
        $leftCount++;
    } else {
        break;
    }
}
$reverseFirstArray = array_reverse($firstArray);
$reverseSecondArray = array_reverse($secondArray);

$rightCount = 0;
for ($i = 0; $i < $count; $i++) {
    if ($reverseFirstArray[$i] == $reverseSecondArray[$i]) {
        $rightCount++;
    } else {
        break;
    }
}
echo max($leftCount, $rightCount);

?>