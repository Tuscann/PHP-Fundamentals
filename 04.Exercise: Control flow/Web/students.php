<?php
$allowedDelimiters = [
    "|",
    ",",
    "&"
];

$error = !empty($_GET['error']) ? $_GET['error'] : null;
if (!empty($_GET['filter'])) {

    $namesJoined = $_GET['names'];
    $agesJoined = $_GET['ages'];
    $delimiterInput = $_GET['delimiter'];

    if (!in_array($delimiterInput, $allowedDelimiters)) {
        header("Location: students.php?error=Delimiter not allowed");
        exit;
    }

    $names = explode($delimiterInput, $namesJoined);
    $ages = explode($delimiterInput, $agesJoined);

    if (count($names) != count($ages)) {
        header("Location: students.php?error=Names and ages mismatch");
        exit;
    }


}


include 'students_frontend.php';








