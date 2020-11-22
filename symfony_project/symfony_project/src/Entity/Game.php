<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{

    private Player $player1;
    private Player $player2;
    public const WIN = 1;
    public const DRAW = 0.5;
    public const LOSE = 0;

    public function __construct(Player $player1, Player $player2 ) {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }


    public static function getProbability(Player $playerA, Player $playerB): float
 
    {
        return bcdiv(1, bcadd(1, pow(10, bcdiv(bcsub($playerB->getLevel()->getPoints(),$playerA->getLevel()->getPoints()), 400, 16) ), 16), 16);
    }


    
    function getResultPoints(float $result, float $probability): float {
        return bcmul(32 , bcsub($result , $probability,5),5);
    }


    public function finish(?Player $winner): void {

        if($winner === null) {
            $this->player1->getLevel()->addPoints($this->getResultPoints(self::DRAW, self::getProbability($this->player1, $this->player2)));
            $this->player2->getLevel()->addPoints($this->getResultPoints(self::DRAW, self::getProbability($this->player2,$this->player1)));
            return;
        }
        $loser = $this->player1 === $winner ? $this->player2 : $this->player1;
        $winner->getLevel()->addPoints($this->getResultPoints(self::WIN, self::getProbability($winner, $loser)));
        $loser->getLevel()->addPoints($this->getResultPoints(self::LOSE, self::getProbability($loser, $winner)));
    }


    

    public function __toString() : string{
        return  "Game ".$this->player1->getName()." VS ".$this->player2->getName()." : probabilité de Joueur ".$this->player1->getName()." face au Joueur ".$this->player2->getName()." : ".self::getProbability($this->player1, $this->player2)
        ."  -----  probabilité de Joueur ".$this->player2->getName()." face au Joueur ".$this->player1->getName()." : ".self::getProbability($this->player2, $this->player1);    
    }


}
