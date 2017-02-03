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

    $namesNonFiltered = explode($delimiterInput, $namesJoined);
    $agesNonFiltered = explode($delimiterInput, $agesJoined);


    if (count($namesNonFiltered) != count($agesNonFiltered)) {
        header("Location: students.php?error=Names and ages mismatch");
        exit;
    }

    $count = count($namesNonFiltered);

     for ($i = 0; $i < $count; $i++) {
        if ($agesNonFiltered[$i] >= 18) {
            $name = $namesNonFiltered[$i];
            $age = $agesNonFiltered[$i];

            $namesAges[$name] = $age;
        }
    }

    $resultsPerPage = 5;
    $page = 1;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    $startIndex = $resultsPerPage * ($page-1);
    $endIndex = $startIndex + $resultsPerPage;
    $pages = ceil($count / $resultsPerPage); // ceil(2.2)=3
    $hasPrevious = $page > 1; // true / false
    $hasNext = $page < $pages; // true / false
    $queryString = $_SERVER['QUERY_STRING'];
    $queryString = preg_replace("/page=\d+&/", "", $queryString);

    $start = 0;
    $namesAgesPaged = [];

    foreach ($namesAges as $name => $age) {
        if ($start >= $startIndex && $start < $endIndex) {
            $namesAgesPaged[$name] = $age;
        }
        $start++;
    }
}

include 'students_frontend.php';