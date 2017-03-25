<?php
//<?php var_export($_GET);
$_GET = array(
    'board' => 'P I F S | P 0 0 F | N 0 0 V | I F F I',
    'beginning' => '2 1',
    'moves' => '5 11 9 8 6 8 4',
);
$startCoins = 50;

$board = $_GET['board'];
$boardClear = str_replace("| ", "", $board);
$boardClear = explode(" ", $boardClear);
//echo $boardClear.PHP_EOL ;
//echo strlen($boardClear) ;
$enteringPosition = explode(" ", trim($_GET['beginning']));
$startPosition = intval(($enteringPosition[0]) * 4) + intval($enteringPosition[1]);
//echo $start;
$moves = explode(" ", trim($_GET["moves"]));

$currentPosition = 0;
for ($i = 0; $i < $moves; $i++) {
    $currentPosition += ($startPosition + intval($moves[$i])) % 4;
    echo($startPosition + intval($moves[$i]));


}

