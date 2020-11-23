<?php
namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */

 class Player {
    private string $name;
    private float $score;

    public function __construct(string $name,float $score){
        $this->name = $name;
        $this->score = $score;
    }

    public function getName(){
        return $this->name;
    }

    public function setName(string $name){
        $this->name = $name;
    }

    public function getScore(){
        return $this->score;
    }

    public function setScore(float $score){
        $this->score = $score;
    }

 }