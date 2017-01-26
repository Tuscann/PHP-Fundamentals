<?php

    date_default_timezone_set("UTC");
    $today = strtotime('12-08-2014 13:07:09');

    $year = date('Y', $today);
    $newYear = strtotime("31-12-{$year} 23:59:59");
    $diff = $newYear - $today;

    echo 'Hours until new year : ' . number_format(floor($diff / (60 * 60)), 0, '.', '') . '<br>';
    echo 'Minutes until new year : ' . number_format(floor($diff / 60), 0, '.', ' ') . '<br>';
    echo 'Seconds until new year : ' . number_format($diff, 0, '.', ' ') . '<br>';

    $days = floor($diff / 60 / 60 / 24);
    $hours = floor($diff / 60 / 60) % $days;
    $minutes = floor($diff / 60) % 60;
    $seconds = $diff % 60;

    echo "Days:Hours:Minutes:Seconds {$days}:{$hours}:{$minutes}:{$seconds}";
    echo "<br>";






