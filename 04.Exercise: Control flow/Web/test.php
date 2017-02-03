<form action="" method="post">
    <fieldset>
        <legend>String operations</legend>
        <label for="str"></label>
        <input type="text" name="str" id="str" required>
        <input type="radio" name="option" value="palindrome" title="Check Palindrome" required> Check Palindrome
        <input type="radio" name="option" value="reverse" title="Reverse string"> Reverse string
        <input type="radio" name="option" value="split" title="Split"> Split
        <input type="radio" name="option" value="hash" title="Hash string"> Hash string
        <input type="radio" name="option" value="shuffle" title="Shuffle string"> Shuffle string
        <input type="submit">
    </fieldset>
</form>
<?php
if (isset($_POST['str'], $_POST['option']) && !empty(trim($_POST['str'])) && !empty(trim($_POST['option']))) {
    $options = [
        'palindrome' => 'isPalindrome',
        'reverse' => 'reverse',
        'split' => 'split',
        'hash' => 'getHash',
        'shuffle' => 'shuffleString'
    ];

    $str = trim($_POST['str']);
    $option = trim($_POST['option']);
    $a = 'isPalindrome';
    if (array_key_exists($option, $options)) {
        echo call_user_func($options[$option], $str);
    }
}

function isPalindrome($str)
{
    if (strrev($str) === $str)
        return "{$str} is a palindrome!";

    return "{$str} is not a palindrome!";
}

function reverse($str)
{
    return strrev($str);
}

function split($str)
{
    return implode(' ', str_split($str));
}

function getHash($str)
{
    return crypt($str);
}

function shuffleString($str)
{
    $chars = str_split($str);
    shuffle($chars);

    return implode('', $chars);
}