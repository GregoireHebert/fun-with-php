<?php

namespace App\Controller;




use App\Entity\Game;
use App\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class MatchMakerController extends AbstractController
{
    /**
     * @Route("", name="match_maker")
     */
    public function index(): Response
    {
        $playerA = new Player("A");
        $playerB = new Player("B");
        $playerC = new Player("C");
        $playerD = new Player("D");

        $playerA->setLevel(1700);
        $playerB->setLevel(2500);
        $playerC->setLevel(1200);
        $playerD->setLevel(1800);

        $game1 = new Game($playerA,$playerB);
        $game2 = new Game($playerC,$playerA);
        $game3 = new Game($playerD,$playerA);
        return $this->render('match_maker/index.html.twig', [
            'controller_name' => 'MatchMakerController',
            'game1' => $game1,
            'game2' => $game2,
            'game3' => $game3
        ]);
    }
}
