<?php
namespace shopping;


class Person
{
    private $name;
    private $money;
    private $bagOfProducts = [];

    public function __construct($name, $money)
    {
        $this->name = $name;
        $this->money = $money;
    }


}

class Product
{
    private $name;
    private $cost;

}

$customers = explode(";", trim(fgets(STDIN)));
$products = explode(";", trim(fgets(STDIN)));

try {
    foreach ($customers as $customer) {

        if ($customer == "") {
            throw new \Exception("Name cannot be empty");
        }
        $delimeter = explode("=", $customer);
        $customerName = $delimeter[0];
        $price = floatval($delimeter[1]);
        if ($price < 0) {
            throw new \Exception("Money cannot be negative");
        }
        $cutomerrr = new Person($customerName, $price);

    }
    foreach ($products as $product) {

//        if ($product == "") {
//            throw new \Exception("Name cannot be empty");
//        }
        $productsDelimeters = explode("=", $products);
        $productName = $productsDelimeters[0];
        $productPrice = floatval($productsDelimeters[1]);
        if ($productPrice < 0) {
            throw new \Exception("Money cannot be negative");
        }
        $producttt = new Person($productName, $productPrice);

    }


} catch (\Exception $e) {
    echo $e->getMessage();
}




//
//    foreach ($names as $name) {
//
//        if (strlen($name) == 0) {
//            throw new \Exception("Name cannot be empty");
//        }
//
//
//    }

//    $products = explode(";", trim(fgets(STDIN)));
//
//    foreach ($products as $product) {
//        $product = explode("=", trim($product));
//        $productName = $product[0];
//
//
//
//        $productPrize = floatval($product[1]);
//
//        if ($productPrize < 0.0) {
//            throw new \Exception("Money cannot be negative");
//        }
//
//    }