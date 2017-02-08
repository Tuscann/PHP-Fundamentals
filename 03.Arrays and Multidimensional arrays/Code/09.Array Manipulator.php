<?php
$numbers = array_map('intval', explode(' ', fgets(STDIN)));
//$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$print = false;

while (true) {
    $tokens = explode(" ", trim(fgets(STDIN)));
    $command = $tokens[0];
    $arrayLength = count($numbers);

    if ($command == "print") {
        echo "[" . implode(", ", $numbers) . "]";
        break;
    } else if ($command == "add") {
            array_splice($numbers, $tokens[1], 0, $tokens[2]);
    } else if ($command == "addMany") {
        array_splice($numbers, $tokens[1], 0, array_slice($tokens, 2));
    } else if ($command == "remove") {
        array_splice($numbers, $tokens[1], 1);
    } else if ($command == "contains") {
        $res = array_search($tokens[1], $numbers);
        if ($res === false) {
            echo "-1" . "\n";
        } else {
            echo $res . "\n";
        }
    } else if ($command == "shift") {
        for ($i = 0; $i < $tokens[1]; $i++) {
            $last = array_shift($numbers);
            array_push($numbers, $last);
        }

    } else if ($command == "sumPairs") {

        $last = array();
        for ($i = 0; $i < $arrayLength; $i += 2) {
            $sum = $numbers[$i];

            if ($i + 1 < $arrayLength) {
                $sum += $numbers[$i + 1];
            }
            array_push($last, $sum);
        }

        $numbers = $last;
    }

}