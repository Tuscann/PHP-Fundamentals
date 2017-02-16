<?php

class Car
{
    const START_KM = 0;

    private static $cars = [];

    private $model;
    private $fuelAmount;
    private $fuelCostPerKm;
    private $traveledKm;

    function __construct($model, $fuelAmount, $fuelCostPerKm)
    {
        $this->model = $model;
        $this->fuelAmount = $fuelAmount;
        $this->fuelCostPerKm = $fuelCostPerKm;
        $this->traveledKm = self::START_KM;

        self::$cars[$this->model] = $this;
    }

    public function getTraveledKm()
    {
        return $this->traveledKm;
    }

    public function setAmountFuel($fuel)
    {
        $this->fuelAmount = $fuel;
    }

    public function setTraveledKm($km)
    {
        $this->traveledKm = $km;
    }

    public function __toString()
    {
        return $this->model . " " . number_format($this->fuelAmount, 2) . " " . $this->traveledKm;
    }

    public static function getCars()
    {
        return self::$cars;
    }

    public static function driveCar($model, $distance)
    {
        $currentCar = self::$cars[$model];

        $fuelCost = $distance * $currentCar->fuelCostPerKm;
        $fuel = $currentCar->fuelAmount - $fuelCost;

        if ($fuel >= 0) {
            $currentCar->setAmountFuel($fuel);
            $currentCar->setTraveledKm($currentCar->getTraveledKm() + $distance);
            return true;
        } else {
            //Not enough fuel
            return false;
        }

    }

}

$counter = intval(trim(fgets(STDIN)));

for($i = 0; $i < $counter; $i++) {

    $input = explode(" ", trim(fgets(STDIN)));
    $model = $input[0];
    $amountKm = doubleval($input[1]);
    $fuelCost = doubleval($input[2]);

    $car = new Car($model, $amountKm, $fuelCost);
}

while (true) {
    $input = explode(" ", trim(fgets(STDIN)));

    if ($input[0] == "End") {
        break;
    }

    $carModel = $input[1];
    $distance = doubleval($input[2]);

    if (Car::driveCar($carModel, $distance) != true) {
        echo "Insufficient fuel for the drive" . "\n";
    };
}
echo implode("\n",Car::getCars());