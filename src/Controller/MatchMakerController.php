<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Player;
use App\Entity\Probability;

class MatchMakerController extends AbstractController
{

    private function getPrintingProbability(Player $player1, Player $player2): string {
        return sprintf("Probability of player %s against player %s : %f\n", 
            $player1->getName(), 
            $player2->getName(), 
            Probability::getProbability($player1, $player2)
        );
    } 
    
    

    private function getResults(): array {
        $playerA = new Player("A");
        $playerA->setPoints(1700);
        $playerB = new Player("B");
        $playerB->setPoints(2500);
        $playerC = new Player("C");
        $playerC->setPoints(1200);
        $playerD = new Player("D");
        $playerD->setPoints(1800);
        $result = [];
        array_push($result, self::getPrintingProbability($playerA, $playerB));
        array_push($result, self::getPrintingProbability($playerB, $playerA));
        array_push($result, self::getPrintingProbability($playerC, $playerA));
        array_push($result, self::getPrintingProbability($playerA, $playerC));
        array_push($result, self::getPrintingProbability($playerD, $playerA));
        array_push($result, self::getPrintingProbability($playerA, $playerD));
        return $result;
    }

    /**
     * @Route("", name="match_maker")
     */
    public function index(): Response
    {
        $results = self::getResults();
        return $this->render('match_maker/index.html.twig', [
            'controller_name' => 'MatchMakerController',
            'results' => $results,
        ]);
    }
}
