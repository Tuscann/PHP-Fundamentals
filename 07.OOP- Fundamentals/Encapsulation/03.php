<?php

class Shop
{

    private $person;
    private $bag = [];

    function __construct(Person $person)
    {
        $this->person = $person;
    }

    function setBag(Product $product)
    {
        if ($this->person->getMoney() < $product->getCost()) {
            throw new Exception($this->person->getName() . ' can\'t afford ' . $product->getName() . PHP_EOL);
        }
        $this->bag[] = $product;
        $this->person->bay($product->getCost());
        echo $this->person->getName() . ' bought ' . $product->getName() . PHP_EOL;
    }

    public function getPerson()
    {
        return $this->person;
    }

    public function getBag(): array
    {
        return $this->bag;
    }
}

class Product
{
    const WORD_LENGHT = 0;
    private $name;
    private $cost;

    function __construct($name, $cost)
    {
        $this->setName($name);
        $this->setCost($cost);
    }


    public function setName($name)
    {
        if ($name == '') {
            throw new Exception('Name cannot be empty');
        }
        $this->name = $name;
    }

    public function setCost($cost)
    {
        if ($cost < self::WORD_LENGHT) {
            throw new Exception("Money cannot be negative");
        }
        $this->cost = $cost;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function getName()
    {
        return $this->name;
    }
}

class Person
{
    const Width = 0;
    private $name;
    private $money;


    function __construct($name, $money)
    {
        $this->setName($name);
        $this->setMoney($money);
    }

    function setName($name)
    {
        if ($name == '') {
            throw  new Exception('Name cannot be empty');
        }
        $this->name = $name;
    }

    function setMoney($money)
    {
        if ($money < self::Width) {
            throw new Exception('Money cannot be negative');
        }
        $this->money = $money;
    }

    function bay($money)
    {
        $this->money -= $money;
    }

    public function getMoney()
    {
        return $this->money;
    }

    public function getName()
    {
        return $this->name;
    }
}

$inputPeople = array_map('trim', explode(';', fgets(STDIN)));
$inputProducts = array_map('trim', explode(';', fgets(STDIN)));

$people = [];
$shops = [];

for ($i = 0; $i < count($inputPeople) - 1; $i++) {
    if (strstr($inputPeople[$i], '=')) {
        $personInfo = array_map('trim', explode('=', $inputPeople[$i]));
        try {
            $person = new Person($personInfo[0], $personInfo[1]);
            $people[$personInfo[0]] = $person;
            $shops[$personInfo[0]] = new Shop ($person);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    } else {
        echo 'Name cannot be empty';
        exit;
    }
}

$products = [];
for ($i = 0; $i < count($inputProducts) - 1; $i++) {
    if (strstr($inputProducts[$i], '=')) {
        $productInfo = array_map('trim', explode('=', $inputProducts[$i]));
        try {
            $product = new Product($productInfo[0], $productInfo[1]);
            $products[$productInfo[0]] = $product;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    } else {
        echo 'Name cannot be empty';
    }
}


while (true) {
    $input = array_map('trim', explode(' ', fgets(STDIN)));
    if ($input[0] == "END") {
        break;
    }

    try {
        $name = $input[0];
        $product = $input[1];
        if (!array_key_exists($name, $shops)) {
            $shop = new Shop($people[$name], $products[$product]);
            $shops[$name] = $shop;
            $shops[$name]->setBag($products[$product]);
        } else {
            $shops[$name]->setBag($products[$product]);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
if (count($shops) == 0) {
    foreach ($people as $person) {
        echo $person->getName() . ' - Nothing bought' . PHP_EOL;
    }


}
foreach ($shops as $shop) {
    echo $shop->getPerson()->getName() . ' - ';
    $count = count($shop->getBag());
    if ($count == 0) {
        echo 'Nothing bought' . PHP_EOL;
    } else {
        for ($i = 0; $i < count($shop->getBag()); $i++) {
            if ($i == count($shop->getBag()) - 1) {
                echo $shop->getBag()[$i]->getName() . PHP_EOL;
            } else {
                echo $shop->getBag()[$i]->getName() . ',';
            }
        }
    }
}