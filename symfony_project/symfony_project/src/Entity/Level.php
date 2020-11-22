<?php

namespace App\Entity;

use App\Repository\LevelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LevelRepository::class)
 */
class Level
{


    private const DEFAULT_POINTS = 1200;
    
    private float $points;


    public function __construct()
    {
        $this->points = self::DEFAULT_POINTS;
    }

    
    public function getPoints(): float
    {
        return $this->points;
    }


    public function setPoints(float $points): void
    {
        $this->points = $points;
    }

    public function addPoints(float $points): void {
        $this->points += $points;
    }


    public function __toString() :String 
    {
        switch ($this->points) {
            case $this->points <= 1200 : 
               return $this->points." points : Debutant";
            case $this->points > 1200 && $this->points <= 2200 : 
                return $this->points." points : Averti";
            case $this->points > 2200 : 
                return $this->points." points : Expert";
            default:
                throw new UnexpectedValueException("!! Erreur lors du calcul du niveau !!");
           }
    }





}
