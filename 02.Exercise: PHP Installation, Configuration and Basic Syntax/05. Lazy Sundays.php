<?php
function getSaturdayss($y, $m)
{
    return new DatePeriod(
        new DateTime("first sunday of $y-$m"),
        DateInterval::createFromDateString('next Sunday'),
        new DateTime("last day of $y-$m")
    );
}

foreach (getSaturdayss(2017, 1) as $sunday) {

    echo date_format($sunday,'jS F,Y');
    echo "<br>";

}
//$month = date("F");
//$year = date("Y");
//$totalDays = date("t");
//
//for ($i = 1; $i <= $totalDays; $i++) {
//    $date = strtotime("$i $month $year"); // convert string to date
//    if (date("l", $date) == "Sunday") { // date("l", $date) --> A full textual representation of the day of the week
//        echo date("jS F, Y", $date). "<br />";
//    }
//}