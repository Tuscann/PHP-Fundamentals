<?php

class Trainer
{
    private $name;

    public function __construct($name, Pokemon $pokemon)
    {
        $this->name = $name;

    }

}

class Pokemon
{

    private $pokemenName;
    private $pokemmonElement;
    private $pokemonHealth;

    public function __construct($pokemenName, $pokemmonElement, $pokemonHealth)
    {
        $this->pokemenName = $pokemenName;
        $this->pokemmonElement = $pokemmonElement;
        $this->pokemonHealth = $pokemonHealth;
    }

}

$trainers = [];
while (true) {
    $input = explode(" ", fgets(STDIN));


    if ($input[0] == "Tournament") {

        break;
    }
    if (count($input) > 1) {
        $trainerName = $input[0];
        $pokemonName = $input[1];
        $pokemonElement = $input[2];
        $pokemonHealth = intval($input[3]);

        $pokemon = new Pokemon($pokemonName, $pokemonElement, $pokemonHealth);
        $trainer = new Trainer($trainerName, $pokemon);



    }


}
while (true) {
    $inputElement = trim(fgets(STDIN));
    if ($inputElement == 'End') {
        break;
    }




}