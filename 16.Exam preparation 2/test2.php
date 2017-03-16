<?php

$_GET = array(
    'array' => '**********
**>****v**
**********
**********
**^****<**
v*********',
);
$line = trim($_GET['array']);
$line = array_map("trim", explode(PHP_EOL, $line));

$matrix = [];
$rows = count($line);

for ($r = 0; $r < $rows; $r++) {
    for ($c = 0; $c < strlen($line[0]); $c++) {
        $matrix[$r][$c] = $line[$r][$c];
    }
}

for ($r = 0; $r < $rows; $r++) {
    for ($c = 0; $c < strlen($line[0]); $c++) {

        $currentRow;
        $currentCol;

        if ($matrix[$r][$c] == '>') {
            $currentRow = $r;
            $currentCol = $c + 1;

            while ($matrix[$r][$c] != '>' && $matrix[$r][$c] != '<'
                && $matrix[$r][$c] != '^' && $matrix[$r][$c] != 'v' && $c < strlen($line[0])) {
                $matrix[$r][$c] = ' ';
                $c++;
            }
        } else if ($matrix[$r][$c] == '<') {
            $currentRow = $r;
            $currentCol = $c - 1;
            while ($matrix[$r][$c] != '>' && $matrix[$r][$c] != '<'
                && $matrix[$r][$c] != '^' && $matrix[$r][$c] != 'v' && $c >= 0) {

                $matrix[$r][$c] = ' ';
                $c--;
            }
        }
        else if ($matrix[$r][$c] == '^') {
            $currentRow = $r - 1;
            $currentCol = $c;
            while ($matrix[$r][$c] != '>' && $matrix[$r][$c] != '<'
                && $matrix[$r][$c] != '^' && $matrix[$r][$c] != 'v' && $r >= 0) {

                $matrix[$r][$c] = ' ';
                $r--;
            }

        }
        else if ($matrix[$r][$c] == 'v') {
            $beforeChange = $r;
            $r++;
            $matrix[$r][$c] = ' ';
            while ($matrix[$r][$c] != '>' && $matrix[$r][$c] != '<'
                && $matrix[$r][$c] != '^' && $matrix[$r][$c] != 'v' && $r < $rows) {
                $matrix[$r][$c] = ' ';
                $r++;

            }
            $r = $beforeChange;
        }
    }
}

for ($r = 0; $r < $rows; $r++) {
    echo '<p>';
    for ($c = 0; $c < strlen($line[0]); $c++) {
        if ($matrix[$r][$c] == '>') {
            $matrix[$r][$c] = '&gt;';
        }
        if ($matrix[$r][$c] == '<') {
            $matrix[$r][$c] = '&lt;';
        }

        echo $matrix[$r][$c];
    }
    echo "</p>" . PHP_EOL;
}