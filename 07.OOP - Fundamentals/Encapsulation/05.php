<?php
namespace PizzaApp;

class Dough
{
    const CALORIES_PER_GRAM = 2;
    const DOUGH_TYPES = [
        "White" => 1.5,
        "Wholegrain" => 1.
    ];
    const BAKING_TECHNIQUES = [
        "Crispy" => .9,
        "Chewy" => 1.1,
        "Homemade" => 1.
    ];
    private $type;
    private $bakingTechnique;
    private $weight;

    public function __construct(string $type, string $bakingTechnique, int $weight)
    {
        $this->setType($type);
        $this->setBakingTechnique($bakingTechnique);
        $this->setWeight($weight);
    }

    public function setType($type)
    {
        if (!array_key_exists($type, self::DOUGH_TYPES)) {
            throw new \Exception("Invalid type of dough.");
        }
        $this->type = $type;
    }

    public function setBakingTechnique($bakingTechnique)
    {
        $this->bakingTechnique = $bakingTechnique;
    }

    public function setWeight($weight)
    {
        if ($weight < 1 || $weight > 200) {
            throw new \Exception("Dough weight should be in the range [1..200].");
        }
        $this->weight = $weight;
    }

    public function getCalories(): float
    {
        return $this->weight
            * self::CALORIES_PER_GRAM
            * self::DOUGH_TYPES[$this->type]
            * self::BAKING_TECHNIQUES[$this->bakingTechnique];
    }
}

class App
{
    const DELIMITER = " ";
    const END = "END";

    private $pizza;

    public function start()
    {
        $this->processInput();
    }

    private function processInput()
    {
        try {
            $pizzaTokens = explode(self::DELIMITER, $this->readLine());
            $this->pizza = new Pizza($this->toUppercaseFirst($pizzaTokens[1]), intval($pizzaTokens[2]));

            $doughTokens = explode(self::DELIMITER, $this->readLine());
            $dough = new Dough(
                $this->toUppercaseFirst($doughTokens[1]),
                $this->toUppercaseFirst($doughTokens[2]),
                intval($doughTokens[3]));

            $this->pizza->setDough($dough);

            while (true) {
                $toppingData = explode(self::DELIMITER, $this->readLine());
                if ($toppingData[0] === self::END) {
                    break;
                }

                $topping = new Topping($this->toUppercaseFirst($toppingData[1]), intval($toppingData[2]));
                $this->pizza->addTopping($topping);
            }

            $this->printOutput();

        } catch (\Exception $ex) {
            $this->writeLine($ex->getMessage());
        }
    }

    private function printOutput()
    {
        $this->writeLine($this->pizza);
    }

    private function toUppercaseFirst(string $text): string
    {
        return ucfirst(strtolower($text));
    }

    private function readLine(): string
    {
        return trim(fgets(STDIN));
    }

    private function writeLine($content)
    {
        echo $content . PHP_EOL;
    }
}

class Pizza
{
    private $name;
    private $numberOfToppings;
    private $dough;
    private $toppings = [];

    public function __construct(string $name, int $numberOfToppings)
    {
        $this->setName($name);
        $this->setNumberOfToppings($numberOfToppings);
    }

    public function setName(string $name)
    {
        if (empty($name) || (strlen($name) < 1 || strlen($name) > 15)) {
            throw new \Exception("Pizza name should be between 1 and 15 symbols.");
        }
        $this->name = $name;
    }

    public function setNumberOfToppings($numberOfToppings)
    {
        if ($numberOfToppings < 0 || $numberOfToppings > 10) {
            throw new \Exception("Number of toppings should be in range [0..10].");
        }
        $this->numberOfToppings = $numberOfToppings;
    }

    public function setDough(Dough $dough)
    {
        $this->dough = $dough;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumberOfToppings(): int
    {
        return $this->numberOfToppings;
    }

    public function getTotalCalories(): float
    {
        $calories = $this->dough->getCalories();
        foreach ($this->toppings as $topping) {
            $calories += $topping->getCalories();
        }
        return $calories;
    }

    public function addTopping(Topping $topping)
    {
        $this->toppings[] = $topping;
    }

    function __toString(): string
    {
        $caloriesFormatted = number_format($this->getTotalCalories(), 2, ".", "");
        return "{$this->getName()} - {$caloriesFormatted} Calories.";
    }
}


class Topping
{
    const CALORIES_PER_GRAM = 2;
    const TOPPING_TYPES = [
        "Meat" => 1.2,
        "Veggies" => .8,
        "Cheese" => 1.1,
        "Sauce" => .9
    ];
    private $type;
    private $weight;

    public function __construct(string $type, int $weight)
    {
        $this->setType($type);
        $this->setWeight($weight);
    }

    public function setType($type)
    {
        if (!array_key_exists($type, self::TOPPING_TYPES)) {
            throw new \Exception("Cannot place {$type} on top of your pizza.");
        }
        $this->type = $type;
    }

    public function setWeight($weight)
    {
        if ($weight < 1 || $weight > 50) {
            throw new \Exception("{$this->type} weight should be in the range [1..50].");
        }
        $this->weight = $weight;
    }

    public function getCalories(): float
    {
        return $this->weight
            * self::CALORIES_PER_GRAM
            * self::TOPPING_TYPES[$this->type];
    }
}

$radio = new App();
$radio->start();