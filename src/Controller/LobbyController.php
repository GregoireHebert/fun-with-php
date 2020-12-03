<?php

namespace App\Controller;

use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/lobby",)
 */
class LobbyController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    private $playerRepository;

    public function __construct(Security $security, PlayerRepository $playerRepository)
    {
       $this->security = $security;
       $this->playerRepository = $playerRepository;
    }

    /**
     * @Route("/",  name="lobby_index")
     * 
     * @IsGranted("ROLE_USER")
     */
    public function index(): Response
    {
        return $this->render('lobby/index.html.twig');
    }

    /**
     * @Route("/join",  name="lobby_join")
     * 
     * @IsGranted("ROLE_USER")
     */
    public function join(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        /**
         * @var Player
         */
        $player = $this->security->getUser();
        $player->setInLobby(true);
        $entityManager->flush();
        
        $players = $this->playerRepository->findBy(['inLobby' => true]);

        return $this->render('lobby/pool.html.twig', [
            'players' => $players,
        ]);
    }

    /**
     * @Route("/leave",  name="lobby_leave")
     * 
     * @IsGranted("ROLE_USER")
     */
    public function leave(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        /**
         * @var Player
         */
        $player = $this->security->getUser();
        $player->setInLobby(false);
        $entityManager->flush();
        
        return $this->render('lobby/index.html.twig');
    }
}