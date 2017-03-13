<?php

//    $startDate = $_GET["dateOne"];
//    $endDate = $_GET["dateTwo"];
//    $restDays = $_GET["holidays"];
$startDate = fgets(STDIN);
$endDate = fgets(STDIN);
$holidays = fgets(STDIN);

$start = new DateTime(trim($startDate));
$end = new DateTime(trim($endDate));


$end->modify('+1 day');
$interval = $end->diff($start);

$days = $interval->days;
// create an iterateable period of date (P1D equates to 1 day)
$period = new DatePeriod($start, new DateInterval('P1D'), $end);

// best stored as array, so you can add more than one
$holidays = array('31-12-2014','24-12-2014','08-12-2014');

foreach($period as $dt) {

    $curr = $dt->format('D');

    if ($curr == 'Sat' || $curr == 'Sun'|| in_array($dt->format('Y-m-d'), $holidays)) {
        $days--;
    }
    else{
        echo $dt->format('Y-m-d')."\n";
    }
}


echo $days;

//echo "<h2>No workdays</h2>";
