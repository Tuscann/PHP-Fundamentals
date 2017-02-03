<?php
//$input = "1 2 3 4 5";
$input = trim(fgets(STDIN));
$numbers = explode(" ", $input);
$print = false;

while (true) {
    $line = trim(fgets(STDIN));
    $comand = explode(" ", $line);

    $realCommand = $comand[0];
    $index = $comand[1];
    $arrayLenght = count($numbers);

    if ($realCommand == "print") {
        echo "[" . implode(", ", $numbers) . "]";
        break;
    } else if ($realCommand == "add") {
        array_splice($numbers, $index, 0, intval($comand[2]));
    } else if ($realCommand == "addMany") {
        array_splice($numbers, $index, $arrayLenght - 2, array_slice($comand, 2));
    } else if ($realCommand == "remove") {
        array_splice($numbers, $index, 1);
    } else if ($realCommand == "contains") {
        $res = array_search($index, $numbers);
        if ($res === false) {
            echo "-1" . "\n";
        } else {
            echo $res . "\n";
        }
    } else if ($realCommand == "shift") {
        for ($i = 0; $i < $comand[1]; $i++) {
            $last = array_shift($numbers);
            array_push($numbers, $last);
        }

    } else if ($realCommand == "sumPairs") {

        $last = array();
        for ($i = 0; $i < $arrayLenght; $i += 2) {
            $sum = $numbers[$i];

            if ($i + 1 < $arrayLenght) {
                $sum += $numbers[$i + 1];
            }
            array_push($last, $sum);
        }

        $numbers = $last;
    }

}