<?php

namespace App\Entity;

class BDDPlayer 
{

    private $players;
    private Player $A;
    private Player $B;
    private Player $C;
    private Player $D;

    public function __construct() 
    {
        $this->A = new Player(1,"A", 1700);
        $this->B = new Player(2,"B", 2500);
        $this->C = new Player(3,"C", 1200);
        $this->D = new Player(4,"D", 1800);

        $this->players = array($this->A, $this->B, $this->C, $this->D);
    }

    public function getPlayers() 
    {
        return $this->players;
    }
}