<?php

interface Icall
{
    public function setPhoneNumbers(array $phone_numbers);
}

interface IBrowse
{
    public function setSites(array $sites);
}

class Smartphone implements Icall, IBrowse
{
    private $phone_numbers;
    private $sites;

    function __construct(array $phone_numbers, array $sites)
    {
        $this->setPhoneNumbers($phone_numbers);
        $this->setSites($sites);
    }

    //Setters
    public function setPhoneNumbers(array $phone_numbers)
    {
        foreach ($phone_numbers as $phone_number) {
            $this->phone_numbers[] = "Calling... " . $phone_number . PHP_EOL;
        }
    }
    public function setSites(array $sites)
    {
        foreach ($sites as $site) {
            if (1 === preg_match('~[0-9]~', $site)) {
                $this->sites[] = "Ivalid URL!" . PHP_EOL;
            } else {
                $this->sites[] = "Browsing: " . $site . PHP_EOL;
            }
        }
    }
    //Getters

    function __toString(): string
    {
        return implode('', $this->phone_numbers) . implode('', $this->sites);
    }
}
$phone_numbers = trim(fgets(STDIN));
$phone_numbers = explode(" ", $phone_numbers);

$sites = explode(" ", trim(fgets(STDIN)));

$smartPhone = new Smartphone($phone_numbers, $sites);

echo $smartPhone;
