<?php

namespace App\Controller;

use App\Entity\SingletonPlayers;
use App\Repository\PlayerRepository;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\Impl\PlayerRepositoryImpl;


/**
 * Class PlayerController
 * @package game
 * @Route ("/player")
 */
class PlayerController extends AbstractController
{

    private PlayerRepository $repo;

    public function __construct() {
        $this->repo = new PlayerRepositoryImpl();
    }

    /**
     * @return Response
     * @Route ("/list")
     */
    public function list(): Response {
        $res = "";
        foreach (SingletonPlayers::getInstance()->getPlayers() as $player) {
            $res .= $player->__toString();
        }
        return new Response($res);
    }

    /**
     * @Route ("/prob/{id1}/{id2}", name = "get_win_prob")
     */
    public function getWinProbability(Request $request, int $id1, int $id2): Response {
        $player1 = $this->repo->findPlayerById($id1);
        $player2 = $this->repo->findPlayerById($id2);
        $res = $res = $this->repo->findWinPropability($id1, $id2);
        $response = "Probabilité du joueur " . $player1->getName() . " face au joueur" . $player2->getName() . " : " . $res;
        return new Response($response);
    }
}