<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LobbyRepository::class)
 * @ApiResource(
 *     security="is_granted('ROLE_USER')",
 *     collectionOperations={
 *      "get" = {"normalization_context"={"groups"={"Match:Collection:Read"}}},
 *      "post"
 *     },
 * )
 */
class Lobby
{
  
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;
    /**
     * @ORM\OneToMany(targetEntity=Player::class)
     * @ORM\Column(type="json")
     */
    private $players = [];

    /**
     * @return int
     */
    public function getId(): ?int
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
     * @return Players
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * @param Player $players
     */
    public function setPlayers($players): void
    {
        $this->players = $players;
    }

    public function addPlayer(Player $player)
    {
       array_push($this->players, $player);
    }

    public function removePlayer(Player $player)
    {
        array_splice($this->players, array_search($this->players, $player));
    }

}
