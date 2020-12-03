<?php

namespace App\Controller;

use App\Entity\Lobby;
use App\Form\LobbyType;
use App\Repository\LobbyRepository;
use App\Entity\Player;
use App\Form\PlayerType;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class LobbyController extends AbstractController
{
    /**
     * @Route("/lobby", name="lobby")
     * @Security("is_granted('ROLE_USER')")
     */
    public function index(): Response
    {
        return $this->render('lobby/index.html.twig', [
            'controller_name' => 'LobbyController',
        ]);
    }

    /**
     * @Route("/lobby/register/{id}", name="lobby_rehister", methods={"POST"})
     * @Security("is_granted('ROLE_USER')")
     */
    public function register(Request $request): Response
    {
        $lobby = new Lobby();
        $form = $this->createForm(LobbyType::class, $lobby);
        $form->handleRequest($request);

        $id=$request->get('id');

        if ($form->isSubmitted() && $form->isValid()) {
            $lobby->setPlayerId($id);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lobby);
            $entityManager->flush();

            return $this->redirectToRoute('lobby');
        }

        return $this->redirectToRoute('lobby');
    }
}
