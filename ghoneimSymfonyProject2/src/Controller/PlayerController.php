<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\Type\PlayerType;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\UserPassportInterface;

class PlayerController extends AbstractController
{
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository) {
        $this->playerRepository = $playerRepository;
    }

    /**
     * @return Response
     * @Route ("/player/new", name="player_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $userPasswordEncoder): Response {
        $player = new Player();
        $form = $this->createForm(PlayerType::class, $player);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $player->setPassword($userPasswordEncoder->encodePassword($player, $player->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($player);
            $entityManager->flush();

            return $this->redirectToRoute('player');
        }

        return $this->render('player/new.html.twig', [
            'player' => $player,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/player", name="player")
     */
    public function index(): Response
    {
        return $this->render('player/index.html.twig', [
            'controller_name' => 'PlayerController',
        ]);
    }

    /**
     * @Route ("/player/create", name="create_player")
     */
    public function create(Request $request) {
        $content = $request->getContent();
        return new Response($content);
    }

    /**
     * @return Response
     * @Route ("/player/list")
     */
    public function list(): Response {
        $res = "";
        $players = $this->playerRepository->findAll();
        foreach ($players as $player) {
            $res .= $player;
        }
        return new Response($res);
    }

    /**
     * @Route ("player/prob/{id1}/{id2}", name = "get_win_prob")
     */
    public function getWinProbability(int $id1, int $id2): Response {
        $player1 = $this->playerRepository->find($id1);
        $player2 = $this->playerRepository->find($id2);
        $res = $this->calcWinProbability($player1, $player2);
        $response = "Probabilité du joueur " . $player1->getName() . " face au joueur " . $player2->getName() . " : " . $res;
        return new Response($response);
    }

    private function calcWinProbability($player1, $player2) {
        $pow = ($player2->getPoints() - $player1->getPoints()) / 400;
        return 1 / (1 + pow(10, $pow));
    }
}
