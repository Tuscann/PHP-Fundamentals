<?php
$arr = array_map('trim', explode(' ', fgets(STDIN)));

$longest = 0;
$startIndex = -1;

for ($i = 0; $i < count($arr); $i++) {
    $currentCount = 1;
    $current = $arr[$i];
    for ($k = $i + 1; $k < count($arr); $k++) {
        if ($arr[$k] > $current) {
            $current = $arr[$k];
            $currentCount++;
        } else {
            break;
        }
    }
    if ($currentCount > $longest) {
        $longest = $currentCount;
        $startIndex = $i;
    }
}
echo implode(' ', array_slice($arr, $startIndex, $longest));