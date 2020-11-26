<?php

namespace App\Tests;

use App\Entity\Duel;
use App\Entity\Player;
use PHPUnit\Framework\TestCase;

class DuelTest extends TestCase
{
    protected $mateo;
    protected $faaab;
    protected $hyriz;
    protected $timoru;

    protected $pAB = 0.0099009900990099;
    protected $pBA = 0.99009900990099;
    protected $pCA = 0.053240215202022;
    protected $pAC = 0.94675978479798;
    protected $pDA = 0.35993500019711;
    protected $pAD = 0.64006499980289;

    protected function setUp()
    {
        $this->mateo = new Player("mateo", 1700);
        $this->faaab = new Player("faaab", 2500);
        $this->hyriz = new Player("hyriz", 1200);
        $this->timoru = new Player("timoru", 1800);
    }

    public function testUpset()
    {
        $r1 = $this->mateo->getElo();
        $r2 = $this->faaab->getElo();
        
        $duel = new Duel($this->mateo, $this->faaab);
        $duel->setResult('1-0');
        $duel->updateRatings(); 
        
        $this->assertEquals($r1 + 32 * (1 - $this->pAB), $this->mateo->getElo());
        $this->assertEquals($r2 + 32 * (0 - $this->pBA), $this->faaab->getElo());
    }

    public function testTrackmania(){
        $r1 = $this->mateo->getElo();
        $r2 = $this->hyriz->getElo();
        
        $duel = new Duel($this->mateo, $this->hyriz);
        $duel->setResult('1-0');
        $duel->updateRatings(); 
        
        $this->assertEquals($r1 + 32 * (1 - $this->pAC), $this->mateo->getElo());
        $this->assertEquals($r2 + 32 * (0 - $this->pCA), $this->hyriz->getElo());
    }

    public function testChessmania(){
        $r1 = $this->mateo->getElo();
        $r2 = $this->timoru->getElo();
        
        $duel = new Duel($this->mateo, $this->timoru);
        $duel->setResult('0-1');
        $duel->updateRatings(); 
        
        $this->assertEquals($r1 + 32 * (0 - $this->pDA), $this->mateo->getElo());
        $this->assertEquals($r2 + 32 * (1 - $this->pAD), $this->timoru->getElo());
    }
}