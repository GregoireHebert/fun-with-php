<?php

 namespace App\Entity;
 
 class Player {
     
    private $name;

    private $level;
    
    function __construct($name, $level) {
        $this->name = $name; 
        $this->level = $level; 
      }
     
     public function setName($name){
         $this->name = $name;
     }
    
     public function getName(){
         return $this->name;
     }

     public function setLevel($level){
        $this->level = $level;
    }
    
   
    public function getLevel(){
        return $this->level;
    }

    public function probaTowin($playerB){
        if ($playerB instanceof Player){
            $ra = $this->level;
            $rb = $playerB->level;
            return 1 / ( 1 + 10 ** (($rb - $ra) / 400 ));
        } else {
            echo "Is not instanceof Player";
        }         
    }

    public function updateLevel($point, $probaToWin){
        $this->setLevel($this->level + 32 * ($point - $probaToWin));
    }
    
    public function winAgainst($playerB){
        $this->updateLevel(1, $this->probaTowin($playerB));
    }

    public function lostAgainst($playerB){
        $this->updateLevel(0, $this->probaTowin($playerB));
    }

    public function drawAgainst($playerB){
        $this->updateLevel(0.5, $this->probaTowin($playerB));
    }
 }

?>