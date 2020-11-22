<?php

require("levelManager.php");

class Player 
{

    public string $name;

    private float $points;

    public function __construct(string $name , float $points) {
        $this->name = $name;
        $this->points = $points;

      }


     public function getName() : string{
       return  $this->name;
     } 



     public function getPoints() : float{
      return  $this->points;
    } 

 
    public function setPoints(float $points) : void{
        $this->points = $points;
    } 


    public function fixLevel($value) : void{
      $this->setPoints( bcadd($this->points , bcmul(32,$value,5),5));
    }



    public function __toString() : string{
      return $this->name." avec un ratio de ".$this->points.", est un joueur ".LevelManager::getLevel($this->points)."\n"; 
    }

    

     


    
}