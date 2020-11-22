<?php

namespace App\Repository\Impl;

use App\Entity\SingletonPlayers;
use \App\Repository\PlayerRepository;
use \App\Entity\Player;

class PlayerRepositoryImpl implements PlayerRepository
{

    public function findPlayerById(int $id): Player
    {
        foreach (SingletonPlayers::getInstance()->getPlayers() as $player) {
            if ($player->getId() === $id) {
                return $player;
            }
        }
    }

    public function findWinPropability(int $id1, int $id2)
    {
        $player1 = $this->findPlayerById($id1);
        $player2 = $this->findPlayerById($id2);
        $pow = ($player2->getPoints() - $player1->getPoints()) / 400;
        return 1 / (1 + pow(10, $pow));
    }

    public function updatePoints(Player $player, float $result, float $prob): void {
        $player->setPoints($player->getPoints() + 32 * ($result - $prob));
    }

}