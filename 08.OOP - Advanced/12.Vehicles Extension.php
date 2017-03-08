<?php
declare(strict_types = 1);

namespace VehiclesExtension;

interface VehicleInterface
{
    public function drive(float $distance): string;

    public function refuel(float $liters);
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

    public function refuel(float $amount)
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
        $this->fuelQuantity = $fuelQuantity;
    }

    protected function setFuelConsumption(float $fuelConsumption)
    {
        return $this->fuelConsumption = $fuelConsumption;
    }

    public function setTankCapacity($tankCapacity)
    {
        if ($tankCapacity < 0) {
            throw new \Exception("Fuel must be a positive number");
        }
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

$car_input = explode(" ", trim(fgets(STDIN)));
$truck_input = explode(" ", trim(fgets(STDIN)));
$bus_input = explode(" ", trim(fgets(STDIN)));


if ($car_input[1] < 0) {
    $car_input[1] = 0;
} else if ($truck_input[1] < 0) {
    $truck_input[1] = 0;
} elseif ($bus_input[1] < 0) {
    $bus_input[1] = 0;
}


if ($car_input[1] > $car_input[3]) {
    echo "Cannot fit fuel in tank" . PHP_EOL;
    $car_input[1] = 0;
}
if ($bus_input[1] > $bus_input[3]) {
    echo "Cannot fit fuel in tank" . PHP_EOL;
    $bus_input[1] = 0;
}

$car = new Car(floatval($car_input[1]), floatval($car_input[2]), floatval($car_input[3]));
$truck = new Truck(floatval($truck_input[1]), floatval($truck_input[2]), floatval($truck_input[3]));
$bus = new Bus(floatval($bus_input[1]), floatval($bus_input[2]), floatval($bus_input[3]));

$n = intval(fgets(STDIN));
for ($i = 0; $i < $n; $i++) {

    try {
        $tokens = explode(" ", trim(fgets(STDIN)));
        $command = $tokens[0];
        $typeVehicle = $tokens[1];
        $liters = floatval($tokens[2]);

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