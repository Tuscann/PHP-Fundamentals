<?php
$currentDay = getdate();
$now = $currentDay[0];
$firstDayOfNewYear = mktime(0, 0, 0, 1, 1, date("Y") + 1);
$leftSeconds = $firstDayOfNewYear - $now;

$lastSundayOfMarch = strtotime("last Sunday of March");
$startSummerTime = mktime(3, 0, 0, 3, date('d', $lastSundayOfMarch), date("Y"));
$lastSundayOfOctober = strtotime("last Sunday of March");
$endSummerTime = mktime(3, 0, 0, 10, date('d', $lastSundayOfOctober), date("Y"));

if ($startSummerTime <= $now && $now <= $endSummerTime) {
    $leftSeconds -= 3600; // remove 1 hour
}

$leftMinutes = (int)($leftSeconds / 60);
$leftHours = (int)($leftSeconds / 3600);

$day = (int)($leftSeconds / (3600 * 24));
$hours = (int)(($leftSeconds % (3600 * 24)) / 3600);
$minutes = (int)(($leftSeconds % 3600) / 60);
$seconds = (int)(($leftSeconds % 3600) % 60);

echo "Hours until new year : $leftHours <br / >";
echo "Minutes until new year : $leftMinutes <br / >";
echo "Seconds until new year : $leftSeconds <br / >";
echo "Days:Hours:Minutes:Seconds $day:$hours:$minutes:$seconds";

// check answer here : http://www.timeanddate.com/counters/newyear.html