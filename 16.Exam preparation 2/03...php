<?php
//$_GET = array(
//    'board' => 'P I F S | P 0 0 F | N 0 0 V | I F F I',
//    'beginning' => '2 1',
//    'moves' => '5 11 9 8 6 8 4',
//);
$table = array_map('trim', explode('|', $_GET['board']));
$beginning = array_map('trim', explode(' ', $_GET['beginning']));
$moves = array_map('trim', explode(' ', $_GET['moves']));

$buyedHouses = 0;
$coins = 50;
$countViligs = 0;

$startRow = $beginning[0] - 1;
$startCol = $beginning[1] - 1;

$griting = '';
$matrix[][] = '';

for ($i = 0; $i < count($table); $i++) {
    $matrix[$i] = explode(' ', $table[$i]);
}
for ($i = 0; $i < count($matrix); $i++) {
    for ($row = 0; $row < count($matrix[$i]); $row++) {
        if ($matrix[$i][$row] == 'I') {
            $countViligs++;
        }
        $matrix[$i][$row];
    }
}
for ($m = 0; $m < count($moves); $m++) {
    $coins += $buyedHouses * 20;
    for ($i = 0; $i < intval($moves[$m]); $i++) {
        if ($startCol == 0 && $startRow != 0) {
            $startRow = $startRow - 1;
        } else if ($startRow == 0 && $startCol != 3) {
            $startCol++;
        } else if ($startCol == 3 && $startRow != 3) {
            $startRow++;
        } else if ($startRow == 3 && $startCol != 0) {
            $startCol--;
        }
    }
    switch ($matrix[$startRow][$startCol]) {
        case "P":
            $coins -= 5;
            break;
        case "F":
            $coins += 20;
            break;
        case "V":
            $coins *= 10;
            break;
        case "S":
            $skip = 2;
            break;
        case "I":
            if ($coins >= 100) {
                $coins -= 100;
            } else {
                $coins -= 10;
            }
            break;
        case "N":
            $griting = '<p>You won! Nakov\'s force was with you!<p>';
    }
    if ($countViligs == $buyedHouses) {
        $griting = '<p>You won! You own the village now! You have ' . $coins . ' coins!<p>';
        break;
    }
    if ($coins < 0) {
        $griting = '<p>You lost! You ran out of money!<p>';
        break;
    }
}
if ($griting == '') {
    $griting = '<p>You lost! No more moves! You have ' . $coins . ' coins!<p>';
}
echo $griting;