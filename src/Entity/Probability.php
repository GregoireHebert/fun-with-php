<?php


class Probability
{

    public function getProbability(Player $playerA, Player $playerB) {
        return 1 / (1 + (pow(10,($playerB->getPoints() - $playerA->getPoints()) /400)));
    }
}
