<?php
$n = $_GET['size'];
$text = $_GET['text'];
$index = 0;
$matrix = array();
$oldN = $n;
$x = 0;
$y = 0;

//Creating an empty bidimensional array
for ($i = 0; $i < $n; $i++) {
    $matrix[$i] = array();
}
while ($n > 0) //Creating a spiral matrix and filling it with the elements of the input string 'text'
{
    for ($i = $y; $i <= $y + $n - 1; $i++) // Go right.
    {
        $matrix[$x][$i] = $text[$index];
        $index++;
    }

    for ($j = $x + 1; $j <= $x + $n - 1; $j++) //Go down.
    {
        $matrix[$j][$y + $n - 1] = $text[$index];
        $index++;
    }

    for ($i = $y + $n - 2; $i >= $y; $i--) // Go left.
    {
        $matrix[$x + $n - 1][$i] = $text[$index];
        $index++;
    }

    for ($i = $x + $n - 2; $i >= $x + 1; $i--) // Go up.
    {
        $matrix[$i][$y] = $text[$index];
        $index++;
    }
    $x++;
    $y++;
    $n -= 2;
}

//Saving the chessboard matrix' characters in a string
$sentence = "";
for ($i = 0; $i < $oldN; $i++) {
    for ($j = $i % 2 == 0 ? 0 : 1; $j < $oldN; $j += 2) {
        $sentence .= $matrix[$i][$j];
    }
}
for ($i = 0; $i < $oldN; $i++) {
    for ($j = $i % 2 == 0 ? 1 : 0; $j < $oldN; $j += 2) {
        $sentence .= $matrix[$i][$j];
    }
}

//Removing unnecessary characters (everything that is not a small letter)
$output = "";
for ($i = 0; $i < strlen($sentence); $i++) {
    if (ord(strtolower($sentence[$i])) >= 97 && ord(strtolower($sentence[$i])) <= 122)
        $output .= strtolower($sentence[$i]);
}

//Checking if the sentence is a palindrome
$isPalindrome = true;
for ($i = 0; $i < strlen($output); $i++) {
    if ($output[$i] != $output[strlen($output) - 1 - $i]) {
        $isPalindrome = false;
    }
}
echo "<div style='background-color:" . ($isPalindrome ? '#4FE000' : '#E0000F') . "'>$sentence</div>";
?>
