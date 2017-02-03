<?php
$today = getdate();//текуща дата
$now = date("d-m-Y  H:i:s", mktime());
echo "Дата и час в момента : " . $now . "<br>";
$hours = $today['hours'];
$minutes = $today['minutes'];
$seconds = $today['seconds'];
$hoursEndDay = 23 - $hours;
$minutesEndDay = 59 - $minutes;
$secondsEndDay = 59 - $seconds;
$day = date("z"); //брой изминали дни от началото на година
$leap = date("L"); //дали годината е високосна, или не

if ($leap == 0) {
    $days = 364 - $day; //брой дни до края на година, ако не е високосна
} else {
    $days = 365 - $day; //брой дни до края на годината, ако е високосна
}

$hoursAll = $days * 24 + $hoursEndDay;
$minutesAll = $hoursAll * 60 + $minutesEndDay;
$secondsAll = $minutesAll * 60 + $secondsEndDay;
echo "Hours until new year : " . $hoursAll . "<br>";
echo "Minutes until new year : " . $minutesAll . "<br>";
echo "Seconds until new year : " . $secondsAll . "<br>";
echo "Days:Hours:Minutes:Seconds " . $days . ":" . $hoursEndDay . ":" . $minutesEndDay . ":" . $secondsEndDay;