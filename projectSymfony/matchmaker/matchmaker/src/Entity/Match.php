<?php

namespace App\Entity;

use App\Entity\Player;

class Match
{
    private Player $playerA;
    private Player $playerB;

    function __construct(Player $player1, Player $player2){
        $this->playerA = $player1;
        $this->playerB = $player2;
    }

    /**
     * @return Player
     */
    public function getPlayerA(): Player
    {
        return $this->playerA;
    }

    /**
     * @param Player $player1
     */
    public function setPlayerA(Player $player1): void
    {
        $this->playerA = $playerA;
    }

    /**
     * @return Player
     */
    public function getPlayerB(): Player
    {
        return $this->playerB;
    }

    /**
     * @param Player $playerB
     */
    public function setPlayerB(Player $playerB): void
    {
        $this->playerB = $playerB;
    }

    public function get_proba(){
        return (1/ (1 + pow(10, (($this->playerB->getRank() - $this->playerA->getRank())/400))));
    }

    public function endMatch(int $winner){
        if ($winner == 1) {
            $this->playerA->setRank($this->playerA->getRank() + 32 * (1 - $this->get_proba()));
            $this->playerB->setRank($this->playerB->getRank() + 32 * (0 - (1-$this->get_proba())));
        } else {
            $this->playerA->setRank($this->playerA->getRank() + 32 * (0 - $this->get_proba()));
            $this->playerB->setRank($this->playerB->getRank() + 32 * (1 - (1-$this->get_proba())));
        }
    }
}
