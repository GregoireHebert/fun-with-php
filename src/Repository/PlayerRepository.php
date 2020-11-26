<?php

namespace App\Repository;

use App\Entity\Player;
use \App\Entity\BDDPlayer;

class PlayerRepository 
{
    private BDDPlayer $bdd;

    public function __construct(){
        $this->bdd = new BDDPlayer();
    }

    public function findPlayerById(int $id): Player
    {
        foreach ($this->bdd->getPlayers() as $player) {
            if ($player->getId() === $id) {
                return $player;
            }
        }
    }
}
