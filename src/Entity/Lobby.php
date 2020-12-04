<?php

namespace App\Entity;

use App\Repository\LobbyRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LobbyRepository::class)
 * @ApiResource(
 *     security="is_granted('ROLE_USER')",
 *     collectionOperations={
 *      "get" = {"normalization_context"={"groups"={"Lobby:Collection:Read"}}},
 *      "post"
 *     },
 *     itemOperations={
 *          "get",
 *          "put" = {"security"="is_granted('ROLE_ADMIN')"},
 *          "delete" = {"security"="is_granted('ROLE_ADMIN')"},
 *     }
 * )
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
     * @ORM\Column(name="all_players", type="array", nullable=true)
     */
    private $allPlayers;

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    public function getAllPlayers()
    {
        return $this->allPlayers;
    }/**
     * @param mixed $allPlayers
     */
    public function setAllPlayers($allPlayers): void
    {
        $this->allPlayers = $allPlayers;
    }

    public function addPlayer($player):void
    {
        array_push($this->allPlayers,$player);
    }

    public function removePlayer($player):void
    {
        if (in_array($player, $this->allPlayers))
        {
            unset($this->allPlayers[array_search($player,$this->allPlayers)]);
        }
    }

    public function okMatch($player1,$player2,$pas) : bool
    {
        $res = $player2->getRatio() - $player1->getRatio();
        if(res >=0 && res <=$pas){
            return true;
        }
        return false;
    }


}
