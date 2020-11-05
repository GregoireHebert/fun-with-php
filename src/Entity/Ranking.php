<?php


class Ranking
{
    public const DEFAULT_POINTS = 1200;
    private float $points;

    public function __construct()
    {
        $this->points = self::DEFAULT_POINTS;
    }

    public function getPoints(): float
    {
        return $this->points;
    }

    public function setPoints(float $points): void
    {
        $this->points = $points;
    }
}