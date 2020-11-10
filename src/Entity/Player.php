<?php
include ('src/Entity/Level.php');

class Player {
    public string $_name;
    public float $_points = 1200;
    public Level $_level;

    public function __construct($playerName) {
        $this->_name = $playerName;
        $this->_level = new Level();
    }

    public function changeScore($matchResult, $probability): void {
        $this->_points = $this->_points + 32 * ($matchResult - $probability);
        $this->_level->checkPlayerLevel($this->_points, $this->_name);
    }

    public function getProbability($pointsOtherPlayer): float {
        return 1/(1+10**(($pointsOtherPlayer - $this->_points)/400));
    }

}

?>