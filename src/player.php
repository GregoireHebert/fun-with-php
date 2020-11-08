<?php

require("levelManager.php");

class Player 
{
    /**
     * nom du joueur
     */
    public string $name;


    /**
     * nombre de points du joueurs
     */
    private float $points;

    public function __construct(string $name , float $points) {
        $this->name = $name;
        $this->points = $points;

      }

      /**
       * renvoie le nom du joueur
       */
     public function getName() : string{
       return  $this->name;
     } 


     /**
      * renvoie les points du joueur
      */
     public function getPoints() : float{
      return  $this->points;
    } 

    /**
     * modifier les points du joueur
     */
    public function setPoints(float $points) : void{
        $this->points = $points;
    } 

    /**
     * corrige le niveau du joueur
     * param $value : (1 - prob) si le joueur a gagner (0 - prob) sinon
     */
    public function fixLevel($value) : void{

      $res = bcadd($this->points , bcmul(32,$value,5),5);
      $this->setPoints($res);
    }

    /**
     * renvoie la description du joueur
     */
    public function toString() : string{
      return $this->name." avec un ratio de ".$this->points.", est un joueur ".LevelManager::getLevel($this->points)."\n"; 
    }

    

     


    
}