<?php

namespace App\Entity;

use App\Repository\MatchRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Joueur;
/**
 * @ORM\Entity(repositoryClass=MatchRepository::class)
 * @ORM\Table(name="`match`")
 */
class Match
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    private const Win = 1;
    private const Lose = 0;
    private const Draw = 0.5;

    public function getId(): ?int
    {
        return $this->id;
    }

    public static function calculProba($jA, $jB): float {
        return 1/(1+pow(10,($jA->elo-$jB->elo)/400));
    }

    public function __construct($jA, $jB) {
        $result = calculProba($jA, $jB);
        if ($result > 0.5) {
            echo "Victoire de ".$jA->name.PHP_EOL;
            //correction du elo
            $jA.setElo($jA->elo += 32*($Win-$result));
            $jB.setElo($jB->elo += 32*($Lose-(1-$result)));//on inverse la proba avec 1-$result
        } elseif ($result < 0.5) {
            echo "Victoire de ".$jB->name.PHP_EOL;
            //correction du elo
            $jB.setElo($jB->elo += 32*($Win-$result));
            $jA.setElo($jA->elo += 32*($Lose-(1-$result)));//on inverse la proba avec 1-$result
        } else {
            echo "Egalité de ".$jA->name." et de ".$jB->name.PHP_EOL;
            //correction du elo
            $jA.setElo($jA->elo += 32*($Draw-$result));
            $jB.setElo($jB->elo += 32*($Draw-$result));
        }
        echo $result.PHP_EOL;
    }
}
