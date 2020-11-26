<?php

namespace App\Entity;

use App\Repository\ProbabilityRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProbabilityRepository::class)
 */
class Probability
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

    public static function getProbability(Player $playerA, Player $playerB): float
    {
        $exponent = bcdiv(bcsub($playerB->getPoints(),$playerA->getPoints()), 400, 15);
        return bcdiv(1, bcadd(1, pow(10, $exponent), 10), 15);
    }
}
