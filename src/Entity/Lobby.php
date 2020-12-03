<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LobbyRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(security="is_granted('ROLE_USER','ROLE_ADMIN')")
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
     * @ORM\Column(type="array", nullable=true)
     */
    private $players = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayers(): ?array
    {
        return $this->players;
    }

    public function setPlayers(?array $players): self
    {
        $this->players = $players;

        return $this;
    }
}
