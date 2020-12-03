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
    private $players;

     /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="lobby")
     */
    private $games;

    /**
     * @ORM\Column(type="string", length=180)
     */
    private $status = Player::RATIO_DEBUTANT;

    

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->games = new ArrayCollection();
    }


    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getName(): string
    {
        return (string) $this->name;
    }

    public function setName(string $username): self
    {
        $this->name = $username;

        return $this;
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
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setLobby($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
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
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
            $game->setLobby($this);
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        if ($this->games->removeElement($game)) {
            // set the owning side to null (unless already changed)
            if ($game->getLobby() === $this) {
                $game->setLobby(null);
            }
        }

        return $this;
    }
}
