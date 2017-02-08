<?php
$input = $_GET['input'];


$input = strtolower(trim($input)); // turn to lower case
define('PATTERN', '/\W+/', true); // pattern for the input (get only the words)
$words = preg_split(PATTERN, $input, -1, PREG_SPLIT_NO_EMPTY); // split by the pattern

$result = []; // for the result
for ($i = 0; $i < count($words); $i++) {
    if (!array_key_exists($words[$i], $result)) {
        // add if is the first match with value 1
        $result[$words[$i]] = 0;
    }
    $result[$words[$i]]++; // increase the value
}

echo "<table border='2'>";
foreach ($result as $word => $count) {
    echo "<tr><td>$word</td><td>$count</td></tr>";
}
echo "</table>";
