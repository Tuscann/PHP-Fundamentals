<?php
session_start();

if (isset($_GET['filter'])) {
    $delimiter = $_GET['delimiter'];
    $names = explode($delimiter, $_GET['names']);
    $ages = explode($delimiter, $_GET['ages']);

    $_SESSION['names'] = $names;
    $_SESSION['ages'] = $ages;

    $_SESSION['pages'] = intval(ceil(count($names) / 5));
    $_SESSION['current_page'] = 1;

    $page = 1;
    $_SESSION['current_page'] = $page;
    $start = ($page - 1) * 5;
    $end = $start + 5;
    $end = min(count($_SESSION['names']), $end);
    $names = [];
    $ages = [];
    for ($i = $start; $i < $end; $i++) {
        $names[] = $_SESSION['names'][$i];
        $ages[] = $_SESSION['ages'][$i];
    }
}

if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
    $_SESSION['current_page'] = $page;
    $start = ($page - 1) * 5;
    $end = $start + 5;
    $end = min(count($_SESSION['names']), $end);
    $names = [];
    $ages = [];
    for ($i = $start; $i < $end; $i++) {
        $names[] = $_SESSION['names'][$i];
        $ages[] = $_SESSION['ages'][$i];
    }
}

include '03.students_info_frontend.php';
