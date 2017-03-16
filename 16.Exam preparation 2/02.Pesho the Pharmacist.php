<?php
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
$invoices = $_GET['invoices'];
$datePieces = explode('/', $today);
$today = strtotime($datePieces[1] . '/' . $datePieces[0] . '/' . $datePieces[2]);
$deliveries = array();

//print_r($datePieces);
//echo PHP_EOL;
//print_r($today);

foreach ($invoices as $row) {
    $tempInvoice = explode("|", trim($row));

    $tempDatePieces = explode('/', $tempInvoice[0]);
    $currDate = strtotime($tempDatePieces[1] . '/' . $tempDatePieces[0] . '/' . $tempDatePieces[2]);

    $currCompany = $tempInvoice[1];
    $currMedicine = $tempInvoice[2];
    $currPrice = (double)$tempInvoice[3];
    $currPrice .='';

    if ($currDate >= strtotime('-5 years', $today )){
        if (!array_key_exists($currDate, $deliveries) ||
            !array_key_exists($currCompany, $deliveries[$currDate])) {
            $deliveries[$currDate][$currCompany][$currPrice][] = $currMedicine;

        } else {
            $oldKey = key($deliveries[$currDate][$currCompany]);
            $newKey =($oldKey + $currPrice) . '' ;
            $deliveries[$currDate][$currCompany][$newKey] = $deliveries[$currDate][$currCompany][$oldKey];
            $deliveries[$currDate][$currCompany][$newKey][] = $currMedicine;
            unset($deliveries[$currDate][$currCompany][$oldKey]);
        }
    }
}
ksort($deliveries);
echo "<ul>";
foreach ($deliveries as $date => $companies) {
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

//echo "<ul><li><p>02/12/2011</p><ul><li><p>Actavis</p><ul><li><p>Aulin-120.54lv</p></li></ul></li></ul></li><li><p>11/05/2013</p><ul><li><p>Actavis</p><ul><li><p>Paracetamol-17.54lv</p></li></ul></li><li><p>Sopharma</p><ul><li><p>Analgin,Paracetamol-77.99lv</p></li></ul></li></ul></li><li><p>23/01/2014</p><ul><li><p>Actavis</p><ul><li><p>Paracetamol-7.54lv</p></li></ul></li></ul></li></ul>";





