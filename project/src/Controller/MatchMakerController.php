<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Joueur;
use App\Entity\Match;

class MatchMakerController extends AbstractController
{
    /**
     * @Route("/match_maker", name="match")
     */
    public function index(): Response
    {
        $joueurA = new Joueur("joueurA");
        $joueurA->setElo(1700);
        $joueurB = new Joueur("joueurB");
        $joueurB->setElo(2500);
        $joueurC = new Joueur("joueurC");
        $joueurD = new Joueur("joueurD");
        $joueurD->setElo(1800);

        $jA_vsjB = new Match($joueurA, $joueurB);
        $jB_vsjA = new Match($joueurB, $joueurA);

        $jC_vsjA = new Match($joueurC, $joueurA);
        $jA_vsjC = new Match($joueurA, $joueurC);

        $jD_vsjA = new Match($joueurD, $joueurA);
        $jA_vsjD = new Match($joueurA, $joueurD);
        
        $joueurs = array($joueurA, $joueurB, $joueurC, $joueurD);
        $matchs = array($jA_vsjB, $jB_vsjA, $jC_vsjA, $jA_vsjC, $jD_vsjA, $jA_vsjD);

        return $this->render('match_maker/index.html.twig', [
            'joueurs' => $joueurs,
            'matchs' => $matchs
        ]);
    }
}
