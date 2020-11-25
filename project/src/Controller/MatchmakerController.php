<?php

namespace App\Controller;

use App\Entity\Level;
use App\Entity\Player;
use App\Entity\Probability;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchmakerController extends AbstractController
{
    /**
     * @Route("", name="matchmaker")
     */
    public function index(): Response
    {
        $level = new Level();

        $playerA = new Player("PlayerA");
        $playerB = new Player("PlayerB");
        $playerC = new Player("PlayerC");
        $playerD = new Player("PlayerD");

        $probability = new Probability();

        $playerA->setPoints(1700);
        $playerB->setPoints(2500);
        $playerC->setPoints(1200);
        $playerD->setPoints(1800);

        $probability1ab = $probability->getProbability($playerA, $playerB);
        $probability1ba = $probability->getProbability($playerB, $playerA);

        $proba = array();
        
        array_push($proba, $probability->getProbability($playerA, $playerB));
        array_push($proba, $probability->getProbability($playerB, $playerA));
        array_push($proba, $probability->getProbability($playerC, $playerA));
        array_push($proba, $probability->getProbability($playerA, $playerC));
        array_push($proba, $probability->getProbability($playerD, $playerA));
        array_push($proba, $probability->getProbability($playerA, $playerD));

        $playerA->setPoints($level -> newLevel($playerA, 1, $probability1ab));
        $playerB->setPoints($level -> newLevel($playerB, 0, $probability1ba));

        $players = array();
        array_push($players, $playerA, $playerB);

        return $this->render('matchmaker/index.html.twig', [
            'controller_name' => 'MatchmakerController',
            'probability' => $proba,
            'players' => $players,
        ]);
    }
}
