<?php
require "Ranking.php";

class Player
{
    public const DEFAULT_POINTS = 1200;
    private Ranking $ranking;
    private string $name;

    public function __construct(string $name)
    {
        $this->ranking = new Ranking();
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPoints(): float
    {
        return $this->ranking->getPoints();
    }

    public function setPoints(float $points): void
    {
        $this->ranking->setPoints($points);
    }
}
