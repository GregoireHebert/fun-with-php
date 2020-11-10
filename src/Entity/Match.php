<?php

class Match {
    public $_player1;
    public $_player2;

    public function __construct($playera, $playerb) {
        $this->_player1 = $playera;
        $this->_player2 = $playerb;
    }

    /**
     * Random value : 1 -> player1 win, 2 -> player1 draw, 3 -> player1 lose
     * Return result of the match for player1
     */
    public function getMatchResult(): float {
        $random = random_int(1, 3);
        if($random == 1) {
            return 1.0;
        } else if($random == 2) {
            return 0.5;
        }
        return 0.0;
    }

    public function playMatch(): float {
        $result = $this->getMatchResult();
        echo("Match result for Player A: $result\n");
        $this->changePlayersScore($result);
        return $result;
    }

    public function changePlayersScore($matchResultForPlayer1): void {
        $this->_player1->changeScore($matchResultForPlayer1, $this->_player1->getProbability($this->_player2->_points));
        $this->_player2->changeScore(1.0 - $matchResultForPlayer1, $this->_player2->getProbability($this->_player1->_points));
    }

}

?>