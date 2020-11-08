<?php 

class Player{

    private $points=1200;

    public function __construct(){
        $this->points=1200;
    }

    public function getPoints(){
        return $this->points;
    }

    public function setPoints($points){
        $this->points=$points;
    }

}