<?php
namespace task5;

class Car
{
    private $model;
    private $fuelAmount;
    private $fuelCostFor1km;
    private $distanceTraveled;

    public function __construct(string $model, float $fuelAmount, float $fuelCostFor1km)
    {
        $this->model = $model;
        $this->fuelAmount = $fuelAmount;
        $this->fuelCostFor1km = $fuelCostFor1km;
        $this->distanceTraveled = 0;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function travel(float $distance)
    {
        $fuelUsed = round($distance * $this->fuelCostFor1km, 2);

        if ($fuelUsed > round($this->fuelAmount, 2)) {
            throw new \Exception("Insufficient fuel for the drive");
        }
        $this->fuelAmount -= $fuelUsed;
        $this->distanceTraveled += $distance;
    }

    public function __toString(): string
    {
        return $this->model . " "
            . number_format(abs($this->fuelAmount), 2)
            . " " . $this->distanceTraveled;
    }
}

$cars = array();

$count = intval(trim(fgets(STDIN)));

for ($i = 0; $i < $count; $i++) {
    $input = explode(" ", fgets(STDIN));
    $carModel = $input[0];
    $fuelAmount = floatval($input[1]);
    $FuelCostFor1km = floatval($input[2]);

    $car = new Car($carModel, $fuelAmount, $FuelCostFor1km);

    $cars[$carModel] = $car;
}
while (true) {
    $commands = explode(" ", trim(fgets(STDIN)));

    if (trim($commands[0]) == "End") {
        break;
    }
    if (count($commands) > 1) {
        $model = $commands[1];
        $AmountKilometers = floatval($commands[2]);

        $car = $cars[$model];


        try{
            $car->travel($AmountKilometers);
        } catch (\Exception $e){
            echo $e->getMessage() . PHP_EOL;
        }
    }
}
foreach ($cars as $car) {
    echo $car . PHP_EOL;
}
