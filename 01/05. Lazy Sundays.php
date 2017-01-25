<?php
function getSaturdayss($y, $m)
{
    return new DatePeriod(
        new DateTime("first saturday of $y-$m"),
        DateInterval::createFromDateString('next Saturday'),
        new DateTime("last day of $y-$m")
    );
}

foreach (getSaturdayss(2016, 12) as $saturays) {

    echo date_format($saturays,'jS F,Y');
    echo "<br>";

}