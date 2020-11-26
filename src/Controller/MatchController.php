<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use App\Entity\Match;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MatchController
 * @package App\Controller
 * @Route ("/match")
 */
class MatchController extends AbstractController
{

	private PlayerRepository $repo;

    public function __construct() {
        $this->repo = new PlayerRepository();
    }

	    /**
     * @return Response
     * @Route ("/{id1}/{id2}")
     */
    public function playMatch(Request $request, int $id1, int $id2): Response {

        $playerA = $this->repo->findPlayerById($id1);
        $playerB = $this->repo->findPlayerById($id2);

        $res = "Les joueurs : <br>";
        $res .= "Rang du joueur " . $playerA->getUsername() . " : " . $playerA->getRank() . "<br>";
        $res .= "Rang du joueur " . $playerB->getUsername() . " : " . $playerB->getRank() . "<br><br>";

        $matchAB = new Match($playerA,$playerB);
        $probaAB = $matchAB->get_proba();
        $probaBA = 1 - $matchAB->get_proba();
        $res .= "Probabilité joueur A face au joueur B : " . $probaAB . "<br>";
        $res .= "Probabilité joueur B face au joueur A : " . $probaBA . "<br><br>";

        $res .= "Rang après le match A contre B : <br>";
        $matchAB->endMatch(1);
        $res .= "Rang du joueur A : " . $playerA->getRank() . "<br>";
        $res .= "Rang du joueur B : " . $playerB->getRank() . "<br>";

        return new Response($res);
    }
}

