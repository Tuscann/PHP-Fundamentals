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

    echo date_format($sunday, 'jS F,Y') . "<br>";

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



//// $currentDate = date("jS F, Y"); // 25th January, 2017
//// $days = date("t"); // days in current month --> 31days
//
//$sundaysInCurrentMonth = array();
//$type = CAL_GREGORIAN;
//$month = date('n'); // Number of current Month --> 1
//$year = date('Y'); // Current year --> 2017
//$day_count = cal_days_in_month($type, $month, $year); // Get the amount of days --> 31days
//
////loop all days
//for ($i = 1; $i <= $day_count; $i++) {
//
//    $date = $year.'/'.$month.'/'.$i; //format date
//    $get_name = date('l', strtotime($date)); //get week day --> Sunday Monday Tuesday Wednesday etc.
//    $day_name = substr($get_name, 0, 3); // Trim day name to 3 chars --> Sunday = Sun etc.
//
//    //Add sundays in array
//    if($day_name == 'Sun'){
//        $sundaysInCurrentMonth[] = $i;
//        $printDate = new DateTime("$year-$month-$i");
//        echo $printDate->format('jS F, Y');
//        echo "</br>";
//    }
//
//}
//// print_r($sundaysInCurrentMonth);