<?php
$input = explode(",", trim(fgets(STDIN)));

$desireThickness = $input[0];

for ($i = 1; $i < count($input); $i++) {
    $startingThikness = trim($input[$i]);
    //var_dump($startingThikness);
    $counter = 0;
    echo "Processing chunk " . $startingThikness." microns";
    echo "\n";

    while ($startingThikness / 4 >= $desireThickness) {
        $startingThikness /= 4;   // изпълняваи докато дава 20 процента от дебелината
        $counter++;
    }
    if ($counter != 0) {   // изпълни само ако повече от 0 операции
        echo 'Cut x' . $counter;
        echo "\n";
        echo 'Transporting and washing';
        echo "\n";
        if ($startingThikness == $desireThickness) {
            echo 'Finished crystal ' . $startingThikness . ' microns';
            echo "\n";
        }
        $counter = 0; // брои колко пъти се повтаря дадено действие
    }
    $startingThikness = floor($startingThikness);  // закръгля надолу до кръгло число

    while ($startingThikness * 0.8 >= $desireThickness) {
        $startingThikness *= 0.8;
        $counter++;
    }
    if ($counter != 0) {
        echo 'Lap x' . $counter;
        echo "\n";
        echo 'Transporting and washing';
        echo "\n";
        if ($startingThikness == $desireThickness) {
            echo 'Finished crystal ' . $startingThikness . ' microns';
            echo "\n";
        }
        $counter = 0;
        $startingThikness = floor($startingThikness);
    }
    while ($startingThikness - 20 >= $desireThickness) {
        $startingThikness -= 20;
        $counter++;
    }
    if ($counter != 0) {
        echo 'Grind x' . $counter;
        echo "\n";
        echo 'Transporting and washing';
        echo "\n";

        if ($startingThikness == $desireThickness) {
            echo 'Finished crystal ' . $startingThikness . ' microns';
            echo "\n";
            break;
        }
        $counter = 0;
        $startingThikness = floor($startingThikness);
    }
    while ($startingThikness - 1 >= $desireThickness) {
        $startingThikness -= 2;
        $counter++;
    }
    if ($counter != 0) {
        echo 'Etch x' . $counter;
        echo "\n";
        echo 'Transporting and washing';
        echo "\n";
        if ($startingThikness == $desireThickness) {
            echo 'Finished crystal ' . $startingThikness . ' microns';
            echo "\n";
            break;
        }
        $counter = 0;
    }
    $startingThikness = floor($startingThikness);

    if ($startingThikness + 1 == $desireThickness) {
        echo 'X-ray x1';
        echo "\n";
        echo 'Finished crystal ' . intval($startingThikness + 1) . ' microns';
    }

}