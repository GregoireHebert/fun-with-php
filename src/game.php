<?php

require("player.php");

class Game {



    private Player $player1;
    private Player $player2;



    public function __construct(Player $player1, Player $player2 ) {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    /**
     * renvoie la probabilité de player1 face à player2
     */
    public function getGameProbabilityP1VsP2() : float {
        return bcdiv(1, bcadd(1, pow(10, 
        bcdiv(bcsub($this->player2->getPoints(), $this->player1->getPoints(),16), 400, 16)
    ), 16), 16); 
    }

    /**
     * renvoie la probabilité de player 2 face à player 1
     */
    public function getGameProbabilityP2VsP1() : float {
        return bcdiv(1, bcadd(1, pow(10, 
        bcdiv(bcsub($this->player1->getPoints(), $this->player2->getPoints(),16), 400, 16)
    ), 16), 16); 
    }
    
    /**
     * corriger le niveau des joueurs
     */
    public function fixPlayersLevel(int $result) : void{
        if($result == 1){
            $valueA = bcsub($result , $this->getGameProbabilityP1VsP2(),5);
            $valueB = bcsub( 0 ,bcsub($result , $this->getGameProbabilityP1VsP2(),16),5);
        }
        else{
            $valueA = bcsub(0,bcsub($result , $this->getGameProbabilityP2VsP1(),16),5);
            $valueB = bcsub($result , $this->getGameProbabilityP2VsP1(),5);    
        }

        $this->player1->fixLevel($valueA);
        $this->player2->fixLevel($valueB);
    }
}