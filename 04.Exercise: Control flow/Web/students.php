<?php
$allowedDelimiters = [
    "|",
    ",",
    "&"
];

$error = !empty($_GET['error']) ? $_GET['error'] : null;
$namesAges = [];
if (!empty($_GET['filter'])) {

    $namesJoined = $_GET['names'];
    $agesJoined = $_GET['ages'];
    $delimiterInput = $_GET['delimiter'];

    if (!in_array($delimiterInput, $allowedDelimiters)) {
        header("Location: students.php?error=Delimiter not allowed");
        exit;
    }

    $namesNotFiltered = explode($delimiterInput, $namesJoined);
    $agesNotFiltered = explode($delimiterInput, $agesJoined);

    if (count($namesNotFiltered) != count($agesNotFiltered)) {
        header("Location: students.php?error=Names and ages mismatch");
        exit;
    }

    $checkedYears = 18;
    $count = count($namesNotFiltered);

    for ($i = 0; $i < $count; $i++) {
        if ($agesNotFiltered[$i] >= $checkedYears) {
            $name = $namesNotFiltered[$i];
            $age = $agesNotFiltered[$i];

            $namesAges[$name] = $age;
        }
    }

    $resultsPerPage = 5;
    $page = 1;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    $startIndex = $resultsPerPage * ($page - 1);
    $endIndex = $startIndex + $resultsPerPage;
    $pages = ceil($count / $resultsPerPage); //ceil(2.2)=3
    $hasPrevious = $page > 1;  // true/false
    $hasNext = $page < $pages; // true/false
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString=preg_replace("/page=\d+&/","",$queryString);

    $start = 0;
    $nameAgesPaged = [];
    foreach ($namesAges as $name => $age) {
        if ($start >= $startIndex && $start < $endIndex) {
            $nameAgesPaged[$name]=$age;
        }
        $start++;
    }

}


include 'students_frontend.php';








