<?php
declare(strict_types = 1);

interface Icall
{
    public function setCall(string $number): string;
}

interface IBrowse
{
    public function setBrowsing(string $url): string;
}

class SmartPhone implements Icall, IBrowse
{

    public function setCall(string $number): string
    {

        if (!is_numeric($number)) {
            throw new Exception("Invalid number!");
        }
        return "Calling... " . $number;
    }

    public function setBrowsing(string $site): string
    {
        if (preg_match('~[0-9]~', $site)) {
            throw new Exception("Invalid URL!");
        }
        return "Browsing: " . $site . "!";
    }
}

$phone_numbers = trim(fgets(STDIN));
$phone_numbers = explode(" ", $phone_numbers);

$sites = trim(fgets(STDIN));
$sites = explode(" ", $sites);

$phone = new SmartPhone();

foreach ($phone_numbers as $phoneNumber) {
    try {
        echo $phone->setCall($phoneNumber) . PHP_EOL;
    } catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}
foreach ($sites as $website) {
    try {
        echo $phone->setBrowsing($website) . PHP_EOL;
    } catch (Exception $e) {
        echo $e->getMessage() . PHP_EOL;
    }
}
