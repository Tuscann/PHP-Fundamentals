<?php

declare(strict_types = 1);

namespace Raw_data;

class Car
{
    private $model;
    private $engine;
    private $cargo;
    private $tires;

    function __construct(string $model, Engine $engine, Cargo $cargo, array $tires)
    {
        $this->model = $model;
        $this->engine = $engine;
        $this->cargo = $cargo;
        $this->tires = $tires;
    }
    //getters
    /**
     * @return Cargo
     */
    public function getCargo(): Cargo
    {
        return $this->cargo;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @return Engine
     */
    public function getEngine(): Engine
    {
        return $this->engine;
    }

    /**
     * @return array
     */
    public function getTires(): array
    {
        return $this->tires;
    }


}

class Engine
{
    private $speed;
    private $power;

    function __construct(int $speed, int $power)
    {
        $this->power = $power;
        $this->speed = $speed;
    }

    /**
     * @return int
     */
    public function getSpeed(): int
    {
        return $this->speed;
    }

    /**
     * @return int
     */
    public function getPower(): int
    {
        return $this->power;
    }

}

class Cargo
{
    private $weight;
    private $type;

    public function __construct(int $weight, $type)
    {
        $this->weight = $weight;
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }
}

class Tire
{

    private $pressure;
    private $age;

    function __construct(float $pressure, int $age)
    {
        $this->pressure = $pressure;
        $this->age = $age;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return float
     */
    public function getPressure(): float
    {
        return $this->pressure;
    }

}

$inputLenght = intval(trim(fgets(STDIN)));
$cars = array();

for ($i = 0; $i < $inputLenght; $i++) {
    $carInfo = trim(fgets(STDIN));
    $carInfo = explode(" ", $carInfo);

    $model = $carInfo[0];

    $engineSpeed = intval($carInfo[1]);
    $enginePower = intval($carInfo[2]);

    $engine = new Engine($engineSpeed, $enginePower);

    $cargoWeight = intval($carInfo[3]);
    $cargoType = $carInfo[4];

    $cargo = new Cargo($cargoWeight, $cargoType);

    $tire_1_pressure = floatval($carInfo[5]);
    $tire_1_age = intval($carInfo[6]);

    $tire_1 = new Tire($tire_1_pressure, $tire_1_age);

    $tire_2_pressure = floatval($carInfo[7]);
    $tire_2_age = intval($carInfo[8]);

    $tire_2 = new Tire($tire_2_pressure, $tire_2_age);

    $tire_3_pressure = floatval($carInfo[9]);
    $tire_3_age = intval($carInfo[10]);

    $tire_3 = new Tire($tire_3_pressure, $tire_3_age);

    $tire_4_pressure = floatval($carInfo[11]);
    $tire_4_age = intval($carInfo[12]);

    $tire_4 = new Tire($tire_4_pressure, $tire_4_age);

    $tires = array($tire_1, $tire_2, $tire_3, $tire_4);

    $car = new Car($model, $engine, $cargo, $tires);

    $cars[] = $car;
}
$command = trim(fgets(STDIN));


foreach ($cars as $car) {
    if ($car->getCargo()->getType() == $command) {
        if ($command == "fragile") {
            foreach ($car->getTires() as $tire) {
                if ($tire->getPressure() < 1) {
                    echo $car->getModel() . PHP_EOL;
                    break;
                }
            }

        } else if ($command == "flamable") {
            if ($car->getEngine()->getPower() > 250) {
                echo $car->getModel() . PHP_EOL;
            }
        }
    }
}
?>