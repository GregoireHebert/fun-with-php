<?php

namespace App\Entity;

class Match {
    public Player $_player1;
    public Player $_player2;

    public function __construct($playera, $playerb) {
        $this->_player1 = $playera;
        $this->_player2 = $playerb;
    }

    /**
     * Random value : 1 -> player1 win, 2 -> player1 draw, 3 -> player1 lose
     * Return result of the match for player1
     */
    public function getMatchResult(): float {
        $rand_array = array(1.0, 0.5, 0.0);
        return $rand_array[array_rand($rand_array, 1)];
    }

    public function playMatch(): float {
        $result = $this->getMatchResult();
        $this->changePlayersScore($result);
        return $result;
    }

    public function changePlayersScore($matchResultForPlayer1): void {
        $this->_player1->changeScore($matchResultForPlayer1, $this->_player1->getProbability($this->_player2->_points));
        $this->_player2->changeScore(1.0 - $matchResultForPlayer1, $this->_player2->getProbability($this->_player1->_points));
    }

}

?>