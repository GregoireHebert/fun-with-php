<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 * @ORM\Table(name="games")
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $player1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $player2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $result;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer1(): ?int
    {
        return $this->player1;
    }

    public function setPlayer1(?int $player1): self
    {
        $this->player1 = $player1;

        return $this;
    }

    public function getPlayer2(): ?int
    {
        return $this->player2;
    }

    public function setPlayer2(?int $player2): self
    {
        $this->player2 = $player2;

        return $this;
    }

    public function getResult(): ?int
    {
        return $this->result;
    }

    public function setResult(?int $result): self
    {
        $this->result = $result;

        return $this;
    }
}
