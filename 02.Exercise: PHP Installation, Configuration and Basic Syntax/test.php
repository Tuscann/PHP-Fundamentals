<?php
$names = array();

// I hardcoded the values instead of getting them from the built-in PHP functions because there were
// encoding problems I could not solve - the month names and the day names somehow had different encodings -
// the month names were in windows-1251, the days of week were in UTF-8
$names["months"] = array("Януари", "Февруари", "Март", "Април", "Май", "Юни", "Юли", "Август", "Септември", "Октомври", "Ноември", "Декември");
$names["days"] = array("По", "Вт", "Ср", "Чт", "Пе", "Сб", "Не");

// Idea for the calendar: http://css-tricks.com/snippets/php/build-a-calendar-table/
function buildCalendar($month, $year)
{
    // It's not generally a good idea to use global variables but it works
    global $names;
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    // -1 is to make the day of week start from 0 (so that it is more natural to work with, using arrays)
    $dayOfWeek = getdate($firstDayOfMonth)["wday"] - 1;
    $calendar = "<table class=\"calendar\">
        <caption>" . $names["months"][$month - 1] . "</caption><thead><tr>";
    foreach ($names["days"] as $day) {
        $calendar .= "<th class=\"header\">" . $day . "</th>";
    }

    $currentDay = 1;
    $calendar .= "</tr></thead><tbody><tr>";
    if ($dayOfWeek > 0) {
        $calendar .= "<td colspan=\"" . $dayOfWeek . "\"></td>";
    }

    while ($currentDay <= $daysInMonth) {
        if ($dayOfWeek == 7) {
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        $calendar .= "<td>" . $currentDay . "</td>";
        $currentDay++;
        $dayOfWeek++;
    }

    if ($dayOfWeek != 7) {
        $calendar .= "<td colspan=\"" . (7 - $dayOfWeek) . "\"></td>";
    }

    $calendar .= "</tr></tbody></table>";
    return $calendar;
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Awesome Calendar</title>
    <style type="text/css">
        table {
            display: inline-block;
            vertical-align: top;
            margin: 10px;
        }

        caption {
            font-weight: bold;
            border-bottom: 1px solid #808080;
        }

        .year {
            font-family: Arial, sans-serif;
            font-size: 60px;
            font-weight: bold;
            text-align: center;
        }

        .header {
            border-bottom: 1px solid #808080;
        }

        .header:last-of-type {
            color: #ff0000;
        }

        .months {
            text-align: center;
        }
    </style>
</head>
<body>
<?php
echo "<div class=\"year\">" . date("Y") . "</div><div class=\"months\">";
for ($i = 1; $i <= 12; $i++) {
    echo buildCalendar($i, date("Y"));
    if ($i % 4 == 0) {
        echo "<br />";
    }
}
echo "</div>";
?>
</body>
</html>