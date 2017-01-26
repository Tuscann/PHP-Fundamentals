<?php
$month = date('m');
$year = date('Y');
$days = date('t');
for ($day = 1; $day <= $days; $day++) {
    $curDate = date($day . '-' . $month . '-' . $year);
    if (date('w', strtotime($curDate)) == 0) {
        echo date('jS F, Y', strtotime($curDate)) . '<br>';
    }
}