<?php 

class Player{

    private const DEFAULT_POINTS = 1200;
    private $points=1200;
    private $name=null;

    public function __construct($name){
        $this->points=self::DEFAULT_POINTS;
        $this->name=$name;
    }

    public function getPoints():int{
        return $this->points;
    }

    public function setPoints($points):void{
        $this->points=$points;
    }
}