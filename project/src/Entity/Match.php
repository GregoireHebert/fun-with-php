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

    public const Win = 1;
    public const Lose = 0;
    public const Draw = 0.5;

    public function getId(): ?int
    {
        return $this->id;
    }

    public static function calculProba($jA, $jB): float {
        return 1/(1+pow(10,($jA->getElo()-$jB->getElo())/400));
    }

    public function __construct($jA, $jB) {
        $result = $this->calculProba($jA, $jB);
        if ($result > 0.5) {
            echo "Victoire de ".$jA->getName().PHP_EOL;
            //correction du elo
            $new_elo_A = $jA->getElo();
            $new_elo_A += 32*(self::Win-$result); 
            $jA->setElo($new_elo_A);
            $new_elo_B = $jB->getElo();
            $new_elo_B += 32*(self::Lose-(1-$result));
            $jB->setElo($new_elo_B);//on inverse la proba avec 1-$result
        } elseif ($result < 0.5) {
            echo "Victoire de ".$jB->getName().PHP_EOL;
            //correction du elo
            $new_elo_B = $jB->getElo();
            $new_elo_B += 32*(self::Win-$result); 
            $jB->setElo($new_elo_B);
            $new_elo_A = $jA->getElo();
            $new_elo_A += 32*(self::Lose-(1-$result));
            $jA->setElo($new_elo_A);//on inverse la proba avec 1-$result
        } else {
            echo "Egalité de ".$jA->getName()." et de ".$jB->getName().PHP_EOL;
            //correction du elo
            $new_elo_A = $jA->getElo();
            $new_elo_A += 32*(self::Draw-$result);
            $jA->setElo($new_elo_A);

            $new_elo_B = $jB->getElo();
            $new_elo_B += 32*(self::Draw-$result);
            $jB->setElo($new_elo_B);
        }
        echo $result.PHP_EOL;
    }
}
