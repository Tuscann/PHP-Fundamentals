<?php


class DateModifier
{
    function getDifferenceBetweenDates(string $firstDate, string $secondDate): string
    {
        $date1 = date_create(str_replace(" ", "-", $firstDate));
        $date2 = date_create(str_replace(" ", "-", $secondDate));

        return date_diff($date1, $date2)->format("%a");
    }
}

$firstDate = trim(fgets(STDIN));
$secondDate = trim(fgets(STDIN));

$date = new DateModifier();

echo $date->getDifferenceBetweenDates($firstDate, $secondDate);

