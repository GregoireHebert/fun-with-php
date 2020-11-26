<?php

namespace App\Controller;

use App\Entity\Duel;
use App\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/simulation", name="simulation_")
 */
class SimulationController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index(): Response
    {
        return $this->render('simulation/index.html.twig');
    }

    /** 
     * @Route("/result", name="result")
     */
    public function result(Request $request): Response
    {
        $player1 = $request->query->get('player1');
        $elo1 = intval($request->query->get('elo1'));
        $player2 = $request->query->get('player2');
        $elo2 = intval($request->query->get('elo2'));
        $result = $request->query->get('result');
        
        $initialsRatings = [$elo1, $elo2];

        $hyriz = new Player($player1, $initialsRatings[0]);
        $timoru = new Player($player2, $initialsRatings[1]);
        
        $duel = new Duel($hyriz, $timoru);
        $duel->setResult($result);
        $duel->updateRatings(); 

        return $this->render('simulation/result.html.twig', [
            'ratings' => $initialsRatings,
            'duel' => $duel
        ]);
    }
}
