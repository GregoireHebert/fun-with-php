<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Player;
use App\Entity\Game;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        $pA = new Player("Joueur A");
        $pA->getLevel()->setPoints(1700);
        $pB = new Player("Joueur B");
        $pB->getLevel()->setPoints(2500);
        $pC = new Player("Joueur C");
        $pD = new Player("Joueur D");
        $pD->getLevel()->setPoints(1800);
        $gameAB = new Game($pA,$pB);
        $gameAC = new Game($pA,$pC);
        $gameAD = new Game($pA,$pD);
        $players = array($pA,$pB,$pC,$pD);
        $games = array($gameAB,$gameAC,$gameAD);
        return $this->render('index/index.html.twig', [
            'players' => $players,
            'games' => $games
        ]);
    }


        /**
     * @Route("/resultAB", name="resultAB")
     */
    public function resultAB(): Response
    {
        $pA = new Player("Joueur A");
        $pA->getLevel()->setPoints(1700);
        $pB = new Player("Joueur B");
        $pB->getLevel()->setPoints(2500);
        $gameAB = new Game($pA,$pB);
        $gameAB->finish($pA);
        $players = array($pA,$pB);
        return $this->render('index/resultAB.html.twig', [
            'players' => $players,
        ]);
    }
}
