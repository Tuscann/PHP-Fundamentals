<?php

class Trainer
{
    private $name;
    private $numberOfBadges;
    private $pokemons = [];

    public function __construct(string $name, int $numberOfBadges = 0)
    {
        $this->name = $name;
        $this->numberOfBadges = $numberOfBadges;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setNumberOfBadges(int $numberOfBadges)
    {
        $this->numberOfBadges = $numberOfBadges;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumberOfBadges(): int
    {
        return $this->numberOfBadges;
    }

    public function getPokemons(): array
    {
        return $this->pokemons;
    }
    public function Pokemons(Pokemon $pokemon)
    {
        $this->pokemons [] = $pokemon;
    }

    public function addBadge()
    {
        return $this->numberOfBadges++;
    }

    public function countOfPokemons()
    {
        return count($this->pokemons);
    }

    public function addPocemonCollection($collection)
    {
        $this->pokemons = $collection;
    }
}

class Pokemon
{
    private $name;
    private $element;
    private $health;

    public function __construct(string $name, string $element, int $health)
    {
        $this->name = $name;
        $this->element = $element;
        $this->health = $health;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getElement(): string
    {
        return $this->element;
    }

    public function setElement(string $element)
    {
        $this->element = $element;
    }

    public function getHealth(): int
    {
        return $this->health;
    }

    public function setHealth(int $health)
    {
        $this->health = $health;
    }

    public function reduceHealth()
    {
        $this->health -= 10;
    }
}

$trainersAndPokemons = [];
$namesOfTrainers = [];
while (true) {
    $input = trim(fgets(STDIN));

    if ($input == "Tournament") {
        break;
    }
    $trainerInfo = explode(' ', $input);
    $trainerName = $trainerInfo[0];
    $pokemonName = $trainerInfo[1];
    $pokemonElement = $trainerInfo[2];
    $pokemonHealth = intval($trainerInfo[3]);

    if (!in_array($trainerName, $namesOfTrainers)) {
        $pokemon = new Pokemon($pokemonName, $pokemonElement, $pokemonHealth);
        $trainer = new Trainer($trainerName);
        $trainer->Pokemons($pokemon);
        $trainersAndPokemons[] = $trainer;
        $namesOfTrainers[] = $trainerName;
    } else {
        $pokemon = new Pokemon($pokemonName, $pokemonElement, $pokemonHealth);
        foreach ($trainersAndPokemons as $trainerAndPokemon) {
            if ($trainerAndPokemon->getName() == $trainerName) {
                $trainerAndPokemon->Pokemons($pokemon);
            }
        }
    }
}
while (true) {
    $input = trim(fgets(STDIN));

    if ($input == "End") {
        break;
    }

    foreach ($trainersAndPokemons as $trainerAndPokemon) {
        $pokemonsByTrainer = $trainerAndPokemon->getPokemons();

        foreach ($pokemonsByTrainer as $key => $pokemon) {
            if ($pokemon->getElement() == $input) {
                $trainerAndPokemon->addBadge();
                break;
            } else {
                $pokemon->reduceHealth();
                if ($pokemon->getHealth() <= 0) {
                    array_splice($pokemonsByTrainer, $key, 1);
                }
            }
        }
        $trainerAndPokemon->addPocemonCollection($pokemonsByTrainer);
    }
}
usort($trainersAndPokemons, 'orderByNumberOfBadges');

foreach ($trainersAndPokemons as $trainerAndPokemons) {
    echo $trainerAndPokemons->getName() . ' ' .
        $trainerAndPokemons->getNumberOfBadges() . ' ' .
        $trainerAndPokemons->countOfPokemons() . PHP_EOL;
}
function orderByNumberOfBadges($a, $b)
{
    return $a->getNumberOfBadges() < $b->getNumberOfBadges();
}
