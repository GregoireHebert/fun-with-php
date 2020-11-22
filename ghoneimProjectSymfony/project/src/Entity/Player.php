<?php

namespace App\Entity;

Class Player
{
    private int $id;
    private float $points;
    private string $name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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

    public function __toString(): string {
        return nl2br("Player [" . $this->getName() . "] has [" . $this->getPoints() . "] points.\n");
    }

}
