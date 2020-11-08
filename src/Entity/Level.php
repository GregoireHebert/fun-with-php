<?php


class Level
{
    public function newLevel(Player $player ,$res, $proba) {
        $substract = bcsub($res, $proba, 5);
        $mul = bcmul(32, $substract, 5);
        return bcadd($player->getPoints(), $mul, 5);

    }
}