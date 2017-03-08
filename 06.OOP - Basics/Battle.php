<?php


class Battle
{
    const ROUNDS = 10;

    private $playerOne;
    private $playerTwo;
    private $rounds;

    public function __construct(Player $playerOne,
                                Player $playerTwo,
                                $rounds = self::ROUNDS)
    {
        $this->playerOne = $playerOne;
        $this->playerTwo = $playerTwo;
        $this->rounds = $rounds;
    }

    public function start()
    {
        $rounds = $this->rounds;
        $player1 = $this->playerOne;
        $player2 = $this->playerTwo;
        while ($rounds > 0 && $player2->isAlive() && $player1->isAlive()) {
            $player1->attack($player2);
            $player2->attack($player1);
            $rounds--;
        }
    }

    public function getResult()
    {
        if ($this->playerOne->isAlive() == $this->playerTwo->isAlive()) {
            return null;
        }

        $winner = $this->playerOne->isAlive()
            ? $this->playerOne
            : $this->playerTwo;

        return $winner;
    }
}