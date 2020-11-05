<?php

class Player
{
    public const DEFAULT_POINTS = 1200;
    private $name;
    private $points;

    public function __construct(string $name) {
    		$this->name = $name;
            $this->points = self::DEFAULT_POINTS;
    }

    public function getName() {
		return $this->name;
	}

	public function getPoints() {
		return $this->points;
	}

	public function setPoints($points){
            $this->points = $points;
    }

}