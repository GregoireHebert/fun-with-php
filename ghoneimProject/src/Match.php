<?php
namespace toto;
require_once "Player.php";

Class Match {


    public function __construct() {

    }

    public function play(Player $player1, Player $player2): void {
        $prob = $player1->getWinProbability($player2);
        echo ("The match started between player [" . $player1->getName() ."] and player [". $player2->getName() . "]. With a win probability equal to [" . $prob . "] for player [" . $player1->getName() . "].<br>");
        $r = mt_rand() / mt_getrandmax();
        if ($r < $prob) {
            echo ("Player " . $player1->getName() . " win the match <br>");
            $player1->updatePoints(1, $prob);
            $player2->updatePoints(0, $prob);
        } else if ($r > $prob) {
            echo ("Player " . $player2->getName() . " win the match <br>");
            $player1->updatePoints(0, $prob);
            $player2->updatePoints(1, $prob);
        } else {
            echo ("Draw <br>");
            $player1->updatePoints(0.5, $prob);
            $player2->updatePoints(0.5, $prob);
        }
    }
}
