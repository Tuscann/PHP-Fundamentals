<?php
$nums = array_map('trim', explode(' ', fgets(STDIN)));

$count = count($nums);
$counter = 0;
$max = 0;
$num = 0;

for ($i = 0; $i < $count; $i++) {
    for ($j = 0; $j < $count; $j++) {
        if ($nums[$i] == $nums[$j]) {
            $counter++;
            if ($max < $counter) {
                $max = $counter;
                $num = $nums[$j];
            }
        }
        if ($j == $count - 1) {
            $counter = 0;
        }
    }
}
echo $num;