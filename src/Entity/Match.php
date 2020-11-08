<?php
require_once "Player.php";

class Match
{
    public const WIN = 1;
    public const DRAW = 0.5;
    public const LOSE = 0;

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

    public function matchOutcome(?Player $winner): void {
        $player1 = $this->getPlayer1();
        $player2 = $this->getPlayer2();
        if($winner === null) {
            $player1->addPoints($this->getPointsChangeFromResult(self::DRAW, Probability::getProbability($player1, $player2)));
            $player2->addPoints($this->getPointsChangeFromResult(self::DRAW, Probability::getProbability($player2, $player1)));
            return;
        }
        $loser = $player1 === $winner ? $player2 : $player1;
        $winner->addPoints($this->getPointsChangeFromResult(self::WIN, Probability::getProbability($winner, $loser)));
        $loser->addPoints($this->getPointsChangeFromResult(self::LOSE, Probability::getProbability($loser, $winner)));
    }


}