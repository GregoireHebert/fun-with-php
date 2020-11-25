<?php

require("player.php");

class Game {



    private Player $player1;
    private Player $player2;



    public function __construct(Player $player1, Player $player2 ) {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }


    public function getGameProbabilityP1VsP2() : float {
        return bcdiv(1, bcadd(1, pow(10, 
        bcdiv(bcsub($this->player2->getPoints(), $this->player1->getPoints(),16), 400, 16)
    ), 16), 16); 
    }


    public function getGameProbabilityP2VsP1() : float {
        return bcdiv(1, bcadd(1, pow(10, 
        bcdiv(bcsub($this->player1->getPoints(), $this->player2->getPoints(),16), 400, 16)
    ), 16), 16); 
    }
    

    public function fixPlayersLevel(int $result) : void{
        if($result == 1){
            $this->player1->fixLevel(bcsub($result , $this->getGameProbabilityP1VsP2(),5));
            $this->player2->fixLevel(bcsub( 0 ,bcsub($result , $this->getGameProbabilityP1VsP2(),16),5));
        }
        else{
            $this->player1->fixLevel(bcsub(0,bcsub($result , $this->getGameProbabilityP2VsP1(),16),5));
            $this->player2->fixLevel(bcsub($result , $this->getGameProbabilityP2VsP1(),5));    
        }
    }
}