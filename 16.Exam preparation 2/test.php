<?php
//za da ne gyrmi judge-a
date_default_timezone_set("Europe/Sofia");
$_GET = array(
    'today' => '27/08/2014',
    'invoices' =>
        array(
            0 => '11/05/2013 | Sopharma | Paracetamol | 20.54lv.',
            1 => '02/12/2011 | Actavis | Aulin | 120.54lv.',
            2 => '13/05/2009 | Sopharma | Tamiflu | 221.54lv.',
            3 => '23/01/2014 | Actavis | Paracetamol | 7.54lv.',
            4 => '11/05/2013 | Sopharma | Analgin | 20.54lv.',
        ),
);
$today = $_GET['today'];
$deliveries = $_GET['invoices'];

$bitsToday = explode('/',$today);
$currDateToday = strtotime($bitsToday[1].'/'.$bitsToday[0].'/'.$bitsToday[2]);

$dataBase = array();

for ($i = 0; $i < count($deliveries); $i++) {

    $currentDeliver =  explode("|", $deliveries[$i]);
    //we trim the intervals if any
    foreach ($currentDeliver as $key => $delivery){
        $currentDeliver[$key] = trim($delivery);
    }

    //convert date to unix timestamp
    $currDate = $currentDeliver[0];
    $bits = explode('/',$currDate);
    $currDate = strtotime($bits[1].'/'.$bits[0].'/'.$bits[2]);

    //get other parameters
    $currCompany = $currentDeliver[1];
    $currMedicine = $currentDeliver[2];
    $currValue = (double)$currentDeliver[3];
    $currValue = $currValue.'';

    //we work only with the invoices from the last five years
    if($currDate >= strtotime("-5 years",$currDateToday)) {

        if (
            !array_key_exists($currDate, $dataBase) ||
            !array_key_exists($currCompany, $dataBase[$currDate]) //&&
            //!array_key_exists($currValue, $dataBase[$currDate][$currCompany])
        ) {
            $dataBase[$currDate][$currCompany][$currValue] = array();
            $dataBase[$currDate][$currCompany][$currValue][] = $currMedicine;
        } else {
            //update medicine and values of current invoice
            foreach ($dataBase[$currDate][$currCompany] as $value => $medicine) {
                $newKey = $value + $currValue;
                $newKey = $newKey.'';
                $dataBase[$currDate][$currCompany][$newKey] = $dataBase[$currDate][$currCompany][$value];
                unset($dataBase[$currDate][$currCompany][$value]);
                $dataBase[$currDate][$currCompany][$newKey][] =  $currMedicine;
            }


        }
    }
}
//var_dump($dataBase);
ksort($dataBase);
echo "<ul>";
foreach ($dataBase as $date => $companies) {
    ksort($companies);
    echo '<li><p>'.date("d/m/Y", $date).'</p>';
    foreach ($companies as $company => $values) {
        echo '<ul><li><p>'.$company.'</p>';
        foreach ($values as $value => $medicine) {
            asort($medicine);
            echo '<ul><li><p>'.implode(",",$medicine).'-'.$value.'lv</p></li></ul>';
        }
        echo '</li></ul>';
    }
    echo '</li>';
}
echo "</ul>";