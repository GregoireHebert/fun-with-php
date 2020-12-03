<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LobbyController extends AbstractController
{
    /**
     * @Route("/lobby", name="lobby")
     */
    public function index(): Response
    {
        $lobbies = $this->getDoctrine()->getRepository(Match::class)->findAll();

        return $this->render('lobby/index.html.twig', [
            'lobbies' => $lobbies,
        ]);
    }

    public function createLobby(): Response
    {
        //on crée un lobby/salon où les joueurs pourront rentrer
    }
}
