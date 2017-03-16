<?php
$_GET = array(
    'list' => 'CPU, RAM, VIA, ROM, RAM, RAM, CPU, CPU, CPU, VIA, ROM, ROM, CPU',
);
$input = trim($_GET['list']);
$stingg = explode(", ", $input);

$counterRAM = 0;
$counterROM = 0;
$counterCPU = 0;
$counterVIA = 0;

foreach ($stingg as $part) {
    if ($part == "RAM") {
        $counterRAM++;
    } else if ($part == "ROM") {
        $counterROM++;
    } else if ($part == "CPU") {
        $counterCPU++;
    } else if ($part == "VIA") {
        $counterVIA++;
    }
}
$priceRAM = 35;
$priceROM = 45;
$priceCPU = 85;
$priceVIA = 45;

if ($counterRAM >= 5) {
    $priceRAM /= 2;
}
if ($counterROM >= 5) {
    $priceROM /= 2;
}
if ($counterCPU >= 5) {
    $priceCPU /= 2;
}
if ($counterVIA >= 5) {
    $priceVIA /= 2;
}
$gainedMoney = $counterRAM * $priceRAM + $counterROM * $priceROM + $counterVIA * $priceVIA + $counterCPU * $priceCPU;

$AssembledComputars = min($counterRAM, $counterROM, $counterCPU, $counterVIA);

$counterRAM -= $AssembledComputars;
$counterROM -= $AssembledComputars;
$counterCPU -= $AssembledComputars;
$counterVIA -= $AssembledComputars;

$leftParts = $counterRAM + $counterROM + $counterCPU + $counterVIA;

$total = $AssembledComputars * 420 +
    $counterRAM * 35 / 2 +
    $counterROM * 45 / 2 +
    $counterVIA * 45 / 2 +
    ($counterCPU * 85 / 2) - $gainedMoney;

echo "<ul><li>{$AssembledComputars} computers assembled</li><li>{$leftParts} parts left</li></ul><p>";
if ($total > 0) {
    echo "Nakov gained {$total} leva</p>
";
} else {
    echo "Nakov lost {$total} leva</p>
";
}


