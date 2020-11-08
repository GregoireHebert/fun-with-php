<?php


class Level
{
    public function newLevel(Player $player ,$res, $proba) {
        return $player->getPoints() + 32 * ($res - $proba);

    }
}