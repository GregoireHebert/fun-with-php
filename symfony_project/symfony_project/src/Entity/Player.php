<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 */
class Player
{



    private string $name;

    private Level $level;

    public function __construct(string $name)
    {
        $this->level = new Level();
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function setLevel(Level $l) : void
    {
        $this->level = $l;
    }

    
    public function getLevel(): Level
    {
        return $this->level;
    }


    public function __toString() : String
    {
       return $this->name." avec un ratio de ".$this->level; 
    }

}
