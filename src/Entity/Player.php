<?php

namespace App\Entity;

Class Player
{
    private int $id;
    private float $rank;
    private string $username;

    function __construct(int $id, string $username, float $rank) {
        $this->id = $id;
        $this->username = $username;
        $this->rank = $rank;
    }

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
    public function getRank(): float
    {
        return $this->rank;
    }

    /**
     * @param float $points
     */
    public function setRank(float $rank): void
    {
        $this->rank = $rank;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $name
     */
    public function setUsername(string $name): void
    {
        $this->username = $username;
    }

    public function __toString(): string {
        return nl2br("Player [" . $this->getUsername() . "] has [" . $this->getPoints() . "] points.\n");
    }

}