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

    public static function getProbability(Player $playerA, Player $playerB) {
        $sub = bcsub($playerB->getPoints(),$playerA->getPoints());
        $exponent = bcdiv($sub, 400, 10);
       return "Probability ". $playerA->getName()." VS ".$playerB->getName()." is ".bcdiv(1, bcadd(1, pow(10, $exponent), 10), 10);
    }
}
