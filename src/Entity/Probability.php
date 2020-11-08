<?php


class Probability
{

    public function getProbability(Player $playerA, Player $playerB) {
        $sub = bcsub($playerB->getPoints(),$playerA->getPoints());
        $exponent = bcdiv($sub, 400, 10);
        return bcdiv(1, bcadd(1, pow(10, $exponent), 10), 10);
    }
}
