<?php
interface carInterface
{
    public function useBreaks():string;
    public function pushTheGas():string;
}
class Ferrari implements carInterface
{
    private $model;
    private $driver;

    public function __construct(string $driver, string $model = "488-Spider")
    {
        $this->driver = $driver;
        $this->model = $model;
    }
    public function useBreaks():string
    {
        return "Brakes!";
    }
    public function pushTheGas():string
    {
        return "Zadu6avam sA!";
    }
    public function __toString():string
    {
        return  "{$this->model}/" . "{$this->useBreaks()}/" . "{$this->pushTheGas()}/" . "{$this->driver}";
    }
}
$driverName = trim(fgets(STDIN));
$car = new Ferrari($driverName);
echo $car;

