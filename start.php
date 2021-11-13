<?php

class TennisGame
{
    public $score = '';

    public function getScore($player1Name, $player2Name, $p1Score, $p2Score)
    {
        if ($p1Score == $p2Score) {
            switch ($p1Score) {
                case 0;
                    $this->score = 'Love-All';
                    break;
                case 1;
                    $this->score = 'Fifteen-All';
                    break;
                case 2;
                    $this->score = 'Thirty-All';
                    break;
                case 3;
                    $this->score = 'Forty-All';
                    break;
                default:
                    $this->score = 'Deuce';
            }
        } else if ($p1Score >= 4 || $p2Score >= 4) {
            $minusResult = $p1Score - $p2Score;
            if ($minusResult == 1) {
                $this->score = 'Advantage ' . $player1Name;
            } elseif ($minusResult == -1) {
                $this->score = 'Advantage ' . $player2Name;
            } elseif ($minusResult >= 2) {
                $this->score = 'Win for ' . $player1Name;
            } else {
                $this->score = 'Win for ' . $player2Name;
            }
        } else {
            for ($i = 1; $i < 3; $i++) {
                if ($i == 1) {
                    $tempScore = $p1Score;
                } else {
                    $this->score .= '-';
                    $tempScore = $p2Score;
                }
                switch ($tempScore)
                {
                    case 0;
                        $this->score .= 'Love';
                        break;
                    case 1;
                        $this->score .= 'Fifteen';
                        break;
                    case 2;
                        $this->score .= 'Thirty';
                        break;
                    case 3;
                        $this->score .= 'Forty';
                        break;
                }
            }
        }
    }
    
    public function __toString()
    {
        return $this->score;
    }
}


$tennisGame = new TennisGame();
$tennisGame->getScore('player1', 'player2', 2, 3);
echo $tennisGame;
