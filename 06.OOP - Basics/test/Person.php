<?php
namespace Hello;

class Person
{
    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function sayHello():string
    {
        return $this->name . ' says "Hello"!';
    }
}