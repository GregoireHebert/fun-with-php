<?php


class Level
{
    public function newLevel($pointPlayer,$res, $proba) {
        return $pointPlayer + 32 * ($res - $proba);

    }
}