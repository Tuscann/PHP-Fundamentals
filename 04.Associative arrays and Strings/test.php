<?php

$text = $numberOne = fgets(STDIN);
$text = strtolower($text);

$words = str_word_count($text, 1);

$words = array_count_values($words);

?>

<table border='2'>
    <?php foreach($words as $x => $x_value): ?>
        <tr><td><?php echo $x?></td><td><?php echo $x_value?></td></tr>
    <?php endforeach; ?>
</table>