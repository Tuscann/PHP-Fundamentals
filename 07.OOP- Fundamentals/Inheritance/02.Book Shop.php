<?php
namespace booskshop;

class Book
{
    private $title;
    private $author;
    private $price;

    public function __construct(string $title, array $author, float $price)
    {
        //$this->title = $title;
        //$this->author = $author;
        $this->setPrice($price);
    }
// Getters
    public function getPrice()
    {
        return $this->price;
    }

    public function __toString()
    {
        return "OK\n" . $this->getPrice();
    }
//Setters
    protected function setPrice(float $price)
    {
        $this->price = $price;
    }
}

class GoldenEditionBook extends Book
{
    public function getPrice()
    {
        return parent::getPrice() * 1.3;
    }
}
try {
    $author = explode(" ", fgets(STDIN));
    $bookName = trim(fgets(STDIN));
    $bookPrice = floatval(fgets(STDIN));
    $bookType = trim(fgets(STDIN));


    if (is_numeric(substr($author[1], 0, 1))) {
        throw new \Exception("Author not valid!");
    }
    if (strlen($bookName) < 3) {
        throw new \Exception("Title not valid!");
    }
    if ($bookPrice <= 0) {
        throw new \Exception("Price not valid!");
    }
    if ($bookType != "GOLD" and $bookType != "STANDARD") {
        throw new \Exception("Type is not valid!");
    }

    if ($bookType == "GOLD") {
        $book = new GoldenEditionBook($bookName, $author, $bookPrice);
    } else if ($bookType == "STANDARD") {
        $book = new Book($bookName, $author, $bookPrice);
    }
    echo $book;

} catch (\Exception $e) {
    echo $e->getMessage();
}