<?php

$food = explode(",", trim(fgets(STDIN)));

$points = 0;
$counter = 0;

foreach ($food as $lanch) {
    $lanch = strtolower($lanch);

    if ($lanch == "cram") {
        $points += 2;
    } else if ($lanch == "lembas") {
        $points += 3;
    } else if ($lanch == "apple") {
        $points += 1;
    } else if ($lanch == "melon") {
        $points += 1;
    } else if ($lanch == "honeycake") {
        $points += 5;
    } else if ($lanch == "mushrooms") {
        $points += -10;
    } else {
        $counter -= 1;
    }

}
$totalSum = $points + $counter;
echo $totalSum . PHP_EOL;

$mood = "";
if ($totalSum < -5) {
    $mood = "Angry";
} else if ($totalSum >= -5 && $totalSum < 0) {
    $mood = "Sad";
} else if ($totalSum >= 0 && $totalSum < 15) {
    $mood = "Happy";
} else if ($totalSum > 15) {
    $mood = "PHP";
}
echo $mood;

