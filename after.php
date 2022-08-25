<?php

class TennisGame
{

    public function getScore(Player $player1, Player $player2)
    {
        if ($player1->score == $player2->score) {
            return new EqualScore($player1, $player2);
        }

        if ($player1->score >= 4 || $player2->score >= 4) {
            return new EndgameScore($player1, $player2);
        }

        return new RegularScore($player1, $player2);
    }
}

class Player
{
    public $name;
    public $score;

    public function __construct(string $name, int $score)
    {
        $this->name = $name;
        $this->score = $score;
    }
}

abstract class Score
{
    public $player1;
    public $player2;

    const VALUES = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty',
    ];

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    abstract function __toString();

    public function getScore(int $score)
    {
        return Score::VALUES[$score] ?? '';
    }
}

class EqualScore extends Score
{
    public function __toString()
    {
        $score = $this->getScore($this->player1->score);

        return $score ? $score . '-All' : 'Deuce';
    }
}

class EndgameScore extends Score
{
    public function __toString()
    {
        $diff = $this->player1->score - $this->player2->score;

        $name = $diff > 0 ? $this->player1->name : $this->player2->name;

        return (abs($diff) === 1 ? 'Advantage for ' : 'Win for ') . $name;
    }
}

class RegularScore extends Score
{
    public function __toString()
    {
        return $this->getScore($this->player1->score) .
            '-' . $this->getScore($this->player2->score);
    }
}

$player1 = new Player('player1', 6);
$player2 = new Player('player2', 2);

$tennisGame = new TennisGame();
echo $tennisGame->getScore($player1, $player2);
