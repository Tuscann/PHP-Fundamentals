<form action="" method="Get">
    <input type="text" name="string" required>
    <input type="radio" name="option" value="palindrome" required>Check Palindome
    <input type="radio" name="option" value="reverse" required>Reverse String
    <input type="radio" name="option" value="split" required>Split
    <input type="radio" name="option" value="hash" required>Hash String
    <input type="radio" name="option" value="shuffle" required>Shuffle String
    <input type="submit" value="Submit">
</form>

<?php
if (isset($_GET['string']) && !empty(trim($_GET['string']))) {

    $selectOption = $_GET['option'];
    $inputString = $_GET['string'];

    if ($selectOption == "palindrome") {
        if ($inputString == strrev($inputString)) {
            echo $inputString . " is palindrome";
        } else {
            echo $inputString . " is not palindrome";
        }
    } else if ($selectOption == "reverse") {
        echo strrev($inputString);

    } else if ($selectOption == "split") {
        echo $string = preg_replace('/[^A-Za-z0-9 \?!]/', '', $inputString);

    } else if ($selectOption == "hash") {
        echo hash("md5", $inputString);

    } else if ($selectOption == "shuffle") {
        echo str_shuffle($inputString);
    }

}
?>