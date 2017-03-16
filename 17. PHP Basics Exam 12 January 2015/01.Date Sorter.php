<?php
//$_GET = array(
//    'list' => '21-12-2014
//2015-01-30
//12/22/2014',
//    'currDate' => '12-01-2015',
//);
$datesInput = explode("\n", $_GET['list']);
$currenetDate = date_create($_GET{'currDate'});


/**
 * @var DateTime[]$dates
 */
$dates = [];

foreach ($datesInput as $date) {
    if (strtotime($date) !== false) {
        $dates[] = date_create($date);
    }
}
sort($dates);

echo "<ul>";
foreach ($dates as $date) {
    echo "<li>";
    if ($date < $currenetDate) {
        echo "<em>" . $date->format('d/m/Y') . "</em>";
    } else {
        echo $date->format('d/m/Y');
    }
    echo "</li>";
}
echo "</ul>";



