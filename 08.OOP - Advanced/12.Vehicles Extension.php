<?php
declare(strict_types = 1);

namespace VehiclesExtension;

interface VehicleInterface
{
    public function drive(float $distance): string;

    public function refuel(float $liters): float;
}

abstract class Vehicle implements VehicleInterface
{
    protected $fuelQuantity;
    protected $fuelConsumption;
    protected $tankCapacity;

    public function __construct(float $fuelQuantity, float $fuelConsumption, float $tankCapacity)
    {
        $this->setFuelQuantity($fuelQuantity);
        $this->setFuelConsumption($fuelConsumption);
        $this->setTankCapacity($tankCapacity);
    }

    public function drive(float $distance): string
    {
        $driveee = $this->fuelConsumption * $distance;
        $this->fuelQuantity -= $driveee;

        if ($this->fuelQuantity > 0) {
            return "{$this->getClassName()} travelled {$distance} km";
        } else {
            $this->fuelQuantity += $driveee;
            return "{$this->getClassName()} needs refueling";
        }
    }

    public function refuel(float $amount): float
    {
        if ($amount > $this->tankCapacity - $this->fuelQuantity) {
            throw new \Exception("Cannot fit fuel in tank");
        } else {
            return $this->fuelQuantity += $amount;
        }

    }

    //Setters

    public function setFuelQuantity(float $fuelQuantity)
    {
        if ($fuelQuantity <= 0) {
            throw new \Exception("Fuel must be a positive number");
        }

        $this->fuelQuantity = $fuelQuantity;
    }

    protected function setFuelConsumption(float $fuelConsumption)
    {
        return $this->fuelConsumption = $fuelConsumption;
    }

    public function setTankCapacity($tankCapacity)
    {
        $this->tankCapacity = $tankCapacity;
    }

    //Getters

    private function getClassName(): string
    {
        return basename(get_class($this));
    }

    public function getFuel()
    {
        return $this->fuelQuantity;
    }
}

class Car extends Vehicle
{
    public function setFuelConsumption(float $fuelConsumption)
    {
        $this->fuelConsumption = $fuelConsumption + 0.9;
    }
}

class Truck extends Vehicle
{

    public function setFuelConsumption(float $fuelConsumption)
    {
        $this->fuelConsumption = $fuelConsumption + 1.6;
    }

    public function refuel(float $amount): float
    {
        return $this->fuelQuantity += $amount * 0.95;
    }
}

class Bus extends Vehicle
{
    public function drive(float $distance, bool $empty = false): string
    {
        if ($empty == false) {
            $this->fuelConsumption += 1.4;
            $res = parent::drive($distance);
            $this->fuelConsumption -= 1.4;
            return $res;
        } else {
            return parent::drive($distance);
        }
    }
}

$carParameters = explode(" ", trim(fgets(STDIN)));
$fuel = floatval($carParameters[1]);
$consumption = floatval($carParameters[2]);
$tankCapacity = floatval($carParameters[3]);

//if ($carParameters[1] > $carParameters[3]) {
//    echo "Cannot fit fuel in tank" . PHP_EOL;
//    $carParameters[1] = 0;
//}


$car = new Car($fuel, $consumption, $tankCapacity);

$truckParameters = explode(" ", trim(fgets(STDIN)));
$fuel = floatval($truckParameters[1]);
$consumption = floatval($truckParameters[2]);
$tankCapacity = floatval($truckParameters[3]);

$truck = new Truck($fuel, $consumption, $tankCapacity);

$busParameters = explode(" ", trim(fgets(STDIN)));
$fuel = floatval($busParameters[1]);
$consumption = floatval($busParameters[2]);
$tankCapacity = floatval($busParameters[3]);

$bus = new Bus($fuel, $consumption, $tankCapacity);

$n = intval(fgets(STDIN));
for ($i = 0; $i < $n; $i++) {

    try {
        $tokens = explode(" ", trim(fgets(STDIN)));
        $command = $tokens[0];
        $typeVehicle = $tokens[1];
        $liters = floatval($tokens[2]);

        if ($liters > $carParameters[3]) {
            echo "Cannot fit fuel in tank" . PHP_EOL;
            $carParameters[1] = 0;
        }


        if ($command == "Drive" && $typeVehicle == "Car") {
            echo $car->drive($liters) . PHP_EOL;;
        } elseif ($command == "Drive" && $typeVehicle == "Truck") {
            echo $truck->drive($liters) . PHP_EOL;;
        } elseif ($command == "Drive" && $typeVehicle == "Bus") {
            echo $bus->drive($liters) . PHP_EOL;
        } elseif ($command == "DriveEmpty" && $typeVehicle == "Bus") {
            echo $bus->drive($liters, true) . PHP_EOL;
        } else if ($command == "Refuel" && $typeVehicle == "Car") {
            $car->refuel($liters);
        } elseif ($command == "Refuel" && $typeVehicle == "Truck") {
            $truck->refuel($liters);
        } elseif ($command == "Refuel" && $typeVehicle == "Bus") {
            $bus->refuel($liters);
        }
    } catch (\Exception $e) {
        echo ($e->getMessage()) . PHP_EOL;
    }
}
echo "Car: " . number_format($car->getFuel(), 2, '.', '') . PHP_EOL;
echo "Truck: " . number_format($truck->getFuel(), 2, '.', '') . PHP_EOL;
echo "Bus: " . number_format($bus->getFuel(), 2, '.', '') . PHP_EOL;

