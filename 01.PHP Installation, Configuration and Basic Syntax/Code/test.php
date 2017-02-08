<?php
$monthYear = date("n/Y/t"); //текущия месец,година и брой дни в месеца
$MonthY = explode("/", $monthYear); //слагаме всичко в масив
$daysMonth = $MonthY[2]; //брой на дните в текущия месец и с for ги обхождаме като започваме от 1-ви
for ($day = 1; $day <= $daysMonth; $day++) {
    $dayWeek = date("w", mktime(0, 0, 0, $MonthY['0'], $day, $MonthY['1'])); //намираме деня от седмицата в цифров формат от 0-6
    if ($dayWeek == '0') {
        $result = date("dS F,Y", mktime(0, 0, 0, $MonthY[0], $day, $MonthY['1']));
        echo($result);
        echo "<br>";
        // с IF проверяме кога денят е 0, т.е неделя и след това извличаме данните с date() и mktime() за съответния ден в нужния формат
    }
}
