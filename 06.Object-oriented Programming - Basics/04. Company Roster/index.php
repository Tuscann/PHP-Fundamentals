<?php

class Employee
{
    private $name;
    private $salary;
    private $position;
    private $department;
    private $email;
    private $age;


    function __construct(string $name, float $salary, string $position, string $department, string $email, float $age)
    {
        $this->name = $name;
        $this->salary = $salary;
        $this->position = $position;
        $this->department = $department;
        $this->email = $email;
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getSalary(): float
    {
        return $this->salary;
    }
    /**
     * @return string
     */
    public function getPosition(): string
    {
        return $this->position;
    }
    /**
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->department;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return float
     */
    public function getAge(): float
    {
        return $this->age;
    }
}

$count = intval(trim(fgets(STDIN)));
$employess = array();
for ($i = 0; $i < $count; $i++) {
    $input = explode(" ", trim(fgets(STDIN)));

    $name = $input[0];
    $salary = floatval($input[1]);
    $position = $input[2];
    $department = $input[3];
    $email = "n/a";
    $age = floatval(-1);

    if (isset($input[4])) {
        if (is_numeric($input[4])) {
            $age = floatval($input[4]);
        } else {
            $email = $input[4];
        }
    }
    if (isset($input[5])) {
        if (is_numeric($input[5])) {
            $age = floatval($input[5]);
        }
    }

    $employee = new Employee($name, $salary, $position, $department, $email, $age);

    array_push($employess, $employee);
}
$departments = [];

foreach ($employess as $employee) {
    if (array_key_exists($employee->getDepartment(), $departments)) {
        $departments[$employee->getDepartment()]++;
    } else {
        $departments[$employee->getDepartment()] = 1;
    }
}

$averageSalaries = [];

foreach ($departments as $department => $count) {
    $averageSalary = 0;
    foreach ($employess as $employe) {
        if ($employe->getDepartment() == $department) {
            $averageSalary += $employe->getSalary();

        }
    }
    $averageSalary /= $count;
    $averageSalaries[$department] = $averageSalary;
}
//var_dump($averageSalaries);
$highestDepartment = array_search(max($averageSalaries), $averageSalaries);

function orderBySalary($a, $b)
{
    return $a->getSalary() < $b->getSalary();
}
usort($employess,"orderBySalary");

echo "Highest Average Salary: {$highestDepartment} \n";

for ($i = 0; $i < count($employess); $i++) {
    if ($employess[$i]->getDepartment() == $highestDepartment) {
        if ($i != count($employess) - 1) {
            echo $employess[$i]->getName() . ' ' . number_format($employess[$i]->getSalary(), 2) . " " . $employess[$i]->getEmail() . ' ' . $employess[$i]->getAge() . PHP_EOL;
        } else {
            echo $employess[$i]->getName() . ' ' . number_format($employess[$i]->getSalary(), 2) . " " . $employess[$i]->getEmail() . ' ' . $employess[$i]->getAge();
        }
    }
}