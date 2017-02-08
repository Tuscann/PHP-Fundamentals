<?php

function test($firstName, $lastName, $age)
{
    echo "My name is " . "{$firstName} " . "{$lastName} " . "and I am " . "{$age}" . " years old." . "<br>";
}

test("Mister", "DakMan", "21");
test("Pesho", "Peshev", "55");

