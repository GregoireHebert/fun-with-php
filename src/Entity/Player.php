<?php

class Player
{
    public const DEFAULT_POINTS = 1200;
    private float $points;
    private string $name;

    public function __construct(string $name)
    {
        $this->points = self::DEFAULT_POINTS;
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
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
