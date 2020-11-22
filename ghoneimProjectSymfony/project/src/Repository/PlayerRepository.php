<?php

namespace App\Repository;

use App\Entity\Player;

interface PlayerRepository
{
    public function findPlayerById(int $id);

    public function findWinPropability(int $id1, int $id2);

    public function updatePoints(Player $player, float $result, float $prob): void;

}