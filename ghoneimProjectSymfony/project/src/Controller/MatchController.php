<?php

namespace App\Controller;

use App\Repository\Impl\PlayerRepositoryImpl;
use App\Repository\PlayerRepository;
use \Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class MatchController
 * @package App\Controller
 * @Route ("/match")
 */
class MatchController extends AbstractController
{

    private PlayerRepository $repo;

    public function __construct() {
        $this->repo = new PlayerRepositoryImpl();
    }

    /**
     * @return Response
     * @Route ("/play/{id1}/{id2}")
     */
    public function playMatch(Request $request, int $id1, int $id2): Response {
        $prob = $this->repo->findWinPropability($id1, $id2);
        $player1 = $this->repo->findPlayerById($id1);
        $player2 = $this->repo->findPlayerById($id2);
        $res = $player1->__toString() . $player2->__toString();
        $res .= "The match started between player [" . $player1->getName() ."] and player [". $player2->getName() . "]. With a win probability equal to [" . $prob . "] for player [" . $player1->getName() . "].<br>";
        $r = mt_rand() / mt_getrandmax();
        if ($r < $prob) {
            $res .= "Player " . $player1->getName() . " win the match <br>";
            $this->repo->updatePoints($player1, 1, $prob);
            $this->repo->updatePoints($player2, 0, $prob);
        } else if ($r > $prob) {
            $res .= "Player " . $player2->getName() . " win the match <br>";
            $this->repo->updatePoints($player1, 0, $prob);
            $this->repo->updatePoints($player2, 1, $prob);
        } else {
            $res .= "Draw <br>";
            $this->repo->updatePoints($player1, 0.5, $prob);
            $this->repo->updatePoints($player2, 0.5, $prob);
        }
        $res .= $player1->__toString() . $player2->__toString();
        return new Response($res);
    }
}