<?php


class Probability
{
    public static function getProbability(Player $playerA, Player $playerB): float
    {
        $exponent = bcdiv(bcsub($playerB->getPoints(),$playerA->getPoints()), 400, 15);
        return bcdiv(1, bcadd(1, pow(10, $exponent), 10), 15);
    }
}