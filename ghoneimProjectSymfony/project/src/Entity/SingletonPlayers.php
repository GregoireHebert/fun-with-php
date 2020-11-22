<?php


namespace App\Entity;

class SingletonPlayers
{
    private static array $instances = [];

    private $players;
    private Player $A;
    private Player $B;
    private Player $C;
    private Player $D;

    protected function __construct() {
        $this->A = new Player();
        $this->A->setId(1);
        $this->A->setName("A");
        $this->A->setPoints(1700);

        $this->B = new Player();
        $this->B->setId(2);
        $this->B->setName("B");
        $this->B->setPoints(2500);

        $this->C = new Player();
        $this->C->setId(3);
        $this->C->setName("C");
        $this->C->setPoints(1200);

        $this->D = new Player();
        $this->D->setId(4);
        $this->D->setName("D");
        $this->D->setPoints(1800);

        $this->players = array($this->A, $this->B, $this->C, $this->D);
    }

    /**
     * @return mixed
     */
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @return Player
     */
    public function getA(): Player
    {
        return $this->A;
    }

    /**
     * @return Player
     */
    public function getB(): Player
    {
        return $this->B;
    }

    /**
     * @return Player
     */
    public function getC(): Player
    {
        return $this->C;
    }

    /**
     * @return Player
     */
    public function getD(): Player
    {
        return $this->D;
    }

    protected function __clone() {}

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(): SingletonPlayers
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }
}