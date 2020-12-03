<?php

namespace App\Controller;

use App\Repository\LobbyRepository;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LobbyController
 * @package App\Controller
 * @Route ("/lobby")
 */
class LobbyController extends AbstractController
{
    private $lobbyRepository;
    private $playerRepository;

    public function __construct(LobbyRepository $lobbyRepository, PlayerRepository $playerRepository)
    {
        $this->lobbyRepository = $lobbyRepository;
        $this->playerRepository = $playerRepository;
    }

    /**
     * @Route("/", name="lobby")
     */
    public function index(): Response
    {
        return $this->render('lobby/index.html.twig', [
            'controller_name' => 'LobbyController',
        ]);
    }

    /**
     * @Route("/list", name="list_lobbies")
     */
    public function list(): Response {
        return $this->render('lobby/list.html.twig', [
            'lobbies' => $this->lobbyRepository->findAll()
        ]);
    }

    /**
     * @Route ("/show_lobby/{id}", name="show_lobby")
     */
    public function showLobby(int $id) {
        return $this->render('lobby/show_lobby.html.twig', [
            'lobby' => $this->lobbyRepository->find($id)
        ]);
    }

    /**
     * @Route("/add_player/{id_lobby}", name="add_player_to_lobby")
     */
    public function addPlayer(int $id_lobby) {
        $lobby = $this->lobbyRepository->find($id_lobby);
        $player = $this->playerRepository->findBy(['username' => $this->getUser()->getUsername()]);
        $lobby->addPlayer($player[0]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($lobby);
        $this->redirectToRoute('https://localhost:8000/lobby/show_lobby/' . $id_lobby);
    }
}
