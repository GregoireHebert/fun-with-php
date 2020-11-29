<?php

namespace App\Controller;

use App\Entity\Player;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository) {
        $this->playerRepository = $playerRepository;
    }

    /**
     * @Route("/player", name="player")
     */
    public function index(): Response
    {
        return $this->render('player/index.html.twig', [
            'controller_name' => 'PlayerController',
        ]);
    }

    /**
     * @Route ("/player/create", name="create_player")
     */
    public function create(Request $request) {
        $content = $request->getContent();
        return new Response($content);
    }

    /**
     * @return Response
     * @Route ("/player/list")
     */
    public function list(): Response {
        $res = "";
        $players = $this->playerRepository->findAll();
        foreach ($players as $player) {
            $res .= $player;
        }
        return new Response($res);
    }

    /**
     * @Route ("player/prob/{id1}/{id2}", name = "get_win_prob")
     */
    public function getWinProbability(int $id1, int $id2): Response {
        $player1 = $this->playerRepository->find($id1);
        $player2 = $this->playerRepository->find($id2);
        $res = $this->calcWinProbability($player1, $player2);
        $response = "Probabilité du joueur " . $player1->getName() . " face au joueur " . $player2->getName() . " : " . $res;
        return new Response($response);
    }

    private function calcWinProbability($player1, $player2) {
        $pow = ($player2->getPoints() - $player1->getPoints()) / 400;
        return 1 / (1 + pow(10, $pow));
    }
}
