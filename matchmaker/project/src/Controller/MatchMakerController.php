<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Player;

class MatchMakerController extends AbstractController
{
    /**
     * @Route("", name="match_maker")
     */
    public function index(): Response
    {

        $playerA = new Player("A", 1700);
        $playerB = new Player("B", 2500);
        $playerC = new Player("C", 1200);
        $playerD = new Player("D", 1800);

        $final =  "<br><br>Probabilité du joueur A face au joueur B: " . $playerA->probaTowin($playerB). "<br><br>";

        $final .=  "Probabilité du joueur B face au joueur A: " . $playerB->probaTowin($playerA). "<br><br>";

        $final .=  "Probabilité du joueur C face au joueur A: " .  $playerC->probaTowin($playerA). "<br><br>";

        $final .=  "Probabilité du joueur A face au joueur C: " . $playerA->probaTowin($playerC). "<br><br>";

        $final .=  "Probabilité du joueur D face au joueur A: " . $playerD->probaTowin($playerA). "<br><br>";

        $final .=  "Probabilité du joueur A face au joueur D: " . $playerA->probaTowin($playerD). "<br><br>";

        $final .= "Admettons que A gagne face à B contre toute attente. Il faudrait corriger leurs niveaux respectifs.<br><br>";

        $playerA->winAgainst($playerB);
        $final .= "Le nouveau niveau du joueur A est: 1700 + 32 * (1 - 0.0099009900990099) soit: " . $playerA->getLevel(). "<br><br>";
        $playerB->lostAgainst($playerA);
        $final .= "Le nouveau niveau du joueur B est: 2500 + 32 * (0 - 0.99009900990099) soit: " . $playerB->getLevel(). "<br><br>";

        return new Response($final);
    }
}
