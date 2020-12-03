<?php

namespace App\Controller;

use App\Entity\Lobby;
use App\Entity\Match;
use App\Entity\Player;
use App\Form\LobbyType;
use App\Repository\LobbyRepository;
use App\Repository\PlayerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/lobby")
 */
class LobbyController extends AbstractController
{
    /**
     * @Route("/", name="lobby_index", methods={"GET"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function index(LobbyRepository $lobbyRepository): Response
    {
        return $this->render('lobby/index.html.twig', [
            'lobbies' => $lobbyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lobby_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lobby = new Lobby();
        $form = $this->createForm(LobbyType::class, $lobby);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lobby);
            $entityManager->flush();

            return $this->redirectToRoute('lobby_index');
        }

        return $this->render('lobby/new.html.twig', [
            'lobby' => $lobby,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lobby_show", methods={"GET"})
     */
    public function show(Lobby $lobby): Response
    {
        return $this->render('lobby/show.html.twig', [
            'lobby' => $lobby,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lobby_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lobby $lobby): Response
    {
        $form = $this->createForm(LobbyType::class, $lobby);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lobby_index');
        }

        return $this->render('lobby/edit.html.twig', [
            'lobby' => $lobby,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lobby_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lobby $lobby): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lobby->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lobby);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lobby_index');
    }

    /**
     * @Route("/{id}", name="lobby_enter", methods={"POST"})
     */
    public function enter(Lobby $lobby, PlayerRepository $playerRepository): Response
    {
        $user = $this->getUser();

        //Set lobby to a player
        $player = $playerRepository->findOneByUsername($user->getUsername());
        $player->setLobby($lobby);

        //Set player to a lobby
        $lobby->addPlayer($player);

        //Persist data
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($lobby);
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('lobby/show.html.twig', [
            'lobby' => $lobby,
        ]);

    }

    /**
     * @Route("/{id}", name="lobby_match", methods={"POST"})
     */
    public function generate_match(Lobby $lobby): Response
    {
        $players = $lobby->getPlayer();


        $match = null;

        for($i = 0; $i < count($players); ++$i){
            $p = $players->get($i);
            $matchSearch = $this->getDoctrine()
                ->getRepository(Match::class)
                ->findBy($p);

            if($matchSearch == null && $match == null){
                $match = new Match();
                $match->setPlayerA($p);
            }
            if($matchSearch == null && $match != null){
                $ratioPlayerA = $match->getPlayerA()->getRatio();
                if($ratioPlayerA >= $p->getRatio() + 100){
                    $match->setPlayerB($p);
                    $match->setStatus('playing');
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($match);
                    $entityManager->flush();
                }

            }

        }


    }


}
