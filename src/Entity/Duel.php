<?php

namespace App\Entity;

use App\Repository\DuelRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DuelRepository::class)
 */
class Duel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="duels1")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player1;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="duels2")
     * @ORM\JoinColumn(nullable=false)
     */
    private $player2;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $result;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer1(): ?Player
    {
        return $this->player1;
    }

    public function setPlayer1(?Player $player1): self
    {
        $this->player1 = $player1;

        return $this;
    }

    public function getPlayer2(): ?Player
    {
        return $this->player2;
    }

    public function setPlayer2(?Player $player2): self
    {
        $this->player2 = $player2;

        return $this;
    }

    public function getResult(): ?string
    {
        return $this->result;
    }

    public function setResult(?string $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function updateRatings(): void {
        $r1 = $this->player1->getElo();
        $r2 = $this->player2->getElo();

        $scores = array_map('intval', explode('-', $this->result));
        $p1 = 1/(1+pow(10, ($r1 - $r2) / 400));
        $p2 = 1/(1+pow(10, ($r2 - $r1) / 400));

        $this->player1->setElo($r1 + 32 * ($scores[0]))
    }
}
