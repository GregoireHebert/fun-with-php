<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatchMakerController extends AbstractController
{
    /**
     * @Route("/match/maker", name="match_maker")
     */
    public function index(): Response
    {
        return $this->render('match_maker/index.html.twig', [
            'controller_name' => 'MatchMakerController',
        ]);
    }
}
