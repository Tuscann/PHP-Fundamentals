<?php
$board = explode ('|', $_GET['board']);
$start = explode(' ', $_GET['beginning']);
$startRow = $start[0] -1;
$startCol = $start[1] -1;
$moves = explode(' ', $_GET['moves']);
$money = 50;

foreach ($board as $key => $row) {
    $board[$key] = str_replace(' ', '', $row);
}

//var_dump($board);
$field = $board[0][0].$board[0][1].$board[0][2].$board[0][3].$board[1][3].$board[2][3].$board[3][3].$board[3][2].$board[3][1].$board[3][0].$board[2][0].$board[1][0];
//var_dump($field);
if ($startRow<=$startCol) {
    $PositionIndex = $startRow + $startCol;
} else {
    $PositionIndex = 12 - ($startRow + $startCol);
}
$countInn = 0;
for ($k = 0; $k < strlen($field); $k++) {
    if ($field[$k] == 'I') {
        $countInn++;
    }
}
$innOwn = array();
for ($i = 0; $i < count($moves); $i++) {
    $PositionIndex = ($PositionIndex + $moves[$i])%12;
    $money += count($innOwn) * 20;
    switch ($field[$PositionIndex]) {
        case 'P' : {
            $money-=5;
        } break;
        case 'I' : {
            if (!in_array($PositionIndex, $innOwn)) {
                if ($money >=100) {
                    $innOwn[] = $PositionIndex;
                    $money -=100;
                } else {
                    $money -=10;
                }
            }
        } break;
        case 'F' : {
            $money+=20;
        } break;
        case 'S' : {
            $i+=2;
        } break;
        case 'V' : {
            $money*=10;
        } break;
        case 'N' : {
            echo  "<p>You won! Nakov's force was with you!<p>";
            return;
        }
    }
    if ($countInn ==  count($innOwn)) {
        echo "<p>You won! You own the village now! You have $money coins!<p>";
        return;
    }
    if ($money < 0) {
        echo "<p>You lost! You ran out of money!<p>";
        return;
    }
    if ($i >= count($moves)-1) {
        echo "<p>You lost! No more moves! You have $money coins!<p>";
        return;
    }

}