<?php
//$nums = array_map('trim', explode(' ', fgets(STDIN)));
$nums = array(3,4,5,6);
$arrayLenght = count($nums);
$counter = 1;
$max = 0;
$end = 0;

//Проверка ако елементите на масива е 1 отпечатва и край;
if ($arrayLenght == 1) {
    echo $nums[0];
    exit;
}
// ако са повече влиза в цикъла
for ($i = 0; $i < $arrayLenght; $i++) {
// ако елемента е последен прави проверка, дали последния елемент е по-голям от предходния
// ако е по-голямо каунтъра се увеличава с едно
    if ($i == $arrayLenght - 1) {
        if ($nums[$i - 1] < $nums[$i]) {
            if ($max < $counter) {
                $max = $counter;
                echo $max;
                $end = $i;
                break;
            } else {
                break;
            }
        }
        // Ако не е последен емент се прави проверка за дали следващия елемент в масива е по-голям ако да
        // каунтъра се увеличава с едно и се прави проверка дали максималната стойност е по-малка от каунтъра ....
    } else {
        if ($nums[$i] < $nums[$i + 1]) {
            $counter++;
            if ($max < $counter) {
                $max = $counter;
                $end = $i + 1;
            }
        } else {
            $counter = 1;
        }
    }
}
// намираме на първия индекс и въртим цикъла от начало до края
$start = $end - ($max - 1);
var_dump($start);
for ($i = $start; $i <= $end; $i++) {
    echo $nums[$i] . ' ';
}