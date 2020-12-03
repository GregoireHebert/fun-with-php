<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LobbyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
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
    private $Player;

    public function __construct()
    {
        $this->Player = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Player[]
     */
    public function getPlayer(): Collection
    {
        return $this->Player;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->Player->contains($player)) {
            $this->Player[] = $player;
            $player->setLobby($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->Player->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getLobby() === $this) {
                $player->setLobby(null);
            }
        }

        return $this;
    }
}
