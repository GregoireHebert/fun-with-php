<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{

    private Player $p1;
    
    private Player $p2;

    public function __construct(Player $p1, Player $p2){
        $this->p1= $p1;
        $this->p2= $p2;
    }

    public function probabilityP1vP2() {
        return bcdiv(1, bcadd(1, pow(10, 
			bcdiv(bcsub($this->p2->getScore(), $this->p1->getScore()),400,10)
		),10),10);
    }

    public function probabilityP2vP1() {
        return bcdiv(1, bcadd(1, pow(10, 
			bcdiv(bcsub($this->p1->getScore(), $this->p2->getScore()),400,10)
		),10),10);
    }

    public function correctPlayersNewScore(int $winner){
        if($winner == 1){
            $this->p1->setScore($this->p1->getScore() + 32 * (1 - $this->probabilityP1vP2()));
			$this->p2->setScore($this->p2->getScore() + 32 * (0 - $this->probabilityP2vP1()));
		} else {
			$this->p1->setScore($this->p1->getScore() + 32 * (0 - $this->probabilityP1vP2()));
			$this->p2->setScore($this->p2->getScore() + 32 * (1 - $this->probabilityP2vP1()));
        }
    }


}