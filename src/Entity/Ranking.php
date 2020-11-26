<?php

namespace App\Entity;

use App\Repository\RankingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RankingRepository::class)
 */
class Ranking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $points;

    public const DEFAULT_POINTS = 1200;

    public function __construct()
    {
        $this->points = self::DEFAULT_POINTS;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoints(): ?float
    {
        return $this->points;
    }

    public function setPoints(float $points): self
    {
        $this->points = $points;

        return $this;
    }
}
