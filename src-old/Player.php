<?php 

class Player{

    private const DEFAULT_POINTS = 1200;
    private $points=self::DEFAULT_POINTS;
    private $name=null;

    public function __construct($name){
        $this->name=$name;
    }

    public function getPoints():float{
        return $this->points;
    }

    public function setPoints($points):void{
        $this->points=$points;
    }

    public function getName():String{
        return $this->name;
    }

    public function setName($name):void{
        $this->name=$name;
    }

    public function probability($opponentPoints):float{
        return 1/(1+(10**(($opponentPoints - $this->getPoints())/400)));
    }
}