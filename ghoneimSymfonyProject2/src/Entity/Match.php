<?php

namespace App\Entity;

use App\Repository\MatchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatchRepository::class)
 * @ORM\Table(name="`match`")
 */
class Match
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Player::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $player1;

    /**
     * @ORM\OneToOne(targetEntity=Player::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $player2;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer1(): ?Player
    {
        return $this->player1;
    }

    public function setPlayer1(Player $player1): self
    {
        $this->player1 = $player1;

        return $this;
    }

    public function getPlayer2(): ?Player
    {
        return $this->player2;
    }

    public function setPlayer2(Player $player2): self
    {
        $this->player2 = $player2;

        return $this;
    }

}
