<?php

interface RemoveInterface
{
    public function remove(): string;
}
interface UsedInterface
{
    public function used(): int;
}
interface AddInterface
{
    public function Add(string $element): int;
}
abstract class Collection
{
    protected $elements = [];
}
class AddCollection extends Collection implements AddInterface
{
    public function Add(string $element): int
    {
        return array_push($this->elements, $element) - 1;
    }
}
class AddRemoveCollection extends Collection implements AddInterface, RemoveInterface
{
    public function Add(string $element): int
    {
        array_unshift($this->elements, $element);
        return 0;
    }
    public function remove(): string
    {
        return array_pop($this->elements);
    }
}
class MyList extends Collection implements AddInterface, RemoveInterface, UsedInterface
{
    public function Add(string $element): int
    {
        array_unshift($this->elements, $element);
        return 0;
    }
    public function remove(): string
    {
        return array_shift($this->elements);
    }
    public function used(): int
    {
        return count($this->elements);
    }
}

spl_autoload_register(function ($className) {
    require_once "{$className}.php";
});
$addCollection = new AddCollection();
$addRemoveCollection = new AddRemoveCollection();
$myList = new MyList();

$addCollections = [$addCollection, $addRemoveCollection, $myList];

$removeCollections = [$addRemoveCollection, $myList];
$input = explode(" ", trim(fgets(STDIN)));

foreach ($addCollections as $collection) {
    $output = [];
    foreach ($input as $item) {
        $output[] = $collection->Add($item);
    }
    echo implode(" ", $output).PHP_EOL;
}
$numOfRemovals = intval(trim(fgets(STDIN)));

foreach ($removeCollections as $collection) {
    $output = [];
    for ($i = 0; $i < $numOfRemovals; $i++) {
        $output[] = $collection->remove();
    }
    echo implode(" ", $output).PHP_EOL;
}

