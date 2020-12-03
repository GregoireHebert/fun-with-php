<?php

namespace App\Entity;

class Player
{
    public string $name;
    public float $level;

    function __construct(string $name)
    {
        $this->name=$name;
        $this->level=1200;
    }

    function correctLevel(int $result, float $proba)
    {
        $this->level+=32*($result-$proba);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param float $level
     */
    public function setLevel(float $level)
    {
        $this->level = $level;
    }

    public function __toString()
    {
        return $this->getName().$this->getLevel();
    }


}