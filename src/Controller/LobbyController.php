<?php

namespace App\Controller;
use App\Entity\Lobby;
use App\Entity\Player;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class LobbyController extends AbstractController
{
    /**
     * @Route("/lobby", name="lobby_index")
     * @Security('is_granted(IS_AUTHENTICATED_FULLY)')
     */
    public function index(\Symfony\component\Security\Core\Security $security): Response
    {

        $lobby = $this->getDoctrine()
        ->getRepository(Lobby::class)
        ->findFirst();

        $players = $lobby->getPlayers();
        $user = $security->getUser();
        return $this->render('lobby/index.html.twig', [
            'players' => $players,
            'user' => $user
        ]);
    }


        /**
     * @Route("/addToLobby", name="add_to_lobby")
     * @Security('is_granted(IS_AUTHENTICATED_FULLY)')
     */
    public function addPlayer(\Symfony\component\Security\Core\Security $security): Response
    {

        if(!$security->isGranted('ROLE_USER')){
            return $this->redirectToRoute('lobby_index');
        }

        $lobby = $this->getDoctrine()
        ->getRepository(Lobby::class)
        ->findFirst();
        $player = $security->getUser();
        $lobby->addPlayer($player->getUsername());

        return $this->redirectToRoute('lobby_index');
    }
}
