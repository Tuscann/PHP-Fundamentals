<?php
$input = explode(" | ", trim(fgets(STDIN)));
$name = $input[0];
$type = $input[1];
$specialPoint = floatval($input[2]);
$level = intval($input[3]);


if ($type == "Demon") {

    $points = round(strlen($name) * 217);
    echo "\"{$name}\" | \"{$points}\" -> {$type}" . PHP_EOL;

    echo number_format($specialPoint * $level, 1, ".", '');

} else if ($type == "Archangel") {

    $reverseName = strrev($name);
    $points = round(strlen($name) * 21);

    echo "\"{$name}\" | \"{$reverseName}{$points}\" -> {$type}" . PHP_EOL;

    echo $specialPoint * $level;
}

