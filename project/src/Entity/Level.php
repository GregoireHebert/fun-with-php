<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LevelRepository::class)
 */
class Level
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function newLevel(Player $player ,$res, $proba) {
        $substract = bcsub($res, $proba, 5);
        $mul = bcmul(32, $substract, 5);
        return bcadd($player->getPoints(), $mul, 5);

    }
}
