<?php
require "Player.php";

class Match
{

    private Player $player1;
    private Player $player2;

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    function getPlayer1(): Player {
        return $this->player1;
    }

    function getPlayer2(): Player {
        return $this->player2;
    }

    function getPointsChangeFromResult(float $result, float $probability): float {
        return 32 * ($result - $probability);
    }

    public function matchOutcome(string $result): void {
        $player1 = $this->getPlayer1();
        $player2 = $this->getPlayer2();
        if(strcmp($result,"draw") == 0) {
            $player1->addPoints($this->getPointsChangeFromResult(0.5, Probability::getProbability($player1, $player2)));
            $player2->addPoints($this->getPointsChangeFromResult(0.5, Probability::getProbability($player2, $player1)));
        } else if(strcmp($result,"win1") == 0) {
            $player1->addPoints($this->getPointsChangeFromResult(1, Probability::getProbability($player1, $player2)));
            $player2->addPoints($this->getPointsChangeFromResult(0, Probability::getProbability($player2, $player1)));
        } else if(strcmp($result,"win2") == 0) {
            $player1->addPoints($this->getPointsChangeFromResult(0, Probability::getProbability($player1, $player2)));
            $player2->addPoints($this->getPointsChangeFromResult(1, Probability::getProbability($player2, $player1)));
        }
    }


}