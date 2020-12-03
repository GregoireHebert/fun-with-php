<?php

namespace App\Controller;

use App\Entity\Lobby;
use App\Entity\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\LobbyRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lobby")
 */
class LobbyController extends AbstractController
{
    /**
     * @Route("/", name="join_lobby", methods={"GET"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function index(LobbyRepository $lobbyRepository, Request $request): Response
    {
        // Récupérer le user
        $player = $this->getDoctrine()
        ->getRepository(Player::class)
        ->findByUsername($request->getSession()->get('username'));

        $lobby = $lobbyRepository->find(1);
        if(!$lobby) {
            $lobby = new Lobby();
        }
        
        $lobby->addPlayer($player);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($lobby);
        $entityManager->flush();

        return $this->render('lobby/index.html.twig', [
            'lobby' => $lobbyRepository->find(1),
        ]);
    }

}
