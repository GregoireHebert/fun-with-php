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

    private $joueurA;
    private $joueurB;

    public const Win = 1;
    public const Lose = 0;
    public const Draw = 0.5;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __construct($jA, $jB) {
        $this->joueurA = $jA;
        $this->joueurB = $jB;
    }

    public function playMatch(): string{
        $result = 1/(1+pow(10,($this->joueurA->getElo()-$this->joueurB->getElo())/400));

        if ($result > 0.5) {
            //correction du elo
            $new_elo_A = $this->joueurA->getElo();
            $new_elo_A += 32*(self::Win-$result);
            $this->joueurA->setElo($new_elo_A);

            $new_elo_B = $this->joueurB->getElo();
            $new_elo_B += 32*(self::Lose-(1-$result));
            $this->joueurB->setElo($new_elo_B);//on inverse la proba avec 1-$result
            
            return sprintf('Victoire de %s nouveau elo : %d points, défaite de  %s nouveau elo %d points', $this->joueurA->getName(), $this->joueurA->getElo(), 
            $this->joueurB->getName(), $this->joueurB->getElo()).PHP_EOL;
        } elseif ($result < 0.5) {
            //correction du elo
            $new_elo_B = $this->joueurB->getElo();
            $new_elo_B += 32*(self::Win-$result); 
            $this->joueurB->setElo($new_elo_B);

            $new_elo_A = $this->joueurA->getElo();
            $new_elo_A += 32*(self::Lose-(1-$result));
            $this->joueurA->setElo($new_elo_A);//on inverse la proba avec 1-$result
            
            return sprintf('Victoire de %s nouveau un elo : %d points, défaite de  %s nouveau elo : %d points', $this->joueurB->getName(), $this->joueurB->getElo(), 
            $this->joueurA->getName(), $this->joueurA->getElo()).PHP_EOL;
        } else {
            //correction du elo
            $new_elo_A = $this->joueurA->getElo();
            $new_elo_A += 32*(self::Draw-$result);
            $this->joueurA->setElo($new_elo_A);

            $new_elo_B = $this->joueurB->getElo();
            $new_elo_B += 32*(self::Draw-$result);
            $this->joueurB->setElo($new_elo_B);
            return sprintf('Match nul, %s nouveau elo : %d points et %s nouveau elo %d points', $this->joueurA->getName(), $this->joueurA->getElo(), $this->joueurB->getName(), $this->joueurB->getElo()).PHP_EOL;
        }
        return sprintf('ERREUR DANS LE CALCUL DES PROBABILITES');
    }

    public function __toString(): string {
        return sprintf('Le match oppose %s avec un elo de %d contre %s avec un elo de %d', $this->joueurA->getName(), $this->joueurA->getElo(), 
            $this->joueurB->getName(), $this->joueurB->getElo()).PHP_EOL;
    }
}
