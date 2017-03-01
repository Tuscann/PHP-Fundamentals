<?php

interface InterfaceCharacter
{
    public function hashPasword();
}

abstract class Character implements InterfaceCharacter
{
    protected $name;
    protected $hashedPass;
    protected $level;

    public function __toString()
    {
        return $this->name . "\" | " . '"' . $this->hashPasword() . '" -> ' . get_class($this);
    }
}

class Demon extends Character
{
    protected $energy;

    public function __construct(string $username, float $energy, int $level)
    {
        $this->name = $username;
        $this->energy = $energy;
        $this->level = $level;
        $this->hashedPass = $this->hashPasword();
    }

    public function hashPasword()
    {
        return round(strlen($this->name) * 217);
    }

    public function __toString()
    {
        return '"' . parent::__toString() . "\n" . number_format($this->energy * $this->level, 1, ".", '');
    }
}

class Archangel extends Character
{
    protected $mana;

    public function __construct(string $username, float $mana, int $level)
    {
        $this->name = $username;
        $this->mana = $mana;
        $this->level = $level;
        $this->hashedPass = $this->hashPasword();
    }
    public function hashPasword()
    {
        return strrev($this->name) . round(strlen($this->name) * 21);
    }

    public function __toString()
    {
        return parent::__toString() . "\n" . $this->mana * $this->level;
    }
}

$input = explode(" | ", trim(fgets(STDIN)));
$name = $input[0];
$type = $input[1];
$specialPoint = floatval($input[2]);
$level = intval($input[3]);

if ($type == "Demon") {
    $demon = new Demon($name, $specialPoint, $level);
    echo $demon;
} else {
    $archangel = new Archangel($name, $specialPoint, $level);
    echo $archangel;
}