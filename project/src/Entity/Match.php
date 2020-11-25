<?php

require "Player.php";

class Match{
    private Player $playerA;
    private Player $playerB;

    function __construct(Player $player1, Player $player2){
        $this->playerA = $player1;
        $this->playerB = $player2;
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

?> 