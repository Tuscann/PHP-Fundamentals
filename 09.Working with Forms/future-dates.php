<!DOCTYPE html>
<html>
<head>
    <title>Future Dates</title>
    <meta charset="utf-8" />
</head>
<body>
<form method="GET" action="future-dates.php">
    <label for="numbersString">
        Numbers string:
        <br/>
        <input type="text" style="width:300px" name="numbersString" id="numbersString" value="Th1s 12# is _43$ just %2^ random5text!!1!"/>
    </label>
    <br/>
    <br/>
    <label for="dateString">
        Date string:
        <br/>
        <textarea rows="6" cols="40" name="dateString" id="dateString">
2014-12-22, this is today! Good luck with the exam. Yesterday was 21/12/2014. Three years ago was Friday 22-12-2011 and it was also working day, but 2011-12-24 was not!</textarea>
    </label>
    <br/>
    <br/>
    <input type="submit"/>
</form>
</body>
</html>

<?php
$numbersString = $_GET['numbersString'];
$dateString = $_GET['dateString'];

$numbersRegex = "/[^a-zA-Z0-9]+?([0-9]+)[^a-zA-Z0-9]+?/";
preg_match_all($numbersRegex, $numbersString, $numbers);

$sum = 0;

foreach ($numbers[1] as $number) {
    $sum+=$number;
}

$sum = strrev($sum);
//var_dump($sum);

$dateRegex = "/([0-9]{4}-[0-9]{2}-[0-9]{2})/";
preg_match_all($dateRegex, $dateString, $dates);

//var_dump($dates);
if (!empty($dates[1])) {
    $futureDates = [];

    foreach ($dates[1] as $date) {
        $tempDate = date_create($date, timezone_open("Europe/Sofia"));
        date_add($tempDate, date_interval_create_from_date_string("$sum days"));
        array_push($futureDates, $tempDate);
    }
    $result = "<ul>";
    foreach ($futureDates as $futureDate) {
        $result .= "<li>". date_format($futureDate, "Y-m-d") . "</li>";
    }
    $result .= "</ul>";
    echo $result;
} else {
    echo "<p>No dates</p>";
}