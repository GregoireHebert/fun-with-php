<?php


namespace App\Entity;


class Game
{
    public Player $player1;
    public Player $player2;

    function __construct(Player $player1,Player $player2)
    {
        $this->player1=$player1;
        $this->player2=$player2;
    }

    function probaPlayer1()
    {
        $exposant = ($this->getPlayer2()->getLevel()
                -$this->getPlayer1()->getLevel())/400;
        $division = 1+(10**$exposant);
        return 1/$division;

    }

    function probaPlayer2()
    {
        $exposant = ($this->getPlayer1()->getLevel()
                -$this->getPlayer2()->getLevel())/400;
        $division = 1+(10**$exposant);
        return 1/$division;
    }

    /**
     * @return Player
     */
    public function getPlayer1()
    {
        return $this->player1;
    }

    /**
     * @param Player $player1
     */
    public function setPlayer1(Player $player1)
    {
        $this->player1 = $player1;
    }

    /**
     * @return Player
     */
    public function getPlayer2()
    {
        return $this->player2;
    }

    /**
     * @param Player $player2
     */
    public function setPlayer2(Player $player2)
    {
        $this->player2 = $player2;
    }

    public function correctLevel(Player $winner){
        $level2 = $this->player2->getLevel();
        $level1= $this->player1->getLevel();
        $level1res=0.0;
        $level2res=0.0;
        if($winner===$this->player1){
            $level1res=$level1+32*(1-$this->probaPlayer1());
            $level2res=$level2+32*(0-$this->probaPlayer2());
        }
        elseif ($winner===$this.$this->player2){
            $level1res=$level1+32*(0-$this->probaPlayer1());
            $level2res=$level2+32*(1-$this->probaPlayer2());
        }
        else{
            $level1res=$level1+32*(0.5-$this->probaPlayer1());
            $level2res=$level2+32*(0.5-$this->probaPlayer2());
        }
        $this->player2->setLevel($level2res);
        $this->player1->setLevel($level1res);
    }
}