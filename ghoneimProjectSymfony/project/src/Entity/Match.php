<?php

namespace game;

use App\Entity\Player;

require_once "Player.php";

class Match
{
    private Player $player1;
    private Player $player2;

    /**
     * @return Player
     */
    public function getPlayer1(): Player
    {
        return $this->player1;
    }

    /**
     * @param Player $player1
     */
    public function setPlayer1(Player $player1): void
    {
        $this->player1 = $player1;
    }

    /**
     * @return Player
     */
    public function getPlayer2(): Player
    {
        return $this->player2;
    }

    /**
     * @param Player $player2
     */
    public function setPlayer2(Player $player2): void
    {
        $this->player2 = $player2;
    }
}