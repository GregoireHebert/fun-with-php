<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Player;
use App\Entity\Game;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     */
    public function game():Response
    {
        $playerA = new Player("Joueur A",1700);
        $playerB = new Player("Joueur B",2500);
        $playerC = new Player("Joueur C",1200);
        $playerD = new Player("Joueur D",1800);
        $playAvB = new Game($playerA, $playerB);
        $playAvC = new Game($playerA, $playerC);
        $playAvD = new Game($playerA, $playerD);

        $players = array();
        array_push($players, $playerA, $playerB, $playerC, $playerD);

        $plays= array();
        array_push($plays, $playAvB, $playAvC, $playAvD);
        
        //not working
        // $playAvB->correctPlayersNewScore(1);
        
        // $probAvB= array();
        // array_push($probAvB, $playerA, $playerB);
        

        return $this->render('game/game.html.twig', [
            'players' => $players,
            'games' => $plays
            // 'probAvB' => $probAvB
        ]);

    }

}
