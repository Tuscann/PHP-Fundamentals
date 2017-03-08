<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php


if (isset($_GET['input'])) {
    $input = strtolower($_GET['input']);
    $pattern = "/[^a-zA-Z]+/";

    $input = preg_split($pattern, $input, -1, PREG_SPLIT_NO_EMPTY);



    $out = [];

    foreach ($input as $item) {
        if (array_key_exists($item, $out)) {
            $out[$item]++;
        } else {
            $out[$item] = 1;
        }
    }
}

$html = "<table border='2'>";

foreach ($out as $key => $value){
    $html .= "<tr><td>$key</td><td>$value</td></tr>";
}

$html .= "</table>";



echo $html;

?>


<form>

    <input type="text" name="input">
    <input type="submit" value="Count Words">

</form>

</body>
</html>