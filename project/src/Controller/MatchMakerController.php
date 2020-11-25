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
        $result_jA_vsjB = $jA_vsjB->playMatch();
        
        $jB_vsjA = new Match($joueurB, $joueurA);
        $result_jB_vsjA = $jB_vsjA->playMatch();

        $jC_vsjA = new Match($joueurC, $joueurA);
        $result_jC_vsjA = $jC_vsjA->playMatch();

        $jA_vsjC = new Match($joueurA, $joueurC);
        $result_jA_vsjC = $jA_vsjC->playMatch();

        $jD_vsjA = new Match($joueurD, $joueurA);
        $result_jD_vsjA = $jD_vsjA->playMatch();

        $jA_vsjD = new Match($joueurA, $joueurD);
        $result_jA_vsjD = $jA_vsjD->playMatch();

        $joueurs = array($joueurA, $joueurB, $joueurC, $joueurD);
        $matchs = array($jA_vsjB, $jB_vsjA, $jC_vsjA, $jA_vsjC, $jD_vsjA, $jA_vsjD);
        $resultatsMatchs = array($result_jA_vsjB, $result_jB_vsjA, $result_jC_vsjA, $result_jA_vsjC, $result_jD_vsjA, $result_jA_vsjD);

        return $this->render('match_maker/index.html.twig', [
            'joueurs' => $joueurs,
            'matchs' => $matchs,
            'resultats' => $resultatsMatchs
        ]);
    }
}
