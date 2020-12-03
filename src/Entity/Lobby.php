<?php

namespace App\Entity;

use App\Repository\LobbyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LobbyRepository::class)
 */
class Lobby
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Player::class, mappedBy="lobby")
     */
    private $Players;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="lobby")
     */
    private $Games;

    public function __construct()
    {
        $this->Players = new ArrayCollection();
        $this->Games = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayers(): Collection
    {
        return $this->Players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->Players->contains($player)) {
            $this->Players[] = $player;
            $player->setLobby($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->Players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getLobby() === $this) {
                $player->setLobby(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGames(): Collection
    {
        return $this->Games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->Games->contains($game)) {
            $this->Games[] = $game;
            $game->setLobby($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->Games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getLobby() === $this) {
                $game->setLobby(null);
            }
        }

        return $this;
    }

    public function checkELO(Player $p1, Player $p2, int $dif) 
    {
        if($p1->ratio >= $p2->ratio-dif-1 && $p1->ratio < $p2->ratio+dif+1) 
        {
            return true;
        }
        return false;
    }
}
