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
        return (1/ (1 + pow(10, (($this->playerB->getPoints() - $this->playerA->getPoints())/400))));
    }


    public function endMatch(int $winner){
        if ($winner == 1){
            $this->playerA->setPoints($this->playerA->getPoints() + 32 * (1 - $this->get_proba()));
            $this->playerB->setPoints($this->playerB->getPoints() + 32 * (0 - (1-$this->get_proba())));
        }
        else {
            $this->playerA->setPoints($this->playerA->getPoints() + 32 * (0 - $this->get_proba()));
            $this->playerB->setPoints($this->playerB->getPoints() + 32 * (1 - (1-$this->get_proba())));
        }
    }
}

?> 