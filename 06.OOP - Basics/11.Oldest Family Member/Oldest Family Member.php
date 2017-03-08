<?php

class Persoon
{
    private $age;
    private $name;

    public function __construct(string $name, int $age)
    {
        $this->age = $age;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    public function __toString()
    {
        return $this->name . " " . $this->age;
    }


}

class Family
{
    private $members = [];
    private $oldestMember = null;

    public function addMember(Persoon $member)
    {
        $this->members[] = $member;

        if ($this->oldestMember == null ||
            $member->getAge() > $this->oldestMember->getAge()
        ) {
            $this->oldestMember = $member;

        }
    }

    public function Getoldestmember(): Persoon
    {
        return $this->oldestMember;
    }

}

$family = new Family();
$number = intval(trim(fgets(STDIN)));

for ($i = 0; $i < $number; $i++) {
    $namesAndNumbers = explode(" ", fgets(STDIN));
    $name = $namesAndNumbers[0];
    $age = intval($namesAndNumbers[1]);

    $member = new Persoon($name, $age);
    $family->addMember($member);
}
echo $family->Getoldestmember();
