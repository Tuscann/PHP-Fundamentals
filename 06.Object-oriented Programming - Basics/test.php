<?php
$count = intval(trim(fgets(STDIN)));

$ivan = [];
for ($i = 0; $i < $count; $i++) {
    $numberOne = explode(' ', fgets(STDIN));

    array_push($ivan, min($numberOne));
}
foreach ($ivan as $key) {
    echo $key . " ";
}

?>