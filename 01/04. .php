<?php
$n = 514;
$printed = false;
$regex = "/^(?:([0-9])(?!.*\\1))*$/";
if ($n <= 102) {
    echo "no";
}
else {
    for ($i=102; $i <= $n; $i++) {
        if (preg_match($regex, strval($i))) {
            echo $i."," . PHP_EOL;
            $printed = true;
        }
    }
    if (!$printed) {
        echo "no";
    }
}
?>