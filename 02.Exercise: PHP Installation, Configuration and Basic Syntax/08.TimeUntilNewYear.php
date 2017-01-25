<form action="" method="get">

    Time: <input type="text" name="name"><br>
    <input type="submit" name="submit">
</form>


<?php


if (isset($_GET["submit"])) {

    $time = htmlspecialchars($_GET["name"]);
    $object = new DateTime($time);
    $year = $object->format("Y");
    //echo $year . "<br>";

    echo $time . "<br>";

    $new_year = date_create("00-00-" . $year . " 00:00:00");
    var_dump($new_year);

    echo "Hours until new year :" . $new_year;


    //echo date("d-m-Y G:i:s");
}
?>
<?php
//$today = getdate();
//$newYear = mktime(0, 0, 0, 1, 1, $today['year'] + 1);
//$diff = $newYear - $today[0];
//if(date("I", $today[0]) > 0) {
//    $diff -= 3600;
//}
//echo "Hours until new year : " . round($diff / 3600) . "<br>";
//echo "Minutes until new year : " . round($diff / 60) . "<br>";
//echo "Seconds until new year : $diff"."<br>";
//echo "Days:Hours:Minutes:Seconds " . round($diff / 86400) . ":" . date("H:i:s", $today[0]);
//?>