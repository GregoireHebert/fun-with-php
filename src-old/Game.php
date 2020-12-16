<?php 

class Game{
    private $player1=null;
    private $player2=null;
    private $result1=null;
    private $result2=null;

    public function __construct($player1,$player2){
        $this->player1=$player1;
        $this->player2=$player2;
    }

    public function doGame($winner):void{
        
        if($winner==0){ // match nul
            $this->result1=0.5;
            $this->result2=0.5;
            echo "Match nul";
            
        }
        elseif ($winner==1) { // joueur 1 gagne
            $this->result1=1;
            $this->result2=0;
            echo $this->player1->getName()." a gagné contre ".$this->player2->getName();
            
        }
        elseif ($winner==2) { // joueur 2 gagne
            $this->result1=0;
            $this->result2=1;
            echo $this->player2->getName()." a gagné contre ".$this->player1->getName();
            
        }
        else{
            echo "Erreur dans le résultat du match";
            return;
        }

        $newLevelPlayer1=$this->newLevel($this->player1->getPoints(), $this->result1, $this->player1->probability($this->player2->getPoints()));
        $this->player1->setPoints($newLevelPlayer1);
        $newLevelPlayer2=$this->newLevel($this->player2->getPoints(), $this->$result2, $this->player2->probability($this->player1->getPoints()));
        $this->player2->setPoints($newLevelPlayer2);
    }

    private function newLevel($level,$result,$probability):float{
        return $level + 32 * ($result-$probability);
    }
}