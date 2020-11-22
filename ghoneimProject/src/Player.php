<?php

namespace toto;

Class Player
{
    private float $points;
    private string $name;


    public function __construct(float $points, string $name)
    {
        $this->points = $points;
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getPoints(): float
    {
        return $this->points;
    }

    /**
     * @param float $points
     */
    public function setPoints(float $points): void
    {
        $this->points = $points;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getWinProbability(Player $player): float {
        $pow = ($player->getPoints() - $this->points) / 400;
        return 1 / (1 + pow(10, $pow));
    }

    public function updatePoints(float $result, float $prob): void {
        $this->points = $this->points + 32 * ($result - $prob);
    }

    public function __toString(): string {
        return nl2br("Player [" . $this->getName() . "] has [" . $this->getPoints() . "] points.\n");
    }

}

