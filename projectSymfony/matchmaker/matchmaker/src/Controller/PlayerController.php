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
 * @Route ("/player")
 */
class PlayerController extends AbstractController
{

	private PlayerRepository $repo;

    public function __construct() {
        $this->repo = new PlayerRepository();
    }

	    /**
     * @return Response
     * @Route ("/{id}")
     */
    public function playMatch(Request $request, int $id): Response {

        $playerA = $this->repo->findPlayerById($id);

        $res = "Rang du joueur " . $playerA->getUsername() . " : " . $playerA->getRank() . "<br>";

        return new Response($res);
    }
}
