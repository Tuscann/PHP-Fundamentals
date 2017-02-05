<form action="">
    <textarea name="input" title="text" required></textarea><br>
    <input type="submit" name="submit" placeholder="Count words">
</form>
<?php
//if (isset($_GET["input"]) && !empty(trim($_GET["input"]))) {

$text = trim($_GET["input"]);
$words = array_count_values(str_word_count(strtolower($text), 1));

$wordsCount = [];
foreach ($words as $word) {
    if (!array_key_exists($word, $wordsCount)) {
        $wordsCount[$word] = 0;
    }
    $wordsCount[$word]++;
}
if (count($wordsCount) != 0) {
    echo "<table border='2'>";
    foreach ($words as $key => $value) {
        echo "<tr><td>" . $key . "</td><td>" . $value . "</td></tr>";
    }
    echo "</table>";
}
//}
?>