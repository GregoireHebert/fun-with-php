<?php


class Probability
{
    public static function getProbability(Player $playerA, Player $playerB): float
    {
        $probability = fn(float $x, float $y) => 1 / (1 + (pow(10, (($y - $x) / 400))));
        return $probability($playerA->getPoints(), $playerB->getPoints());
    }
}