<?php
$arr = array_filter(explode(' ', fgets(STDIN)));
$input = trim(fgets(STDIN));
while ($input != 'print') {
    $tokens = preg_split('/\s+/', $input);
    $command = $tokens[0];
    array_shift($tokens);

    switch ($command) {
        case 'add':
            add($arr, $tokens[0], $tokens[1]);
            break;
        case 'addMany':
            addMany($arr, array_shift($tokens), $tokens);
            break;
        case 'contains':
            echo contains($arr, $tokens[0]) . "\n";
            break;
        case 'remove':
            remove($arr, $tokens[0]);
            break;
        case 'shift':
            shift($arr, $tokens[0]);
            break;
        case 'sumPairs':
            sumPairs($arr);
            break;
        default:
            echo 'Wrong command!';
            break;
    }

    $input = trim(fgets(STDIN));
}

echo '[' . implode(', ', $arr) . ']';

function add(&$arr, $index, $element)
{
    if (intval($index) >= count($arr)) {
        array_push($arr, $element);
    } else {
        array_splice($arr, intval($index), 0, $element);
    }
}

function addMany(&$arr, $index, $elements)
{
    array_splice($arr, intval($index), 0, $elements);
}

function contains($arr, $element)
{
    $res = array_search($element, $arr);
    if ($res === false) {
        return -1;
    }

    return $res;
}

function remove(&$arr, $index)
{
    array_splice($arr, intval($index), 1);
}

function shift(&$arr, $rotations)
{
    $rotations = intval($rotations) % count($arr);
    for ($i = 0; $i < $rotations; $i++) {
        $element = array_shift($arr);
        array_push($arr, $element);
    }
}

function sumPairs(&$arr)
{
    $res = [];
    for ($i = 0; $i < count($arr); $i += 2) {
        $sum = $arr[$i];
        if ($i + 1 < count($arr)) {
            $sum += $arr[$i + 1];
        }

        array_push($res, $sum);
    }

    $arr = $res;
}