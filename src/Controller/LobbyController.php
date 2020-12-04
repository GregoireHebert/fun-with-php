<?php

namespace App\Controller;

use App\Entity\Lobby;
use App\Entity\Match;
use App\Form\LobbyType;
use App\Repository\LobbyRepository;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lobby")
 */
class LobbyController extends AbstractController
{
    private $pas=100;
    /**
     * @Route("", name="lobby_index")
     */
    public function index(LobbyRepository $lobbyRepository): Response
    {
        $lobby = $lobbyRepository->findAll()[0];
        return $this->render('lobby/index.html.twig', [
            'lobby' => $lobby,
        ]);
    }

    /**
     * @Route("/add", name="lobby_add")
     */
    public function add(PlayerRepository $playerRepository,LobbyRepository $lobbyRepository) : Response
    {
        $playsession =  $this->get('session')->get('user');
        $id = $playsession->getId();
        $player = $playerRepository->find($id);
        $lobby = $lobbyRepository->findAll()[0];
        if(!in_array($player,$lobby->getAllPlayers()))
        {
            $lobby->addPlayer($player);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lobby);
            $entityManager->flush();
        }
        return $this->render('lobby/index.html.twig', [
            'lobby' => $lobby,
        ]);
    }

    /**
     * @Route("/remove", name="lobby_remove")
     */
    public function remove (PlayerRepository $playerRepository,LobbyRepository $lobbyRepository) : Response
    {
        $playsession =  $this->get('session')->get('user');
        $id = $playsession->getId();
        $player = $playerRepository->find($id);
        $lobby = $lobbyRepository->findAll()[0];
        if(in_array($player,$lobby->getAllPlayers()))
        {
            $lobby->removePlayer($player);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lobby);
            $entityManager->flush();
        }
        return $this->render('home_page/index.html.twig', [
        ]);
    }

    /**
     * @Route("/play", name="play")
     */
    public function playGame(LobbyRepository $lobbyRepository) : Response
    {
        $lobby = $lobbyRepository->findAll()[0];
        $allPlayers = $lobby->getAllPlayers();
        $size = sizeof($allPlayers);
        $entityManager = $this->getDoctrine()->getManager();
        $playamatch = false;
        for($i=0;$i<$size;$i++){
            for($j=0;$j<$size;$j++){
                $playerA = $allPlayers[$i];
                $playerB = $allPlayers[$j];
                if($playerA != $playerB && $lobby->okMatch($playerA,$playerB,$this->pas)){
                    $match = new Match();
                    $match->setPlayerA($playerA);
                    $match->setPlayerB($playerB);
                    $entityManager->persist($match);
                    $entityManager->flush();
                    $lobby->removePlayer($playerA);
                    $lobby->removePlayer($playerB);
                    $playamatch = true;
                }
            }
        }
        /**
        if(!$playamatch){
            $this->playGame($lobbyRepository,$this->pas+100);
        }
         * **/
        $matches = $this->getDoctrine()
            ->getRepository(Match::class)
            ->findAll();

        return $this->render('match/index.html.twig', [
            'matches' => $matches,
        ]);
    }


}
